<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $cardId = $this->input('id');
        if ($cardId == 0 || Auth::user()->role == 'admin') return true;
        return $this->user()->cards()->where('id', $cardId)->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => '',
            'user_id' => '',
            'profile_picture' => 'sometimes|string',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'id_code' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'blood_type' => 'required|string|max:3',
            // 'profile_picture_file' => 'sometimes|image|mimes:png,jpg,jpeg|max:4048'
            'profile_picture_file' => 'sometimes|image|mimes:png,jpg,jpeg'
        ];
    }
}
