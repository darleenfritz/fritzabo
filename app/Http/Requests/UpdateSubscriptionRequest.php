<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubscriptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'contact' => 'required',
            'price' => 'required|numeric',
            'subscribed_at' => 'nullable|date',
            'subscription_end' => 'nullable|date|after_or_equal:subscribed_at',
            'mediatype_id' => 'nullable|exists:mediatypes,id',
            'billingcycle_id'=> 'nullable|exists:billingcycles,id',
        ];
    }
}
