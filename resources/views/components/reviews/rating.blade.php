<div class="col-md-3">
    <div id="rating">
        <div class="rating-avg">
            Average Rating
            <br>
            <span>{{ round($product->averageRate(), 2) }}</span>
            <div class="rating-stars">
                @for($i = 0; $i < round($product->averageRate()); $i++)

                    <i class="fa fa-star"></i>

                @endfor
                @for($i = 0; $i < 5 - round($product->averageRate()); $i++)

                        <i class="fa fa-star-o"></i>

                    @endfor

            </div>
        </div>
    </div>
</div>