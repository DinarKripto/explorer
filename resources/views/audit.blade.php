@extends('layouts.landingpage')

@section('title','Audit')

@section('content')

    <div class="page_title">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="page_title-content">
                        <p>Audit</p>
                    </div>
                    <br><br>
                </div>
            </div>
        </div>
    </div>


    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 mb-3">


                    <div class="row ">

                        <div class="col-xl-3 col-sm-6 col-12 text-center">

                        </div>
                        <div class="col-xl-3 col-sm-6 col-12 text-center">
                            <div class="chart-stat">
                                <p class="mb-1">Circulation Supply</p>
                                <h5>  {{$circulation_supply}} DNC</h5>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12 text-center">
                            <div class="chart-stat">
                                <p class="mb-1">Market Cap</p>
                                <h5>  ${{$market_cap}}</h5>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12 text-center">

                        </div>


                    </div>
                </div>


            </div>


        </div>
    </div>


    <section>
        <div class="content-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div id="dnc-chart" style="height: 500px; width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>

    </section>


    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="buy-sell-widget">
                                <div class="tab-content tab-content-default">
                                    <div class="tab-pane fade show active" id="buy" role="tabpanel">
                                        <div class="card-body">
                                            <div class="transaction-table1">
                                              <div class="table-responsive">
                                                    <table class="table mb-0 table-responsive-sm">
                                                        <thead>
                                                        <tr>
                                                            <th>Asset</th>
                                                            <th>% of Porfolio</th>
                                                            <th>Current Balance</th>
                                                            <th>BTC Equivalent</th>
                                                            <th>USD(T) Equivalent</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($grid as $row)
                                                        <tr>
                                                            <td>{{$row["asset"]}}</td>
                                                            <td class="">{{$row["portfolio"]}}%</td>
                                                            <td>{{$row["balance"]}}</td>
                                                            <td>{{$row["btc"]}} BTC</td>
                                                            <td> ${{$row["usd"]}}</td>


                                                        </tr>
                                                        @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>


            </div>


        </div>
    </div>

<input type="hidden" id="hdnChart" name="hdnChart" value='{!! json_encode($chart) !!}'>
@endsection

@section('javascript')
<script>
    
  //Chart JS


am4core.ready(function() {

// $.ajax({
//     type: "GET",
//     cache: false,
//     contentType: "application/json",
//     url: '/api/getAuditData',
//     success: function (res) {
//         console.log(res);

//     },
//     error: function (res, ajaxOptions, thrownError) {
//         console.log(res);
//     }
// });
// Themes begin
    am4core.useTheme(am4themes_dark);
    am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
    var val =  $('#hdnChart').val();
    // alert(val);
    var chart = am4core.create("dnc-chart", am4charts.XYChart);

// Add data
    chart.data = JSON.parse(val);
    var arr = [];
    chart.data.forEach(myFunction);

    function myFunction(item, index) {
        arr.push(item.values);
    }

    var max = Math.max(arr);

    // chart.data = [{
    //     "currency": "Physical Gold",
    //     "values": 50
    // }, {
    //     "currency": "BTC",
    //     "values": 30
    // }, {
    //     "currency": "ETH",
    //     "values": 20
    // },{
    //     "currency": "DDK",
    //     "values": 10
    // }];
// Create axes

    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "currency";
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.renderer.minGridDistance = 30;

    categoryAxis.renderer.labels.template.adapter.add("dy", function(dy, target) {
        if (target.dataItem && target.dataItem.index & 2 == 2) {
            return dy + 25;
        }
        return dy;
    });

    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.title.text = "Equity (%)";
    valueAxis.calculateTotals = true;
    valueAxis.min = 0;
    valueAxis.max = max+100;


// Create series
    var series = chart.series.push(new am4charts.ColumnSeries());
    series.dataFields.valueY = "values";
    series.dataFields.categoryX = "currency";
    series.name = "values";
    series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
    series.columns.template.fillOpacity = .8;


    var columnTemplate = series.columns.template;
    columnTemplate.strokeWidth = 2;
    columnTemplate.strokeOpacity = 1;
    columnTemplate.fillOpacity = .8;
    columnTemplate.strokeOpacity = 0;
    columnTemplate.fill = am4core.color("#ffffff");

}); // end am4core.ready()





</script>
@endsection
