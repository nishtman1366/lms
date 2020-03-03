@extends('layouts.app')

@section('content')
    <div class="card alert alert-warning">
        <div class="card-body">
            <h3>قابل توجه اساتید و دانشجویان گرامی</h3>
            <p>این سامانه جهت ارسال و دریافت فایل های مربوط به واحدهای درسی راه اندازی شده است.اساتید عزیز میتوانند فایل
                های خود را به پست الکترونیک webmaster@gau.ac.ir و یا learn.gau@gmail.com ارسال نمایند.</p>
            <p>جهت دریافت اطلاعات بیشتر با شماره تلفن 01732437610 تماس حاصل فرمایید.</p>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{route('search')}}" method="post">
                @csrf
                <div class="form-group">
                    <input placeholder="جستجوی جزوات" value="{{isset($query) && !is_null($query) ? $query : ''}}"
                           class="form-control form-control-lg form-control-borderless" type="text" name="query"
                           id="query">
                </div>
                <div class="text-left">
                    <button class="btn btn-success">جستجو</button>
                </div>
            </form>
        </div>
    </div>
    @if(isset($results))
        @if(count($results) > 0)
            <div class="card mt-1">
                <div class="card-body search-result">
                    @foreach($results as $result)
                        <p class="title d-inline">
                            <a href="{{route('view_document',['id'=>$result->id])}}">{{$result->title}}</a>
                        </p>
                        <p class="description d-inline">
                            تعداد فایل ها: {{$result->files->count()}} - نام درس: {{$result->lesson->name}} - نام
                            استاد: {{$result->professor->name}}
                        </p>
                        <div class="dropdown-divider"></div>
                    @endforeach
                </div>
            </div>
        @else
            <h3 class="alert alert-danger text-center mt-1">نتیجه ای با جستجوی شما منطبق نمی باشد.</h3>
        @endif
    @endif
@endsection
