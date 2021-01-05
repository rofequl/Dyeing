@extends('layouts.app')
@section('title','New Bill Entry')
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
                <h3 class="page-title">New Bill Entry</h3>
            </div>
        </div>
        <div class="card p-0 py-3 mb-4 text-center">

            <form method="get" action="{{route('bill.entry')}}" class="form-row p-2">
                <div class="col-xl-2 col-md-4 col-5 text-center">Challan No.</div>
                <div class="col-xl-5 form-group col-md-6 col-7">
                    <input type="text" id="tags" name="order_no" value="{{$id===null?'':$id}}"
                           class="form-control"
                           placeholder="Please enter challan number." required>
                </div>
                <div class="col-xl-2 col-md-2 col-7">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
            @if($delivery)
                <hr>
                <div class="invoice">
                    <div style="min-width: 600px">
                        <main>
                            <form method="post" action="{{route('bill.store')}}">
                                @csrf
                                <div class="row contacts">
                                    <div class="col invoice-to">
                                        <div class="text-gray-light">Challan No: {{$delivery->challan_no}}</div>
                                        <h4 class="to">{{$delivery->order->factory->factory_name}}</h4>
                                        <div class="address">{{$delivery->order->factory->address}}</div>
                                        <div class="email"><a
                                                href="mailto:john@example.com">{{$delivery->order->factory->phone}}</a>
                                        </div>
                                        <input type="hidden" name="challan_no" value="{{$delivery->challan_no}}">
                                    </div>
                                    <div class="col invoice-details">
                                        <div class="row my-2">
                                            <div class="col-md-6 col-5 text-right">Current Date</div>
                                            <div
                                                class="input-daterange input-group input-group-sm ml-auto col-md-6 col-7">
                                                <input type="text" class="input-sm form-control datepicker" name="date"
                                                       placeholder="Date" max="255" id="analytics-overview-date-range-1"
                                                       required>
                                                <span class="input-group-append">
                                            <span class="input-group-text">
                                              <i class="material-icons">&#xE916;</i>
                                            </span>
                                          </span>
                                            </div>
                                        </div>
                                        <div class="date">Vehicle No: {{$delivery->vehicle_no}}</div>
                                        <div class="date">Driver's Name: {{$delivery->driver_name}}</div>
                                    </div>
                                </div>
                                <table class="table table-bordered text-center">
                                    <thead>
                                    <tr>
                                        <th scope="col">Buyer</th>
                                        <th scope="col">Order No.</th>
                                        <th scope="col">Style No.</th>
                                        <th scope="col">Batch No.</th>
                                        <th scope="col">Fabrics Type</th>
                                        <th scope="col">Color</th>
                                        <th scope="col">Dia</th>
                                        <th scope="col">GSM</th>
                                        <th scope="col">Grey Quantity</th>
                                        <th scope="col">Unit Price</th>
                                        <th scope="col">Total Amount</th>
                                        <th scope="col">Remarks</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(get_delivery($delivery->batch_no) as $deliver)
                                        <tr>
                                            <td colspan="12"><span class="font-weight-bold">Process :</span>
                                                @if($deliver->process_list)
                                                    @foreach(get_process($deliver->process_list->process_id) as $processes)
                                                        {{$processes->process_name}} +
                                                    @endforeach
                                                @endif
                                            </td>
                                        </tr>
                                        @foreach($deliver->batchlist as $batch)
                                            <tr class="serial" id="{{$batch->id}}">
                                                <td>{{$batch->order_list->buyer->buyer}}</td>
                                                <td>{{$deliver->order_id}}</td>
                                                <td>@if($batch->order_list->style) {{$batch->order_list->style->style_name}} @endif</td>
                                                <td>{{$deliver->batch_no}}</td>
                                                <td>{{$batch->order_list->fabrics_type}}</td>
                                                <td>@if($batch->order_list->colour) {{$batch->order_list->colour->colour_name}} @endif</td>
                                                <td>{{getDeliveryChalan($batch->id)->dia}}</td>
                                                <td>{{$batch->order_list->gsm}}</td>
                                                <td class="qty{{$batch->id}}">{{getDeliveryChalan($batch->id)->grey_wt}}</td>
                                                <td>
                                                    <input type="number" id="unit_price{{$batch->id}}"
                                                           name="unit_price[]" class="form-control unit_price">
                                                    <input type="hidden" name="batch_id[]" value="{{$batch->id}}">
                                                </td>
                                                <td class="total{{$batch->id}}"></td>
                                                <td>
                                                    <input class="form-control" type="text" name="remarks[]" placeholder="Remarks">
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="10" class="text-right">Total =
                                        </td>
                                        <td class="totalAmount"></td>
                                        <td></td>
                                    </tr>
                                    </tfoot>
                                </table>
                                <div class="row m-0 p-3">
                                    <div class="col-6">

                                    </div>
                                    <div class="col-6">
                                        <div class="row mt-2">
                                            <div class="col-6 text-right">

                                            </div>
                                            <div class="col-6">
                                                <button type="submit" class="btn btn-primary float-left px-4 mr-2">
                                                    Save
                                                </button>
                                                <button type="button"
                                                        onclick="window.location.href='{{route('bill.index')}}'"
                                                        class="btn btn-secondary float-left px-4 RemoveNewPurchaseRequisition">
                                                    Close
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </main>
                        <footer>

                        </footer>
                    </div>
                    <div></div>
                </div>
            @endif
        </div>

    </div>



@endsection
@push('style')
    <style>
        #invoice {
            padding: 30px;
        }

        .invoice {
            position: relative;
            background-color: #FFF;
            min-height: 680px;
            padding: 15px;
            font-family: 'Arial', sans-serif;
            font-size: 14px;
        }

        .invoice header {
            padding: 10px 0;
            margin-bottom: 20px;
        }

        .invoice .company-details {
            text-align: right
        }

        .invoice .company-details .name {
            margin-top: 0;
            margin-bottom: 0
        }

        .invoice .contacts {
            margin-bottom: 20px
        }

        .invoice .invoice-to {
            text-align: left
        }

        .invoice .invoice-to .to {
            margin-top: 0;
            margin-bottom: 0
        }

        .invoice .invoice-details {
            text-align: right
        }

        .invoice .invoice-details .invoice-id {
            margin-top: 0;
            color: #3989c6
        }

        table {
            page-break-inside: auto
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto
        }

        thead {
            display: table-header-group
        }

        tfoot {
            display: table-footer-group
        }

        @media print {
            .invoice {
                font-size: 11px !important;
                overflow: hidden !important
            }

            .hidden-print {
                display: none;
            }
        }

    </style>
@endpush
@push('script')
    <script>
        $.fn.datepicker.defaults.format = "dd MM, yyyy";
        $('.datepicker').datepicker("setDate", new Date());

        $(document).on('keyup', '.unit_price', function () {
            if (/\D/g.test(this.value))
                this.value = this.value.replace(/\D/g, '');
            calculation();
        });

        function calculation() {
            let AllClass = $(".serial"), subtotal = 0;
            for (let i = 0; i < AllClass.length; i++) {
                let id = parseInt($(AllClass[i]).attr('id'));
                let price = $('#unit_price' + id).val();
                let qty = parseInt($('.qty' + id).text());
                if (price !== '') {
                    price = price * qty;
                    subtotal += price;
                    $(".total" + id).text(price);
                }
            }
            $('.totalAmount').text(subtotal);
        }
    </script>
@endpush
