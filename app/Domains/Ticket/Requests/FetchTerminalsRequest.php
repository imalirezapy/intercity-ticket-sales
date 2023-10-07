<?php

namespace App\Domains\Ticket\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FetchTerminalsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     */
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'city_code' => [
                'required',
                'string',
//                'max:5', # TODO: uncomment in production (PlanSeeder inserted greater than 5)
            ]
        ];
    }

    public function getCityCode(): ?string
    {
        return $this->validated('city_code');
    }
}
