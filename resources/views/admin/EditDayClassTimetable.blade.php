<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit {{ ucfirst($day) }} Timetable</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h2 class="mb-4 text-success">Edit Timetable - {{ ucfirst($day) }}</h2>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <form method="POST" action="{{ route('admin.timetable.updateDay', ['classId' => $classId, 'day' => $day]) }}">
    @csrf
    @for($i = 0; $i < 7; $i++)
      <h6 class="mt-4 mb-2">LEC.{{ $i + 1 }}</h6>
      <div class="row mb-3">
        <div class="col-md-4">
          <label class="form-label">Subject</label>
          <select class="form-select" name="timetable[{{ $i }}][subject_id]">
            @foreach ($subjects as $subject)
              <option value="{{ $subject->id }}"
                {{ isset($daySchedule[$i]) && $daySchedule[$i]->subject_id == $subject->id ? 'selected' : '' }}>
                {{ $subject->name }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="col-md-4">
          <label class="form-label">Teacher</label>
          <select class="form-select" name="timetable[{{ $i }}][teacher_id]">
            @foreach ($teachers as $teacher)
              <option value="{{ $teacher->id }}"
                {{ isset($daySchedule[$i]) && $daySchedule[$i]->teacher_id == $teacher->id ? 'selected' : '' }}>
                {{ $teacher->name }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="col-md-4">
          <label class="form-label">Time</label>
          <input type="text" class="form-control" value="{{ isset($daySchedule[$i]) ? $daySchedule[$i]->subjectTime->start_time . ' - ' . $daySchedule[$i]->subjectTime->end_time : 'N/A' }}" disabled>
        </div>
      </div>
    @endfor

    <div class="text-center mt-4">
      <button type="submit" class="btn btn-success">Save Changes</button>
    </div>
  </form>
</div>
</body>
</html>
