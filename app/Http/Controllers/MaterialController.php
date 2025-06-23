<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material;
use App\Http\Requests\MaterialRequest;
class MaterialController extends Controller
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

        $materials = Material::when($request->query('search'),function($query) use($searchQuery, $fields) {
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
        return view('admin.materials.index',compact('materials'));
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $material=new Material();
       return view('admin.materials.save',compact('material'));
    }

 

    public function store(MaterialRequest $request)
    {
       
        $material=Material::create($request->except('files'));
       if(request()->hasFile('files')){
              if($material && $material->files){
                    $this->remove_file($material->files);
                   }
           $material->files= $this->upload_file($request->file('files'),'materials');
           $material->save();
        }
           $route=url('materials');
        
        // return response()->json(['success' =>__('recored created successfully.'),'url'=>$route]);
         return redirect('materials')->with(["success"=>__('recored updated successfully.')]);   
        
    }
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material)
    {
        return view('admin.materials.save',compact('material'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\MaterialRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MaterialRequest $request,$id)
    {
        $material=Material::find($id);
       
        $material->update($request->except('files'));
        if(request()->hasFile('files')){
              if($material && $material->files){
                    $this->remove_file($material->files);
                   }
           $material->files= $this->upload_file($request->file('files'),'materials');
           $material->save();
        }
         $route=url('materials');
        
        // return response()->json(['success' =>__('recored updated successfully.'),'url'=>$route]);
        
         return redirect('materials')->with(["success"=>__('recored updated successfully.')]);   
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Material $material)
    {   
             
        $material->delete();
        $route=url('materials');
        
        // return response()->json(['success' =>__('recored deleted successfully.'),'url'=>$route]);
         return redirect()->back()->with('success',trans('DeleteSuccessfully'));
        }

    

   
}
