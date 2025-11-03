@extends('layouts.admin')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Dashboard</a></li>
        </ul>
    </div>
</div>

<div class="row animated fadeInUp">


    

    <div class="col-md-4">
        <h4 class="section-subtitle"><b>Regional</b> DF Status</h4>
        <div class="panel">
            <div class="panel-content">
                <div class="widget-list list-left-element list-sm nano has-scrollbar">
                    <div style="position: relative;" class="dash-box-height-2 nano-content dashboard">
                         <canvas id="bar-chart" width="400" height="250"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

@include('common_pages.common_modal',['modalTitle'=>'Requisition Details'])

@endsection
@section('css')
<style>
.dash-box-height{
    height:262px;
    padding: 10px 10px 0;
}
.dash-box-height-2{
    height:238px;
}
.widget-list.list-left-element.minwidth .left-element {
    min-width: 80px !important;
}
.nano > .nano-content.dashboard{
    position: relative !important;
}
.dropup, .dropdown{
    display: inline-block;
}
.dropdown-menu{
    right: 0;
    left:auto;
}
.middle-align{
    position:absolute;
    width: 100%;
    text-align: center;
    font-size: 18px;
    top:50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

   /* -------------------- */
.dash-box-height h4{
    padding: 0;
    margin:0;
}
.dash-box-height h5{
    padding:10px 0 0;
    margin:0;
    font-size: 20px;
    line-height:26px;
}
.dash-box-heightIn {
    padding:10px;
    margin-bottom:8px;
    position: relative;
    height:calc(100% - 9px);
    background-color: #ededed;
}
   /* ---------------------------------- */

.manageHgt a{
    display: block;
    height:100%;

}
.dash-box-heightIn img{ height: 40px; }
.mild{
    width:100%;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
}
.manageHgt:first-child:nth-last-child(1) {
  height: 100%;
}

/* two items */
.manageHgt:first-child:nth-last-child(2),
.manageHgt:first-child:nth-last-child(2) ~ .manageHgt {
  height: 50%;
}

/* three items */
.manageHgt:first-child:nth-last-child(3),
.manageHgt:first-child:nth-last-child(3) ~ .manageHgt {
  height: 33.3333%;
}

/* four items */
.manageHgt:first-child:nth-last-child(4),
.manageHgt:first-child:nth-last-child(4) ~ .manageHgt {
  height: 25%;
}

/* five items */
.manageHgt:first-child:nth-last-child(5),
.manageHgt:first-child:nth-last-child(5) ~ .manageHgt {
  height: 20%;
}
.manageHgt .col-md-6,
.manageHgt .col-sm-6,
.manageHgt .col-xs-6,
.manageHgt .row{ height: 100% }
.fourBox .dash-box-heightIn{padding:29px 10px; }
.fourBox>div:nth-child(odd){
    padding-right: 5px;

}
.fourBox>div:nth-child(even){
    padding-left: 5px;

}
.manageHgt:first-child:nth-last-child(4) .subtitle,
.manageHgt:first-child:nth-last-child(4) ~ .manageHgt .subtitle{
    font-size: 12px;

}
.manageHgt:first-child:nth-last-child(4) .title,
.manageHgt:first-child:nth-last-child(4) ~ .manageHgt .title{
    font-size: 14px;
    padding:0;
}
.manageHgt:first-child:nth-last-child(4) img,
.manageHgt:first-child:nth-last-child(4) ~ .manageHgt img{
    height: 24px;
}
@media only screen and (max-width: 640px) {
    .dash-box-height{height: auto;}
    .fourBox>div:nth-child(odd){padding-right:15px;}
    .fourBox>div:nth-child(even){padding-left:15px;}
    .fourBox .dash-box-heightIn{padding:9px 10px;}
}
</style>
@stop
@section('script')
    <!--morris chart-->
    <!--Gallery with Magnific popup-->
    <script src="{{ asset('js/examples/dashboard.js') }}"></script>
    <script src="{{ asset('vendor/chart-js/chart.min.js') }}"></script>
    <script>
    //BAR CHART EXAMPLE
    /*==-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*/
    var bar = document.getElementById("bar-chart");
    var options ={
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        };

    var dataBars = {
        labels: ["January", "February", "March", "April", "May"],
        datasets: [
            {
                label: "Stock",
                fill: true,
                backgroundColor: "rgba(0, 145, 123, 1)",
                borderColor: "rgba(0, 145, 123, 1)",
                data: [14, 15, 13, 13, 12]
            },
            {
                label: "Injected",
                fill: true,
                backgroundColor: "rgba(181, 223, 187, 1)",
                borderColor: "rgba(181, 223, 187, 1)",
                data: [12, 13, 11, 6, 9]
            }
        ],
        options: {
            scales: {
                yAxes: [{
                    stacked: true
                }]
            }
        }
    };

    var barChar = new Chart(bar, {
        type: 'horizontalBar',
        data: dataBars,
        options: options

    });

    function getDetails(id){
         var modalBody=$('#modal-body');
          modalBody.css('padding-top',0);
          modalBody.html('');
         $.get(laravelObj.appHost+"/get-requisition-details/"+id, function(data, status){
             //$('#modal-title').html('Requisition Details');
             modalBody.html(data);
          });
        $('#common-modal').modal('show');
      }
    </script>

@stop