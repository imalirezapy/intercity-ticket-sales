<?php

namespace Tests\Feature\Services\Ticket;

use App\Composables\Database\Migrations\CallSeeder;
use App\Data\Models\Plan;
use Database\Seeders\PlanSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\ResponseStructure;
use Tests\TestCase;

class GetTerminalsFeatureTest extends TestCase
{
    use RefreshDatabase,
        ResponseStructure,
        CallSeeder;

    private string $cityCode;
    private string $endpoint = 'api/v1/plans/terminals';
    private array $arrivalCitiesStructure = [
        'data' => [
            "*" => [
                'terminal',
            ]
        ]
    ];

    protected function setUp(): void
    {
        parent::setUp();
        $this->callSeeder(PlanSeeder::class);
        $this->setUpCityCode();
    }

    public function testSuccessfulFetchTerminals()
    {
        $response = $this->call(
            method: 'GET',
            uri: $this->endpoint,
            parameters: [ 'city_code' => $this->cityCode, ]
        );

        $response->assertOk()
            ->assertJsonStructure($this->responseStructure)
            ->assertJsonStructure($this->arrivalCitiesStructure);

        foreach ($response->json('data') as $terminal) {
            $this->assertTrue(str($terminal['terminal'])->startsWith($this->cityCode));
        }
    }

    public function testTerminalsEndpointSupportPostMethod()
    {
        $response = $this->postJson(
            uri: $this->endpoint,
            data: [ 'city_code' => $this->cityCode ]
        );

        $response->assertOk()
            ->assertJsonStructure($this->responseStructure)
            ->assertJsonStructure($this->arrivalCitiesStructure);
    }


    private function setUpCityCode(): void
    {
        $this->cityCode = Plan::first()->departure_city;
    }
}
