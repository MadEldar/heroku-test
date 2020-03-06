<!DOCTYPE html>
<html lang="en">
@include('assignment05/layout/head')
<body>
@include('assignment05/layout/header')

<!-- Start slider -->
<section id="aa-slider">
    <div class="aa-slider-area">
        <div id="sequence" class="seq">
            <div class="seq-screen">
                <ul class="seq-canvas">
                    @foreach($categories as $cat)
                    <!-- single slide item -->
                    <li>
                        <div class="seq-model">
                            <img data-seq src="{{ $cat['thumbnail'] }}" alt="{{ $cat['name'] }}" />
                        </div>
                        <div class="seq-title">
                            <span data-seq>Save Up to 75% Off</span>
                            <h2 data-seq>{{ $cat['name'] }}</h2>
                            <p data-seq>{{ $cat['description'] }}</p>
                            <a data-seq href="/blog/public/assignment05/category?cat={{ $cat['id'] }}" class="aa-shop-now-btn aa-secondary-btn">SHOP NOW</a>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <!-- slider navigation btn -->
            <fieldset class="seq-nav" aria-controls="sequence" aria-label="Slider buttons">
                <a type="button" class="seq-prev" aria-label="Previous"><span class="fa fa-angle-left"></span></a>
                <a type="button" class="seq-next" aria-label="Next"><span class="fa fa-angle-right"></span></a>
            </fieldset>
        </div>
    </div>
</section>
<!-- / slider -->

<!-- Start Promo section -->
<section id="aa-promo">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="aa-promo-area">
                    <div class="row">
                        <!-- promo left -->
                        <?php $first = array_shift($categories) ?>
                        <div class="col-md-5 no-padding">
                            <div class="aa-promo-left">
                                <div class="aa-promo-banner">
                                    <img src="{{ $first['thumbnail'] }}" alt="img">
                                    <div class="aa-prom-content">
                                        <span>75% Off</span>
                                        <h4><a href="/blog/public/assignment05/category?cat={{ $first['id'] }}">{{ $first['name'] }}</a></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- promo right -->
                        <div class="col-md-7 no-padding">
                            <div class="aa-promo-right">
                                @foreach($categories as $cat)
                                    <div class="aa-single-promo-right">
                                        <div class="aa-promo-banner">
                                            <img src="{{ $cat['thumbnail'] }}" alt="img">
                                            <div class="aa-prom-content">
                                                <span>Exclusive Item</span>
                                                <h4><a href="/blog/public/assignment05/category?cat={{ $cat['id'] }}">{{ $cat['name'] }}</a></h4>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- / Promo section -->

<!-- popular section -->
<section id="aa-popular-category">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="aa-popular-category-area">
                        <!-- start prduct navigation -->
                        <ul class="nav nav-tabs aa-products-tab">
                            <li class="active"><a href="#latest" data-toggle="tab">Latest</a></li>
                            <li><a href="#high-cost" data-toggle="tab">Highest Cost</a></li>
                            <li><a href="#low-cost" data-toggle="tab">Lowest Cost</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <!-- start latest product category -->
                            <div class="tab-pane fade in active" id="latest">
                                <ul class="aa-product-catg aa-latest-slider">
                                    @foreach($products['latest'] as $pro)
                                        <!-- start single product item -->
                                        <li>
                                            <figure>
                                                <a class="aa-product-img" href="#"><img src="{{ $pro->product_thumbnail }}" alt="polo shirt img"></a>
                                                <a class="aa-add-card-btn" href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                                                <figcaption>
                                                    <h4 class="aa-product-title"><a href="#">{{ $pro->product_name }}</a></h4>
                                                    <span class="aa-product-price">${{ number_format($pro->price, 2) }}</span>
                                                </figcaption>
                                            </figure>
                                            <div class="aa-product-hvr-content">
                                                <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                                                <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
                                                <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>
                                            </div>
                                            <!-- product badge -->
{{--                                            <span class="aa-badge aa-sale" href="#">SALE!</span>--}}
                                        </li>
                                    @endforeach
                                </ul>
                                <a class="aa-browse-btn" href="#">Browse all Product <span class="fa fa-long-arrow-right"></span></a>
                            </div>
                            <!-- / latest product category -->

                            <!-- Start men popular category -->
                            <div class="tab-pane fade" id="high-cost">
                                <ul class="aa-product-catg aa-popular-slider">
                                    @foreach($products['highCost'] as $pro)
                                        <!-- start single product item -->
                                        <li>
                                            <figure>
                                                <a class="aa-product-img" href="#"><img src="{{ $pro->product_thumbnail }}" alt="polo shirt img"></a>
                                                <a class="aa-add-card-btn" href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                                                <figcaption>
                                                    <h4 class="aa-product-title"><a href="#">{{ $pro->product_name }}</a></h4>
                                                    <span class="aa-product-price">${{ number_format($pro->price, 2) }}</span>
                                                </figcaption>
                                            </figure>
                                            <div class="aa-product-hvr-content">
                                                <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                                                <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
                                                <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>
                                            </div>
                                            <!-- product badge -->
{{--                                            <span class="aa-badge aa-sale" href="#">SALE!</span>--}}
                                        </li>
                                    @endforeach
                                </ul>
                                <a class="aa-browse-btn" href="#">Browse all Product <span class="fa fa-long-arrow-right"></span></a>
                            </div>
                            <!-- / popular product category -->

                            <!-- start featured product category -->
                            <div class="tab-pane fade" id="low-cost">
                                <ul class="aa-product-catg aa-featured-slider">
                                    @foreach($products['lowCost'] as $pro)
                                        <!-- start single product item -->
                                        <li>
                                            <figure>
                                                <a class="aa-product-img" href="#"><img src="{{ $pro->product_thumbnail }}" alt="polo shirt img"></a>
                                                <a class="aa-add-card-btn" href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                                                <figcaption>
                                                    <h4 class="aa-product-title"><a href="#">{{ $pro->product_name }}</a></h4>
                                                    <span class="aa-product-price">${{ number_format($pro->price, 2) }}</span>
                                                    <span class="aa-product-price"><del>${{ number_format($pro->price*2, 2) }}</del></span>
                                                </figcaption>
                                            </figure>
                                            <div class="aa-product-hvr-content">
                                                <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                                                <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
                                                <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>
                                            </div>
                                            <!-- product badge -->
                                            <span class="aa-badge aa-sale" href="#">SALE!</span>
                                        </li>
                                    @endforeach
                                </ul>
                                <a class="aa-browse-btn" href="#">Browse all Product <span class="fa fa-long-arrow-right"></span></a>
                            </div>
                            <!-- / featured product category -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- / popular section -->

<!-- Support section -->
<section id="aa-support">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="aa-support-area">
                    <!-- single support -->
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="aa-support-single">
                            <span class="fa fa-truck"></span>
                            <h4>FREE SHIPPING</h4>
                            <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
                        </div>
                    </div>
                    <!-- single support -->
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="aa-support-single">
                            <span class="fa fa-clock-o"></span>
                            <h4>30 DAYS MONEY BACK</h4>
                            <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
                        </div>
                    </div>
                    <!-- single support -->
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="aa-support-single">
                            <span class="fa fa-phone"></span>
                            <h4>SUPPORT 24/7</h4>
                            <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- / Support section -->

@include('assignment05/layout/footer')

@include('assignment05/layout/scripts')
</body>
</html>
