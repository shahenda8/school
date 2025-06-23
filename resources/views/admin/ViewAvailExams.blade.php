<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pre-Exams</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }
        .container { display: flex; }
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
            width: 60px; height: 60px;
            border-radius: 50%;
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
        }
        .grades-table th, .grades-table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }
        .grades-table a {
            color: #2e7d32;
            text-decoration: underline;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container">
    <aside class="sidebar">
        <div class="profile">
            <img src="profile.jpg" alt="Student">
            <p class="name">{{ Auth::user()->name }}</p>
            <p class="email">{{ Auth::user()->email }}</p>
        </div>
        <nav class="menu">
            <a href="#">Home</a>
            <a href="#">Personal Information</a>
            <a href="#">Classes Timetable</a>
            <a href="#">Exams Timetable</a>
            <a href="#">Subjects & Materials</a>
            <a href="#" class="active">Pre-Exams</a>
            <a href="#">Homeworks</a>
            <a href="#">Results</a>
        </nav>
    </aside>

    <main class="main">
        <header class="header">
            <h1>New Generation School</h1>
        </header>

        <table class="grades-table">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Available Exam</th>
                    <th>Previous Exams</th>
                    <th>Cumulative Degree</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($results as $item)
                    <tr>
                        <td>{{ $item['subject'] }}</td>
                        <td>
                            @if ($item['available_exam'])
                                <a href="#">Available</a> 
                            @else
                                Not Available
                            @endif
                        </td>
                        <td>{{ $item['previous'] }}</td>
                        <td>{{ $item['cumulative'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</div>
</body>
</html>
