@extends('layouts.app')
@section('title','Dyeing Factory')
@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <i class="fa fa-times-circle mx-2"></i>
                <strong>Error!</strong> {{$error}}!
            </div>
        @endforeach
    @endif
    @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <i class="fa fa-check mx-2"></i>
            <strong>Success!</strong> {{ session()->get('message') }}!
        </div>
    @endif
    <div class="main-content-container container-fluid px-4 mb-4">
        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-6 text-center text-sm-left mb-4 mb-sm-0">
                <span class="text-uppercase page-subtitle">Dyeing Manage</span>
                <h3 class="page-title">Buyer Details Entry</h3>
            </div>
            <div class="col-12 col-sm-6 d-flex align-items-center">
                <div class="d-inline-flex mb-sm-0 mx-auto ml-sm-auto mr-sm-0" role="group" aria-label="Page actions">
                    <a id="add-new-event" role="button" href="#" class="btn btn-primary" data-toggle="modal"
                       data-target="#exampleModal">
                        <i class="material-icons">add</i> New Buyer Entry</a>
                </div>
            </div>
        </div>
        @if(isset($edit))
            <div class="row">
                <div class="col-sm-12 mb-4">
                    <!-- Quick Post -->
                    <div class="card card-small h-100">
                        <div class="card-header border-bottom">
                            <h6 class="m-0">Update Buyer Details</h6>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <form class="quick-post-form" method="post"
                                  action="{{route('buyer.update',$edit->id)}}">
                                @csrf
                                @method('PUT')
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <select name="factory_id" class="form-control department" required>
                                            <option disabled>Select Factory</option>
                                            @foreach($factory as $factories)
                                                <option
                                                    value="{{$factories->id}}" {{$factories->id == $edit->factory_id? 'selected':''}}>{{$factories->factory_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control product" name="buyer"
                                               placeholder="Buyer Name" value="{{$edit->buyer}}">
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <button type="submit" class="btn btn-accent">Update</button>
                                    <a href="{{route('buyer.index')}}" role="button" class="btn btn-success mx-2">Close</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- End Quick Post -->
                </div>
            </div>
        @endif
        <table class="transaction-history d-none">
            <thead>
            <tr>
                <th>#</th>
                <th>Factory Name</th>
                <th>Buyer</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>@php $sl = 1; @endphp
            @foreach($buyer as $buyers)
                <tr>
                    <td>{{$sl}}</td>@php $sl++; @endphp
                    <td>{{$buyers->factory->factory_name}}</td>
                    <td>{{$buyers->buyer}}</td>
                    <td>
                        <div class="btn-group btn-group-sm" role="group" aria-label="Table row actions">
                            <button type="button" class="btn btn-white edit"
                                    href="{{route('buyer.edit',$buyers->id,'edit')}}">
                                <i class="material-icons">&#xE254;</i>
                            </button>
                            <button type="button" class="btn btn-white delete"
                                    href="{{route('buyer.destroy',$buyers->id)}}">
                                <i class="material-icons">&#xE872;</i>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="post" action="{{route('buyer.store')}}" autocomplete="off">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Buyer Details Entry</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <select name="factory_id" class="form-control department" required>
                                    <option selected disabled>Select Factory</option>
                                    @foreach($factory as $factories)
                                        <option value="{{$factories->id}}">{{$factories->factory_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control product" name="buyer"
                                       placeholder="Buyer Name">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('style')
    <link rel="stylesheet" href="{{asset('assets/styles/responsive.dataTables.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/sweetalert/sweetalert.css')}}"/>
@endpush
@push('script')
    <script src="{{asset('assets/scripts/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/scripts/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/scripts/app/app-transaction-history.1.3.1.min.js')}}"></script>
    <script src="{{asset('assets/sweetalert/sweetalert.js')}}"></script>
    <script>
        $('.delete').click(function (e) {
            e.preventDefault();
            let linkURL = $(this).attr("href");
            swal({
                title: "Sure want to delete?",
                text: "If you click 'OK' file will be deleted",
                type: "warning",
                showCancelButton: true
            }, function () {
                $.ajax({
                    type: "DELETE",
                    url: linkURL,
                    data: {_token: $('meta[name="csrf-token"]').attr('content')},
                    success: function (result) {
                        swal({
                            title: "Well Done",
                            text: "Buyer delete successfully",
                            type: "success",
                        }, function () {
                            location.reload();
                        })
                    },
                    error: function (result) {
                        if (result.status == 401) {
                            swal({
                                title: "Can't Delete",
                                text: "This buyer already use another table",
                                type: "warning",
                            })
                        } else {
                            swal({
                                title: "Something Wrong",
                                text: "Please try again later",
                                type: "warning",
                            })
                        }
                    }
                });
            });
        });

        $('.edit').click(function (e) {
            let linkURL = $(this).attr("href");
            window.location.href = linkURL;
        });
    </script>
@endpush

