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
        <li class="nav-item"><a class="nav-link" href="#">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Roles</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Users</a></li>
        <li class="nav-item"><a class="nav-link active" href="#">Grades</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Subjects</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Subject materials</a></li>
        <li class="nav-item"><a class="nav-link " href="#">Question</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Exams</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Ticketing support</a></li>
      </ul>
    </div><!-- Main Content -->
<div class="main-content flex-grow-1">
  <div class="header text-center py-3">
    <h2 class="text-white">New Generation School</h2>
  </div>
  <div class="container py-4">
    <div class="card">
      <div class="card-body">
        <h4 class="mb-4">Add student</h4>
        @if (session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

@if ($errors->any())
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <ul class="mb-0">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif
<form action="{{ route('admin.students.store') }}" method="POST">
  @csrf

  <div class="row mb-3">
    <div class="col-md-3">
      <label class="form-label">اسم الطالب</label>
      <input type="text" name="name" class="form-control" required />
    </div>

    <div class="col-md-3">
      <label class="form-label">اسم المستخدم</label>
      <input type="text" name="user_name" class="form-control" required />
    </div>

    <div class="col-md-3">
      <label class="form-label">كلمة المرور</label>
      <input type="password" name="password" class="form-control" required />
    </div>

    <div class="col-md-3">
      <label class="form-label">تاريخ الميلاد</label>
      <input type="date" name="birth_date" class="form-control" required />
    </div>

    <div class="col-md-3">
      <label class="form-label">رقم الهاتف</label>
      <input type="text" name="phone" class="form-control" />
    </div>

    <div class="col-md-3">
      <label class="form-label">البريد الإلكتروني</label>
      <input type="email" name="email" class="form-control" />
    </div>

    <div class="col-md-3">
      <label class="form-label">الرقم القومي</label>
      <input type="text" name="national_id" class="form-control" />
    </div>

    <div class="col-md-3">
      <label class="form-label">العنوان</label>
      <input type="text" name="address" class="form-control" />
    </div>

    <div class="col-md-3">
      <label class="form-label">المرحلة الدراسية</label>
      <select name="stage_id" class="form-select" required>
        <option selected disabled>اختر المرحلة</option>
        @foreach($stages as $stage)
          <option value="{{ $stage->id }}">{{ $stage->name }}</option>
        @endforeach
      </select>
    </div>

    <div class="col-md-3">
      <label class="form-label">الفصل</label>
      <select name="class_model_id" class="form-select" required>
        <option selected disabled>اختر الفصل</option>
        @foreach($classes as $class)
          <option value="{{ $class->id }}">{{ $class->name }}</option>
        @endforeach
      </select>
    </div>

    <div class="col-md-3">
      <label class="form-label">ولي الأمر</label>
      <select name="guardian_id" class="form-select" required>
        <option selected disabled>اختر ولي الأمر</option>
        @foreach($guardians as $guardian)
          <option value="{{ $guardian->id }}">{{ $guardian->name }}</option>
        @endforeach
      </select>
    </div>
  </div>

  <div class="text-end">
    <button type="submit" class="btn btn-success">Add</button>
  </div>
</form>  </div>
    </div>
  </div>
</div>

  </div>
</body>
</html>
