@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header"><h3>{{$class->name}}</h3></div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-10 order-1 order-md-0">
                    <div class="row">
                        <div class="col-12 col-md-6 my-1">
                            <div class="card">
                                <div class="card-body bg-dark">
                                    <h4 class="text-success"><i class="fa fa-file-pdf-o"></i> جزوات این کلاس</h4>
                                    @if(count($class->documents) > 0)
                                        @foreach($class->documents as $document)
                                            <div class="row p-1 m-1">
                                                <div class="col-10">
                                                    <i class="fa fa-file-pdf-o m-1 text-primary"></i>
                                                    <span class="view-document-files text-primary"
                                                          style="cursor: pointer"
                                                          data-class-id="{{$class->id}}"
                                                          data-document-id="{{$document->id}}">{{$document->title}}</span>
                                                </div>
                                                <div class="col-1"><a
                                                            href="{{route('dashboard.classes.documents.edit',['id'=>$class->id,'documentId'=>$document->id])}}"><i
                                                                class="fa fa-edit text-primary"></i></a></div>
                                                <div class="col-1"><a class="delete"
                                                            href="{{route('api.dashboard.classes.documents.delete',['id'=>$class->id,'documentId'=>$document->id])}}"><i
                                                                class="fa fa-trash text-danger"></i></a></div>
                                            </div>
                                            <div class="dropdown-divider"></div>
                                        @endforeach
                                    @else
                                        <h5 class="alert alert-warning text-center">جزوه ای برای این کلاس ثبت نشده
                                            است.</h5>
                                    @endif
                                    <div class="text-left">
                                        <a href="{{route('dashboard.classes.documents.new',['id'=>$class->id])}}"
                                           class="btn btn-success">
                                            <i class="fa fa-plus m-1"></i>ثبت جزوه
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 my-1">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="text-success"><i class="fa fa-sticky-note"></i> تکالیف این کلاس</h4>
                                    @if(count($class->documents) > 0)

                                    @else
                                        <h5 class="alert alert-warning text-center">تکلیفی برای این کلاس ثبت نشده
                                            است.</h5>
                                    @endif
                                    <div class="text-left">
                                        <a href="#" class="btn btn-success">
                                            <i class="fa fa-plus m-1"></i>ثبت تکلیف
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 my-1">
                            <div class="card">
                                <div class="card-body bg-dark">
                                    <h4 class="text-success"><i class="fa fa-envelope"></i> پیام های استاد</h4>
                                    @if(count($class->documents) > 0)

                                    @else
                                        <h5 class="alert alert-warning text-center">پیامی برای این کلاس ثبت نشده
                                            است.</h5>
                                    @endif
                                    <div class="text-left">
                                        <a href="#" class="btn btn-success">
                                            <i class="fa fa-plus m-1"></i>ثبت پیام برای دانشجویان
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-2 order-0 order-md-1">
                    <p class="text-center">
                        <span style="font-size: 5rem" class="d-block">
                        <i class="fa fa-graduation-cap"></i></span>
                        {{$class->professor->name}}</p>
                </div>
            </div>
        </div>
    </div>
    @modal([
                                    'id'=>'document-files',
                                    'title'=>'لیست فایل ها',
                                        'buttons'=>[
                                            ['class'=>'primary','label'=>'بستن','dismiss'=>true]
                                        ]
                                    ])
    <div id="files-container">
        <h4 class="text-center text-primary">در حال بارگزاری اطلاعات...</h4>
    </div>
    @endmodal
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $(".view-document-files").click(function () {
                $('#document-files').modal();
                let classId = $(this).attr('data-class-id');
                let documentId = $(this).attr('data-document-id');
                axios.get('http://127.0.0.1:8000/api/classes/' + classId + '/documents/' + documentId + '/files')
                    .then(function (response) {
                        let html = '';
                        for (let i = 0; i < response.data.files.length; i++) {
                            html += '<div class="row">';
                            html += '<div class="col-7 text-truncate"><a href="' + response.data.files[i].url + '" target="_blank">' + response.data.files[i].name + '</a></div>';
                            html += '<div class="col-4">' + response.data.files[i].fileSize + '</div>';
                            html += '<div class="col-1">' +
                                '<i class="fa fa-trash text-danger"></i> ' +
                                '</div>';
                            html += '</div>';
                            html += '<div class="dropdown-divider"></div>';
                        }
                        $("#files-container").html(html);
                        console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
                    .then(function () {

                    });
            });
            $('.delete').click(function (e) {
                e.preventDefault();
                let url = $(this).attr('href');
                axios.delete(url)
                    .then(function (response) {
                        console.log(response)
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
                    .then(function () {

                    });
            });
        })
    </script>
@endpush