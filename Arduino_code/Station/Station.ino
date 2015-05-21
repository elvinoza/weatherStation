#include <SoftwareSerial.h>
#include "FloatToString.h"
#include "inetGSM.h"
#include <avr/wdt.h>
#include <Wire.h> 
#include "MPL3115A2.h" 
#include "HTU21D.h" 

MPL3115A2 myPressure; 
HTU21D myHumidity;

// digital pins
const byte WSPEED = 3;
const byte RAIN = 2;
const byte STAT1 = 7;

#ifdef ENABLE_LIGHTNING
const byte LIGHTNING_IRQ = 4; //Not really an interrupt pin, we will catch it in software
const byte slaveSelectPin = 10; //SS for AS3935
#endif

// analog pins
const byte WDIR = A0;
const byte LIGHT = A1;
const byte BATT = A2;
const byte REFERENCE_3V3 = A3;

#ifdef ENABLE_LIGHTNING
#include "AS3935.h" //Lighting dtector
#include <SPI.h> //Needed for lighting sensor

byte SPItransfer(byte sendByte);

AS3935 AS3935(SPItransfer, slaveSelectPin, LIGHTNING_IRQ);
#endif

InetGSM inet;

char msg[50];
int numdata;
int i=0;
boolean started=false;
long lastSecond; 
unsigned int minutesSinceLastReset; 
byte seconds; 
byte seconds_2m; 
byte minutes; 
byte minutes_10m; 

long lastWindCheck = 0;
volatile long lastWindIRQ = 0;
volatile byte windClicks = 0;

#ifdef ENABLE_LIGHTNING
byte lightning_distance = 0;
#endif


byte windspdavg[60];
int winddiravg[60]; 
volatile float rainHour[60]; //60 floating numbers to keep track of 60 minutes of rain


int winddir; 
float windspeedmph; 
float windgustmph; 
int windgustdir; //[0-360]
float windspdmph_avg2m; 
int winddir_avg2m;
float humidity; // [%]
float tempC; // temperature in celsius
float rainin; //60min
float rain1m;
volatile float dailyrainin; 
float pressure;
char buffer[4]; //helps convert float to string
float light_lvl;
volatile unsigned long raintime, rainlast, raininterval, rain;

//Interrupt routines (these are called by the hardware interrupts, not by the main code)
void rainIRQ()
// Count rain gauge bucket tips as they occur
// Activated by the magnet and reed switch in the rain gauge, attached to input D2
{
  raintime = millis(); // current time
  raininterval = raintime - rainlast; // calculate interval between this and last event
  
  
  if (raininterval > 10) // ignore switch-bounce glitches less than 10mS after initial edge
  {
    rain1m += 0.2794;
    dailyrainin += 0.2794;
    rainHour[minutes] += 0.2794; //Increase this minute's amount of rain

    rainlast = raintime; // set up for next event
  }
}

// Activated by the magnet in the anemometer (2 ticks per rotation), attached to input D3
void wspeedIRQ()
{
  if (millis() - lastWindIRQ > 10) // Ignore switch-bounce glitches less than 10ms (142MPH max reading) after the reed switch closes
  {
    lastWindIRQ = millis(); //Grab the current time
    windClicks++; //There is 1.492MPH for each click per second.
  }
}

//set up GPRS shield
void setupGSM(){
     if (gsm.begin(2400)) {
          started=true;
     }

     if(started) {
          if (inet.attachGPRS("internet.wind", "", ""))
               Serial.println(F("status=ATTACHED"));
          else Serial.println(F("status=ERROR"));
          delay(1000);

          gsm.SimpleWriteln("AT+CIFSR");
          delay(5000);
          gsm.WhileSimpleRead();
     }
}

//set up weather shield
void setupWeatherShield(){
  
  pinMode(WSPEED, INPUT_PULLUP); // input from wind meters windspeed sensor
  pinMode(RAIN, INPUT_PULLUP); // input from wind meters rain gauge sensor
  pinMode(WDIR, INPUT);
  pinMode(LIGHT, INPUT);
  midnightReset(); //Reset rain totals
  
  //Configure the pressure 
  myPressure.begin(); // Get sensor online
  myPressure.setModeBarometer(); // Measure pressure in Pascals from 20 to 110 kPa
  myPressure.setOversampleRate(128); // Set Oversample to the recommended 128
  myPressure.enableEventFlags(); 
  myPressure.setModeActive(); 

  //Configure the humidity sensor
  myHumidity.begin();

  // attach external interrupt pins to IRQ functions
  attachInterrupt(0, rainIRQ, FALLING);
  attachInterrupt(1, wspeedIRQ, FALLING);
  interrupts();
}

void setup()
{
  Serial.begin(9600);
  wdt_reset(); 
  wdt_disable();
  
  setupGSM();
  setupWeatherShield();
  
  seconds_2m = 0;
  seconds = 0;
  lastSecond = millis();
  rain1m = 0;

  //Serial.println(freeRam());
}

