@extends('admin.layouts.app')
@section('content')

    <div class="account-pages"></div>
    <div class="clearfix"></div>

    <div class="wrapper-page">
        <div class="card-box">
            <div class="panel-heading text-center">
                <img src="{{ $reqData['bigLogo'] }}" height="120" />
                <h4 class="text-center"> <strong>Admin Panel</strong></h4>
            </div>


            <div class="p-20">
                <form id="checkLoginForm" class="form-horizontal m-t-20" action="{{ route('check.login') }}" method="POST">
                    
                    @csrf

                    <div class="form-group-custom">
                        <input type="text" id="email" name="email" required="required" />
                        <label class="control-label" for="email">Email</label><i class="bar"></i>
                        <span role="alert" id="emailErr" style="color:red;font-size: 12px"></span>
                    </div>

                    <div class="form-group-custom">
                        <input type="password" id="password" name="password" required="required" />
                        <label class="control-label" for="password">Password</label><i class="bar"></i>
                        <span role="alert" id="passwordErr" style="color:red;font-size: 12px"></span>
                    </div>

                    <div class="form-group text-center m-t-40">
                        <div class="col-12">
                            <button id="checkLoginBtn" class="btn btn-block text-uppercase waves-effect waves-light" style="background-color: #792b91; color:white;" type="submit">Log In</button>
                        </div>
                    </div>
                    
                    <div class="form-group m-t-30 m-b-0">
                        <div class="col-12">
                            <a href="JavaScript:void(0);" class="btnClickEventDo btn waves-effect waves-light text-dark" style="box-shadow: none;"><i class="fa fa-lock m-r-5"></i> Forgotyour password?</a>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <div class="wrapper-page" style="display: none;">
        <div class=" card-box">
            <div class="panel-heading text-center">
                <img src="{{ $reqData['bigLogo'] }}" height="120" />
                <h4 class="text-center"> <strong>Forgot Password</strong></h4>
            </div>

            <div class="p-20">

                <form id="forgotPasswordForm" method="post" action="{{ route('save.forgotPassword') }}" method="POST">
                    @csrf

                    <div class="alert alert-info alert-dismissable">Enter your <b>Email</b> and OTP will be sent to you!</div>

                    <div class="form-group-custom m-t-40">
                        <input type="text" id="email" name="email" required="required" />
                        <label class="control-label" for="email">Email</label><i class="bar"></i>
                        <span role="alert" id="emailErr" style="color:red;font-size: 12px"></span>
                    </div>

                    <div class="form-group text-center m-t-40">
                        <div class="col-12">
                            <button id="forgotPasswordBtn" class="btn btn-block text-uppercase waves-effect waves-light" type="submit" style="background-color: #0797dd; color: white;">Send otp</button>
                        </div>
                    </div>

                    <div class="form-group m-t-30 m-b-0">
                        <div class="col-12">
                            <a href="JavaScript:void(0);" class="btnClickEventDo btn waves-effect waves-light text-dark" style="box-shadow: none;"><i class="fa fa-lock m-r-5"></i> Login</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>

    <div class="wrapper-page" style="display: none;">
        <div class=" card-box">
            <div class="panel-heading text-center">
                <img src="{{ $reqData['bigLogo'] }}" height="120" />
                <h4 class="text-center"> <strong>Reset Password</strong></h4>
            </div>

            <div class="p-20">
                <form id="resetPasswordForm" method="post" action="{{ route('update.resetPassword') }}" method="POST">
                    @csrf

                    <div class="form-group-custom m-t-40">
                        <input type="text" id="otp" name="otp" required="required" value="{{ old('otp') }}"/>
                        <label class="control-label" for="otp">OTP</label><i class="bar"></i>
                        <span role="alert" id="otpErr" style="color:red;font-size: 12px"></span>
                    </div>

                    <div class="form-group-custom m-t-40">
                        <input type="text" id="password" name="password" required="required" />
                        <label class="control-label" for="password">Password</label><i class="bar"></i>
                        <span role="alert" id="passwordErr" style="color:red;font-size: 12px"></span>
                    </div>

                    <div class="form-group-custom m-t-40">
                        <input type="text" id="confirmPassword" name="confirmPassword" required="required" />
                        <label class="control-label" for="confirmPassword">Re-Password</label><i class="bar"></i>
                        <span role="alert" id="confirmPasswordErr" style="color:red;font-size: 12px"></span>
                    </div>

                    <div class="form-group text-center m-t-40">
                        <div class="col-12">
                            <button id="resetPasswordBtn" class="btn btn-block text-uppercase waves-effect waves-light" type="submit" style="background-color: #0797dd; color: white;">Reset</button>
                        </div>
                    </div>
                    <div class="form-group m-t-30 m-b-0">
                        <div class="col-12">
                            <a href="JavaScript:void(0);" class="btnClickEventDo btn waves-effect waves-light text-dark" style="box-shadow: none;"><i class="fa fa-lock m-r-5"></i> Login</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>


    </div>

@endsection
