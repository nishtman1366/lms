@extends('layouts.app')

@section('content')
    <div class="card col-12 col-md-6 col-lg-5 m-auto p-0">
        @php
            if(!is_null($class)){
                $route=route('dashboard.classes.update',['id'=>$class->id]);
            }else{
                $route=route('dashboard.classes.create');
            }
        @endphp
        <form id="class-form" action="{{$route}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-header bg-dark text-light text-right">ثبت کلاس جدید</div>
            <div class="card-body row">
                <div class="form-group col-12 col-md-6 text-right">
                    <label for="professor_id">نام استاد</label>
                    <select class="form-control" name="professor_id" id="professor_id" size="1">
                        <option value="">انتخاب کنید:</option>
                        @foreach($professors as $professor)
                            <option data-title="{{$professor->name}}" value="{{$professor->id}}" {{!is_null($class) && $class->professor_id==$professor->id ? 'selected' : ''}}>{{$professor->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-12 col-md-6 text-right">
                    <label for="lesson_id">نام درس</label>
                    <select class="form-control" name="lesson_id" id="lesson_id" size="1">
                        <option value="">انتخاب کنید:</option>
                        @foreach($lessons as $lesson)
                            <option data-title="{{$lesson->name}}" value="{{$lesson->id}}" {{!is_null($class) && $class->lesson_id==$lesson->id ? 'selected' : ''}}>{{$lesson->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-12 text-right">
                    <label for="name">نام کلاس</label>
                    <input id="name" class="form-control" type="text" name="name"
                           value="{{!is_null($class) ? old('name',$class->name) : old('name')}}">
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary">ثبت</button>
            </div>
        </form>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $("#lesson_id").change(function () {
                $('#name').val($(this).find('option:selected').text() + ' - ' + $("#professor_id").find('option:selected').text());
            });
            $("#professor_id").change(function () {
                $('#name').val($("#lesson_id").find('option:selected').text() + ' - ' + $(this).find('option:selected').text());
            });
        });
    </script>
@endpush