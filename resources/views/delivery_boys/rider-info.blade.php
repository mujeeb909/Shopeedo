@extends('delivery_boys.layouts.test')

@section('style')
<style>
    body {
    font-family: 'Inter', sans-serif !important;
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
        font-size: 20px;

    }
    .progress-bar-step .label {
        margin-top: 10px;
    }
    .progress-line {
        position: absolute;
        top: 32px;
        left: 3%;
        height: 5px;
        width: calc(100% - 80px); /* Adjust this to change the line width */
        background-color: #ddd;
        z-index: 0;
    }
    .progress-bar-step.active ~ .progress-bar-step .progress-line {
        background-color: #007bff;
    }
    .round-custom {
        border-radius: 22px;
        background-color: #ECECEC;
    }
    .step {
        display: none;
    }
    .step.active {
        display: block;
    }

    .form-control {
        width:44%
    }
    .text-primary{
        color:#7d9a40 !important;
    }
    .btn-primary { 
        background-color:#7d9a40 !important;
    }
    .rider-btn-style {
        font-size: 24px;
        padding:12px 80px;
        border-radius: 10px;
        border: none;
    }

    .label-style {
        font-size: 18px;
        margin-bottom: 10px;
        /* padding:12px ; */
        /* border-radius: 10px; */ 
        /* border: none; */
   
    }
    
    @media (max-width: 768px) {
    .form-control {
        width: 100%; /* Width for small and extra small screens */
    }
    
}
</style>
@endsection

@section('content')
@if (session('success'))
<div class="toast show ml-auto toast-custom" role="alert" aria-live="assertive" aria-atomic="true" >
    <div class="toast-header">
        <strong class="mr-auto">Success</strong>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body">
        {{ session('success') }}
    </div>
