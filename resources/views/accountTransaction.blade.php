@php
use \App\Http\Controllers\DashboardController;
@endphp

@extends('layouts.landingpage')

@section('title','Address Overview')

@section('content')

                <div class="page_title">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="page_title-content">
                                    <p> Address Overview</p>
                                </div>
                                <br><br>

                                <div class="form-group has-feedback contract copy-btn col-xl-12">

                                    <h3>CONTRACT</h3>
                                    <br>
                                    {{--Start New Copy Button--}}
                                    <div class="input-group js-copy-container">
                                        <input type="text" id="contractadd" class="form-control js-copy-target" value="{{$Token_info['ContractAddress']}}" placeholder="{{$Token_info['ContractAddress']}}" readonly>
                                        <span class="input-group-btn">
                                    <button class="btn btn-default btn-copy js-copy-trigger" id="copy-button" data-clipboard-target="#contractadd">Copy</button>

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

                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="buyer-seller">
                                                <div class="d-flex justify-content-between mb-3">

                                                    <div class="seller-info text-right">
                                                        <div class="media">
                                                            <div class="media-body">
                                                                <h4>Address OverView</h4>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody>
                                                        <tr>
                                                            <td><span class="">Address OverView</span></td>
                                                            <td><span class="">{{$Account}}</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tokens Hold:</td>
                                                            <td>{{number_format($FinalTxnSum/1000000000000000000,3,'.','')}} DNC</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Successful Transfers:</td>
                                                            <td>{{ $FinalTxnCount }}</td>
                                                        </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-7 col-lg-7 col-md-12">

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

                                                            <h2>Account Transactions</h2>
                                                            <div class="table-responsive">
                                                                <table class="table mb-0 table-responsive-sm">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>TxnHash</th>
                                                                        <th>Block</th>
                                                                        <th>Age</th>
                                                                        <th>From</th>
                                                                        <th>Contract </th>
                                                                        <th>Receiver</th>
                                                                        <th>Value</th>
                                                                        <th>Gas Price</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach ($Account_detail as $key=>$val)
                                                                        <tr>
                                                                            <td>
                                                                                <a class="hash-width" href="#" id="singleContractTxn" onclick="getToken(this);">{{$val['TXHASH']}}</a>
                                                                            </td>
                                                                            <td class="">
                                                                                {{$val['BlockNumber']}}
                                                                            </td>
                                                                                
                                                                            <td class=" ">
                                                                            {{ date("d-F-Y H:i:s", substr($val["TIME"], 0, 10))}}
                                                                            </td>
                                                                            <td>
                                                                                {{$val['FROMADDRESS']}}
                                                                            </td>
                                                                            <td >
                                                                                {{$val['TOADDRESS']}}
                                                                            </td>
                                                                            <td >
                                                                                {{$val['TOKENRECEIVERADDRESS']}}
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

@endsection
