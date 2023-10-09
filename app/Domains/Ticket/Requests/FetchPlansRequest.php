<?php

namespace App\Domains\Ticket\Requests;

use App\Composables\Requests\HasPagination;
use Illuminate\Foundation\Http\FormRequest;

class FetchPlansRequest extends FormRequest
{
    use HasPagination;

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
            'departure_place' => 'required|string',
            'arrival_place' => 'required|string',
            'datetime' => 'numeric|min:1',
            'perPage' => 'numeric|min:1',
        ];
    }
}
