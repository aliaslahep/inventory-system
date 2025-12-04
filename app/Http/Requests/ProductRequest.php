<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
       return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
                
        $productId = $this->route('product')->id ?? null;

        return [
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products,sku,' . $productId, 
            'price' => 'required|numeric|min:0.01', 
            'quantity' => 'required|integer|min:0', 
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive', 
            'category_ids' => 'nullable|array',
            'category_ids.*' => 'exists:categories,id',
        ];
    }
}
