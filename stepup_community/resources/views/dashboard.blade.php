@extends('layout.homelayout')

@section('site_title')
    Dashboard
@endsection

@section('css_file')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/comments.css') }}">
@endsection

@section('content_section')
    <input type="hidden" id="csrf-token" value="{{ csrf_token() }}">
    <!-- Post Modal -->
    <div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="postModalLabel">Write Your Post</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body container">
                    <div class="alert alert-primary errAddPost" role="alert" style="display: none;"></div>
                    <form action="{{ route('addPost') }}" id="addPost" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label for="category" class="form-label">Select Category <span class="text-danger">*</span></label>
                            <select class="form-select" id="category" name="category">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="pos_image" class="form-label">Select Image</label>
                            <input class="form-control" type="file" id="post_image" name="pos_image">
                        </div>
                        <div class="mb-3">
                            <label for="post_content" class="form-label">Post Content <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="post_content" name="post_content" style="min-height: 200px;" placeholder="What's on your mind?"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary px-3">Add Post</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Save Memory Modal -->
    <div class="modal fade" id="saveMemory" tabindex="-1" aria-labelledby="saveMemoryLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="saveMemoryLabel">Save Your Memory</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body container">
                    <div class="alert alert-primary errAddMemory" role="alert" style="display: none;"></div>
                    <form action="{{ route('addMemory') }}" id="addMemory" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="memory_image" class="form-label">Select Image <span class="text-danger">*</span></label>
                            <input class="form-control" type="file" id="memory_image" name="memory_image">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary px-3">Save Memory</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Single Memory Show Modal -->
    <div class="modal fade" id="memoryModal" tabindex="-1" aria-labelledby="memoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="memoryModalLabel">Memory</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex justify-content-center">
                    <div class="singla-memory-area bg-body-tertiary h-100">

                        <div class="h-100" id="show-memory" style="display: none;">
                        </div>

                        <div class="h-100" id="loding-card">
                            <div class="loding-header p-2">
                                <div class="header-img skeleton"></div>
                                <div class="loding-title">
                                    <div class="skeleton skeleton-text"></div>
                                    <div class="skeleton skeleton-text"></div>
                                </div>
                            </div>
                            <div class="" style="margin-top: max(30%, 20vh);">
                              <div class="skeleton skeleton-image m-auto"></div>
                            </div>
                        </div>
                      
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- comment section --}}
    <div class="modal fade" id="comentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content" id="show-comment" style="display: none;">
            </div>
            <div class="modal-content"  id="loding-comment-card">
                <div class="modal-header">
                    <div class="w-100 d-flex justify-content-between align-items-end">
                        <div></div>
                        <div><h1 class="modal-title fs-5" id="commentModalLabel">Comment</h1></div>
                        <div><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
                    </div>
                </div>
                <div class="modal-body px-0" style="background: #f0f2f5; scrollbar-width: none;scroll-behavior: smooth;">
                    <div class="h-100">
                        <div class="loding-header p-2">
                            <div class="header-img skeleton"></div>
                            <div class="loding-title">
                                <div class="skeleton skeleton-text"></div>
                                <div class="skeleton skeleton-text"></div>
                            </div>
                        </div>
                        <div>
                            <div class="skeleton skeleton-foter-image m-auto"></div>
                        </div>
                        <div class="loding-footer px-2 pt-4">
                            <div class="header-img skeleton"></div>
                            <div class="loding-title mt-1">
                                <div class="skeleton skeleton-footer-text"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
    <div class="container px-0 px-sm-2 pt-2 pt-sm-3 d-flex justify-content-center align-items-center">
        <div class="post-area d-flex bg-white" data-bs-toggle="modal" data-bs-target="#postModal">
            <img class="rounded-circle" src="{{ asset('profileImage').'/'.Auth::user()->avatar }}" width="42px" height="42px">
            <div class="post-btn ms-2 w-100">
                <span class="px-3 py-2">What's on your mind?</span>
            </div>
        </div>
    </div>
    <div class="container px-0 px-sm-2 pt-2 pt-sm-3 d-flex justify-content-center align-items-center">
        <div class="container memory-area-wrapper p-0">
            <button class="scroll-btn left bg-white text-dark hidden" id="scrollLeft"><i class="fas fa-chevron-left"></i></button>
            <div class="memory-area" id="memoryArea">
                <!-- Images here -->
                <div class="ad-memory-area" data-bs-toggle="modal" data-bs-target="#saveMemory">
                    <div class="add-memory d-flex justify-content-center align-items-center text-center">
                        <span>
                            <i class="fa fa-plus-circle text-white" aria-hidden="true"></i>
                            <p class="fw-bolder text-white mb-0">Memory</p>
                        </span>
                    </div>
                </div>
                @foreach ($memoryData as $memoryData)
                    @if (Auth::user()->uid  == $memoryData->uid)
                        <div class="memory" id="show_memory" memory_id="{{ $memoryData->m_id }}">
                            <img class="othor-icon" src="{{ asset('profileImage').'/'.$memoryData->avatar }}" width="40px" height="40px">
                            <img class="memory-img" src="{{ asset('memoryImage').'/'.$memoryData->memory_image }}" alt="">
                            <p class="memory-author text-white m-0">{{ $memoryData->name }}</p>
                        </div>
                    @elseif ($memoryData->status == 2)
                        <div class="memory" id="show_memory" memory_id="{{ $memoryData->m_id }}">
                            <img class="othor-icon" src="{{ asset('profileImage').'/'.$memoryData->avatar }}" width="40px" height="40px">
                            <img class="memory-img" src="{{ asset('memoryImage').'/'.$memoryData->memory_image }}" alt="">
                            <p class="memory-author text-white m-0">{{ $memoryData->name }}</p>
                        </div>
                    @endif
                @endforeach
                <!-- Repeat memory divs as needed -->
            </div>
            <button class="scroll-btn right text-dark hidden" id="scrollRight"><i class="fas fa-chevron-right"></i></button>
        </div>
    </div>

    {{-- post area --}}
    <div class="container px-0 px-sm-2 pt-2 pt-sm-3 d-flex justify-content-center flex-wrap" id="post-container">
        @foreach ($pinPost as $pinPost)
            @php
                $date = $pinPost->created_at;
                $formattedDate = date('d M Y', strtotime($date));
            @endphp
            <div class="bg-white p-box mb-2 mb-sm-3 px-0 pt-3 shadow-sm">
                <div class="d-flex px-3">
                    <img class="rounded-circle" src="{{ asset('profileImage'.'/'.$pinPost->users->avatar) }}" width="45px" height="45px" alt="">
                    <div class="ps-2">
                        <p class="mb-0 p-profile">{{ $pinPost->users->name }}</p>
                        <p class="p-time mb-0">
                            IN: <span class="text-primary"> {{ $pinPost->category }}</span>, {{ $formattedDate }}
                        </p>
                    </div>
                </div>
                <div class="my-1 px-3" style="color: #565252;">
                    <div class="someText post_content">{{ substr_replace($pinPost->post_content, '...', 100) }}</div>
                    <div class="seeMoreText post_content" style="display: none;">{{ $pinPost->post_content }}</div>
                    <span class="text-primary fw-bold seemoreButton"> See more</span>
                </div>
                @if ($pinPost->post_image !== "null")
                    <div><img src="{{ asset('postImage'.'/'.$pinPost->post_image) }}" width="100%" alt=""></div>
                @endif
                <div class="d-flex justify-content-between text-muted px-3 reaction-count">
                    <p class="my-2 ms-2">Like {{ $pinPost->likes_count }}</p>
                    <p class="my-2 me-2">Comment {{ $pinPost->comment_count }}</p>
                </div>
                <hr class="my-0 mx-3">
                <div class="row text-center mx-1">
                    <div class="col">
                        @if ($pinPost->user_has_liked)
                            <div class="reaction-area px-2 py-1 my-1 d-flex justify-content-center text-primary">
                                <i class="fa fa-thumbs-up reaction-icon"></i><span class="reaction-text ms-2">Like</span>
                            </div>
                        @else
                            <div class="reaction-area px-2 py-1 my-1 d-flex justify-content-center text-secondary" id="like_post" post_id="{{ $pinPost->p_id }}">
                                <i class="fa fa-thumbs-up reaction-icon"></i><span class="reaction-text ms-2">Like</span>
                            </div>
                        @endif
                    </div>
                    <div class="col">
                        <div class="reaction-area px-2 py-1 my-1 d-flex justify-content-center text-secondary" id="show_comment" post_id="{{ $pinPost->p_id }}">
                            <i class="fa fa-comment reaction-icon"></i><span class="reaction-text ms-2">Comment</span>
                        </div>
                    </div>
                    <div class="col">
                        @if ($pinPost->user_has_saved)
                            <div class="reaction-area px-2 py-1 my-1 d-flex justify-content-center text-primary" id="unsave_post" post_id="{{ $pinPost->p_id }}">
                                <i class="fa fa-save reaction-icon"></i><span class="reaction-text ms-2">Save</span>
                            </div>
                        @else
                            <div class="reaction-area px-2 py-1 my-1 d-flex justify-content-center text-secondary" id="save_post" post_id="{{ $pinPost->p_id }}">
                                <i class="fa fa-save reaction-icon"></i><span class="reaction-text ms-2">Save</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <script>
        const memoryArea = document.getElementById('memoryArea');
        const scrollLeftBtn = document.getElementById('scrollLeft');
        const scrollRightBtn = document.getElementById('scrollRight');

        function updateButtons() {
            scrollLeftBtn.classList.toggle('hidden', memoryArea.scrollLeft <= 0);
            scrollRightBtn.classList.toggle('hidden', memoryArea.scrollLeft + memoryArea.clientWidth >= memoryArea.scrollWidth);
        }

        // Scroll left and right functions
        scrollLeftBtn.addEventListener('click', () => {
            memoryArea.scrollBy({ left: -200, behavior: 'smooth' });
        });
        scrollRightBtn.addEventListener('click', () => {
            memoryArea.scrollBy({ left: 200, behavior: 'smooth' });
        });

        memoryArea.addEventListener('scroll', updateButtons);
        window.addEventListener('load', updateButtons);
        window.addEventListener('resize', updateButtons);
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // load post
            var page = 1;
            var isRunning = false;
            var hasMorePosts = true;
            loadPost();

            $(window).scroll(function() {
                if ($(window).scrollTop() + $(window).height() > $(document).height() - 500) {
                    if (!isRunning && hasMorePosts) {
                        loadPost();
                    }
                }
            });

            function loadPost() {
                isRunning = true;
                $.ajax({
                    url: "{{ route('loadPosts') }}",
                    method: "GET",
                    dataType: "json",
                    data: { 'page': page },
                    success: function(data) {
                        if (data.message != "success") {
                            hasMorePosts = false;
                        } else {
                            $("#post-container").append(data.html);
                            page++;
                        }
                        isRunning = false;
                    }
                });
            }

            // add post
            $('#addPost').on('submit', function(event) {
                event.preventDefault();
                let formData = new FormData(this);
    
                $.ajax({
                    url: "{{ route('addPost') }}",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.message) {
                            $(".errAddPost").fadeIn().delay(2000).fadeOut(2000).html(response.message);
                        }
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessages = '';
                        $.each(errors, function(key, value) {
                            errorMessages += value + '\n';
                        });
                        $(".errAddPost").fadeIn().delay(2000).fadeOut(2000).html(errorMessages);
                    }
                });
            });

            // add memory
            $('#addMemory').on('submit', function(event) {
                event.preventDefault();
                let formData = new FormData(this);
    
                $.ajax({
                    url: "{{ route('addMemory') }}",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.message) {
                            $(".errAddMemory").fadeIn().delay(2000).fadeOut(2000).html(response.message);
                        }
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessages = '';
                        $.each(errors, function(key, value) {
                            errorMessages += value + '\n';
                        });
                        $(".errAddMemory").fadeIn().delay(2000).fadeOut(2000).html(errorMessages);
                    }
                });
            });

            // show memory
            $(document).on('click', '#show_memory', function(event) {
                event.preventDefault();
                var m_id = $(this).attr('memory_id');
                $('#show-memory').hide();
                $('#show-memory').html("");
                $('#loding-card').show();
                $('#memoryModal').modal('show');
                $.ajax({
                    url: "{{ route('loadMemory') }}",
                    method: "GET",
                    dataType: "json",
                    data: { 'memory_id': m_id },
                    success: function(data) {
                        if (data.message == "success") {
                            $('#loding-card').hide();
                            $('#show-memory').html(data.html);
                            $('#show-memory').show();
                        }
                    }
                });
            });

            // like post
            $(document).on('click', '#like_post', function(event) {
                event.preventDefault();
                var post_id = $(this).attr('post_id');
                var $this = $(this);
                $.ajax({
                    url: "{{ route('likePost') }}",
                    method: "GET",
                    dataType: "json",
                    data: { 'post_id': post_id },
                    success: function(data) {
                        if (data.message == "success") {
                            $this.removeClass('text-secondary');
                            $this.addClass('text-primary');
                        }
                    }
                });
            });

            // save post
            $(document).on('click', '#save_post', function(event) {
                event.preventDefault();
                var post_id = $(this).attr('post_id');
                var $this = $(this);
                $.ajax({
                    url: "{{ route('savePost') }}",
                    method: "GET",
                    dataType: "json",
                    data: { 'post_id': post_id },
                    success: function(data) {
                        if (data.message == "success") {
                            $this.removeClass('text-secondary');
                            $this.addClass('text-primary');
                        }
                    }
                });
            });

            // unsave post
            $(document).on('click', '#unsave_post', function(event) {
                event.preventDefault();
                var post_id = $(this).attr('post_id');
                var $this = $(this);
                $.ajax({
                    url: "{{ route('unsavePost') }}",
                    method: "GET",
                    dataType: "json",
                    data: { 'post_id': post_id },
                    success: function(data) {
                        if (data.message == "success") {
                            $this.removeClass('text-primary');
                            $this.addClass('text-secondary');
                        }
                    }
                });
            });

            // post comment
            $(document).on('click', '#show_comment', function(event) {
                event.preventDefault();
                var post_id = $(this).attr('post_id');
                $('#show-comment').hide();
                $('#show-comment').html("");
                $('#loding-comment-card').show();
                $('#comentModal').modal('show');
                $.ajax({
                    url: "{{ route('loadComment') }}",
                    method: "GET",
                    dataType: "json",
                    data: { 'post_id': post_id },
                    success: function(response) {
                        $('#loding-comment-card').hide();
                        $('#show-comment').html(response.html);
                        $('#show-comment').show();
                    }
                });
            });

            // write comment
            $(document).on('click', '#post_comment', function(event) {
                event.preventDefault();
                var post_id = $('#post_id').val();
                var comment = $('#comment').val();
                var _token  = $('#csrf-token').val();
                $.ajax({
                    url: "{{ route('saveComment') }}",
                    method: "POST",
                    dataType: "json",
                    data: { 'post_id': post_id, 'comment': comment, '_token': _token },
                    success: function(data) {
                        if (data.message == "success") {
                            $('#comment_area').html(data.html);
                        }
                    }
                });
            });

            // open replay prompt
            $(document).on('click', '.replyToComment', function(event) {
                event.preventDefault();
                $(this).next('.replyForm').toggle();
            });

            // save comment reply
            $(document).on('click', '.postCommentReply', function(event) {
                event.preventDefault();
                const form       = $(this).closest('form');
                const post_id    = form.find('.post_id').val();
                const comment_id = form.find('.comment_id').val();
                const reply_text = form.find('.replyCommentText').val();
                const _token     = $('#csrf-token').val();
                $.ajax({
                    url: "{{ route('saveReply') }}",
                    method: "POST",
                    dataType: "json",
                    data: { 'post_id': post_id, 'comment_id': comment_id, 'reply_text': reply_text, '_token': _token },
                    success: function(data) {
                        if (data.message == "success") {
                            $('#comment_area').html(data.html);
                        }
                    }
                });
            });

            // see mode
            $(document).on('click', '.seemoreButton', function(event) {
                event.preventDefault();
                $(this).siblings('.someText').toggle();
                $(this).siblings('.seeMoreText').toggle();
                if ($(this).text() === ' See more') {
                    $(this).text(' See less');
                } else {
                    $(this).text(' See more');
                }
            });
        });
    </script>
@endsection