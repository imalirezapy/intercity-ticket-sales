<?php

namespace Tests\Feature\Services\Ticket;

use App\Data\Models\Booking;
use App\Data\Models\Plan;
use App\Data\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\ResponseStructure;
use Tests\TestCase;
use Tests\WithUser;

class DeleteBookingFeatureTest extends TestCase
{
    use RefreshDatabase,
        WithUser,
        ResponseStructure;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUser();
    }


    public function endpoint($bookingId): string
    {
        return "api/v1/bookings/{$bookingId}";
    }

    public function testResponseUnauthenticatedIfUserNotAuthorized()
    {
        $response = $this->deleteJson($this->endpoint(12345));

        $response->assertUnauthorized()
            ->assertJsonStructure($this->responseStructure)
            ->assertJson([
                'status_code' => Response::HTTP_UNAUTHORIZED,
                'is_successful' => false,
            ]);
    }

    public function testResponseNotFoundErrorIfBookingNotExists()
    {
        $response = $this->actingAs($this->user)
            ->deleteJson($this->endpoint(12345));

        $response->assertNotFound()
            ->assertJson([
                'status_code' => Response::HTTP_NOT_FOUND,
                'is_successful' => false,
            ]);
    }

    public function testResponseNotFoundErrorIfBookingBelongsToAnotherUser()
    {
        $plan = $this->createPlan();
        $booking = $plan->bookings->first();
        $newUser = User::factory()->createOne();

        $response = $this->actingAs($newUser)
            ->deleteJson($this->endpoint($booking->id));


        $response->assertNotFound()
            ->assertJson([
                'status_code' => Response::HTTP_NOT_FOUND,
                'is_successful' => false,
            ]);
    }

    public function testSuccessfulDeleteBookedTicket()
    {
        $plan = $this->createPlan();
        $booking = $plan->bookings->first();

        $response = $this->actingAs($this->user)
            ->deleteJson($this->endpoint($booking->id));

        $response->assertOk()
            ->assertJson([
                'is_successful' => true,
            ]);
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

        $plan->load('bookings');
        return $plan;
    }
}
