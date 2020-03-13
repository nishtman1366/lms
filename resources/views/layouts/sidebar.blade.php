<ul class="nav flex-column flex-nowrap overflow-hidden">
    <li class="nav-item dropdown ml-auto">
        <img src="{{asset('assets/images/avatar.png')}}" class="w-25 m-1" style="float: right">
        <a class="nav-link collapsed" href="#" role="button"
           data-toggle="collapse" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }} <span class="caret"></span>
        </a>
        <div class="dropdown-menu dropdown-menu text-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('logout') }}">
                ویرایش اطلاعات
            </a>
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                خروج
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                  style="display: none;">
                @csrf
            </form>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link text-truncate" href="{{route('dashboard')}}"><i class="fa fa-home"></i> <span
                    class="d-none d-sm-inline">صفحه اصلی</span></a>
    </li>
    @role('student')
    <li class="nav-item">
        <a class="nav-link collapsed text-truncate" href="#classes_menu" data-toggle="collapse"
           data-target="#classes_menu"><i class="fa fa-table"></i> <span
                    class="d-none d-sm-inline">کلاس های آموزشی</span></a>
        <div class="collapse" id="classes_menu" aria-expanded="false">
            <ul class="flex-column nav">
                @foreach($userClasses as $class)
                    <li class="nav-item"><a class="nav-link"
                                            href="{{route('dashboard.classes.view',['id'=>$class->class_id])}}"><i
                                    class="fa fa-graduation-cap"></i> <span
                                    class="d-none d-sm-inline">{{$class->studentClass->name}}</span></a>
                    </li>
                @endforeach
            </ul>
        </div>
    </li>
    @endrole
    <li class="nav-item">
        <a class="nav-link collapsed text-truncate" href="#submenu1" data-toggle="collapse"
           data-target="#submenu1"><i class="fa fa-table"></i> <span
                    class="d-none d-sm-inline">آموزش</span></a>
        <div class="collapse show" id="submenu1" aria-expanded="true">
            <ul class="flex-column nav">
                <li class="nav-item"><a class="nav-link" href="{{route('dashboard.professors.list')}}"><i
                                class="fa fa-graduation-cap"></i> <span class="d-none d-sm-inline">مدیریت اساتید</span></a>
                </li>
                <li class="nav-item"><a class="nav-link" href="{{route('dashboard.students.list')}}"><i
                                class="fa fa-graduation-cap"></i> <span
                                class="d-none d-sm-inline">مدیریت دانشجویان</span></a>
                </li>
                <li class="nav-item"><a class="nav-link" href="{{route('dashboard.lessons.list')}}"><i
                                class="fa fa-book"></i> <span class="d-none d-sm-inline">مدیریت دروس</span></a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('dashboard.classes.list')}}"><i
                                class="fa fa-calendar"></i> <span class="d-none d-sm-inline">مدیریت کلاس ها</span></a>
                </li>
                <li class="nav-item"><a class="nav-link" href="{{route('dashboard.documents.list')}}"><i
                                class="fa fa-sticky-note"></i> <span class="d-none d-sm-inline">مدیریت جزوات</span></a>
                </li>
                {{--                                <li class="nav-item">--}}
                {{--                                    <a class="nav-link collapsed py-1" href="#submenu1sub1" data-toggle="collapse"--}}
                {{--                                       data-target="#submenu1sub1"><span>Customers</span></a>--}}
                {{--                                    <div class="collapse" id="submenu1sub1" aria-expanded="false">--}}
                {{--                                        <ul class="flex-column nav pl-4">--}}
                {{--                                            <li class="nav-item">--}}
                {{--                                                <a class="nav-link p-1" href="#">--}}
                {{--                                                    <i class="fa fa-fw fa-clock-o"></i> Daily </a>--}}
                {{--                                            </li>--}}
                {{--                                            <li class="nav-item">--}}
                {{--                                                <a class="nav-link p-1" href="#">--}}
                {{--                                                    <i class="fa fa-fw fa-dashboard"></i> Dashboard </a>--}}
                {{--                                            </li>--}}
                {{--                                            <li class="nav-item">--}}
                {{--                                                <a class="nav-link p-1" href="#">--}}
                {{--                                                    <i class="fa fa-fw fa-bar-chart"></i> Charts </a>--}}
                {{--                                            </li>--}}
                {{--                                            <li class="nav-item">--}}
                {{--                                                <a class="nav-link p-1" href="#">--}}
                {{--                                                    <i class="fa fa-fw fa-compass"></i> Areas </a>--}}
                {{--                                            </li>--}}
                {{--                                        </ul>--}}
                {{--                                    </div>--}}
                {{--                                </li>--}}
            </ul>
        </div>
    </li>
    <li class="nav-item"><a class="nav-link text-truncate" href="{{route('dashboard.users.list')}}"><i
                    class="fa fa-user"></i>
            <span class="d-none d-sm-inline">مدیریت کاربران</span></a></li>
    <li class="nav-item"><a class="nav-link text-truncate" href="#"><i class="fa fa-bar-chart"></i> <span
                    class="d-none d-sm-inline">گزارشات</span></a></li>
    <li class="nav-item"><a class="nav-link text-truncate" href="#"><i class="fa fa-gears"></i> <span
                    class="d-none d-sm-inline">تنظیمات</span></a></li>
    <li class="nav-item"><a class="nav-link text-truncate" href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">خروج</a>
    </li>
</ul>