<?php
namespace App\Services\Ticket\Http\Middleware;

use App\Composables\Responses\Features\ThrowsFailure;
use App\Composables\Responses\Features\ThrowsNotFound;
use App\Domains\Ticket\Jobs\GetPlanByIdJob;
use App\Enums\ResponseMessageKeys;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CanBookPlan
{
    use ThrowsFailure;

    public function __construct(
        private readonly GetPlanByIdJob $getPlanByIdJob,
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
        $plan = $this->getPlanByIdJob->handle($request->route('planId'));
        if ($plan->remain_capacity <= 0){
            $this->failedResponse(
                ResponseMessageKeys::CAPACITY_IS_FULL->value,
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        return $next($request);
    }
}
