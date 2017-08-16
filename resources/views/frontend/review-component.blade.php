@if(count($filtered) > 0)

  @foreach($filtered as $review)

  <div class="review-short">
     <div class="avatar">
        <img alt="" class="img-circle img-thumbnail" src="{!! getTheCustomerPic($review->user->id) !!}" />
     </div>
     <div class="body">
      <span class="rating-stars rating-5">
       {!! genRatedStar($review->rating) !!}
      </span>

      <strong class="title">{{ $review->title }}</strong>

      <div class="details">
      <span itemprop="author" itemscope="" itemtype="http://schema.org/Person">
       <strong itemprop="name">{{ $review->user->name }}</strong>
      </span>

      <time class="date relative-time">{{ \Carbon\Carbon::parse($review->created_at)->diffForHumans() }}</time>
      <meta itemprop="datePublished">
      </div>

      <p itemprop="description">
        {{ $review->description }}

      </p>  </div>

     <div class="clearfix"></div>
  </div>

  @endforeach

@endif
