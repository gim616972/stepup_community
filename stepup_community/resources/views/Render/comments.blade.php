<div class="modal-header">
    <div class="w-100 d-flex justify-content-between align-items-end">
        <div></div>
        <div><h1 class="modal-title fs-5" id="commentModalLabel">Comment</h1></div>
        <div><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
    </div>
</div>
<div class="modal-body p-0" style="background: #f0f2f5; scrollbar-width: none;scroll-behavior: smooth;">
    <div class="bg-white px-0 pt-3 shadow-sm rounded-3">
        <div class="d-flex px-3">
            <img class="rounded-circle" src="{{ asset('profileImage'.'/'.$postComment->users->avatar) }}" width="35px" height="35px" alt="">
            <div class="ps-2">
                <p class="mb-0 p-profile">{{ $postComment->users->name }}</p>
                <p class="p-time mb-0">
                    IN: <span class="text-primary"> {{ $postComment->category }}</span>, 3h
                </p>
            </div>
        </div>
        <div class="my-1 px-3" style="color: #565252;">
            <div class="post_content">{{ $postComment->post_content }}</div>
        </div>
        @if ($postComment->post_image !== "null")
            <div><img src="{{ asset('postImage'.'/'.$postComment->post_image) }}" width="100%" alt=""></div>
        @endif
        <div class="row text-center">
            <div class="col">
                @if ($postComment->likes_count > 0)
                    <div class="reaction-area px-2 py-1 my-1 d-flex justify-content-center text-primary" id="like_post" post_id="{{ $postComment->p_id }}">
                        <i class="fa fa-thumbs-up reaction-icon"></i><span class="reaction-text ms-2">Like</span>
                    </div>
                @else
                    <div class="reaction-area px-2 py-1 my-1 d-flex justify-content-center text-secondary" id="like_post" post_id="{{ $postComment->p_id }}">
                        <i class="fa fa-thumbs-up reaction-icon"></i><span class="reaction-text ms-2">Like</span>
                    </div>
                @endif
            </div>
            <div class="col">
                <div class="reaction-area px-2 py-1 my-1 d-flex justify-content-center text-secondary">
                    <i class="fa fa-comment reaction-icon"></i><span class="reaction-text ms-2">Comment</span>
                </div>
            </div>
            <div class="col">
                @if ($postComment->saves_count > 0)
                    <div class="reaction-area px-2 py-1 my-1 d-flex justify-content-center text-primary" id="save_post" post_id="{{ $postComment->p_id }}">
                        <i class="fa fa-save reaction-icon"></i><span class="reaction-text ms-2">Save</span>
                    </div>
                @else
                    <div class="reaction-area px-2 py-1 my-1 d-flex justify-content-center text-secondary" id="save_post" post_id="{{ $postComment->p_id }}">
                        <i class="fa fa-save reaction-icon"></i><span class="reaction-text ms-2">Save</span>
                    </div>
                @endif
            </div>
        </div>
        <hr class="m-0">
        <div id="comment_area" class="pt-2">
            @foreach ($postComment->comments as $selectComment)
                <ul class="comment_tree tree">
                    @if (Auth::user()->uid  == $selectComment->commentUser->uid)
                        <li>
                            <div class="pe-4 pb-2">
                                <div class="coment_section">
                                    <div class="d-flex">
                                        <img class="rounded-circle me-3" src="{{ asset('profileImage').'/'.$selectComment->commentUser->avatar }}" width="35px" height="35px">
                                        <span class="fw-bolder pe-3">{{ $selectComment->commentUser->name }}</span>
                                    </div>
                                    <div>
                                        <div class="px-2 py-2">
                                            <p class="mb-0">{{ $selectComment->comment }}</p>
                                        </div>
                                        <p class="fw-bold ps-2 mb-1 replyToComment">Reply</p>
                                        <form class="mb-3 replyForm" style="display: none;">
                                            <input type="hidden" class="comment_id" value="{{ $selectComment->com_id }}">
                                            <input type="hidden" class="post_id" value="{{ $selectComment->p_id }}">
                                            <div class="d-flex align-items-center flex-nowrap">
                                                <input type="text" class="form-control replyCommentText" placeholder="Write your reply here...">
                                                <button type="button" class="btn btn-primary ms-2 postCommentReply"><i class="fas fa-paper-plane"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <ul class="comment_tree">
                                @foreach ($selectComment->replies as $selectReplies)
                                    @include('Render.replies', ['comment' => $selectReplies])
                                @endforeach
                            </ul>
                        </li>
                    @elseif ($selectComment->status == 2)
                        <li>
                            <div class="pe-4 pb-2">
                                <div class="coment_section">
                                    <div class="d-flex">
                                        <img class="rounded-circle me-3" src="{{ asset('profileImage').'/'.$selectComment->commentUser->avatar }}" width="35px" height="35px">
                                        <span class="fw-bolder pe-3">{{ $selectComment->commentUser->name }}</span>
                                    </div>
                                    <div>
                                        <div class="px-2 py-2">
                                            <p class="mb-0">{{ $selectComment->comment }}</p>
                                        </div>
                                        <p class="fw-bold ps-2 mb-1 replyToComment">Reply</p>
                                        <form class="mb-3 replyForm" style="display: none;">
                                            <input type="hidden" class="comment_id" value="{{ $selectComment->com_id }}">
                                            <input type="hidden" class="post_id" value="{{ $selectComment->p_id }}">
                                            <div class="d-flex align-items-center flex-nowrap">
                                                <input type="text" class="form-control replyCommentText" placeholder="Write your reply here...">
                                                <button type="button" class="btn btn-primary ms-2 postCommentReply"><i class="fas fa-paper-plane"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <ul class="comment_tree">
                                @foreach ($selectComment->replies as $selectReplies)
                                    @include('Render.replies', ['comment' => $selectReplies])
                                @endforeach
                            </ul>
                        </li>
                    @endif
                </ul>
            @endforeach
        </div>
    </div>
</div>
<div class="modal-footer align-items-center flex-nowrap">
    <img class="rounded-circle me-2" src="{{ asset('profileImage').'/'.Auth::user()->avatar }}" width="35px" height="35px">
    <input type="hidden" id="post_id" value="{{ $postComment->p_id }}">
    <input type="text" id="comment" class="form-control" placeholder="Write your comment here...">
    <button type="button" class="btn btn-primary ms-2" id="post_comment"><i class="fas fa-paper-plane"></i></button>
</div>