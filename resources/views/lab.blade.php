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
                <h3 class="page-title">LAB APP List</h3>
            </div>
            <div class="col-12 col-sm-6 d-flex align-items-center">
                <div class="d-inline-flex mb-sm-0 mx-auto ml-sm-auto mr-sm-0" role="group" aria-label="Page actions">
                    <a href="{{route('lab.entry')}}" class="btn btn-primary">
                        <i class="material-icons">add</i> New LAB Entry</a>
                </div>
            </div>
        </div>

        <table class="transaction-history d-none">
            <thead>
            <tr>
                <th>#</th>
                <th>Factory Name</th>
                <th>Buyer Name</th>
                <th>Order No.</th>
                <th>Style</th>
                <th>Colour</th>
                <th>LAB APP</th>
                <th>Grey Receive</th>
            </tr>
            </thead>
            <tbody>@php $sl = 1; @endphp
            @foreach($lab as $labs)
                <tr>
                    <td>{{$sl}}</td>@php $sl++; @endphp
                    <td>{{$labs->order->factory->factory_name}}</td>
                    <td>{{$labs->buyer->buyer}}</td>
                    <td>{{$labs->order_id}}</td>
                    <td>@if($labs->style) {{$labs->style->style_name}} @endif</td>
                    <td>@if($labs->colour) {{$labs->colour->colour_name}} @endif</td>
                    <td>{{$labs->lab_name}}</td>
                    <td>{{(int)$labs->grey_received - (int)$labs->batch_received}}</td>
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
@endpush
