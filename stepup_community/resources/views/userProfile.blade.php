@extends('layout.homelayout')

@section('site_title')
    Profile
@endsection

@section('content_section')
<style>
    .profile-box {
        width: 700px;
        padding-bottom: 3px;
    }
    .basic_info_icon {
        font-size: 25px;
    }
    .profile_icon {
        border: 10px solid #1c68fa;
    }
</style>
    <div class="container px-0 px-sm-2 pt-5 pt-sm-3 d-flex justify-content-center flex-wrap">
        <div class="bg-white profile-box mb-2 mb-sm-3 px-0 mt-5 shadow-sm">
            <div class="d-flex align-items-center ps-5 py-4">
                <i class="fa-solid fa-address-card pe-3 basic_info_icon"></i>
                <span class="fw-bolder">Basic Information</span>
            </div>
            <div class="d-flex justify-content-center mb-3">
                <img class="rounded-circle border-2 p-1 border-primary profile_icon" src="{{ asset('profileImage').'/'.$user_image }}" width="80px" height="80px">
            </div>
            <div class="d-flex justify-content-center mb-5">
                <div class="px-3 px-md-5 fw-bolder text-muted">
                        <p>Name: {{ $user_name }}</p>
                        <p>Email: {{ $user_email }}</p>
                        <p>Phone: {{ $user_phone }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection