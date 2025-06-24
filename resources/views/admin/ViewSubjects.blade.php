<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Study Materials - New Generation School</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f1f5f9;
    }

    .sidebar {
      width: 250px;
      background-color: #2e7d32;
      min-height: 100vh;
      color: white;
      position: fixed;
      padding: 20px 15px;
    }

    .sidebar .profile {
      text-align: center;
      margin-bottom: 30px;
    }

    .sidebar .profile img {
      width: 70px;
      height: 70px;
      border-radius: 50%;
      background-color: #fff;
    }

    .sidebar .nav-link {
      color: white;
      padding: 10px 15px;
      border-radius: 6px;
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 10px;
    }

    .sidebar .nav-link.active,
    .sidebar .nav-link:hover {
      background-color: #1b5e20;
      color: white;
    }

    .main {
      margin-left: 250px;
      padding: 20px;
    }

    .header {
      background-color: #2e7d32;
      padding: 15px;
      color: white;
      text-align: center;
      border-radius: 5px;
      margin-bottom: 20px;
    }

    .material-card {
      background-color: white;
      padding: 20px;
      border-radius: 10px;
      margin-bottom: 15px;
      box-shadow: 0px 0px 10px rgba(0,0,0,0.05);
    }

    .material-title {
      font-size: 20px;
      font-weight: bold;
      color: #2e7d32;
    }

    .material-desc {
      color: #555;
      margin-top: 5px;
    }

    .btn-view {
      margin-top: 10px;
    }

    @media(max-width: 768px) {
      .sidebar {
        width: 100%;
        height: auto;
        position: relative;
      }
      .main {
        margin-left: 0;
      }
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <div class="profile">
      <img src="https://via.placeholder.com/70" alt="User" />
      <h6 class="mt-2">{{ Auth::user()->name }}</h6>
      <small>{{ Auth::user()->email }}</small>
    </div>
    <nav class="nav flex-column">
                <a href="{{ route('events.index') }}">🏠Home</a>
                <a href="{{ route('class.management') }}" class="active">📊Grades Managments</a>
                <a href="{{ route('attendance.index') }}">📋Record Attends</a>
                <a href="{{ route('attendance.reports') }}">📋Attends reports</a>
                <a href="{{ route('admin.events.create') }}">🗓️Create Event</a>
                {{--  <a href="{{ route('materials.bySubject') }}">📚Subject materials</a>  --}}
                <a href="{{ route('student.results') }}">📊Results</a>
                 <a href="{{ route('student.pre_exams') }}" class="active">📋Pre-Exams</a>
    </nav>
  </div>

  <!-- Main Content -->
  <div class="main">
    <div class="header">
      <h3>New Generation School</h3>
    </div>

    <h4 class="mb-4 fw-bold">Study Materials</h4>

    @foreach ($subjects as $subject)
      <div class="material-card">
        <div class="material-title">{{ $subject->subject_name }}</div>
        <div class="material-desc">Study materials related to {{ $subject->subject_name }}.</div>
        <a href="{{ route('materials.bySubject', $subject->id) }}" class="btn btn-success btn-sm btn-view">View</a>
      </div>
    @endforeach

    @if ($subjects->isEmpty())
      <div class="alert alert-warning">No subjects available for your stage.</div>
    @endif

  </div>

</body>
</html>
