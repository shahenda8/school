<!DOCTYPE html><html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grades & Class Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- <link rel="stylesheet" href="styles.css"> -->
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

.controls {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
}

.controls input[type=\"text\"] {
    flex: 1;
    padding: 8px;
}

.controls button, .controls select {
    padding: 8px 12px;
}

.add-class {
    background-color: #2e7d32;
    color: white;
    border: none;
    cursor: pointer;
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

.actions button {
    margin: 0 3px;
    padding: 4px 8px;
    cursor: pointer;
}

.pagination {
    text-align: center;
}

.pagination button {
    padding: 6px 12px;
    margin: 0 2px;
}

.pagination .active {
    background-color: #2e7d32;
    color: white;
}
     </style>
    <script src="script.js" defer></script>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="profile">
                <img src="profile.jpg" alt="Yomna">
                <p class="name">user name</p>
                <p class="email">user email</p>
            </div>
            <nav class="menu">
                <a href="#">Home</a>
            <a href="#">🧑‍🧒Personal Information</a>
            <a href="{{ route('view-class-table') }}">📋Classes Timetable</a>
            <a href="{{ route('exams.show') }}">📋Exams Timetable</a>
            <a href="{{ route('subjects.index') }}">📚Subjects & Materials</a>
            <a href="{{ route('student.pre_exams') }}" class="active">📋Pre-Exams</a>
            <a href="{{ route('student.results') }}">📊Results</a>
            </nav>
        </aside><main class="main">
        <header class="header">
            <h1>New Generation School</h1>
        </header>

        <table class="grades-table">
            <thead>
                <tr>
                    <th>Subjects</th>
                    <th>Coursework Marks</th>
                    <th>Final Exam</th>
                    <th>Total Degree</th>
                </tr>
            </thead>
<tbody>
    @foreach ($results as $row)
        <tr>
            <td>{{ $row['subject'] }}</td>
            <td>{{ $row['coursework'] }}</td>
            <td>{{ $row['final'] }}</td>
            <td>{{ $row['total'] }}</td>
        </tr>
    @endforeach
</tbody>
    </main>
</div>

</body>
</html>
