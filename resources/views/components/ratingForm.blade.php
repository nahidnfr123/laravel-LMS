<div class="container-wrapper">
    <div class="container d-flex align-items-center justify-content-center">
        <div class="row justify-content-center">
            <form action="{{route('home.review.store')}}" method="POST">
                @csrf()
                @method('POST')

                <input type="hidden" name="reviewable_id" value="{{$reviewable_id}}">
                <input type="hidden" name="reviewable_type" value="{{$reviewable_type}}">
                <!-- star rating -->
                <div class="rating-wrapper">
                    <!-- star 5 -->
                    <input type="radio" id="5-star-rating" name="rating" value="5">
                    <label for="5-star-rating" class="star-rating">
                        <i class="fa fa-star d-inline-block"></i>
                    </label>

                    <!-- star 4 -->
                    <input type="radio" id="4-star-rating" name="rating" value="4">
                    <label for="4-star-rating" class="star-rating star">
                        <i class="fa fa-star d-inline-block"></i>
                    </label>

                    <!-- star 3 -->
                    <input type="radio" id="3-star-rating" name="rating" value="3">
                    <label for="3-star-rating" class="star-rating star">
                        <i class="fa fa-star d-inline-block"></i>
                    </label>

                    <!-- star 2 -->
                    <input type="radio" id="2-star-rating" name="rating" value="2">
                    <label for="2-star-rating" class="star-rating star">
                        <i class="fa fa-star d-inline-block"></i>
                    </label>

                    <!-- star 1 -->
                    <input type="radio" id="1-star-rating" name="rating" value="1">
                    <label for="1-star-rating" class="star-rating star">
                        <i class="fa fa-star d-inline-block"></i>
                    </label>
                </div>

                <label>
                    <textarea name="review" class="form-control" placeholder="Write your review" rows="3" cols="100"></textarea>
                </label>

                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

<style>
    .rating-wrapper {
        align-self: center;
        border-radius: 5rem;
        display: inline-flex;
        direction: rtl !important;
        margin-left: auto;
    }

    .rating-wrapper label {
        color: #E1E6F6;
        cursor: pointer;
        display: inline-flex;
        font-size: 2rem;
        padding: 1rem .6rem;
        transition: color 0.5s;
    }

    .rating-wrapper svg {
        -webkit-text-fill-color: transparent;
        -webkit-filter: drop-shadow (4px 1px 6px rgba(198, 206, 237, 1));
        filter: drop-shadow(5px 1px 3px rgba(198, 206, 237, 1));
    }

    .rating-wrapper input {
        height: 100%;
        width: 100%;
    }

    .rating-wrapper input {
        display: none;
    }

    .rating-wrapper label:hover,
    .rating-wrapper label:hover ~ label,
    .rating-wrapper input:checked ~ label {
        color: #fff200;
    }

    .rating-wrapper label:hover,
    .rating-wrapper label:hover ~ label,
    .rating-wrapper input:checked ~ label {
        color: #fff200;
    }
</style>
