@extends('admin.layouts.master')
@section('content')

  <!-- Main Content -->
  <div class="main-content">
    <header>New Generation School</header>

    <div class="form-container">
      <h2>
        {{$exam->id?'Edit':'Add'}} exam</h2>



      <!-- exam Form -->
      <form id="examForm" action="{{$exam->id?route('exams.update',$exam->id):route('exams.store')}}" method="post" enctype="multipart/form-data">
        @csrf
          @if($exam->id)
           @method('PUT')

        @endif
        <input type="hidden" name="teacher_id" value="{{auth('teacher')->user()->id}}"/>
        <input type="hidden" name="type" value="mcq"/>
              <!-- Upload -->
          
          <div class="form-group-row">
              <div class="form-group">
                <label for="examContent">Exam Name</label>
                <input type="text" id="examContent" name="name" value="{{old('name',$exam->name)}}" placeholder="write your exam ‘s Content" />
                
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
              </div>
              
             
           </div>
           <div class="form-group-row">
             <div class="form-group">
                <label for="Subject">Subject</label>
                <select name="subject_id" id="Subject">
                    <option value="" selected disabled>-select Subject-</option>              

                    @foreach(\App\Models\Subject::where('teacher_id',auth('teacher')->user()->id)->get() as $subject)
                        <option value="{{$subject->id}}" {{old('subject_id',$exam->subject_id)==$subject->id?'selected':''}}>{{$subject->name}}</option>
                    @endforeach
                
                </select>   
                
                    @error('subject_id')
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
            <div class="form-group-row">
               <div class="form-group">
                  <label for="class_model">Class Model</label>
                  <select name="class_model_id" id="class_model">
                      <option value="" selected disabled>-select Class Model-</option>              

                      @foreach(\App\Models\ClassModel::get() as $class_model)
                          <option value="{{$class_model->id}}" {{old('class_model_id',$subject->class_model_id)==$class_model->id?'selected':''}}>{{$class_model->name}}</option>
                      @endforeach
                  
                  </select>   
                  
                      @error('class_model_id')
                      <div class="text-danger">{{ $message }}</div>
                      @enderror
                </div>
                  <div class="form-group">
                      <label>Term</label>
                      <select id="term" name="term">
                        <option value="" disabled selected>-Select Term-</option>
                        <option value="1"  {{old('term',$exam->term)=='1'?'selected':''}}>Term1</option>
                        <option value="2"  {{old('term',$exam->term)=='2'?'selected':''}}>Term2</option>
                      </select>
                      @error('term')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                  </div>
                
            </div>
            <div class="form-group-row">
              <div class="form-group">
                <label for="start_time">Exam Start date</label>
                <input type="datetime-local" id="start_time" name="start_time" value="{{old('start_time',$exam->start_time)}}" placeholder="write your exam ‘s start time" />
                
                        @error('start_time')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
              </div>
               <div class="form-group">
                <label for="end_time">Exam End date</label>
                <input type="datetime-local" id="end_time" name="end_time" value="{{old('end_time',$exam->end_time)}}" placeholder="write your exam ‘s start time" />
                
                        @error('end_time')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
              </div>
              
             
           </div>
           <div class="form-group-row">
              <div class="form-group">
                  <label for="questions">Select Questions</label>
                  <select name="questions[]" class="select2" id="questions" multiple style="height: 200px;">
                      @foreach(\App\Models\Question::where('teacher_id', auth('teacher')->user()->id)->get() as $question)
                          <option value="{{ $question->id }}"
                              {{ (collect(old('questions', $exam->questions->pluck('question_id') ?? []))->contains($question->id)) ? 'selected' : '' }}>
                              {{ Str::limit($question->ques_content, 100) }}
                          </option>
                      @endforeach
                  </select>
                  @error('questions')
                      <div class="text-danger">{{ $message }}</div>
                  @enderror
              </div>
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