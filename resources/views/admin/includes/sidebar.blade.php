<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
        <div class="main-menu-content">
                <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

                        <li class="nav-item"><a href="{{route('admin.dashboard')}}"><i
                                                class="la la-mouse-pointer"></i><span class="menu-title"
                                                data-i18n="nav.add_on_drag_drop.main">الرئيسية
                                        </span></a>
                        </li>


                        <li class="nav-item"><a href=""><i class="la la-home"></i>
                                        <span class="menu-title" data-i18n="nav.dash.main">المقرات الرئيسيه </span>
                                        <span
                                                class="badge badge badge-danger badge-pill float-right mr-2">{{App\Models\mainCategory::count()}}</span>
                                </a>
                                <ul class="menu-content">
                                        <li class="active"><a class="menu-item" href="{{route('admin.maincategories')}}"
                                                        data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                                        </li>
                                        <li><a class="menu-item" href="{{route('admin.maincategories.create')}}"
                                                        data-i18n="nav.dash.crypto">أضافة
                                                        مقر جديد </a>
                                        </li>
                                </ul>
                        </li>


                        <li class="nav-item"><a href=""><i class="la la-graduation-cap"></i>
                                        <span class="menu-title" data-i18n="nav.dash.main">الصفوف </span>
                                        <span
                                                class="badge badge badge-primary badge-pill float-right mr-2">{{App\Models\Grade::count()}}</span>
                                </a>
                                <ul class="menu-content">
                                        <li class="active"><a class="menu-item" href="{{route('admin.grades')}}"
                                                        data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                                        </li>
                                        <li><a class="menu-item" href="{{route('admin.grades.create')}}"
                                                        data-i18n="nav.dash.crypto">أضافة
                                                        صف جديد </a>
                                        </li>
                                </ul>
                        </li>


                        <li class="nav-item"><a href=""><i class="la la-group"></i>
                                        <span class="menu-title" data-i18n="nav.dash.main">المجموعات </span>
                                        <span
                                                class="badge badge badge-success badge-pill float-right mr-2">{{App\Models\Group::count()}}</span>
                                </a>
                                <ul class="menu-content">
                                        <li class="active"><a class="menu-item" href="{{route('admin.groups')}}"
                                                        data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                                        </li>
                                        <li><a class="menu-item" href="{{route('admin.groups.create')}}"
                                                        data-i18n="nav.dash.crypto">أضافة
                                                        مجموعة </a>
                                        </li>
                                </ul>
                        </li>


                        <li class="nav-item"><a href=""><i class="la la-male"></i>
                                        <span class="menu-title" data-i18n="nav.dash.main">الطلاب </span>
                                        <span
                                                class="badge badge badge-warning  badge-pill float-right mr-2">{{App\Models\Student::count()}}</span>
                                </a>
                                <ul class="menu-content">
                                        <li class="active"><a class="menu-item" href="{{route('admin.student')}}"
                                                        data-i18n="nav.dash.ecommerce">
                                                        عرض الكل </a>
                                        </li>
                                        <li><a class="menu-item" href="{{route('admin.student.create')}}"
                                                        data-i18n="nav.dash.crypto">أضافة
                                                        طالب </a>
                                        </li>
                                </ul>
                        </li>


                        <li class="nav-item"><a href=""><i class="la la-file-text-o"></i>
                                        <span class="menu-title" data-i18n="nav.dash.main">الامتحانات </span>
                                        <span
                                                class="badge badge badge-dark  badge-pill float-right mr-2">{{App\Models\Exam::count()}}</span>
                                </a>
                                <ul class="menu-content">
                                        <li class="active"><a class="menu-item" href="{{route('admin.exam')}}"
                                                        data-i18n="nav.dash.ecommerce">
                                                        عرض الكل </a>
                                        </li>
                                        <li><a class="menu-item" href="{{route('admin.exam.create')}}"
                                                        data-i18n="nav.dash.crypto">أضافة
                                                        امتحان جديد </a>
                                        </li>
                                </ul>
                        </li>


                        <li class="nav-item"><a href=""><i class="la la-dollar"></i>
                                        <span class="menu-title" data-i18n="nav.dash.main">المصروفات </span>
                                        <span
                                                class="badge badge badge-info  badge-pill float-right mr-2">{{App\Models\Month::count()}}</span>
                                </a>
                                <ul class="menu-content">
                                        <li class="active"><a class="menu-item"
                                                        href="{{route('admin.cash.month.index')}}"
                                                        data-i18n="nav.dash.ecommerce">
                                                        عرض الكل </a>
                                        </li>
                                        {{-- <li><a class="menu-item" href="{{route('admin.cash.month.create')}}"
                                                        data-i18n="nav.dash.crypto">أضافة
                                                        شهر جديد </a>
                                        </li> --}}
                                </ul>
                        </li>
        </div>
</div>