@extends('layouts.app')

@section('content')
    <div class="card">
        <a href="{{route('dashboard.documents.new')}}" id="add__new__item" type="button"
           class="btn btn-success position-absolute"><i class="fas fa-plus"></i>ثبت جزوه جدید</a>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col" colspan="2">ردیف</th>
                <th scope="col">نام دانشجو</th>
                <th scope="col">شماره دانشجویی</th>
                <th scope="col">رشته</th>
                <th scope="col">مقطع</th>
            </tr>
            </thead>
            <tbody>
            @php($i=1)
            @foreach($users as $user)
                <tr>
                    <th scope="row"><input class="form-check" type="checkbox" name="user_id[]" value="{{$user->id}}"></th>
                    <th scope="row">{{$i}}</th>
                    <td class="text-center">{{$user->name}}</td>
                    <td class="text-center">{{$user->username}}</td>
                    <td class="text-center">{{$user->name}}</td>
                    <td class="text-center">{{$user->name}}</td>
                </tr>
                @php($i++)
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
