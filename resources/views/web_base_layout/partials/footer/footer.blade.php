<!-- ==========================
    NEWSLETTER - START
=========================== -->
<section class="separator separator-newsletter" style="display: none">
    <div class="container">
        <div class="newsletter-left">
            <div class="newsletter-badge">
                <span>Subsribe & Get </span>
                <span class="price">$15</span>
                <span>discount</span>
            </div>
        </div>
        <div class="newsletter-right">
            <div class="row">
                <div class="col-sm-6">
                    <div class="newsletter-body">
                        <h3>Newsletter</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua.</p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <form>
                        <div class="input-group input-group-lg">
                            <input type="email" class="form-control" placeholder="Enter email address">
                            <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button">Sign Up</button>
                                </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ==========================
    NEWSLETTER - END
=========================== -->

<!-- ==========================
    FOOTER - START
=========================== -->
<footer class="navbar navbar-default">
    <div class="container">
        <div class="row">

            <div class="col-sm-3 col-xs-6" style="display: none">
                <div class="footer-widget footer-widget-facebook">
                    <h4>Facebook Page</h4>
                    <ul class="list-unstyled row row-no-padding">
                        <li class="col-xs-3"><a href="#"><img src="assets/images/avatar/avatar_01.jpg"
                                                              class="img-responsive" alt=""></a></li>
                        <li class="col-xs-3"><a href="#"><img src="assets/images/avatar/avatar_02.jpg"
                                                              class="img-responsive" alt=""></a></li>
                        <li class="col-xs-3"><a href="#"><img src="assets/images/avatar/avatar_03.jpg"
                                                              class="img-responsive" alt=""></a></li>
                        <li class="col-xs-3"><a href="#"><img src="assets/images/avatar/avatar_04.jpg"
                                                              class="img-responsive" alt=""></a></li>
                        <li class="col-xs-3"><a href="#"><img src="assets/images/avatar/avatar_01.jpg"
                                                              class="img-responsive" alt=""></a></li>
                        <li class="col-xs-3"><a href="#"><img src="assets/images/avatar/avatar_02.jpg"
                                                              class="img-responsive" alt=""></a></li>
                        <li class="col-xs-3"><a href="#"><img src="assets/images/avatar/avatar_03.jpg"
                                                              class="img-responsive" alt=""></a></li>
                        <li class="col-xs-3"><a href="#"><img src="assets/images/avatar/avatar_04.jpg"
                                                              class="img-responsive" alt=""></a></li>
                    </ul>
                    <p>45,500 Likes <a href="#" class="btn btn-default btn-sm"><i class="fa fa-thumbs-up"></i>Like</a>
                    </p>
                </div>
            </div>

            <div class="col-sm-4 col-xs-6">
                <div class="footer-widget footer-widget-links">
                    <h4> @lang('lang.web.categories') </h4>
                    <ul class="list-unstyled">
                        @includeIf('web_base_layout.partials.footer_partials.categories')
                    </ul>
                </div>
            </div>
            <div class="col-sm-4 col-xs-6">
                <div class="footer-widget footer-widget-links">
                    <h4>@lang('lang.web.libraries')</h4>
                    <ul class="list-unstyled">
                        @includeIf('web_base_layout.partials.footer_partials.libraries')

                    </ul>
                </div>
            </div>
            <div class="col-sm-4 col-xs-6">
                <div class="footer-widget footer-widget-contacts">
                    <h4>@lang('lang.web.contact_us') </h4>
                    <ul class="list-unstyled">
                        <li> help@umarket.com<i class="fa fa-envelope"></i></li>
                        <li> 754 213 456<i class="fa fa-phone"></i></li>
                        <li> 40°44'00.9"N 73°59'43.4"W<i class="fa fa-map-marker"></i></li>
                        <li class="social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-tumblr"></i></a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
        <div class="footer-bottom">
            <div class="row">

                <div class="col-sm-6" style="display: none">
                    <ul class="list-inline payment-methods">
                        <li><i class="fa fa-cc-amex"></i></li>
                        <li><i class="fa fa-cc-diners-club"></i></li>
                        <li><i class="fa fa-cc-discover"></i></li>
                        <li><i class="fa fa-cc-jcb"></i></li>
                        <li><i class="fa fa-cc-mastercard"></i></li>
                        <li><i class="fa fa-cc-paypal"></i></li>
                        <li><i class="fa fa-cc-stripe"></i></li>
                        <li><i class="fa fa-cc-visa"></i></li>
                    </ul>
                </div>
                <div class="col-sm-12">
                    <p class="copyright">{{COPYRIGHT}}</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- ==========================
    FOOTER - END
=========================== -->