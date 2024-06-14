@extends('auth.layouts.authentication')

@section('content')
<style>
@media screen and (max-width: 1024px) {
  .img-hide {
    display: none;
  }
}
.progress-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px 0;
            position: relative;
        }
        .progress-bar-step {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            text-align: center;
            font-weight: bold;
        }
        .progress-bar-step .circle {
            width: 70px;
            height: 70px;
            background-color: #ddd;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1;
        }
        .progress-bar-step.active .circle {
            background-color: #7d9a40;
            color: #fff;
        }
        .progress-bar-step .label {
            margin-top: 10px;
        }
        .progress-line {
            position: absolute;
            top: 32px;
            left: 7%;
            height: 5px;
            width: calc(100% - 80px); /* Adjust this to change the line width */
            background-color: #ddd;
            z-index: 0;
        }
        .progress-bar-step.active ~ .progress-bar-step .progress-line {
            background-color: #007bff;
        }
      


</style>
<style>
        body {
            display: flex;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .left-panel {
            flex: 1;
            background-color: #6d9243;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        .left-panel img {
            width: 80%;
            height: auto;
            border-radius: 20px;
        }
        .right-panel {
            flex: 1;
            /* background-color: #e6e6e6; */
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .verification-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }
        .progress-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .progress-step {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .circle {
            width: 40px;
            height: 40px;
            background-color: #6d9243;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }
        .circle.inactive {
            background-color: #ddd;
            color: #666;
        }
        .otp-input {
            width: 50px;
            height: 50px;
            margin: 0 5px;
            font-size: 20px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .btn-next {
            width: 100%;
            background-color: #6d9243;
            color: white;
            border: none;
            padding: 10px;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-next:hover {
            background-color: #5b8035;
        }
        .footer-text {
            margin-top: 20px;
            font-size: 14px;
        }
        .footer-text a {
            color: #6d9243;
            text-decoration: none;
        }
        .footer-text a:hover {
            text-decoration: underline;
        }
    </style>
    <div class="aiz-main-wrapper d-flex flex-column justify-content-md-center" style="background-color: #7D9A40;
">
        
        <section class=" overflow-hidden">
            <div class="row no-gutters mt-3 p-4 p-lg-5s" >
                <div class="col-lg-6  img-hide">
                <img src="{{ uploaded_asset(get_setting('seller_register_page_image')) }}" alt="" class="img-fit">
                </div>
                <div class="col-lg-6 p-4 p-lg-5 d-flex flex-column justify-content-center border" style="height: auto; background-color: white; border-radius:22px;">

                                <!-- Titles -->
                                <div class="text-center">
                                    <h1 class="fs-20 fs-md-24 fw-700">{{ translate('Create Account')}}</h1>
                                </div>

                                <!-- heading -->

                                <!-- steps -->
                                <div class="container">
        <div class="progress-container">
            <div class="progress-bar-step active">
                <div class="circle">1</div>
                <div class="label">Step 1</div>
            </div>
            <div class="progress-line"></div>
            <div class="progress-bar-step">
                <div class="circle">2</div>
                <div class="label">Step 2</div>
            </div>
        </div>
    </div>


                                <div class="mb-3 mt-3 text-center">
                    
                                    <span class="">{{ translate('Let’s create your free Shopeedo Business account ')}}</span>
                                                   
                                              
                                </div>


                                <!-- Register form -->
                                <div class="pt-3">
                                    <div class="">

                                     
    
                                        <form id="reg-form" class="form-default" role="form" action="{{ route('register') }}" method="POST">
                                            @csrf
                                         

                                              
                                            <div class="right-panel">
                                            <div class="verification-container">
                                                <h2>Enter OTP for Verification</h2>
                                                
                                                <div class="otp-inputs">
                                                    <input type="text" class="otp-input" maxlength="1">
                                                    <input type="text" class="otp-input" maxlength="1">
                                                    <input type="text" class="otp-input" maxlength="1">
                                                    <input type="text" class="otp-input" maxlength="1">
                                                </div>
                                                <p class="footer-text">
                                                    0:00 <br>
                                                    Haven't Received OTP? <a href="#">Resend Code</a>
                                                </p>
                                                <button class="btn-next">Next</button>
                                                <p class="footer-text">
                                                    Already have an Account? <a href="#">Sign in</a>
                                                </p>
                                            </div>
                                        </div>
                                        </form>
                                       
                                    </div>

                                    <!-- Log In -->
                                    <p class="fs-12 text-gray mb-0">
                                        {{ translate('Already have an account?')}}
                                        <a href="{{ route('user.login') }}" class="ml-2 fs-14 fw-700 animate-underline-primary">{{ translate('Log In')}}</a>
                                    </p>
                                </div>
                            </div>
            </div>
            <div class="mt-3 mr-4 mr-md-0">
                            <a href="{{ url()->previous() }}" class="ml-auto fs-14 fw-700 d-flex align-items-center text-primary" style="max-width: fit-content;">
                                <i class="las la-arrow-left fs-20 mr-1"></i>
                                {{ translate('Back to Previous Page')}}
                            </a>
                        </div>
        </section>
    </div>
@endsection

@section('script')
    @if(get_setting('google_recaptcha') == 1)
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endif

    <script type="text/javascript">
        @if(get_setting('google_recaptcha') == 1)
        // making the CAPTCHA  a required field for form submission
        $(document).ready(function(){
            $("#reg-form").on("submit", function(evt)
            {
                var response = grecaptcha.getResponse();
                if(response.length == 0)
                {
                //reCaptcha not verified
                    alert("please verify you are human!");
                    evt.preventDefault();
                    return false;
                }
                //captcha verified
                //do the rest of your validations here
                $("#reg-form").submit();
            });
        });
        @endif
    </script>
       <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection