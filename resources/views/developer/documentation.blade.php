@extends('layouts.developer_layout')
@section('hello')
@stop
@section('content')
    <section id="contact" class="home-section nopadd-bot color-dark bg-gray" style="padding-top: 50px">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="h-bold">Nuosavos stotelės sukūrimas</h3>
                            <p>
                                Šiame vadove jums pateiksime visus reikiamus atlikti žingsnius, kad galėtumėte
                                susikurti savo nuosavą nutolusią orų stotelę ir galėtumėte naudotis mūsų teikiamomis
                                paslaugomis.
                            </p>
                            <h5>Reikalinga įranga</h5>
                            <p>Mes rekomenduosime ir pateikiame jums visos reikalingos įrangos sąrašą, kurios užteks
                            pasidaryti nuosavą stotelę. Tačiau tai nėra būtina. Jūs galite naudotis ir kitokia įranga.<br>
                                1. Mikrokontroleris "Arduino Uno R3". Daugiau apie mikrokontrolerį galite rasti <a href="http://www.arduino.cc/en/Main/ArduinoBoardUno" target="_blank">čia</a>.<br>
                                2. Orų daviklių plokštė "SparkFun Weather Shield". Daugiau informacijos apie plokštę galite rasti <a href="https://www.sparkfun.com/products/12081" target="_blank">čia</a>.<br>
                                3. 2 vnt. <a href="https://www.sparkfun.com/products/132" target="_blank">RJll 6-PIN</a> sujungėjų. <br>
                                4. Kritulių, vėjo greičio ir krypties davikliai. Daugiau informacijos rasite <a href="https://www.sparkfun.com/products/8942" target="_blank">čia</a>.<br>
                                5. GPRS plokšė <a href="http://www.seeedstudio.com/wiki/GPRS_Shield_V1.0" target="_blank">"GPRS Shield V1.0"</a> su sim kortele ir interneto prieiga. <br>
                                6. Stovas, bei apsauga nuo lietaus(plokštėms) - pagal nuožiūra.<br>
                                7. Matitinimas 12V.
                            </p>
                            <h5>Vadovas</h5>
                            <h6>Stotelės surinkimas</h6>
                            <img src="{{ asset('img/station.jpg') }}" width="300" style="align: left" class="center-block" alt="Arduino Uno, Weather Shield, GPRS shield" />
                            <p>
                                Paveikslėlyje yra matoma kaip tarpusavyje yra sujungtos plokštės. Viršuje yra GPRS plokštė su įstatyta
                                SIM kortele, viduryje - orų daviklių plokštė, apačioje - Arduino Uno R3. Sujungite išorinius daviklius į
                                "Weather" plokštę. Vėjo greičio ir krypties į daviklį į "Wind" jungtį, o kritulių daviklį į "Rain" jungtį.
                                Norėdami įrašyti programinį kodą į stotelę jums reikės atsisiųsti <a href="http://www.arduino.cc/en/Main/Software" target="_blank">"Arduino IDE"</a>,
                                bei programinį <a href="{{ asset('arduino_code/Station.ino') }}" download>kodą</a>. Taip pat jums reikės pridėti
                                GPRS, HTU21D bibliotekas. Jas galite pridėti atidarę programą ir "Sketch"->"Import Library..."->"Add Library...".
                                Taip pat atidarę atsiųstą kodą jums reikės pakeisti kintamųjų app_id ir app_key į jūsų, kuriuos galite pamatyti prisijungę ir nuėję
                                į jūsų stotelės informacijos puslapį. Atlikę šiuos veiksmus, jums reikia sujungti Arduino su kompiuteriu USB laidu
                                ir paspausti "Upload" mygtuką.<br>
                                Viskas, jūsų stotelė yra paruošta darbui, įjungite ją nuo maitinimo šaltinio ir paspauskite ant GPRS ploštės esantį mygtuką(2 sekundes)
                                kuris prijungs jūsų stotelę prie mūsų serverio.
                            </p>
                            <h3 class="h-bold">API dokumentacija</h3>
                            <p>
                                Jei nenorite naudotis mūsų teikiama programine įranga stotelei,ar  norite gauti savo stotelės duomenis, kuriuos
                                norite patys apdoroti, naudoti savo internetinėje sveitainėje ar kt. galite naudotis mūsų API. Su API pagalba galite
                                siųsti duomenis iš stotelės į mūsų serverį, bei gauti informacija. Grupuoti, išrinkti pagal laikotarpius,
                                skaičiuoti vidurkius, bei kt. Atlikus užklausą serveris grąžina rezultatus JSON formatu. HTTP yra bendravimo protokolas,
                                MeteO API įgyvendintas REST principais.<br>
                                Užklausos:

                            </p>
                            <ul>
                                <li>
                                    Duomenų siuntimas į serverį<br>
                                    <div style="font-family: courier">
                                    Užklausa: GET /api/v1/set?app_id=app-id&app_key=app-key&t=temperature&h=humidity&l=light-level&p=pressure&wd=wind-direction&ws=wind-speed&r=rain
                                    </div>
                                    Parametrai:<br>
                                    1. app-id - jūsų stotelės sugeneruotas app_id, kuris identifikuoja jūsų stotelę. pvz: 3Rk8S0<br>
                                    2. app-key - jūsų stotelės raktas, kuris reikalingas norint ikelti informaciją į serverį. Jis yra žinomas tik stotelės savininkui,
                                    ir tik jis gali įkelti į serverį informaciją su šiuo raktu. Rakto pavizdys: KjdTEANlw6YPxKIPORINgmMKzQBTJtDt<br>
                                    3. temperature - tempertatūros rodiklis, pagal celsijų. Pavizdys: 24.87<br>
                                    4. humidity - drėgmės rodiklis, procentais. Pavizdys: 26.07 <br>
                                    5. light-level - šviesos lygis. Pavizdys: 1.81 <br>
                                    6. pressure - slėgis, paskaliais(Pa). Pavizdys: 99328.00 <br>
                                    7. wind-direction - vėjo kryptis, laipsniais. Pavizdys: 0-360&deg; <br>
                                    8. wind-speed - vėjo greitis, km/h. Pavizdys: 2.85 km/h. <br>
                                    9. rain - kritulių kiekis, mm. Pavizdys: 0.04 mm.<br>
                                    Rezultatas:<br>
                                    sėkmingo įterpimo atvėju gaunamas:
                                    <code class="prettyprint">
                                        {
                                        "success": true,
                                        "message": "Successfully authenticated and your data inserted."
                                        }
                                    </code><br>
                                    jei nepavyko autentifikuoti stotelės, gaunamas:
                                    <code class="prettyprint">
                                        {
                                        "success": false,
                                        "message": "Authenticate problem. Check your app_id and app_key."
                                        }
                                    </code><br>
                                </li>
                                <li>
                                    Gauti visų sistemoje stotelių sąrašą<br>
                                    <div style="font-family: courier">
                                        Užklausa: GET /api/v1/get/station-list
                                    </div>
                                    Rezultatas: <br>
                                    <code class="prettyprint">
                                        [
                                        {
                                        "id": "3RkTSJ",
                                        "station_name": "Kaunas"
                                        },
                                        {
                                        "id": "LfTaqC",
                                        "station_name": "Kaunas123"
                                        }
                                        ]
                                    </code><br>
                                </li>
                                <li>
                                    Gauti visus stotelės duomenis
                                    <div style="font-family: courier">
                                        Užklausa: GET /api/v1/get/allStationData/{id}
                                    </div>
                                    Parametrai:<br>
                                    1. id - stotelės id.<br>
                                    Rezultatas: <br>

                                    <code class="prettyprint">
                                        [
                                        {
                                        "id": 1,
                                        "user_id": "3RkTSJ",
                                        "temperature": 88.7,
                                        "humidity": 24.51,
                                        "light_level": 0.01,
                                        "pressure": 99328,
                                    </code>
                                    <code class="prettyprint">
                                        "wind_direction": 45,
                                        "wind_speed": 0.03,
                                        "rain": 0,
                                        "created_at": "2015-03-21 13:45:27",

                                    </code><br>
                                    <code class="prettyprint">
                                        "updated_at": "2015-03-21 13:45:27"
                                        },{
                                        "id": 2,
                                        "user_id": "3RkTSJ",
                                        "temperature": 88.47,

                                    </code><br>
                                    <code class="prettyprint">
                                        "humidity": 24.69,
                                        "light_level": 0.02,
                                        "pressure": 99328,
                                        "wind_direction": 45,
                                        "wind_speed": 0,
                                        "rain": 0,
                                    </code><br>
                                    <code class="prettyprint">
                                        "created_at": "2015-03-21 13:45:55",
                                        "updated_at": "2015-03-21 13:45:55"
                                        }, ...]
                                    </code><br>
                                </li>
                                <li>
                                    Gauti stotelės duomenis pagal laikotarpį, bei norimus duomenis
                                    <div style="font-family: courier">
                                        Užklausa: GET /api/v1/get/{parameter}/{id}/{format}
                                    </div>
                                    Parametrai:<br>
                                    1. id - stotelės id.<br>
                                    2. format - duomenų laikotarpio fomatas, gali būti: h - valandos, d - dienos, w - savaitės, m - mėnėsio, y - metų.
                                    Laikotarpis yra imamas nuo šios dienos. Pvz, jei šios dienos data yra 2015-03-03 ir pasirinktas formatas yra d - diena, tai bus
                                    atfiltruota informacija nuo 2015-03-02 iki 2015-03-03 <br>
                                    3. parameter - kokius duomenis norite paimti. Galimi variantai: temperatures, humidities, light_levels,
                                    wind_speeds, wind_direction, rain.
                                    Rezultatas: <br>
                                    <code class="prettyprint">
                                        {
                                        "success": true,
                                        "data": [
                                        {
                                        "temperature": 29.878148148148,
                                        "date": "05-02 13h"
                                        },
                                    </code><br>
                                    <code class="prettyprint">
                                        {
                                        "temperature": 29.193818181818,
                                        "date": "05-02 14h"
                                        },
                                        {
                                        "temperature": 28.479743589744,
                                        "date": "05-02 15h"
                                        },...]}
                                    </code>
                                </li>
                                <li>
                                    Gauti stotelės duomenis pagal savo nustatytą laikotarpį, bei norimus duoemenis
                                    <div style="font-family: courier">
                                        Užklausa: GET /api/v1/get/dataByDate/{id}/{parameter}/{start_date}/{end_date}
                                    </div>
                                    Parametrai:<br>
                                    1. id - stotelės id.<br>
                                    2. parameter - kokius duomenis norite paimti. Galimi variantai: temperatures, humidities, light_levels,
                                    wind_speeds, wind_direction, rain arba all. <br>
                                    3. start_date - laikotarpio pradžia. Pavizdys: 2015-01-05.<br>
                                    4. end_date - laikotarpio pabaiga. Pavizdys: 2015-02-09.<br>
                                    Rezultatas kai parametrai nuropdyti teisingai:
                                    <code class="prettyprint">
                                        {
                                        "success": true,
                                        "data": [
                                        {
                                        "temperature": 24.977880597015,
                                        "date": "2015-05-01"
                                        },

                                    </code>
                                    <code class="prettyprint">
                                        {
                                        "temperature": 29.254455159113,
                                        "date": "2015-05-02"
                                        }, ...
                                        ]}
                                    </code><br>
                                    Rezultatas kai parametrai nurodyti neteisingai:
                                    <code class="prettyprint">
                                        {
                                        "success": false,
                                        "error": "Get data must be: temperature, humidity, light_level, pressure, wind_direction,
                                    </code>
                                    <code class="prettyprint">
                                         "wind_speed, rain or all. Date format must be Y-m-d"
                                        }
                                    </code><br>
                                    Rezultatas kai pradžios data yra didesnė nei pabaigos:
                                    <code class="prettyprint">
                                        {
                                        "success": false,
                                        "error": "Start date must by less than end date"
                                        }
                                    </code>
                                </li>
                                <li>
                                    Gauti paskutinius stotelės duomenis
                                    <div style="font-family: courier">
                                        Užklausa: GET /api/v1/get/lastStationInformation/{id}
                                    </div>
                                    Parametrai:<br>
                                    1. id - stotelės id.<br>
                                    Rezultatai:<br>
                                    <code class="prettyprint">
                                        {
                                        "success": true,
                                        "information": {
                                        "id": 4274,
                                        "user_id": "3RkTSJ",
                                        "temperature": 26.56,
                                        "humidity": 24.94,

                                    </code>
                                    <code class="prettyprint">
                                        "light_level": 0.6,
                                        "pressure": 100352,
                                        "wind_direction": "SW",
                                        "wind_speed": 0,
                                        "rain": 0,
                                    </code>
                                    <code class="prettyprint">
                                        "created_at": "2015-05-03 14:49:38"
                                        }
                                        }
                                    </code>
                                </li>
                            </ul>
                            <h6>Klaidų kodai</h6>
                            <ul>
                                <li>
                                    400 - bloga užklausa.
                                </li>
                                <li>
                                    500 - serverio klaida.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop