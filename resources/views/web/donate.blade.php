@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row text-center">
            <div class="col-4">
                <div class="card">
                    <div class="card-header">慷慨解囊</div>
                    <img class="card-img-top" src="/img/alipay.jpeg" alt="支付宝">
                    <div class="card-body">
                        <h5>支付宝支付</h5>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header">慷慨解囊</div>
                    <img class="card-img-top" src="/img/wechatpay.png" alt="微信">
                    <div class="card-body">
                        <h5>微信支付</h5>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header">点滴回馈</div>
                    <img class="card-img-top" src="/img/alipay_red_packet.png" alt="微信">
                    <div class="card-body">
                        <h5>支付宝红包</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
