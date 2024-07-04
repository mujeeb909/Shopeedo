@extends('auth.layouts.authentication')
@section('css')
    <style>
           .btn-primary:hover {
                background-color: #7D9A40 !important;
            }
            .back-btn a:hover {

                color:#7D9A40;
            }
            .back-btn {
                border: 1px solid #7D9A40;
                width: 100%;
            }
            .form-control {
                color:black;
            }
            .otp-button {
                max-width:149px;
                border-radius: 8px;
                border:1px solid #7D9A40;
                /* border-color: ; */
                color: #7D9A40;
            }
            #sendOtpBtn:disabled {
            background-color: grey;
            color: white;
            cursor: not-allowed;
            text-decoration: line-through;
        }
    </style>

@section('content')
    <div class="aiz-main-wrapper d-flex flex-column justify-content-center bg-white">
        <section class="bg-white overflow-hidden" style="min-height:100vh;">
            {{-- style="min-height: 100vh;" --}}
            <div class="row" >
                <!-- Left Side Image-->
                <div class="col-xxl-6 col-lg-7">
                    {{-- <div class="h-100">
                        <img src="{{ uploaded_asset(get_setting('password_reset_page_image')) }}" alt="{{ translate('Password Reset Page Image') }}" class="img-fit h-100">
                    </div> --}}
                    <div style="max-width:581px" class="m-auto pt-2">
                        <img src="{{ static_asset('assets/img/dummy_seller-left.png') }}" alt="" width="581" height="715"  class="img-fit" >
                        {{-- <img src="{{ uploaded_asset(get_setting('forgot_password_page_image')) }}" alt="{{ translate('Forgot Password Page Image') }}" class="img-fit h-100"> --}}
                    </div>
                </div>

                <!-- Right Side -->
                <div class="col-xxl-6 col-lg-5">
                    <div class="right-content">
                        <div class="row align-items-center justify-content-center justify-content-lg-start h-100">
                            <div class="col-xxl-7 p-4 p-lg-5">
                                <!-- Site Icon -->
                                {{-- <div class="size-48px mb-3 mx-auto mx-lg-0">
                                    <img src="{{ uploaded_asset(get_setting('site_icon')) }}" alt="{{ translate('Site Icon')}}" class="img-fit h-100">
                                </div> --}}

                                <!-- Titles -->
                                <div class="text-center text-lg-left">
                                    <h1 class="fs-20 fs-md-20 fw-700 text-primary" >{{ translate('Verify Otp Number') }}</h1>
                                    <h5 class="fs-14 fw-400 text-dark">
                                        {{ translate('Enter 4 digit one time password sent on your email address') }}
                                    </h5>
                                </div>

                                <!-- Reset password form -->
                                <div class="pt-3 pt-lg-4 bg-white">
                                    <div class="">
                                        <form class="form-default" role="form" action="{{ route('password.update') }}" method="POST">
                                            @csrf


                                            <!-- Email -->
                                            {{-- <div class="form-group">
                                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" placeholder="{{ translate('Email') }}" required autofocus>

                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div> --}}

                                            <!-- Code -->
                                            {{-- <div class="form-group">
                                                <input id="code" type="text" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" name="code" value="{{ $email ?? old('code') }}" placeholder="{{translate('Code')}}" required autofocus>

                                                @if ($errors->has('code'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('code') }}</strong>
                                                    </span>
                                                @endif
                                            </div> --}}

                                            <div class="form-group d-flex" style="gap: 5px">
                                                <input type="number" name="otp_1" class="form-control text-center fw-900" required autofocus min="0" max="9" style="color:black" oninput="if(this.value.length > 1) this.value = this.value.slice(0, 1);">
                                                <input type="number" name="otp_2" class="form-control text-center fw-900" required autofocus min="0" max="9" style="color:black" oninput="if(this.value.length > 1) this.value = this.value.slice(0, 1);">
                                                <input type="number" name="otp_3" class="form-control text-center fw-900" required autofocus min="0" max="9" style="color:black" oninput="if(this.value.length > 1) this.value = this.value.slice(0, 1);">
                                                <input type="number" name="otp_4" class="form-control text-center fw-900" required autofocus min="0" max="9" style="color:black" oninput="if(this.value.length > 1) this.value = this.value.slice(0, 1);">
                                            </div>

                                            <div class="d-flex justify-content-between align-items-center">
                                               <div class="d-flex justify-content-between text-black" style="gap:5px">
                                                    <span>OTP expires in </span>
                                                    <div id="timer" class="fw-600">02:00</div>
                                               </div>

                                                <button id="sendOtpBtn" class="py-2 px-3 otp-button" disabled>
                                                    <svg width="23" height="22" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M21.3147 1.18501C21.5195 1.38987 21.6072 1.66757 21.5776 1.93475C21.5693 2.00964 21.5517 2.08371 21.525 2.15512L15.115 20.4693C14.9909 20.8241 14.6627 21.0671 14.2872 21.0824C13.9117 21.0977 13.5648 20.8823 13.4122 20.5388L9.8887 12.611L1.96088 9.08752C1.61742 8.93487 1.40195 8.58803 1.41727 8.21249C1.43259 7.83696 1.6756 7.50882 2.03035 7.38466L20.3445 0.974692C20.4164 0.947795 20.4909 0.930227 20.5663 0.921987C20.6217 0.915897 20.6772 0.914911 20.7322 0.918874C20.9445 0.934039 21.1524 1.02275 21.3147 1.18501ZM17.178 4.02538L4.81833 8.35125L10.3802 10.8232L17.178 4.02538ZM11.6765 12.1195L18.4743 5.32174L14.1485 17.6814L11.6765 12.1195Z" fill="#7D9A40"/>
                                                    </svg>
                                                    Resend OTP
                                                </button>
                                            </div>

                                            <!-- Password -->
                                            {{-- <div class="form-group">
                                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ translate('New Password') }}" required>

                                                @if ($errors->has('password'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                            </div> --}}

                                            <!-- Password Confirmation-->

                                            {{-- <div class="form-group">
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ translate('Reset Password') }}" required>
                                            </div> --}}

                                            <!-- Submit Button -->
                                            {{-- <div class="mb-4 mt-4">
                                                <button type="submit" class="btn btn-primary btn-block fw-700 fs-14 rounded-0">{{ translate('Reset Password') }}</button>
                                            </div> --}}
                                            <div class="mb-4 mt-4">
                                                <button type="submit" class="btn btn-primary btn-block fw-700 fs-14 ">{{ translate('Confirm') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- Go Back -->
                                    {{-- <a href="{{ url()->previous() }}" class="mt-3 fs-14 fw-700 d-flex align-items-center text-primary" style="max-width: fit-content;">
                                        <i class="las la-arrow-left fs-20 mr-1"></i>
                                        {{ translate('Back to Previous Page')}}
                                    </a> --}}
                                    <button class="btn back-btn text-center" style="border:1px solid #7D9A40; " >
                                        <a href="{{ url()->previous() }}" class="fs-14 fw-700 d-flex align-items-center justify-content-center " >
                                            <i class="las la-arrow-left fs-20 mr-1"></i>
                                            {{ translate('Back ')}}
                                        </a>
                                       </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
<script>
    const timerElement = document.getElementById('timer');
        const sendOtpBtn = document.getElementById('sendOtpBtn');
        let timeLeft = 120; // 2 minutes in seconds

        const countdown = setInterval(() => {
            let minutes = Math.floor(timeLeft / 60);
            let seconds = timeLeft % 60;
            timerElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            timeLeft--;

            if (timeLeft < 0) {
                clearInterval(countdown);
                sendOtpBtn.disabled = false;
                timerElement.textContent = "00:00";
            }
        }, 1000);

</script>
@endsection