void loop()
{
  wdt_reset();
  if(millis() - lastSecond >= 1000)
  {
    lastSecond += 1000;

    if(++seconds_2m > 59){//119
      seconds_2m = 0;
      getSensorsData();
      sendRequest();
      rain1m = 0;
    }

    windspeedmph = get_wind_speed();
    winddir = get_wind_direction();
    windspdavg[seconds_2m] = (int)windspeedmph;
    winddiravg[seconds_2m] = winddir;

    if(++seconds > 59)
    {
      seconds = 0;

      if(++minutes > 59) minutes = 0;
      if(++minutes_10m > 9) minutes_10m = 0;

      rainHour[minutes] = 0;

      minutesSinceLastReset++;  
    }
    
//    if(minutesSinceLastReset > (1440))
//    {
//      midnightReset(); 
//    }
  }  
}

void getSensorsData(){  
  
  float temp = 0;
  for(int i = 0 ; i < 60 ; i++)
    temp += windspdavg[i];
  temp /= 60.0;
  windspdmph_avg2m = temp;

  temp = 0; 
  for(int i = 0 ; i < 60 ; i++)
    temp += winddiravg[i];
  temp /= 60;
  winddir_avg2m = temp;

  humidity = myHumidity.readHumidity();
  tempC = myPressure.readTemp();

  rainin = 0;  
  for(int i = 0 ; i < 60 ; i++)
    rainin += rainHour[i];

  pressure = myPressure.readPressure();
  light_lvl = get_light_level();
}

String createQuery(){
  //app_id=3RkTSJ&app_key=KjdTEANlw6YPxKIP       //TODO: Insert Auth into query
  String query = "/api/v1/set?";
  query = query + "t=" + floatToString(buffer, tempC, 2);
  delay(20);
  query = query + "&h=" + floatToString(buffer, humidity, 2);
  delay(20);
  query = query + "&l=" + floatToString(buffer, light_lvl, 2);
  delay(20);
  query = query + "&p=" + floatToString(buffer, pressure, 2);
  delay(20);
  query = query + "&wd=" + String(winddir_avg2m);
  delay(20);
  query = query + "&ws=" + floatToString(buffer, windspdmph_avg2m, 2);
  delay(20);
  query = query + "&r=" + floatToString(buffer, rain1m, 2);
  
  return query;
}

//send request to the server
void sendRequest()
{
  String query = createQuery();
  //Serial.println(query);
  char __query[query.length()];
  query.toCharArray(__query, query.length());
  Serial.println(__query);
  numdata=inet.httpGET("www.weatherstation.needwebsite.eu", 80, __query, msg, 50);
  
}

//return light level
float get_light_level()
{
  float operatingVoltage = averageAnalogRead(REFERENCE_3V3);

  float lightSensor = averageAnalogRead(LIGHT);

  operatingVoltage = 3.3 / operatingVoltage; //The reference voltage is 3.3V

  lightSensor *= operatingVoltage;

  return(lightSensor);
}

//return wind speed
float get_wind_speed()
{
  float deltaTime = millis() - lastWindCheck; //750ms

  deltaTime /= 1000.0; //Covert to seconds

  float windSpeed = (float)windClicks / deltaTime; //3 / 0.750s = 4

  windClicks = 0; //Reset and start watching for new wind
  lastWindCheck = millis();

  windSpeed *= 1.492; //4 * 1.492 = 5.968MPH
  
  return(windSpeed);
}

//return wind direction
int get_wind_direction() 
{
  unsigned int adc;
  adc = averageAnalogRead(WDIR);

  if (adc < 380) return (113);
  if (adc < 393) return (68);
  if (adc < 414) return (90);
  if (adc < 456) return (158);
  if (adc < 508) return (135);
  if (adc < 551) return (203);
  if (adc < 615) return (180);
  if (adc < 680) return (23);
  if (adc < 746) return (45);
  if (adc < 801) return (248);
  if (adc < 833) return (225);
  if (adc < 878) return (338);
  if (adc < 913) return (0);
  if (adc < 940) return (293);
  if (adc < 967) return (315);
  if (adc < 990) return (270);
  return (-1); //error
}

//Takes an average of readings on a given pin
//Returns the average
int averageAnalogRead(int pinToRead)
{
  byte numberOfReadings = 8;
  unsigned int runningValue = 0; 

  for(int x = 0 ; x < numberOfReadings ; x++)
    runningValue += analogRead(pinToRead);
  runningValue /= numberOfReadings;

  return(runningValue);  
}

//return available Ram
int freeRam () {
  extern int __heap_start, *__brkval; 
  int v; 
  return (int) &v - (__brkval == 0 ? (int) &__heap_start : (int) __brkval); 
}

//Reset all variables
void midnightReset()
{
  dailyrainin = 0; 

  windgustmph = 0; 
  windgustdir = 0; 

  minutes = 0; 
  seconds = 0;
  lastSecond = millis(); 

  minutesSinceLastReset = 0; 
}

