<hr>
<div class="replay-area-details">
    <h4 class="title">Leave a Reply</h4>
    <form action="{{ route('blog.comment', $data['id']) }}" method="POST">
        @csrf
        <div class="row g-4">
            @guest('web')
                <div class="col-lg-6">
                    <input type="text" name="name" placeholder="Your Name">
                </div>
                <div class="col-lg-6">
                    <input type="tel" name="phone" placeholder="Your Phone">
                </div>
                <div class="col-12">
                    <input type="email" name="email" placeholder="Email">
                </div>
            @else
                
                <span>
                    <img src="{{ asset(Auth::user()->profile_pic) }}" alt="finbiz_buseness" style="width:48px !important">
                    {{ Auth::user()->name }}
                </span>
            @endguest
            
            <div class="col-12">
                <textarea name="comment"></textarea>
            </div>
        </div>
        <button class="rts-btn btn-primary" >Submit Comment</button>
    </form>
</div>

<div>
    @foreach ($comments as $i)
    <div class="comment-area my-2">
        <img src="{{ asset($i['user']['profile_pic']) }}" alt="finbiz_buseness" width="24px">
        <span>{{ $i['user']['name'] }}</span>
        <p>
            {{ $i['message'] }}
        </p>
        
    </div>
    @endforeach
</div>
