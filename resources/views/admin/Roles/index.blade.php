@extends('layouts.admin')

@section('title','صلاحيات فريق العمل')
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">صلاحيات فريق العمل </h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item active"> الصلاحيات
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
                                <h4 class="card-title">فريق العمل </h4>
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
                                                <th>الاسم</th>
                                                <th>الإجراءات</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @isset($admins)
                                            @foreach($admins as $admin)
                                            @if(!$admin->owner == Auth::user()->owner)
                                            <tr>
                                                <td>{{$admin -> name}}</td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Basic example">

                                                        <a href="{{route('admin.Roles.change',['admin_id'=>$admin->id,'role'=>'superRole'])}}"
                                                            @if($admin->superRole == 1)
                                                            class="btn btn-outline-success btn-min-width box-shadow-3
                                                            mr-1 mb-1"
                                                            @else
                                                            class="btn btn-outline-warning btn-min-width box-shadow-3
                                                            mr-1 mb-1"
                                                            @endif>
                                                            تغير الصلاحيات
                                                        </a>

                                                        <a href="{{route('admin.Roles.change',['admin_id'=>$admin->id,'role'=>'ExamRole'])}}"
                                                            @if($admin->ExamRole == 1)
                                                            class="btn btn-outline-success btn-min-width box-shadow-3
                                                            mr-1 mb-1"
                                                            @else
                                                            class="btn btn-outline-warning btn-min-width box-shadow-3
                                                            mr-1 mb-1"
                                                            @endif>
                                                            امتحان
                                                        </a>

                                                        <a href="{{route('admin.Roles.change',['admin_id'=>$admin->id,'role'=>'payRole'])}}"
                                                            @if($admin->payRole == 1)
                                                            class="btn btn-outline-success btn-min-width box-shadow-3
                                                            mr-1 mb-1"
                                                            @else
                                                            class="btn btn-outline-warning btn-min-width box-shadow-3
                                                            mr-1 mb-1"
                                                            @endif>
                                                            مصروفات
                                                        </a>

                                                        <a href="{{route('admin.Roles.change',['admin_id'=>$admin->id,'role'=>'videoRole'])}}"
                                                            @if($admin->videoRole == 1)
                                                            class="btn btn-outline-success btn-min-width box-shadow-3
                                                            mr-1 mb-1"
                                                            @else
                                                            class="btn btn-outline-warning btn-min-width box-shadow-3
                                                            mr-1 mb-1"
                                                            @endif>
                                                            فيديوهات
                                                        </a>

                                                        <a href="{{route('admin.Roles.change',['admin_id'=>$admin->id,'role'=>'docRole'])}}"
                                                            @if($admin->docRole == 1)
                                                            class="btn btn-outline-success btn-min-width box-shadow-3
                                                            mr-1 mb-1"
                                                            @else
                                                            class="btn btn-outline-warning btn-min-width box-shadow-3
                                                            mr-1 mb-1"
                                                            @endif>
                                                            ملفات
                                                        </a>

                                                        <a href="{{route('admin.Roles.change',['admin_id'=>$admin->id,'role'=>'addQuarterRole'])}}"
                                                            @if($admin->addQuarterRole == 1)
                                                            class="btn btn-outline-success btn-min-width box-shadow-3
                                                            mr-1 mb-1"
                                                            @else
                                                            class="btn btn-outline-warning btn-min-width box-shadow-3
                                                            mr-1 mb-1"
                                                            @endif>
                                                            اضافة مقر
                                                        </a>

                                                        <a href="{{route('admin.Roles.change',['admin_id'=>$admin->id,'role'=>'addGradeRole'])}}"
                                                            @if($admin->addGradeRole == 1)
                                                            class="btn btn-outline-success btn-min-width box-shadow-3
                                                            mr-1 mb-1"
                                                            @else
                                                            class="btn btn-outline-warning btn-min-width box-shadow-3
                                                            mr-1 mb-1"
                                                            @endif>
                                                            اضافة صف
                                                        </a>

                                                        <a href="{{route('admin.Roles.change',['admin_id'=>$admin->id,'role'=>'addGroupRole'])}}"
                                                            @if($admin->addGroupRole == 1)
                                                            class="btn btn-outline-success btn-min-width box-shadow-3
                                                            mr-1 mb-1"
                                                            @else
                                                            class="btn btn-outline-warning btn-min-width box-shadow-3
                                                            mr-1 mb-1"
                                                            @endif>
                                                            اضافة مجموعة
                                                        </a>

                                                        <a href="{{route('admin.Roles.change',['admin_id'=>$admin->id,'role'=>'addStudentRole'])}}"
                                                            @if($admin->addStudentRole == 1)
                                                            class="btn btn-outline-success btn-min-width box-shadow-3
                                                            mr-1 mb-1"
                                                            @else
                                                            class="btn btn-outline-warning btn-min-width box-shadow-3
                                                            mr-1 mb-1"
                                                            @endif>
                                                            اضافة طلاب
                                                        </a>

                                                        <a href="{{route('admin.Roles.change',['admin_id'=>$admin->id,'role'=>'EditRole'])}}"
                                                            @if($admin->EditRole == 1)
                                                            class="btn btn-outline-success btn-min-width box-shadow-3
                                                            mr-1 mb-1"
                                                            @else
                                                            class="btn btn-outline-warning btn-min-width box-shadow-3
                                                            mr-1 mb-1"
                                                            @endif>
                                                            تعديل بيانات
                                                        </a>

                                                        <a href="{{route('admin.Roles.change',['admin_id'=>$admin->id,'role'=>'DeleteRole'])}}"
                                                            @if($admin->DeleteRole == 1)
                                                            class="btn btn-outline-success btn-min-width box-shadow-3
                                                            mr-1 mb-1"
                                                            @else
                                                            class="btn btn-outline-warning btn-min-width box-shadow-3
                                                            mr-1 mb-1"
                                                            @endif>
                                                            حذف بيانات
                                                        </a>

                                                    </div>
                                                </td>
                                            </tr>
                                            @endif
                                            @endforeach
                                            @endisset
                                        </tbody>
                                    </table>
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