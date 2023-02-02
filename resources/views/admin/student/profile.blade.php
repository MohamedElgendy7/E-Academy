@extends('layouts.admin')

@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title"> ملف الطالب </h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item active"> الطلاب
                            </li>
                            <li class="breadcrumb-item active"> ملف طالب
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- DOM - jQuery events table -->
            <section id="dom">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"> بيانات الطالب -
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                            </div>

                            @include('admin.includes.alerts.success')
                            @include('admin.includes.alerts.errors')

                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <table class="table display nowrap table-striped table-bordered ">
                                        <thead class="">
                                            <tr>
                                                <th>الاسم </th>
                                                <th>الرقم </th>
                                                <th>رقم ولي الامر </th>
                                                <th>الحالة</th>
                                                <th> المقر </th>
                                                <th> الصف </th>
                                                <th> المجموعة </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @isset($student)
                                            {{-- @foreach($student as $info) --}}
                                            <tr>
                                                <td>{{$student -> name}}</td>
                                                <td>{{$student -> number}}</td>
                                                <td>{{$student -> Parentnumber}}</td>
                                                <td>{{$student -> getActive()}}</td>
                                                <td>{{$student ->mainCategory -> name}}</td>
                                                <td>{{$student ->grades -> name}}</td>
                                                <td>{{$student ->groups -> name}}</td>
                                            </tr>
                                            {{-- @endforeach --}}
                                            @endisset
                                        </tbody>
                                    </table>
                                    <div class="justify-content-center d-flex">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="content-body">
            <!-- DOM - jQuery events table -->
            <section id="dom">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"> غياب الطالب -
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                            </div>
                            <a href="{{route('download',$student ->id)}}" class="">

                                <div class="qr" style='text-align: center'>
                                    {{QrCode::size(200)
                                    ->format('png')
                                    ->generate
                                    ('http://'.domain.'/admin/absent/qr/'.$student->id,'public/qrcodes/'.$student->id.'.png')
                                    }}

                                    <img style="width: 150px; height: 150px;"
                                        src="{{'/public/qrcodes/'.$student->id.'.png'}}">
                                </div>
                            </a>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <table class="table display nowrap table-striped table-bordered ">
                                        <thead class="">
                                            </td>
                                            <tr>
                                                <th>اليوم </th>
                                                <th>الحالة</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @isset($absent)
                                            @foreach($absent as $info)
                                            <tr>
                                                <td>{{$info -> day}}</td>
                                                <td>{{$info -> getActive()}}</td>
                                            </tr>
                                            @endforeach
                                            @endisset
                                        </tbody>
                                    </table>
                                    <div class="justify-content-center d-flex">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="content-body">
            <!-- DOM - jQuery events table -->
            <section id="dom">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"> درجات الطالب -
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                            </div>

                            @include('admin.includes.alerts.success')
                            @include('admin.includes.alerts.errors')

                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <table class="table display nowrap table-striped table-bordered ">
                                        <thead class="">
                                            <tr>
                                                <th>الاختبار </th>
                                                <th>الدرجة</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @isset($degrees)
                                            @foreach($degrees as $degree)
                                            <tr>
                                                <td>{{App\Models\Exam::find($degree -> exam_id)->name}}</td>
                                                <td>{{$degree -> degree}}</td>
                                            </tr>
                                            @endforeach
                                            @endisset
                                        </tbody>
                                    </table>
                                    <div class="justify-content-center d-flex">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="content-body">
            <!-- DOM - jQuery events table -->
            <section id="dom">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"> مصرفات الطالب -
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                            </div>

                            @include('admin.includes.alerts.success')
                            @include('admin.includes.alerts.errors')

                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <table class="table display nowrap table-striped table-bordered ">
                                        <thead class="">
                                            <tr>
                                                <th>الشهر </th>
                                                <th>المدفوع</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @isset($cashs)
                                            @foreach($cashs as $cash)
                                            <tr>
                                                <td>{{App\Models\Month::find($cash -> month)->name}}</td>
                                                <td>{{$cash -> paid}}</td>
                                            </tr>
                                            @endforeach
                                            @endisset
                                        </tbody>
                                    </table>
                                    <div class="justify-content-center d-flex">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection