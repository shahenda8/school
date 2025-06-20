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
                <a href="#">Dashboard</a>
                <a href="#">Roles</a>
                <a href="#">Users</a>
                <a href="#" class="active">Grades</a>
                <a href="#">Subjects</a>
                <a href="#">Subject materials</a>
                <a href="#">Ticketing support</a>
                <a href="#">PRE-EXAMS & RESULTS</a>
            </nav>
        </aside><main class="main">
        <header class="header">
            <h1>New Generation School</h1>
        </header>

        <section class="controls">
            <input type="text" class="bi bi-funnel" placeholder="Search...">

            <button class="filter-btn btn btn-outline-secondary">
                <i class="bi bi-funnel"></i>
            </button>

            <select>
                <option>CLASSES OF GRADE 1</option>
            </select>
            <button class="add-class">ADD CLASS</button>
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
                    <td class="actions">
                        <a href="#" class="bi bi-pencil"></a>
                        <a href="#" class="bi bi-trash3"></a>
                    </td>
                </tr>
    @endforeach

            </tbody>
        </table>

       {{--  <div class="pagination">
            <button>&laquo;</button>
            <button class="active">1</button>
            <button>2</button>
            <button>3</button>
            <button>&raquo;</button>
        </div>  --}}
    </main>
</div>

</body>


</html>
