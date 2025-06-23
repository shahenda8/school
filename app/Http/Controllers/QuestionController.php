<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Http\Requests\QuestionRequest;
class QuestionController extends Controller
{   
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $request = request();

        $fields = ['ques_content'];
        $searchQuery = trim($request->query('search'));

        $questions = Question::when($request->query('search'),function($query) use($searchQuery, $fields) {
            foreach ($fields as $field)
                $query->orWhere($field, 'like',  '%' . $searchQuery .'%');
            })->when($request->query('from_date'), function($query, $from_date) {
                $query->where('created_at', '>=', $from_date);
            })->when($request->query('to_date'), function($query, $to_date) {
                $query->where('created_at', '<=', $to_date);
            })
       
            ->where('teacher_id',auth('teacher')->user()->id)
            ->orderBy('id', 'desc')->paginate(5);
        return view('admin.questions.index',compact('questions'));
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $question=new Question();
       return view('admin.questions.save',compact('question'));
    }

 

    public function store(QuestionRequest $request)
    {
       
        $question=Question::create($request->except('answer')+['answer'=>json_encode($request->answer)]);
      
           $route=url('questions');
        
        // return response()->json(['success' =>__('recored created successfully.'),'url'=>$route]);
         return redirect('questions')->with(["success"=>__('recored updated successfully.')]);   
        
    }
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        return view('admin.questions.save',compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\questionRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionRequest $request,$id)
    {
        $question=Question::find($id);
       
        $question->update($request->except('answer')+['answer'=>json_encode($request->answer)]);
       
         $route=url('questions');
        
        // return response()->json(['success' =>__('recored updated successfully.'),'url'=>$route]);
        
         return redirect('questions')->with(["success"=>__('recored updated successfully.')]);   
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {   
             
        $question->delete();
        $route=url('questions');
        
        // return response()->json(['success' =>__('recored deleted successfully.'),'url'=>$route]);
         return redirect()->back()->with('success',trans('DeleteSuccessfully'));
        }

    

   
}
