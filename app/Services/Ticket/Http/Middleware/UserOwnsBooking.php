<?php
namespace App\Services\Ticket\Http\Middleware;

use App\Composables\Responses\Features\ThrowsNotFound;
use App\Domains\Ticket\Jobs\GetBookingByIdJob;
use App\Domains\Ticket\Jobs\GetPlanByIdJob;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserOwnsBooking
{
    use ThrowsNotFound;

    public function __construct(
        private readonly GetBookingByIdJob $getBookingByIdJob,
    )
    {
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $booking = $this->getBookingByIdJob->handle($request->route('bookingId'));

        if ($booking->user_id != $request->user()->id){
            $this->notFound();
        }

        return $next($request);
    }
}
