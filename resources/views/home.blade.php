@php
use \App\Http\Controllers\DashboardController;
@endphp

@extends('layouts.landingpage')

@section('title','Token Overview')

@section('content')

    <div class="page_title">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="page_title-content">
                    <p>Contract Transaction

                    </p>
                </div>
                <br><br>
                    <div class="form-group has-feedback contract copy-btn col-xl-12">

                        <h3>CONTRACT</h3>
                        <br>
                        {{--Start New Copy Button--}}
                        <div class="input-group js-copy-container">
                            <input type="text" id="contractadd" class="form-control js-copy-target" value="{{$Token_info['ContractAddress']}}" placeholder="{{$Token_info['address']}}" readonly>

                            <span class="input-group-btn">
                                    <button class="btn btn-default btn-copy js-copy-trigger" id="copy-button"
                                            data-clipboard-target="#contractadd">Copy</button>

                                </span>
                        </div>
                        {{--End New Copy Button--}}

                    </div>
                </div>
            </div>
        </div>
    </div>

    <section>
        <div class="content-body">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-xl-5 col-lg-5 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="buyer-seller">
                                    <div class="d-flex justify-content-between mb-3">

                                        <div class="seller-info text-right">
                                            <div class="media">
                                                <div class="media-body">
                                                    <h4>Token OverView</h4>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td><span class="">Total Supply:</span></td>
                                            <td><span class="">{{number_format($Token_info['TotalSupply'],3,'.',',') }} DNC</span></td>
                                        </tr>
                                        <tr>
                                            <td>Name:</td>
                                            <td>{{$Token_info['name']}} ({{$Token_info['symbol']}})</td>
                                        </tr>
                                        <tr>
                                            <td>Decimals:</td>
                                            <td>{{$Token_info['Decimal']}}</td>
                                        </tr>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-7 col-lg-7 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="buyer-seller">
                                    <div class="d-flex justify-content-between mb-3">

                                        <div class="seller-info text-right">
                                            <div class="media">
                                                <div class="media-body">
                                                    <h4>Misc</h4>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td><span class="">Contract Creator:</span></td>
                                            <td><span class=" hash-width">{{$Token_info['owner']}}</span></td>
                                        </tr>
                                        <tr>
                                            <td >Contract Txn Hash:</td>
                                            <td class="ptb"><p class="truncate dis-blok">

                                                    <a class="hash-width" href={{route("SearchedHashTransaction",'0xd3cba810ef15298957c32c38adc920f151f05541a35628a33a269223e08c7bc1')                                           }}>0xd3cba810ef15298957c32c38adc920f151f05541a35628a33a269223e08c7bc1</a>
                                                </p></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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
                            <div class="transaction-table1">
                                <h2>Token Transactions</h2>
                                <p>Latest {!! $Token_transactions->firstItem() !!}
                                    - {!! $Token_transactions->lastItem() !!} Txns from a total
                                    of {{Session::get('TokenTxn_count')}} Transactions!</p>
                                <div class="table-responsive">
                                    <table class="table mb-0 table-responsive-sm">
                                        <thead>
                                        <tr>
                                            <th>TxnHash</th>
                                            <th>Block</th>
                                            <th>Age</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Value</th>
                                            <th>Gas Price</th></tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($Token_transactions as $key=>$val)
                                            <tr>
                                                <td class=" ellipsis-text overflow-text">
                                                    @if($val['TXNSTATUS']=='false')
                                                        <span class="red-star" style=" color: red;">*</span>
                                                    @endif
                                                    <a class='hash-width'  href='#' id='singleTokenTxn' onclick='getToken(this);' >{{$val['TXHASH']}}</a>
                                                </td>
                                                <td class="">
                                                    {{$val['BlockNumber']}}
                                                </td>
                                                <td class=" ">
                                                    {{DashboardController::TimeElapseString(date("d-F-Y H:i:s", substr($val["TIME"], 0, 10)))}}
                                                </td>
                                                <td class=" ellipsis-text overflow-text">
                                                    {{$val['FROMADDRESS']}}
                                                </td>
                                                <td class=" ellipsis-text overflow-text">
                                                    {{$val['TOADDRESS']}}
                                                </td>
                                                <td class=" ">
                                                    {{DashboardController::DisplayPrice($val['NUMBEROFTOKENS'])}} DNC
                                                </td>
                                                <td class=" ">
                                                    {{DashboardController::DisplayPrice($val['GASPRICE'])}} ETH
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>

                                    </table>
                                    {{  $Token_transactions->links()}}
                                </div>
                            </div>
                        </div>

