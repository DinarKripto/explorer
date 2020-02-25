<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BlockTxn - DNC Explorer</title>

    <link rel="shortcut icon" href="{!! asset('img/favicon.ico') !!}" type="image/x-icon">


    <!-- Bootstrap core CSS -->
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
   <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/styles.css" rel="stylesheet">
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

                            <div class="form-group has-feedback contract copy-btn">

                                {{--Start New Copy Button--}}
                                <div class="input-group js-copy-container">
                                    <input type="text" id="contractadd" class="form-control js-copy-target" value="{{$Token_info['ContractAddress']}}" placeholder="{{$Token_info['ContractAddress']}}" readonly>
                                    <span class="input-group-btn">
                                    <button class="btn btn-default js-copy-trigger" id="copy-button" data-clipboard-target="#contractadd">Copy</button>
                                        {{--<button class="btn btn-default js-copy-trigger"  onClick="copyToClipboard({{$Token_info['ContractAddress']}})" >Copy</button>--}}
                                </span>
                                </div>
                                {{--End New Copy Button--}}



                            <!-- <label class="control-label">Font Awesome</label> -->
                                {{--<input type="text" id="contractadd" class="form-control" placeholder={{$Token_info['ContractAddress']}} value={{$Token_info['ContractAddress']}} readonly>--}}


                                {{--<span class="form-control-feedback">--}}
                                {{--<button onclick="myFunction()"><i class="fa fa-copy"> </i></button>--}}
                                {{--</span>--}}



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


            <div class="main-bg-2 m-t-10" >
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 ">
                        <div class="tabs-bg1">
                            <div class="clear2"></div>
                            <ul class="nav nav-tabs m-l-10">
                                <li class="active btn-tab"><a data-toggle="tab" href="#home">Transactions</a></li>
                                <!-- <li class="btn-tab m-tab"><a data-toggle="tab" href="#menu1">Tokens</a></li> -->
                            </ul>

                            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 m-p-0">
                                <hr class="m-p-0" style="color: #b8b5b5;">
                            </div>
                            <div class="tab-content">
                                <div id="home" class="tab-pane fade in active">
                                    <div class="table-bg">

                                        <div class="clear"></div>
                                        <div class="table-responsive ver-table-pg3">
                                            <table style="width:100%">
                                                <tr>
                                                    <th class="col-xs-2"> Block Hash</th>
                                                    <td class="" >{{$Block_detail[0]['BLOCKHASH']}}</td>
                                                </tr>

                                                <tr>
                                                    <th class="col-xs-2"> Transactions</th>
                                                   <td class="" > <a href={{route('Block',$Block_detail[0]['BLOCKHASH'])}}>{{sizeof($Block_detail)}} Transactions</a></td>
                                                </tr>

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





        <!-- footer starts -->

    @include('layouts.footer')
    </div>
</div>


