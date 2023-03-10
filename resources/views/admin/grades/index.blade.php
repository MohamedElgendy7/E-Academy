@extends('layouts.admin')

@section('title','الصفوف')
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title"> الصفوف</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item active"> الصفوف
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
                                <h4 class="card-title">جميع الصفوف </h4>
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
                                    <table class="table display nowrap table-striped table-bordered">
                                        <thead class="">
                                            <tr>
                                                <th>الصف </th>
                                                <th>الحالة</th>
                                                <th> المقر </th>
                                                <th>الإجراءات</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @isset($grades)
                                            @foreach($grades as $Grade)
                                            <tr>
                                                <td>{{$Grade -> name}}</td>
                                                <td>{{$Grade -> getActive()}}</td>
                                                <td>{{$Grade ->main_category ->name}}</td>
                                                {{-- <td> <img style="width: 150px; height: 100px;"
                                                        src="{{$Grade -> photo}}"></td> --}}
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        @if(Auth::user()->addRole == 1)
                                                        <a href="{{route('admin.groups.create',$Grade -> id)}}"
                                                            class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">اضافة
                                                            مجموعة</a>
                                                        @endif
                                                        @if(Auth::user()->docRole == 1)
                                                        <a href="{{route('admin.doc.create',$Grade -> id)}}"
                                                            class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">اضافة
                                                            ملف</a>
                                                        @endif

                                                        <a href="{{route('admin.grades.show',$Grade -> id)}}"
                                                            class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">عرض
                                                            المجموعات</a>

                                                        @if(Auth::user()->EditRole == 1)
                                                        <a href="{{route('admin.grades.edit',$Grade -> id)}}"
                                                            class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>
                                                        @endif

                                                        @if(Auth::user()->DeleteRole == 1)
                                                        <a href="{{route('admin.grades.delete',$Grade -> id)}}"
                                                            class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">حذف</a>
                                                        @endif

                                                        @if(Auth::user()->ActiveRole == 1)
                                                        <a href="{{route('admin.grades.status',$Grade -> id)}}"
                                                            class="btn btn-outline-warning btn-min-width box-shadow-3 mr-1 mb-1">
                                                            @if($Grade -> active == 0)
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