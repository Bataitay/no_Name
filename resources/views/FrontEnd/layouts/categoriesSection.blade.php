<section class="categories">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">
                @foreach ($categoryFe as $categoryAll )
                <div class="col-lg-3">
                    <div class="categories__item set-bg" data-setbg="{{ !empty($categoryAll->image) ? asset($categoryAll->image) : asset('uploads/no_image.jpg') }}">
                        <h5><a href="#">{{ $categoryAll->nameVi }}</a></h5>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
