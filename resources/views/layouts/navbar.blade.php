


<div id="preloader">
    <div class="sk-three-bounce">
        <div class="sk-child sk-bounce1"></div>
        <div class="sk-child sk-bounce2"></div>
        <div class="sk-child sk-bounce3"></div>
    </div>
</div>

<div id="main-wrapper">

    <div class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <nav class="navbar navbar-expand-lg navbar-light px-0 justify-content-between">
                        <a class="navbar-brand" href="{!! route('main') !!}"><img src="/vendors/images/w_logo.png" alt="">
                        </a>


                        <div class="dashboard_log my-2">
                            <div class="d-flex align-items-center">

                                    <div class="form-group has-feedback search">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text"><i class="fa fa-search"></i></label>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Search by Address/Txhash/Block" onkeydown="search(event, this)">
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="sidebar">
        <div class="menu">
            <ul>
                <li>
                    <a href="{{route('main')}}" data-toggle="tooltip" data-placement="right" title="Dashboard">
                        <span><i class="la la-igloo"></i></span>
                    </a>
                </li>
                <li><a href="{{route('Transactions')}}" data-toggle="tooltip" data-placement="right" title="Transactions">
                        <span><i class="la la-exchange-alt"></i></span>
                    </a>
                </li>
                <li><a href="{{route('AccountTransaction')}}" data-toggle="tooltip" data-placement="right" title="Account Transaction">
                        <span><i class="la la-balance-scale"></i></span>
                    </a>
                </li>
                <li><a href="{{route('Audit')}}" data-toggle="tooltip" data-placement="right" title="Audit">
                        <span><i class="la la-calculator"></i></span>
                    </a>
                </li>
                <li><a href="{{route('GoldReserve')}}" data-toggle="tooltip" data-placement="right" title="Gold Reserve">
                        <span><i class="la la-coins"></i></span>
                    </a>
                </li>
                <li><a href="{{route('GoldRedeem')}}" data-toggle="tooltip" data-placement="right" title="Gold Redeem">
                        <span><i class="la la-gifts"></i></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>





