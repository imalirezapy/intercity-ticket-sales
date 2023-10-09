<?php

namespace Tests\Feature\Services\Ticket;

use App\Composables\Database\Migrations\CallSeeder;
use App\Data\Models\Plan;
use Database\Seeders\PlanSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\ResponseStructure;
use Tests\TestCase;

class GetArrivalCitiesFeatureTest extends TestCase
{
    use RefreshDatabase,
        ResponseStructure,
        CallSeeder;

    private string $cityCode;
    private string $endpoint = 'api/v1/plans/arrival-cities';
    private array $arrivalCitiesStructure = [
        'data' => [
            "*" => [
                'departure_city',
                'arrival_city',
            ]
        ]
    ];

    protected function setUp(): void
    {
        parent::setUp();
        $this->callSeeder(PlanSeeder::class);
        $this->setUpCityCode();
    }



    public function testSuccessfulFetchArrivalCities()
    {
        $response = $this->call(
            method: 'GET',
            uri: $this->endpoint,
            parameters: [ 'city_code' => $this->cityCode, ]
        );

        $response->assertOk()
            ->assertJsonStructure($this->responseStructure)
            ->assertJsonStructure($this->arrivalCitiesStructure);

        foreach ($response->original['data'] as $cities) {
            $this->assertEquals($this->cityCode, $cities['departure_city']);
        }
    }

    public function testArrivalCitiesEndpointSupportPostMethod()
    {
        $response = $this->postJson(
            uri: $this->endpoint,
            data: [ 'city_code' => $this->cityCode ]
        );

        $response->assertOk()
            ->assertJsonStructure($this->responseStructure)
            ->assertJsonStructure($this->arrivalCitiesStructure);
    }

    public function testResponseUnprocessableIfCityCodeNotExists()
    {
        $response = $this->postJson(
            uri: $this->endpoint,
            data: [ 'city_code' => 'this-city-does-not-exists', ]
        );

        $response->assertUnprocessable()
            ->assertJsonStructure([
                'errors' => [
                    'city_code',
                ]
            ]);

    }

    private function setUpCityCode(): void
    {
        $this->cityCode = Plan::first()->departure_city;
    }
}
