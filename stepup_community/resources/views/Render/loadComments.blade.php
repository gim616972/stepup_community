@foreach ($loadComment->comments as $selectComment)
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
    