@extends(layoutExtend('website'))
@section('title')
    {{  trans('home.HomeTitle') }}
@endsection
@section('description')
    {{ trans('website.Footer IGTS') }}
@endsection
@section('keywords')

@endsection
@section('content')

    @include('website.theme.bootstrap.layout.igts.shared.innerPagesHead', ['title' => trans('home.direct pay')])

    <section class="sec sec_pad_top sec_pad_bottom">
        <div class="wrapper row d-flex justify-content-center">

            @if($payment_token)
                <div class="col-md-12" style="height: 600px;position: initial;">
                    @if(getDir() == 'rtl')
                        <iframe name="iframe1" id="myVideo" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" webkitAllowFullScreen mozallowfullscreen allowfullscreen src="https://uae.paymob.com/api/acceptance/iframes/10064?payment_token=<?= $payment_token ?>" title="0" byline="0" portrait="0" width="640" height="360" frameborder="0" allow="autoplay" oncontextmenu="return false"></iframe>
                    @else
                        <iframe name="iframe1" id="myVideo" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" webkitAllowFullScreen mozallowfullscreen allowfullscreen src="https://uae.paymob.com/api/acceptance/iframes/10064?payment_token=<?= $payment_token ?>" title="0" byline="0" portrait="0" width="640" height="360" frameborder="0" allow="autoplay" oncontextmenu="return false"></iframe>
                    @endif
                </div>
                <div class="col-md-12">
                    <a type="button" href="/directpay" class="btn btn-secondary mt-4">Back</a>
                </div>


            @elseif($tamra_token)
                <div class="col-md-12" style="height: 600px;position: initial;">
                        <iframe name="iframe1" id="myVideo" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" webkitAllowFullScreen mozallowfullscreen allowfullscreen src="{{$tamra_token}}" title="0" byline="0" portrait="0" width="640" height="360" frameborder="0" allow="autoplay" oncontextmenu="return false"></iframe>
                </div>
                <div class="col-md-12">
                    <a type="button" href="/directpay" class="btn btn-secondary mt-4">Back</a>
                </div>

            @else
                <form action="" method="POST" style="width: 60%">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="currency">{{trans('home.currency')}}</label>
                        <select class="form-control input-item user-login-ico" id="currency" name="currency" required="required">
                            <option value="">{{trans('home.select currency')}}</option>
                            <option value="USD">{{trans('home.usd')}}</option>
                            <option value="EGP">{{trans('home.egp')}}</option>
                            <option value="AED">{{trans('home.aed')}}</option>
                            <option value="SAR">{{trans('home.sar')}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="currency">{{trans('home.Payment Method')}}</label>
                        <select class="form-control input-item user-login-ico" id="type" name="type" required="required">
                            <option value="">
                                {{trans('home.choose payment method')}}
                            </option>
                            <option value="Visa">{{trans('home.Visa-Master')}}</option>
                            <option value="Tamara">{{trans('home.Tamara')}}</option>
                            <option value="ApplePay">{{trans('home.Apple pay & Google pay')}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="amount">{{trans('home.amount')}}</label>
                        <input type="number" class="form-control" id="amount" name="amount" placeholder="{{trans('home.amount')}}" required="required">
                    </div>

                    @if(!Auth::check())
                        <a href="javascript:void(0)" data-dismiss="modal" data-remote="/login" data-toggle="modal" data-target="#loginModal" class="button button_primary">
                            {{trans('home.pay now')}}
                        </a>
                    @else
                        <button type="submit" class="btn btn-primary">  {{trans('home.pay now')}}</button>
                    @endif

                </form>


        </div>
        @endif
        </div>

    </section>

@endsection