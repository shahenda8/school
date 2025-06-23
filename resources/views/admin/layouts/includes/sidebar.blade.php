  <div class="sidebar">
    <div class="profile">
      <img src="{{asset('images/profile.jpg')}}" alt="Profile Picture" />
      <h2>{{auth()->user()->name}}</h2>
      <p>{{auth()->user()->email}}</p>
    </div>
    <ul>

      @if(auth('teacher')->check())
       <li  class="{{request()->routeIs('teacher.dashboard')?'active':''}}"><a href="{{route('teacher.dashboard')}}"><i class="fa fa-home"></i>Dashboard</a></li>

       <li  class="{{request()->routeIs('class-managment')?'active':''}}"><a href="{{route('class-managment')}}"><i class="fas fa-bars-progress"></i>Class Managment</a></li>

       <li  class="{{request()->routeIs('subjects.index')?'active':''}}"><a href="{{route('subjects.index')}}"><i class="fab fa-discourse"></i>Subjects</a></li>
      <li  class="{{request()->routeIs('materials.index')?'active':''}}"><a href="{{route('materials.index')}}"><i class="fas fa-person-chalkboard"></i>Materials</a></li>
    
      <li  class="{{request()->routeIs('questions.index')?'active':''}}"><a href="{{route('questions.index')}}"><i class="fa fa-question"></i>Questions</a></li>
      <li  class="{{request()->routeIs('exams.index')?'active':''}}"><a href="{{route('exams.index')}}"><i class="fa fa-file"></i>Exams</a></li>
      @elseif(auth('manager')->check())
       <li  class="{{request()->routeIs('manager.dashboard')?'active':''}}"><a href="{{route('manager.dashboard')}}"><i class="fa fa-home"></i>Dashboard</a></li>
       <li  class="{{request()->routeIs('admin.teachers.create')?'active':''}}"><a href="{{route('admin.teachers.create')}}"><i class="fa fa-users-cogs"></i>Teacher</a></li>
       <li  class="{{request()->routeIs('admin.students.create')?'active':''}}"><a href="{{route('admin.students.create')}}"><i class="fa fa-users"></i>Students</a></li>
       <li  class="{{request()->routeIs('admin.guardians.create')?'active':''}}"><a href="{{route('admin.guardians.create')}}"><i class="fa fa-list"></i>Guardians</a></li>

      @endif
    </ul>
  </div>