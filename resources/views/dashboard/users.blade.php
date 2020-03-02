@extends('layouts.app')

@section('content')
    <div class="card">
        <a href="{{route('dashboard.documents.new')}}" id="add__new__item" type="button"
           class="btn btn-success position-absolute"><i class="fas fa-plus"></i>ثبت کاربر جدید</a>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">ردیف</th>
                <th scope="col">نام کاربر</th>
                <th scope="col">نوع کاربر</th>
                <th scope="col">عملیات</th>
            </tr>
            </thead>
            <tbody>
            @php($i=1)
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{$i}}</th>
                    <td class="text-center">{{$user->name}}</td>
                    <td class="text-center">{{$user->typeName}}</td>
                    <td class="text-center">
                        <a class="btn btn-sm btn-primary"
                           href="{{route('dashboard.documents.edit',['id'=>$user->id])}}"><i
                                    class="fas fa-edit"></i>ویرایش</a>
                        <a class="btn btn-sm btn-danger"
                           href="{{route('dashboard.documents.delete',['id'=>$user->id])}}"><i
                                    class="fas fa-trash-alt"></i>حذف</a>
                    </td>
                </tr>
                @php($i++)
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
