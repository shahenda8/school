<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Exam Timetable</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: #f4f4f4;
    }

    .container {
      display: flex;
    }

    .sidebar {
      width: 250px;
      background-color: #2e7d32;
      color: white;
      min-height: 100vh;
      padding: 20px;
    }

    .profile {
      text-align: center;
      margin-bottom: 20px;
    }

    .profile img {
      width: 60px;
      height: 60px;
      border-radius: 50%;
    }

    .menu a {
      display: block;
      padding: 10px;
      color: white;
      text-decoration: none;
      margin-bottom: 5px;
    }

    .menu a.active,
    .menu a:hover {
      background-color: #1b5e20;
    }

    .main {
      flex: 1;
      padding: 20px;
      background-color: white;
    }

    .header {
      background-color: #388e3c;
      color: white;
      padding: 20px;
      text-align: center;
      font-size: 24px;
      margin-bottom: 20px;
    }

    .grades-table {
      width: 100%;
      border-collapse: collapse;
    }

    .grades-table th,
    .grades-table td {
      border: 1px solid #ccc;
      padding: 10px;
      text-align: center;
    }

    .grades-table th {
      background-color: #f0f0f0;
    }
  </style>
</head>
<body>
  <div class="container">
    <aside class="sidebar">
      <div class="profile">
        <img src="https://via.placeholder.com/60" alt="User">
        <p class="name">user name</p>
        <p class="email">user email</p>
      </div>
      <nav class="menu">
                <a href="{{ route('events.index') }}">🏠Home</a>
                <a href="{{ route('class.management') }}" class="active">📊Grades Managments</a>
                <a href="{{ route('attendance.index') }}">📋Record Attends</a>
                <a href="{{ route('attendance.reports') }}">📋Attends reports</a>
                <a href="{{ route('admin.events.create') }}">🗓️Create Event</a>
                {{--  <a href="{{ route('materials.bySubject') }}">📚Subject materials</a>  --}}
      </nav>
    </aside>

    <main class="main">
      <header class="header">
        <h1>New Generation School</h1>
      </header>

      <h3>Exam Timetable - Grade: {{ $grade->name }}</h3>

      <table class="grades-table">
        <thead>
          <tr>
            <th>Subject</th>
            <th>Exam Name</th>
            <th>Day</th>
            <th>Time</th>
            <th>Room</th>
          </tr>
        </thead>
        <tbody>
          @forelse($timetable as $exam)
            <tr>
              <td>{{ $exam->subject->name }}</td>
              <td>{{ $exam->name }}</td>
              <td>{{ $exam->day }}</td>
              <td>{{ $exam->time }}</td>
              <td>{{ $exam->location }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="5">No exams scheduled.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </main>
  </div>
</body>
</html>
