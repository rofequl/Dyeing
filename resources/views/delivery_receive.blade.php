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
                <h3 class="page-title">Delivery Challan Entry</h3>
            </div>
        </div>
        <div class="card p-0 py-3 mb-4 text-center">

            <form method="get" action="{{route('delivery.entry')}}" class="form-row p-2">
                <div class="col-xl-2 col-md-4 col-5 text-center">Order No.</div>
                <div class="col-xl-5 form-group col-md-6 col-7">
                    <input type="text" id="tags" name="order_no" value="{{$id===null?'':$id}}"
                           class="form-control"
                           placeholder="Please enter order number." required>
                </div>
                <div class="col-xl-2 col-md-2 col-7">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
            @if($batch!==null)
                <table class="table" id="order_table">
                    <thead class="bg-light">
                    <tr>
                        <th scope="col" class="border-0"></th>
                        <th scope="col" class="border-0">Factory Name</th>
                        <th scope="col" class="border-0">Batch No</th>
                        <th scope="col" class="border-0">Date</th>
                        <th scope="col" class="border-0">Work Order</th>
                        <th scope="col" class="border-0">Compostion</th>
                        <th scope="col" class="border-0">Stitch Length</th>
                    </tr>
                    </thead>
                    <tbody class="AddPurchaseDiv">
                    @foreach($batch as $batchs)
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox mb-1">
                                    <input type="checkbox" value="{{$batchs['batch']->batch_no}}"
                                           class="custom-control-input"
                                           id="formsCheckbox{{$batchs['batch']->batch_no}}">
                                    <label class="custom-control-label"
                                           for="formsCheckbox{{$batchs['batch']->batch_no}}"></label>
                                </div>
                            </td>
                            <td>{{$batchs['batch']->order->factory->factory_name}}</td>
                            <td>{{$batchs['batch']->batch_no}}</td>
                            <td>{{date('d F, Y', strtotime($batchs['batch']->date))}}</td>
                            <td>{{$batchs['batch']->work_order}}</td>
                            <td>{{$batchs['batch']->compostion}}</td>
                            <td>{{$batchs['batch']->stitch_length}}</td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <div class="card card-small mb-4">
            <div class="card-header border-bottom text-right">
                    <span onclick="window.location.href='{{route('delivery.index')}}'" class="mb-0 right-hand"
                          style="cursor: pointer"><i
                            class="fas fa-hand-point-left"></i> Go back </span>
            </div>
            <div class="card-body p-0 text-center">
                <form method="post" action="{{route('delivery.store')}}" id="upload_form"
                      enctype="multipart/form-data" autocomplete="off">
                    @csrf

                    <div class="row p-3">
                        <div class="col-md-6">
                            <div class="row" id="member_id">
                                <div class="col-md-4 col-5 text-right">Challan No</div>
                                <div class="form-group col-md-6 col-7">
                                    <input type="text" class="form-control" name="challan_no"
                                           placeholder="Enter Challan No" required>
                                    <input type="hidden" value="{{$order===null?'':$order->id}}" name="order_id"
                                           required>
                                </div>
                            </div>
                            <div class="row" id="member_id">
                                <div class="col-md-4 col-5 text-right">Factory Name</div>
                                <div class="form-group col-md-6 col-7">
                                    <input type="text" class="form-control factory_name"
                                           placeholder="Factory Name"
                                           value="{{$order===null?'':$order->factory->factory_name}}" readonly>
                                </div>
                            </div>
                            <div class="row" id="member_id">
                                <div class="col-md-4 col-5 text-right">Factory Address</div>
                                <div class="form-group col-md-6 col-7">
                                    <input type="text" class="form-control batch_no"
                                           placeholder="Factory Address"
                                           value="{{$order===null?'':$order->factory->address}}" readonly>
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
                            <div class="row mt-3" id="member_id">
                                <div class="col-md-6 col-5 text-right">Vehicle No</div>
                                <div class="form-group col-md-6 col-7">
                                    <input type="text" name="vehicle_no" class="form-control"
                                           placeholder="Enter Vehicle No">
                                </div>
                            </div>
                            <div class="row" id="member_id">
                                <div class="col-md-6 col-5 text-right">Drivers Name</div>
                                <div class="form-group col-md-6 col-7">
                                    <input type="text" name="driver_name" class="form-control batch_no"
                                           placeholder="Enter Drivers Name">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive" style="font-size: 14px!important;">
                        <table class="table mb-0 mt-4 table-bordered">
                            <thead class="bg-light">
                            <tr>
                                <th scope="col" style="white-space: nowrap">Buyer</th>
                                <th scope="col" style="white-space: nowrap">Order No.</th>
                                <th scope="col" style="white-space: nowrap">Batch No.</th>
                                <th scope="col">Dia</th>
                                <th scope="col" style="white-space: nowrap">GSM</th>
                                <th scope="col">GREY Quantity</th>
                                <th scope="col">Finish Quantity</th>
                                <th scope="col" style="white-space: nowrap">Roll</th>
                                <th scope="col" style="white-space: nowrap">Remarks</th>
                            </tr>
                            </thead>
                            <tbody class="AddDeliveryDiv">

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
                                            onclick="window.location.href='{{route('delivery.index')}}'"
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



