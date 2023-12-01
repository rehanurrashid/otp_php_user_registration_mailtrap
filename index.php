<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Registration</title>
    <link rel="icon" href="images/cms-favicon-150x150.png" sizes="32x32">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
        }
        .container {
            max-width: 500px;
            margin: 50px auto;
        }
        input:focus{
                outline: none!important;
                border-color: none!important;
                box-shadow: none!important;
        }
        select:focus{
                outline: none!important;
                border-color: none!important;
                box-shadow: none!important;
        }
        .error{
            color: #B81111;
        }
    </style>
</head>
<body>
    <!-- Just an image -->
    <nav class="navbar navbar-light bg-white shadow-sm">
      <a class="navbar-brand" href="#">
        <img src="images/rehan.png" width="25%" alt="" class="ms-3">
      </a>
    </nav>

    <div class="container">
        <h2 class="text-center mb-4">User Registration</h2>
        <form method="POST" action="" class="js-form">
            <div class="mb-3">
                <label for="name" class="form-label"><i class="fas fa-user"></i> Name:</label>
                <input type="text" class="form-control" id="name" name="name" data-validate-field="name" placeholder="John Doe">
            </div>
            <div class="mb-3">
                <label for="country" class="form-label"><i class="fas fa-globe"></i> Country:</label>
                <select class="form-select" id="country" name="country" data-validate-field="country">
                    <option value="">Select</option>
                    <option value="PK">Pakistan</option>
                    <option value="USA">United States</option>
                    <option value="UK">United kingdom</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email:</label>
                <div class="input-group">
                    <input type="email" class="form-control" id="email" name="email" placeholder="john_doe@domain.com">
                    <button type="button" class="btn btn-primary send_otp" onclick="send_otp()"><i class="fas fa-paper-plane"></i> Send OTP</button>
                </div>

                <div class="error d-none email_required" style="color: #B81111">Email field must be filled!</div>
                <div class="error d-none email_valid" style="color: #B81111">Must me a valid email address!</div>

                <div class="text-end d-none timer_div">Resend OTP in <span id="timer"></span></div>
                <div class="text-success d-none otp_sent">Please check your email address. You will receive a code shortly!</div>

                <div class="input-group">
                    <input type="text" class="form-control mt-2" id="email_otp" name="email_otp"  placeholder="Enter Email OTP">
                    <button type="button" class="btn btn-dark mt-2 verify_otp" onclick="verify_otp()"><i class="fa fa-check"></i> Verify OTP</button>
                </div>

                <div class="error d-none email_otp_required" style="color: #B81111">Email OTP field must be filled!</div>
                <div class="error d-none email_otp_invalid" style="color: #B81111">You have entered an invalid OTP!</div>

                <div class="error d-none email_otp_status" style="color: #B81111">Please verify your email before proceed!</div>

            </div>

            <!-- <div class="mb-3">
                <label for="phone" class="form-label"><i class="fas fa-phone"></i> Phone:</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="phone" name="phone" >
                    <button type="button" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Verify Phone</button>
                </div>
                <input type="text" class="form-control mt-2" id="phone_otp" name="phone_otp" placeholder="Enter Phone OTP" >
            </div> -->

            <div class="mb-3">
                <label for="gender" class="form-label"><i class="fas fa-venus-mars"></i> Gender:</label>
                <select class="form-select" id="gender" name="gender" data-validate-field="gender">
                    <option value="">Select</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success" id="submit"><i class="fas fa-user-plus"></i> Sign Up</button>
            <div class="alert alert-success text-success user_success mt-2 d-none">
                User registered successfully!
            </div>
        </form>
    </div>

<!-- Footer -->
<footer class="bg-primary text-center text-white">

  <!-- Copyright -->
  <div class="text-center p-3  pt-4" style="background-color: rgba(0, 0, 0, 0.2)">
    © 2023 Copyright:
    <a class="text-white" href="http://rehanurrashid.com/" target="_blank">rehanurrashid.com</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    
    <script src="js/just-validate.min.js"></script>

    <script>

var email_otp_status = false;

