<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class MaterialRequest extends FormRequest
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
    public function rules(Request $request)
    { 
        // dd(request()->method());
                return [
                    'name'=>'required|string|max:255',
                    'type'=>'required',
                    'term'=>'required',
                    'stage_id'=>'required|exists:stages,id',
                    'subject_id'=>'required|exists:subjects,id',
                    'files'=>request()->method()=='POST' ?'required':'nullable',
                ];
            
    }

    
    public function attributes()
    {  
         return [
            'stage_id'=>"stage",
        ];
    }
    




}
