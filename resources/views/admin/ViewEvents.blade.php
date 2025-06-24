<!-- resources/views/events/index.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Events - New Generation School</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
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
      margin-bottom: 20px;
    }

    .form-label {
      font-weight: 500;
    }

    textarea.form-control {
      resize: none;
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
        <h5 class="mb-0">User Name</h5>
        <small>User Email</small>
      </div>
      <ul class="nav flex-column">
        <li class="nav-item"><a href="{{ route('events.index') }}">🏠Home</a></li>
        <li class="nav-item"><a href="{{ route('class.management') }}" class="active">📊Grades Managments</a></li>
        <li class="nav-item"><a href="{{ route('attendance.index') }}">📋Record Attends</a></li>
        <li class="nav-item"><a href="{{ route('attendance.reports') }}">📋Attends reports</a></li>
        <li class="nav-item"> <a href="{{ route('admin.events.create') }}">🗓️Create Event</a></li>
      </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content flex-grow-1">
      <div class="header text-center py-3">
        <h2 class="text-white">New Generation School</h2>
      </div>
      <div class="container py-4">
        @forelse ($events as $event)
          <div class="card">
            <div class="card-body">
              <form>
                <div class="mb-3">
                  <label class="form-label">Event Name</label>
                  <textarea class="form-control" rows="2" readonly>{{ $event->name }}</textarea>
                </div>

                <div class="mb-3">
                  <label class="form-label">Event Description</label>
                  <textarea class="form-control" rows="3" readonly>{{ $event->description }}</textarea>
                </div>

                <div class="mb-3">
                  <label class="form-label">Event Date</label>
                  <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($event->date)->format('Y-m-d') }}" readonly>
                </div>
              </form>
            </div>
          </div>
        @empty
          <div class="alert alert-warning">No events available.</div>
        @endforelse
      </div>
    </div>
  </div>
</body>
</html>
