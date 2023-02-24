<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChambreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'numero_porte'=>$this->method()=='POST' ?
            ['required','min:2','max:20','unique:chambres,numero_porte']:
            ['required','min:2', 'max:20', Rule::unique('chambres','numero_porte')->ignore($this->chambre)],
            'category'=>'sometimes','nullable','exists:categories,id',
            'disponibilite'=> 'sometimes','nullable','exists:disponibilites,id',
        ];
    }
}
