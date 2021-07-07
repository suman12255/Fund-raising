@include('include.header')
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Contact</h1>
            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .container -->
</div><!-- .page-header -->

<div class="contact-page-wrap">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-5">
                <div class="entry-content">
                    <h2>Get In touch with us</h2>

                    <p>Share your great experience with FundMe. Please write to us. We are eagerly waiting to hearing from you. Your ideas or any constructive criticism are highly welcomed and appreciated.</p>

                    <ul class="contact-social d-flex flex-wrap align-items-center">
                        <li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                        <li><a href="#"><i class="fa fa-behance"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    </ul>

                    <ul class="contact-info p-0">
                        <li><i class="fa fa-phone"></i><span>+977 9840069707</span></li>
                        <li><i class="fa fa-envelope"></i><span>office@fundme.com</span></li>
                        <li><i class="fa fa-map-marker"></i><span>kathmandu,Nepal</span></li>
                    </ul>
                </div>
            </div><!-- .col -->

            <div class="col-12 col-lg-7">
                <form class="contact-form">
                    <input type="text" placeholder="Name">
                    <input type="email" placeholder="Email">
                    <textarea rows="15" cols="6" placeholder="Messages"></textarea>

                    <span>
                            <input class="btn gradient-bg" type="submit" value="Contact us">
                        </span>
                </form><!-- .contact-form -->

            </div><!-- .col -->

            <div class="col-12">
                <div class="contact-gmap">
                    
                    <iframe width="1200" height="400" frameborder="0" style="border:0" src="https://www.google.com/maps/d/embed?mid=15h33U_uxei_ydHdP1QJ1trYRdeA" width="640" height="480"></iframe>
                </div>
            </div>
        </div><!-- .row -->
    </div><!-- .container -->
</div>
@include('include.footer')