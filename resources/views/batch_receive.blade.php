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
                <h3 class="page-title">Batch Entry</h3>
            </div>
        </div>

        <div class="card p-0 py-3 mb-4 text-center">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-4 col-5 text-right">Order No.</div>
                        <div class="form-group col-md-6 col-7">
                            <input type="text" id="order_no" class="form-control"
                                   placeholder="Please enter order number.">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="spinner-border" style="display: none">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>

            <table class="table" id="order_table" style="display:none;">
                <thead class="bg-light">
                <tr>
                    <th scope="col" class="border-0"></th>
                    <th scope="col" class="border-0">Factory Name</th>
                    <th scope="col" class="border-0">Buyer Name</th>
                    <th scope="col" class="border-0">Style</th>
                    <th scope="col" class="border-0">Fabrics Type</th>
                    <th scope="col" class="border-0">Color</th>
                    <th scope="col" class="border-0">Grey Quantity</th>
                    <th scope="col" class="border-0">LAB APP</th>
                </tr>
                </thead>
                <tbody class="AddPurchaseDiv">

                </tbody>
            </table>

        </div>

        <div class="card card-small mb-4">
            <div class="card-header border-bottom text-right">
                    <span onclick="window.location.href='{{route('batch.index')}}'" class="mb-0 right-hand"
                          style="cursor: pointer"><i
                            class="fas fa-hand-point-left"></i> Go back </span>
            </div>
            <div class="card-body p-0 text-center">
                <form method="post" action="{{route('batch.store')}}" id="upload_form"
                      enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="row p-3">
                        <div class="col-md-6">
                            <div class="row" id="member_id">
                                <div class="col-md-4 col-5 text-right">Factory Name</div>
                                <div class="form-group col-md-6 col-7">
                                    <input type="text" class="form-control factory_name"
                                           placeholder="Factory Name" readonly>
                                    <input type="hidden" name="order_id" class="order_id" required>
                                </div>
                            </div>
                            <div class="row" id="member_id">
                                <div class="col-md-4 col-5 text-right">Batch No.</div>
                                <div class="form-group col-md-6 col-7">
                                    <input type="text" name="batch_no" class="form-control batch_no"
                                           placeholder="Enter Batch No." required>
                                </div>
                            </div>
                            <div class="row" id="member_id">
                                <div class="col-md-4 col-5 text-right">Buyer Name</div>
                                <div class="form-group col-md-6 col-7">
                                    <input type="text" class="form-control buyer_name"
                                           placeholder="Buyer Name" readonly>
                                </div>
                            </div>
                            <div class="row" id="member_id">
                                <div class="col-md-4 col-5 text-right">Style</div>
                                <div class="form-group col-md-6 col-7">
                                    <input type="text" class="form-control style"
                                           placeholder="Style." readonly>
                                </div>
                            </div>
                            <div class="row" id="member_id">
                                <div class="col-md-4 col-5 text-right">Colour</div>
                                <div class="form-group col-md-6 col-7">
                                    <input type="text" class="form-control colour"
                                           placeholder="Colour" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-5 text-right">Work Order</div>
                                <div class="form-group col-md-6 col-7">
                                    <input type="text" class="form-control" name="work_order"
                                           placeholder="Enter Work Order">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row mt-2">
                                <div class="col-md-6 col-5 text-right">Current Date</div>
                                <div class="input-daterange input-group input-group-sm ml-auto col-md-6 col-7">
                                    <input type="text" class="input-sm form-control datepicker" name="date"
                                           placeholder="Date" max="255" id="analytics-overview-date-range-1" required>
                                    <span class="input-group-append">
                                            <span class="input-group-text">
                                              <i class="material-icons">&#xE916;</i>
                                            </span>
                                          </span>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6 col-5 text-right">Compostion</div>
                                <div class="form-group col-md-6 col-7">
                                    <input type="text" class="form-control compostion" name="compostion"
                                           placeholder="Compostion">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-5 text-right">FAB/TYPE</div>
                                <div class="form-group col-md-6 col-7">
                                    <input type="text" class="form-control fab_type"
                                           placeholder="FAB/TYPE" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-5 text-right">YARN COUNT</div>
                                <div class="form-group col-md-6 col-7">
                                    <input type="text" class="form-control yarn_count"
                                           placeholder="YARN COUNT" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-5 text-right">STITCH LENGTH</div>
                                <div class="form-group col-md-6 col-7">
                                    <input type="text" class="form-control stitch_length" name="stitch_length"
                                           placeholder="STITCH LENGTH">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-5 text-right">FINISH/G.S.M</div>
                                <div class="form-group col-md-6 col-7">
                                    <input type="text" class="form-control finish_gsm"
                                           placeholder="FINISH/G.S.M" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table mb-0 mt-4">
                            <thead class="bg-light">
                            <tr>
                                <th scope="col" style="white-space: nowrap">FABRICS TYPE</th>
                                <th scope="col" style="white-space: nowrap">MC/DIA</th>
                                <th scope="col">FINISH D/A</th>
                                <th scope="col" style="white-space: nowrap">MARK/HOLE</th>
                                <th scope="col" style="white-space: nowrap">Y/LOT</th>
                                <th scope="col" style="white-space: nowrap">GREY/WT</th>
                                <th scope="col" style="white-space: nowrap">ROLL</th>
                            </tr>
                            </thead>
                            <tbody class="AddBatchDiv">

                            </tbody>

                        </table>
                    </div>
                    <div class="row m-0 p-3">
                        <div class="col-6">

                        </div>
                        <div class="col-6">
                            <div class="row mt-2">
                                <div class="col-6 text-right">
                                </div>
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary float-left px-4 mr-2">Save</button>
                                    <button type="button"
                                            onclick="window.location.href='{{route('batch.index')}}'"
                                            class="btn btn-secondary float-left px-4 RemoveNewPurchaseRequisition">
                                        Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>




    <!-- Modal -->

