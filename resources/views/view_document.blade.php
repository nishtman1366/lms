@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h3>{{$document->title}}</h3>
            <div class="row">
                <span class="badge badge-danger m-1"><i class="fa fa-graduation-cap"></i> {{$document->professor->name}}</span>
                <span class="badge badge-success m-1"><i class="fa fa-book"></i> {{$document->lesson->name}}</span>
            </div>
            @if(count($document->files) > 0)
                @foreach($document->files as $file)
                    <p class="m-2 pr-3">
                        <a target="_blank" href="{{route('download',['id'=>$file->id])}}">
                            <span class="file-list-item"><i class="fa fa-download"></i> {{$file->name}}</span></a>
                        (حجم فایل: {{$file->fileSize}})
                    </p>
                @endforeach
            @endif
        </div>
    </div>
@endsection
