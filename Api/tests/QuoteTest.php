<?php

class QuoteTest extends TestCase
{
    public function testShoutingValid()
    {
        $response = $this->call('GET', 'api/v1/shout/'.'steve-jobs', ['limit' => 2]);

        $this->assertEquals(200, $response->status());
    }

    public function testInvalidLimit()
    {
        $zeroLimit = $this->call('GET', 'api/v1/shout/'.'steve-jobs', ['limit' => 0]);
        $exceedLimit = $this->call('GET', 'api/v1/shout/'.'steve-jobs', ['limit' => 11]);
        $emptyLimit = $this->call('GET', 'api/v1/shout/'.'steve-jobs', ['limit' => '']);
        $nonIntLimit = $this->call('GET', 'api/v1/shout/'.'steve-jobs', ['limit' => 'abc']);

        $this->assertEquals(422, $zeroLimit->status());
        $this->assertEquals(422, $exceedLimit->status());
        $this->assertEquals(422, $emptyLimit->status());
        $this->assertEquals(422, $nonIntLimit->status());
    }

    public function testValidResult()
    {
        $response = $this->json('GET', 'api/v1/shout/'.'steve-jobs', ['limit' => 2]);
        $response->seeJson();
    }
}
