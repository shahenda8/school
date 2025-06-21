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
        <li class="nav-item"><a class="nav-link" href="#">Users</a></li>
        <li class="nav-item"><a class="nav-link active" href="#">Grades</a></li>
        <li class="nav-item"><a class="nav-link" href="#">classes timetables</a></li>
        <li class="nav-item"><a class="nav-link" href="#">exams timetable</a></li>
      </ul>
    </div><!-- Main Content -->
<div class="main-content flex-grow-1">
  <div class="header text-center py-3">
    <h2 class="text-white">New Generation School</h2>
  </div>
  <div class="container py-4">
    <div class="card">
      <div class="card-body">
        <h4 class="mb-4">Add Class</h4>
<form action="{{ route('admin.classes.store') }}" method="POST">
  @csrf

  <div class="row mb-3">
    <div class="col-md-4">
      <label class="form-label">اسم الفصل</label>
      <input type="text" name="name" class="form-control" required />
    </div>

    <div class="col-md-4">
      <label class="form-label">المرحلة الدراسية</label>
      <select name="stage_id" class="form-select" required>
        <option selected disabled>اختر المرحلة</option>
        @foreach($stages as $stage)
          <option value="{{ $stage->id }}">{{ $stage->name }}</option>
        @endforeach
      </select>
    </div>

    <div class="col-md-4">
      <label class="form-label">عدد الطلاب (المبدئي)</label>
      <input type="number" name="no_students" class="form-control" min="0" required />
      <small class="text-muted">سيتم تحديث هذا الرقم تلقائيًا لاحقًا عند إضافة طلاب.</small>
    </div>
  </div>

  <div class="text-end">
    <button type="submit" class="btn btn-success">Add</button>
  </div>
</form>
      </div>
    </div>
  </div>
</div>

  </div>
</body>
</html>
