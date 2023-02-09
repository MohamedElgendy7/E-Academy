@extends('layouts.admin')
@section('title','تسجيل مصروفات')
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
                            <li class="breadcrumb-item"><a href=""> المصروفات </a>
                            </li>
                            <li class="breadcrumb-item active">تسجيل مصروفات الطالب
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card border-primary">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form"> تسجيل المصروفات</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
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
                                <div class="card-body">
                                    <form class="form" action="{{route('admin.cash.store')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="super_id" value="{{Auth::user()->super_id}}">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput2"> أختر الطالب </label>
                                                    <select name="student_id" class="select2 form-control">
                                                        <optgroup label="من فضلك أختر الطالب ">
                                                            @if($students && $students -> count() > 0)
                                                            @foreach($students as $student)
                                                            <option value="{{$student ->id}}">{{$student ->
                                                                name}}</option>
                                                            @endforeach
                                                            @endif
                                                        </optgroup>
                                                    </select>
                                                    @error('student_id')
                                                    <span class="text-danger"> {{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput2"> أختر الشهر </label>
                                                    <select name="month" class="select2 form-control">
                                                        <optgroup label="من فضلك أختر الامتحان ">
                                                            @if($months && $months -> count() > 0)
                                                            @foreach($months as $month)
                                                            <option value="{{$month ->id}}">{{$month ->
                                                                name}}</option>
                                                            @endforeach
                                                            @endif
                                                        </optgroup>
                                                    </select>
                                                    @error('month')
                                                    <span class="text-danger"> {{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="projectinput1"> المبلغ </label>
                                                    <input type="text" value="" id="name" class="form-control"
                                                        placeholder="" name="paid">
                                                    @error("paid")
                                                    <span class="text-danger"> هذا الحقل مطلوب</span>
                                                    @enderror
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
        </div>
    </div>
    </section>
    <!-- // Basic form layout section end -->
</div>
</div>
</div>

@endsection