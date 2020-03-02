@extends('layouts.app')

@section('content')
    <div class="card col-12 col-md-4 col-lg-3 m-auto p-0">
        @php
            if(!is_null($lesson)){
                $route=route('dashboard.lessons.update',['id'=>$lesson->id]);
            }else{
                $route=route('dashboard.lessons.create');
            }
        @endphp
        <form action="{{$route}}" method="post">
            @csrf
            <div class="card-header bg-dark text-light text-right">ثبت درس جدید</div>
            <div class="card-body">
                <div class="form-group text-right">
                    <label for="name">نام درس</label>
                    <input id="name" class="form-control" type="text" name="name"
                           value="{{!is_null($lesson) ? $lesson->name : null}}">
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary">ثبت</button>
            </div>
        </form>
    </div>
@endsection
