@extends('layouts.header')
@include('layouts.header')
@push('title')
  <title>SpinPay | P2P Lending Platform</title>
@endpush
<div class="register-container-body">
<div class="navbar" style="height:12%">
    <div class="container">
      <div class="logo-container">
         SpinPay
      </div>
      <div class="menu-container">
        <h4><a href="#">login</a></h4>
     </div>
    </div>
</div>

<div class="register-main-body">
    <div class="alert alert-danger text-center" id="errorDiv" style="padding:0%;display:none"></div>
    <div class="container reg-div-1">
        <div id="aadharUploadMainDiv">
           <div class="row">
               <h3 class="mt-5" style="font-family:myFirstFont;color:white">upload your aadhar card&nbsp;&nbsp;&nbsp;&nbsp;
             </div>
           <div class="row mt-4">
            <div class="col-md-6">
                <div class="inputDiv">
                    <input type="tel" id="aadharnum" placeholder="enter aadhar card number here" required>
                    <small class="form-text text-muted">number should be matched with aadhar card image.</small>
                </div>
            </div>
            
            </div>
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="inputFileDiv">
                        <div class="fileIntwrapper" style="width:100%;height:100%">
                            <center>
                              <input type="file" id="aadharfile" class="filesInput" accept=".pdf,.png,.jpg" placeholder="create a new password" required>
                              <img src="{{asset('images/upload-files.svg')}}" alt="" width="100">click here to upload aadhar image 
                              </center> 
                        </div>
                        </div>
                
                    <small class="form-text text-muted">only .pdf, .jpg, .png files are accepted with max size 300kb.</small><br>
                    <small class="form-text text-muted">uploaded file - </small><small class="form-text" id="hh" style="color:green">no file uploaded yet</small>
                </div>
                <div class="col-md-6">
                    <button class="btn capbtn" id="aadharUploadBtn" style="float:right">upload aadhar</button>
                    <div class="loader mt-2" id="aUpBtnLoader" style="display:none;float:right;margin-right:10%;"></div>
                </div>
                </div>
 
         
</div>
<div id="panUploadMainDiv" style="display:none">
    <div class="row">
        <h3 class="mt-5" style="font-family:myFirstFont;color:white">upload your pan card&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
    <div class="row mt-4">
     <div class="col-md-6">
         <div class="inputDiv">
             <input type="tel" id="pannum" placeholder="enter aadhar card number here" required>
             <small class="form-text text-muted">number should be matched with aadhar card image.</small>
         </div>
     </div>
     
     </div>
     <div class="row mt-4">
         <div class="col-md-6">
             <div class="inputFileDiv">
                 <div class="fileIntwrapper" style="width:100%;height:100%">
                     <center>
                       <input type="file" id="panfile" class="filesInput" accept=".pdf,.png,.jpg" required>
                       <img src="{{asset('images/upload-files.svg')}}" alt="" width="100">click here to upload pan card image 
                       </center> 
                 </div>
                 </div>
         
             <small class="form-text text-muted">only .pdf, .jpg, .png files are accepted with max size 300kb.</small><br>
             <small class="form-text text-muted">uploaded file - </small><small class="form-text" id="hh" style="color:green">no file uploaded yet</small>
         </div>
         <div class="col-md-6">
             <button class="btn capbtn" id="aadharUploadBtn" style="float:right">upload pan</button>
             <div class="loader mt-2" id="panUpBtnLoader" style="display:none;float:right;margin-right:10%;"></div>
         </div>
         </div>

  
