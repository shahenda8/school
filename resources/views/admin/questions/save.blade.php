@extends('admin.layouts.master')
@section('content')

  <!-- Main Content -->
  <div class="main-content">
    <header>New Generation School</header>

    <div class="form-container">
      <h2>
        {{$question->id?'Edit':'Add'}} question</h2>



      <!-- question Form -->
      <form id="questionForm" action="{{$question->id?route('questions.update',$question->id):route('questions.store')}}" method="post" enctype="multipart/form-data">
        @csrf
          @if($question->id)
           @method('PUT')

        @endif
        <input type="hidden" name="teacher_id" value="{{auth('teacher')->user()->id}}"/>
        <input type="hidden" name="type" value="mcq"/>
              <!-- Upload -->
          
          <div class="form-group-row">
              <div class="form-group">
                <label for="questionContent">Question Content</label>
                <input type="text" id="questionContent" name="ques_content" value="{{old('ques_content',$question->ques_content)}}" placeholder="write your question ‘s Content" />
                
                        @error('ques_content')
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
                        <option value="{{$subject->id}}" {{old('subject_id',$question->subject_id)==$subject->id?'selected':''}}>{{$subject->name}}</option>
                    @endforeach
                
                </select>   
                
                    @error('subject_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
              </div>
              <div class="form-group">
                <label for="degree">Degree</label>
                <input type="number" min="1" id="degree" name="degree" value="{{old('degree',$question->degree)}}" placeholder="write your question ‘s Degree" />
                
                        @error('degree')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
              </div>
           </div>
         <div class="form-group" id="answersWrapper">
              <label for="answers">Answers</label>
              @php
                  $answers = old('answer', json_decode($question->answer ?? '[]', true));
                  $correct = old('correct_answer', $question->correct_answer ?? null);
              @endphp

              @for($i = 0; $i < 4; $i++)
                  <div class="answer">
                       <input type="radio" name="correct_answer" value="{{ $i }}" {{ $correct == $i ? 'checked' : '' }} />
                      <input type="text" name="answer[]" value="{{ $answers[$i] ?? '' }}" placeholder="Answer {{ $i+1 }}" class="form-control" />

                  </div>
              @endfor

              @error('answer')
                  <div class="text-danger">{{ $message }}</div>
              @enderror
               @error('answer.*')
                  <div class="text-danger">{{ $message }}</div>
              @enderror

              @error('correct_answer')
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