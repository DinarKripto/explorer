
@extends('layouts.landingpage')

@section('title','Account')

@section('content')

    <div class="page_title">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="page_title-content">
                        <p>Hash

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
                                    <div class="justify-content-between mb-3">

                                        <div class="seller-info text-center">
                                            <div class="media">
                                                <div class="media-body">
                                                    <h4>Such DNC Account Address Does Not Exists</h4>

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


    </section>



@endsection
