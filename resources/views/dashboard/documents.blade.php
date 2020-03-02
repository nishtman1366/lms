@extends('layouts.app')

@section('content')
    <div class="card">
        <a href="{{route('dashboard.documents.new')}}" id="add__new__item" type="button"
           class="btn btn-success position-absolute"><i class="fas fa-plus"></i>ثبت جزوه جدید</a>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">ردیف</th>
                <th scope="col">نام جزوه</th>
                <th scope="col">تعداد فایل ها</th>
                <th scope="col">نام استاد</th>
                <th scope="col">نام کلاس</th>
                <th scope="col">عملیات</th>
            </tr>
            </thead>
            <tbody>
            @php($i=1)
            @foreach($documents as $document)
                <tr>
                    <th scope="row">{{$i}}</th>
                    <td class="text-center">{{$document->title}}</td>
                    <td class="text-center">
                        <a href="{{route('dashboard.documents.view_files',['id'=>$document->id])}}">{{$document->files->count()}}</a>
                    </td>
                    <td class="text-center">
                        <a href="{{route('dashboard.professors.view_documents',['id'=>$document->id])}}">{{$document->professor->name}}</a>
                    </td>
                    <td class="text-center">
                        <a href="{{route('dashboard.lessons.view_documents',['id'=>$document->id])}}">{{$document->lesson->name}}</a>
                    </td>
                    <td class="text-center">
                        <a class="btn btn-sm btn-primary"
                           href="{{route('dashboard.documents.edit',['id'=>$document->id])}}"><i
                                class="fas fa-edit"></i>ویرایش</a>
                        <a class="btn btn-sm btn-danger"
                           href="{{route('dashboard.documents.delete',['id'=>$document->id])}}"><i
                                class="fas fa-trash-alt"></i>حذف</a>
                    </td>
                </tr>
                @php($i++)
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
