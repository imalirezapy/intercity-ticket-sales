<?php


use App\Composables\Responses\Features\ThrowsNotFound;
use App\Domains\Ticket\Jobs\GetPlanByUlidJob;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PlanExists
{
    use ThrowsNotFound;

    public function __construct(
        private readonly GetPlanByUlidJob $getPlanByUlidJob,
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
        if (! $this->getPlanByUlidJob->handle($request->route('planId'))){
            $this->notFound();
        }
        return $next($request);
    }
}
