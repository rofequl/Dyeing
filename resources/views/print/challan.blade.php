<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Chilanka&display=swap" rel="stylesheet">
    <title>Delivery Challan</title>
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
</head>
<body>
<div id="invoice">
    <div class="toolbar hidden-print">
        <div class="text-right">
            <button id="printInvoice" class="btn btn-sm btn-info"><i class="fa fa-print"></i> Print</button>
        </div>
    </div>
    <div class="invoice">
        <div style="min-width: 600px">
            <header>
                <div class="row">
                    <div class="col-12 text-center">
                        <h2 class="font-weight-bold" style="font-family: 'Chilanka', cursive;">YARN MUSEUM (BD) LTD</h2>
                        <p>Factory: Dhaka-Narshingdi Highway, Vulta, Rupgonj, Narayanganj</p>
                        <hr>
                        <div class="row justify-content-center">
                            <div class="bg-dark text-light col-2 p-1 rounded" style="">Delivery Challan</div>
                        </div>

                    </div>
                </div>
            </header>
            <main>
                <div class="row contacts">
                    <div class="col invoice-to">
                        <div class="text-gray-light">Challan No: {{$delivery->challan_no}}</div>
                        <h4 class="to">{{$delivery->order->factory->factory_name}}</h4>
                        <div class="address">{{$delivery->order->factory->address}}</div>
                        <div class="email"><a href="mailto:john@example.com">{{$delivery->order->factory->phone}}</a>
                        </div>
                    </div>
                    <div class="col invoice-details">
                        <div class="date">Date: {{date('d F, Y', strtotime($delivery->date))}}</div>
                        <div class="date">Vehicle No: {{$delivery->vehicle_noe}}</div>
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
                        <th scope="col">Finish Quantity</th>
                        <th scope="col">ROLL</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(get_delivery($delivery->batch_no) as $deliver)
                        <tr>
                            <td colspan="11"><span class="font-weight-bold">Process :</span>
                                @foreach(get_process($deliver->process_list->process_id) as $processes)
                                    {{$processes->process_name}} +
                                @endforeach
                            </td>
                        </tr>
                        @foreach($deliver->batchlist as $batch)
                            <tr>
                                <td>{{$batch->order_list->buyer->buyer}}</td>
                                <td>{{$deliver->order_id}}</td>
                                <td>{{$batch->order_list->style->style_name}}</td>
                                <td>{{$deliver->batch_no}}</td>
                                <td>{{$batch->order_list->fabrics_type}}</td>
                                <td>{{$batch->order_list->colour->colour_name}}</td>
                                <td>{{$batch->order_list->dia}}</td>
                                <td>{{$batch->order_list->gsm}}</td>
                                <td>{{$batch->grey_wt}}</td>
                                <td>{{$batch->finished_qty}}</td>
                                <td>{{$batch->roll}}</td>
                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="8" class="text-right">Total =</td>
                        <td>{{$delivery->total_grey}}</td>
                        <td>{{$delivery->total_finish}}</td>
                        <td>{{$delivery->total_roll}}</td>
                    </tr>
                    </tfoot>
                </table>

            </main>
            <footer>

            </footer>
        </div>
        <div></div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>
<script>
    $('#printInvoice').click(function () {
        Popup($('.invoice')[0].outerHTML);

        function Popup(data) {
            window.print();
            return true;
        }
    });
</script>
</body>
</html>
