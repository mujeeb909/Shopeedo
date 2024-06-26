@extends('delivery_boys.layouts.test')

@section('style')
<style>
.form-group {
            margin: 20px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            box-sizing: border-box;
            margin-bottom: 15px;
        }

        .error-message {
            color: red;
            font-size: 12px;
            display: none;
        }

        .radio-group, .checkbox-container {
            margin-bottom: 15px;
        }

        .ride-button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        .text-center {
            text-align: center;
        }

        .text-white {
            color: #fff;
        }

        .bold {
            font-weight: bold;
        }
</style>
@endsection

@section('content')
    
    {{-- Hero Section --}}
    {{-- <section>
        <div class="container">
            <h1 class="text-center my-5">Join us as a Shopeedo Rider</h1>
            <div class="text-white hero-rider pl-4" style="background-image: url('{{ static_asset('assets/img/background_rider.png') }}');">
                <h2 >اب ملے گا ہر رائیڈر کو ہر رائیڈ پہ کم از کم 70 روپے اور ساتھ ہر کلومیٹر پہ اظافی چارج۔ اب جتنا زیادہ فاصلہ اتنی زیادہ کمائی</h2>
            </div>
        </div>
    </section> --}}

    <section>
        <div class="container">
        <h1 class="text-center mt-5 mb-5 font-weight-bold">Become a Shopeedo Rider</h1>

            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-5 col-sm-12">
                    <div class="left-rider-content" >
                        <div class="image-container d-none d-md-block" >
                            <img src="{{ static_asset('assets/img/rider_image.png') }}" alt="Rider Image" class="responsive-image">
                        </div>
                        
                        <div class="mt-5">
                            <h2>Requirements:</h2>
                            <ul style="font-weight:700">
                                <li>Original CNIC</li>
                                <li>Driving license (learner/permanent)</li>
                                <li>Security deposit</li>
                                <li>Vehicle registration card </li>
                            </ul>
                        </div>
                   </div>
                </div>
                <div class="col-md-5 col-sm-12">
                    <div class="rider-form p-5" style="background-color:#7D9A40; border-radius:10px ">
                        <h4 class="text-white text-center my-5">Enter Rider Details</h4>
                        {{-- <form action="{{ route('delivery.info') }}" method="post" class="form-group">
                            @csrf
                            <input type="text" name="" id="" placeholder="First Name" class="form-control my-3" required pattern="^[A-Za-z]+$" title="First name should only contain letters.">
                            <input type="text" name="" id="" placeholder="Last Name" class="form-control my-3" required >
                            <input type="number" name="" id="" placeholder="Phone Number" class="form-control my-3" required >
                            <select id="vehicle" name="vehicle" class="form-control my-3" required>
                                <option value="" disabled selected>Select Vehicle</option>
                                <option value="car" >Car</option>
                                <option value="bike" >Bike</option>
                            </select>
                            <input type="password" name="password" placeholder="Password" class="form-control my-3" required>
                            <input type="password" name="confirm-password" placeholder="Confirm Password" class="form-control my-3" required>
                
                            <label class="form-label">Are you over 18 years old?</label>
                            <div class="radio-group">
                                <label class="radio-container">
                                    <input type="radio" name="over_18" value="yes">
                                        <span>Yes</span>
                                </label>
                                <label class="radio-container"> 
                                    <input type="radio" name="over_18" value="no">
                                    <span> No</span>
                                </label>
                            </div>

                            <div>
                                <label class="checkbox-container">
                                    <input type="checkbox" name="agreement">
                                    I Agree to <a href="https://dev.shopeedo.com/terms-and-conditions" class="text-white"><strong>Terms & Conditions</strong></a> and Privacy Policy of Shopeedo
                                </label>
                            </div>
                            <div class="text-center">
                            <button class="ride-button"  type="submit" >Submit</button>
                            <div>
                            <label for="" class="text-white mt-2">Already have an Account? <a href="" class="text-white bold">Sign In</a></label>
                        </div>
                            </div>

                        </form> --}}

                        <form action="{{ route('delivery.info') }}" method="post" class="form-group" id="deliveryForm">
                            @csrf
                            <input type="text" name="first_name" id="first-name" placeholder="First Name" class="form-control @error('first_name') is-invalid @enderror" required pattern="^[A-Za-z]+$" title="First name should only contain letters.">
                            <div class="error-message" id="first-name-error">Please enter a valid first name. Only letters are allowed.</div>
                            @error('first_name')
                                <div class="invalid-feedback"> {{ $message }}</div>
                            @enderror
                            
                            <input type="text" name="last_name" id="last-name" placeholder="Last Name" class="form-control @error('last_name') is-invalid @enderror" required pattern="^[A-Za-z]+$" title="Last name should only contain letters.">
                            <div class="error-message" id="last-name-error">Please enter your last name.</div>
                            @error('last_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            
                            <input type="text" name="phone_number" id="phone-number" placeholder="Phone Number" class="form-control @error('phone_number') is-invalid @enderror" required pattern="^\d{11}$" maxlength="11"  title="Phone number should be 11 digits.">
                            <div class="error-message" id="phone-number-error">Please enter a valid phone number with 11 digits.</div>
                            @error('phone_number')
                                <div class="invalid_feedback">{{ $message }}</div>
                            @enderror

                            <select id="vehicle" name="vehicle_type" class="form-control @error('vehichle_type') is-invalid @enderror" required>
                                <option value="" disabled selected>Select Vehicle</option>
                                <option value="car">Car</option>
                                <option value="bike">Bike</option>
                            </select>
                            <div class="error-message" id="vehicle-error">Please select a vehicle.</div>
                            @error('vehicle_type')
                            <div class="invalid_feedback">{{ $message }}</div>
                            @enderror
                        
                            <input type="password" name="password" id="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" required minlength="8">
                            <div class="error-message" id="password-error">Password must be at least 8 characters long.</div>
                            
                            @error('password')
                                <div class="invalid_feedback">{{ $message }}</div>
                            @enderror
                            <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirm Password" class="form-control" required>
                            <div class="error-message" id="confirm-password-error">Passwords do not match.</div>
                    
                            <label class="form-label">Are you over 18 years old?</label>
                            <div class="radio-group">
                                <label class="radio-container">
                                    <input type="radio" name="over_18" class="@error('over_18') is-invalid @enderror" value="yes" required>
                                    <span>Yes</span>
                                </label>
                                <label class="radio-container">
                                    <input type="radio" name="over_18" class="@error('over_18') is-invalid @enderror" value="no" required>
                                    <span>No</span>
                                </label>
                            </div>
                            <div class="error-message" id="over-18-error">Please select an option.</div>
                            @error('over_18')
                                <div class="invalid_feedback">{{ $message }}</div>
                            @enderror
                            
                            <div>
                                <label class="checkbox-container">
                                    <input type="checkbox" name="agreement" id="agreement" class="@error('agreement') is-invalid @enderror" required>
                                    I Agree to <a href="https://dev.shopeedo.com/terms-and-conditions" class="text-white"><strong>Terms & Conditions</strong></a> and Privacy Policy of Shopeedo
                                </label>
                            </div>
                            <div class="error-message" id="agreement-error">You must agree to the terms and conditions.</div>
                            @error('agreement')
                                <div class="invalid_feedback">{{ $message }}</div>
                            @enderror

                            <div class="text-center">
                                <button class="ride-button" type="submit">Submit</button>
                                <div>
                                    <label for="" class="text-white mt-2">Already have an Account? <a href="{{ route('deliveryboy.login') }}" class="text-white bold">Sign In</a></label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-1"></div>

            </div>
        </div>
    </section>

    <section  class="my-5">
        <div class="container p-4">
            <h1 class="text-center font-weight-bold">Why Ride With Shopeedo</h1>
            <div class="row my-5">
                <div class="col-md-6">
                    <div class="d-flex flex-column align-items-center">
                        <svg width="124" height="114" viewBox="0 0 124 114" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.963" fill-rule="evenodd" clip-rule="evenodd" d="M38.3868 0.0175098C43.799 -0.0291958 49.2103 0.0175378 54.6208 0.157683C62.1533 1.92397 65.7609 6.64312 65.4434 14.3152C72.0896 14.2683 78.735 14.3152 85.3798 14.4553C89.2138 15.706 91.5398 18.2759 92.3575 22.1648C92.5475 25.9963 92.5475 29.8275 92.3575 33.659C91.7156 35.6352 90.3391 36.4294 88.2278 36.042C87.1285 35.7075 86.4165 35.0067 86.0918 33.9394C85.997 30.2949 85.9018 26.6504 85.807 23.0059C85.5134 22.1539 84.991 21.453 84.2406 20.9033C77.9899 20.4951 71.7242 20.3549 65.4434 20.4828C65.4909 23.4746 65.4434 26.4651 65.301 29.4538C64.945 30.2026 64.4229 30.8099 63.7345 31.2761C57.955 31.5948 52.164 31.735 46.3614 31.6966C41.0449 31.6498 35.7287 31.6033 30.4123 31.5564C29.1406 31.4687 28.2386 30.8615 27.7066 29.7342C27.5642 26.6518 27.5166 23.568 27.5642 20.4828C21.6776 20.4359 15.7915 20.4828 9.90625 20.6229C8.63448 20.7107 7.73258 21.3179 7.20059 22.4452C7.01071 39.8266 7.01071 57.2081 7.20059 74.5896C7.42445 75.4539 7.94659 76.0611 8.76703 76.4118C23.5766 76.552 38.3865 76.5988 53.1967 76.552C53.332 73.6633 54.8512 72.4954 57.7536 73.0476C58.6556 73.3748 59.2725 73.982 59.6049 74.8699C59.7948 76.6453 59.7948 78.421 59.6049 80.1965C59.5274 81.5808 58.8154 82.4684 57.4688 82.8598C40.9501 83.0467 24.4313 83.0467 7.91261 82.8598C4.60821 81.943 2.28228 79.9338 0.934866 76.8323C0.606485 67.4536 0.464082 58.062 0.507657 48.6575C0.555135 39.6397 0.602583 30.622 0.65006 21.6042C1.5204 17.8503 3.84629 15.4674 7.6278 14.4553C14.2726 14.3152 20.918 14.2683 27.5642 14.3152C27.2472 6.6073 30.8546 1.84141 38.3868 0.0175098ZM38.9564 6.46547C44.2923 6.33614 49.6087 6.47632 54.9056 6.88599C57.9829 8.41012 59.3118 10.8865 58.8928 14.3152C50.5386 14.3152 42.1841 14.3152 33.8299 14.3152C33.5505 10.3679 35.2594 7.7513 38.9564 6.46547ZM33.8299 20.4828C42.1841 20.4828 50.5386 20.4828 58.8928 20.4828C58.8928 22.0715 58.8928 23.6599 58.8928 25.2486C50.5386 25.2486 42.1841 25.2486 33.8299 25.2486C33.8299 23.6599 33.8299 22.0715 33.8299 20.4828Z" fill="#7D9A40"/>
                            <path opacity="0.947" fill-rule="evenodd" clip-rule="evenodd" d="M86.3551 43C102.42 43.421 113.9 50.6991 120.795 64.8342C126.573 80.8757 123.095 94.6388 110.363 106.123C99.4774 114.199 87.569 116.065 74.637 111.722C73.0311 109.848 73.1263 108.076 74.9229 106.403C75.5042 106.122 76.1232 105.982 76.7806 105.983C92.366 110.196 104.56 105.717 113.364 92.5469C118.691 81.8003 118.024 71.443 111.363 61.4751C102.729 51.2531 91.7257 47.4741 78.3525 50.1381C75.9426 48.4821 75.7523 46.6158 77.7809 44.5396C78.6806 44.0903 79.6332 43.8104 80.639 43.6998C82.5879 43.4725 84.4931 43.2391 86.3551 43Z" fill="#7D9A40"/>
                            <path opacity="0.902" fill-rule="evenodd" clip-rule="evenodd" d="M69.75 49.0386C71.9423 48.7816 73.1923 49.8078 73.5 52.1177C73.3973 52.895 73.1473 53.6088 72.75 54.2597C71.77 55.1638 70.645 55.7438 69.375 56C67.5875 55.8704 66.629 54.8441 66.5 52.9209C66.6085 52.2157 66.8167 51.5463 67.125 50.9128C67.9603 50.1789 68.8352 49.5543 69.75 49.0386Z" fill="#7D9A40"/>
                            <path opacity="0.917" fill-rule="evenodd" clip-rule="evenodd" d="M60.2262 58C63.872 57.9952 65.1853 59.6797 64.1659 63.0534C63.375 64.2474 62.5483 65.4172 61.6853 66.5626C57.8037 67.7903 56.1012 66.4335 56.5783 62.4919C57.1386 61.6948 57.6251 60.8526 58.0375 59.9652C58.5459 59.0539 59.2754 58.3989 60.2262 58Z" fill="#7D9A40"/>
                            <path opacity="0.944" fill-rule="evenodd" clip-rule="evenodd" d="M86.9346 60.0081C88.7655 59.9047 89.9765 60.789 90.5678 62.661C90.7024 67.1798 90.7473 71.6995 90.7024 76.2203C92.8573 76.1714 95.0103 76.2203 97.1614 76.3677C99.503 77.4781 100.086 79.2959 98.9107 81.8209C98.4857 82.2751 97.9922 82.6191 97.4305 82.8525C93.7524 83.0492 90.0745 83.0492 86.3964 82.8525C85.8248 82.5218 85.3314 82.0797 84.9162 81.5261C84.4737 75.1656 84.3841 68.7789 84.6471 62.3663C85.0359 61.1041 85.7984 60.3179 86.9346 60.0081Z" fill="#7D9A40"/>
                            <path opacity="0.919" fill-rule="evenodd" clip-rule="evenodd" d="M58.2855 87C59.4982 87.0835 60.5121 87.6334 61.3273 88.6504C62.2114 90.445 62.9357 92.3152 63.5 94.2616C62.7766 97.7545 60.942 98.7998 57.9958 97.3973C56.1392 95.0957 55.3185 92.4003 55.5335 89.3105C56.1378 88.0084 57.0552 87.238 58.2855 87Z" fill="#7D9A40"/>
                            <path opacity="0.909" fill-rule="evenodd" clip-rule="evenodd" d="M67.2545 100.034C68.9169 99.8156 70.2311 100.641 71.1966 102.509C72.0927 106.602 71.0038 108.407 67.9303 107.923C66.9069 107.147 66.1185 106.064 65.565 104.675C65.2965 102.525 65.8597 100.978 67.2545 100.034Z" fill="#7D9A40"/>
                            </svg> 
                        <h5 class=" font-weight-bold mt-2">Flexible Schedule</h5>
                        <p class="mb-5">Work at your own convenience.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex flex-column align-items-center">
                        <svg width="103" height="106" viewBox="0 0 103 106" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.948" fill-rule="evenodd" clip-rule="evenodd" d="M50.042 0.513447C50.8456 0.477437 51.6457 0.513752 52.4428 0.622373C55.1322 2.25565 58.0421 3.16335 61.1726 3.34552C64.3641 3.11874 67.3466 2.21101 70.1208 0.622373C73.829 0.332304 75.3203 2.03882 74.5948 5.74189C74.0708 8.92337 73.3069 12.0459 72.3032 15.1095C75.6271 17.174 76.6821 20.0787 75.4678 23.8236C75.1018 24.554 74.6291 25.2076 74.0492 25.7842C75.5324 27.446 77.1328 29.0074 78.8506 30.4681C84.6246 35.795 89.0257 42.0765 92.0546 49.3122C94.4612 55.916 94.4976 62.5241 92.1637 69.1367C95.016 69.467 97.7076 70.3022 100.239 71.642C102.88 74.1907 103.207 76.9864 101.221 80.0293C100.622 80.5278 100.004 80.9998 99.3658 81.4454C88.0541 87.8532 76.7782 94.3163 65.5376 100.834C62.1421 102.711 58.5775 104.163 54.8435 105.191C52.1374 105.666 49.4458 105.593 46.7683 104.973C38.3034 101.661 29.8645 98.284 21.4517 94.8432C21.3109 96.088 21.1291 97.3226 20.9061 98.5467C20.6331 99.1743 20.1603 99.5737 19.4875 99.7449C13.7403 99.8902 7.99314 99.8902 2.24598 99.7449C1.13984 99.3902 0.594223 98.6278 0.609129 97.4575C0.463624 84.7495 0.463624 72.0414 0.609129 59.3334C0.677397 58.3607 1.15025 57.6708 2.02773 57.2638C7.9204 57.1185 13.8131 57.1185 19.7057 57.2638C20.1693 57.5082 20.5693 57.835 20.9061 58.2441C21.1983 59.753 21.3074 61.278 21.2335 62.819C23.998 62.819 26.7623 62.819 29.5268 62.819C29.0037 56.3397 30.277 50.2398 33.3462 44.5195C34.9939 41.7136 36.8128 39.0268 38.8023 36.459C42.0396 32.937 45.4224 29.5603 48.9508 26.3289C46.3033 23.7589 45.8305 20.8179 47.5322 17.5059C48.35 16.5791 49.2594 15.7804 50.2603 15.1095C48.7291 11.1761 47.8925 7.10956 47.7505 2.90982C48.1239 1.70266 48.8877 0.903859 50.042 0.513447ZM52.661 6.17759C58.2627 8.78375 63.8645 8.78375 69.466 6.17759C69.1731 9.12567 68.4457 11.9941 67.2835 14.7827C63.2076 14.9642 59.1338 14.9279 55.0617 14.6738C54.0231 11.9059 53.2228 9.0738 52.661 6.17759ZM52.661 19.4665C58.3359 19.4302 64.0103 19.4665 69.6843 19.5755C71.2185 19.9415 71.6188 20.8493 70.8846 22.2986C70.7209 22.435 70.5389 22.5439 70.339 22.6254C64.2281 22.7707 58.1172 22.7707 52.0063 22.6254C50.7059 21.2353 50.9242 20.1824 52.661 19.4665ZM54.1887 27.5271C59.1362 27.4907 64.0832 27.5271 69.0295 27.636C72.0433 30.7166 75.135 33.7304 78.305 36.6768C81.917 40.4711 84.8269 44.7556 87.0349 49.5301C89.2357 54.7629 89.6722 60.1366 88.3444 65.6511C87.9203 66.9207 87.4111 68.1553 86.8166 69.3546C81.0615 71.5368 75.4597 74.0783 70.0116 76.9794C68.9444 73.1537 66.4346 71.0841 62.4821 70.7706C58.0445 70.6981 53.6067 70.6253 49.1691 70.5528C45.0697 66.4373 40.1227 64.0046 34.3283 63.2547C33.6916 57.4825 34.7464 52.0362 37.4928 46.9159C39.2633 43.6967 41.3731 40.7195 43.822 37.9839C47.0291 34.7098 50.3028 31.5146 53.6431 28.3985C53.7876 28.0752 53.9696 27.7848 54.1887 27.5271ZM5.30144 61.7298C9.01163 61.7298 12.7218 61.7298 16.432 61.7298C16.432 72.8402 16.432 83.9507 16.432 95.0611C12.7206 95.0822 9.01039 95.1548 5.30144 95.2789C5.30144 84.096 5.30144 72.9128 5.30144 61.7298ZM21.2335 67.6118C25.0172 67.5754 28.8001 67.6118 32.5823 67.7207C36.04 68.0723 39.241 69.1616 42.1852 70.9885C44.0586 72.2766 45.8046 73.729 47.4231 75.3455C52.5154 75.4181 57.608 75.4908 62.7004 75.5634C65.1613 76.3291 65.7796 77.8179 64.5555 80.0293C64.1331 80.3783 63.6604 80.6326 63.1369 80.7918C54.3343 80.8643 45.5315 80.9371 36.729 81.0097C35.1585 81.9525 34.8311 83.2235 35.7469 84.8221C36.0208 84.977 36.2752 85.1584 36.5107 85.3667C45.7498 85.512 54.989 85.512 64.2281 85.3667C65.1489 85.1251 66.0219 84.7621 66.847 84.2774C67.4485 83.5309 68.1762 82.9501 69.0295 82.5346C74.7504 79.7882 80.4975 77.1014 86.271 74.4741C90.0109 73.5312 93.6484 73.8216 97.1834 75.3455C97.4887 75.5769 97.7069 75.8673 97.8381 76.2169C97.5498 76.7951 97.1133 77.2308 96.5286 77.524C85.3625 83.8594 74.2319 90.2496 63.1369 96.695C61.007 97.8306 58.8245 98.8474 56.5894 99.7449C53.3411 101.213 50.0674 101.285 46.7683 99.9628C38.3381 96.5647 29.8994 93.188 21.4517 89.8326C21.2335 82.4272 21.1608 75.0203 21.2335 67.6118Z" fill="#7D9A40"/>
                            <path opacity="0.95" fill-rule="evenodd" clip-rule="evenodd" d="M62.2043 33.5015C64.8477 33.449 65.8551 34.7678 65.2261 37.4579C68.7841 37.6007 70.7986 39.469 71.2698 43.0627C71.1846 45.1974 70.1053 46.0034 68.0321 45.4805C67.0362 44.9552 66.5685 44.1127 66.6291 42.9528C66.5212 42.5499 66.2693 42.2934 65.8737 42.1835C64.0029 42.0369 62.1324 42.0369 60.2617 42.1835C59.9528 42.2857 59.7011 42.4691 59.5062 42.733C59.3622 44.3448 59.3622 45.9568 59.5062 47.5686C59.686 47.7517 59.866 47.935 60.0458 48.1181C69.6615 46.847 73.223 50.9865 70.7302 60.5367C69.5446 62.7345 67.7099 63.7603 65.2261 63.6139C65.8391 66.4664 64.7599 67.7485 61.9884 67.4603C61.3666 67.1854 60.9709 66.7093 60.8013 66.0317C60.6936 65.2289 60.6577 64.4232 60.6934 63.6139C57.1392 63.4752 55.1247 61.6069 54.6497 58.009C54.8703 56.0273 55.9495 55.2213 57.8873 55.5912C58.8913 56.2047 59.4309 57.1206 59.5062 58.3387C59.686 58.5218 59.866 58.7051 60.0458 58.8882C61.9884 59.0348 63.931 59.0348 65.8737 58.8882C66.2693 58.7783 66.5212 58.5218 66.6291 58.1189C66.7731 56.7269 66.7731 55.3347 66.6291 53.9427C66.5288 53.6282 66.3487 53.3719 66.0895 53.1735C56.204 54.3173 52.6425 50.0312 55.4051 40.3153C56.6341 38.3522 58.397 37.3996 60.6934 37.4579C60.5705 36.298 60.7506 35.199 61.233 34.1609C61.5895 33.9633 61.9133 33.7435 62.2043 33.5015Z" fill="#7D9A40"/>
                            </svg>
                             
                        <h5 class=" font-weight-bold mt-2">Great Earnings </h5>
                        <p>Competitive pay for every delivery.</p>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-6">
                    <div class="d-flex flex-column align-items-center">
                        <svg width="124" height="114" viewBox="0 0 124 114" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.953" fill-rule="evenodd" clip-rule="evenodd" d="M35.5994 0C36.3999 0 37.2006 0 38.001 0C40.9517 2.67234 43.9137 5.35557 46.8872 8.04969C51.3305 6.48443 55.8134 5.03101 60.3364 3.68944C64.2631 3.0543 68.1058 3.35243 71.8644 4.58385C78.2439 7.33 84.4882 10.3114 90.5973 13.528C92.0762 14.0399 93.5975 14.3753 95.1605 14.5342C95.0252 13.2311 95.5855 12.2995 96.8416 11.7391C99.322 11.6274 101.804 11.5901 104.287 11.6273C104.213 10.5613 104.333 9.51782 104.647 8.49689C105.116 7.96168 105.716 7.62628 106.448 7.49068C111.412 7.34161 116.375 7.34161 121.339 7.49068C122.306 7.5666 123.027 7.97653 123.5 8.7205C123.5 18.8571 123.5 28.9939 123.5 39.1304C123.146 39.4958 122.746 39.8312 122.299 40.1366C114.534 40.2111 106.768 40.2858 99.0031 40.3602C94.8487 46.021 89.0847 48.8533 81.7112 48.8571C73.5455 56.4596 65.3799 64.0621 57.2143 71.6646C56.2536 72.1118 55.293 72.1118 54.3323 71.6646C38.8416 57.2422 23.3509 42.8199 7.86025 28.3975C7.37992 27.5776 7.37992 26.7578 7.86025 25.9379C17.155 17.3215 26.4013 8.67549 35.5994 0ZM36.56 5.81366C38.4631 7.21228 40.2245 8.77749 41.8437 10.5093C38.4463 12.332 35.084 12.2948 31.7567 10.3975C33.4064 8.89898 35.0076 7.37103 36.56 5.81366ZM62.2578 8.04969C64.9796 7.85876 67.6214 8.19416 70.1832 9.0559C76.2087 11.5997 82.0527 14.432 87.7153 17.5528C90.0973 18.4957 92.5792 19.0547 95.1605 19.2298C95.2006 25.2675 95.1605 31.3048 95.0404 37.3416C89.3842 44.7751 82.4595 46.0049 74.266 41.0311C73.217 40.1293 72.2563 39.1604 71.3841 38.1242C64.2848 35.9459 57.24 33.6354 50.2495 31.1925C47.837 29.5978 47.2366 27.548 48.4482 25.0435C49.4137 23.8488 50.6945 23.178 52.2909 23.0311C60.1628 25.1759 68.0083 27.4119 75.8271 29.7391C78.5297 28.9825 79.0501 27.529 77.3882 25.3789C71.4669 23.5905 65.5428 21.8017 59.6159 20.0124C56.7741 17.3665 53.9319 14.7205 51.0901 12.0745C50.9805 11.7964 51.1006 11.61 51.4503 11.5155C55.0763 10.3284 58.6788 9.17314 62.2578 8.04969ZM109.33 12.0745C112.452 12.0745 115.575 12.0745 118.697 12.0745C118.697 19.9751 118.697 27.8759 118.697 35.7764C115.575 35.7764 112.452 35.7764 109.33 35.7764C109.33 27.8759 109.33 19.9751 109.33 12.0745ZM27.6739 14.087C29.0198 14.6381 30.3808 15.1971 31.7567 15.764C36.6374 17.1369 41.2406 16.5778 45.5663 14.087C47.2772 15.4559 48.9182 16.9093 50.4897 18.4472C47.3987 19.1659 45.077 20.8056 43.5248 23.3665C37.2805 24.8145 33.6379 28.504 32.5973 34.4348C32.1946 41.5116 35.597 46.1699 42.8043 48.4099C51.1304 49.6965 56.7743 46.6779 59.736 39.354C62.2448 40.1948 64.7665 41.0147 67.3012 41.8137C66.6588 45.8331 67.5395 49.5599 69.9431 52.9938C68.3054 54.6303 66.6242 56.2329 64.8996 57.8012C63.4401 57.1617 61.9191 56.5654 60.3364 56.0124C57.6329 55.3756 54.9109 55.3011 52.1708 55.7888C50.2185 56.2935 48.3772 56.9643 46.647 57.8012C38.6416 50.3479 30.6359 42.8943 22.6304 35.441C26.4714 29.9211 26.4714 24.4058 22.6304 18.8944C24.3603 17.3213 26.0415 15.7189 27.6739 14.087ZM100.204 16.323C101.565 16.323 102.926 16.323 104.287 16.323C104.287 22.8075 104.287 29.2919 104.287 35.7764C102.926 35.7764 101.565 35.7764 100.204 35.7764C100.204 29.2919 100.204 22.8075 100.204 16.323ZM18.7878 22.3602C20.9697 25.5039 21.0097 28.7088 18.9079 31.9752C17.1867 30.3726 15.4655 28.7703 13.7443 27.1677C15.4741 25.5947 17.1553 23.9921 18.7878 22.3602ZM42.324 28.6211C42.6242 28.6383 42.8243 28.7875 42.9244 29.0683C43.8282 32.1444 45.7894 34.4178 48.8085 35.8882C50.8461 36.5326 52.8474 37.2405 54.8126 38.0124C52.6182 43.0589 48.6954 44.8848 43.0445 43.4907C37.513 40.6355 36.1921 36.5733 39.0818 31.3043C40.0662 30.274 41.147 29.3796 42.324 28.6211ZM72.3447 45.6149C73.5391 46.2457 74.7399 46.8794 75.9472 47.5155C75.1866 48.2237 74.4262 48.9316 73.6656 49.6398C72.8611 48.3992 72.4209 47.0576 72.3447 45.6149ZM54.0921 60.1491C56.5144 59.8843 58.7559 60.3315 60.8168 61.4907C59.2156 63.1304 57.5344 64.6956 55.7733 66.1863C54.0122 64.6956 52.331 63.1304 50.7298 61.4907C51.775 60.8205 52.8956 60.3733 54.0921 60.1491Z" fill="#7D9A40"/>
                            <path opacity="0.878" fill-rule="evenodd" clip-rule="evenodd" d="M83.9131 27C86.0739 26.994 86.8809 28.5256 86.3346 31.5941C85.0297 33.5598 83.8027 33.4642 82.6539 31.307C82.2404 29.2827 82.6601 27.8471 83.9131 27Z" fill="#7D9A40"/>
                            <path opacity="0.952" fill-rule="evenodd" clip-rule="evenodd" d="M62.4591 114C60.4656 114 58.4719 114 56.4784 114C54.0915 113.595 51.7789 112.891 49.5409 111.89C44.2859 109.599 39.1823 107.082 34.2306 104.339C32.4931 103.55 30.6592 103.142 28.7284 103.117C28.7825 104.239 28.3041 105.09 27.2931 105.671C24.7427 105.782 22.1909 105.819 19.6379 105.782C19.6775 106.674 19.6376 107.562 19.5183 108.447C19.1595 109.077 18.6412 109.558 17.9634 109.891C12.7004 110.039 7.4375 110.039 2.17457 109.891C1.43357 109.683 0.875376 109.275 0.5 108.67C0.5 98.6749 0.5 88.6803 0.5 78.6857C0.853428 78.1733 1.33188 77.7662 1.93534 77.4641C9.59052 77.3901 17.2457 77.3159 24.9009 77.242C32.4728 68.1271 41.5633 66.5724 52.1724 72.5778C53.4532 73.5453 54.6493 74.5819 55.7608 75.6873C61.9186 77.5683 68.0588 79.4932 74.181 81.4619C77.018 82.6151 79.0514 84.503 80.2812 87.1256C80.4547 87.2497 80.654 87.3237 80.8793 87.3477C87.1695 85.721 93.4692 84.1294 99.778 82.5725C106.713 82.0156 110.621 84.9401 111.5 91.3455C110.878 95.8853 108.247 98.9579 103.606 100.563C89.8983 105.162 76.1829 109.641 62.4591 114ZM39.4935 73.5773C44.7086 73.5182 48.8551 75.4061 51.9332 79.2409C58.5157 81.4755 65.1343 83.6226 71.7888 85.6819C76.0066 87.3568 76.8836 89.948 74.4203 93.4555C73.1383 94.3601 71.7029 94.6562 70.1142 94.3439C62.7767 92.0978 55.4007 89.9878 47.986 88.014C46.0277 88.2365 45.2301 89.2731 45.5938 91.1234C45.8622 91.5952 46.221 92.0023 46.6703 92.345C53.9266 94.492 61.1833 96.6389 68.4397 98.786C73.2882 99.8534 77.0759 98.4837 79.8028 94.6771C80.2033 93.895 80.4822 93.0808 80.6401 92.2339C87.1814 90.5924 93.7201 88.9266 100.256 87.2366C104.484 86.794 106.438 88.5339 106.117 92.456C105.266 94.2093 103.87 95.4309 101.931 96.1207C88.644 100.578 75.3272 104.946 61.9806 109.225C59.0269 109.572 56.1562 109.275 53.3685 108.336C47.2827 105.622 41.3021 102.735 35.4267 99.6744C33.2785 98.8608 31.0456 98.4535 28.7284 98.4528C28.6885 92.4556 28.7284 86.4588 28.8481 80.4625C31.2836 76.651 34.832 74.3558 39.4935 73.5773ZM5.28448 82.0172C8.3944 82.0172 11.5043 82.0172 14.6142 82.0172C14.6142 89.7908 14.6142 97.5644 14.6142 105.338C11.5043 105.338 8.3944 105.338 5.28448 105.338C5.28448 97.5644 5.28448 89.7908 5.28448 82.0172ZM19.6379 82.0172C20.9935 82.0172 22.3491 82.0172 23.7047 82.0172C23.7047 88.3842 23.7047 94.751 23.7047 101.118C22.3491 101.118 20.9935 101.118 19.6379 101.118C19.6379 94.751 19.6379 88.3842 19.6379 82.0172Z" fill="#7D9A40"/>
                            <path opacity="0.891" fill-rule="evenodd" clip-rule="evenodd" d="M39.19 86C40.9999 86.1502 41.7463 87.0914 41.429 88.8236C40.791 89.8795 39.85 90.2245 38.6059 89.859C37.4119 89.029 37.1847 87.9937 37.9245 86.753C38.3164 86.4239 38.7383 86.1728 39.19 86Z" fill="#7D9A40"/>
                            </svg>
                             
                        <h5 class=" font-weight-bold mt-2">Instant Payments</h5>
                        <p  class="mb-5">Get paid quickly after each shift.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex flex-column align-items-center">
                        <svg width="100" height="113" viewBox="0 0 100 113" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.97" fill-rule="evenodd" clip-rule="evenodd" d="M39.387 0C41.012 0 42.6373 0 44.2623 0C49.8327 1.3909 53.4154 4.84858 55.01 10.373C55.5804 13.982 56.1714 17.5869 56.7828 21.1875C59.8483 18.5759 62.9139 15.9642 65.9794 13.3525C71.4162 10.3824 76.6608 10.6767 81.7132 14.2354C87.1194 19.2825 88.1904 25.1312 84.9264 31.7812C84.1151 32.9925 83.1917 34.096 82.1564 35.0918C86.4473 36.7248 90.7315 38.3801 95.0093 40.0576C98.8865 43.0345 100.253 46.8968 99.109 51.6445C97.4536 56.2228 95.7546 60.7841 94.0121 65.3281C93.3063 66.2127 92.3831 66.6541 91.2421 66.6523C90.0472 66.4027 88.8654 66.1083 87.6964 65.7695C87.8004 78.9437 87.6896 92.1124 87.364 105.275C86.2545 109.286 83.706 111.861 79.7187 113C56.155 113 32.5911 113 9.02743 113C4.37645 111.64 1.75414 108.55 1.16053 103.73C1.01279 87.9133 1.01279 72.0964 1.16053 56.2793C1.44815 54.9619 2.22376 54.0425 3.48736 53.5205C20.2554 53.447 37.0232 53.3733 53.7912 53.2998C36.3812 47.1033 19.0224 40.7764 1.71454 34.3193C0.562338 33.1503 0.229934 31.7892 0.717327 30.2363C2.15105 26.1732 3.62841 22.127 5.14938 18.0977C7.32898 13.1361 11.1332 10.9659 16.5619 11.5869C20.489 12.817 24.367 14.178 28.1961 15.6699C27.8898 7.49177 31.6201 2.26845 39.387 0ZM40.0518 6.8418C44.3048 6.36329 47.0749 8.12892 48.3619 12.1387C49.0254 15.9545 49.5424 19.78 49.9131 23.6152C46.2948 22.1685 42.6384 20.8076 38.9438 19.5322C34.9625 16.9789 34.1131 13.6316 36.3954 9.49023C37.4212 8.30312 38.64 7.4203 40.0518 6.8418ZM73.2922 18.0977C78.6803 19.1184 80.7115 22.2817 79.3863 27.5879C77.8728 30.489 75.4719 31.7764 72.1842 31.4502C68.2379 30.1401 64.3231 28.7424 60.4393 27.2568C63.6067 24.357 66.8569 21.5613 70.1898 18.8701C71.2278 18.5054 72.2618 18.2479 73.2922 18.0977ZM13.6811 18.3184C14.8344 18.2375 15.9425 18.4214 17.0051 18.8701C25.7868 22.092 34.5771 25.2921 43.3759 28.4707C43.4918 29.1348 43.381 29.7969 43.0435 30.457C41.8246 33.7676 40.6058 37.0781 39.387 40.3887C38.8691 40.612 38.3521 40.5752 37.8358 40.2783C27.9782 36.6996 18.1539 33.058 8.36262 29.3535C9.55966 26.1081 10.7785 22.871 12.0191 19.6426C12.4876 19.0642 13.0416 18.6228 13.6811 18.3184ZM50.2456 30.8984C52.2672 31.6062 54.2617 32.3787 56.2288 33.2158C54.6982 37.2377 53.147 41.247 51.5752 45.2441C49.68 44.4924 47.7594 43.8303 45.8135 43.2578C47.1664 39.092 48.6438 34.9722 50.2456 30.8984ZM62.6553 35.5332C72.3097 38.8733 81.9126 42.3677 91.4637 46.0166C92.1684 46.7211 92.6116 47.5673 92.7933 48.5547C91.6412 52.0336 90.4224 55.4914 89.1368 58.9277C78.9354 55.1118 68.7048 51.3598 58.4449 47.6719C59.6994 43.6308 61.103 39.5847 62.6553 35.5332ZM7.91942 60.252C16.7097 60.252 25.4998 60.252 34.2901 60.252C34.2901 75.6277 34.2901 91.0032 34.2901 106.379C26.6076 106.416 18.9253 106.379 11.2435 106.269C9.57913 106.155 8.50804 105.309 8.03022 103.73C7.91942 89.2378 7.88248 74.7451 7.91942 60.252ZM41.1598 60.252C43.3021 60.252 45.4441 60.252 47.5863 60.252C47.5863 75.6277 47.5863 91.0032 47.5863 106.379C45.4441 106.379 43.3021 106.379 41.1598 106.379C41.1598 91.0032 41.1598 75.6277 41.1598 60.252ZM54.456 60.252C60.7351 60.2151 67.014 60.252 73.2922 60.3623C75.7385 61.2601 78.1761 62.1798 80.6051 63.1211C80.8637 76.5833 80.9005 90.0462 80.7159 103.51C80.3366 105.211 79.2655 106.13 77.5027 106.269C69.8208 106.379 62.1385 106.416 54.456 106.379C54.456 91.0032 54.456 75.6277 54.456 60.252Z" fill="#7D9A40"/>
                            </svg>
                            
                             
                        <h5 class=" font-weight-bold mt-2">Special Perks </h5>
                        <p>Enjoy bonuses and rewards.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
        <h1 class="text-center font-weight-bold my-5">Bonuses and Perks</h1>
        <div class="table-responsive">
            <table class="table text-center">
                <thead>
                    <tr>
                        <th >Bonus/Perk</th>
                        <th>Eligibility</th>
                        <th>Bonus Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td rowspan="4">Welcome Bonus</td>
                        <td>Complete 75 deliveries within 30 days</td>
                        <td>Rs. 1500</td>
                    </tr>
                    <tr>
                        <td>Complete 100 deliveries within 30 days</td>
                        <td>Rs. 2500</td>
                    </tr>
                    <tr>
                        <td>Complete 160 deliveries within 30 days</td>
                        <td>Rs. 4000</td>
                    </tr>
                    <tr>
                        <td>Complete 200 deliveries within 30 days</td>
                        <td>Rs. 5000</td>
                    </tr>
                    <tr class="highlight">
                        <td rowspan="3">Weekly Bonus</td>
                        <td>Complete 50 deliveries within 7 days</td>
                        <td>Rs. 900</td>
                    </tr>
                    <tr class="highlight">
                        <td>Complete 70 deliveries within 7 days</td>
                        <td>Rs. 1275</td>
                    </tr>
                    <tr class="highlight">
                        <td>Complete 100 deliveries within 7 days</td>
                        <td>Rs. 1800</td>
                    </tr>
                </tbody>
            </table>
        </div>

        </div>
    </section>
{{-- 
    <section>
        <div class="container">
        <h1 class="text-center font-weight-bold my-5">Frequently Asked Questions</h1>
        <div class="accordion" id="faqAccordion">
            <div class="card">
                <div class="card-header accordion-header d-flex justify-content-between" id="headingOne">    
                       
                        <button class="btn" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Kya ma shopeedo ka ek rider bn skta hon?
                        </button>
                        <span class="toggle-icon"><i class="fas fa-plus"></i></span>
                  
                </div>
                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#faqAccordion">
                    <div class="card-body accordion-body pl-5">
                        Bilkul, iss ke liye ap ka ID card ki need ho gi jo ap ko verification ke time pa add krna ho ga.
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <section>
        <div class="container">
            <h1 class="text-center font-weight-bold my-5">Frequently Asked Questions</h1>
            <div class="accordion" id="faqAccordion">
                <div class="card">
                    <div class="card-header accordion-header d-flex justify-content-between" id="headingOne">
                        <button class="btn" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Kya ma shopeedo ka ek rider bn skta hon?
                        </button>
                        <span class="toggle-icon"><i class="fas fa-plus"></i></span>
                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#faqAccordion">
                        <div class="card-body accordion-body pl-5">
                            Bilkul, iss ke liye ap ka ID card ki need ho gi jo ap ko verification ke time pa add krna ho ga.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#faqAccordion .card-header').on('click', function() {
            var $this = $(this);
            var $icon = $this.find('.toggle-icon i');
            var $collapse = $this.next('.collapse');

            // Toggle the collapse state
            if ($collapse.hasClass('show')) {
                $collapse.collapse('hide');
                $icon.removeClass('fa-minus').addClass('fa-plus');
            } else {
                $('#faqAccordion .collapse.show').collapse('hide'); // Close other open items
                $('#faqAccordion .toggle-icon i').removeClass('fa-minus').addClass('fa-plus'); // Reset all icons
                $collapse.collapse('show');
                $icon.removeClass('fa-plus').addClass('fa-minus');
            }
        });

        $('#faqAccordion').on('show.bs.collapse', function (e) {
            $(e.target).prev('.card-header').addClass('active-header');
            $(e.target).addClass('active-body');
        });

        $('#faqAccordion').on('hide.bs.collapse', function (e) {
            $(e.target).prev('.card-header').removeClass('active-header');
            $(e.target).removeClass('active-body');
        });
    });

    document.getElementById('deliveryForm').addEventListener('submit', function(event) {
            let isValid = true;

            const firstName = document.getElementById('first-name');
            const firstNameError = document.getElementById('first-name-error');
            if(!firstName.checkValidity()){
                firstNameError.style.display = "block";
                isValid = false;
            } else {
                firstNameError.style.display = 'none'
            }

            // First Name validation
            // const firstName = document.getElementById('first-name');
            // const firstNameError = document.getElementById('first-name-error');
            // if (!firstName.checkValidity()) {
            //     firstNameError.style.display = 'block';
            //     isValid = false;
            // } else {
            //     firstNameError.style.display = 'none';
            // }

            // Last Name validation
            const lastName = document.getElementById('last-name');
            const lastNameError = document.getElementById('last-name-error');
            if (!lastName.checkValidity()) {
                lastNameError.style.display = 'block';
                isValid = false;
            } else {
                lastNameError.style.display = 'none';
            }

            // Phone Number validation
            const phoneNumber = document.getElementById('phone-number');
            const phoneNumberError = document.getElementById('phone-number-error');
            if (!phoneNumber.checkValidity()) {
                phoneNumberError.style.display = 'block';
                isValid = false;
            } else {
                phoneNumberError.style.display = 'none';
            }

            // Vehicle selection validation
            const vehicle = document.getElementById('vehicle');
            const vehicleError = document.getElementById('vehicle-error');
            if (!vehicle.checkValidity()) {
                vehicleError.style.display = 'block';
                isValid = false;
            } else {
                vehicleError.style.display = 'none';
            }

            // Password validation
            const password = document.getElementById('password');
            const passwordError = document.getElementById('password-error');
            if (!password.checkValidity()) {
                passwordError.style.display = 'block';
                isValid = false;
            } else {
                passwordError.style.display = 'none';
            }

            // Confirm Password validation
            const confirmPassword = document.getElementById('confirm-password');
            const confirmPasswordError = document.getElementById('confirm-password-error');
            if (confirmPassword.value !== password.value) {
                confirmPasswordError.style.display = 'block';
                isValid = false;
            } else {
                confirmPasswordError.style.display = 'none';
            }

            // Over 18 validation
            const over18 = document.querySelector('input[name="over_18"]:checked');
            const over18Error = document.getElementById('over-18-error');
            if (!over18) {
                over18Error.style.display = 'block';
                isValid = false;
            } else {
                over18Error.style.display = 'none';
            }

            // Agreement validation
            const agreement = document.getElementById('agreement');
            const agreementError = document.getElementById('agreement-error');
            if (!agreement.checkValidity()) {
                agreementError.style.display = 'block';
                isValid = false;
            } else {
                agreementError.style.display = 'none';
            }

            if (!isValid) {
                event.preventDefault();
            }
        });
</script>
@endsection