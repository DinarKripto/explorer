@php
use \App\Http\Controllers\DashboardController;
@endphp
@extends('layouts.landingpage')

@section('title','Account Transaction')

@section('content')

                <div class="page_title">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="page_title-content">
                                    <p>Account Transaction
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
                                    <button class="btn btn-default btn-copy js-copy-trigger" id="copy-button" data-clipboard-target="#contractadd">Copy</button>

                                </span>
                                    </div>
                                    {{--End New Copy Button--}}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>




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

                                                            <h2>Top Account Holders</h2>
                                                            <div class="table-responsive">
                                                                <table class="table mb-0 table-responsive-sm">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>Account Address</th>
                                                                        <th>Balance</th>
                                                                        <th>Distribution</th>

                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach ($Account as $val)
                                                                        <tr>
                                                                            <td>
                                                                            <a class="hash-width" href={!! route("SearchedAccountTransaction", [$val['address']]) !!}>{{$val['address']}}</a>
                                                                            </td>
                                                                            <td>{{number_format($val['balance']/1000000000000000000,3,'.','')}} DNC</td>
                                                                            <td>{{number_format($val['share'],2,'.','')}}%</td>
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



