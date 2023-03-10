<div class="main-menu menu-fixed menu-accordion menu-shadow menu-dark " data-scroll-to-active="true">
        <div class="main-menu-content">
                <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

                        <li class="nav-item"><a href="{{route('admin.dashboard')}}"><i class="la la-calendar"></i><span
                                                class="menu-title" data-i18n="nav.add_on_drag_drop.main">الجدول
                                        </span></a>
                        </li>


                        <li class="nav-item"><a href=""><i class="la la-home"></i>
                                        <span class="menu-title" data-i18n="nav.dash.main">المقرات الرئيسيه </span>
                                        <span
                                                class="badge badge badge-danger badge-pill float-right mr-2">{{App\Models\mainCategory::user()->count()}}</span>
                                </a>
                                <ul class="menu-content">
                                        <li class="active"><a class="menu-item" href="{{route('admin.maincategories')}}"
                                                        data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                                        </li>
                                        @if(Auth::user()->addQuarterRole == 1)
                                        <li><a class="menu-item" href="{{route('admin.maincategories.create')}}"
                                                        data-i18n="nav.dash.crypto">أضافة
                                                        مقر جديد </a>
                                        </li>
                                        @endif
                                </ul>
                        </li>


                        <li class="nav-item"><a href=""><i class="la la-graduation-cap"></i>
                                        <span class="menu-title" data-i18n="nav.dash.main">الصفوف </span>
                                        <span
                                                class="badge badge badge-primary badge-pill float-right mr-2">{{App\Models\Grade::user()->count()}}</span>
                                </a>
                                <ul class="menu-content">
                                        <li class="active"><a class="menu-item" href="{{route('admin.grades')}}"
                                                        data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                                        </li>
                                </ul>
                        </li>


                        <li class="nav-item"><a href=""><i class="la la-group"></i>
                                        <span class="menu-title" data-i18n="nav.dash.main">المجموعات </span>
                                        <span
                                                class="badge badge badge-success badge-pill float-right mr-2">{{App\Models\Group::user()->count()}}</span>
                                </a>
                                <ul class="menu-content">
                                        <li class="active"><a class="menu-item" href="{{route('admin.groups')}}"
                                                        data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                                        </li>
                                </ul>
                        </li>


                        <li class="nav-item"><a href=""><i class="la la-male"></i>
                                        <span class="menu-title" data-i18n="nav.dash.main">الطلاب </span>
                                        <span
                                                class="badge badge badge-warning  badge-pill float-right mr-2">{{App\Models\Student::user()->count()}}</span>
                                </a>
                                <ul class="menu-content">
                                        <li class="active"><a class="menu-item" href="{{route('admin.student')}}"
                                                        data-i18n="nav.dash.ecommerce">
                                                        عرض الكل </a>
                                        </li>
                                </ul>
                        </li>

                        @if(Auth::user()->ExamRole == 1)
                        <li class="nav-item"><a href=""><i class="la la-file-text-o"></i>
                                        <span class="menu-title" data-i18n="nav.dash.main">الامتحانات </span>
                                        <span
                                                class="badge badge badge-dark  badge-pill float-right mr-2">{{App\Models\Exam::user()->count()}}</span>
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
                        @endif

                        @if(Auth::user()->payRole == 1)
                        <li class="nav-item"><a href=""><i class="la la-dollar"></i>
                                        <span class="menu-title" data-i18n="nav.dash.main">المصروفات </span>
                                        <span
                                                class="badge badge badge-info  badge-pill float-right mr-2">{{App\Models\Month::user()->count()}}</span>
                                </a>
                                <ul class="menu-content">
                                        <li class="active"><a class="menu-item"
                                                        href="{{route('admin.cash.month.index')}}"
                                                        data-i18n="nav.dash.ecommerce">
                                                        عرض الكل </a>
                                        </li>
                                </ul>
                        </li>
                        @endif

                        @if(Auth::user()->videoRole == 1)
                        <li class="nav-item"><a href=""><i class="la la-youtube"></i>
                                        <span class="menu-title" data-i18n="nav.dash.main">الفيديوهات </span>
                                        <span
                                                class="badge badge badge-danger  badge-pill float-right mr-2">{{App\Models\Video::user()->count()}}</span>
                                </a>
                                <ul class="menu-content">
                                        <li class="active"><a class="menu-item" href="{{route('admin.video.index')}}"
                                                        data-i18n="nav.dash.ecommerce">
                                                        عرض الكل </a>
                                        </li>
                                        <li class="active"><a class="menu-item" href="{{route('admin.video.create')}}"
                                                        data-i18n="nav.dash.ecommerce">
                                                        اضافة فيديو جديد</a>
                                        </li>
                                </ul>
                        </li>
                        @endif

                        @if(Auth::user()->docRole == 1)
                        <li class="nav-item"><a href=""><i class="la la-file"></i>
                                        <span class="menu-title" data-i18n="nav.dash.main">الملفات </span>
                                        <span
                                                class="badge bg-light text-dark  badge-pill float-right mr-2">{{App\Models\Doc::user()->count()}}</span>
                                </a>
                                <ul class="menu-content">
                                        <li class="active"><a class="menu-item" href="{{route('admin.doc.index')}}"
                                                        data-i18n="nav.dash.ecommerce">
                                                        عرض الكل </a>
                                        </li>
                                </ul>
                        </li>
                        @endif

                        @if(Auth::user()->superRole == 1)
                        <li class="nav-item"><a class="menu-item" href="{{route('admin.Roles.index')}}"
                                        data-i18n="nav.dash.ecommerce"><i class="la la-tags"></i>
                                        <span class="menu-title" data-i18n="nav.dash.main">الصلاحيات </span>
                                </a>
                        </li>
                        @endif
                </ul>
        </div>
</div>