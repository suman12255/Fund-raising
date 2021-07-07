@include('include.header')

<div class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h1>Campaign List</h1>
			</div><!-- .col -->
		</div><!-- .row -->
	</div><!-- .container -->
</div><!-- .page-header -->
<br><br>
<div class="featured-cause">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="section-heading">
					<h2 class="entry-title">All Campaign</h2>
				</div><!-- .section-heading -->
			</div><!-- .col -->
		</div><!-- .row -->

		<div class="row">
			<?php
			$get_campaign = DB::table('campaigns')->where('campaign_status',1)->get();
			?>
			@foreach($get_campaign as $campaign)
					<div class="col-12 col-lg-6">
						<div class="cause-wrap d-flex flex-wrap justify-content-between">
							<figure class="m-0">
								<img src="cover_image/{{$campaign->cover_image}}" alt="" style="width:250px;height:250px;">
							</figure>

							<div class="cause-content-wrap">
								<header class="entry-header d-flex flex-wrap align-items-center">
									<h3 class="entry-title w-100 m-0">
										<a href="/campaign-details?id={{$campaign->id}}">
											<h4>{{$campaign->title}}</h4>
										</a>
									</h3>

									<div class="posted-date">
										<a href="#">{{$campaign->created_at}} </a>
									</div><!-- .posted-date -->

									<div class="cats-links">
										<a href="#">
											<h6>Organised
												@if($campaign->university_id=='1')
													All
												@endif
												@if($campaign->university_id=='2')
													Children
												@endif
												@if($campaign->university_id=='3')
												Disasters
												@endif
												@if($campaign->university_id=='4')
													Pandmic
												@endif
											</h6>
										</a>
									</div><!-- .cats-links -->
								</header><!-- .entry-header -->

								<div class="entry-content">
									<p class="m-0">
										This campaign is verified . All the Campaign is accepted after verification.

									</p>
								</div><!-- .entry-content -->

								<div class="entry-footer mt-5">
									<a href="/campaign-details?id={{$campaign->id}}" class="btn gradient-bg mr-2">Donate Now</a>
								</div><!-- .entry-footer -->
							</div><!-- .cause-content-wrap -->

							<div class="fund-raised w-100">
								<?php
								$total = DB::table('pays')->where('campaign_id', $campaign->id)->sum('amount');
								if($total!=Null){
									$percentage=round(($total*100)/$campaign->target_amount);

								}else{
									$percentage=0;
								}
								?>
									<div class="progress">
										<div class="progress-bar bg-success" style="width:{{$percentage}}%">{{$percentage}}%</div>
									</div>

								<div class="fund-raised-details d-flex flex-wrap justify-content-between align-items-center">
									<div class="fund-raised-total mt-4">
										Raised: RS
										 @if($total==Null)
											 0
										 @endif
										@if($total!=Null)
										    {{$total}}
										@endif


									</div><!-- .fund-raised-total -->

									<div class="fund-raised-goal mt-4">
										Goal: RS {{$campaign->target_amount}}
									</div><!-- .fund-raised-goal -->
								</div><!-- .fund-raised-details -->
							</div><!-- .fund-raised -->
						</div><!-- .cause-wrap -->
					</div><!-- .col -->
				@endforeach
		</div><!-- .row -->
	</div><!-- .container -->
</div><!-- .featured-cause -->
<br><br>
@include('include.footer')
