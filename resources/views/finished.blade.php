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
                <h3 class="page-title">Finished Receive</h3>
            </div>
            <div class="col-12 col-sm-6 d-flex align-items-center">
                <div class="d-inline-flex mb-sm-0 mx-auto ml-sm-auto mr-sm-0" role="group" aria-label="Page actions">
                    <a id="add-new-event" role="button" href="#" class="btn btn-primary" data-toggle="modal"
                       data-target="#exampleModal">
                        <i class="material-icons">add</i> Finished Quantity Add</a>
                </div>
            </div>
        </div>
        <table class="transaction-history d-none">
            <thead>
            <tr>
                <th>#</th>
                <th>Factory Name</th>
                <th>Buyer Name</th>
                <th>Batch No.</th>
                <th>Order No.</th>
                <th>Finished Quantity</th>
                <th>Date</th>
            </tr>
            </thead>
            <tbody>@php $sl = 1; @endphp
            @foreach($finished as $finisheds)
                <tr>
                    <td>{{$sl}}</td>@php $sl++; @endphp
                    <td>{{$finisheds->batch->order_list->order->factory->factory_name}}</td>
                    <td>{{$finisheds->batch->order_list->buyer->buyer}}</td>
                    <td>{{$finisheds->batch->batch_no}}</td>
                    <td>{{$finisheds->batch->order_list->order_id}}</td>
                    <td>{{$finisheds->finished_qty}}</td>
                    <td>{{$finisheds->date}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="post" action="{{route('finished.store')}}" autocomplete="off">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add process in batch</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-row">
                            <div class="col-3">Batch No:</div>
                            <div class="form-group col-6">
                                <input type="number" class="form-control batch_no"
                                       placeholder="Enter Batch No" max="255">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-3 text-right">
                                <button type="button" class="btn btn-primary search">Search</button>
                            </div>
                        </div>
                        <div class="modal_div" style="display: none">
                            <input type="hidden" class="batch_id" name="batch_id">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control gray_qty" name="gray_qty"
                                           placeholder="Grey Quantity" readonly>
                                </div>
                                <div class="input-daterange input-group input-group-sm ml-auto col-md-6 col-7">
                                    <input type="text" class="input-sm form-control datepicker" name="date"
                                           placeholder="Date" max="255" id="analytics-overview-date-range-1" required>
                                    <span class="input-group-append">
                                            <span class="input-group-text">
                                              <i class="material-icons">&#xE916;</i>
                                            </span>
                                          </span>
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
@endpush
@push('script')
    <script src="{{asset('assets/scripts/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/scripts/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/scripts/app/app-transaction-history.1.3.1.min.js')}}"></script>
    <script src="{{asset('assets/sweetalert/sweetalert.js')}}"></script>
    <script>
        $('.datepicker').datepicker("setDate", new Date());
        $('.search').click(function (e) {
            e.preventDefault();
            let batch = $('.batch_no').val();
            $.ajax({
                url: "{!! route('batch.get','') !!}" + "/" + batch,
                type: 'get',
                dataType: 'json',
                success: function (result) {
                    $('.batch_no').removeClass('is-invalid');
                    $('.invalid-feedback').text('');
                    $('.batch_id').val(result.batch.id);
                    $('.gray_qty').val(result.batch.gray_wt);
                    $('.modal_div').show();
                },
                error: function (result) {
                    $('.batch_no').addClass('is-invalid');
                    $('.invalid-feedback').text('No batch found');
                    $('.modal_div').hide();
                    $('.batch_id').val('');
                }
            });
        });

        $('.edit').click(function (e) {
            let linkURL = $(this).attr("href");
            window.location.href = linkURL;
        });

        $(document).on('keyup', '.finished_qty', function () {
            if (/\D/g.test(this.value))
                this.value = this.value.replace(/\D/g, '');
            $('.waste').val($('.gray_qty').val() - this.value);
        });
    </script>
@endpush

