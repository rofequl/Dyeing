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
                <span class="text-uppercase page-subtitle"></span>
                <h3 class="page-title">Delivery Challan</h3>
            </div>
            <div class="col-12 col-sm-6 d-flex align-items-center">
                <div class="d-inline-flex mb-sm-0 mx-auto ml-sm-auto mr-sm-0" role="group" aria-label="Page actions">
                    <a id="add-new-event" href="{{route('delivery.entry')}}" class="btn btn-primary">
                        <i class="material-icons">add</i> Delivery Challan Add</a>
                </div>
            </div>
        </div>

        <table class="transaction-history d-none">
            <thead>
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Order No.</th>
                <th>Factory Name</th>
                <th>Batch No</th>
                <th>Challan No</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>@php $sl = 1; @endphp
            @foreach($delivery as $deliver)
                <tr>
                    <td>{{$sl}}</td>@php $sl++; @endphp
                    <td>{{date('d F, Y', strtotime($deliver->date))}}</td>
                    <td>{{$deliver->order_id}}</td>
                    <td>{{$deliver->order->factory->factory_name}}</td>
                    <td>{{implode(' ,',json_decode($deliver->batch_no))}}</td>
                    <td>{{$deliver->challan_no}}</td>
                    <td>
                        <div class="btn-group btn-group-sm" role="group" aria-label="Table row actions">
                            <button type="button" class="btn btn-white edit"
                                    href="{{route('delivery.challan',$deliver->id)}}">
                                <i class="material-icons">remove_red_eye</i>
                            </button>
                            <button type="button" class="btn btn-white delete"
                                    href="{{route('delivery.destroy',$deliver->id)}}">
                                <i class="material-icons">&#xE872;</i>
                            </button>
                        </div>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>

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
                            text: "Delivery challan delete successfully",
                            type: "success",
                        }, function () {
                            location.reload();
                        })
                    },
                    error: function (result) {
                        swal({
                            title: "Something Wrong",
                            text: "Please try again later",
                            type: "warning",
                        })
                    }
                });
            });
        });

        $('.edit').click(function (e) {
            let linkURL = $(this).attr("href");
            window.open(linkURL);
        });
    </script>
@endpush

