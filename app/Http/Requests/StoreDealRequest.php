<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDealRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // return false;
        return true; // Allow all users to create deals (adjust as needed)
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'original_price' => 'required|numeric|min:0',
            'discounted_price' => 'required|numeric|min:0',
            'type' => 'required|string|in:free,paid',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'max_usage_limit' => 'required|integer|min:1',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
        ];
    }
    // 'end_date' => 'required|date|after_or_equal:start_date',
    // 'category_id' => 'required|integer|exists:categories,id',
}
