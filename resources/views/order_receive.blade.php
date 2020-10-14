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
                <h3 class="page-title">Order Entry</h3>
            </div>
        </div>
        <div class="card card-small mb-4">
            <div class="card-header border-bottom text-right">
                    <span onclick="window.location.href='{{route('order.index')}}'" class="mb-0 right-hand"
                          style="cursor: pointer"><i
                            class="fas fa-hand-point-left"></i> Go back </span>
                <div class="spinner-border" style="display: none">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <div class="card-body p-0 text-center">
                <form method="post" action="{{route('order.store')}}" id="upload_form"
                      enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="row p-3">
                        <div class="col-md-6">
                            <div class="row" id="member_id">
                                <div class="col-md-4 col-5 text-right">Factory Name</div>
                                <div class="form-group col-md-4 col-7">
                                    <select name="factory_id" id="factory_id" class="form-control" required>
                                        <option selected disabled>Select Factory</option>
                                        @foreach($factory as $factories)
                                            <option value="{{$factories->id}}">{{$factories->factory_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row" id="member_id">
                                <div class="col-md-4 col-5 text-right">Factory Address</div>
                                <div class="form-group col-md-8 col-7">
                                    <input type="text" id="factory_address" class="form-control"
                                           placeholder="Factory Address" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6 col-5 text-right">Challan No.</div>
                                <div class="col-md-6 col-7">
                                    <input type="text" class="form-control totalValue" name="challan_no"
                                           max="11">
                                </div>
                            </div>
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
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table mb-0 mt-4" style="width: 250%">
                            <thead class="bg-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" style="white-space: nowrap">Buyer Name</th>
                                <th scope="col">Style</th>
                                <th scope="col" style="white-space: nowrap">Work Order</th>
                                <th scope="col" style="white-space: nowrap">Yarn Count</th>
                                <th scope="col" style="white-space: nowrap">Fabrics Type</th>
                                <th scope="col" style="white-space: nowrap">MC/DIA</th>
                                <th scope="col" style="white-space: nowrap">F/DIA</th>
                                <th scope="col" style="white-space: nowrap">Grey GSM/S/L</th>
                                <th scope="col" style="white-space: nowrap">F/GSM</th>
                                <th scope="col" style="white-space: nowrap">Color</th>
                                <th scope="col" style="white-space: nowrap">Roll</th>
                                <th scope="col" style="white-space: nowrap">Quantity</th>
                                <th scope="col" style="white-space: nowrap">Action</th>
                            </tr>
                            </thead>
                            <tbody class="AddOrderDiv">
                            <tr>
                                <td class="Sl">1</td>
                                <td>
                                    <select id="buyer1" name="buyer[]" class="form-control buyer" required></select>
                                </td>
                                <td>
                                    <select id="style1" name="style[]" class="form-control"></select>
                                </td>
                                <td><input name="work_order[]" type="text" id="work_order1"
                                           class="form-control ProductEdit" max="255"></td>
                                <td><input name="yarn_count[]" type="text" id="yarn_count1"
                                           class="form-control ProductEdit" max="255"></td>
                                <td><input name="fabrics_type[]" type="text" id="fabrics_type1"
                                           class="form-control ProductEdit" max="255"></td>
                                <td><input name="dia[]" type="text" id="dia1"
                                           class="form-control ProductEdit" max="255"></td>
                                <td><input name="f_dia[]" type="text" id="f_dia1"
                                           class="form-control ProductEdit" max="255"></td>
                                <td><input name="gray_gsm[]" type="text" id="gray_gsm1"
                                           class="form-control ProductEdit" max="255"></td>
                                <td><input name="gsm[]" type="text" id="gsm1"
                                           class="form-control ProductEdit" max="255"></td>
                                <td>
                                    <select id="colour1" name="colour[]" class="form-control"></select>
                                </td>
                                <td><input name="roll[]" id="roll1" type="text"
                                           class="form-control totalValue" max="255" required></td>
                                <td><input id="quantity1" type="text" name="quantity[]" class="form-control totalValue"
                                           max="255" required>
                                </td>
                            </tr>
                            </tbody>

                        </table>
                    </div>
                    <div class="row mt-5 m-0 p-3">
                        <div class="col-6">
                            <div class="row">
                                <button type="button" class="btn btn-success AddRow float-left">Add New Row
                                </button>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row mt-2">
                                <div class="col-6 text-right">
                                    Total Roll:
                                </div>
                                <div class="col-6">
                                    <input id="total_roll" name="total_roll" type="text" class="form-control"
                                           readonly>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-6 text-right">
                                    Total Qty:
                                </div>
                                <div class="col-6">
                                    <input id="total_qty" name="total_qty" type="text" class="form-control"
                                           readonly>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-6 text-right">
                                </div>
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary float-left px-4 mr-2">Save</button>
                                    <button type="button"
                                            onclick="window.location.href='{{route('order.index')}}'"
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
    <style>
        @keyframes spinner-border {
            to { transform: rotate(360deg); }
        }
        .spinner-border{
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
        .spinner-border-sm{
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
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function () {
            InsertCreate();
        });
        $('.datepicker').datepicker("setDate", new Date());
        $('#factory_id').change(function () {
            AddSelectBuyer2();
            let id = $(this).val();
            let url = "{{ route('factory.show', ":id") }}";
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                beforeSend: function() {
                    $(".right-hand").hide();
                    $(".spinner-border").show();
                },
                success: function (data) {
                    $('#factory_address').val(data.factory.address);
                    $(".right-hand").show();
                    $(".spinner-border").hide();
                },
                error: function (result) {
                    swal({
                        title: "Something Wrong",
                        text: "Please try again later",
                        type: "warning",
                    }, function () {
                        location.reload();
                    })
                },
                timeout: 5000
            });
        });

        function InsertCreate() {
            AddSelectBuyer('buyer1');
            AddSelectStyle('style1');
            AddSelectColour('colour1');

        }

        function AddSelectBuyer(clas) {
            let factory = $('#factory_id').val();
            let url = "{{ route('buyer.list', ":id") }}";
            url = url.replace(':id', factory);
            if (factory == null) {
                return true;
            } else {
                $.ajax({
                    url: url,
                    type: 'get',
                    dataType: 'json',
                    success: function (data) {
                        $('#' + clas).html('');
                        $('#' + clas).append('<option value="" selected disabled>Select Buyer</option>');
                        data.buyer.forEach(function (element) {
                            $('#' + clas).append($('<option>', {value: element.id, text: element.buyer}));
                        });
                    },
                    error: function (result) {
                        swal({
                            title: "Something Wrong",
                            text: "Please try again later",
                            type: "warning",
                        })
                    },
                    timeout: 5000
                });
            }


        }

        function AddSelectBuyer2() {
            let factory = $('#factory_id').val();
            let url = "{{ route('buyer.list', ":id") }}";
            url = url.replace(':id', factory);
            if (factory == null) {
                return true;
            } else {
                $.ajax({
                    url: url,
                    type: 'get',
                    dataType: 'json',
                    success: function (data) {
                        $('.buyer').html('');
                        $('.buyer').append('<option value="" selected disabled>Select Buyer</option>');
                        data.buyer.forEach(function (element) {
                            $('.buyer').append($('<option>', {value: element.id, text: element.buyer}));
                        });
                    },
                    error: function (result) {
                        swal({
                            title: "Something Wrong",
                            text: "Please try again later",
                            type: "warning",
                        })
                    },
                    timeout: 5000
                });
            }


        }

        function AddSelectStyle(clas) {
            let url = "{{route('style.list')}}";
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                success: function (data) {
                    $('#' + clas).html('');
                    $('#' + clas).append('<option value="" selected>Select Style</option>');
                    data.style.forEach(function (element) {
                        $('#' + clas).append($('<option>', {value: element.id, text: element.style_name}));
                    });
                },
                error: function (result) {
                    swal({
                        title: "Something Wrong",
                        text: "Please try again later",
                        type: "warning",
                    })
                },
                timeout: 5000
            });


        }

        function AddSelectColour(clas) {
            let url = "{{route('colour.list')}}";
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                success: function (data) {
                    $('#' + clas).html('');
                    $('#' + clas).append('<option value="" selected>Select Colour</option>');
                    data.colour.forEach(function (element) {
                        $('#' + clas).append($('<option>', {value: element.id, text: element.colour_name}));
                    });
                },
                error: function (result) {
                    swal({
                        title: "Something Wrong",
                        text: "Please try again later",
                        type: "warning",
                    })
                },
                timeout: 5000
            });


        }

        $(document).on('click', '.AddRow', function () {
            let count = parseInt($(".AddOrderDiv tr .Sl").last().text()) + 1;
            let product = '<tr class="AddPurchaseTr' + count + '">\n' +
                '                                <td class="Sl">' + count + '</td>\n' +
                '                                <td>\n' +
                '                                    <select id="buyer' + count + '" name="buyer[]" class="form-control buyer" required></select>\n' +
                '                                </td>\n' +
                '                                <td>\n' +
                '                                    <select id="style' + count + '" name="style[]" class="form-control"></select>\n' +
                '                                </td>\n' +
                '                                <td><input name="work_order[]" type="text" id="work_order' + count + '"\n' +
                '                                           class="form-control ProductEdit" max="255"></td>\n' +
                '                                <td><input name="yarn_count[]" type="text" id="yarn_count' + count + '"\n' +
                '                                           class="form-control ProductEdit" max="255"></td>\n' +
                '                                <td><input name="fabrics_type[]" type="text" id="fabrics_type' + count + '"\n' +
                '                                           class="form-control ProductEdit" max="255"></td>\n' +
                '                                <td><input name="dia[]" type="text" id="dia' + count + '"\n' +
                '                                           class="form-control ProductEdit" max="255"></td>\n' +
                '                                <td><input name="f_dia[]" type="text" id="f_dia' + count + '"\n' +
                '                                           class="form-control ProductEdit" max="255"></td>\n' +
                '                                <td><input name="gray_gsm[]" type="text" id="gray_gsm' + count + '"\n' +
                '                                           class="form-control ProductEdit" max="255"></td>\n' +
                '                                <td><input name="gsm[]" type="text" id="gsm' + count + '"\n' +
                '                                           class="form-control ProductEdit" max="255"></td>\n' +
                '                                <td>\n' +
                '                                    <select id="colour' + count + '" name="colour[]" class="form-control"></select>\n' +
                '                                </td>\n' +
                '                                <td><input name="roll[]" id="roll' + count + '" type="text"\n' +
                '                                           class="form-control totalValue" max="255" required>\n' +
                '                                </td>\n' +
                '                                <td><input id="quantity' + count + '" type="text" name="quantity[]" class="form-control totalValue" max="255" required></td>\n' +
                '                                        <td><button type="button" class="btn btn-danger shadow-none px-2" onclick="AddOrderDivRemove(\'AddPurchaseTr' + count + '\')" title="Remove Input"><i class="fas fa-1x fa-minus-circle"></i></button></td>\n' +
                '                            </tr>';
            $(".AddOrderDiv").append(product);
            AddSelectBuyer('buyer' + count);
            AddSelectStyle('style' + count);
            AddSelectColour('colour' + count);
        });

        function AddOrderDivRemove(data) {
            $('.' + data).remove();
            calculation();
        }

        $(document).on('keyup', '.totalValue', function () {
            if (/\D/g.test(this.value))
                this.value = this.value.replace(/\D/g, '');
            calculation();
        });

        function calculation() {
            let AllClass = $(".AddOrderDiv tr .Sl"), roll = 0, quantity = 0;
            for (let i = 0; i < AllClass.length; i++) {
                let id = parseInt($(AllClass[i]).text()),
                    price = $("#roll" + id).val(),
                    price2 = $("#quantity" + id).val();
                roll += Math.trunc(price);
                quantity += Math.trunc(price2);

            }
            $('#total_roll').val(roll);
            $('#total_qty').val(quantity);
        }
    </script>
@endpush

