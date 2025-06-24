<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Student Attendance Reports</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background-color: #f4f6f9;
      font-family: Arial, sans-serif;
    }
    .sidebar {
      height: 100vh;
      background-color: #2e7d32;
      color: white;
      padding: 20px;
      position: fixed;
      width: 220px;
      top: 0;
      left: 0;
    }
    .sidebar a {
      display: flex;
      align-items: center;
      gap: 10px;
      color: white;
      text-decoration: none;
      margin: 10px 0;
      padding: 8px;
      border-radius: 5px;
    }
    .sidebar a:hover,
    .sidebar .active {
      background-color: #1b5e20;
    }
    .profile {
      text-align: center;
      margin-bottom: 30px;
    }
    .profile img {
      border-radius: 50%;
      width: 80px;
    }
    .main-content {
      margin-left: 240px;
      padding: 20px;
    }
    .header {
      background-color: #388e3c;
      color: white;
      padding: 10px 20px;
      border-radius: 5px;
    }
    .btn-success {
      background-color: #43a047;
    }
  </style>
</head>
<body>

  <div class="sidebar">
    <div class="profile">
      <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Profile">
      <h6 class="mt-2">Nancy</h6>
      <small>Nancy@gmail.com</small>
    </div>
                <a href="{{ route('events.index') }}">🏠Home</a>
                <a href="{{ route('class.management') }}" class="active">📊Grades Managments</a>
                <a href="{{ route('attendance.index') }}">📋Record Attends</a>
                <a href="{{ route('attendance.reports') }}">📋Attends reports</a>
                <a href="{{ route('admin.events.create') }}">🗓️Create Event</a>
                {{--  <a href="{{ route('materials.bySubject') }}">📚Subject materials</a>  --}}
                <a href="#">📝Create PRE-EXAMS</a>
  </div>

  <div class="main-content">
    <div class="header mb-4">
      <h3>New Generation School</h3>
    </div>

    <div class="card p-4">
      <h4 class="mb-4">Student Attendance Reports</h4>


<form method="GET" action="{{ route('attendance.reports') }}">
  <div class="row mb-3">
    <div class="col-md-3">
      <label class="form-label">Class:</label>
      <select name="class_id" class="form-select">
        <option value="">All</option>
        @foreach ($classes as $class)
          <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>
            {{ $class->name }}
          </option>
        @endforeach
      </select>
    </div>
    <div class="col-md-3">
      <label class="form-label">Date:</label>
      <input type="date" name="date" class="form-control" value="{{ request('date') }}">
    </div>
    <div class="col-md-3 d-flex align-items-end">
      <button class="btn btn-primary w-100">Filter</button>
    </div>
  </div>
</form>

<div class="table-responsive">
  <table class="table table-bordered" id="attendanceTable">
    <thead class="table-light">
      <tr>
        <th>Student Name</th>
        <th>Status</th>
        <th>Date</th>
        <th>Class</th>
        <th>Teacher</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($attendances as $attendance)
        <tr>
          <td>{{ $attendance->student->name ?? '-' }}</td>
          <td>{{ ucfirst($attendance->status) }}</td>
          <td>{{ $attendance->date }}</td>
          <td>{{ $attendance->classModel->name ?? '-' }}</td>
          <td>{{ $attendance->teacher->name ?? '-' }}</td>
        </tr>
      @empty
        <tr>
          <td colspan="5">No attendance records found.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
      <button class="btn btn-success mt-3" onclick="downloadPDF()">Download Report as PDF</button>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- jsPDF -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

  <script>
    async function downloadPDF() {
      const { jsPDF } = window.jspdf;
      const doc = new jsPDF();
      doc.setFontSize(14);
      doc.text("Student Attendance Report", 20, 20);

      const table = document.getElementById("attendanceTable");
      let y = 30;

      for (let row of table.rows) {
        let rowText = '';
        for (let cell of row.cells) {
          rowText += cell.innerText + ' | ';
        }
        doc.text(rowText.trim(), 20, y);
        y += 10;
      }

      doc.save("attendance_report.pdf");
    }
  </script>

</body>
</html>
