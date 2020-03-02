@extends('layouts.app')

@section('content')
    <div class="card col-12 col-md-6 col-lg-5 m-auto p-0">
        @php
            if(!is_null($document)){
                $route=route('dashboard.documents.update',['id'=>$document->id]);
            }else{
                $route=route('dashboard.documents.create');
            }
        @endphp
        <form id="document-form" action="{{$route}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-header bg-dark text-light text-right">ثبت جزوه جدید</div>
            <div class="card-body row">
                <div class="form-group col-12 text-right">
                    <label for="title">نام جزوه</label>
                    <input id="title" class="form-control" type="text" name="title"
                           value="{{!is_null($document) ? $document->title : null}}">
                </div>
                <div class="form-group col-12 col-md-6 text-right">
                    <label for="professor_id">نام استاد</label>
                    <select class="form-control" name="professor_id" id="professor_id" size="1">
                        <option value="">انتخاب کنید:</option>
                        @foreach($professors as $professor)
                            <option value="{{$professor->id}}" {{!is_null($document) && $document->professor_id==$professor->id ? 'selected' : ''}}>
                                {{$professor->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-12 col-md-6 text-right">
                    <label for="lesson_id">نام درس</label>
                    <select class="form-control" name="lesson_id" id="lesson_id" size="1">
                        <option value="">انتخاب کنید:</option>
                        @foreach($lessons as $lesson)
                            <option value="{{$lesson->id}}" {{!is_null($document) && $document->lesson_id==$lesson->id ? 'selected' : ''}}>
                                {{$lesson->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-12">
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
            <div class="card-footer">
                <button class="btn btn-primary">ثبت</button>
            </div>
        </form>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            console.log('jquery loaded');
            $(".delete-file").click(function () {
                let fileId = $(this).attr('data-file-id');
                let row = '#file-row-' + fileId;
                $(row).remove();
                $("#document-form").append('<input type="hidden" name="deleteFiles[]" value="' + fileId + '">')
            });
        });
    </script>
@endpush