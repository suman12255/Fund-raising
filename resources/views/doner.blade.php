@include('include.header')
{{-- <h1>Doner List</h1>
<table border="1">
    <tr>
        <td>Sn</td>
        <td>Name</td>
        <td>Email</td>
        <td>Phone</td>
        <td>Amount</td>
    </tr>
    <tr>
        @foreach($doners as $doner)
        <tr>
            <td>{{$doner['id']}}</td>
            <td>{{$doner['payer_name']}}</td>
            <td>{{$doner['payer_email']}}</td>
            <td>{{$doner['payer_phone']}}</td>
            <td>{{$doner['amount']}}</td>
            
        </tr>
    @endforeach --}}
    @foreach($doners as $doner)
    
    <div class="page-content page-container" id="page-content">
        <div class="padding">
            <div class="d-flex align-items-center">
                <div class="col-xl-6 col-md-12">
                    <div class="card user-card-full">
                        <div class="row m-l-0 m-r-0">
                            <div class="col-sm-4 bg-c-lite-green user-profile">
                                <div class="card-block text-center text-white">
                                    <div class="m-b-25"> <img src="https://img.icons8.com/bubbles/100/000000/user.png" class="img-radius" alt="User-Profile-Image"> </div>
                                    
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="card-block">
                                    <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600" >Name</p>
                                            <h6 class="text-muted f-w-400">{{$doner['payer_name']}}</h6>
                                          
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600" >Email</p>
                                            <h6 class="text-muted f-w-400">{{$doner['payer_email']}}</h6>
                                          
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Phone</p>
                                            <h6 class="text-muted f-w-400">{{$doner['payer_phone']}}</h6>
                                        </div>
                                    </div>
                                    <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600"></h6>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Amount</p>
                                            <h6 class="text-muted f-w-400">
                                                {{$doner['amount']}}</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Last Donation</p>
                                            <h6 class="text-muted f-w-400">{{$doner['updated_at']}}</h6>
                                            
                                        </div>
                                    </div>
                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    @endforeach
@include('include.footer')
