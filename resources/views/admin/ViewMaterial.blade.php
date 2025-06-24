
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Subject Materials</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
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

    .name, .email {
      margin: 5px 0;
    }

    .menu a {
      display: block;
      padding: 10px;
      color: white;
      text-decoration: none;
    }

    .menu a.active, .menu a:hover {
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
      margin-bottom: 20px;
    }

    .grades-table th, .grades-table td {
      border: 1px solid #ccc;
      padding: 8px;
      text-align: center;
    }

    .btn-download {
      background-color: #2e7d32;
      color: white;
      padding: 5px 10px;
      border: none;
      border-radius: 4px;
      text-decoration: none;
      font-size: 14px;
    }

    .btn-download:hover {
      background-color: #1b5e20;
    }
  </style>
</head>
<body>
  <div class="container">
    <aside class="sidebar">
      <div class="profile">
        <img src="profile.jpg" alt="User">
        <p class="name">{{ Auth::user()->name }}</p>
        <p class="email">{{ Auth::user()->email }}</p>
      </div>
      <nav class="menu">
                <a href="{{ route('events.index') }}">🏠Home</a>
                <a href="{{ route('class.management') }}" class="active">📊Grades Managments</a>
                <a href="{{ route('attendance.index') }}">📋Record Attends</a>
                <a href="{{ route('attendance.reports') }}">📋Attends reports</a>
                <a href="{{ route('admin.events.create') }}">🗓️Create Event</a>
                {{--  <a href="{{ route('materials.bySubject') }}">📚Subject materials</a>  --}}
                <a href="{{ route('student.results') }}">📊Results</a>
                 <a href="{{ route('student.pre_exams') }}" class="active">📋Pre-Exams</a>
       </nav>
    </aside>

    <main class="main">
      <header class="header">
        <h1>{{ $subject->subject_name }} Materials</h1>
      </header>

      <table class="grades-table">
        <thead>
          <tr>
            <th>Lesson</th>
            <th>File Type</th>
            <th>Download</th>
            <th>Homework</th>
            <th>Download</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($materials as $material)
            <tr>
              <td>{{ $material->name }}</td>
              <td>{{ strtoupper($material->type) }}</td>
              <td>
                @if ($material->type == 'url')
                  <a href="{{ $material->files }}" target="_blank" class="btn-download">Open Link</a>
                @else
                  <a href="{{ asset('storage/' . $material->files) }}" download class="btn-download">Download</a>
                @endif
              </td>

              @php
                $hw = $homeworks->firstWhere('subject_id', $material->subject_id);
              @endphp
              <td>{{ $hw ? $hw->name : '--' }}</td>
              <td>
                @if ($hw && $hw->file)
                  <a href="{{ asset('storage/' . $hw->file) }}" download class="btn-download">Download</a>
                @else
                  --
                @endif
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5">No materials available for this subject.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </main>
  </div>
</body>
</html>
