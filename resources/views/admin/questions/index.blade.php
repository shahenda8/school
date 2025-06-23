@extends('admin.layouts.master')
@section('content')

 <div class="main-content">
    <header> New Generation School </header>

    <div class="content">
      <div class="top-bar">
        <form>
        <input type="text" value="{{request()->search}}" name="search" placeholder="Search..." id="searchBox" />
        <button id="searchBtn">Search</button>
        </form>
        <a href="{{route('questions.create')}}" class="submit-button">Create New question</a>
      </div>

      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>question Content</th>
            <th>question Degree</th>            
            <th>subject</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="questionTable">
            @foreach($questions as $question)
          <tr>
            <td>{{$question->id}}</td>
        
            <td>{{$question->ques_content}}</td>
            <td>{{$question->degree}}</td>
            <td>{{$question->subject?->name}}</td>
            
            <td>
              <a  href="{{ route('questions.edit',$question->id) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>edit</a>
                <form action="{{ route('questions.destroy', $question->id) }}" method="post" style="display: inline-block">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    <button  type="submit" class="btn btn-danger delete btn-sm show_confirm"><i class="fa fa-trash"></i>delete</button>
                </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

      <!-- <div class="pagination">
        <button>&lt;&lt;</button>
        <button>&lt;</button>
        <button class="active">1</button>
        <button>&gt;</button>
        <button>&gt;&gt;</button>
      </div> -->
 @if ($questions->lastPage() > 1)
  <div class="pagination">

    {{-- << First Page --}}
    <button
      @if ($questions->onFirstPage()) disabled @endif
      onclick="window.location='?page=1'">&lt;&lt;</button>

    {{-- < Previous Page --}}
    <button
      @if ($questions->onFirstPage()) disabled @endif
      onclick="window.location='?page={{ $questions->currentPage() - 1 }}'">&lt;</button>

    {{-- Page Numbers --}}
    @php
        $current = $questions->currentPage();
        $last = $questions->lastPage();
        $start = max(1, $current - 2);
        $end = min($last, $current + 2);

        if ($start > 1) {
            echo '<button onclick="window.location=\'?page=1\'">1</button>';
            if ($start > 2) echo '<span>...</span>';
        }

        for ($i = $start; $i <= $end; $i++) {
            echo '<button class="' . ($i == $current ? 'active' : '') . '" onclick="window.location=\'?page=' . $i . '\'">' . $i . '</button>';
        }

        if ($end < $last) {
            if ($end < $last - 1) echo '<span>...</span>';
            echo '<button onclick="window.location=\'?page=' . $last . '\'">' . $last . '</button>';
        }
    @endphp

    {{-- > Next Page --}}
    <button
      @if ($questions->currentPage() == $questions->lastPage()) disabled @endif
      onclick="window.location='?page={{ $questions->currentPage() + 1 }}'">&gt;</button>

    {{-- >> Last Page --}}
    <button
      @if ($questions->currentPage() == $questions->lastPage()) disabled @endif
      onclick="window.location='?page={{ $questions->lastPage() }}'">&gt;&gt;</button>

  </div>
@endif



    </div>
  </div>
@endsection

@section('script')

<script>
    document.querySelectorAll('.pagination-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const page = this.getAttribute('data-page');
            if (!this.disabled && page) {
                // You can change the window location or use AJAX here
                window.location.href = `?page=${page}`;
            }
        });
    });
</script>
@endsection