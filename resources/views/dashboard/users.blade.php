@extends('layouts.app')

@section('content')
    <div class="card">
        <table class="table table-hover">
            <thead>
            <tr>
                <td colspan="7">
                    <div class="form-row">
                        <div class="col-12 col-md-4">
                            <a href="{{route('dashboard.users.new')}}" type="button"
                               class="btn btn-success"><i class="fa fa-plus p-1"></i>ثبت کاربر جدید</a>
                            <a href="#" type="button" data-toggle="modal"
                               data-target="#upload-users-modal"
                               class="btn btn-success"><i class="fa fa-upload p-1"></i>آپلود لیست کاربران</a>
                        </div>
                        <div class="col-12 col-md-4">
                            <select disabled name="users-groups" id="users-groups" size="1" class="form-control">
                                <option value="">اضافه کردن کاربران به:</option>
                                @foreach($groups as $group)
                                    <option value="{{$group->name}}">{{$group->display_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <input class="form-control" type="text" name="query"
                                   placeholder="جستجو در نام، نام خانوادگی، کد ملی و ...">
                        </div>
                        <div class="col-12 col-md-3">
                            <select name="users-groups" id="users-groups" size="1" class="form-control">
                                <option value="">همه کاربران</option>
                                @foreach($groups as $group)
                                    <option value="{{$group->name}}">{{$group->display_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-md-3">
                            <select name="users-groups" id="users-groups" size="1" class="form-control">
                                <option value="">همه کاربران</option>
                                <option value="">فعال</option>
                                <option value="1">غبرفعال</option>
                            </select>
                        </div>
                        <button class="btn btn-primary col-12 col-md-1">فیلتر</button>
                    </div>
                </td>
            </tr>
            <tr>
                <th scope="col" colspan="2">ردیف</th>
                <th scope="col">نام</th>
                <th scope="col">نام کاربری</th>
                <th scope="col">کد ملی</th>
                <th scope="col">نوع کاربری</th>
                <th scope="col">عملیات</th>
            </tr>
            </thead>
            <tbody>
            @php($i=1)
            @foreach($users as $user)
                <tr>
                    <th scope="row"><input class="form-check user-check" type="checkbox" name="user"
                                           value="{{$user->id}}"></th>
                    <th scope="row">{{$i}}</th>
                    <td class="text-center">{{$user->name}}</td>
                    <td class="text-center">{{$user->username}}</td>
                    <td class="text-center">{{$user->national_code}}</td>
                    <td class="text-center">{{$user->roles->first()->display_name}}</td>
                    <td class="text-center">
                        <a class="btn btn-sm btn-primary"
                           href="{{route('dashboard.users.edit',['id'=>$user->id])}}"><i
                                    class="fa fa-edit p-1"></i></a>
                        <a class="btn btn-sm btn-danger"
                           href="{{route('dashboard.users.delete',['id'=>$user->id])}}"><i
                                    class="fa fa-trash p-1"></i></a>
                    </td>
                </tr>
                @php($i++)
            @endforeach
            <tr>
                <td colspan="7">{{$users->links()}}</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="upload-users-modal" tabindex="-1" role="dialog"
         aria-labelledby="upload-users-modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="upload-users-modalLabel">آپلود لیست کاربران</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="users-form" action="{{route('dashboard.users.upload')}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <p class="alert alert-warning text-justify">
                            فایل باید به صورت متنی که هر سطر اطلاعات یک کاربر شامل کد ملی، نام خانوادگی و نام باشد که به
                            همین ترتیب ذکر
                            شده و بوسیله علامت , از هم جدا شده باشند.
                        </p>
                        <div class="form-group">
                            <label for="users_file">فایل حاوی اطلاعات کاربران:</label>
                            <input type="file" class="form-control" name="users_file" id="users_file">
                        </div>
                        <div class="form-group">
                            <label for="user_groups">گروه کاربران:</label>
                            <select name="user_groups" id="user_groups" class="form-control">
                                @foreach($groups as $group)
                                    <option value="{{$group->name}}">{{$group->display_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                    <button type="button" data-form-id="#users-form" class="btn btn-primary submit">ارسال</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $('.user-check').click(function () {
                if ($(this).prop("checked") === true) {
                    console.log("Checkbox is checked.");
                }
            });
            $(".submit").click(function () {
                let form = $(this).attr('data-form-id');
                $(form).submit();
            });
        });
    </script>
@endpush
