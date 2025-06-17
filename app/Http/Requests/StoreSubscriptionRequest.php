<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubscriptionRequest extends FormRequest

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
            //
            'name' => 'required',
            'contact'=>'required',
            'mediatype_id' => ['nullable', 'exists:mediatypes,id'],
            'price' => 'required|decimal:0,2',
            'subscribed_at' => 'date',
            'subscription_end' => 'nullable|date',
            'billingcycle_id' => ['nullable', 'exists:billingcycles,id'],
        ];
    }
}