{{--                        <div class="card-body">--}}
{{--                            <div class="buy-sell-widget">--}}
{{--                                <ul class="nav nav-tabs">--}}
{{--                                    <li class="nav-item"><a class="nav-link active" data-toggle="tab"--}}
{{--                                                            href="#buy">Contract Transactions</a>--}}
{{--                                    </li>--}}
{{--                                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#sell">Token--}}
{{--                                            Transactions</a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                                <div class="tab-content tab-content-default">--}}
{{--                                    <div class="tab-pane fade" id="buy" role="tabpanel">--}}
{{--                                        <div class="card-body">--}}
{{--                                            <div class="transaction-table1">--}}
{{--                                                <p>Latest {!! $Contract_transactions->firstItem() !!}--}}
{{--                                                    - {!! $Contract_transactions->lastItem() !!} Txns from a total--}}
{{--                                                    of {!! $Contract_transactions->total() !!} Transactions!</p>--}}
{{--                                                <h2>Contract Transactions</h2>--}}
{{--                                                <div class="table-responsive">--}}
{{--                                                    <table class="table mb-0 table-responsive-sm">--}}
{{--                                                        <thead>--}}
{{--                                                            <tr>--}}
{{--                                                                <th>TxnHash</th>--}}
{{--                                                                <th>Block</th>--}}
{{--                                                                <th>Age</th>--}}
{{--                                                                <th>From</th>--}}
{{--                                                                <th>To</th>--}}
{{--                                                                <th>Value</th>--}}
{{--                                                                <th>Gas Price</th>--}}
{{--                                                            </tr>--}}
{{--                                                        </thead>--}}
{{--                                                        <tbody>--}}
{{--                                                        @foreach($Contract_transactions as $key=>$val)--}}
{{--                                                            <tr>--}}

{{--                                                              <td class=" ellipsis-text overflow-text">--}}
{{--                                                                @if($val['txreceipt_status']=='false')--}}
{{--                                                                    <span class="red-star" style=" color: red;">--}}
{{--                                                                        *--}}
{{--                                                                    </span>--}}
{{--                                                                @endif--}}
{{--                                                                <a class="hash-width" href="#" id="singleContractTxn" onclick='getContract(this);'>{{$val['hash']}}</a>--}}
{{--                                                                </td>--}}
{{--                                                                <td class="">--}}
{{--                                                                    {{$val['blockNumber']}}--}}
{{--                                                                </td>--}}
{{--                                                                <td class=" ">--}}
{{--                                                                    {{DashboardController::TimeElapseString(date("d-F-Y H:i:s", substr($val["timeStamp"], 0, 10)))}}--}}
{{--                                                                </td>--}}
{{--                                                                <td class=" ellipsis-text overflow-text">--}}
{{--                                                                    {{$val['from']}}--}}
{{--                                                                </td>--}}
{{--                                                                <td class=" ellipsis-text overflow-text">--}}
{{--                                                                    {{$val['to']}}--}}
{{--                                                                </td>--}}
{{--                                                                <td class=" ">--}}
{{--                                                                    {{DashboardController::DisplayPrice($val['value'])}} ETH--}}
{{--                                                                </td>--}}
{{--                                                                <td class=" ">--}}
{{--                                                                    {{DashboardController::DisplayPrice($val['gasPrice'])}} ETH--}}
{{--                                                                </td>--}}
{{--                                                            </tr>--}}
{{--                                                        @endforeach--}}

{{--                                                        </tbody>--}}
{{--                                                    </table>--}}
{{--                                                    {{  $Contract_transactions->links()}}--}}
{{--                                                </div>--}}
{{--                                            </div>--}}


{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="tab-pane fade show active" id="sell">--}}

{{--                                     --}}


{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                        </div>--}}
                    </div>
                    {{--                <p class="p-4">Note: Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi cupiditate suscipit explicabo voluptas eos in tenetur error temporibus dolorum. Nulla!</p>--}}
                </div>


            </div>


        </div>
    </div>



@endsection



