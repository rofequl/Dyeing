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
                <h3 class="page-title">Finished Entry</h3>
            </div>
        </div>

        <div class="card p-0 py-3 mb-4 text-center">

            <form method="get" action="{{route('finished.entry')}}" class="form-row p-2">
                <div class="col-xl-2 col-md-4 col-5 text-center">Batch No.</div>
                <div class="col-xl-5 form-group col-md-6 col-7">
                    <input type="text" name="batch_no" value="{{$batch===null?'':$batch->batch_no}}"
                           class="form-control"
                           placeholder="Please enter batch number.">
                </div>
                <div class="col-xl-2 col-md-2 col-7">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>

            @if($batch!==null)
                <table class="table" id="order_table">
                    <thead class="bg-light">
                    <tr>
                        <th scope="col" class="border-0">Factory Name</th>
                        <th scope="col" class="border-0">Buyer Name</th>
                        <th scope="col" class="border-0">Style</th>
                        <th scope="col" class="border-0">Fabrics Type</th>
                        <th scope="col" class="border-0">Color</th>
                        <th scope="col" class="border-0">Grey Quantity</th>
                        <th scope="col" class="border-0">Finished Received</th>
                        <th scope="col" class="border-0">Waste</th>
                        <th scope="col" class="border-0"></th>
                    </tr>
                    </thead>
                    <tbody class="AddPurchaseDiv">
                    @foreach($batch->batchlist as $batchlist)
                        <tr>
                            <td>{{$batchlist->order_list->order->factory->factory_name}}</td>
                            <td>{{$batchlist->order_list->buyer->buyer}}</td>
                            <td>{{$batchlist->order_list->style->style_name}}</td>
                            <td>{{$batchlist->order_list->fabrics_type}}</td>
                            <td>{{$batchlist->order_list->colour->colour_name}}</td>
                            <td>{{$batchlist->grey_wt}}</td>
                            <td>{{$batchlist->finished_qty}}</td>
                            <td>{{$batchlist->waste}}</td>
                            <td>
                                <button type="button" class="btn btn-white add" id="{{$batchlist->id}}"
                                        data-grey_wt="{{$batchlist->grey_wt}}"
                                        data-finished_qty="{{$batchlist->finished_qty}}"
                                        data-waste="{{$batchlist->waste}}">
                                    <i class="material-icons">
                                        add_task
                                    </i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="post" action="{{route('finished.store')}}" autocomplete="off">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add finished in batch</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" class="batchlist_id" name="batchlist_id">
                        <div class="modal_div">
                            <input type="hidden" class="batch_id" name="batch_id">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <input type="text" class="form-control gray_qty" name="gray_qty"
                                           placeholder="Grey Quantity" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control finished_qty" name="finished_qty"
                                           placeholder="Finished Received">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control waste" name="waste"
                                           placeholder="Waste" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
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
    <script>
        $(document).on('click', '.add', function () {
            $('.batchlist_id').val($(this).attr("id"));
            $('.gray_qty').val($(this).attr("data-grey_wt"));
            $('.finished_qty').val($(this).attr("data-finished_qty"));
            $('.waste').val($(this).attr("data-waste"));
            $('#exampleModal').modal('show');
        });

        $(document).on('keyup', '.finished_qty', function () {
            if (/\D/g.test(this.value))
                this.value = this.value.replace(/\D/g, '');
            $('.waste').val($('.gray_qty').val() - this.value);
        });
    </script>
@endpush
