<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'category_id' => 'required|exists:categories,id',
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules += [$locale . '.name' => 'required|string|max:255,ignore:'.$this->product->id];
            $rules += [$locale . '.description' => 'required|string'];
        }
        $rules += [
            // 'image' => 'sometimes|image',
            'purchase_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'stock' => 'required|numeric',
        ];

        return $rules;
    }
}
