@extends('layouts.admin')

@section('title','أضافة طالب جديد')
@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">الرئيسية </a>
                            </li>
                            <li class="breadcrumb-item"><a href=""> الطلاب </a>
                            </li>
                            <li class="breadcrumb-item active">إضافة طالب
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body ">
            <!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card border-primary">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form"> إضافة طالب </h4>
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
                                <div class="card-body">
                                    <form class="form" action="{{route('admin.student.store')}}" method="POST">
                                        @csrf

                                        <div class="form-body">
                                            <h4 class="form-section"><i class="ft-home"></i> بيانات الطالب </h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> اسم الطالب </label>
                                                        <input type="text" value="" id="name" class="form-control"
                                                            placeholder="" name="name">
                                                        @error("name")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> رقم الطالب </label>
                                                        <input type="text" value="" id="number" class="form-control"
                                                            placeholder="" name="number">
                                                        @error("number")
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> رقم ولي امر الطالب </label>
                                                        <input type="text" value="" id="Parentnumber"
                                                            class="form-control" placeholder="" name="Parentnumber">
                                                        @error("Parentnumber")
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <input type="hidden" value="{{Auth::user()->super_id}}" name='super_id'>
                                                <input type="hidden" value="{{$group->main_category_id}}"
                                                    name='main_category_id'>
                                                <input type="hidden" value="{{$group->grade_id}}" name='grade_id'>
                                                <input type="hidden" value="{{$group->id}}" name='group_id'>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mt-1">
                                                        <input type="checkbox" value="1" name="active"
                                                            id="switcheryColor4" class="switchery" data-color="success"
                                                            checked />
                                                        <label for="switcheryColor4" class="card-title ml-1">
                                                            الحالة
                                                        </label>
                                                        @error("active")
                                                        <span class="text-danger"> </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-actions">
                                            <button type="button" class="btn btn-warning mr-1"
                                                onclick="history.back();">
                                                <i class="ft-x"></i> تراجع
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> حفظ
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- // Basic form layout section end -->
        </div>
    </div>
</div>

@endsection