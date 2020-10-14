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
                <h3 class="page-title">Batch List</h3>
            </div>
            <div class="col-12 col-sm-6 d-flex align-items-center">
                <div class="d-inline-flex mb-sm-0 mx-auto ml-sm-auto mr-sm-0" role="group" aria-label="Page actions">
                    <a href="{{route('batch.entry')}}" class="btn btn-primary">
                        <i class="material-icons">add</i> New Batch Entry</a>
                </div>
            </div>
        </div>
        <table class="transaction-history d-none">
            <thead>
            <tr>
                <th>#</th>
                <th>Factory Name</th>
                <th>Buyer Name</th>
                <th>Batch No.</th>
                <th>Order No.</th>
                <th>Style</th>
                <th>Colour</th>
                <th>Grey / WT</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>@php $sl = 1; @endphp
            @foreach($batch as $batches)
                <tr>
                    <td>{{$sl}}</td>@php $sl++; @endphp
                    <td>{{$batches->order_list->order->factory->factory_name}}</td>
                    <td>{{$batches->order_list->buyer->buyer}}</td>
                    <td>{{$batches->batch_no}}</td>
                    <td>{{$batches->order_list->order_id}}</td>
                    <td>{{$batches->order_list->style->style_name}}</td>
                    <td>{{$batches->order_list->colour->colour_name}}</td>
                    <td>{{$batches->gray_wt}}</td>
                    <td>{{$batches->date}}</td>
                    <td>
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" class="btn btn-white view" id="{{$batches->id}}">
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
                                        <span class="factory_name"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Batch No:</td>
                                    <td>
                                        <span class="batch_no"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Machine No:</td>
                                    <td>
                                        <span class="machine_no"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Buyer Name:</td>
                                    <td>
                                        <span class="buyer_name"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Po No:</td>
                                    <td>
                                        <span class="po_no"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Colour:</td>
                                    <td>
                                        <span class="colour"></span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table border">
                                <tr>
                                    <td>Current Date:</td>
                                    <td>
                                        <span class="date"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Compostion:</td>
                                    <td>
                                        <span class="compostion"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>FAB/TYPE:</td>
                                    <td>
                                        <span class="fab_type"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>YARN COUNT:</td>
                                    <td>
                                        <span class="yarn_count"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>STITCH LENGTH:</td>
                                    <td>
                                        <span class="stitch_length"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>FINISH/G.S.M:</td>
                                    <td>
                                        <span class="finish_gsm"></span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0 mt-4 text-center">
                            <thead class="bg-light">
                            <tr>
                                <th scope="col" style="white-space: nowrap">MC/DIA</th>
                                <th scope="col" style="white-space: nowrap">FINISH D/A</th>
                                <th scope="col" style="white-space: nowrap">MARK/HOLE</th>
                                <th scope="col" style="white-space: nowrap">Y/LOT</th>
                                <th scope="col" style="white-space: nowrap">Grey/WT</th>
                                <th scope="col" style="white-space: nowrap">ROLL</th>
                                <th scope="col" style="white-space: nowrap">FINISH W/T</th>
                            </tr>
                            </thead>
                            <tbody class="AddPurchaseDiv">
                            <td class="mc_dia"></td>
                            <td class="finish_dia"></td>
                            <td class="mark_hole"></td>
                            <td class="y_lot"></td>
                            <td class="gray_wt"></td>
                            <td class="roll"></td>
                            <td class="finish_wt"></td>
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
                url: "{!! route('batch.show','') !!}" + "/" + id,
                type: 'get',
                dataType: 'json',
                success: function (data) {
                    $('.factory_name').html(data.batch.order_list.order.factory.factory_name);
                    $('.batch_no').html(data.batch.batch_no);
                    $('.machine_no').html(data.batch.machine_no);
                    $('.buyer_name').html(data.batch.order_list.buyer.buyer);
                    $('.po_no').html(data.batch.po_no);
                    $('.colour').html(data.batch.order_list.colour.colour_name);
                    $('.date').html(data.batch.date);
                    $('.compostion').html(data.batch.compostion);
                    $('.fab_type').html(data.batch.order_list.fabrics_type);
                    $('.yarn_count').html(data.batch.order_list.yarn_count);
                    $('.stitch_length').html(data.batch.stitch_length);
                    $('.finish_gsm').html(data.batch.order_list.gsm);
                    $('.mc_dia').html(data.batch.order_list.dia);
                    $('.finish_dia').html(data.batch.order_list.f_dia);
                    $('.mark_hole').html(data.batch.mark_hole);
                    $('.y_lot').html(data.batch.y_lot);
                    $('.gray_wt').html(data.batch.gray_wt);
                    $('.roll').html(data.batch.order_list.roll);
                    $('.finish_wt').html(data.batch.Finish_wt);
                    $('#exampleModal').modal('show');
                }
            });
        });
    </script>
@endpush

