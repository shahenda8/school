<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class SubjectRequest extends FormRequest
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
                    'description'=>'required|string|max:500',
                    'stage_id'=>'required|exists:stages,id',
                    'image'=>request()->method()=='POST' ?'required|image|mimes:png,jpg,jpeg,svg':'nullable|image|mimes:png,jpg,jpeg,svg'
                ];
            
    }

    
    public function attributes()
    {  
         return [
            'stage_id'=>"stage",
        ];
    }
    




}
