<?php

namespace Tests\Feature\Services\Ticket;

use App\Composables\Database\Migrations\CallSeeder;
use App\Enums\TablesEnum;
use Database\Seeders\PlanSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\ResponseStructure;
use Tests\TestCase;

class GetDepartureCitiesFeatureTest extends TestCase
{
    use RefreshDatabase,
        ResponseStructure,
        CallSeeder;

    private string $cityCode;
    private string $endpoint = 'api/v1/plans/departure-cities';
    private array $departureCitiesStructure = [
        'data' => [
            "*" => [
                'departure_city',
            ]
        ]
    ];

    protected function setUp(): void
    {
        parent::setUp();
        $this->callSeeder(PlanSeeder::class);
    }



    public function testSuccessfulFetchDepartureCities()
    {
        $response = $this->getJson($this->endpoint);

        $response->assertOk()
            ->assertJsonStructure($this->responseStructure)
            ->assertJsonStructure($this->departureCitiesStructure);

        foreach ($response->json('data') as $city) {
            $this->assertDatabaseHas(TablesEnum::PLANS->value, $city);
        }
    }

    public function testDepartureCitiesEndpointSupportPostMethod()
    {
        $response = $this->postJson($this->endpoint);

        $response->assertOk()
            ->assertJsonStructure($this->responseStructure)
            ->assertJsonStructure($this->departureCitiesStructure);
    }
}
