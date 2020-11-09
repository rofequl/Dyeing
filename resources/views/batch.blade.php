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
                <th>Batch No.</th>
                <th>Order No.</th>
                <th>Work Order</th>
                <th>Compostion</th>
                <th>Stitch Length</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>@php $sl = 1; @endphp
            @foreach($batch as $batches)
                <tr>
                    <td>{{$sl}}</td>@php $sl++; @endphp
                    <td>{{$batches->order->factory->factory_name}}</td>
                    <td>{{$batches->batch_no}}</td>
                    <td>{{$batches->order_id}}</td>
                    <td>{{$batches->work_order}}</td>
                    <td>{{$batches->compostion}}</td>
                    <td>{{$batches->stitch_length}}</td>
                    <td>{{date('d F, Y', strtotime($batches->date))}}</td>
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
                                    <td>Buyer Name:</td>
                                    <td>
                                        <span class="buyer_name"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Style:</td>
                                    <td>
                                        <span class="style"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Colour:</td>
                                    <td>
                                        <span class="colour"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Work Order:</td>
                                    <td>
                                        <span class="work_order"></span>
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
                                <th scope="col" style="white-space: nowrap">FABRICS TYPE</th>
                                <th scope="col" style="white-space: nowrap">MC/DIA</th>
                                <th scope="col" style="white-space: nowrap">FINISH D/A</th>
                                <th scope="col" style="white-space: nowrap">MARK/HOLE</th>
                                <th scope="col" style="white-space: nowrap">Y/LOT</th>
                                <th scope="col" style="white-space: nowrap">Grey/WT</th>
                                <th scope="col" style="white-space: nowrap">ROLL</th>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
            integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
            crossorigin="anonymous"></script>
    <script>
        $('.view').click(function () {
            $(".AddPurchaseDiv").html('');
            let id = $(this).attr("id");
            $.ajax({
                url: "{!! route('batch.show','') !!}" + "/" + id,
                type: 'get',
                dataType: 'json',
                success: function (data) {
                    $('.factory_name').html(data.batch.order.factory.factory_name);
                    $('.batch_no').html(data.batch.batch_no);
                    $('.date').html(moment(data.batch.date).format('LL'));
                    $('.work_order').html(data.batch.work_order);
                    $('.compostion').html(data.batch.compostion);
                    $('.stitch_length').html(data.batch.stitch_length);
                    for (let i = 0; i < data.batch.batchlist.length; i++) {

                        var style, colour;
                        if (data.batch.batchlist[i].order_list.style == null) {
                            style = ''
                        } else {
                            style = data.batch.batchlist[i].order_list.style.style_name
                        }
                        if (data.batch.batchlist[i].order_list.colour == null) {
                            colour = ''
                        } else {
                            colour = data.batch.batchlist[i].order_list.colour.colour_name
                        }

                        $('.buyer_name').html(data.batch.batchlist[i].order_list.buyer.buyer);
                        $('.colour').html(colour);
                        $('.style').html(style);
                        $('.fab_type').html(data.batch.batchlist[i].order_list.fabrics_type);
                        $('.yarn_count').html(data.batch.batchlist[i].order_list.yarn_count);
                        $('.finish_gsm').html(data.batch.batchlist[i].order_list.gsm);

                        let product = '<tr>\n' +
                            '                                        <td>' + data.batch.batchlist[i].order_list.fabrics_type + '</td>\n' +
                            '                                        <td>' + data.batch.batchlist[i].order_list.dia + '</td>\n' +
                            '                                        <td>' + data.batch.batchlist[i].order_list.f_dia + '</td>\n' +
                            '                                        <td>' + data.batch.batchlist[i].mark_hole + '</td>\n' +
                            '                                        <td>' + data.batch.batchlist[i].y_lot + '</td>\n' +
                            '                                        <td>' + data.batch.batchlist[i].grey_wt + '</td>\n' +
                            '                                        <td>' + data.batch.batchlist[i].roll + '</td>\n' +
                            '                                    </tr>';
                        $(".AddPurchaseDiv").append(product);
                    }


                    $('#exampleModal').modal('show');
                }
            });
        });
    </script>
@endpush

