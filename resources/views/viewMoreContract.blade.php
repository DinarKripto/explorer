@php
    use \App\Http\Controllers\DashboardController;
@endphp

@extends('layouts.landingpage')

@section('title','All Contract Transactions')

@section('content')



    <div class="page_title">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="page_title-content">
                        <p>All Contract Transactions
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
                            <h4 class="card-title">All {{$name}} Transactions</h4>

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
                                          
                                        @foreach($data as $key=>$val)
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
    <input type="hidden" id="method" name="method" value="{{$name}}">


@endsection

@section('javascript')
<script>

function loadData(){
    var method = $('#method').val();
    if(method == 'mint'){
        method = null;
    }
    $.ajax({
            type: "get",
            url: "/api/getAllTransaction",
            datatype: "json",
            success: function (r) {
                var mint = [];
                r.data.forEach(function(item, index) {
                    var input = decodeInput(item.input);
                    if((input.method === null) || input.method === 'MinterFunction')//mint
                    {
                        if(method == 'mint'){
                            mint.push(item);
                        }
                    }
                    else if(input.method === method)//mint
                    {
                        mint.push(item);
                    }
                    
                });
                var content = getContent(mint);
                $("#tblMint tbody").append(content);

            }
        });
}

$('document').ready(function () {
    // loadData();
});

</script>
@endsection
