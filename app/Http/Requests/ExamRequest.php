<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class ExamRequest extends FormRequest
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
                    'questions.*'=>'required|exists:questions,id',
                    'subject_id'=>'required|exists:subjects,id',
                    'stage_id'=>'required|exists:stages,id',
                    'class_model_id'=>'required|exists:class_models,id',
                    'type'=>'required',
                    'term'=>'required',
                    'start_time'=>'required',
                    'end_time'=>'required',
                ];
            
    }

    
    public function attributes()
    {  
         return [
            'stage_id'=>"stage",
            'subject_id'=>"subject",
            'class_model_id'=>"class model",
            'ques_content'=>'question content',
        ];
    }
    




}
