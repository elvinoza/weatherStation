<?php

class ApiTest extends TestCase {

    private $user;
    private $app_id;

    public function setUp(){
        parent::setUp();
        $this->user = new \App\User();
        $this->app_id = '3RkTSJ';
    }

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testAuthenticateTrue()
    {
        $api = new \App\Services\Api('3RkTSJ', 'KjdTEANlw6YPxKIPORINgmMKzQBTJtDt', $this->user);
        $result = $api->authenticate();

        $this->assertTrue($result);
    }

    /**
     *  Test authenticate false when id is wrong
     *
     * @return void
     */
    public function testAuthenticateFalseID()
    {
        $api = new \App\Services\Api('3RkTSe', 'KjdTEANlw6YPxKIPORINgmMKzQBTJtDt', $this->user);
        $result = $api->authenticate();
        $this->assertFalse($result);
    }

    /**
     *  Test authenticate false when key is wrong
     *
     * @return void
     */
    public function testAuthenticateFalseKEY()
    {
        $api = new \App\Services\Api('3RkTSJ', 'KjdTEANlw6YPxKdededdRINgmMKzQBTJtDt', $this->user);
        $result = $api->authenticate();
        $this->assertFalse($result);
    }

    /**
     *  Test insert station data
     *
     * @return void
     */
    public function testInsertStationData()
    {
        $this->user = $this->user->find($this->app_id);
        $api = new \App\Services\Api('3RkTSJ', 'KjdTEANlw6YPxKIPORINgmMKzQBTJtDt', $this->user);
        if($api->authenticate()){
            $api->insertStationData(18.45, 21.58, 0.8, 1235.5, 125, 8.5, 0);
            $last = $this->user->weathers->last();
            $this->user->weathers->last()->delete();

            $this->assertEquals($last->temperature, 18.45);
            $this->assertEquals($last->humidity, 21.58);
            $this->assertEquals($last->light_level, 0.8);
            $this->assertEquals($last->pressure, 1235.5);
            $this->assertEquals($last->wind_direction, 125);
            $this->assertEquals($last->wind_speed, 8.5);
            $this->assertEquals($last->rain, 0);
        }
    }

    /**
     *  Test to get all data
     *
     * @return void
     */
    public function testGetAllData()
    {
        $this->user = $this->user->find($this->app_id);
        $api = new \App\Services\Api('3RkTSJ', 'KjdTEANlw6YPxKIPORINgmMKzQBTJtDt', $this->user);
        if($api->authenticate()){
            $data = $api->getAllData();
            $this->assertEquals(count($data), 5589);
        }
    }

    /**
     *  Test to get data by format (y)
     *
     * @return void
     */
    public function testGetAllDataByFormatY()
    {
        $this->user = $this->user->find($this->app_id);
        $api = new \App\Services\Api('3RkTSJ', 'KjdTEANlw6YPxKIPORINgmMKzQBTJtDt', $this->user);
        if($api->authenticate()){
            $data = $api->getStationDataByFormat("y", "temperature");
            $result = $data['data'][0];
            $this->assertEquals($result->temperature, 37.329517749498);
            $this->assertEquals($result->date, "2015-03");
        }
    }

    /**
     *  Test to get data by format (m)
     *
     * @return void
     */
    public function testGetAllDataByFormatM()
    {
        $this->user = $this->user->find($this->app_id);
        $api = new \App\Services\Api('3RkTSJ', 'KjdTEANlw6YPxKIPORINgmMKzQBTJtDt', $this->user);
        if($api->authenticate()){
            $data = $api->getStationDataByFormat("m", "temperature");
            $result = $data['data'][0];
            $this->assertEquals($result->temperature, 27.21625);
            $this->assertEquals($result->date, "04-22");
        }
    }

    /**
     *  Test to get data by format (w)
     *
     * @return void
     */
    public function testGetAllDataByFormatW()
    {
        $this->user = $this->user->find($this->app_id);
        $api = new \App\Services\Api('3RkTSJ', 'KjdTEANlw6YPxKIPORINgmMKzQBTJtDt', $this->user);
        if($api->authenticate()){
            $data = $api->getStationDataByFormat("w", "temperature");
            $result = $data['success'];
            $this->assertEquals($result, true);
        }
    }

    /**
     *  Test to get data by format (h)
     *
     * @return void
     */
    public function testGetAllDataByFormatH()
    {
        $this->user = $this->user->find($this->app_id);
        $api = new \App\Services\Api('3RkTSJ', 'KjdTEANlw6YPxKIPORINgmMKzQBTJtDt', $this->user);
        if($api->authenticate()){
            $data = $api->getStationDataByFormat("h", "humidity");
            $result = $data['success'];
            $this->assertEquals($result, true);
        }
    }

