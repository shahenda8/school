<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class QuestionRequest extends FormRequest
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
                    'ques_content'=>'required|string|max:255',
                    'answer.*'=>'required|string|max:100',
                    'teacher_id'=>'required|exists:teachers,id',
                    'subject_id'=>'required|exists:subjects,id',
                    'degree'=>'required|integer|min:1',
                    'correct_answer' => 'required|integer|min:0|max:3'

                ];
            
    }

    
    public function attributes()
    {  
         return [
            'stage_id'=>"stage",
            'ques_content'=>'question content',
        ];
    }
    




}
