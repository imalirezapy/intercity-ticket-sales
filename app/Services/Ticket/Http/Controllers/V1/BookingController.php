<?php
namespace App\Services\Ticket\Http\Controllers\V1;

use App\Domains\Ticket\Requests\BookPlanRequest;
use App\Services\Ticket\Features\BookPlanFeature;
use App\Services\Ticket\Features\DeleteBookingFeature;
use Illuminate\Http\Response;
use Lucid\Units\Controller;
use OpenApi\Annotations as OA;
class BookingController extends Controller
{
    public function __construct(
        private readonly BookPlanFeature $bookPlanFeature,
        private readonly DeleteBookingFeature $deleteBookingFeature,
    )
    {
    }

    /**
     * @OA\Post(
     *       path="/api/v1/plans/{planId}/book",
     *       tags={"Ticket"},
     *       summary="Reserve a ticket",
     *       security={"sanctum": {}},
     *       @OA\Parameter(
     *           required=true,
     *           in="path",
     *           name="planId",
     *           example="1",
     *       ),
     *       @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *             @OA\Property(property="passengers_count", type="number", example="1"),
     *             @OA\Property(property="seats_numbers", type="array", @OA\Items(type="number", example="10"), description="The count of seats must be equal to passengers_count"),
     *          )
     *       ),
     *
     *       @OA\Response(
     *           response=200,
     *           description="successful fetch terminals",
     *           @OA\JsonContent(),
     *       ),
     *       @OA\Response(
     *           response=422,
     *           description="Unprocessable - Invalid passengers_count or seats_numbers",
     *           @OA\JsonContent(),
     *        ),
     *       @OA\Response(
     *           response=401,
     *           description="Unauthenticated",
     *           @OA\JsonContent()
     *       ),
     *       @OA\Response(
     *           response=404,
     *           description="Not found error - invalid planId",
     *           @OA\JsonContent()
     *       )
     *  )
     */
    public function store(BookPlanRequest $request): Response
    {
        return $this->bookPlanFeature->handle($request);
    }

    /**
     * @OA\Delete(
     *       path="/api/v1/bookings/{bookingId}",
     *       tags={"Ticket"},
     *       summary="Cancel (delete) Reserved ticket",
     *       security={"sanctum": {}},
     *       @OA\Parameter(
     *           required=true,
     *           in="path",
     *           name="bookingId",
     *           example="1",
     *       ),
     *
     *       @OA\Response(
     *           response=200,
     *           description="successful fetch terminals",
     *           @OA\JsonContent(),
     *       ),
     *       @OA\Response(
     *           response=404,
     *           description="Not found error - invalid bookingId",
     *           @OA\JsonContent()
     *       )
     *  )
     */
    public function delete(int $bookingId): Response
    {
        return $this->deleteBookingFeature->handle($bookingId);
    }
}
