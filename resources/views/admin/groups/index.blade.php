@extends('layouts.admin')

@section('title','المجموعات')
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title"> المجموعات</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item active"> المجموعات
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
                                <h4 class="card-title">جميع المجموعات </h4>
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
                                    <table class="table display nowrap table-striped table-bordered table-responsive ">
                                        <thead class="">
                                            <tr>
                                                <th>اسم المجموعة </th>
                                                <th> المقر </th>
                                                <th> الصف </th>
                                                <th>الإجراءات</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @isset($groups)
                                            @foreach($groups as $group)
                                            <tr>
                                                <td @if($group -> active == 1) class="bg-success bg-lighten-5" @endif
                                                    class="bg-danger bg-lighten-5">{{$group -> name}}</td>
                                                {{-- <td>{{$group -> getActive()}}</td> --}}
                                                <td>{{$group ->main_category -> name}}</td>
                                                <td>{{$group ->grades -> name}}</td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Basic example">


                                                        <a href="{{route('admin.student.create',$group ->id)}}"
                                                            class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">اضافة
                                                            طالب</a>


                                                        <a href="{{route('admin.student.show',$group -> id)}}"
                                                            class="btn btn-outline-dark btn-min-width box-shadow-3 mr-1 mb-1">عرض
                                                            الطلاب</a>


                                                        <a href="{{route('admin.absent.students',$group -> id)}}"
                                                            class="btn btn-outline-info btn-min-width box-shadow-3 mr-1 mb-1">الغائبين
                                                        </a>


                                                        <a href="{{route('admin.degree.create',$group -> id)}}"
                                                            class="btn btn-outline-success btn-min-width box-shadow-3 mr-1 mb-1">
                                                            تسجيل درجات</a>


                                                        <a href="{{route('admin.degree.show',$group -> id)}}"
                                                            class="btn btn-outline-info btn-min-width box-shadow-3 mr-1 mb-1">عرض
                                                            نتائج امتحان
                                                        </a>


                                                        <a href="{{route('admin.cash.create',$group ->id)}}"
                                                            class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تسجيل
                                                            مصروفات</a>


                                                        <a href="{{route('admin.groups.status',$group -> id)}}"
                                                            class="btn btn-outline-warning btn-min-width box-shadow-3 mr-1 mb-1">
                                                            @if($group -> active == 0)
                                                            تفعيل
                                                            @else
                                                            الغاء تفعيل
                                                            @endif
                                                        </a>

                                                        <a href="{{route('admin.groups.edit',$group -> id)}}"
                                                            class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>

                                                        <a href="{{route('admin.groups.delete',$group -> id)}}"
                                                            class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">حذف</a>

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