@extends('layouts.admin')

@section('title','تعديل بيانات الطالب')
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
                            <li class="breadcrumb-item active"> تعديل
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
                                <h4 class="card-title" id="basic-layout-form"> تعديل بيانات طالب </h4>
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
                                    <form class="form" action="{{route('admin.student.update',$student -> id)}}"
                                        method="POST">
                                        @csrf


                                        <input name="id" value="{{$student -> id}}" type="hidden">
                                        {{--input for make valiedation of photo just for create not update--}}


                                        <div class="form-body">
                                            <h4 class="form-section"><i class="ft-home"></i> بيانات الطالب </h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> اسم الطالب
                                                        </label>
                                                        <input type="text" id="name" class="form-control" placeholder=""
                                                            value="{{$student -> name}}" name="name">
                                                        @error("name")
                                                        <span class="text-danger"> هذا الحقل مطلوب</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2"> أختر المقر </label>
                                                        <select name="main_category_id" class="select2 form-control">
                                                            <optgroup label="من فضلك أختر القسم ">
                                                                @if($mainCategory && $mainCategory -> count() > 0)
                                                                @foreach($mainCategory as $category)
                                                                <option value="{{$category -> id }}" @if($student ->
                                                                    main_category_id == $category -> id ) selected
                                                                    @endif>{{$category ->
                                                                    name}}</option>
                                                                @endforeach
                                                                @endif
                                                            </optgroup>
                                                        </select>
                                                        @error('main_category_id')
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2"> أختر الصف </label>
                                                        <select name="grade_id" class="select2 form-control">
                                                            <optgroup label="من فضلك أختر القسم ">
                                                                @if($grades && $grades -> count() > 0)
                                                                @foreach($grades as $grade)
                                                                <option value="{{$grade -> id }}" @if($student ->
                                                                    grade_id == $grade -> id ) selected @endif>
                                                                    {{$grade ->name}}
                                                                </option>
                                                                @endforeach
                                                                @endif
                                                            </optgroup>
                                                        </select>
                                                        @error('grade_id')
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2"> أختر المجموعة </label>
                                                        <select name="group_id" class="select2 form-control">
                                                            <optgroup label="من فضلك أختر القسم ">
                                                                @if($groups && $groups -> count() > 0)
                                                                @foreach($groups as $group)
                                                                <option value="{{$group -> id }}" @if($student ->
                                                                    group_id == $group -> id ) selected @endif>
                                                                    {{$group ->name}}
                                                                </option>
                                                                @endforeach
                                                                @endif
                                                            </optgroup>
                                                        </select>
                                                        @error('group_id')
                                                        <span class="text-danger"> {{$message}}</span>
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
                                                <i class="la la-check-square-o"></i> تحديث
                                            </button>
                                        </div>
                                    </form>
                                    <div class="tab-content px-1 pt-1">
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