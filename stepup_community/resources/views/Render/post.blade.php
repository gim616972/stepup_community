@foreach ($posts as $posts)
    @php
        $date = $posts->created_at;
        $formattedDate = date('d M Y', strtotime($date));
    @endphp
    <div class="bg-white p-box mb-2 mb-sm-3 px-0 pt-3 shadow-sm">
        <div class="d-flex px-3">
            <img class="rounded-circle" src="{{ asset('profileImage'.'/'.$posts->users->avatar) }}" width="45px" height="45px" alt="">
            <div class="ps-2">
                <p class="mb-0 p-profile">{{ $posts->users->name }}</p>
                <p class="p-time mb-0">
                    IN: <span class="text-primary"> {{ $posts->category }}</span>, {{ $formattedDate }}
                </p>
            </div>
        </div>
        <div class="my-1 px-3" style="color: #565252;">
            <div class="someText post_content">{{ substr_replace($posts->post_content, '...', 100) }}</div>
            <div class="seeMoreText post_content" style="display: none;">{{ $posts->post_content }}</div>
            <span class="text-primary fw-bold seemoreButton"> See more</span>
        </div>
        @if ($posts->post_image !== "null")
            <div><img src="{{ asset('postImage'.'/'.$posts->post_image) }}" width="100%" alt=""></div>
        @endif
        <div class="d-flex justify-content-between text-muted px-3 reaction-count">
            <p class="my-2 ms-2">Like {{ $posts->likes_count }}</p>
            <p class="my-2 me-2">Comment {{ $posts->comment_count }}</p>
        </div>
        <hr class="my-0 mx-3">
        <div class="row text-center mx-1">
            <div class="col">
                @if ($posts->user_has_liked)
                    <div class="reaction-area px-2 py-1 my-1 d-flex justify-content-center text-primary">
                        <i class="fa fa-thumbs-up reaction-icon"></i><span class="reaction-text ms-2">Like</span>
                    </div>
                @else
                    <div class="reaction-area px-2 py-1 my-1 d-flex justify-content-center text-secondary" id="like_post" post_id="{{ $posts->p_id }}">
                        <i class="fa fa-thumbs-up reaction-icon"></i><span class="reaction-text ms-2">Like</span>
                    </div>
                @endif
            </div>
            <div class="col">
                <div class="reaction-area px-2 py-1 my-1 d-flex justify-content-center text-secondary" id="show_comment" post_id="{{ $posts->p_id }}">
                    <i class="fa fa-comment reaction-icon"></i><span class="reaction-text ms-2">Comment</span>
                </div>
            </div>
            <div class="col">
                @if ($posts->user_has_saved)
                    <div class="reaction-area px-2 py-1 my-1 d-flex justify-content-center text-primary" id="unsave_post" post_id="{{ $posts->p_id }}">
                        <i class="fa fa-save reaction-icon"></i><span class="reaction-text ms-2">Save</span>
                    </div>
                @else
                    <div class="reaction-area px-2 py-1 my-1 d-flex justify-content-center text-secondary" id="save_post" post_id="{{ $posts->p_id }}">
                        <i class="fa fa-save reaction-icon"></i><span class="reaction-text ms-2">Save</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endforeach