@extends('layouts.app')

@section('content')
    <div class="card">
        <a href="{{route('dashboard.lessons.new')}}" id="add__new__item" type="button"
           class="btn btn-success position-absolute"><i class="fas fa-plus"></i>ثبت درس جدید</a>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">ردیف</th>
                <th scope="col">نام درس</th>
                <th scope="col">تعداد جزوات</th>
                <th scope="col">عملیات</th>
            </tr>
            </thead>
            <tbody>
            @php($i=1)
            @foreach($lessons as $lesson)
                <tr>
                    <th scope="row">{{$i}}</th>
                    <td class="text-center">{{$lesson->name}}</td>
                    <td class="text-center">
                        <a href="{{route('dashboard.lessons.view_documents',['id'=>$lesson->id])}}">{{$lesson->documents->count()}}</a>
                    </td>
                    <td class="text-center">
                        <a class="btn btn-sm btn-primary"
                           href="{{route('dashboard.lessons.edit',['id'=>$lesson->id])}}"><i
                                class="fas fa-edit"></i>ویرایش</a>
                        <a class="btn btn-sm btn-danger"
                           href="{{route('dashboard.lessons.delete',['id'=>$lesson->id])}}"><i
                                class="fas fa-trash-alt"></i>حذف</a>
                    </td>
                </tr>
                @php($i++)
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
