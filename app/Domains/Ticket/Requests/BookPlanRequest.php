<?php

namespace App\Domains\Ticket\Requests;

use App\Data\DTO\BookingDTO;
use App\Domains\Ticket\Jobs\GetPlanByIdJob;
use App\Rules\PassengersSeatNumbersRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class BookPlanRequest extends FormRequest
{
    private GetPlanByIdJob $getPlanByIdJob;

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     */
    public function rules(): array
    {
        $this->setUp();

        $remainCount = $this->getPlanByIdJob->handle($this->route('planId'))->remain_capacity;

        return [
            'passengers_count' => [
                'required',
                'numeric',
                "between:1,". $remainCount
            ],
            'seats_numbers' => [
                'bail',
                'required',
                'array',
                new PassengersSeatNumbersRule()
            ],
        ];
    }

    public function withValidator($validator)
    {
        $seatsLength = $this->passengers_count;

        if (!$validator->fails()) {
            $v = Validator::make($validator->validated(), [
                'seats_numbers'=> "array|size:{$seatsLength}"

            ]);
            $v->validate();
        }
    }

    private function setUp(): void
    {
        $this->getPlanByIdJob = resolve(GetPlanByIdJob::class);
    }

    public function getPassengersCount(): ?int
    {
        return $this->validated('passengers_count');
    }

    public function getSeatsNumbers(): ?array
    {
        return $this->validated('seats_numbers');
    }

    private function getPlanId(): ?int
    {
        return $this->route('planId');
    }


    public function getBookingDTO(): ?BookingDTO
    {
        return new BookingDTO(
            user_id: auth()->id(),
            plan_id: $this->getPlanId(),
            count: $this->getPassengersCount(),
            seats_numbers: $this->getSeatsNumbers(),
        );
    }
}
