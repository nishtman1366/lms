@extends('layouts.app')

@section('content')
    <div class="card">
        <a href="{{route('dashboard.professors.new')}}" id="add__new__item" type="button"
           class="btn btn-success position-absolute"><i class="fas fa-plus"></i>ثبت استاد جدید</a>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">ردیف</th>
                <th scope="col">نام استاد</th>
                <th scope="col">تعداد جزوات</th>
                <th scope="col">عملیات</th>
            </tr>
            </thead>
            <tbody>
            @php($i=1)
            @foreach($professors as $professor)
                <tr>
                    <th scope="row">{{$i}}</th>
                    <td class="text-center">{{$professor->name}}</td>
                    <td class="text-center">
                        <a href="{{route('dashboard.professors.view_documents',['id'=>$professor->id])}}">{{$professor->documents->count()}}</a>
                    </td>
                    <td class="text-center">
                        <a class="btn btn-sm btn-primary"
                           href="{{route('dashboard.professors.edit',['id'=>$professor->id])}}"><i
                                class="fas fa-edit"></i>ویرایش</a>
                        <a class="btn btn-sm btn-danger"
                           href="{{route('dashboard.professors.delete',['id'=>$professor->id])}}"><i
                                class="fas fa-trash-alt"></i>حذف</a>
                    </td>
                </tr>
                @php($i++)
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
