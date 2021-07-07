@include('include.admin_header');
<?php
//get the total number of raised for uniten
$uniten=DB::table('campaigns')->where('university_id','=',1)->get();
$uniten_sum=0;
if($uniten!=null){
    foreach ($uniten as $un){
        $uniten_total=DB::table('pays')->where('campaign_id','=',$un->id)->sum('amount');
        if($uniten_total!=null){
            $uniten_sum=$uniten_sum+$uniten_total;
        }

    }
}
//-----------------------------------------
//get the total number of raised for iukl
$iukl=DB::table('campaigns')->where('university_id','=',2)->get();
$iukl_sum=0;
if($iukl!=null){
    foreach ($iukl as $ikl){
        $iukl_total=DB::table('pays')->where('campaign_id','=',$ikl->id)->sum('amount');
        if($iukl_total!=null){
            $iukl_sum=$iukl_sum+$iukl_total;
        }

    }
}
//-----------------------------------------
//get the total number of raised for upm
$upm=DB::table('campaigns')->where('university_id','=',3)->get();
$upm_sum=0;
if($upm!=null){
    foreach ($upm as $up){
        $upm_total=DB::table('pays')->where('campaign_id','=',$up->id)->sum('amount');
        if($upm_total!=null){
            $upm_sum=$upm_sum+$upm_total;
        }

    }
}
//-----------------------------------------
//get the total number of raised for upm
$ukm=DB::table('campaigns')->where('university_id','=',4)->get();
$ukm_sum=0;
if($ukm!=null){
    foreach ($ukm as $uk){
        $ukm_total=DB::table('pays')->where('campaign_id','=',$uk->id)->sum('amount');
        if($ukm_total!=null){
            $ukm_sum=$ukm_sum+$ukm_total;
        }

    }
}
//-----------------------------------------
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['All',<?php echo $uniten_sum;?>],
            ['Children',<?php echo $iukl_sum;?>],
            [' Disasters',<?php echo $upm_sum;?>],
            ['Pandmic',<?php echo $ukm_sum;?>]
        ]);

        var options = {
            title: 'Overview of  Campaign Earning',
            pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
    }
</script>
<section class="dashboard-counts section-padding">
    <div class="container-fluid">
        <div class="row">
            <!-- Count item widget-->
            <?php
             $count=DB::table('users')->count();
            $count_campaign=DB::table('campaigns')->count();
            ?>
            <div class="col-xl-2 col-md-4 col-6">
                <div class="wrapper count-title d-flex">
                    <div class="icon"><i class="icon-user"></i></div>
                    <div class="name"><strong class="text-uppercase">Total user</strong>
                        <div class="count-number">{{$count}}</div>
                    </div>
                </div>
            </div>
            <!-- Count item widget-->
            <div class="col-xl-2 col-md-4 col-6">
                <div class="wrapper count-title d-flex">
                    <div class="icon"><i class="icon-padnote"></i></div>
                    <div class="name"><strong class="text-uppercase">Total campaign</strong>
                        <div class="count-number">{{$count_campaign}}</div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<section class="dashboard-counts section-padding">
    <div class="container-fluid">
        <div class="row">
            <!-- Count item widget-->
            <div class="col-xl-2 col-md-4 col-12">
                <div id="donutchart" style="width: 900px; height: 500px;"></div>
            </div>

        </div>
    </div>
</section>
@include('include.admin_footer');
