@extends('layouts.app')
@section('title','Order List Report | Dyeing Factory')
@section('content')
    <div class="main-content-container container-fluid px-4 mb-4">
        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-6 text-center text-sm-left mb-4 mb-sm-0">
                <span class="text-uppercase page-subtitle">Report</span>
                <h3 class="page-title">Grey Stock and Order</h3>
            </div>
        </div>
        <div class="my-2">
            <div class="form-row">
                <div class="input-daterange input-group input-group-sm col-md-2">
                    <input type="text" class="input-sm form-control datepicker" value="{{$date2}}" name="date"
                           autocomplete="off"
                           placeholder="Select Date" id="analytics-overview-date-range-1" required>
                    <span class="input-group-append">
                                            <span class="input-group-text">
                                              <i class="material-icons">&#xE916;</i>
                                            </span>
                                          </span>
                </div>
                <div class="input-daterange input-group-sm col-md-2">
                    <a href="{{route('report.stock')}}" class="btn btn-sm btn-accent">Reset Search</a>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <div id="printbar" style="float:right;margin-top: 7px;margin-right: 7px"></div>
            <table class="transaction table-bordered d-none">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Factory Name</th>
                    <th>Previous Order QTY</th>
                    <th>Today Order QTY Received</th>
                    <th class="text-primary">Total Order QTY</th>
                    <th>Previous Grey QTY</th>
                    <th>Today Grey QTY Received</th>
                    <th class="text-primary">Total Grey QTY</th>
                    <th class="text-success">Grey Fabric Received Balance</th>
                    <th>Previous Batch QTY</th>
                    <th>Today Batch</th>
                    <th class="text-primary">Total Batch</th>
                    <th class="text-success">Grey Stock</th>
                </tr>
                </thead>
                <tbody>@php $sl = 1; @endphp
                @foreach($order as $orders)
                    <tr>
                        <td>{{$sl}}</td>@php $sl++; @endphp
                        <td>{{$orders->factory->factory_name}}</td>
                        <td>{{preOrderQty($orders->factory_id, $date)}}</td>
                        <td>{{getOrderRece($orders->factory_id, $date)}}</td>
                        <td class="text-primary">{{$orders->total}}</td>
                        <td>{{preGreyQty($orders->factory_id, $date)}}</td>
                        <td>{{getGreyRece($orders->factory_id, $date)}}</td>
                        <td class="text-primary">{{totalGreyQty($orders->factory_id, $date)}}</td>
                        <td class="text-success">{{$orders->total - totalGreyQty($orders->factory_id, $date)}}
                        <td>{{preBatchQty($orders->factory_id, $date)}}</td>
                        <td>{{getBatchQty($orders->factory_id, $date)}}</td>
                        <td class="text-primary">{{totalBatchQty($orders->factory_id, $date)}}</td>
                        <td class="text-success">{{totalGreyQty($orders->factory_id, $date) - totalBatchQty($orders->factory_id, $date)}}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot class="border">
                <tr>
                    <td></td>
                    <td>Total:</td>
                    <td class="border text-center"></td>
                    <td class="border text-center"></td>
                    <td class="border text-center text-primary"></td>
                    <td class="border text-center"></td>
                    <td class="border text-center"></td>
                    <td class="border text-center text-primary"></td>
                    <td class="border text-center text-success"></td>
                    <td class="border text-center"></td>
                    <td class="border text-center"></td>
                    <td class="border text-center text-primary"></td>
                    <td class="border text-center text-success"></td>
                </tr>
                </tfoot>
            </table>
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
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function () {
            var table = $('.transaction').DataTable({
                buttons: [
                    {
                        extend: 'copyHtml5',
                        text: '<i class="fas fa-copy mr-1"></i> Copy',
                        titleAttr: 'Copy'
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel mr-1"></i> Excel',
                        titleAttr: 'Excel'
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fas fa-file-csv mr-1"></i> CSV',
                        titleAttr: 'CSV'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf mr-1"></i> PDF',
                        titleAttr: 'PDF'
                    }

                ],
                "footerCallback": function (row, data, start, end, display) {
                    var api = this.api(), data;
                    var intVal = function (i) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                                i : 0;
                    };

                    var total = function (i) {
                        return api.column(i).data()
                            .reduce(function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0)
                    };


                    $(api.column(2).footer()).html(total(2));
                    $(api.column(3).footer()).html(total(3));
                    $(api.column(4).footer()).html(total(4));
                    $(api.column(5).footer()).html(total(5));
                    $(api.column(6).footer()).html(total(6));
                    $(api.column(7).footer()).html(total(7));
                    $(api.column(8).footer()).html(total(8));
                    $(api.column(9).footer()).html(total(9));
                    $(api.column(10).footer()).html(total(10));
                    $(api.column(11).footer()).html(total(11));
                    $(api.column(12).footer()).html(total(12));
                }
            });

            table.buttons().container().appendTo($('#printbar'));
            $('.dt-buttons').addClass('btn-group d-table ml-auto');
            $('.dt-buttons button').addClass('btn btn-sm btn-white');

        });
        $('.datepicker').datepicker({autoclose: true, format: 'dd/mm/yyyy'}).on('changeDate', function (e) {
            if (e.target.name == 'date') {
                var url = window.location.href;
                url = new URL(url);
                if (url.searchParams.get("date")) {
                    url.searchParams.set('date', e.format(0, "dd/mm/yyyy"));
                    window.location.replace(url.href);
                } else {
                    url.searchParams.append('date', e.format(0, "dd/mm/yyyy"));
                    window.location.replace(url.href);
                }
            }
        });

        function factory() {
            let url = window.location.href;
            let factory = $('.factory').val();
            url = new URL(url);
            if (url.searchParams.get("factory")) {
                url.searchParams.set('factory', factory);
                window.location.replace(url.href);
            } else {
                url.searchParams.append('factory', factory);
                window.location.replace(url.href);
            }
        }

        function buyer() {
            let url = window.location.href;
            let buyer = $('.buyer').val();
            url = new URL(url);
            if (url.searchParams.get("buyer")) {
                url.searchParams.set('buyer', buyer);
                window.location.replace(url.href);
            } else {
                url.searchParams.append('buyer', buyer);
                window.location.replace(url.href);
            }
        }

        function stylen() {
            let url = window.location.href;
            let style = $('.style').val();
            url = new URL(url);
            if (url.searchParams.get("style")) {
                url.searchParams.set('style', style);
                window.location.replace(url.href);
            } else {
                url.searchParams.append('style', style);
                window.location.replace(url.href);
            }
        }

        function colour() {
            let url = window.location.href;
            let colour = $('.colour').val();
            url = new URL(url);
            if (url.searchParams.get("colour")) {
                url.searchParams.set('colour', colour);
                window.location.replace(url.href);
            } else {
                url.searchParams.append('colour', colour);
                window.location.replace(url.href);
            }
        }
    </script>
@endpush

