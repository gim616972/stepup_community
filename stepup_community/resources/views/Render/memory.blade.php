@if (!empty($memories))
    @php
        $date = $memories->created_at;
        $formattedDate = date('d M Y, H:i A', strtotime($date));
    @endphp
    @if (Auth::user()->uid  == $memories->uid)
        <div class="d-flex align-items-center h-100" >
            <div class="d-flex px-3 pt-3" style="position: absolute; top: 0;">
                <img class="rounded-circle" src="{{ asset('profileImage').'/'.$memories->avatar }}" width="45px" height="45px">
                <div class="ps-2">
                    <p class="mb-0 p-profile text-dark">{{ $memories->name }}</p>
                    <p class="p-time mb-0 text-dark">
                        Time:<span class="text-primary"> {{ $formattedDate }}</span>
                    </p>
                </div>
            </div>
            <img class="single-memory-img" src="{{ asset('memoryImage').'/'.$memories->memory_image }}">
        </div>
    @elseif ($memories->status > 1)
        <div class="d-flex align-items-center h-100" >
            <div class="d-flex px-3 pt-3" style="position: absolute; top: 0;">
                <img class="rounded-circle" src="{{ asset('profileImage').'/'.$memories->avatar }}" width="45px" height="45px">
                <div class="ps-2">
                    <p class="mb-0 p-profile text-dark">{{ $memories->name }}</p>
                    <p class="p-time mb-0 text-dark">
                        Time:<span class="text-primary"> {{ $formattedDate }}</span>
                    </p>
                </div>
            </div>
            <img class="single-memory-img" src="{{ asset('memoryImage').'/'.$memories->memory_image }}">
        </div>
    @endif
    
@endif