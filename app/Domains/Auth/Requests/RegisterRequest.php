<?php

namespace App\Domains\Auth\Requests;

use App\Data\DTO\UserDTO;
use App\Enums\TablesEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(TablesEnum::USERS->value, 'email'),
            ],
            'password' => [
                'required',
                'string',
                'min:6',
            ],
        ];
    }

    public function getEmail(): ?string
    {
        return $this->validated('email');
    }

    public function getPass(): ?string
    {
        return $this->validated('password');
    }

    public function getUserDTO(): UserDTO
    {
        return new UserDTO([
            'email' => $this->getEmail(),
            'password' => $this->getPass(),
        ]);
    }
}
