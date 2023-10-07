<?php

namespace App\Domains\Auth\Requests;

use App\Data\DTO\UserDTO;
use App\Enums\TablesEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LoginRequest extends FormRequest
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
            'first_name' => ['string', 'max:255'],
            'last_name' => ['string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::exists(TablesEnum::USERS->value, 'email'),
            ],
            'password' => [
                'required',
                'string',
                'min:6',
            ],
        ];
    }

    public function getFirstName(): ?string
    {
        return $this->validated('first_name');
    }

    public function getLastName(): ?string
    {
        return $this->validated('last_name');
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
            'first_name' => $this->getFirstName(),
            'last_name' => $this->getLastName(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
        ]);
    }
}
