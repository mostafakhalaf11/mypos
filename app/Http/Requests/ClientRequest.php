<?php

namespace App\Http\Requests;

use App\Rules\UniquePhonesForClient;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:255',
            'phone' => 'required|array|min:1',
            'phone.*' =>['required','string','regex:/(^[0]{1}[1]{1}[0,1,2,5]{1}[0-9]{8}$)/','distinct',new UniquePhonesForClient($this->route('client'))],
            'address' => 'required|string|max:255',
        ];
    }
}
