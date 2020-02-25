@extends('layouts.landingpage')

@section('title','Block')

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

                                                <h2>Account Token Transactions</h2>
                                                <div class="table-responsive">
                                                    <table class="table mb-0 table-responsive-sm">
                                                        <thead>
                                                        <tr>
                                                            <td class="">TxnHash</td>
                                                            <td class="">Block</td>
                                                            <td class="">Age</td>
                                                            <td class="">From</td>
                                                            <td class="">To</td>
                                                            <td class="">Value</td>
                                                            <td class="">[Gas Price]</td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @php
                                                            $var='';
                                                          foreach($Block_detail as $key=>$val){
                                                          if($val['TXNSTATUS']=='0x0'){
                                                           $var.='<tr>';

                                                          $var.='<td class=" ellipsis-text overflow-text">';
                                                          $var.='<span class="red-star" style=" color: red;">';
                                                          $var.='*';
                                                          $var.='</span>';
                                                          $var.="<a class='hash-width'  href='#' id='singleTokenTxn' onclick='getToken(this);' >";
                                                          $var.=$val['TXHASH'];
                                                          $var.='</a>';
                                                          $var.='</td>';

                                                          $var.='<td class="">';
                                                          $var.=$val['BlockNumber'];
                                                          $var.='</td>';

                                                          $time = date("d-F-Y H:i:s", substr($val["TIME"], 0, 10));

                                                          $var.='<td class=" ">';
                                                          $var.=$time;
                                                          $var.='</td>';

                                                          $var.='<td class=" ellipsis-text overflow-text">';
                                                          $var.=$val['FROMADDRESS'];
                                                          $var.='</td>';


                                                          $var.='<td class=" ellipsis-text overflow-text">';
                                                          $var.=$val['TOADDRESS'];
                                                          $var.='</td>';

                                                          if($val['NUMBEROFTOKENS']!='-')
                                                          {
                                                          $var.='<td class=" ">';
                                                          $var.=$val['NUMBEROFTOKENS'].' DNC';
                                                          $var.='</td>';
                                                          }
                                                          else
                                                          {
                                                          $var.='<td class=" ">';
                                                          $var.=$val['VALUE'].' ETHER';
                                                          $var.='</td>';
                                                          }
                                                          $var.='<td class=" ">';
                                                          $var.=$val['GASPRICE'];
                                                          $var.='</td>';


                                                          $var.='</tr>';
                                                          }
                                                          else{
                                                          $var.='<tr>';
                                                          $var.='<td class=" ellipsis-text overflow-text">';
                                                          $var.="<a class='hash-width' href='#' id='singleTokenTxn' onclick='getToken(this);' >";
                                                          $var.=$val['TXHASH'];
                                                          $var.='</a>';
                                                          $var.='</td>';

                                                          $var.='<td class="">';
                                                          $var.=$val['BlockNumber'];
                                                          $var.='</td>';

                                                      $time = date("d-F-Y H:i:s", substr($val["TIME"], 0, 10));

                                                          $var.='<td class=" ">';
                                                          $var.=$time;
                                                          $var.='</td>';

                                                          $var.='<td class=" ellipsis-text overflow-text">';
                                                          $var.=$val['FROMADDRESS'];
                                                          $var.='</td>';



                                                          $var.='<td class=" ellipsis-text overflow-text">';
                                                          $var.=$val['TOADDRESS'];
                                                          $var.='</td>';

                                                          if($val['NUMBEROFTOKENS']!='-')
                                                          {
                                                          $var.='<td class=" ">';
                                                          $var.=$val['NUMBEROFTOKENS'].' DNC';
                                                          $var.='</td>';
                                                          }
                                                          else
                                                          {
                                                          $var.='<td class=" ">';
                                                          $var.=$val['VALUE'].' ETHER';
                                                          $var.='</td>';
                                                          }

                                                          $var.='<td class=" ">';
                                                          $var.=$val['GASPRICE'];
                                                          $var.='</td>';


                                                          $var.='</tr>';
                                                          }
                                                            }
                                                            echo $var;
                                                        @endphp


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
