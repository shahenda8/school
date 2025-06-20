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
                <a href="#">home</a>
                <a href="#">personal information</a>
                <a href="#">Users</a>
                <a href="#" >Grades</a>
                <a href="#" class="active">classes timetable</a>
                <a href="#">exams timetable</a>
            </nav>
        </aside><main class="main">
        <header class="header">
            <h1>New Generation School</h1>
        </header>

        <section class="controls">
            <!-- <input type="text" placeholder="Search...">
            <button class="filter-btn">Filter</button> -->
            <select>
                <option>Grade 1</option>
            </select>
            <select>
                <option>1/1</option>
            </select>
            <button class="add-class">ADD TIMETABLE</button>
        </section>

        <table class="grades-table">
            <thead>
                <tr>
                    <th>days</th>
                    <th>lec.1<br>(7:00-8:30)</th>
                    <th>lec.2<br>(8:30-10:00)</th>
                    <th>lec.3<br>(10:00-11:30)</th>
                    <th>lec.4<br>(12:00-13:30)</th>
                    <th>lec.5<br>(13:30-15:00)</th>
                    <th>lec.6<br>(15:00-16:30)</th>
                    <th>lec.7<br>(16:30-18:00)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
@php
    $day = null;
@endphp
                     <tr>
     @foreach ($data as $row)
            @if($row->day == $day || $day == null)
                 @if($day == null)
                                      <td>{{ $row->day }}</td>
                 @endif

                   {{--  <td>{{ $row->day }}</td>  --}}
                   <td>{{ $row->subject->name }} <br> <a href="{{ $row->teacher->email }}"> {{ $row->teacher->email }} </a></td>
                   @else
                    <td class="actions">
                       <a href="$row->class_model_id" class="bi bi-pencil"></a>
                       <a href="$row->class_model_id" class="bi bi-trash3"></a>
                   </td>

                   </tr>
                   <tr>
                     <td>{{ $row->day }}</td>
                     <td>{{ $row->subject->name }} <br> <a href="{{ $row->teacher->email }}"> {{ $row->teacher->email }} </a></td>
            @endif


@php
    $day = $row->day;
@endphp
    @endforeach
                        <td class="actions">
                       <a href="$row->class_model_id" class="bi bi-pencil"></a>
                       <a href="$row->class_model_id" class="bi bi-trash3"></a>
                   </td>
                       </tr>
                    {{--  <td class="actions">
                       <a href="#" class="bi bi-pencil"></a>
                       <a href="#" class="bi bi-trash3"></a>
                   </td>  --}}






                {{--  <tr>
                    <td>mon</td>
                    <td>20</td>
                    <td>7</td>
                    <td>7</td>
                    <td>7</td>
                    <td>7</td>
                    <td>7</td>
                    <td>7</td>
                    <td class="actions">
                         <a href="#" class="bi bi-pencil"></a>
                        <a href="#" class="bi bi-trash3"></a>

                    </td>
                </tr>
                <tr>
                    <td>tue</td>
                    <td>15</td>
                    <td>7</td>
                    <td>7</td>
                    <td>7</td>
                    <td>7</td>
                    <td>7</td>
                    <td>7</td>
                    <td class="actions">
                      <a href="#" class="bi bi-pencil"></a>
                        <a href="#" class="bi bi-trash3"></a>

                        <!-- <button>View</button>
                        <button>Edit</button>
                        <button>Delete</button> -->
                    </td>
                </tr>
                <tr>
                    <td>wed</td>
                    <td>20</td>
                    <td>7</td>
                    <td>7</td>
                    <td>7</td>
                    <td>7</td>
                    <td>7</td>
                    <td>7</td>
                    <td class="actions">
                    <!-- <a href="#" class="bi bi-eye"></a> -->
                        <a href="#" class="bi bi-pencil"></a>
                        <a href="#" class="bi bi-trash3"></a>
                    </td>
                </tr>

                <tr>
                    <td>thu</td>
                    <td>20</td>
                    <td>7</td>
                    <td>7</td>
                    <td>7</td>
                    <td>7</td>
                    <td>7</td>
                    <td>7</td>
                    <td class="actions">
                    <!-- <a href="#" class="bi bi-eye"></a> -->
                        <a href="#" class="bi bi-pencil"></a>
                        <a href="#" class="bi bi-trash3"></a>
                    </td>
                </tr>  --}}

            </tbody>
        </table>

        <!-- <div class="pagination">
            <button>&laquo;</button>
            <button class="active">1</button>
            <button>2</button>
            <button>3</button>
            <button>&raquo;</button>
        </div> -->
    </main>
</div>

</body>
</html>
