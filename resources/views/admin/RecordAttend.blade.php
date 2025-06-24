<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Student Attendance</title>
  <style>
  body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
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

    .content {
      background-color: #ffffff;
      border-radius: 8px;
      padding: 20px;
    }

    .form-group {
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    table, th, td {
      border: 1px solid #ccc;
    }

    th, td {
      padding: 10px;
      text-align: center;
    }

    .btn {
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin-right: 10px;
    }

    .btn-save {
      background-color: #2e7d32;
      color: white;
    }

    .btn-download {
      background-color: #2196f3;
      color: white;
    }
  </style>
</head>
<body>
  <div class="container">
    <aside class="sidebar">
      <div class="profile">
        <img src="https://via.placeholder.com/60" alt="User">
        <p class="name">{{ Auth::user()->name ?? 'user name' }}</p>
        <p class="email">{{ Auth::user()->email ?? 'email' }}</p>
      </div>
      <nav class="menu">
 <a href="#">🏠 Home</a>
                <a href="{{ route('events.index') }}">🏠Home</a>
                <a href="{{ route('class.management') }}" class="active">📊Grades Managments</a>
                <a href="{{ route('attendance.index') }}">📋Record Attends</a>
                <a href="{{ route('attendance.reports') }}">📋Attends reports</a>
                <a href="{{ route('admin.events.create') }}">🗓️Create Event</a>
                {{--  <a href="{{ route('materials.bySubject') }}">📚Subject materials</a>  --}}
                <a href="#">📝Create PRE-EXAMS</a>
      </nav>
    </aside>

    <main class="main">
      <header class="header">New Generation School</header>
      <div class="content">
        <h3>Student Attendance</h3>

        <form action="{{ route('attendance.store') }}" method="POST">
          @csrf
          <div class="form-group">
            <label for="class">Class:</label>
            <select name="class_id" required>
              <option value="">Select Class</option>
              @foreach ($classes as $class)
                <option value="{{ $class->id }}">{{ $class->name }}</option>
              @endforeach
            </select>

            <label for="date">Date:</label>
            <input type="date" name="date" required>
          </div>

          <table>
            <thead>
              <tr>
                <th>Subject</th>
                <th>Student Name</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @php $students = \App\Models\Student::all(); @endphp
              @foreach ($students as $student)
              <tr>
                <td>
                  <select name="attendance[{{ $student->id }}][subject_id]" required>
                    @foreach ($subjects as $subject)
                      <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach
                  </select>
                </td>
                <td>
                  {{ $student->name }}
                  <input type="hidden" name="attendance[{{ $student->id }}][student_id]" value="{{ $student->id }}">
                </td>
                <td>
                  <select name="attendance[{{ $student->id }}][status]" required>
                    <option value="attend">Attend</option>
                    <option value="absent">Absent</option>
                  </select>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>

          <button type="submit" class="btn btn-save">Save Attendance</button>
        </form>
      </div>
    </main>
  </div>
</body>
</html>
