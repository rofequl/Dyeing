@extends('layouts.app')
@section('title','Dyeing Factory')
@section('content')
    <div class="main-content-container container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-4 mb-sm-0">
                <span class="text-uppercase page-subtitle">Dashboard</span>
                <h3 class="page-title"></h3>
            </div>
        </div>
        <!-- End Page Header -->

    </div>
@endsection
@push('style')

@endpush
@push('script')
    <script src="{{asset('assets/scripts/app/app-ecommerce.1.3.1.min.js')}}"></script>
@endpush

