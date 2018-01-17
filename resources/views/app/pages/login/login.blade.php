@extends('app.login-layout')

@section('page-title')
    <title>Login</title>
@endsection

@section('page-content')

    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <form class="form-horizontal" role="form" method="POST" action="">

                    {{ csrf_field() }}

                    <div class="col-md-12 logo-div">
                        {{--<img src="" alt="">--}}
                        <h3>ADMİN PANEL</h3>
                    </div>

                    <div>
                        <input type="text" name="email" class="form-control" placeholder="Email" required="" />
                    </div>
                    <div>
                        <input type="password" name="password" class="form-control" placeholder="Password" required="" />
                    </div>
                    <div class="text-center">
                        <button class="btn btn-success submit form-control">Giriş</button>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        {{--<p class="change_link">--}}
                            {{--<a>Şifrəni unutmusunuz?</a>--}}
                        {{--</p>--}}
                        <div class="clearfix"></div>
                        <br />

                        <div>
                            <p>&#169; {{date('Y')}} All rights reserved</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>

@endsection
