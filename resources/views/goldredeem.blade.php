@extends('layouts.landingpage')

@section('title','Gold Redeem')

@section('content')
    <div class="page_title">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="page_title-content">
                        <p>Gold Redeem
                        </p>
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

                                                <h2>Gold Redeem</h2>
                                                <br>

                                                <div class="d-flex align-items-center mb-4">

                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <label class="input-group-text"><i class="fa fa-search"></i></label>
                                                            </div>
                                                            <input type="text" class="form-control" placeholder="Search Gold by Series No." onkeydown="searchGoldReserve(event, this)">
                                                        </div>
                                                    </div>
                                                </div>
                                                @if(empty($data['data']))
                                                    No Record found
                                                @endif
                                                <div class="bs-example">
                                                    @foreach ($data as $key=>$val)
                                                        @foreach ($val as $txs)
                                                    <div class="accordion" id="accordion">
                                                        <div class="card">
                                                            <div class="card-header gold-header" id="heading{{$loop->index+1}}">
                                                                    <a  data-toggle="collapse" data-target="#collapse{{$loop->index+1}}"><i class="fa fa-plus plus-minus"></i> Gold Redeem: {{$txs['tx']}} </a>

                                                            </div>
                                                            <div id="collapse{{$loop->index+1}}" class="collapse" aria-labelledby="heading{{$loop->index+1}}" data-parent="#accordion">
                                                            @foreach ($txs['values'] as $row)
                                                                <div class="card-body">
                                                                
                                                                            <h3></h3>
                                                                            <div class="table-responsive">
                                                                                <table class="table">
                                                                                    <tbody>
                                                                                    
                                                                                    <tr>
                                                                                        <td>TX Hash:</td>
                                                                                        <td><a class="hash-width" href="#" id="singleTokenTxn" onclick="getToken(this);">{{$row['tx']}}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Series No:</td>
                                                                                        <td>{{$row['series_no']}}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Weight (Gram):</td>
                                                                                        <td>{{$row['weight']}}</td>

                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Diameter (mm) :</td>
                                                                                        <td>{{$row['diameter']}}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Thickness (mm):</td>
                                                                                        <td>{{$row['thikness']}}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Fineness:</td>
                                                                                        <td>{{$row['fitness']}}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Types:</td>
                                                                                        <td>{{$row['type']}}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Redeem:</td>
                                                                                        <td>{{$row['redeem']}}</td>
                                                                                    </tr>

                                                                                    <tr>
                                                                                        <td>Front Image:</td>


                                                                                        <td>
                                                                                            <a class="lightbox" href="#gold{{$loop->parent->index}}{{$loop->index+1}}">
                                                                                                <img src="{{$minting . '/' . $row['image']}}"/>
                                                                                            </a>
                                                                                            <div class="lightbox-target" id="gold{{$loop->parent->index}}{{$loop->index+1}}">
                                                                                                <img src="{{$minting . '/' . $row['image']}}"/>
                                                                                                <a class="lightbox-close" href="#"></a>
                                                                                            </div>
                                                                                            {{--                                                                        <img src="{{$minting . '/' . $row['image']}}" width='200' height="200px">--}}


                                                                                        </td>
                                                                                    </tr>

                                                                                    <tr>
                                                                                        <td>Back Image:</td>
                                                                                        <td>

                                                                                            <a class="lightbox" href="#goldback{{$loop->parent->index}}{{$loop->index+1}}">
                                                                                                <img src="{{$minting . '/' . $row['image_back']}}"/>
                                                                                            </a>
                                                                                            <div class="lightbox-target" id="goldback{{$loop->parent->index}}{{$loop->index+1}}">
                                                                                                <img src="{{$minting . '/' . $row['image_back']}}"/>
                                                                                                <a class="lightbox-close" href="#"></a>
                                                                                            </div>



                                                                                        {{--                                                                        <img src="{{$minting . '/' . $row['image_back']}}" width='200' height="200px"></td>--}}
                                                                                    </tr>


                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                </div>
                                                                @endforeach

                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @endforeach
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

<script>

    function searchGoldReserve(e, ele) {
        if (e.keyCode === 13) {
            document.location.href = "/GoldRedeem" + "?s=" + ele.value;
            
        }
    }


</script>

