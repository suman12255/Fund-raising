@include('include.header')
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Payment Page</h1>
            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .container -->
</div><!-- .page-header -->

<div class="contact-page-wrap">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-5">
                <div class="entry-content">
                    <h2>We Accept Paypal</h2>

                    <p>
                        For now we accept Paypal payments only. In future we will implement all the payment gateway  including online banking. Please pay through your Paypal account by following the steps. Thank You.  </p>

                </div>
            </div><!-- .col -->

            <div class="col-12 col-lg-7">
                @if (session('error'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                   <?php
                    $id=$_GET['id'];
                   ?>
                    @if(Auth::check())
                    <form class="contact-form" method="post" action="{{ route('pay_now') }}">
                        @csrf
                           <input type="hidden" name="campaign_id" value="{{$id}}">
                            <input type="text" placeholder="Your Name" name="name" value="{{Auth::user()->name}}" required>
                            <input type="text" placeholder="Your E-mail" name="email" value="{{Auth::user()->email}}" required>
                            <input type="text" placeholder="Your Phone" name="phone" value="{{Auth::user()->phone}}" required>
                            <input type="number" step="any" placeholder="Enter Amount " name="amount" required>
                            <span>
                            <input class="btn gradient-bg" type="submit" value="Pay with PayPal">
                           </span>
                    </form><!-- .contact-form -->
                    @endif
                    @if(!Auth::check())
                       <form class="contact-form" method="post" action="{{ route('pay_now') }}">
                           @csrf
                            <input type="hidden" name="campaign_id" value="{{$id}}">
                            <input type="text" placeholder="Your Name" name="name" required>
                            <input type="text" placeholder="Your E-mail" name="email" required>
                            <input type="text" placeholder="Your Phone" name="phone" required>
                            <input type="number" class="form-control" step="any" placeholder="Enter Amount" name="amount" required>
                               <span>
                            <input class="btn gradient-bg" type="submit" value="Pay with PayPal">
                           </span>
                       </form><!-- .contact-form -->
                    @endif


            </div><!-- .col -->

        </div><!-- .row -->
    </div><!-- .container -->
</div>


@include('include.footer')
