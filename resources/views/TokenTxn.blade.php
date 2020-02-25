<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TokenTxn - DNC Explorer</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link rel="shortcut icon" href="{!! asset('img/favicon.ico') !!}" type="image/x-icon">


    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/styles.css" rel="stylesheet">
    <!-- <link href="css/auth.css" rel="stylesheet"> -->
</head>
<body>



<div class="container ">
    <div class="main-bg">
        <div class="row ">
            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">

                @include('layouts.navbar')

            </div>
        </div>
    </div>

    <div class="row">


        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12  cont-bg m-p-0">
                <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12 p-l-30">
                    <div class="col-md-2 col-lg-2 p-t-18">
                        <p class=" font-cont m-p-0">
                            CONTRACT
                        </p>
                    </div>
                    <div class="col-md-7 col-lg-7 st p-0-10">
                        <!-- <div class="search-bar  ">
                          <form>
                          <input type="text" name="search" placeholder="Search..">
                       </form>
                      </div> -->
                        <div class="form-group has-feedback contract copy-btn">
                            <!-- <label class="control-label">Font Awesome</label> -->
                            <input type="text" id="contractadd" class="form-control" placeholder="{{$Token_info['ContractAddress']}}" value="{{$Token_info['ContractAddress']}}" readonly>
                            {{--<span class="form-control-feedback">--}}
                            {{--<button class="btn" data-clipboard-target="#contractadd">--}}
                            {{--<i class="fa fa-copy"> </i>--}}
                            {{--</button>--}}
                            {{----}}
                            {{--</span>--}}
                            <span class="form-control-feedback">
                                                                    <button class="btn btn-default js-copy-trigger" id="copy-button" data-clipboard-target="#contractadd" >Copy</button>

                                {{--<button onclick="myFunction()"><i class="fa fa-copy"> </i></button>--}}
                                </span>



                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 p-l-45">
                <div class="font-spon">
                    <p>
                        {{--Sponsored Link: FTEC-Artifical Intelligence trading revolution!SoftCap reached!Get Max Bonus!--}}
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 p-l-45">
                <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12 m-p-0">
                    <div class="ver-table">
                        <h4>Token OverView</h4>
                        <table style="width:100%">
                            <tr>
                                <td>  Total Supply:</td>
                                <td class="text-center" > {{$Token_info['TotalSupply']}} </td>
                            </tr>
                            <tr class="b-t">
                                <td>Name:</td>
                                <td class="text-center">{{$Token_info['name']}}({{$Token_info['symbol']}})</td>
                            </tr>
                            <tr class="b-t">
                                <td>Decimals:</td>
                                <td class="text-center">{{$Token_info['Decimal']}}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="col-md-7 col-lg-7 col-sm-12 col-xs-12 ver-tab-m-2">
                    <div class="ver-table">
                        <h4>Misc</h4>
                        <table style="width:100%">
                            <tr>
                                <td>Contract Creator:</td>
                                <td class="dinar-text">0x1b04CFA261813B95a8C0e6781eD96b08b902C88e </td>
                            </tr>
                            <tr class="b-t b-b">
                                <td>Contract Creation Txn Hash:</td>
                                <td class="ptb"><p class="truncate dis-blok" >

                                        <a href={{route("SearchedHashTransaction",'0xd3cba810ef15298957c32c38adc920f151f05541a35628a33a269223e08c7bc1')                                           }}>0xd3cba810ef15298957c32c38adc920f151f05541a35628a33a269223e08c7bc1</a>
                                    </p></td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        </div>



        <div class="main-bg-2 m-t-10" >
            <div class="row">

                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 ">
                    <div class="tabs-bg">
                        <ul class="nav nav-tabs">
                            <li class="active btn-tab"><a data-toggle="tab" id="contract_txn" href="#"  onclick="showContractTxn()">Contract Transactions</a></li>
                            <li class="btn-tab m-tab"><a data-toggle="tab" id="token_txn" >Token Transactions</a></li>
                        </ul>

                    </div>
                    <div class="tab-content">

                        <div id="token" class="tab-pane fade in active"  >

                            <div class="table-bg">
                                <p class="font-tab m-p-0 p-20">Latest {!! $Token_transactions->firstItem() !!} - {!! $Token_transactions->lastItem() !!}  Txns from a total of {{Session::get('TokenTxn_count')}} Transactions!</p>
                                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                    <hr style="color: #b8b5b5;">
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
                                    <h3 class="tb-head m-p-0">Token Transactions</h3>
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6  ">
                                {{--<div class="right">--}}
                                    {{--<span ><a class="view" href="#" >View All</a></span>--}}
                                    {{--</div>--}}
                                </div>
                                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                    <hr style="color: #b8b5b5;">
                                </div>
                                <div class="clear"></div>




                                <div class="table-responsive">
                                    <table class="table table-fixed tb">
                                        <thead>
                                        <tr>
                                            <td class="">TxnHash</td>
                                            <td class="">Block</td>
                                            <td class="">Age</td>
                                            <td class="">From</td>
                                            <td class="">To</td>
                                            <td class="">Value</td>
                                            <td class="">Gas Price</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $var='';
                                          foreach($Token_transactions as $key=>$val){
                                          if($val['TXNSTATUS']=='false'){
                                           $var.='<tr>';

                                          $var.='<td class=" ellipsis-text overflow-text">';
                                          $var.='<span class="red-star" style=" color: red;">';
                                          $var.='*';
                                          $var.='</span>';
                                          $var.="<a  href='#' id='singleTokenTxn' onclick='getToken(this);' >";
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

                                         /* $var.='<td class=" ">';
                                          $var.='<div class="text-center">';
                                          $var.='<span class="circle text-center">';
                                          $var.='IN';
                                          $var.='</span>';
                                          $var.='</div>';
                                          $var.='</td>';*/

                                          $var.='<td class=" ellipsis-text overflow-text">';
                                          $var.=$val['TOADDRESS'];
                                          $var.='</td>';


                                          $var.='<td class=" ">';
                                          $var.=$val['NUMBEROFTOKENS'].' DNC';
                                          $var.='</td>';

                                          $var.='<td class=" ">';
                                          $var.=$val['GASPRICE'];
                                          $var.='</td>';


                                          $var.='</tr>';
                                          }
                                          else{
                                          $var.='<tr>';
                                          $var.='<td class=" ellipsis-text overflow-text">';
                                          $var.="<a  href='#' id='singleTokenTxn' onclick='getToken(this);' >";
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

                                          /*$var.='<td class=" ">';
                                          $var.='<div class="text-center">';
                                          $var.='<span class="circle text-center">';
                                          $var.='IN';
                                          $var.='</span>';
                                          $var.='</div>';
                                          $var.='</td>';*/

                                          $var.='<td class=" ellipsis-text overflow-text">';
                                          $var.=$val['TOADDRESS'];
                                          $var.='</td>';


                                          $var.='<td class=" ">';
                                          $var.=$val['NUMBEROFTOKENS'].' DNC';
                                          $var.='</td>';

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
                                    {{  $Token_transactions->links()}}
                                </div>         </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>



    </div>





    <!-- footer starts -->

    @include('layouts.footer')
</div>
</div>



<script src="//cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.4.0/clipboard.min.js"></script>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!-- Custom scripts for this template -->
<script src="js/forum-custom.js"></script>


<script>
    // $(document).ready(function() {
    //     $('#home').show();
    //     $('#menu1').hide();
    // });

    function showContractTxn() {
        window.open("/Transactions");

    }

    function myFunction() {
//        var copyText = document.getElementById("contractadd");
//        copyText.select();
//        document.execCommand("copy");
        // alert("Copied the text: " + copyText.value);
    }


    function getToken(a) {
        var hash=a.innerHTML;
        document.location.href="SingleTokenTransaction" + "/"+ hash;
    }
    //    Start Text Copy Tooltip

    $('button').tooltip({
        trigger: 'click',
        placement: 'bottom'
    });

    function setTooltip(btn,message) {
        btn.tooltip('hide')
            .attr('data-original-title', message)
            .tooltip('show');
    }

    function hideTooltip(btn) {
        setTimeout(function() {
            btn.tooltip('hide');
        }, 2000);
    }

    // Clipboard

    var clipboard = new Clipboard('button');

    clipboard.on('success', function(e) {
        var btn = $(e.trigger);
        setTooltip(btn,'Copied!');
        hideTooltip(btn);
    });

    clipboard.on('error', function(e) {
        var btn = $(e.trigger);
        setTooltip('Failed!');
        hideTooltip(btn);
    });

    //    END Text Copy Tooltip


</script>


</body>
</html>
