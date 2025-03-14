<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
// use Illuminate\Support\Facades\Hash;
use App\Models\Deal;

class UpdateDealRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // return false;
        return true; // Allow all users to update deals (adjust as needed)
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $deal = $this->route('deal');
        $currentUsageCount = $deal->current_usage_count;

        return [
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'original_price' => [
                'sometimes',
                'numeric',
                'min:0',
                Rule::requiredIf($this->input('type') === 'paid')
            ],
            'discounted_price' => [
                'sometimes',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) {
                    if ($this->input('type') === 'paid' && $value >= $this->input('original_price')) {
                        $fail('Discounted price must be lower than original price for paid deals');
                    }
                }
            ],
            'type' => 'sometimes|string|in:free,paid',
            'start_date' => 'sometimes|date',
            'end_date' => 'sometimes|date|after_or_equal:start_date',
            'max_usage_limit' => [
                'sometimes',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) use ($currentUsageCount) {
                    if ($value < $currentUsageCount) {
                        $fail('Usage limit cannot be less than current usage count');
                    }
                }
            ],
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'sometimes|boolean',
            'is_featured' => 'sometimes|boolean',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->input('type') === 'free') {
                $validator->sometimes('original_price', '0', function ($input) {
                    return $input->type === 'free';
                });

                $validator->sometimes('discounted_price', '0', function ($input) {
                    return $input->type === 'free';
                });
            }
        });
    }

    public function messages()
    {
        return [
            'end_date.after_or_equal' => 'End date must be after or equal to start date',
        ];
    }
}
