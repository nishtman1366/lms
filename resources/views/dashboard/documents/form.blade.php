@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">ارسال جزوه برای: <h3>{{$class->name}}</h3></div>
        @php
            if(!is_null($document)){
                $route=route('dashboard.classes.documents.update',['id'=>$class->id,'documentId'=>$document->id]);
            }else{
                $route=route('dashboard.classes.documents.create',['id'=>$class->id]);
            }
        @endphp
        <form id="document-form" action="{{$route}}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="class_id" value="{{$class->id}}">
            @csrf
            <div class="card-body row">
                <div class="col-12 col-md-6">
                    <div class="form-group text-right">
                        <label for="title">نام جزوه</label>
                        <input id="title" class="form-control" type="text" name="title"
                               value="{{!is_null($document) ? $document->title : null}}">
                    </div>
                    <div class="form-group text-right">
{{--                        <label for="description">توضیحات</label>--}}
                        <textarea name="description" id="description" placeholder="توضیحات"
                                  class="form-control">{{!is_null($document) ? $document->description : null}}</textarea>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="files">فایل ها</label>
                        <input class="form-control" type="file" id="files" name="files[]" multiple>
                    </div>
                    @if(!is_null($document) && count($document->files) > 0)
                        <div class="row">
                            <ul>
                                @foreach($document->files as $file)
                                    <li id="file-row-{{$file->id}}">
                                        <span class="file-list-item">{{$file->name}}</span> {{$file->fileSize}}
                                        <i class="fa fa-trash delete-file" data-file-id="{{$file->id}}">حذف</i></li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

            </div>
            <div class="card-footer text-left">
                <a href="{{route('dashboard.classes.view',['id'=>$class->id])}}" class="btn btn-secondary">انصراف</a>
                <button class="btn btn-success">ثبت</button>
            </div>
        </form>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $(".delete-file").click(function () {
                let fileId = $(this).attr('data-file-id');
                let row = '#file-row-' + fileId;
                $(row).remove();
                $("#document-form").append('<input type="hidden" name="deleteFiles[]" value="' + fileId + '">')
            });
        });
    </script>
@endpush