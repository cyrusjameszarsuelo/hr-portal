<!doctype html>
    <html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="{{ URL::asset ('css/style.css')}}" rel="stylesheet">
        <link rel="icon" href="{{ URL::asset('img/megawide-icon.png')}}">

        <link rel="stylesheet" href="{{ asset ('login_assets/css/owl.carousel.min.css')}}">

        <link href="{{ URL::asset ('assets/custom/css/custom.css')}}" rel="stylesheet">

        <!-- Style -->
        <link rel="stylesheet" href="{{ asset ('login_assets/css/style.css')}}">

        <title>Login</title>
    </head>
    <body>


        <div class="d-lg-flex half">
            <div class="bg order-1 order-md-2" style="background-image: url('https://images.pexels.com/photos/439416/pexels-photo-439416.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2');"></div>
            <div class="contents order-2 order-md-1">

                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-7">
                            <center>
                            <h3>Login to <strong>MEGANet</strong></h3>
                            <p class="mb-4" style="font-size: 18px">We use Microsoft 365 for accessing your account.</p>
                            <br>
                            <p class="text-sm">Click the button below to get started.</p>

                            </center>

                            <a href="{{ route('connect') }}" class="btn btn-block btn-primary text-white mt-2" style="padding: 13px; text-decoration: none; background-color: black"> <img src="https://purepng.com/public/uploads/large/purepng.com-microsoft-logo-iconlogobrand-logoiconslogos-251519939091wmudn.png" alt="" style="width: 13%; padding-right: 15px">Login with your Microsoft Account</a>

                        </div>
                    </div>
                </div>
            </div>


        </div>



        <script src="{{ asset ('login_assets/js/jquery-3.3.1.min.js')}}"></script>
        <script src="{{ asset ('login_assets/js/popper.min.js')}}"></script>
        <script src="{{ asset ('login_assets/js/bootstrap.min.js')}}"></script>
        <script src="{{ asset ('login_assets/js/main.js')}}"></script>
    </body>
    </html>