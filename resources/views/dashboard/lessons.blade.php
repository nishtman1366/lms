@extends('layouts.app')

@section('content')
    <div class="card">
        <table class="table table-hover">
            <thead>
            <tr>
                <td colspan="5">
                    <a href="{{route('dashboard.lessons.new')}}" type="button"
                       class="btn btn-success"><i class="fa fa-plus p-1"></i>ثبت درس جدید</a>
                    <a href="#" type="button" data-toggle="modal"
                       data-target="#upload-lessons-modal"
                       class="btn btn-success"><i class="fa fa-upload p-1"></i>آپلود فایل دروس</a>
                </td>
            </tr>
            <tr>
                <th scope="col">ردیف</th>
                <th scope="col">نام درس</th>
                <th scope="col">کد درس</th>
                <th scope="col">تعداد جزوات</th>
                <th scope="col">عملیات</th>
            </tr>
            </thead>
            <tbody>
            @php($i=1)
            @foreach($lessons as $lesson)
                <tr>
                    <th scope="row">{{$i}}</th>
                    <td class="text-center">{{$lesson->name}}</td>
                    <td class="text-center">{{$lesson->code}}</td>
                    <td class="text-center">
                        <a href="{{route('dashboard.lessons.view_documents',['id'=>$lesson->id])}}">{{$lesson->documents->count()}}
                            <i class="fa fa-book"></i> </a>
                    </td>
                    <td class="text-center">
                        <a class="btn btn-sm btn-primary"
                           href="{{route('dashboard.lessons.edit',['id'=>$lesson->id])}}"><i
                                    class="fa fa-edit m-1"></i>ویرایش</a>
                        <a class="btn btn-sm btn-danger"
                           href="{{route('dashboard.lessons.delete',['id'=>$lesson->id])}}"><i
                                    class="fa fa-trash m-1"></i>حذف</a>
                    </td>
                </tr>
                @php($i++)
            @endforeach
            <tr>
                <td colspan="5">
                    {{$lessons->links()}}
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="upload-lessons-modal" tabindex="-1" role="dialog"
         aria-labelledby="upload-lessons-modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="upload-lessons-modalLabel">آپلود لیست دروس</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="lessons-form" action="{{route('dashboard.lessons.upload')}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <p class="alert alert-warning text-justify">
                            فایل باید به صورت متنی که هر سطر اطلاعات یک درس شامل کد درس و نام درس که به همین ترتیب ذکر
                            شده و بوسیله علامت , از هم جدا شده باشند.
                        </p>
                        <div class="form-group">
                            <label for="lessons_file">فایل حاوی اطلاعات دروس:</label>
                            <input type="file" class="form-control" name="lessons_file" id="lessons_file">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                    <button type="button" data-form-id="#lessons-form" class="btn btn-primary submit">ارسال</button>
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
