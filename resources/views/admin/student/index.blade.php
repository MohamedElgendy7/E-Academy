@extends('layouts.admin')

@section('title','الطلاب')
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title"> الطلاب </h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item active"> الطلاب
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
                        <div class="card border-primary">
                            <div class="card-header">
                                <h4 class="card-title">جميع الطلاب </h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                    </ul>
                                </div>
                            </div>

                            @include('admin.includes.alerts.success')
                            @include('admin.includes.alerts.errors')

                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <table class="table display nowrap table-striped table-bordered scroll-horizontal">
                                        <thead class="">
                                            <tr>
                                                <th>الاسم </th>
                                                <th>الحالة</th>
                                                <th> المقر </th>
                                                <th> الصف </th>
                                                <th> المجموعة </th>
                                                <th>الإجراءات</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @isset($students)
                                            @foreach($students as $student)
                                            <tr>
                                                <td>{{$student -> name}}</td>
                                                <td>{{$student -> getActive()}}</td>
                                                <td>{{$student ->mainCategory -> name}}</td>
                                                <td>{{$student ->grades -> name}}</td>
                                                <td>{{$student ->groups -> name}}</td>
                                                {{-- <td> <img style="width: 150px; height: 100px;"
                                                        src="{{$Grade -> photo}}"></td> --}}
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        @if(Auth::user()->EditRole == 1)
                                                        <a href="{{route('admin.student.edit',$student -> id)}}"
                                                            class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>
                                                        @endif
                                                        @if(Auth::user()->DeleteRole == 1)
                                                        <a href="{{route('admin.student.delete',$student -> id)}}"
                                                            class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">حذف</a>
                                                        @endif

                                                        <a href="{{route('admin.student.profile',$student -> id)}}"
                                                            class="btn btn-outline-info btn-min-width box-shadow-3 mr-1 mb-1">ملف
                                                            الطالب</a>

                                                        @if(Auth::user()->ActiveRole == 1)
                                                        <a href="{{route('admin.student.status',$student -> id)}}"
                                                            class="btn btn-outline-warning btn-min-width box-shadow-3 mr-1 mb-1">
                                                            @if($student -> active == 0)
                                                            تفعيل
                                                            @else
                                                            الغاء تفعيل
                                                            @endif
                                                        </a>
                                                        @endif

                                                    </div>
                                                </td>
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