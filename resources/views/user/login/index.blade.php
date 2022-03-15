<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from html.designstream.co.in/redial/style1/default/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 01 Feb 2021 06:08:38 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <!--Plugin CSS-->
    <link href="{{asset('template/css/plugins.min.css')}}" rel="stylesheet">
    <!--main Css-->
    <link href="{{asset('template/css/main.min.css')}}" rel="stylesheet">
</head>
<body>
<!-- main-content-->
<div class="wrapper">
    <div class="w-100">
        <div class="row d-flex justify-content-center  pt-5 mt-5">
            <div class="col-12 col-xl-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h4 class="mb-0 redial-font-weight-400">{{__('data.site.login.sign_in')}}</h4>
                    </div>
                    <div class="redial-divider"></div>
                    <div class="card-body py-4 text-center">
                        <form form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="email" class="form-control" @error('email') is-invalid @enderror  value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{__('data.site.login.email')}}" />
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="{{__('data.site.login.password')}}" @error('password') is-invalid @enderror required autocomplete="current-password"/>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group text-left">
                                <input type="checkbox" id="checkbox11">
                                <label for="checkbox11">{{__('data.site.login.remember')}}</label>
                            </div>

                            <button type="submit" class="btn btn-primary btn-md redial-rounded-circle-50 btn-block">{{__('data.site.login.enter')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End main-content-->

<!-- jQuery -->
<script src="{{asset('template/js/plugins.min.js')}}"></script>
<script src="{{asset('template/js/common.js')}}"></script>
</body>

</html>