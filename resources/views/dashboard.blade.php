@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body row">
                    <div class="col-12 col-md-4">
                        <h3>کلاس های شما</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>نام کلاس</th>
                                    <th>تعداد دانشجویان</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td class="text-center">درس فلان و بیسار</td>
                                    <td class="text-center">26</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
