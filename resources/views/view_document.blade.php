@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h3>{{$document->title}}</h3>
            <div class="row">
                <div class="col-12 col-md-4">نام استاد: {{$document->professor->name}}</div>
                <div class="col-12 col-md-4">نام درس: {{$document->lesson->name}}</div>
            </div>
            <ul>
                @if(count($document->files) > 0)
                    @foreach($document->files as $file)
                        <li>
                            <a target="_blank" href="{{route('download',['id'=>$file->id])}}">
                                <span class="file-list-item">{{$file->name}}</span></a>
                            (حجم فایل: {{$file->fileSize}})
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
@endsection
