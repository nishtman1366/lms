@extends('layouts.app')

@section('content')
    <div class="card">
        <table class="table table-hover">
            <thead>
            <tr>
                <td colspan="6">
                    <a href="#" type="button" data-toggle="modal" data-target="#add-students-modal"
                       class="btn btn-success"><i class="fa fa-plus p-1"></i>اضافه کردن دانشجویان</a>
                    <a href="{{route('dashboard.documents.new')}}" type="button"
                       class="btn btn-danger"><i class="fa fa-trash p-1"></i>حذف دانشجویان انتخاب شده</a>
                </td>
            </tr>
            <tr>
                <th scope="col" colspan="2">ردیف</th>
                <th scope="col">نام دانشجو</th>
                <th scope="col">شماره دانشجویی</th>
                <th scope="col">رشته</th>
                <th scope="col">مقطع</th>
            </tr>
            </thead>
            <tbody>
            @php($i=1)
            @foreach($users as $user)
                <tr>
                    <th scope="row"><input class="form-check" type="checkbox" name="user_id[]" value="{{$user->id}}">
                    </th>
                    <th scope="row">{{$i}}</th>
                    <td class="text-center">{{$user->name}}</td>
                    <td class="text-center">{{$user->username}}</td>
                    <td class="text-center">{{$user->name}}</td>
                    <td class="text-center">{{$user->name}}</td>
                </tr>
                @php($i++)
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="add-students-modal" tabindex="-1" role="dialog"
         aria-labelledby="add-students-modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-students-modalLabel">اضافه کردن دانشجویان به کلاس</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="students" action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="students_id">شماره دانشجویی:</label>
                            <input class="form-control" type="text" name="students_id" id="students_id">
                            <span class="small text-danger">اگر تعداد دانشجویان بیشتر از یک نفر می باشد، شماره دانشجویی ها را با ',' از هم جدا کنید.</span>
                        </div>
                        <div class="form-group">
                            <label for="students_file">فایل شماره های دانشجویی:</label>
                            <input type="file" class="form-control" name="students_file" id="students_file">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                    <button type="button" data-form-id="#students" class="btn btn-primary submit">ارسال</button>
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
