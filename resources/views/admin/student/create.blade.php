@extends('layouts.admin')

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
        <div class="content-body">
            <!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form"> إضافة طالب </h4>
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
                                    <form class="form" action="{{route('admin.student.store')}}" method="POST">
                                        @csrf
                                        {{-- <div class="form-group">
                                            <label> صوره القسم </label>
                                            <label id="projectinput7" class="file center-block">
                                                <input type="file" id="file" name="photo">
                                                <span class="file-custom"></span>
                                            </label>
                                            @error('photo')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div> --}}

                                        <div class="form-body">

                                            <h4 class="form-section"><i class="ft-home"></i> بيانات الطالب </h4>

                                            {{-- @if(get_languages() -> count() > 0) --}}
                                            {{-- @foreach(get_languages() as $index => $lang) --}}
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

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="projectinput2"> أختر المقر </label>
                                                        <select name="main_category_id" class="select2 form-control">
                                                            <optgroup label="من فضلك أختر المقر ">
                                                                @if($main_category && $main_category -> count() > 0)
                                                                @foreach($main_category as $category)
                                                                <option value="{{$category -> id }}">{{$category ->
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

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="projectinput2"> أختر الصف </label>
                                                        <select name="grade_id" class="select2 form-control">
                                                            <optgroup label="من فضلك أختر القسم ">
                                                                @if($grades && $grades -> count() > 0)
                                                                @foreach($grades as $grade)
                                                                <option value="{{$grade -> id }}">{{$grade ->
                                                                    name}}</option>
                                                                @endforeach
                                                                @endif
                                                            </optgroup>
                                                        </select>
                                                        @error('grade_id')
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="projectinput2"> أختر المجموعة </label>
                                                        <select name="group_id" class="select2 form-control">
                                                            <optgroup label="من فضلك أختر المجموعة ">
                                                                @if($groups && $groups -> count() > 0)
                                                                @foreach($groups as $group)
                                                                <option value="{{$group -> id }}">{{$group ->
                                                                    name}}</option>
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