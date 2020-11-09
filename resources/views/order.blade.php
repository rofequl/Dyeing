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
                <h3 class="page-title">Order List</h3>
            </div>
            <div class="col-12 col-sm-6 d-flex align-items-center">
                <div class="d-inline-flex mb-sm-0 mx-auto ml-sm-auto mr-sm-0" role="group" aria-label="Page actions">
                    <a href="{{route('order.entry')}}" class="btn btn-primary">
                        <i class="material-icons">add</i> New Order Entry</a>
                </div>
            </div>
        </div>
        <table class="transaction-history d-none">
            <thead>
            <tr>
                <th>#</th>
                <th>Factory Name</th>
                <th>Order No</th>
                <th>Total Quantity</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>@php $sl = 1; @endphp
            @foreach($order as $orders)
                <tr>
                    <td>{{$sl}}</td>@php $sl++; @endphp
                    <td>{{$orders->factory->factory_name}}</td>
                    <td>{{$orders->id}}</td>
                    <td>{{$orders->total_qty}}</td>
                    <td>{{$orders->date}}</td>
                    <td>
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" class="btn btn-white view" id="{{$orders->id}}">
                                <i class="material-icons">
                                    remove_red_eye
                                </i>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div>
                        <h4 class="text-center mb-0">Dyeing Factory</h4>
                        <p class="text-center">Dhaka Bangladesh</p>
                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table border">
                                <tr>
                                    <td>Factory Name:</td>
                                    <td>
                                        <span class="factory_id"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Factory Address:</td>
                                    <td>
                                        <span class="factory_address"></span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table border">
                                <tr>
                                    <td>Date:</td>
                                    <td>
                                        <span class="date"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Total Qty:</td>
                                    <td>
                                        <span class="total_qty"></span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0 mt-4 text-center" style="width: 200%">
                            <thead class="bg-light">
                            <tr>
                                <th scope="col" style="white-space: nowrap">Order List No</th>
                                <th scope="col" style="white-space: nowrap">Buyer Name</th>
                                <th scope="col" style="white-space: nowrap">Style</th>
                                <th scope="col" style="white-space: nowrap">Work Order</th>
                                <th scope="col" style="white-space: nowrap">Yarn Count</th>
                                <th scope="col" style="white-space: nowrap">Fabrics Type</th>
                                <th scope="col" style="white-space: nowrap">MC/DIA</th>
                                <th scope="col" style="white-space: nowrap">F/DIA</th>
                                <th scope="col" style="white-space: nowrap">Grey GSM/S/L</th>
                                <th scope="col" style="white-space: nowrap">F/GSM</th>
                                <th scope="col" style="white-space: nowrap">Color</th>
                                <th scope="col" style="white-space: nowrap">Quantity</th>
                            </tr>
                            </thead>
                            <tbody class="AddPurchaseDiv">

                            </tbody>
                        </table>
                    </div>
                </div>
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
        $('.view').click(function () {
            let id = $(this).attr("id");
            $.ajax({
                url: "{!! route('order.show','') !!}" + "/" + id,
                type: 'get',
                dataType: 'json',
                success: function (data) {
                    $('.factory_id').html(data.order.factory.factory_name);
                    $('.factory_address').html(data.order.factory.address);
                    $('.date').html(data.order.date);
                    $('.total_qty').html(data.order.total_qty);
                    $(".AddPurchaseDiv").html('');
                    for (let i = 0; i < data.order.order_list.length; i++) {
                        var style, colour;
                        if (data.order.order_list[i].style == null) {
                            style = ''
                        } else {
                            style = data.order.order_list[i].style.style_name
                        }
                        if (data.order.order_list[i].colour == null) {
                            colour = ''
                        } else {
                            colour = data.order.order_list[i].colour.colour_name
                        }
                        let product = '<tr>\n' +
                            '                                        <td>' + data.order.order_list[i].id + '</td>\n' +
                            '                                        <td>' + data.order.order_list[i].buyer.buyer + '</td>\n' +
                            '                                        <td>' + style + '</td>\n' +
                            '                                        <td>' + data.order.order_list[i].work_order + '</td>\n' +
                            '                                        <td>' + data.order.order_list[i].yarn_count + '</td>\n' +
                            '                                        <td>' + data.order.order_list[i].fabrics_type + '</td>\n' +
                            '                                        <td>' + data.order.order_list[i].dia + '</td>\n' +
                            '                                        <td>' + data.order.order_list[i].f_dia + '</td>\n' +
                            '                                        <td>' + data.order.order_list[i].gray_gsm + '</td>\n' +
                            '                                        <td>' + data.order.order_list[i].gsm + '</td>\n' +
                            '                                        <td>' + colour + '</td>\n' +
                            '                                        <td>' + data.order.order_list[i].quantity + '</td>\n' +
                            '                                    </tr>';
                        $(".AddPurchaseDiv").append(product);
                        removenull();
                    }
                    $('#exampleModal').modal('show');
                }
            });
        });

        function removenull() {
            $(".AddPurchaseDiv tr td")
                .filter(function (index) {
                    if ($( this ).text() == 'null') {
                        return true;
                    }
                })
                .text('');
        }
    </script>
@endpush

