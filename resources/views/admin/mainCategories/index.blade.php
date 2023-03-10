@extends('layouts.admin')

@section('title','المقرات الرئيسية')
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title"> المقرات الرئيسية </h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item active"> المقرات الرئيسية
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body ">
            <!-- DOM - jQuery events table -->
            <section id="dom ">
                <div class="row">
                    <div class="col-12">
                        <div class="card border-primary">
                            <div class="card-header">
                                <h4 class="card-title">جميع المقرات الرئيسية </h4>
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

                            <div class="card-content collapse show ">
                                <div class="card-body card-dashboard">
                                    <table class="table display nowrap table-striped table-bordered ">
                                        <thead class="">
                                            <tr>
                                                <th>المقر </th>
                                                <th>الحالة</th>
                                                <th>الإجراءات</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @isset($categories)
                                            @foreach($categories as $category)
                                            <tr>
                                                <td>{{$category -> name}}</td>
                                                <td>{{$category -> getActive()}}</td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        @if(Auth::user()->addRole == 1)
                                                        <a href="{{route('admin.grades.create',$category -> id)}}"
                                                            class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">اضافة
                                                            صف</a>
                                                        @endif


                                                        <a href="{{route('admin.maincategories.show',$category -> id)}}"
                                                            class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">عرض
                                                            الصفوف</a>
                                                        @if(Auth::user()->EditRole == 1)
                                                        <a href="{{route('admin.maincategories.edit',$category -> id)}}"
                                                            class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>
                                                        @endif

                                                        @if(Auth::user()->DeleteRole == 1)
                                                        <a href="{{route('admin.maincategories.delete',$category -> id)}}"
                                                            class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">حذف</a>
                                                        @endif


                                                        @if(Auth::user()->ActiveRole == 1)
                                                        <a href="{{route('admin.maincategories.status',$category -> id)}}"
                                                            class="btn btn-outline-warning btn-min-width box-shadow-3 mr-1 mb-1">
                                                            @if($category -> active == 0)
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