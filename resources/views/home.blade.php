@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12 col-md-3">
            <div class="card">
                <div class="card-header">
                    جدیدترین جزوات
                </div>
                <div class="card-body">
                    @if(isset($newest) && count($newest) > 0)
                        @foreach($newest as $item)
                            <a class="clearfix" href="{{route('view_document',['id'=>$item->id])}}">{{$item->title}}</a>
                            <span class="badge badge-success"><i class="fa fa-book"></i> {{$item->lesson->name}}</span>
                            <span class="badge badge-danger"><i class="fa fa-graduation-cap"></i> {{$item->professor->name}}</span>
                            <div class="dropdown-divider"></div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="col-12 col-md-9">
            <div class="card alert alert-warning">
                <div class="card-body">
                    <h3>قابل توجه اساتید و دانشجویان گرامی</h3>
                    <p>این سامانه جهت ارسال و دریافت فایل های مربوط به واحدهای درسی راه اندازی شده است.اساتید عزیز
                        میتوانند فایل
                        های خود را به پست الکترونیک webmaster@gau.ac.ir و یا learn.gau@gmail.com ارسال نمایند.</p>
                    <p>جهت دریافت اطلاعات بیشتر با شماره تلفن 01732437610 تماس حاصل فرمایید.</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{route('search')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <input placeholder="جستجوی جزوات"
                                   value="{{isset($query) && !is_null($query) ? $query : ''}}"
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
                                <a class="clearfix"
                                   href="{{route('view_document',['id'=>$result->id])}}">{{$result->title}}</a>
                                <span class="badge badge-primary"><i class="fa fa-download"></i> {{$result->files->count()}} فایل</span>
                                <span class="badge badge-success"><i class="fa fa-book"></i> {{$result->lesson->name}}</span>
                                <span class="badge badge-danger"><i class="fa fa-graduation-cap"></i> {{$result->professor->name}}</span>
                                <div class="dropdown-divider"></div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <h3 class="alert alert-danger text-center mt-1">نتیجه ای با جستجوی شما منطبق نمی باشد.</h3>
                @endif
            @endif
        </div>
    </div>

@endsection
