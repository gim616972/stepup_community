@extends('layout.homelayout')

@section('site_title')
    Saved Post
@endsection

@section('css_file')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

@section('content_section')
    <div class="container px-0 px-sm-2 pt-2 pt-sm-3 d-flex justify-content-center flex-wrap" id="post-container">
        @foreach ($savedPost as $savedPost)
            @php
                $date = $savedPost->created_at;
                $formattedDate = date('d M Y', strtotime($date));
            @endphp
            <div class="bg-white p-box mb-2 mb-sm-3 px-0 pt-3 shadow-sm">
                <div class="d-flex px-3">
                    <img class="rounded-circle" src="{{ asset('profileImage'.'/'.$savedPost->avatar) }}" width="45px" height="45px" alt="">
                    <div class="ps-2">
                        <p class="mb-0 p-profile">{{ $savedPost->name }}</p>
                        <p class="p-time mb-0">
                            IN: <span class="text-primary"> {{ $savedPost->category }}</span>, {{ $formattedDate }}
                        </p>
                    </div>
                </div>
                <p class="mt-1 px-3" style="color: #565252;">
                    {{ $savedPost->post_content }} <span class="text-primary fw-bold"> See more</span>
                </p>
                @if ($savedPost->post_image !== "null")
                    <div><img src="{{ asset('postImage'.'/'.$savedPost->post_image) }}" width="100%" alt=""></div>
                @endif
                <div class="d-flex justify-content-between text-muted px-3 reaction-count">
                    <p class="my-2 ms-2">Like 500</p>
                    <p class="my-2 me-2">Comment 800</p>
                </div>
                <hr class="my-0 mx-3">
                <div class="row text-center mx-1">
                    <div class="col">
                        <div class="reaction-area px-2 py-1 my-1 d-flex justify-content-center text-secondary" id="like_post" post_id="{{ $savedPost->p_id }}">
                            <i class="fa fa-thumbs-up reaction-icon"></i><span class="reaction-text ms-2">Like</span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="reaction-area px-2 py-1 my-1 d-flex justify-content-center text-secondary" id="show_comment" post_id="{{ $savedPost->p_id }}">
                            <i class="fa fa-comment reaction-icon"></i><span class="reaction-text ms-2">Comment</span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="reaction-area px-2 py-1 my-1 d-flex justify-content-center text-secondary" id="save_post" post_id="{{ $savedPost->p_id }}">
                            <i class="fa fa-save reaction-icon"></i><span class="reaction-text ms-2">Save</span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection