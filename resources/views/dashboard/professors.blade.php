@extends('layouts.app')

@section('content')
    <div class="card">
        <table class="table table-hover">
            <thead>
            <tr>
                <td colspan="3">
                    <a href="{{route('dashboard.professors.new')}}" type="button"
                       class="btn btn-success"><i class="fa fa-plus"></i>ثبت استاد جدید</a>
                    <a href="#" type="button" data-toggle="modal"
                       data-target="#upload-professors-modal"
                       class="btn btn-success"><i class="fa fa-upload p-1"></i>آپلود لیست اساتید</a>
                </td>
            </tr>
            <tr>
                <th scope="col">ردیف</th>
                <th scope="col">نام استاد</th>
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
                        <a class="btn btn-sm btn-primary"
                           href="{{route('dashboard.professors.edit',['id'=>$professor->id])}}"><i
                                    class="fa fa-edit p-1"></i></a>
                        <a class="btn btn-sm btn-danger"
                           href="{{route('dashboard.professors.delete',['id'=>$professor->id])}}"><i
                                    class="fa fa-trash p-1"></i></a>
                    </td>
                </tr>
                @php($i++)
            @endforeach
            <tr>
                <td colspan="3">
                    {{$professors->links()}}
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="upload-professors-modal" tabindex="-1" role="dialog"
         aria-labelledby="upload-professors-modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="upload-professors-modalLabel">آپلود لیست اساتید</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="professors-form" action="{{route('dashboard.professors.upload')}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <p class="alert alert-warning text-justify">
                            فایل باید به صورت متنی که هر سطر اطلاعات یکی از اساتید شامل نام، نام خانوادگی، شماره پرسنلی و کد ملی که به همین ترتیب ذکر
                            شده و بوسیله علامت , از هم جدا شده باشد.
                        </p>
                        <div class="form-group">
                            <label for="professors_file">فایل حاوی اطلاعات اساتید:</label>
                            <input type="file" class="form-control" name="professors_file" id="professors_file">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                    <button type="button" data-form-id="#professors-form" class="btn btn-primary submit">ارسال</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $(".submit").click(function () {
                let form = $(this).attr('data-form-id');
                $(form).submit();
            })
        });
    </script>
@endpush