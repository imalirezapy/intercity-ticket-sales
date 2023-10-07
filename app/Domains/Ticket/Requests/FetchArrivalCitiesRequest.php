<?php

namespace App\Domains\Ticket\Requests;

use App\Enums\TablesEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FetchArrivalCitiesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     */
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
        return [
            'city_code' => [
                'required',
                'string',
//                'max:5', # TODO: uncomment in production (PlanSeeder inserted greater than 5)
                Rule::exists(TablesEnum::PLANS->value, 'departure_city'),
            ]
        ];
    }

    public function getCityCode(): ?string
    {
        return $this->validated('city_code');
    }
}