    /**
     *  Test to get data by format (h) and wrong key
     *
     * @return void
     */
    public function testGetAllDataByFormatHWrongKey()
    {
        $this->user = $this->user->find($this->app_id);
        $api = new \App\Services\Api('3RkTSJ', 'KjdTEANlw6YPxKIPORINtmMKzQBTJtDt', $this->user);
        if($api->authenticate()){
            $data = $api->getStationDataByFormat("h", "humidity");
            $this->assertEquals($data['success'], false);
            $this->assertEquals($data['error'], 'Station not found');
        }
    }

    /**
     *  Test to get data by date with good data
     *
     * @return void
     */
    public function testGetChartByDateWithGoodData()
    {
        $this->user = $this->user->find($this->app_id);
        $api = new \App\Services\Api('3RkTSJ', 'KjdTEANlw6YPxKIPORINgmMKzQBTJtDt', $this->user);
        if($api->authenticate()){
            $data = $api->getChartByDate("temperature", "2015-04-01", "2015-05-01");
            $this->assertEquals($data['success'], true);
            $this->assertEquals($data['data'][0]->temperature, '27.739830508475');
            $this->assertEquals($data['data'][0]->date, '2015-04-01');
            $this->assertEquals($data['data'][6]->date, '2015-05-01');
            $this->assertEquals(count($data['data']), 7);
        }
    }

    /**
     *  Test to get data by date with wrong date
     *
     * @return void
     */
    public function testGetChartByDateWithWrongData()
    {
        $this->user = $this->user->find($this->app_id);
        $api = new \App\Services\Api('3RkTSJ', 'KjdTEANlw6YPxKIPORINgmMKzQBTJtDt', $this->user);
        if($api->authenticate()){
            $data = $api->getChartByDate("temperature", "2015/01/05", "2015-05-01");
            $this->assertFalse($data['success']);
            $this->assertEquals($data['error'], 'Get data must be: temperature, humidity, light_level, pressure, wind_direction, wind_speed, rain or all. Date format must be Y-m-d');
            $data = $api->getChartByDate("temperature", "2015-05-05", "2015-05-01");
            $this->assertFalse($data['success']);
            $this->assertEquals($data['error'], 'Start date must by less than end date');
        }
    }

    /**
     *  Test to get data by date with wrong key
     *
     * @return void
     */
    public function testGetChartByDateWithWrongKey()
    {
        $this->user = $this->user->find($this->app_id);
        $api = new \App\Services\Api('3RkTSJ', 'KjdTEANlw6YPxKIPdORINgmMKzQBTJtDt', $this->user);
        if($api->authenticate()){
            $data = $api->getChartByDate("temperature", "2015/01/05", "2015-05-01");
            $this->assertFalse($data['success']);
            $this->assertEquals($data['error'], 'Station not found');
        }
    }

    /**
     *  Test to get wind direction count
     *
     * @return void
     */
    public function testGetWindDirectionCount()
    {
        $this->user = $this->user->find($this->app_id);
        $api = new \App\Services\Api('3RkTSJ', 'KjdTEANlw6YPxKIPORINgmMKzQBTJtDt', $this->user);
        if($api->authenticate()){
            $data = $api->getWindDirectionCounts("y");
            $this->assertTrue($data['success']);
            $this->assertEquals($data['data']['Š'], 134);
            $this->assertEquals($data['data']['ŠR'], 512);
            $this->assertEquals($data['data']['R'], 479);
            $this->assertEquals($data['data']['PR'], 2575);
            $this->assertEquals($data['data']['P'], 448);
            $this->assertEquals($data['data']['PV'], 290);
            $this->assertEquals($data['data']['V'], 345);
            $this->assertEquals($data['data']['ŠV'], 799);
        }
    }

    /**
     *  Test to get wind direction count with wrong key
     *
     * @return void
     */
    public function testGetWindDirectionCountWrongKey()
    {
        $this->user = $this->user->find($this->app_id);
        $api = new \App\Services\Api('3RkTSJ', 'KjdTEANlw6YPxKIPORIdgmMKzQBTJtDt', $this->user);
        if($api->authenticate()){
            $data = $api->getWindDirectionCounts("y");
            $this->assertFalse($data['success']);
            $this->assertEquals($data['error'], 'Station not found');
        }
    }

    /**
     *  Test to get wind direction count by date with good data
     *
     * @return void
     */
    public function testGetWindDirectionCountByDate()
    {
        $this->user = $this->user->find($this->app_id);
        $api = new \App\Services\Api('3RkTSJ', 'KjdTEANlw6YPxKIPORINgmMKzQBTJtDt', $this->user);
        if($api->authenticate()){
            $data = $api->getWindDirectionCountsByDate("2015-04-01", "2015-05-01");
            $this->assertTrue($data['success']);
            $this->assertEquals($data['data']['Š'], 1);
            $this->assertEquals($data['data']['ŠR'], 291);
            $this->assertEquals($data['data']['R'], 312);
            $this->assertEquals($data['data']['PR'], 491);
            $this->assertEquals($data['data']['P'], 96);
            $this->assertEquals($data['data']['PV'], 151);
            $this->assertEquals($data['data']['V'], 177);
            $this->assertEquals($data['data']['ŠV'], 1);
        }
    }

