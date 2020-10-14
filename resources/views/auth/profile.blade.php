@extends('layouts.app')
@section('title','Dyeing Factory | User Profile Edit')
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
                <span class="text-uppercase page-subtitle">Dashboard</span>
                <h3 class="page-title">User Profile</h3>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row">
            <div class="col-lg-8 mt-4">
                <div class="card card-small edit-user-details mb-4">
                    <div class="card-body p-0">
                        <form id="profile-update" action="{{route('user.update',base64_encode($user->id))}}"
                              class="py-4" method="post" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            @method('PUT')
                            <div class="form-row mx-4">
                                <div class="col mb-3">
                                    <h6 class="form-text m-0">Setup your profile details</h6>
                                </div>
                            </div>
                            <div class="form-row mx-4">
                                <div class="col-lg-8">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <div class="input-group input-group-seamless">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="material-icons">person</i>
                                                    </div>
                                                </div>
                                                <input type="text" max="255" class="form-control" name="name"
                                                       placeholder="User Name" value="{{$user->name}}">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <div class="input-group input-group-seamless">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="material-icons"></i>
                                                    </div>
                                                </div>
                                                <input type="email" max="255" name="email" value="{{$user->email}}"
                                                       class="form-control" placeholder="Email Address">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <div class="input-group input-group-seamless">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="material-icons"></i>
                                                    </div>
                                                </div>
                                                <input type="text" max="255" name="address" value="{{$user->address}}"
                                                       class="form-control" placeholder="User Address">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <div class="input-group input-group-seamless">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="material-icons"></i>
                                                    </div>
                                                </div>
                                                <input type="text" max="12" name="phone" value="{{$user->phone}}"
                                                       class="form-control" placeholder="User Phone">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label for="userProfilePicture" class="text-center w-100 mb-4">Profile
                                        Picture</label>
                                    <div class="edit-user-details__avatar m-auto">
                                        <img src="{{asset($user->image)}}" class="img-thumbnail" alt="User Avatar"
                                             id="previewLogo" style="height: 120px!important;width: 120px!important;">
                                        <label class="edit-user-details__avatar__change">
                                            <i class="material-icons mr-1"></i>
                                            <input type="file" name="image" id="userProfilePicture" class="d-none">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer border-top">
                        <button type="button" onclick="document.getElementById('profile-update').submit();"
                                class="btn btn-sm btn-accent ml-auto d-table mr-3">Save Changes
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mt-4">
                <div class="card card-small edit-user-details mb-4">
                    <div class="card-body p-0">
                        <form id="profile-password-update"
                              action="{{route('user.password',base64_encode($user->id))}}" method="post"
                              class="py-4">
                            @csrf
                            @method('PUT')
                            <div class="form-row mx-4">
                                <div class="col mb-3">
                                    <h6 class="form-text m-0">Change Password</h6>
                                </div>
                            </div>
                            <div class="form-row mx-4">
                                <div class="form-group col-md-12">
                                    <input type="password" class="form-control" name="old_password"
                                           placeholder="Old Password">
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="password" class="form-control" name="password"
                                           placeholder="New Password">
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="password" class="form-control" name="password_confirmation"
                                           placeholder="Repeat New Password">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer border-top">
                        <button type="button" onclick="document.getElementById('profile-password-update').submit();"
                                class="btn btn-sm btn-accent ml-auto d-table mr-3">Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- End Transaction History Table -->
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
        $('.delete').click(function (e) {
            e.preventDefault();
            let linkURL = $(this).attr("href");
            swal({
                title: "Sure want to delete?",
                text: "If you click 'OK' file will be deleted",
                type: "warning",
                showCancelButton: true
            }, function () {
                window.location.href = linkURL;
            });
        });

        $('.edit').click(function (e) {
            let linkURL = $(this).attr("href");
            window.location.href = linkURL;
        });

        $(function () {
            $("#userProfilePicture").change(function () {
                let file = this.files[0];
                let imagefile = file.type;
                let match = ["image/jpeg", "image/png", "image/jpg"];
                if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
                    alert("only jpeg, jpg and png Images type allowed");
                    return false;
                } else {
                    let reader = new FileReader();
                    reader.onload = imageIsLoaded;
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });

        function imageIsLoaded(e) {
            $('#previewLogo').attr('src', e.target.result);
        }
    </script>
@endpush
