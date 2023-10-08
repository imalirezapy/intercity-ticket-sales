<?php
namespace App\Services\Ticket\Http\Middleware;

use App\Composables\Responses\Features\ThrowsNotFound;
use App\Domains\Ticket\Jobs\GetPlanByIdJob;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PlanExists
{
    use ThrowsNotFound;

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
        if (! $this->getPlanByIdJob->handle($request->route('planId'))){
            $this->notFound();
        }

        return $next($request);
    }
}
