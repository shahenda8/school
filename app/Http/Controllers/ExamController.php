<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Http\Requests\ExamRequest;
use App\Models\ExamQuestion;

class ExamController extends Controller
{   
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $request = request();

        $fields = ['name'];
        $searchQuery = trim($request->query('search'));

        $exams = Exam::when($request->query('search'),function($query) use($searchQuery, $fields) {
            foreach ($fields as $field)
                $query->orWhere($field, 'like',  '%' . $searchQuery .'%');
            })->when($request->query('from_date'), function($query, $from_date) {
                $query->where('created_at', '>=', $from_date);
            })->when($request->query('to_date'), function($query, $to_date) {
                $query->where('created_at', '<=', $to_date);
            })
       
            ->whereHas('subject',function($q){
                    $q->where('teacher_id',auth('teacher')->user()->id);
            })
            ->orderBy('id', 'desc')->paginate(5);
        return view('admin.exams.index',compact('exams'));
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $exam=new Exam();
       return view('admin.exams.save',compact('exam'));
    }

 

    public function store(ExamRequest $request)
    {
       
        $exam=Exam::create($request->except('questions'));
          foreach($request->questions as $question){
            ExamQuestion::create([
                'exam_id'=>$exam->id,
                'question_id'=>$question
            ]);
          }
           $route=url('exams');
        
        // return response()->json(['success' =>__('recored created successfully.'),'url'=>$route]);
         return redirect('exams')->with(["success"=>__('recored updated successfully.')]);   
        
    }
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        return view('admin.exams.save',compact('exam'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\examRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExamRequest $request,$id)
    {
        $exam=Exam::find($id);
       
        $exam->update($request->except('questions'));
        $exam->questions->delete();
        foreach($request->questions as $question){
            ExamQuestion::create([
                'exam_id'=>$exam->id,
                'question_id'=>$question
            ]);
          }
         $route=url('exams');
        
        // return response()->json(['success' =>__('recored updated successfully.'),'url'=>$route]);
        
         return redirect('exams')->with(["success"=>__('recored updated successfully.')]);   
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {   
             
        $exam->delete();
        $route=url('exams');
        
        // return response()->json(['success' =>__('recored deleted successfully.'),'url'=>$route]);
         return redirect()->back()->with('success',trans('DeleteSuccessfully'));
        }

    

   
}
