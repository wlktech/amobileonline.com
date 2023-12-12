<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Email Verify Template</title>
    <style>
         body {
                font-family: 'Nunito', sans-serif;
                background: #fff !important;
            }

            h3{
                font-weight:600;
            }

            span{
                text-align: center;
            }

            .container{
                width: 100%;
            }
            .col-12{
                width: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
             
            }

            .my-5{
                margin: 1.5rem 1.5rem;
            }

            .mt-5{
                margin-top : 0.5rem;
            }

            .btn-dark{
                background-color: #000;
                color: #fff;
                border-radius: 10px;
            }

            .text-center{
                text-align: center;
            }

            .code{
                width: 200px;
                padding: 20px;
                font-size: 20px;
                font-weight: 600;
                letter-spacing: 10px;
                text-align: center;
            }
    </style>
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-12">
               <div class="p-2 mt-5">
                   <h3 class="font-weight-bolder text-center">Email Verification</h3>
                   <p>Hi {{ $data->name }},</p>
                   <p>You are receiving this email so we can confirm this email address for your account.
                      To finish verifying your email address,click the button below or enter the provided code.
                   </p>

                   <div class="text-center">To verify manually, enter this code</div>
                   <div class="text-center my-5">
                     <span class="code">{{ $data->code }}</span>
                   </div>
                   <p>If you did not request this email ,please contact an administrator at 
                     <a href="mailto:info@amobilonline.com">info@amobilonline.com</a>
                   </p>
               </div>
            </div>
        </div>
    </div>

  </body>
</html>
