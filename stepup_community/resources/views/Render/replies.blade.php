@if (Auth::user()->uid  == $comment->commentUser->uid)
    <li>
        <div class="pe-3 pb-2">
            <div class="coment_section">
                <div class="d-flex">
                    <img class="rounded-circle me-3" src="{{ asset('profileImage').'/'.$comment->commentUser->avatar }}" width="35px" height="35px">
                    <span class="fw-bolder pe-3">{{ $comment->commentUser->name }}</span>
                </div>
                <div>
                    <div class="px-2 py-2">
                        <p class="mb-0">{{ $comment->comment }}</p>
                    </div>
                    <p class="fw-bold ps-2 mb-1 replyToComment">Reply</p>
                    <form class="mb-3 replyForm" style="display: none;">
                        <input type="hidden" class="comment_id" value="{{ $comment->com_id }}">
                        <input type="hidden" class="post_id" value="{{ $comment->p_id }}">
                        <div class="d-flex align-items-center flex-nowrap">
                            <input type="text" class="form-control replyCommentText" placeholder="Write your reply here...">
                            <button type="button" class="btn btn-primary ms-2 postCommentReply"><i class="fas fa-paper-plane"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @if ($comment->replies->count())
            <ul class="comment_tree">
                @foreach ($comment->replies as $reply)
                    @include('Render.replies', ['comment' => $reply])
                @endforeach
            </ul>
        @endif
    </li>
@elseif ($comment->status == 2)
    <li>
        <div class="pe-3 pb-2">
            <div class="coment_section">
                <div class="d-flex">
                    <img class="rounded-circle me-3" src="{{ asset('profileImage').'/'.$comment->commentUser->avatar }}" width="35px" height="35px">
                    <span class="fw-bolder pe-3">{{ $comment->commentUser->name }}</span>
                </div>
                <div>
                    <div class="px-2 py-2">
                        <p class="mb-0">{{ $comment->comment }}</p>
                    </div>
                    <p class="fw-bold ps-2 mb-1 replyToComment">Reply</p>
                    <form class="mb-3 replyForm" style="display: none;">
                        <input type="hidden" class="comment_id" value="{{ $comment->com_id }}">
                        <input type="hidden" class="post_id" value="{{ $comment->p_id }}">
                        <div class="d-flex align-items-center flex-nowrap">
                            <input type="text" class="form-control replyCommentText" placeholder="Write your reply here...">
                            <button type="button" class="btn btn-primary ms-2 postCommentReply"><i class="fas fa-paper-plane"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @if ($comment->replies->count())
            <ul class="comment_tree">
                @foreach ($comment->replies as $reply)
                    @include('Render.replies', ['comment' => $reply])
                @endforeach
            </ul>
        @endif
    </li>
@endif

