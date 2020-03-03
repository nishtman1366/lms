@extends('layouts.app')

@section('content')
    <div class="card">
        <a href="{{route('dashboard.classes.new')}}" id="add__new__item" type="button"
           class="btn btn-success position-absolute"><i class="fas fa-plus"></i>ثبت کلاس جدید</a>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">ردیف</th>
                <th scope="col">نام کلاس</th>
                <th scope="col">نام استاد</th>
                <th scope="col">نام درس</th>
                <th scope="col">تعداد دانشجویان</th>
                <th scope="col">عملیات</th>
            </tr>
            </thead>
            <tbody>
            @php($i=1)
            @foreach($classes as $class)
                <tr>
                    <th scope="row">{{$i}}</th>
                    <td class="text-center">{{$class->name}}</td>
                    <td class="text-center">
                        <a href="{{route('dashboard.professors.view_classes',['id'=>$class->id])}}">{{$class->professor->name}}</a>
                    </td>
                    <td class="text-center">
                        <a href="{{route('dashboard.lessons.view_classes',['id'=>$class->id])}}">{{$class->lesson->name}}</a>
                    </td>
                    <td class="text-center">
                        <a href="{{route('dashboard.classes.view_students',['id'=>$class->id])}}">{{$class->students->count()}}</a>
                    </td>
                    <td class="text-center">
                        <a class="btn btn-sm btn-primary"
                           href="{{route('dashboard.classes.edit',['id'=>$class->id])}}"><i
                                class="fas fa-edit"></i>ویرایش</a>
                        <a class="btn btn-sm btn-danger"
                           href="{{route('dashboard.classes.delete',['id'=>$class->id])}}"><i
                                class="fas fa-trash-alt"></i>حذف</a>
                    </td>
                </tr>
                @php($i++)
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