    /**
     *  Test to get wind direction count by date with wrong data
     *
     * @return void
     */
    public function testGetWindDirectionCountByDateWrongData()
    {
        $this->user = $this->user->find($this->app_id);
        $api = new \App\Services\Api('3RkTSJ', 'KjdTEANlw6YPxKIPORINgmMKzQBTJtDt', $this->user);
        if($api->authenticate()){
            $data = $api->getWindDirectionCountsByDate("2015-06-01", "2015-05-01");
            $this->assertFalse($data['success']);
            $this->assertEquals($data['error'], 'Start date must by less than end date');
            $data = $api->getWindDirectionCountsByDate("2015/04/01", "2015/05/01");
            $this->assertFalse($data['success']);
            $this->assertEquals($data['error'], 'Date format must be Y-m-d.');
            $data = $api->getWindDirectionCountsByDate("", "2015/05/01");
            $this->assertFalse($data['success']);
            $this->assertEquals($data['error'], 'Date format must be Y-m-d.');
            $data = $api->getWindDirectionCountsByDate("2015-04-01", "");
            $this->assertFalse($data['success']);
            $this->assertEquals($data['error'], 'Date format must be Y-m-d.');
        }
    }

    /**
     *  Test to get wind direction count by date with wrong key
     *
     * @return void
     */
    public function testGetWindDirectionCountByDateWrongKey()
    {
        $this->user = $this->user->find($this->app_id);
        $api = new \App\Services\Api('3RkTSJ', 'KjdTEANlw6YPxKIPORINglMKzQBTJtDt', $this->user);
        if($api->authenticate()){
            $data = $api->getWindDirectionCountsByDate("2015-06-01", "2015-05-01");
            $this->assertFalse($data['success']);
            $this->assertEquals($data['error'], 'Station not found');
        }
    }

    /**
     *  Test to get last station data
     *
     * @return void
     */
    public function testGetLastStationData()
    {
        $this->user = $this->user->find($this->app_id);
        $api = new \App\Services\Api('3RkTSJ', 'KjdTEANlw6YPxKIPORINgmMKzQBTJtDt', $this->user);
        if($api->authenticate()){
            $data = $api->getLastInformation();
            $last = $data['information'];
            $this->assertTrue($data['success']);
            $this->assertEquals($last->temperature, 10.58);
            $this->assertEquals($last->humidity, 21.58);
            $this->assertEquals($last->light_level, 0.8);
            $this->assertEquals($last->pressure, 1235.5);
            $this->assertEquals($last->wind_direction, "PR");
            $this->assertEquals($last->wind_speed, 8.5);
            $this->assertEquals($last->rain, 0);
        }
    }

    /**
     *  Test to generate key
     *
     * @return void
     */
    public function testGenerateKey()
    {
        $this->user = $this->user->find($this->app_id);
        $api = new \App\Services\Api('3RkTSJ', 'KjdTEANlw6YPxKIPORINgmMKzQBTJtDt', $this->user);
        if($api->authenticate()){
            $data = $api->regenerateKey(18);
            $this->assertEquals(strlen($data), 18);
        }
    }

    /**
     *  Test to get direction name
     *
     * @return void
     */
    public function testGetDirectionName()
    {
        $this->user = $this->user->find($this->app_id);
        $api = new \App\Services\Api('3RkTSJ', 'KjdTEANlw6YPxKIPORINgmMKzQBTJtDt', $this->user);
        if($api->authenticate()){
            $result = $api->getWindDirectionName(10);
            $this->assertEquals($result, "Š");
            $result = $api->getWindDirectionName(50);
            $this->assertEquals($result, "ŠR");
            $result = $api->getWindDirectionName(90);
            $this->assertEquals($result, "R");
            $result = $api->getWindDirectionName(120);
            $this->assertEquals($result, "PR");
            $result = $api->getWindDirectionName(190);
            $this->assertEquals($result, "P");
            $result = $api->getWindDirectionName(220);
            $this->assertEquals($result, "PV");
            $result = $api->getWindDirectionName(250);
            $this->assertEquals($result, "V");
            $result = $api->getWindDirectionName(320);
            $this->assertEquals($result, "ŠV");
        }
    }

    /**
     *  Test wind direction grouping
     *
     * @return void
     */
    public function testWindDirectionGrouping()
    {
        $this->user = $this->user->find($this->app_id);
        $api = new \App\Services\Api('3RkTSJ', 'KjdTEANlw6YPxKIPORINgmMKzQBTJtDt', $this->user);
        if($api->authenticate()){
            $data = [
                        ['c_direction' => 12, 'wind_direction' => 'P'],
                        ['c_direction' => 2, 'wind_direction' => 'PR'],
                        ['c_direction' => 3, 'wind_direction' => 'P'],
                        ['c_direction' => 1, 'wind_direction' => 'PR'],
                    ];

            $result = $api->getDirectionsGroupedArray($data);
            $this->assertEquals($result['P'], 15);
            $this->assertEquals($result['PR'], 3);
        }
    }
}