@php
use \App\Http\Controllers\DashboardController;
@endphp

@extends('layouts.landingpage')

@section('title','Dashboard')

@section('content')

    <div class="page_title">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="page_title-content">
                    <p>Dashboard
                        <!--                                <span> Maria Pascle</span>-->
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content-body">
    <div class="container-fluid">
        <div class="margin-rates ">
            <div class="outer-border" >
                <div class="row ">



                    <div class="col-xl-3 col-sm-6 col-12 text-center">
                        <div class="balance-widget">
                            <div class="total-balance">
                                <h4 class="card-title">Block Count </h4>
                                <h3 class="block-value"></h3>
                                <h6>Last Block</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-sm-6 col-12 text-center">
                        <div class="chart-stat">
                            <p class="mb-1">Mint Transactions</p>
                            <h5>  {{$mintCount}}</h5>
                        </div>
                    </div>
                    <div class="col-xl-2 col-sm-6 col-12 text-center">
                        <div class="chart-stat">
                            <p class="mb-1">Burn Transactions</p>
                            <h5>  {{$burnCount}}</h5>
                        </div>
                    </div>
                    <div class="col-xl-2 col-sm-6 col-12 text-center">
                        <div class="chart-stat">
                            <p class="mb-1">Failed Token Txns</p>
                            <h5>  {{$UnsuccessTokenTxn_count}}</h5>
                        </div>
                    </div>
                    <div class="col-xl-2 col-sm-6 col-12 text-center">
                        <div class="chart-stat">
                            <p class="mb-1">DNC Holders</p>
                            <h5>  {{$Account_count}}</h5>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-xxl-12">
                <div class="card">
                    <div class="card-header border-0 py-0">
                        <h4 class="card-title">Mint Transactions</h4>
                        <a href="{{ url('ViewMoreContract/Mint/') }}">View More </a>
                    </div>
                    <div class="card-body">
                        <div class="transaction-table">
                            <div class="table-responsive">
                                <table id="tblMint" class="table mb-0 table-responsive-sm">
                                    <thead>
                                    <tr>
                                        <th>Transaction Hash</th>
                                        <th>Block Number</th>
                                        <th>Timestamp</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @foreach($mint as $key=>$val)
                                            <tr>
                                                @if($val['txreceipt_status']=='0')
                                                    <td >
                                                        <span class="red-star" style=" color: red;">*</span>
                                                        <a class="hash-width" href="#" id="singleContractTxn" onclick="getContract(this);">{{$val['hash']}}</a></td>
                                                @else
                                                    <td >
                                                        <a class='hash-width' href='#' id='singleContractTxn' onclick='getContract(this);' >{{$val['hash']}}</a>
                                                    </td>
                                                @endif
                                                <td class="">
                                                    {{$val['blockNumber']}}
                                                </td>
                                                <td class=" " >
                                                    {{ date("d-F-Y H:i:s", substr($val["timeStamp"], 0, 10)).' ('. DashboardController::TimeElapseString(date("d-F-Y H:i:s", substr($val["timeStamp"], 0, 10))) .')' }}
                                                </td>

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
        
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-xxl-12">
                <div class="card">
                    <div class="card-header border-0 py-0">
                        <h4 class="card-title">Burn Transactions</h4>
                        <a href="{{ url('ViewMoreContract/Burn/') }}">View More </a>
                    </div>
                    <div class="card-body">
                        <div class="transaction-table">
                            <div class="table-responsive">
                                <table id="tblBurn" class="table mb-0 table-responsive-sm">
                                    <thead>
                                    <tr>
                                        <th>Transaction Hash</th>
                                        <th>Block Number</th>
                                        <th>Timestamp</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($burn as $key=>$val)
                                            <tr>
                                                @if($val['txreceipt_status']=='0')
                                                    <td >
                                                        <span class="red-star" style=" color: red;">*</span>
                                                        <a class="hash-width" href="#" id="singleContractTxn" onclick="getContract(this);">{{$val['hash']}}</a></td>
                                                @else
                                                    <td >
                                                        <a class='hash-width' href='#' id='singleContractTxn' onclick='getContract(this);' >{{$val['hash']}}</a>
                                                    </td>
                                                @endif
                                                <td class="">
                                                    {{$val['blockNumber']}}
                                                </td>
                                                <td class=" " >
                                                    {{ date("d-F-Y H:i:s", substr($val["timeStamp"], 0, 10)).' ('. DashboardController::TimeElapseString(date("d-F-Y H:i:s", substr($val["timeStamp"], 0, 10))) .')' }}
                                                </td>

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

        
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-xxl-12">
                <div class="card">
                    <div class="card-header border-0 py-0">
                        <h4 class="card-title">ChangeRate Transactions</h4>
                        <a href="{{ url('ViewMoreContract/ChangeRate/') }}">View More </a>
                    </div>
                    <div class="card-body">
                        <div class="transaction-table">
                            <div class="table-responsive">
                                <table id="tblChangeRate" class="table mb-0 table-responsive-sm">
                                    <thead>
                                    <tr>
                                        <th>Transaction Hash</th>
                                        <th>Block Number</th>
                                        <th>Timestamp</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($changeRate as $key=>$val)
                                            <tr>
                                                @if($val['txreceipt_status']=='0')
                                                    <td >
                                                        <span class="red-star" style=" color: red;">*</span>
                                                        <a class="hash-width" href="#" id="singleContractTxn" onclick="getContract(this);">{{$val['hash']}}</a></td>
                                                @else
                                                    <td >
                                                        <a class='hash-width' href='#' id='singleContractTxn' onclick='getContract(this);' >{{$val['hash']}}</a>
                                                    </td>
                                                @endif
                                                <td class="">
                                                    {{$val['blockNumber']}}
                                                </td>
                                                <td class=" " >
                                                    {{ date("d-F-Y H:i:s", substr($val["timeStamp"], 0, 10)).' ('. DashboardController::TimeElapseString(date("d-F-Y H:i:s", substr($val["timeStamp"], 0, 10))) .')' }}
                                                </td>

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


@endsection
@section('javascript')
<script>



function loadData(){
    $.ajax({
            type: "get",
            url: "api/getAllTransaction",
            datatype: "json",
            success: function (r) {
                var mint = [];
                var burn = [];
                var changeRate = [];
                
                r.data.forEach(function(item, index) {
                    var input = decodeInput(item.input);
                    if((input.method === null && mint.length <=10) || input.method === 'MinterFunction')//mint
                    {
                        mint.push(item);
                    }
                    else if(input.method === 'burn' && burn.length <=10){
                        burn.push(item);
                    }
                    else if(input.method === 'ChangeRate' && changeRate.length <=10){
                        changeRate.push(item);
                    }
                });
                var content = getContent(mint);
                $("#tblMint tbody").append(content);

                content = getContent(burn);
                $("#tblBurn tbody").append(content);

                content = getContent(changeRate);
                $("#tblChangeRate tbody").append(content);

            }
        });
}

$('document').ready(function () {
    // loadData();
    getBlockCount();
});


setInterval(function () {
        getBlockCount();
}, 3000);//time in milliseconds

</script>
@endsection

