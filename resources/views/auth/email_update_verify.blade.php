@extends('frontend.layout.app')
@section('title','A-Mobile | Email Verify')
@push('style')
<style>

    .form-invlid{
        border: 2px solid red !important;
    }

  /* Tablet */
  @media (max-width: 767px) {
    
  }

  /* Mobile */
  @media screen and (max-width: 480px) {
    .user-login {
      border: none;
      box-shadow: none;
    }
  }
</style>
@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="co-12 mt-3 p-0">
            <a href="{{ url('/home')}}" class="font-weight-bolder">
              <i class="fas fa-long-arrow-alt-left"></i> &nbsp;&nbsp;<span>Verify Your Email</span>
            </a>
        </div>
      <div class="col-12  mt-3 d-flex justify-content-center ">
          <div class="card border-0">
            <div class=" p-3 w-100 d-flex justify-content-center">
                <div class="rounded-circle border mail-icon">
                  <i class="fas fa-envelope"></i>
                </div>
            </div>
                <p class="text-center font-weight-bolder">
                    Please Enter the 4 digit Code Sent to <br>
                    Email {{ $data->email }}
                </p>
            <div class="card-body">
            <form action="JavaScript:void(0);" method="post" class="otp-form" name="otp-form">
                @csrf
                <div class="otp-input-fields">
                    <input type="hidden" name="email" value="{{ $data->email}}" class="email"> 
                    <input type="hidden" name="id" value="{{ $user->id }}" class="user"> 
                    <input type="number" name="code_1" class="otp__digit otp__field__1 otp">
                    <input type="number" name="code_2" class="otp__digit otp__field__2 otp">
                    <input type="number" name="code_3" class="otp__digit otp__field__3 otp">
                    <input type="number" name="code_4" class="otp__digit otp__field__4 otp">
                </div>
                <div class="text-center invalidCode">
                    
                </div>
                <div class="w-100 text-center mt-4">
                    <button type="button" class="btn btn-dark verify-btn verify_btn">Verify</button>
                </div>
                </form>
            </div>
          </div>
      </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        var otp_inputs = document.querySelectorAll(".otp__digit");
        var mykey = "0123456789".split("");
        let otpError1 = true;
        let otpError2 = true;
        let otpError3 = true;
        let otpError4 = true;
        otp_inputs.forEach((_)=>{
            _.addEventListener("keyup", handle_next_input)
        })
        function handle_next_input(event){
            let current = event.target
            let index = parseInt(current.classList[1].split("__")[2])
            current.value = event.key
        
           if(event.keyCode == 8 && index > 1){
               current.previousElementSibling.focus()
           }
           if(index < 6 && mykey.indexOf(""+event.key+"") != -1){
              var next = current.nextElementSibling;
              next.focus()
           }
            var _finalKey = ""
            for(let {value} of otp_inputs){
               _finalKey += value
            }
            if(_finalKey.length == 6){
                document.querySelector("#_otp").classList.replace("_notok", "_ok")
                document.querySelector("#_otp").innerText = _finalKey
            }else{
                document.querySelector("#_otp").classList.replace("_ok", "_notok")
                document.querySelector("#_otp").innerText = _finalKey
            }
        }

        $('.verify_btn').on('click',function(){
            var vals = $('.otp').map(function(){
                    return this.value;
                }).get().join('');

            validateOtp1();
            validateOtp2();
            validateOtp3();
            validateOtp4();
            if(otpError1 == true && otpError2 == true && otpError3== true && otpError4 == true){
                $.ajax({
                    method: "POST",
                    url: `{{ route('user.email.update') }}`,
                    cache: false,
                    dataType: "json",
                    data: {
                        _token: '{{csrf_token()}}',
                        id: $('.user').val(),
                        code: vals,
                        email: $('.email').val()
                    },
               
                        success: function (response) {
                            if(response == 'Success'){
                                 location.assign(window.location.href = '/home')
                            }else{
                                $('.invalidCode').append(`<span class="text-danger font-weight-bolder">Invalid Code</span>`);
                            }
                       
                       
                        },

                });
            }else{
                console.log('Required');
            }
            
        });

        function validateOtp1() {
                let opt_1 = $(".otp__field__1").val();
                if(opt_1.length == "") {
                   $(".otp__field__1").addClass('form-invlid');
                    otpError1 = false;
                    return false;
                } else {
                    $(".otp__field__1").removeClass('form-invlid');
                }
        }
        function validateOtp2() {
                let opt_1 = $(".otp__field__2").val();
                if(opt_1.length == "") {
                   $(".otp__field__2").addClass('form-invlid');
                    otpError2 = false;
                    return false;
                } else {
                    $(".otp__field__2").removeClass('form-invlid');
                }
        }
        function validateOtp3() {
                let opt_1 = $(".otp__field__3").val();
                if(opt_1.length == "") {
                   $(".otp__field__3").addClass('form-invlid');
                    otpError3 = false;
                    return false;
                } else {
                    $(".otp__field__3").removeClass('form-invlid');
                }
        }
        function validateOtp4() {
                let opt_1 = $(".otp__field__4").val();
                if(opt_1.length == "") {
                   $(".otp__field__4").addClass('form-invlid');
                    otpError4 = false;
                    return false;
                } else {
                    $(".otp__field__4").removeClass('form-invlid');
                }
        }
        
    </script>
@endpush