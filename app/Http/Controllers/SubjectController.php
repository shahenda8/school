<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Http\Requests\SubjectRequest;
class SubjectController extends Controller
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

        $subjects = Subject::when($request->query('search'),function($query) use($searchQuery, $fields) {
            foreach ($fields as $field)
                $query->orWhere($field, 'like',  '%' . $searchQuery .'%');
            })->when($request->query('from_date'), function($query, $from_date) {
                $query->where('created_at', '>=', $from_date);
            })->when($request->query('to_date'), function($query, $to_date) {
                $query->where('created_at', '<=', $to_date);
            })

            // ->where('teacher_id',auth('teacher')->user()->id)
            ->orderBy('id', 'desc')->paginate(5);
        return view('admin.subjects.index',compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subject=new Subject();
       return view('admin.subjects.save',compact('subject'));
    }



    public function store(SubjectRequest $request)
    {

        $subject=Subject::create($request->except('image'));
       if(request()->hasFile('image')){
              if($subject && $subject->image){
                    $this->remove_file($subject->image);
                   }
           $subject->image= $this->upload_file($request->image,'subjects');
           $subject->save();
        }
           $route=url('subjects');

        // return response()->json(['success' =>__('recored created successfully.'),'url'=>$route]);
         return redirect('subjects')->with(["success"=>__('recored updated successfully.')]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        return view('admin.subjects.save',compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\SubjectRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubjectRequest $request,$id)
    {
        $subject=Subject::find($id);

        $subject->update($request->except('image'));
        if(request()->hasFile('image')){
              if($subject && $subject->image){
                    $this->remove_file($subject->image);
                   }
           $subject->image= $this->upload_file($request->image,'subjects');
           $subject->save();
        }
         $route=url('subjects');

        // return response()->json(['success' =>__('recored updated successfully.'),'url'=>$route]);

         return redirect('subjects')->with(["success"=>__('recored updated successfully.')]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {

        $subject->delete();
        $route=url('subjects');

        // return response()->json(['success' =>__('recored deleted successfully.'),'url'=>$route]);
         return redirect()->back()->with('success',trans('DeleteSuccessfully'));
        }




}
