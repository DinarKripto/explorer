@php
    use \App\Http\Controllers\DashboardController;
@endphp

@extends('layouts.landingpage')

@section('title','All Token Transactions')

@section('content')


    <div class="page_title">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="page_title-content">
                        <p>View All Token Transactions
                            <!--                                <span> Maria Pascle</span>-->
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body">
        <div class="container-fluid">



            <div class="row">
                <div class="col-xl-12 col-lg-12 col-xxl-12">
                    <div class="card">
                        <div class="card-header border-0 py-0">
                            <h4 class="card-title">Token Transactions</h4>

                        </div>
                        <div class="card-body">
                            <div class="transaction-table">
                                <div class="table-responsive">
                                    <table class="table mb-0 table-responsive-sm">
                                        <thead>
                                        <tr>
                                            <th>Transaction Hash</th>
                                            <th>Block Number</th>
                                            <th>Tokens</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($Token_transactions as $key=>$val)
                                      <tr>
                                        @if($val['TXNSTATUS']=='0x0')
                                            <td >
                                                <span class="red-star" style=" color: red;">*</span>
                                                <a class="hash-width" href="#" id="singleTokenTxn" onclick="getToken(this);">$val['TXHASH']</a></td>
                                        @else
                                            <td >
                                                <a class='hash-width' href='#' id='singleTokenTxn' onclick='getToken(this);' >{{$val['TXHASH']}}</a>
                                            </td>
                                        @endif
                                        <td class="">
                                            {{$val['BlockNumber']}}
                                        </td>
                                        <td class="">
                                            {{DashboardController::DisplayPrice($val['NUMBEROFTOKENS'])}} DNC
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