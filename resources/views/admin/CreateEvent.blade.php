<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Add Event</title>
  <meta name="description" content="Event Management Page" />
  <style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Segoe UI', sans-serif;
}
body {
  background-color: #f8f9fc;
}
#Header {
  background-color: #2e7d32;
  color: white;
  padding: 20px;
  text-align: center;
  font-size: 24px;
  font-weight: bold;
  margin: 10px 20px 0px 260px;
}
.container {
  display: flex;
  padding: 20px;
}
.sidebar {
  height: 110vh;
  width: 220px;
  background-color: #2e7d32;
  color: white;
  padding: 20px;
  border-radius: 8px;
  margin: -90px 0px 0px 0px;
}
.profile {
  text-align: center;
  margin-bottom: 30px;
}

.profile img {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  margin-bottom: 10px;
}

.profile h3 {
  font-size: 16px;
}

.profile p {
  font-size: 13px;
  color: #dcdcdc;
}
.sidebar ul {
  list-style: none;
  padding: 0;
}
.sidebar ul li {
  padding: 12px 10px;
  font-size: 15px;
  color: white;
  display: flex;
  align-items: center;
  border-radius: 5px;
  transition: background-color 0.2s;
  cursor: pointer;
}
.sidebar ul li:hover {
  background-color: #1b5e20;
  font-weight: bold;
}
.sidebar ul li.active {
  background-color: #1b5e20;
  font-weight: bold;
}

.main-content {
  flex: 1;
  margin-left: 20px;
  padding: 20px;
  background-color: white;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0,0,0,0.05);
}
.main-content h2 {
  margin-bottom: 20px;
  color: #2e7d32;
}

.event-form .form-group {
  margin-bottom: 15px;
  display: flex;
  flex-direction: column;
}

.event-form label {
  margin-bottom: 5px;
  font-weight: bold;
  color: #333;
}

.event-form input,
.event-form textarea {
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 6px;
  font-size: 14px;
}

#event-form textarea {
  resize: vertical;
}

.submit-btn {
  background-color: #2e7d32;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 6px;
  cursor: pointer;
  font-weight: bold;
}

.submit-btn:hover {
  background-color: #1b5e20;
}
.form-buttons {
  margin-top: 20px;
  display: flex;
  gap: 10px;
}

.btn {
  padding: 10px 20px;
  font-size: 15px;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.btn-save {
  background-color: #2e7d32;
  color: white;
}

.btn-save:hover {
  background-color: #1b5e20;
}

.btn-cancel {
  background-color: #ccc;
  color: #333;
}

.btn-cancel:hover {
  background-color: #b3b3b3;
}
  </style>
</head>
<body>
  <div id="Header">New Generation School</div>
  <div class="container">
    <div class="sidebar">
      <div class="profile">
        <img src="profile_picture.png" alt="profile" />
        <h3> Nancy </h3>
        <p> Nancy@gmail.com </p>
      </div>
      <ul>
        <li class="nav-item"><a href="{{ route('events.index') }}">🏠Home</a></li>
        <li class="nav-item"><a href="{{ route('class.management') }}" class="active">📊Grades Managments</a></li>
        <li class="nav-item"><a href="{{ route('attendance.index') }}">📋Record Attends</a></li>
        <li class="nav-item"><a href="{{ route('attendance.reports') }}">📋Attends reports</a></li>
        <li class="nav-item"> <a href="{{ route('admin.events.create') }}">🗓️Create Event</a></li>
        {{--  <li class="nav-item"><a href="{{ route('materials.bySubject') }}">📚Subject materials</a></li>  --}}
        <li class="nav-item"> <a href="#">📝Create PRE-EXAMS</a></li>
      </ul>
    </div>

    <div class="main-content">
      <h2>Add New Event</h2>

      @if(session('success'))
        <p style="color: green; font-weight: bold;">{{ session('success') }}</p>
      @endif

      <form class="event-form" method="POST" action="{{ route('admin.events.store') }}">
        @csrf
        <div class="form-group">
          <label for="eventName">Event Name:</label>
          <input type="text" id="eventName" name="eventName" required />
        </div>

        <div class="form-group">
          <label for="eventDate">Date:</label>
          <input type="date" id="eventDate" name="eventDate" required />
        </div>

        <div class="form-group">
          <label for="eventTime">Time:</label>
          <input type="time" id="eventTime" name="eventTime" required />
        </div>

        <div class="form-group">
          <label for="eventLocation">Location:</label>
          <input type="text" id="eventLocation" name="eventLocation" required />
        </div>

        <div class="form-group">
          <label for="eventDescription">Description:</label>
          <textarea id="eventDescription" name="eventDescription" rows="3"></textarea>
        </div>

        <div class="form-buttons">
          <button type="submit" class="btn btn-save">Save</button>
          <button type="button" class="btn btn-cancel">Cancel</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const form = document.querySelector(".event-form");
      const cancelBtn = document.querySelector(".btn-cancel");

      cancelBtn.addEventListener("click", function () {
        if (confirm("هل أنت متأكد أنك تريد إلغاء البيانات؟")) {
          form.reset();
        }
      });
    });
  </script>
</body>
</html>
