@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <a href="{{route('dashboard.professors.list')}}" class="btn btn-primary">
                                    لیست اساتید
                                </a>
                            </div>
                            <div class="col-12 col-md-6">
                                <a href="{{route('dashboard.lessons.list')}}" class="btn btn-primary">
                                لیست دروس
                                </a>
                            </div>
                            <div class="col-12 col-md-6">
                                <a href="{{route('dashboard.documents.list')}}" class="btn btn-primary">
                                    لیست جزوات
                                </a>
                            </div>
                            <div class="col-12 col-md-6">
                                <a href="{{route('dashboard.users.list')}}" class="btn btn-primary">
                                    لیست کاربران
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
