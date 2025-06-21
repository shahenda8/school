{{--  {{ $stages }}  --}}
<!DOCTYPE html><html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grades Management</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<script src="{{ asset('js/script.js') }}"></script>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="profile">
                <img src="profile.jpg" alt="Yomna">
                <p class="name">Yomna</p>
                <p class="email">Yomna@gmail.com</p>
            </div>
            <nav class="menu">
                <a href="#" class="active">Dashboard</a>
                <a href="#">Roles</a>
                <a href="#">Users</a>
                <a href="#" >Grades</a>
                <a href="#">Subjects</a>
                <a href="#">Subject materials</a>
                <a href="#">Ticketing support</a>
                <a href="#">PRE-EXAMS & RESULTS</a>
            </nav>
        </aside><main class="main">
        <header class="header">
            <h1>{{$type}} Dashbaord</h1>
        </header>

      <h1>welcome :{{$user->name}}<h1>

     
     
    </main>
</div>

</body>


</html>
