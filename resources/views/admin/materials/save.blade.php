@extends('admin.layouts.master')
@section('content')

  <!-- Main Content -->
  <div class="main-content">
    <header>New Generation School</header>

    <div class="form-container">
      <h2>
        {{$material->id?'Edit':'Add'}} Material</h2>



      <!-- material Form -->
      <form id="materialForm" action="{{$material->id?route('materials.update',$material->id):route('materials.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        @if($material->id)
           @method('PUT')

        @endif
        <!-- Upload -->
         
           <div class="form-group-row">
              <div class="form-group">
                <label for="materialName">Name</label>
                <input type="text" id="materialName" name="name" value="{{old('name',$material->name)}}" placeholder="write your material ‘s name" />
                
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
              </div>
            </div>
          <div class="form-group-row">
                
                  <div class="form-group">
                    <label for="Grade">Grade</label>
                      <select name="stage_id" id="grade">
                          <option value="" selected disabled>-select Grade-</option>              

                          @foreach(\App\Models\Stage::get() as $stage)
                              <option value="{{$stage->id}}" {{old('stage_id',$material->stage_id)==$stage->id?'selected':''}}>{{$stage->name}}</option>
                          @endforeach
                      
                      </select>   
                    
                        @error('stage_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                  </div>


                    <div class="form-group">
                        <label for="subject">subject</label>
                        <select name="subject_id" id="subject">
                            <option value="" selected disabled>-select subject-</option>              

                            @foreach(\App\Models\Subject::where('teacher_id',auth('teacher')->user()->id)->get() as $subject)
                                <option value="{{$subject->id}}" {{old('subject_id',$material->subject_id)==$subject->id?'selected':''}}>{{$subject->name}}</option>
                            @endforeach
                        
                        </select>   
                    
                        @error('subject_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                  </div>
          </div>
           <div class="form-group-row">
                  <div class="form-group">
                      <label>Term</label>
                      <select id="term" name="term">
                        <option value="" disabled selected>-Select Term-</option>
                        <option value="1"  {{old('term',$material->term)=='1'?'selected':''}}>Term1</option>
                        <option value="2"  {{old('term',$material->term)=='2'?'selected':''}}>Term2</option>
                      </select>
                      @error('term')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                  </div>
                  <div class="form-group">
                      <label>Type</label>
                      <select id="type" name="type">
                        <option value="" disabled selected>-Select type-</option>
                        <option value="pdf"  {{old('type',$material->type)=='pdf'?'selected':''}}>pdf</option>
                        <option value="video"  {{old('type',$material->type)=='video'?'selected':''}}>video</option>
                        <option value="assignment"  {{old('type',$material->type)=='assignment'?'selected':''}}>assignment</option>
                      </select>
                      @error('type')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                  </div>
            </div>
                  <div class="form-group">
                      <label>Files</label>
                    <input type="file" id="files" name="files" placeholder="write your material ‘s Files" />
                        @if($material->files)
                            <a href='{{asset($material->files)}}' target="_blank"><i class="fa fa-file-download"></i></a>
                      @endif
                      @error('files')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                  </div>
           
      
        <button class="submit-button mt-5" type="submit">Save</button>
      </form>
    </div>
  </div>

@endsection

@section('script')

<script>

    
document.addEventListener("DOMContentLoaded", () => {
  const uploadBox = document.getElementById("uploadBox");
  const fileInput = document.getElementById("photoInput");

  if (uploadBox && fileInput) {
    uploadBox.addEventListener("click", () => fileInput.click());

    fileInput.addEventListener("change", () => {
      if (fileInput.files.length > 0) {
        uploadBox.textContent = `Selected: ${fileInput.files[0].name}`;

      }
    });
  }
});
</script>
@endsection