@endsection
@push('style')
    <link rel="stylesheet" href="{{asset('assets/styles/responsive.dataTables.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/sweetalert/sweetalert.css')}}"/>
    <style>
        @keyframes spinner-border {
            to {
                transform: rotate(360deg);
            }
        }

        .spinner-border {
            display: inline-block;
            width: 2rem;
            height: 2rem;
            vertical-align: text-bottom;
            border: .25em solid currentColor;
            border-right-color: transparent;
            border-radius: 50%;
            -webkit-animation: spinner-border .75s linear infinite;
            animation: spinner-border .75s linear infinite;
        }

        .spinner-border-sm {
            height: 1rem;
            border-width: .2em;
        }
    </style>
@endpush
@push('script')
    <script src="{{asset('assets/scripts/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/scripts/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/scripts/app/app-transaction-history.1.3.1.min.js')}}"></script>
    <script src="{{asset('assets/sweetalert/sweetalert.js')}}"></script>
    <script>
        $('.datepicker').datepicker("setDate", new Date());
        $(document).on('keyup', '#order_no', () => {
            let order_no = $('#order_no').val();
            if (order_no !== '') {
                $.ajax({
                    url: "{!! route('batch.order','') !!}" + "/" + order_no,
                    type: 'get',
                    dataType: 'json',
                    beforeSend: function () {
                        $(".spinner-border").show();
                    },
                    success: function (data) {
                        $(".AddPurchaseDiv").html('');
                        for (let i = 0; i < data.order.length; i++) {
                            let product = '<tr>\n' +
                                '<td><div class="custom-control custom-checkbox mb-1">\n' +
                                '                              <input type="checkbox" value="' + data.order[i].id + '" class="custom-control-input" id="formsCheckbox' + i + '">\n' +
                                '                              <label class="custom-control-label" for="formsCheckbox' + i + '"></label>\n' +
                                '                            </div></td>' +
                                '                                        <td>' + data.order[i].factory_name + '</td>\n' +
                                '                                        <td>' + data.order[i].buyer_name + '</td>\n' +
                                '                                        <td>' + data.order[i].style + '</td>\n' +
                                '                                        <td>' + data.order[i].fabrics_type + '</td>\n' +
                                '                                        <td>' + data.order[i].color + '</td>\n' +
                                '                                        <td>' + data.order[i].grey_receive + '</td>\n' +
                                '                                        <td>' + data.order[i].lab_app + '</td>\n' +
                                '                                    </tr>';
                            $(".AddPurchaseDiv").append(product);
                        }
                        $("#order_table").show();
                        $(".spinner-border").hide();
                    },
                    error: function (result) {
                        $(".spinner-border").hide();
                        $("#order_table").hide();
                    },
                    timeout: 5000
                });
            } else {
                $(".AddPurchaseDiv").html('');
                $("#order_table").hide();
            }
        });

        $(document).on('change', 'input[type="checkbox"]', function () {
            let id = $(this).attr('value');
            if ($(this).is(":checked")) {
            } else {
                $('.batchlist' + id).remove();
                return;
            }
            $.ajax({
                url: "{!! route('simple.order','') !!}" + "/" + id,
                type: 'get',
                dataType: 'json',
                beforeSend: function () {
                    $(".spinner-border").show();
                    $("#order_table").hide();
                },
                success: function (data) {
                    var colour;
                    if (data.order.colour == null) {
                        colour = ''
                    } else {
                        colour = data.order.colour.colour_name
                    }
                    $('.order_id').val(data.order.order_id);
                    $('.factory_name').val(data.order.order.factory.factory_name);
                    $('.buyer_name').val(data.order.buyer.buyer);
                    $('.style').val(data.order.style.style_name);
                    $('.colour').val(colour);
                    $('.fab_type').val(data.order.fabrics_type);
                    $('.yarn_count').val(data.order.yarn_count);
                    $('.finish_gsm').val(data.order.gsm);
                    $('.mc_dia').val(data.order.dia);
                    $('.finish_dia').val(data.order.f_dia);

                    let grey_quantity = parseInt(data.order.grey_received) - parseInt(data.order.batch_received);

                    let product = ' <tr class="batchlist' + id + '">\n' +
                        '                                <td>\n' +
                        '<input type="hidden" name="order_list_id[]" value="' + data.order.id + '" required>' +
                        '                                    <input type="text"\n' +
                        '                                           class="form-control" value="' + data.order.fabrics_type + '" max="255" readonly>\n' +
                        '                                </td>\n' +
                        '                                <td>\n' +
                        '                                    <input type="text"\n' +
                        '                                           class="form-control" value="' + data.order.dia + '" max="255" readonly>\n' +
                        '                                </td>\n' +
                        '                                <td>\n' +
                        '                                    <input type="text"\n' +
                        '                                           class="form-control" value="' + data.order.f_dia + '" max="255" readonly>\n' +
                        '                                </td>\n' +
                        '                                <td><input name="mark_hole[]" type="text"\n' +
                        '                                           class="form-control mark_hole" max="255"></td>\n' +
                        '                                <td><input name="y_lot[]" type="text"\n' +
                        '                                           class="form-control y_lot" max="255"></td>\n' +
                        '                                <td><input name="gray_wt[]" type="number"\n' +
                        '                                           class="form-control gray_wt" max="' + grey_quantity + '" required></td>\n' +
                        '                                <td><input name="roll[]" type="text"\n' +
                        '                                           class="form-control roll" max="255"></td>\n' +
                        '                            </tr>';

                    $(".AddBatchDiv").append(product);
                    $(".spinner-border").hide();
                    $("#order_table").show();
                },
                error: function (result) {
                    $(".spinner-border").hide();
                    $("#order_table").show();
                },
                timeout: 5000
            });
        });

    </script>
@endpush

