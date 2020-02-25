@php
use \App\Http\Controllers\DashboardController;
@endphp

@extends('layouts.landingpage')

@section('title','Contract Transaction')

@section('content')

                <div class="page_title">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="page_title-content">
                                <p>Transaction Info

                                </p>
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
                                <div class="col-xl-1 col-lg-2 col-md-12"></div>

                                <div class="col-xl-10 col-lg-10 col-md-12">
                                    <div class="card outer-border">
                                        <div class="card-body">
                                            <div class="buyer-seller">
                                                <div class="d-flex justify-content-between mb-3">

                                                    <div class="seller-info text-right">
                                                        <div class="media">
                                                            <div class="media-body">
                                                                <h4>Contract Overview</h4>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody>
                                                        <tr>
                                                            <td><span class="">Transaction Hash</span></td>
                                                            <td><span class="">{{$Txn_detail['hash']}}</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tx Receipient status:</td>
                                                            @if($Txn_detail['txreceipt_status']=='0')
                                                                <td class=""><font color="red">Failed!</font></td>
                                                            @else
                                                                <td class=""><font color="green">Success</font></td>
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            <td>Transaction Index:</td>
                                                            <td class=""> {{$Txn_detail['transactionIndex']}}</td>
                                                        </tr>

                                                        <tr>
                                                            <td>From:</td>
                                                            <td>{{$Txn_detail['from']}}</td>
                                                        </tr>

                                                        <tr>
                                                            <td>To:</td>
                                                            <td>{{$Txn_detail['to']}}</td>
                                                        </tr>


                                                        <tr>
                                                            <td>Value:</td>
                                                            <td>{{DashboardController::DisplayPrice($Txn_detail['value'])}} ETH</td>
                                                        </tr>

                                                        <tr>
                                                            <td>Gas Price:</td>
                                                            <td>{{DashboardController::DisplayPrice($Txn_detail['gasPrice'])}} ETH</td>
                                                        </tr>

                                                        <tr>
                                                            <td>Gas:</td>
                                                            <td>{{DashboardController::DisplayPrice($Txn_detail['gas'])}} ETH</td>
                                                        </tr>

                                                        <tr>
                                                            <td>Time:</td>
                                                            <td>
                                                                @php
                                                                    $time = date("d-F-Y H:i:s", substr($Txn_detail["timeStamp"], 0, 10));
                                                                @endphp
                                                                {{$time}}
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>Nounce:</td>
                                                            <td>{{$Txn_detail['nonce']}}</td>
                                                        </tr>

                                                        <tr>
                                                            <td>Input Data:</td>
                                                            <td> <textarea class="textarea1" rows="5" id="comment" readonly> {{$Txn_detail['input']}}</textarea></td>
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
                    </div>


                </section>

@endsection
@section('javascript')
<script>
        const abi = [{"constant":true,"inputs":[],"name":"name","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"spender","type":"address"},{"name":"value","type":"uint256"}],"name":"approve","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"account","type":"address"},{"name":"value","type":"uint256"}],"name":"MinterFunction","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"totalSupply","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"from","type":"address"},{"name":"to","type":"address"},{"name":"value","type":"uint256"}],"name":"transferFrom","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"decimals","outputs":[{"name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"cap","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"spender","type":"address"},{"name":"addedValue","type":"uint256"}],"name":"increaseAllowance","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[],"name":"unpause","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"weiRaised","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"value","type":"uint256"}],"name":"burn","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"account","type":"address"}],"name":"isPauser","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"newRate","type":"uint256"}],"name":"ChangeRate","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"paused","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"renouncePauser","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"owner","type":"address"}],"name":"balanceOf","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"renounceOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"from","type":"address"},{"name":"value","type":"uint256"}],"name":"burnFrom","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"account","type":"address"}],"name":"addPauser","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"_rate","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"pause","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"owner","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"symbol","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"account","type":"address"}],"name":"addMinter","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[],"name":"renounceMinter","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"spender","type":"address"},{"name":"subtractedValue","type":"uint256"}],"name":"decreaseAllowance","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"to","type":"address"},{"name":"value","type":"uint256"}],"name":"transfer","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"account","type":"address"}],"name":"isMinter","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"owner","type":"address"},{"name":"spender","type":"address"}],"name":"allowance","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"beneficiary","type":"address"}],"name":"buyTokens","outputs":[],"payable":true,"stateMutability":"payable","type":"function"},{"constant":false,"inputs":[{"name":"newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"inputs":[{"name":"_name","type":"string"},{"name":"_symbol","type":"string"},{"name":"_decimals","type":"uint8"},{"name":"_cap","type":"uint256"}],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"payable":true,"stateMutability":"payable","type":"fallback"},{"anonymous":false,"inputs":[{"indexed":true,"name":"purchaser","type":"address"},{"indexed":true,"name":"beneficiary","type":"address"},{"indexed":false,"name":"value","type":"uint256"},{"indexed":false,"name":"amount","type":"uint256"}],"name":"TokensPurchased","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"previousOwner","type":"address"},{"indexed":true,"name":"newOwner","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"name":"account","type":"address"}],"name":"Paused","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"name":"account","type":"address"}],"name":"Unpaused","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"account","type":"address"}],"name":"PauserAdded","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"account","type":"address"}],"name":"PauserRemoved","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"account","type":"address"}],"name":"MinterAdded","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"account","type":"address"}],"name":"MinterRemoved","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"},{"indexed":false,"name":"value","type":"uint256"}],"name":"Transfer","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"owner","type":"address"},{"indexed":true,"name":"spender","type":"address"},{"indexed":false,"name":"value","type":"uint256"}],"name":"Approval","type":"event"}];
        const decoder = new InputDataDecoder(abi);
        const data = $('#comment').val();
        
        const result = decoder.decodeData(data);
        $('#comment').val('Data: ' + data + '\n' + 'Human readable format: ' +JSON.stringify(result));
        
        console.log(result);
</script>
@endsection