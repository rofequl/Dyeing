@extends('layouts.app')
@section('title','Order List Report | Dyeing Factory')
@section('content')
    <div class="main-content-container container-fluid px-4 mb-4">
        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-6 text-center text-sm-left mb-4 mb-sm-0">
                <span class="text-uppercase page-subtitle">Report</span>
                <h3 class="page-title">Order List</h3>
            </div>
        </div>
        <div class="my-2">
            <div class="form-row">
                <div class="input-daterange input-group input-group-sm col-md-2">
                    <input type="text" class="input-sm form-control datepicker" value="{{$date}}" name="date"
                           autocomplete="off"
                           placeholder="Select Date" id="analytics-overview-date-range-1" required>
                    <span class="input-group-append">
                                            <span class="input-group-text">
                                              <i class="material-icons">&#xE916;</i>
                                            </span>
                                          </span>
                </div>
                <div class="input-daterange input-group-sm col-md-2">
                    <select class="input-sm form-control factory"
                            onchange="if (this.selectedIndex) factory();">
                        <option selected disabled>Select Factory</option>
                        @foreach($factory as $factories)
                            <option
                                value="{{base64_encode($factories->id)}}" {{$factory_id == $factories->id?'selected':''}}>{{$factories->factory_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-daterange input-group-sm col-md-2">
                    <select class="input-sm form-control buyer"
                            onchange="if (this.selectedIndex) buyer();">
                        <option selected disabled>Select Buyer</option>
                        @foreach($buyer as $buyers)
                            <option
                                value="{{base64_encode($buyers->id)}}" {{$buyer_id == $buyers->id?'selected':''}}>{{$buyers->buyer}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-daterange input-group-sm col-md-2">
                    <select class="input-sm form-control style"
                            onchange="if (this.selectedIndex) stylen();">
                        <option selected disabled>Select Style</option>
                        @foreach($style as $styles)
                            <option
                                value="{{base64_encode($styles->id)}}" {{$style_id == $styles->id?'selected':''}}>{{$styles->style_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-daterange input-group-sm col-md-2">
                    <select class="input-sm form-control colour"
                            onchange="if (this.selectedIndex) colour();">
                        <option selected disabled>Select Colour</option>
                        @foreach($colour as $colours)
                            <option
                                value="{{base64_encode($colours->id)}}" {{$colour_id == $colours->id?'selected':''}}>{{$colours->colour_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-daterange input-group-sm col-md-2">
                    <a href="{{route('report.order')}}" class="btn btn-sm btn-accent">Reset Search</a>
                </div>
            </div>
        </div>
        <div id="printbar" style="float:right;margin-top: 7px;margin-right: 7px"></div>
        <table class="transaction d-none">
            <thead>
            <tr>
                <th>#</th>
                <th>Factory Name</th>
                <th>Buyer Name</th>
                <th>Style</th>
                <th>Colour</th>
                <th>Roll</th>
                <th>Quantity</th>
                <th>Date</th>
            </tr>
            </thead>
            <tbody>@php $sl = 1; @endphp
            @foreach($order as $orders)
                <tr>
                    <td>{{$sl}}</td>@php $sl++; @endphp
                    <td>{{$orders->order->factory->factory_name}}</td>
                    <td>{{$orders->buyer->buyer}}</td>
                    <td>{{$orders->style==''?'':$orders->style->style_name}}</td>
                    <td>{{$orders->colour==''?'':$orders->colour->colour_name}}</td>
                    <td>{{$orders->roll}}</td>
                    <td>{{$orders->quantity}}</td>
                    <td>{{$orders->order->date}}</td>
                </tr>
            @endforeach
            </tbody>
            <tfoot class="border {{$filter == 0?'d-none':''}}">
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>Total:</td>
                <td class="border text-center">{{$order->sum('roll')}}</td>
                <td class="border text-center">{{$order->sum('quantity')}}</td>
                <td></td>
            </tr>
            </tfoot>
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

                ]
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

