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
                <a href="{{ route('events.index') }}">🏠Home</a>
                <a href="{{ route('class.management') }}" class="active">📊Grades Managments</a>
                <a href="{{ route('attendance.index') }}">📋Record Attends</a>
                <a href="{{ route('attendance.reports') }}">📋Attends reports</a>
                <a href="{{ route('admin.events.create') }}">🗓️Create Event</a>
                <a href="{{ route('subjects.index') }}">📚Subject materials</a>
                {{--  <a href="exams.create">📝Create PRE-EXAMS</a>  --}}
            </nav>
        </aside><main class="main">
        <header class="header">
            <h1>New Generation School</h1>
        </header>

        <section class="controls">

                <button onclick="window.location.href='{{ route('admin.classes.create') }}'" class="add-class">
                    ADD CLASS
                </button>
                <button onclick="window.location.href='{{ route('exams.table.create') }}'" class="add-class">
                    ADD EXAM TIME TABLE
                </button>
                <button onclick="window.location.href='{{ route('admin.students.create') }}'" class="add-class">
                    ADD STUDENT
                </button>
                <button onclick="window.location.href='{{ route('admin.teachers.create') }}'" class="add-class">
                    ADD TEACHER
                </button>
                <button onclick="window.location.href='{{ route('admin.guardians.create') }}'" class="add-class">
                    ADD PARENTS
                </button>

                 </section>

        <table class="grades-table">
            <thead>
                <tr>
                @foreach($columnHeadName as $headName)
                    <th>{!! $headName !!}</th>
                 @endforeach

                </tr>
            </thead>
            <tbody>

{{--  {{ $stages }}  --}}

    @foreach ($data as $row)
                <tr>
            @foreach ($columnNames as $columnName)
                    <td>

                    {!! $row->{$columnName['column']} !!}
                    @if($columnName['link'] != null)
                        <a href="{{ $columnName['link'] }}/{{ $row->id }}" class="bi bi-eye"></a>
                    @endif
                    </td>
            @endforeach
                        @if(!empty($routes))
                    <td class="actions">

                                @if(!empty($routes['editLink']))
                                    <a href="#" class="bi bi-pencil"></a>
                                @endif

                                @if(!empty($routes['deleteLink']))
                                  <a href="{{ route($routes['deleteLink'] , $row->id) }}" class="bi bi-trash3"></a>
                                @endif

                    </td>
                        @endif
                </tr>
    @endforeach

            </tbody>
        </table>

    </main>
</div>

</body>


</html>