</div>
<div id="payslipUploadMainDiv" style="display:none">
    <div class="row">
        <h3 class="mt-5" style="font-family:myFirstFont;color:white">upload your last payslip&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
    <div class="row mt-4">
     <div class="col-md-6">
         <div class="inputDiv">
             <input type="tel" id="pannum" placeholder="enter aadhar card number here" required>
             <small class="form-text text-muted">number should be matched with pan card image.</small>
         </div>
     </div>
     
     </div>
     <div class="row mt-4">
         <div class="col-md-6">
             <div class="inputFileDiv">
                 <div class="fileIntwrapper" style="width:100%;height:100%">
                     <center>
                       <input type="file" id="payslipfile1" class="filesInput" accept=".pdf,.png,.jpg" required>
                       <img src="{{asset('images/upload-files.svg')}}" alt="" width="100">click here to upload payslip image 
                       </center> 
                 </div>
                 </div>
         
             <small class="form-text text-muted">only .pdf, .jpg, .png files are accepted with max size 300kb.</small><br>
             <small class="form-text text-muted">uploaded file - </small><small class="form-text" id="hh" style="color:green">no file uploaded yet</small>
         </div>
         <div class="col-md-6">
             <button class="btn capbtn" id="aadharUploadBtn" style="float:right">upload payslip</button>
             <div class="loader mt-2" id="paysBtnLoader" style="display:none;float:right;margin-right:10%;"></div>
         </div>
         </div>

  
</div>


</div>
</div>
</div>


@include('layouts.jsfiles')

<script>
    let role = 0;
    $('#lenderRole').on('click',function(){
        if(role==0){
            $('#errorDiv').css('display','none');
        }
        role = 3;
        $('#borrowerRole').css('background-color','white');
        $('#lenderRole').css('background-color','#3498DB');
    })
    $('#borrowerRole').on('click',function(){
        if(role==0){
            $('#errorDiv').css('display','none');
        }
        role = 4;
        $('#errorDiv').css('display','none');
        $('#lenderRole').css('background-color','white');
        $('#borrowerRole').css('background-color','#3498DB');
    })

    // $('#verifyEmailBtn').on('click',function(){
    //   $('#verifyEmailBtn').css('display','none');
    //   $('#emailVerLoader').css('display','block');
    //   // $('#otpDiv').css('display','block');
  
    // })
 
    $(document).ready(function() {
        function errormsg(str){
            $('#errorDiv').html(str);
              $('#errorDiv').css('display','block');
        }
      $('#joinSpinpayBtn').click(function() {
          if(role==0){
            errormsg('please select a role - lender or borrower');
          }
          $("#userphone").val()=="" ? errormsg('mobile number can not be empty') : phoneInput = $("#userphone").val();
          $("#userpasswordcnf").val()=="" ? errormsg('confirm password can not be empty') : password_confirmationInput = $("#userpasswordcnf").val();
          $("#userpassword").val()=="" ? errormsg('password can not be empty') : passwordInput = $("#userpassword").val();
          $("#usermail").val()=="" ? errormsg('email can not be empty') : mailInput = $("#usermail").val();
          $("#username").val()=="" ? errormsg('name can not be empty') : nameInput = $("#username").val();
          if(passwordInput!=password_confirmationInput){
            errormsg('password and confirm password should be matched.');
          }else{
                var getData = {
                    name: nameInput,
                    email: mailInput,
                    phone: phoneInput,
                    password: passwordInput,
                    password_confirmation: password_confirmationInput,
                    role_id: role
                };
                $.ajax({
                    url:"/api/store_users",
                    type:"post",
                    dataType: "json",
                    data: getData,
                    beforeSend: function(){
                        $('#joinSpinpayBtn').css('display','none');
                        $('#joinBtnLoader').css('display','block');
                    },
                    success: function(result) {
                        if(result['code']==400){
                            errormsg(result['msg']);
                            $('#joinBtnLoader').css('display','none');
                            $('#joinSpinpayBtn').css('display','block');
                        }
                        else if(result['code']==200){
                            $('#joinBtnLoader').css('display','none');
                            $('#joinSpinpayBtn').css('display','block');
                        }
                    }
                });     
          }
      });
    });
  </script>
<script>
    const aadharFileInput = document.getElementById('aadharfile');
    aadharFileInput.onchange = () => {
        const selectedFile = aadharFileInput.files[0];
        $('#hh').html(selectedFile['name']);
    }
</script>
@include('layouts.footer')