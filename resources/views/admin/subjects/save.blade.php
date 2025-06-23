@extends('admin.layouts.master')
@section('content')

  <!-- Main Content -->
  <div class="main-content">
    <header>New Generation School</header>

    <div class="form-container">
      <h2>
        {{$subject->id?'Edit':'Add'}} Subject</h2>



      <!-- Subject Form -->
      <form id="subjectForm" action="{{$subject->id?route('subjects.update',$subject->id):route('subjects.store')}}" method="post" enctype="multipart/form-data">
        @csrf
          @if($subject->id)
           @method('PUT')

        @endif
<input type="hidden" name="teacher_id" value="{{auth('teacher')->user()->id}}"/>
              <!-- Upload -->
            <div class="form-group">
            <label for="photoInput">Upload Photo</label>
            <div id="uploadBox" class="upload-area">
                + Click here to upload Photo
            </div>
            <input type="file" id="photoInput" name="image" accept="image/*" style="display: none;" />
            @if($subject->image)
                      <img src="{{asset($subject->image)}}" width="100px"/>
            @endif
            </div>
            
            @error('image')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          <div class="form-group-row">
          <div class="form-group">
            <label for="subjectName">Name</label>
            <input type="text" id="subjectName" name="name" value="{{old('name',$subject->name)}}" placeholder="write your subject ‘s name" />
            
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
          </div>
          
          <div class="form-group">
            <label for="Grade">Grade</label>
            <select name="stage_id" id="grade">
                <option value="" selected disabled>-select Grade-</option>              

                @foreach(\App\Models\Stage::get() as $stage)
                    <option value="{{$stage->id}}" {{old('stage_id',$subject->stage_id)==$stage->id?'selected':''}}>{{$stage->name}}</option>
                @endforeach
             
            </select>   
            
                @error('stage_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
           </div>
           </div>
        <div class="form-group">
          <label for="subjectDescription">Description</label>
          <textarea id="subjectDescription" name="description" placeholder="write your subject ‘s description">{{old('description',$subject->description)}} </textarea>
          
            @error('description')
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