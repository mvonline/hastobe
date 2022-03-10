<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class apiTest extends TestCase
{
    /**
     * @return void
     * @throws \Throwable
     */
    public function test_api()
    {
        $payload = [];
        $payload['rate']['energy']=0.3;
        $payload['rate']['transaction']=1;
        $payload['rate']['time']=2;
        $payload['cdr']['meterStart']=1204307;
        $payload['cdr']['timestampStart']="2021-04-05T10:04:00Z";
        $payload['cdr']['meterStop']=1215230;
        $payload['cdr']['timestampStop']="2021-04-05T11:27:00Z";
        $response = $this->post('/api/rate',$payload);
        $result = $response->decodeResponseJson();
        $response->assertStatus(200);
        $this->assertEquals(7.04, $result["overall"]);
        $this->assertEquals(3.277, $result["components"]["energy"]);
        $this->assertEquals(2.767, $result["components"]["time"]);
        $this->assertEquals(1, $result["components"]["transaction"]);
    }

    /**
     * @return void
     * @throws \Throwable
     */
    public function test_validation()
    {
        $payload = [];
        $payload['rate']['energy']=0.3;
        $payload['rate']['transaction']=1;
        $payload['rate']['time']=2;
        $payload['cdr']['meterStart']=1204307;
        $payload['cdr']['timestampStart']="2021-04-05T10:04:00Z";
        $payload['cdr']['meterStop']=1215230;
        $response = $this->post('/api/rate',$payload);
        $response->assertStatus(302);
    }
}
