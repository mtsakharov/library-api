<?php
declare(strict_types=1);

namespace App\Http\Requests\Auth;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|max:255',
            'password' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
        ];
    }

    /**
     * Always return JSON.
     * @param array $errors
     * @return JsonResponse
     */
    public function response(array $errors): JsonResponse
    {
        return response()->json($errors, 422);
    }
}
