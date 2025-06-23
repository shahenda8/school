<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Question - New Generation School</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />
  <style>
    .sidebar {
      width: 250px;
      background-color: #1e5631;
      min-height: 100vh;
      color: white;
    }
    .sidebar .nav-link {
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
        <li class="nav-item"><a class="nav-link" href="#">Users</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Grades</a></li>
        <li class="nav-item"><a class="nav-link" href="#">classes timetable</a></li>
        <li class="nav-item"><a class="nav-link active" href="#">exams timetable</a></li>
      </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content flex-grow-1">
      <div class="header text-center py-3">
        <h2 class="text-white">New Generation School</h2>
      </div>
      <div class="container py-4">
        <form method="POST" action="{{ route('exams.store') }}">
          @csrf

          <!-- Grade -->
          <div class="row mb-3">
            <div class="col-md-3">
              <label class="form-label">Grade</label>
              <select name="stage_id" class="form-select" required>
                <option disabled selected>Select Grade</option>
                @foreach($grades as $grade)
                  <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="card">
            <div class="card-body">
              <div class="row mb-3">
                <!-- Subject -->
                <div class="col-md-3">
                  <label class="form-label">Subject</label>
                  <select name="subject_id" class="form-select" required>
                    <option disabled selected>Select Subject</option>
                    @foreach($subjects as $subject)
                      <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach
                  </select>
                </div>

                <!-- Exam Name -->
                <div class="col-md-3">
                  <label class="form-label">Name</label>
                  <select name="name" class="form-select" required>
                    <option disabled selected>Select Exam Type</option>
                    @foreach($examTypes as $exam)
                      <option value="{{ $exam }}">{{ $exam }}</option>
                    @endforeach
                  </select>
                </div>

                <!-- Time -->
                <div class="col-md-3">
                  <label class="form-label">Time</label>
                  <select name="time" class="form-select" required>
                    <option disabled selected>Select Time</option>
                    <option>07:00:00-08:30:00</option>
                    <option>09:00:00-10:30:00</option>
                    <option>11:00:00-12:30:00</option>
                  </select>
                </div>

                <!-- Day -->
                <div class="col-md-3">
                  <label class="form-label">Day</label>
      <input type="date" name="birth_date" class="form-control" required />
                    {{--  <option disabled selected>Select Day</option>
                    <option>Monday</option>
                    <option>Tuesday</option>
                    <option>Wednesday</option>
                    <option>Thursday</option>
                    <option>Sunday</option>
                  </select>  --}}
                </div>

                <!-- Location -->
                <div class="col-md-3 mt-3">
                  <label class="form-label">Location</label>
                  <input type="text" name="location" class="form-control" placeholder="Enter location" required />
                </div>
              </div>
            </div>
          </div>

          <!-- Submit Button -->
          <button type="submit" class="btn btn-success mt-4" style="display: block; margin: 0 auto; margin-bottom: 40px;">Create</button>

          @if(session('success'))
            <div class="alert alert-success text-center mt-3">
              {{ session('success') }}
            </div>
          @endif

        </form>
      </div>
    </div>
  </div>
</body>
</html>