</div>
@endif
<section>
    <div class="container mt-5">
        <div class="progress-container">
            <div class="progress-bar-step active" id="progress-step1">
                <div class="circle">1</div>
                <div class="label">Step 1</div>
            </div>
            <div class="progress-line"></div>
            <div class="progress-bar-step" id="progress-step2">
                <div class="circle">2</div>
                <div class="label">Step 2</div>
            </div>
            <div class="progress-bar-step" id="progress-step3">
                <div class="circle">3</div>
                <div class="label">Step 3</div>
            </div>
            <div class="progress-bar-step" id="progress-step4">
                <div class="circle">4</div>
                <div class="label">Step 4</div>
            </div>
            <div class="progress-bar-step" id="progress-step5">
                <div class="circle">5</div>
                <div class="label">Step 5</div>
            </div>
        </div>
        {{-- <div class="card">
            <div class="card-body">
              
            </div>
        </div> --}}

        <div class="tab-content">
            <!-- Step 1 -->
            <div class="tab-pane fade show active step" id="step1">
                <h5 class="text-center text-primary fw-600">Welcome to Shopeedo</h5>
                <p class="text-center">You too can earn up to 60,000 per month by becoming a delivery hero of Shopeedo Lahore!</p>
                <h5 class="text-primary fw-500">Requirements:</h5>
                <ul class="font-weight-bold">
                    <li>Original Valid CNIC</li>
                    <li>Learners or Original Valid Driving License</li>
                    <li>Smart Phone</li>
                    <li>Copy of your latest household bill</li>
                    <li>1500/- Rupees Security Deposit</li>
                </ul>
                <h5 class="text-primary fw-500">Select an area near you:</h5>
                <ul class="font-weight-bold">
                    <li>Gulberg</li>
                    <li>DHA (Defence Housing Authority)</li>
                    <li>Johar Town</li>
                    <li>Model Town</li>

                </ul>
                {{-- <select class="form-control mb-3">
                    <option>Gulberg</option>
                    <option>DHA (Defence Housing Authority)</option>
                    <option>Johar Town</option>
                    <option>Model Town</option>
                </select> --}}
                <div class="d-flex justify-content-end"><button class="btn btn-primary next-step rider-btn-style" data-next="step2">Next</button></div>
                
            </div>
            <!-- Step 2 -->
            <div class="tab-pane step" id="step2">
                <h5 class="text-center text-primary fw-600">Rider Information</h5>
                <p class="text-center">Provide your personal details to complete your profile and start riding with us.</p>
              <div class="m-auto" >
                <form>
                    <div class="container p-4" style="max-width:700px; border-radius:20px; background-color:#EEEEEE">
                          <!-- Radio buttons for marital status -->
                        <div >
                            <label class="label-style fw-600">1. What is your marital status?</label><br>
                            <input type="radio" id="married_yes" name="marital_status" value="yes"  >
                            <label class="label-style" for="married_yes">Single</label><br>
                            <input type="radio" id="married_no" name="marital_status" value="no"  >
                            <label class="label-style" for="married_no">Married</label>
                        </div>

                          <!-- cnic number -->
                          <div>
                            <label class="label-style fw-600 " >2. Enter your CNIC number</label><br>
                            <input type="number"  class="form-control mb-3" id="cnic" name="cnic" value="" placeholder="Enter Your Cnic">
                        </div>

                         <!-- Date of Birth -->
                         <div>
                            <label class="label-style fw-600">3. Date of birth</label><br>
                            <input type="date"  class="form-control mb-3" id="dob" name="dob" value="" >
                        </div>
                        {{-- martial status --}}
                        <div>
                        <label class="label-style fw-600" for="area" class="mb-2">4. In which area of Lahore are you registering?</label>
                        <select class="form-control mb-3" id="area">

                            <option selected>Select area</option>
                            <option>Lahore</option>
                        </select>
                       </div>

                       {{-- Religion --}}
                       <div>
                        <label class="label-style fw-600 mb-2" >5. What is your religion?</label>
                        <select class="form-control mb-3">

                            <option selected>Select area</option>
                            <option>Islam</option>
                        </select>
                       </div>
                      
                       {{-- Education --}}
                       <div>
                        <label  class=" label-style fw-600 mb-2">6. What is your highest level of education completed?</label>
                        <select class="form-control mb-3">

                            <option selected>Select Education</option>
                            <option>Matric</option>
                        </select>
                       </div>

                       {{-- Education --}}
                       <div>
                        <label  class= "label-style fw-600 mb-2">7. How many people are there in your family?</label>
                        <select class="form-control mb-3"  >
                            <option selected>Select Members</option>
                            <option>1</option>
                            <option>2</option>
                        </select>
                       </div>

                          <!-- Radio buttons for currently employed -->
                          <div>
                            <label class="label-style fw-600">8. Are you currently employed?</label><br>
                            <input type="radio" id="employed_yes" name="employed_status" value="yes">
                            <label class="label-style " for="employed_yes">Yes</label><br>
                            <input type="radio" id="employed_no" name="employed_status" value="no">
                            <label class="label-style " for="employed_no">No</label>
                         </div>

                          {{-- current working status --}}
                       <div>
                        <label  class=" label-style fw-600 mb-2">9. If yes, where are you currently working?</label>
                        <select class="form-control mb-3">
                            <option selected>Select Organization</option>
                            <option>1</option>
                            <option>2</option>
                        </select>
                       </div>

                       <!-- Radio buttons for experience status -->
                       <div>
                        <label class="label-style fw-600">10. Do you have any experience in food delivery?</label><br>
                        <input type="radio" id="experience_yes" name="experience_status" value="yes">
                        <label class="label-style  mb-2" for="experience_yes">Yes</label><br>
                        <input type="radio" id="experience_no" name="experience_status" value="no">
                        <label  class="label-style  mb-2" for="experience_no">No</label>
                     </div>

                        {{-- current employment status --}}
                        <div>
                            <label  class="label-style fw-600 mb-2">11. What type of employment are you interested in?</label>
                            <select class="form-control mb-3">
                                <option selected>Select Employment Type</option>
                                <option>1</option>
                                <option>2</option>
                            </select>
                           </div>

                           <!-- Emergency name-->
                         <div>
                            <label class="label-style fw-600">12. Enter name of emergency contact</label><br>
                            <input type="text"  class="form-control mb-3" id="emergency_name" name="emergency_name" value="" placeholder="Enter Name">
                        </div>

                          <!-- Emergency contact-->
                          <div>
                            <label class="label-style fw-600">13. Enter number of emergency contact</label><br>
                            <input type="number"  class="form-control mb-3" id="emergency_number" name="emergency_number" value="" placeholder="Enter Contact">
                        </div>

                        {{-- here about shopeedo--}}
                        <div>
                            <label  class="label-style fw-600 mb-2">14. Where did you hear about shopeedo?</label>
                            <select class="form-control mb-3">
                                <option selected>Select </option>
                                <option>1</option>
                                <option>2</option>
                            </select>
                           </div>


                    </div>
                    <!-- Add other form fields similarly -->
                    
                </form>
                <!-- Form elements for step 2 go here -->
                <div class="d-flex justify-content-center justify-content-md-between flex-wrap m-4">
                    <button class="btn btn-secondary prev-step rider-btn-style m-2" data-prev="step1" style=" padding:12px 60px;">Previous</button>
                    <button class="btn btn-primary next-step rider-btn-style m-2" data-next="step3">Next</button>
                </div>
            </div>
                
            </div>
            <!-- Step 3 -->
            <div class="tab-pane  step" id="step3">
                <h5></h5>
                <h5 class="text-center">Upload Documents</h5>
                <p class="text-center">Please upload clear pictures of the required documents for verification.</p>
                <!-- Form elements for step 3 go here -->
                <div>
                   
                    <form action="">
                        <div class="container p-4" style="background-color:#EEEEEE">
                            {{-- <div >
                                <label for="exampleFormControlFile1">1.Upload your picture (.pdf, .png or .jpg, max 10MB)</label>
                                <input type="file" class="form-control-file form-control " id="exampleFormControlFile1">
                               

                              </div> --}}

                              <div class="upload-container">
                                <input type="file" id="file-upload" />
                                <label for="file-upload" class="file-upload-label">
                                    <span class="plus-icon">+</span>
                                    <span class="upload-text">Upload Picture</span>
                                </label>
                            </div>
                        </div>
                            
                    </form>
                    <div class="d-flex justify-content-between m-6">
                        <button class="btn btn-secondary prev-step rider-btn-style m-2" data-prev="step2">Previous</button>
                        <button class="btn btn-primary next-step rider-btn-style m-2" data-next="step4">Next</button>
                        </div>
                </div>
                
            </div>
            <!-- Step 4 -->
            <div class="tab-pane  step" id="step4">
                <h5>Review and Confirm</h5>
                <!-- Form elements for step 4 go here -->
                <div class="d-flex justify-content-between">

                <button class="btn btn-secondary prev-step rider-btn-style" data-prev="step3">Previous</button>
                <button class="btn btn-primary next-step rider-btn-style" data-next="step5">Next</button>
            </div>
            </div>
            <!-- Step 5 -->
            <div class="tab-pane  step" id="step5">
                <h5>Complete Registration</h5>
                <!-- Form elements for step 5 go here -->
                <div class="d-flex justify-content-between">

                <button class="btn btn-secondary prev-step rider-btn-style" data-prev="step4">Previous</button>
                <button class="btn btn-primary rider-btn-style" type="submit">Submit</button>
            </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')
<script>
    $(document).ready(function() {
        function updateProgressBar(step) {
            $('.progress-bar-step').removeClass('active');
            $('#progress-step' + step).addClass('active');
        }

        $('.next-step').click(function() {
            var nextId = $(this).data('next');
            $('.step').removeClass('active');
            $('#' + nextId).addClass('active');
            updateProgressBar(nextId.charAt(nextId.length - 1)); // Get the step number
        });

        $('.prev-step').click(function() {
            var prevId = $(this).data('prev');
            $('.step').removeClass('active');
            $('#' + prevId).addClass('active');
            updateProgressBar(prevId.charAt(prevId.length - 1)); // Get the step number
        });
    });

    $('.toast').toast({ delay: 5000 });
    $('.toast').toast('show');
</script>
@endsection
