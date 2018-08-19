<div class="col-md-6">
    @if(count($product->comments))
    <div id="reviews">
        <ul class="reviews">
            @foreach($product->comments()->paginate(3) as $comment)
                <li>
                    <div class="review-heading">

                        <h5 class="name">{{ $comment->commented->name }}</h5>
                        <p class="date">{{ $comment->created_at }}</p>
                        <div class="review-rating">

                            @for($i = 0; $i < $comment->rate; $i++)

                            <i class="fa fa-star"></i>

                            @endfor
                            @for($i = 0; $i < 5 - $comment->rate; $i++)
                            <i class="fa fa-star-o empty"></i>
                                @endfor

                        </div>
                    </div>
                    <div class="review-body">
                        <p>{{ $comment->comment }}</p>
                    </div>
                </li>
            @endforeach

        </ul>
        <ul class="reviews-pagination">

            {{ $product->comments()->paginate(3)->links('vendor.pagination.custom_comment_pagination') }}
        </ul>
    </div>
        @else
        <div class="reviews">
            <h4><strong>No comments! Be first to leave one.</strong></h4>
        </div>
        @endif
</div>