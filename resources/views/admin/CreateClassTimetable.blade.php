<!DOCTYPE html><html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Question - New Generation School</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />
  <style>
    /* CSS Styles */
    .sidebar {
      width: 250px;
      background-color: #1e5631;
      min-height: 100vh;
      color: white;
    }.sidebar .nav-link {
  color: white;
  padding: 10px 15px;
  border-radius: 4px;
}

.sidebar .nav-link.active,
.sidebar .nav-link:hover {
  background-color: #2f7744;
  color: white;
}

.header {
  background-color: #2f7744;
}

.main-content {
  background-color: #fff;
  flex-grow: 1;
}

.card {
  border: none;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
}

.form-label {
  font-weight: 500;
}

textarea.form-control {
  resize: none;
}

.form-check {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 10px;
}

.btn-link {
  color: #2f7744;
  font-weight: bold;
  text-decoration: none;
}

.btn-link:hover {
  text-decoration: underline;
}

@media (max-width: 768px) {
  .sidebar {
    width: 100%;
    min-height: auto;
  }

  .main-content {
    padding: 1rem;
  }
}

body {
  background-color: #fbe3ca;
}

  </style>
</head>
<body>
  <div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar p-3 text-white">
      <div class="text-center mb-4">
        <img src="https://via.placeholder.com/80" class="rounded-circle mb-2" alt="Profile" />
        <h5 class="mb-0">user name</h5>
        <small>user email</small>
      </div>
      <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link" href="#">home</a></li>
        <li class="nav-item"><a class="nav-link" href="#">personal information</a></li>
        <li class="nav-item"><a class="nav-link " href="#">Users</a></li>
        <li class="nav-item"><a class="nav-link " href="#">Grades</a></li>
        <li class="nav-item"><a class="nav-link active" href="#">classes timetable</a></li>
        <li class="nav-item"><a class="nav-link" href="#">exams timetable</a></li>
      </ul>
    </div><!-- Main Content -->
<div class="main-content flex-grow-1">
  <div class="header text-center py-3">
    <h2 class="text-white">New Generation School</h2>
  </div>
  <div class="container py-4">



<form method="POST" action="{{ route('admin.timetable.store') }}">
  @csrf

  <div class="row mb-4">
    <div class="col-md-3">
      <label class="form-label">Grade</label>
      <select name="grade_id" class="form-select" onchange="filterClasses(this.value)">
        @foreach ($grades as $grade)
          <option value="{{ $grade->id }}">{{ $grade->name }}</option>
        @endforeach
      </select>
    </div>

    <div class="col-md-3">
      <label class="form-label">Class</label>
      <select name="class_id" class="form-select" id="class-select">
        @foreach ($classes as $class)
          <option value="{{ $class->id }}">{{ $class->name }}</option>
        @endforeach
      </select>
    </div>
  </div>

  @foreach (['SUNDAY', 'MONDAY', 'TUESDAY', 'WEDNESDAY', 'THURSDAY'] as $day)
    <div class="card mb-4">
      <div class="card-body">
        <h4>{{ $day }}</h4>

        @for ($i = 0; $i < 7; $i++)
          <h6 class="mt-3 mb-2">LEC.{{ $i + 1 }}</h6>
          <div class="row mb-3">
            <div class="col-md-3">
              <select class="form-select" name="timetable[{{ $day }}][{{ $i }}][subject_id]">
                @foreach ($subjects as $subject)
                  <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-3">
              <select class="form-select" name="timetable[{{ $day }}][{{ $i }}][teacher_id]">
                @foreach ($teachers as $teacher)
                  <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-3">
              <select class="form-select" name="timetable[{{ $day }}][{{ $i }}][subject_time_id]">
                @foreach ($times as $time)
                  <option value="{{ $time->id }}">{{ $time->start_time }} - {{ $time->end_time }}</option>
                @endforeach
              </select>
            </div>
          </div>
        @endfor
      </div>
    </div>
  @endforeach

  <div class="text-center mb-5">
    <button type="submit" class="btn btn-success">Create</button>
  </div>
</form>

</div>

  </div>
  <script>
  function filterClasses(stageId) {
    const allOptions = @json($classes);
    const classSelect = document.getElementById("class-select");
    classSelect.innerHTML = '';

    allOptions.forEach(cls => {
      if (cls.stage_id == stageId) {
        let opt = document.createElement("option");
        opt.value = cls.id;
        opt.innerText = cls.name;
        classSelect.appendChild(opt);
      }
    });
  }
</script>
</body>
</html>
