<?php

namespace Tests\Feature\Services\Ticket;

use App\Data\Models\Plan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;
use Tests\ResponseStructure;
use Tests\TestCase;
use App\Services\Ticket\Features\BookPlanFeature;
use Tests\WithUser;

class BookPlanFeatureTest extends TestCase
{
    use RefreshDatabase,
        WithUser,
        ResponseStructure;

    private array $bookingStructure = [
        'data' => [
            'id',
            'plan_id',
            'count',
            'seats_numbers',
            'expires_at',
            'created_at',
        ]
    ];

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUser();
    }


    public function endpoint($planId): string
    {
        return "api/v1/plans/{$planId}/book";
    }

    public function testResponseUnauthenticatedIfUserNotAuthorized()
    {
        $response = $this->postJson($this->endpoint(12345));

        $response->assertUnauthorized()
            ->assertJsonStructure($this->responseStructure)
            ->assertJson([
                'status_code' => Response::HTTP_UNAUTHORIZED,
                'is_successful' => false,
            ]);
    }

    public function testResponseNotFoundErrorIfPlanNotExists()
    {
        $response = $this->actingAs($this->user)
            ->postJson($this->endpoint(12345));

        $response->assertNotFound()
            ->assertJson([
                'status_code' => Response::HTTP_NOT_FOUND,
                'is_successful' => false,
            ]);
    }

    public function testCanNotBookPlanThatReachedMaxCapacity()
    {
        $plan = $this->createPlan(5, range(1, 5));

        $response = $this->actingAs($this->user)
            ->postJson($this->endpoint($plan->id), [
                'passengers_count' => 1,
                "seats_numbers" => [3]
            ]);

        $response->assertUnprocessable()
            ->assertJsonStructure([
                "errors" =>  [ "seats_numbers" ]
            ]);

    }

    public function testResponseUnprocessableIfSeatsReservedAlready()
    {
        $plan = $this->createPlan(3, range(1, 3));

        $response = $this->actingAs($this->user)
            ->postJson($this->endpoint($plan->id), [
                'passengers_count' => 1,
                "seats_numbers" => [ 3 ]
            ]);

        $response->assertUnprocessable()
            ->assertJsonStructure([
                "errors" =>  [ "seats_numbers" ]
            ]);

    }

    public function testSuccessfulBookTicket()
    {
        $plan = $this->createPlan();

        $response = $this->actingAs($this->user)
            ->postJson($this->endpoint($plan->id), [
                'passengers_count' => 1,
                "seats_numbers" => [3]
            ]);

        $response->assertOk()
            ->assertJsonStructure($this->responseStructure)
            ->assertJsonStructure($this->bookingStructure)
            ->assertJson([
                'is_successful' => true,
                'data' => [
                    'plan_id' => $plan->id,
                    'count' => 1,
                    'seats_numbers' => [3],
                ]
            ]);
        $this->assertTrue(
            $response->original['data']
                ->expires_at
                ->gt($response->original['data']->created_at)
        );
    }

    private function createPlan($count = 2, $seatsNumbers = [1, 2]): Plan
    {
        $plan = Plan::factory()->createOne([
            'total_capacity' => 5,
        ]);
        $plan->bookings()->create([
            'user_id' => $this->user->id,
            'count' => $count,
            'seats_numbers' => $seatsNumbers,
        ]);

        return $plan;
    }
}
