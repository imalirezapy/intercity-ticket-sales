<?php

namespace App\Services\Ticket\Http\Controllers\V1;

use App\Domains\Ticket\Requests\FetchArrivalCitiesRequest;
use App\Domains\Ticket\Requests\FetchPlansRequest;
use App\Domains\Ticket\Requests\FetchTerminalsRequest;
use App\Services\Ticket\Features\FetchPlansFeature;
use App\Services\Ticket\Features\GetArrivalCitiesFeature;
use App\Services\Ticket\Features\GetDepartureCitiesFeature;
use App\Services\Ticket\Features\GetTerminalsFeature;
use Illuminate\Http\Response;
use Lucid\Units\Controller;
use OpenApi\Annotations as OA;

class PlanController extends Controller
{
    public function __construct(
        private readonly GetDepartureCitiesFeature $getDepartureCitiesFeature,
        private readonly GetArrivalCitiesFeature $getArrivalCitiesFeature,
        private readonly GetTerminalsFeature $getTerminalsFeature,
        private readonly FetchPlansFeature $fetchPlansFeature,
    )
    {
    }


    /**
     * @OA\Get(
     *     path="/api/v1/plans/departure-cities",
     *     tags={"Fetch data"},
     *     summary="Fetch departure cities list",
     *     @OA\Response(response=200, description="successful fetch cities", @OA\JsonContent()),
     * )
     * @OA\Post(
     *      path="/api/v1/plans/departure-cities",
     *      tags={"Fetch data"},
     *      summary="Fetch departure cities list",
     *      @OA\Response(response=200, description="successful fetch cities", @OA\JsonContent()),
     * )
     */
    public function getDepartureCities(): Response
    {
        return $this->getDepartureCitiesFeature->handle();
    }


    /**
     * @OA\Get(
     *     path="/api/v1/plans/arrival-cities",
     *     tags={"Fetch data"},
     *     summary="Fetch arrival cities list ",
     *     @OA\Parameter(
     *         required=true,
     *         name="city_code",
     *         in="query",
     *         description="a valid arrival city code",
     *         example="shiraz"
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="successful fetch cities",
     *          @OA\JsonContent()
     *      ),
     *     @OA\Response(
     *          response=422,
     *          description="Unprocessable - Invalid city code",
     *          @OA\JsonContent()
     *      )
     * )
     * @OA\Post(
     *      path="/api/v1/plans/arrival-cities",
     *      tags={"Fetch data"},
     *      summary="Fetch arrival cities list ",
     *      @OA\RequestBody(
     *          required=true,
     *
     *          @OA\JsonContent(
     *              @OA\Property(property="city_code", type="string", example="shiraz")
     *          )
     *
     *      ),
     *      @OA\Response(
     *                response=200,
     *                description="successful fetch cities",
     *                @OA\JsonContent()
     *            ),
     *      @OA\Response(
     *                response=422,
     *                description="Unprocessable - Invalid city code",
     *                @OA\JsonContent()
     *            )
     * )
     */
    public function getArrivalCities(FetchArrivalCitiesRequest $request): Response
    {
        return $this->getArrivalCitiesFeature->handle($request);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/plans/terminals",
     *     tags={"Fetch data"},
     *     summary="Fetch terminals list ",
     *     @OA\Parameter(
     *         required=true,
     *         name="city_code",
     *         in="query",
     *         description="a valid arrival/departure city code",
     *         example="shiraz"
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="successful fetch cities",
     *          @OA\JsonContent()
     *      ),
     *     @OA\Response(
     *          response=422,
     *          description="Unprocessable - Invalid city code",
     *          @OA\JsonContent()
     *      )
     * )
     * @OA\Post(
     *      path="/api/v1/plans/terminals",
     *      tags={"Fetch data"},
     *      summary="Fetch terminals by arrival/departure city code list ",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              @OA\Property(property="city_code", type="string", example="shiraz")
     *          )
     *      ),
     *      @OA\Response(
     *                response=200,
     *                description="successful fetch terminals",
     *                @OA\JsonContent()
     *            ),
     *      @OA\Response(
     *                response=422,
     *                description="Unprocessable - Invalid city code",
     *                @OA\JsonContent()
     *            )
     * )
     */
    public function getTerminals(FetchTerminalsRequest $request): Response
    {
        return $this->getTerminalsFeature->handle($request);
    }

    public function search(FetchPlansRequest $request): Response
    {
        return $this->fetchPlansFeature->handle($request);
    }
}
