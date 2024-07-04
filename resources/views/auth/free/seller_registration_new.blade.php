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
        .round-custom{
            border-radius: 22px;
             background-color: #ECECEC;
      }
      


</style>
    <div class="aiz-main-wrapper d-flex flex-column justify-content-md-center" style="background-color: #fff;
">
        
        <section class=" overflow-hidden">
            <div class="row no-gutters mt-3 p-4 p-lg-5s " >
                <div class="col-lg-6  img-hide">
                    <img src="{{ uploaded_asset(get_setting('seller_register_page_image')) }}" alt="" class="img-fit" style="padding: 80px">
                </div>
                <div class="col-lg-6 p-4 p-lg-5 d-flex flex-column" style="max-width: 700px;">
                               <!-- steps -->
                               <div class="container">
                                <!-- Titles -->
                                <div>
                                    <h1 class="fs-20 fs-md-24 fw-700" style="color: #7D9A40;">{{ translate('Create Account')}}</h1>
                                </div>

                                <!-- heading -->

                             


                                <div class="mb-3 mt-3">
                    
                                    <span class="">{{ translate('Create your free shopeedo seller account')}}</span>
                                                   
                                              
                                </div>


                                <!-- Register form -->
                                <div class="pt-3">
                                    <div class="">
                                        <form id="reg-form" class="form-default" role="form" action="{{ route('register') }}" method="POST">
                                            @csrf
                                            <!-- First Name -->
                                            <!-- <div class="form-group">
                                                <label for="fname" class="fs-12 fw-700 text-soft-dark">{{  translate('First Name') }}</label>
                                                <input type="text" class="form-control round-custom{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('fname') }}" placeholder="{{  translate('First Name') }}" name="fname">
                                                @if ($errors->has('name'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            </div> -->

                                            <!--Last Name -->
                                            <!-- <div class="form-group">
                                                <label for="lname" class="fs-12 fw-700 text-soft-dark">{{  translate('Last Name') }}</label>
                                                <input type="text" class="form-control round-custom{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('lname') }}" placeholder="{{  translate('Last Name') }}" name="lname">
                                                @if ($errors->has('name'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            </div> -->

                                             <!-- phone number -->
                                             <div class="form-group phone-form-group">
                                                    <label for="phone" class="fs-12  text-soft-dark">{{  translate('Mobile Number') }}</label>
                                                    <input type="tel"  class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ old('phone') }}" placeholder="03XX-XXXXXXX" name="phone" autocomplete="off">
                                            </div>

                                            <!--Email -->
                                            @if (addon_is_activated('otp_system'))
                                                <div class="form-group email-form-group">
                                                    <label for="email" class="fs-12 text-soft-dark">{{ translate('Email Address') }}</label>
                                                    <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{ translate('eg. ali@abc.com ') }}" name="email" autocomplete="off">
                                                    @if ($errors->has('email'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            @else
                                                <div class="form-group">
                                                    <label for="email" class="fs-12 fw-700 text-soft-dark">{{ translate('Business Email') }}</label>
                                                    <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{ translate('eg. ali@abc.com ') }}" name="email">
                                                    @if ($errors->has('email'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            @endif

                                               <!--Address -->
                                               <!-- <div class="form-group mt-3">
                                                <label for="address" class="fs-12 fw-700 text-soft-dark">{{  translate('Address') }}</label>
                                                <input type="text" class="form-control round-custom{{ $errors->has('address') ? ' is-invalid' : '' }}" value="{{ old('address') }}" placeholder="{{  translate('Address') }}" name="address" required>
                                                @if ($errors->has('address'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('address') }}</strong>
                                                    </span>
                                                @endif
                                            </div> -->

                                            <!-- Country -->
                                            <!-- <div class="form-group mt-3">
                                                <label for="country" class="fs-12 fw-700 text-soft-dark">{{  translate('Country') }}</label>
                                                <select id="country" class="form-control round-custom" name="country" onchange="updateCityDropdown()">
                                                    <option value="pk">Pakistan</option>
                                                    <option value="Canada">Canada</option>
                                                    <option value="UK">UK</option>
                                                </select>
                                            </div> -->

                                            <!-- City -->
                                            <!-- <div class="form-group mt-3">
                                                <label for="city" class="fs-12 fw-700 text-soft-dark">{{  translate('City') }}</label>
                                                <select id="city" class="form-control round-custom" name="city">
                                                    <option value="lhr">Lahore</option>>
                                                </select>
                                            </div> -->

                                            <!-- password -->
                                            <div class="form-group mb-0">
                                                <label for="password" class="fs-12 text-soft-dark">{{  translate('Password') }}</label>
                                                <div class="position-relative">
                                                    <input type="password" class="form-control { $errors->has('password') ? ' is-invalid' : '' }}" placeholder="************************" name="password">
                                                    <i class="password-toggle las la-2x la-eye"></i>
                                                </div>
                                                <div class="text-right">
                                                    <!-- <span class="fs-12 fw-400 text-gray-dark">{{ translate('Password must contain at least 6 digits') }}</span> -->
                                                </div>
                                                @if ($errors->has('password'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <!-- password Confirm -->
                                            <div class="form-group">
                                                <label for="password_confirmation" class="fs-12  text-soft-dark">{{  translate('Confirm Password') }}</label>
                                                <div class="position-relative">
                                                    <input type="password" class="form-control" placeholder="************************" name="password_confirmation">
                                                    <i class="password-toggle las la-2x la-eye"></i>
                                                </div>
                                            </div>

                                            <!-- Recaptcha -->
                                            @if(get_setting('google_recaptcha') == 1)
                                                <div class="form-group">
                                                    <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_KEY') }}"></div>
                                                </div>
                                                @if ($errors->has('g-recaptcha-response'))
                                                    <span class="invalid-feedback" role="alert" style="display: block;">
                                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                                    </span>
                                                @endif
                                            @endif

                                            <!-- Terms and Conditions -->
                                            <!-- <div class="mb-3">
                                                <label class="aiz-checkbox">
                                                    <input type="checkbox" name="checkbox_example_1" required>
                                                    <span class="">{{ translate('I am authorized to operate the account. ')}} <a href="{{ route('terms') }}" class="fw-500">{{ translate('terms and conditions.') }}</a></span>
                                                    <span class="aiz-square-check"></span>
                                                </label>
                                            </div> -->
                                            <!-- <div class="mb-3">
                                                <label class="aiz-checkbox">
                                                    <input type="checkbox" name="checkbox_example_1" required>
                                                    <span class="">{{ translate('I am authorized to operate the account. ')}}</span>
                                                    <span class="aiz-square-check"></span>
                                                </label>
                                            </div> -->

                                            <!-- Submit Button -->
                                            <div class="mb-4 mt-4">
                                                <button type="submit" class="btn btn-primary btn-block fw-600 round-submit">{{  translate('Create Account') }}</button>
                                            </div>
                                        </form>
                                        
                                        <!-- Social Login -->
                                        @if(get_setting('google_login') == 1 || get_setting('facebook_login') == 1 || get_setting('twitter_login') == 1 || get_setting('apple_login') == 1)
                                            <div class="text-center mb-3">
                                                <span class="bg-white fs-12 text-gray">{{ translate('Or Join With')}}</span>
                                            </div>
                                            <ul class="list-inline social colored text-center mb-4">
                                                @if (get_setting('facebook_login') == 1)
                                                    <li class="list-inline-item">
                                                        <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="facebook">
                                                            <i class="lab la-facebook-f"></i>
                                                        </a>
                                                    </li>
                                                @endif
                                                @if(get_setting('google_login') == 1)
                                                    <li class="list-inline-item">
                                                        <a href="{{ route('social.login', ['provider' => 'google']) }}" class="google">
                                                            <i class="lab la-google"></i>
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (get_setting('twitter_login') == 1)
                                                    <li class="list-inline-item">
                                                        <a href="{{ route('social.login', ['provider' => 'twitter']) }}" class="twitter">
                                                            <i class="lab la-twitter"></i>
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (get_setting('apple_login') == 1)
                                                    <li class="list-inline-item">
                                                        <a href="{{ route('social.login', ['provider' => 'apple']) }}" class="apple">
                                                            <i class="lab la-apple"></i>
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        @endif
                                    </div>

                                    <!-- Log In -->
                                    <p class="fs-12  mb-0">
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