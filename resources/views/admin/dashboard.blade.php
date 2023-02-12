@extends('layouts.admin')

@section('title','الجدول')
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-center">
                            <img src="clintes/{{Auth::user()->super_id}}/timetable.jpg" style="width:537px"
                                alt="جدول المواعيد">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Active Orders -->
        </div>
    </div>
</div>
@endsection