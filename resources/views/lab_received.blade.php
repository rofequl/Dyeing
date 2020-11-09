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
                <h3 class="page-title">Lab Entry</h3>
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
                    <th scope="col" class="border-0">Factory Name</th>
                    <th scope="col" class="border-0">Buyer Name</th>
                    <th scope="col" class="border-0">Style</th>
                    <th scope="col" class="border-0">Fabrics Type</th>
                    <th scope="col" class="border-0">Color</th>
                    <th scope="col" class="border-0">Grey Quantity</th>
                    <th scope="col" class="border-0"></th>
                </tr>
                </thead>
                <tbody class="AddPurchaseDiv">

                </tbody>
            </table>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade bd-example-modal-sm" id="exampleModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form method="post" action="{{route('Lab.store')}}">
                        @csrf
                        <input type="hidden" class="orderlist_id" name="id">
                        <input type="text" class="form-control" placeholder="Enter LAB APP" name="lab_name" max="255"
                               required>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
                    url: "{!! route('lab.order','') !!}" + "/" + order_no,
                    type: 'get',
                    dataType: 'json',
                    beforeSend: function () {
                        $(".spinner-border").show();
                    },
                    success: function (data) {
                        $(".AddPurchaseDiv").html('');
                        for (let i = 0; i < data.order.length; i++) {
                            let product = '<tr>\n' +
                                '                                        <td>' + data.order[i].factory_name + '</td>\n' +
                                '                                        <td>' + data.order[i].buyer_name + '</td>\n' +
                                '                                        <td>' + data.order[i].style + '</td>\n' +
                                '                                        <td>' + data.order[i].fabrics_type + '</td>\n' +
                                '                                        <td>' + data.order[i].color + '</td>\n' +
                                '                                        <td>' + data.order[i].grey_receive + '</td>\n' +
                                '                                        <td>' +
                                '<button type="button" class="btn btn-white add" id="' + data.order[i].id + '">\n' +
                                '                                <i class="material-icons">\n' +
                                '                                    add_task\n' +
                                '                                </i>\n' +
                                '                            </button>' +
                                '</td>\n' +
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

        $(document).on('click', '.add', function () {
            $('.orderlist_id').val($(this).attr("id"));
            $('#exampleModal').modal('show');
        });


    </script>

@endpush