@endsection
@push('style')
    <link rel="stylesheet" href="{{asset('assets/styles/responsive.dataTables.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/sweetalert/sweetalert.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/TagInput/tag.min.css')}}"/>
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
    <script src="{{asset('assets/TagInput/tag.min.js')}}"></script>
    <script>
        $.fn.datepicker.defaults.format = "dd MM, yyyy";
        $('.datepicker').datepicker("setDate", new Date());
        $('#tags').tagsInput({
            'height': '40px',
        });
        $(document).on('change', 'input[type="checkbox"]', function () {
            let id = $(this).attr('value');
            if ($(this).is(":checked")) {
            } else {
                $('.Deliverylist' + id).remove();
                return;
            }
            $.ajax({
                url: "{!! route('delivery.show','') !!}" + "/" + id,
                type: 'get',
                dataType: 'json',
                beforeSend: function () {
                    $(".spinner-border").show();
                    $("#order_table").hide();
                },
                success: function (data) {

                    let product = '';
                    if (data.process != null) {
                        product = '<tr class="Deliverylist' + data.batch.batch_no + '">\n' +
                            '                                <td class="text-center" colspan="11">' + data.process.join(' + ') + '' +
                            '<input type="hidden" class="d-none" name="batch_no[]" value="' + data.batch.batch_no + '" required></td>\n' +
                            '                            </tr>';
                    }
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
                        let dia = data.batch.batchlist[i].order_list.f_dia==null? '':data.batch.batchlist[i].order_list.f_dia;
                        product += '<tr class="Deliverylist' + data.batch.batch_no + '">\n' +
                        '                                        <td> <input type="hidden" name="batch_list_id[]" value="' + data.batch.batchlist[i].id + '">' + data.batch.batchlist[i].order_list.buyer.buyer + '' +
                        '</td>\n' +
                        '                                        <td>' + data.batch.order_id + '</td>\n' +
                        '                                        <td>' + data.batch.batch_no + '</td>\n' +
                        '                                        <td><input placeholder="Dia" name="dia[]" class="form-control" type="text" value="' + dia + '"></td>\n' +
                            '                                        <td>' + data.batch.batchlist[i].order_list.gsm + '</td>\n' +
                            '                                        <td><input name="grey_wt[]" class="form-control" type="number" value="' + data.batch.batchlist[i].grey_wt + '"></td>\n' +
                            '                                        <td><input placeholder="Finish Quantity" name="finished_qty[]" class="form-control" type="number"></td>\n' +
                            '                                        <td><input placeholder="Roll" name="roll[]" class="form-control" type="number" value="' + data.batch.batchlist[i].roll + '"></td>\n' +
                            '                                        <td><input placeholder="Remarks" name="remarks[]" class="form-control" type="text" max="255"></td>\n' +
                            '                                    </tr>';
                    }

                    $(".AddDeliveryDiv").append(product);
                    removenull();
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

        function removenull() {
            $(".AddDeliveryDiv tr td")
                .filter(function (index) {
                    if ($(this).text() == 'null') {
                        return true;
                    }
                })
                .text('');
        }

    </script>
@endpush