const validation = new window.JustValidate('.js-form', {
        rules: {
            name: {
                required: true,
            }, 
            country: {
               required: true,
            }, 
            gender: {
               required: true,
            }, 
        },
        messages: {
            name: {
                required: 'Name field must be filled!',
            },
            country: {
                required: 'Country field must be selected!',
            },
            gender: {
                required: 'Gender field must be selected!',
            },
            
        },
        submitHandler: function (form, values, ajax) {

            let name = $('#name').val();
            let country = $('#country').val();
            let gender = $('#gender').val();
            let email = $('#email').val();
            let email_otp = $('#email_otp').val();

            if(email == ''){
                $('.email_required').removeClass('d-none');
                $('#email').css('border', '1px solid rgb(184, 17, 17)');
                return false;
            }
            else{

                $('.email_required').addClass('d-none');
                var emailExp = new RegExp(/^\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i);
                if(emailExp.test(email) == false){
                    $('.email_valid').removeClass('d-none');
                    return false;
                }
            }
            $('.email_valid').addClass('d-none');
            $('#email').css('border', '1px solid #dee2e6');

            //  email OTP required
            if(email_otp == ''){
                $('.email_otp_required').removeClass('d-none');
                $('#email_otp').css('border', '1px solid rgb(184, 17, 17)');
                return false;
            }
            $('.email_otp_required').addClass('d-none');
            $('#email_otp').css('border', '1px solid #dee2e6');

            if(email_otp_status == false){
                $('.email_otp_status').removeClass('d-none');
                return false;
            }
            $('.email_otp_status').addClass('d-none');

            $.ajax({
                url:'register.php',
                type:'post',
                data:'email='+email+'&name='+name+'&country='+country+'&gender='+gender,
                success:function(result){
                    if(result=='yes'){
                        jQuery('.user_success').removeClass('d-none');
                    }
                }
            });
        },
    });

    let timerOn = true;

    function timer(remaining) {

        $('.timer_div').removeClass('d-none');
        var m = Math.floor(remaining / 60);
        var s = remaining % 60;
          
        m = m < 10 ? '0' + m : m;
        s = s < 10 ? '0' + s : s;
        document.getElementById('timer').innerHTML = m + ':' + s;
        remaining -= 1;
          
        if(remaining >= 0 && timerOn) {
            setTimeout(function() {
                timer(remaining);
            }, 1000);
            return;
        }

        if(!timerOn) {
            // Do validate stuff here
            return;
        }
          
        // Do timeout stuff here
        $('.timer_div').addClass('d-none');
        $('.send_otp').removeClass('disabled');
    }

    

    function send_otp(){
        var email=$('#email').val();

        if(email == ''){
            $('.email_required').removeClass('d-none');
            $('#email').css('border', '1px solid rgb(184, 17, 17)');
            return false;
        }
        else{
            $('.email_required').addClass('d-none');
            var emailExp = new RegExp(/^\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i);
            if(emailExp.test(email) == false){
                $('.email_valid').removeClass('d-none');
                return false;
            }
        }

        $('.email_valid').addClass('d-none');
        $('#email').css('border', '1px solid #dee2e6');
        $('.send_otp').html('<i class="fas fa-repeat"></i> Resend OTP');
        $('.send_otp').addClass('disabled');

        $.ajax({
            url:'send_otp.php',
            type:'post',
            data:'email='+email,
            success:function(result){
                if(result=='yes'){
                    timer(60);
                    jQuery('.second_box').show();
                    jQuery('.otp_sent').removeClass('d-none');
                    jQuery('.first_box').hide();
                }
            }
        });
    }

    function verify_otp(){

        var email=$('#email').val();

        if(email == ''){
            $('.email_required').removeClass('d-none');
            $('#email').css('border', '1px solid rgb(184, 17, 17)');
            return false;
        }
        else{
            $('.email_required').addClass('d-none');
            var emailExp = new RegExp(/^\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i);
            if(emailExp.test(email) == false){
                $('.email_valid').removeClass('d-none');
                return false;
            }
        }

        var otp=jQuery('#email_otp').val();

        //  email OTP required
        if(otp == ''){
            $('.email_otp_required').removeClass('d-none');
            $('#email_otp').css('border', '1px solid rgb(184, 17, 17)');
            return false;
        }
        $('.email_otp_required').addClass('d-none');
        $('#email_otp').css('border', '1px solid #dee2e6');
        $('.verify_otp').html('<i class="fas fa-spinner fa-spin"></i> Verifying');
        $('.verify_otp').addClass('disabled');
        $('.email_otp_invalid').addClass('d-none');

        jQuery.ajax({
            url:'check_otp.php',
            type:'post',
            data:'otp='+otp+'&email='+email,
            success:function(result){
                if(result=='yes'){
                    $('.verify_otp').addClass('disabled');
                    $('.verify_otp').removeClass('btn-dark');
                    $('.verify_otp').addClass('btn-success');
                    $('.verify_otp').html('<i class="fas fa-check-circle"></i> Verified');
                    $('#email_otp').attr('disabled','disabled');
                    $('#email').attr('disabled','disabled');
                    $('.send_otp').addClass('disabled');
                    email_otp_status = true;
                }
                else{
                    $('.verify_otp').html('<i class="fa fa-check"></i> Verify OTP');
                    $('.verify_otp').removeClass('disabled');
                    $('#email_otp').css('border', '1px solid rgb(184, 17, 17)');
                    $('.email_otp_invalid').removeClass('d-none');
                }
            }
        });
    }
    </script>

</body>
</html>


