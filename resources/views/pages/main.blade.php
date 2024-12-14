@extends('welcome')

@section('title', 'Main')

@section('content')

    
    <label>
        <input type='checkbox' id="checkbox-action">
        <span class='menu'>
            <span class='hamburger'></span>
        </span>
        <ul id="nav-hide" hidden  style="overflow: hidden;">
            <li>
                <div class="row">
                    <div class="col-md-10">
                        <a href='/home'>Home</a>
                    </div>
                </div>
            </li>
            <li>
                <div class="row">
                    <div class="col-md-10">
                        <a href='/our-company'>Our Company</a>
                    </div>
                </div>
            </li>
            <li>
                <div class="row">
                    <div class="col-md-10">
                        <a id='our-office' href="#">Corporate Office</a>
                    </div>
                    <div class="col-md-2">
                        <span class="arrow-li"><i class="fa-solid fa-play"></i></span>
                    </div>
                </div>
                <ol id="ol-submenu1" style="display: none">
                    <li><a href="/corporate-office/Business Devt">Business Dev't</a></li>
                    <li><a href="/corporate-office/CCAB">CCAB</a></li>
                    <li><a href="/corporate-office/Foundation">Foundation</a></li>
                    <li><a href="/corporate-office/Finance">Finance</a></li>
                    <li><a href="https://hr-portal-megawide.herokuapp.com/human-resources">HR</a></li>
                    <li><a href="/corporate-office/Internal Audit">Internal Audit</a></li>
                    <li><a href="/corporate-office/IT">IT</a></li>
                    <li><a href="/corporate-office/Legal">Legal</a></li>
                    <li><a href="/corporate-office/OCEO">OCEO</a></li>
                </ol>
            </li>
            <li>
                <div class="row">
                    <div class="col-md-10">
                        <a href="/our-business-and-subsidiaries">Our Businesses and Subsidiaries</a>
                    </div>
                </div>
            </li>
            {{-- <li>
                <div class="row">
                    <div class="col-md-10">
                        <a id='quick-links' href="#">Quick Links</a>
                    </div>
                </div>
                <ol id="ol-submenu3" style="display: none">
                    <li><a href="https://humanedge.megawide.com.ph/">Human Edge</a></li>
                    <li><a href="https://service.adventus.com/">IT Services</a></li>
                    <li><a href="https://checkrequestportal.megawide.com.ph:9443">CRIS</a></li>
                    <li><a href="https://megawide.com.ph/">Megawide.com.ph</a></li>
                </ol>
            </li> --}}
            <li>
                <div class="row">
                    <div class="col-md-10">
                        <a href='/company-events'>Events and Holidays</a>
                    </div>
                </div>
            </li>
        </ul>
    </label>
    

    <section class="bg-light">

        <div class="img-mega"></div>
        <div class="meganet-logo">
            <img class="img-mega-logo" src="{{asset('img/meganet-newlogo.png')}}" alt="">
        </div>

        {{-- <a href="/mega-gram"><img src="{{asset('img/megagram.png')}}" alt="" class="img-megagram"></a> --}}


        <div class="parent">


            <ul class="parent-nav">
                <li><a href="https://web.yammer.com/main/groups/eyJfdHlwZSI6Ikdyb3VwIiwiaWQiOiI4NjAxMTcyMzc3NiJ9/all" target="_blank" class="child-nav comboard" data-text="COMMUNITY BOARD"> <label class="icon-arrow"><i class="fa-solid fa-play"></i></label>COMMUNITY BOARD</a></li>
                <li><a href="/meganews" class="child-nav meganews" data-text="MEGANEWS"><label class="icon-arrow"><i class="fa-solid fa-play"></i></label>MEGANEWS</a></li>
                <li><a href="/mega-good-vibes-primary" class="child-nav megagoodvibes" data-text="MEGA GOOD VIBES"><label class="icon-arrow"><i class="fa-solid fa-play"></i></label>MEGAGOOD VIBES</a></li>
                <li><a href="/mega-trivia" class="child-nav megatrivia" data-text="MEGA TRIVIA"><label class="icon-arrow"><i class="fa-solid fa-play"></i></label>MEGATRIVIA</a></li>
                {{-- <li><a href="/mega-gram" class="child-nav megagram" data-text="MEGAGRAM"><label class="icon-arrow"><i class="fa-solid fa-play"></i></label>MEGAGRAM</a></li> --}}
                <li><a href="#" class="child-nav quicklinks" data-text="QUICKLINKS"><label class="icon-arrow"><i class="fa-solid fa-play"></i></label>EMPLOYEE LINKS</a></li>
            </ul>



            <div class="bg"></div>
            <div class="bg"></div>
            <div class="bg"></div>

            <div class="bg-meganews-img" hidden>
                <img src="{{ $meganews ? $meganews->meganews_image->first()->image : 'asset("img/person-bg-bg.png"'}}" alt="">
            </div>

            <div class="highlights"></div>
            {{-- <div class="highlights-2">
                <div class="highlights-text"></div>
            </div> --}}
            <div class="highlights-3"></div>

            <div class="bg-humanedge" hidden>
                <a href="https://humanedge.megawide.com.ph/" target="_blank"><img class="img-humanedge" src="https://humanedge.megawide.com.ph/app/assets/images/HE-logo.png" alt=""></a>
            </div>

            <div class="bg-adventus" hidden>
                <a href="https://service.adventus.com/" target="_blank"><img class="img-adventus" src="https://adventus.com/resources/front/template/adventusasia/images/logo-adventus.png" alt=""></a>
            </div>

            <div class="bg-cris" hidden>
                <a href="https://checkrequestportal.megawide.com.ph:9443" target="_blank"><img class="img-cris" src="{{asset('img/quicklinks/cris-removebg-preview.png')}}" alt=""></a>
            </div>

            <div class="bg-megawide" hidden>
                <a href="https://megawide.com.ph/" target="_blank"><img class="img-megawide" src="{{asset('img/quicklinks/megawide-logo.png')}}" alt=""></a>
            </div>



            <div class="footer-content">
                <section class="row">
                    <div class="col-md-3 ">
                        <img src="{{asset('img/megawide-logo.png')}}" alt="" style="width: 15vw; margin-top: 5px;">
                    </div>

                    <div class="col-md-2 col-lg-4 align-self-center" style="margin-top: -8px;">
                        <a href="https://www.facebook.com/MegawideCorp" style="color: white"><i class="fa-brands fa-facebook icon-logos"></i></a>
                        <a href="https://instagram.com/officialmegawide?igshid=YmMyMTA2M2Y=" style="color: white"><i class="fa-brands fa-instagram icon-logos"></i></a>
                        <a href="https://twitter.com/megawidebuilds?s=21&t=oAlFWvbecpcaOgn2WEV9uw" style="color: white"><i class="fa-brands fa-twitter icon-logos"></i></a>
                        <label for="">&nbsp;&nbsp;&nbsp;<a href="https://www.megawide.com.ph/" style="padding-left: 10px; font-size: 15px; color: white;"> www.megawide.com.ph</a></label>
                    </div>

                    <div class="col-md-7 col-lg-5 ">
                        <div class="vl"></div>
                        <label style="margin-left: 1vw;" for="">Engineering <br> A First-World Philippines</label>
                        
                    </div>
                    <hr style="border: solid 0.5px #666666; width: 100vw; margin-left: -19vw;">
                </section>
            </div>
            <div class="footer"></div>
            <div class="footer-2"></div>
        </div>
    </section>

    <style>

        @font-face {
          font-family: magistral;
          src: url({{asset('fonts/Magistral-Medium.woff')}});
        }

        .img-megagram {
            position: absolute;
            margin-left: 31.8vw;
            margin-top: 26vw;
            z-index: 3;
            width: 6vw;
        }

        body {
            margin-top: -21px;
        }

        label .menu {
            position: absolute;
            left: 38vw;
            top: 10vw;
            z-index: 100;
            width: 3vw;
            height: 3vw;
            background: transparent;
            border-radius: 50% 50% 50% 50%;
            transition: 0.5s ease-in-out;
            box-shadow: 0 0 0 0 #fff, 0 0 0 0 #fff;
            cursor: pointer;
        }
        label .hamburger {
            position: absolute;
            top: 1.5vw;
            left: 0.5vw;
            width: 30px;
            height: 2px;
            background: #000;
            display: block;
            transform-origin: center;
            transition: 0.5s ease-in-out;
        }
        label .hamburger:after, label .hamburger:before {
            transition: 0.5s ease-in-out;
            content: "";
            position: absolute;
            display: block;
            width: 100%;
            height: 100%;
            background: #000;
        }
        label .hamburger:before {
            top: -10px;
        }
        label .hamburger:after {
            bottom: -10px;
        }
        label input {
            display: none;
        }
        label input:checked + .menu {
            /*box-shadow: 9vw 9vw 0vw 10vw #0000008f, 0vw 0vw 0vw 0vw #0000008f;*/
            border-radius: 0;
            background-color: #0000008f;
            width: 22vw;
            height: 19vw;
        }
        label input:checked + .menu .hamburger {
            transform: rotate(45deg);
        }
        label input:checked + .menu .hamburger:after {
            transform: rotate(90deg);
            bottom: 0;
        }
        label input:checked + .menu .hamburger:before {
            transform: rotate(90deg);
            top: 0;
        }
        label input:checked + .menu + ul {
            opacity: 1;
        }
        label ul {
            z-index: 200;
            position: absolute;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0;
            transition: 0.25s 0s ease-in-out;
            width: 19vw;

        }
        label a {
            margin-bottom: 1em;
            display: block;
            color: #000;
            text-decoration: none;
        }

        ul#nav-hide li a {
            font-size: 1vw;
            color: #fff;
            margin-bottom: 5px;
            font-family: sans-serif;
            font-weight: 100;
        }

        ul#nav-hide li a:hover {
            color: #f13a3a;
        }

        .arrow-li {
            color: #ee3124;
        }

        label {
            font-size: 0.9vw;
        }

        .icon-arrow {
            font-size: 1vw;
            color: #ee3124;
            margin-top: 0.7vw;
            margin-left: -1.8vw;
            padding-right: 1vw;
        }

        .comboard label {
            display: none;

        }

        .comboard:hover label{
            display:block;
        }

        .meganews label {
            display: none;

        }

        .meganews:hover label{
            display:block;
        }

        .megagoodvibes label {
            display: none;

        }

        .megagoodvibes:hover label{
            display:block;
        }

        .megatrivia label {
            display: none;

        }

        .megatrivia:hover label{
            display:block;
        }

        .quicklinks label {
            display: none;

        }

        .quicklinks:hover label{
            display:block;
        }

        .megagram label {
            display: none;

        }

        .megagram:hover label{
            display:block;
        }

        .vl {
            border-left: 2px solid white;
            height: 3vw;
            position: absolute;
        }

        .parent {
          position: relative;
          top: 0;
          left: 0;
          overflow: hidden;
        }

        .img-mega-logo {
            width: 21vw;
        }

        .icon-logos {
            font-size: 1.5vw;
            padding-left: 1vw;
        }

        .highlights-text {
            position: absolute;
            /*top: 71vh;*/
            left: 34.5vw;
            z-index: 4;
            color: white;
            font-size: 1.8vw;
            font-weight: 900;
        }

        .footer-content {
            position: absolute;
            top: 85vh;
            left: 20vw;
            z-index: 5;
            color: white;

        }

        .img-mega {
            /*background-image: url({{asset('img/person-bg.png')}});*/
            background-size: cover;
            width: 28%;
            height: 81%;
            background-repeat: no-repeat;
            position: absolute;
            top: 1vh;
            left: 56vw;
            z-index: 2;
            /*zoom:  20%;*/
            overflow: hidden;
        }

        .meganet-logo {
            position: absolute;
            top: 0vh;
            left: 19vw;
        }

        .bg-megawide {
            position: absolute;
            top: 61vh;
            right: 4vw;
            z-index: 4;
        }

        .img-megawide {
            width: 43vw;
        }

        .bg-humanedge {
            position: absolute;
            top: 3vh;
            right: 4vw;
            z-index: 4;
        }

        .img-humanedge {
            width: 20vw;
        }

        .bg-cris {
            position: absolute;
            top: 40vh;
            right: 7vw;
            z-index: 4;
        }

        .img-cris {
            width: 32vw;
        }

        .bg-adventus {
            position: absolute;
            top: 24vh;
            right: 5vw;
            z-index: 4;
        }

        .img-adventus {
            width: 29vw;
        }

        .bg {
            width: 100%;
            height: 100vh;
            margin: 0;
            padding: 0;
            background-image: url({{asset("img/megagram-large.png")}});
            background-size: contain;
            /*background-repeat: no-repeat;*/
            background-color: lightgrey;
            background-position: center;
            overflow: hidden;
            -webkit-transform: scale(1.05);
            transform: scale(1.05);
            clip-path: polygon(50% 0%, 0% 96%, 100% 100%, 100% 0%);
            margin-left: 23%;
            top: 1.2vw;
            position: relative;
            /*filter: blur(2px);*/
            z-index: 1;
        }

        .bg:nth-child(2) {
            position: absolute;
            top: 0;
            left: 0;
            /*-webkit-filter: blur(10px);*/
            /*filter: blur(6px);*/
            /*clip-path: polygon(104% 0%, 100% 0%, 100% 100%, 44% 100%);*/
            overflow: hidden;
            z-index: 2;
        }

        .bg:nth-child(3) {
            position: absolute;
            top: 0;
            left: 0;
            background: #d9d9d9 !important;
            clip-path: polygon(25% 0%, 100% 0%, 100% 100%, 95% 100%);
            overflow: hidden;
            z-index: 0;
        }

        .bg-meganews-img {
            position: absolute;
            top: 14vh;
            right: 0vw;
            z-index: 4;
        }

        .bg-meganews-img img {
            width: 45vw;
            clip-path: polygon(21% 0, 100% 0, 100% 100%, 0 100%, 0% 29%)
        }

        .highlights {
            background: #d9d9d9;
            /*background-size: cover;*/
            width: 100vw;
            height: 16vw;
            position: absolute;
            z-index: 3;
            bottom: -4vh;
            clip-path: polygon(0% 100%, 18% 100%, 35% 0%, 0% 0%);
        }

        .highlights-2 {
            background: #f13a3a;
            /*background-size: cover;*/
            width: 100vw;
            height: 16vw;
            position: absolute;
            z-index: 3;
            bottom: -4vh;
            clip-path: polygon(34.7% 0%, 0% 195%, 50.3% 0%, 0% 0%);
        }

        .highlights-3 {

            background: #ee2f21;
            /*background-size: cover;*/
            width: 100vw;
            height: 18vw;
            position: absolute;
            z-index: 2;
            bottom: -4vh;
            clip-path: polygon(20% 100%, 15% 100%, 34% 2%, 20% 2%);

        }

        .footer {
            background: #000;
            background-size: cover;
            width: 100vw;
            height: 13vw;
            position: absolute;
            z-index: 4;
            bottom: -4vh;
        }

        .footer-2 {
            /*background: gray;*/
            background: rgb(180,180,180);
            background: linear-gradient(130deg, rgba(180,180,180,1) 1%, rgba(193,193,193,1) 20%, rgb(0 0 0 / 52%) 45%);
            background-size: cover;
            width: 100vw;
            height: 13vw;
            position: absolute;
            z-index: 4;
            bottom: -4vh;
            clip-path: polygon(31.8% 0%, 18% 100%, 100% 100%, 100% 0);
        }

        ul {
            position: fixed;
            z-index: 6;
            left: 20vw;
            top: 17vw;

        }
        ul li {
          list-style: none;
          /*text-align: center;*/
        }
        ul li a {
          color: #333;
          text-decoration: none;
          font-size: 1.8vw;
          font-family: magistral;
          /*padding: 5px 20px;*/
          display: inline-flex;
          font-weight: 700;
          transition: 0.5s;
        }
        ul:hover li a {
          color: #0002;
        }
        ul li:hover a {
          color: #000;

          /*background: rgba(255, 255, 255, 1);*/
        }
        ul li a:before {
          content: "";
          position: absolute;
          top: 50%;
          left: 40%;
          transform: translate(-50%, -50%);
          display: flex;
          justify-content: center;
          align-items: center;
          font-size: 2em;
          color: rgba(0, 0, 0, 0.1);
          border-radius: 50%;
          z-index: -1;
          opacity: 0;
          font-weight: 900;
          text-transform: uppercase;
          letter-spacing: 500px;
          transition: letter-spacing 0.5s, left 0.5s;
        }
        /*ul li a:hover:before {
          content: attr(data-text);
          opacity: 1;
          left: 50%;
          letter-spacing: 10px;
          width: 1800px;
          height: 1800px;
        }
        ul li:nth-child(6n + 1) a:before {
          background: #ffffff00;
        }
        ul li:nth-child(6n + 2) a:before {
          background: #ffffff00;
        }
        ul li:nth-child(6n + 3) a:before {
          background: #ffffff00;
        }
        ul li:nth-child(6n + 4) a:before {
          background: #ffffff00;
        }*/

        a:hover {
            font-size: 2.2vw;
            font-weight: 800;
        }

    </style>

    <script>
        window.onload = function() {
            $("#checkbox-action").on('click', function(){

                if ($("#checkbox-action").is(':checked')) {
                    $("#nav-hide").removeAttr('hidden');
                } else {
                    $("#nav-hide").attr("hidden",true);
                }

            });

            var counter = 0;
            var counter1 = 0;
            var counter2 = 0;

            $('#our-office').click(function() {
                if (counter == 0) {
                    counter = 1;
                } else {
                    counter = 0;
                }

                if (counter == 1) {
                    counter1 = 0;
                    counter2 = 0;
                    $('#ol-submenu2').css("display","none");
                    $('#ol-submenu3').css("display","none");
                    $('#ol-submenu1').css("display","block");
                    $('.menu').css('height', '30vw');
                    $('#nav-hide').css('top', '54%');

                } else {
                    $('#ol-submenu1').css("display","none");
                    $('.menu').css('height', '20vw');
                    $('#nav-hide').css('top', '40%');
                }
            });

            $('#our-business-and-subs').click(function() {
                if (counter1 == 0) {
                    counter1 = 1;
                } else {
                    counter1 = 0;
                }

                if (counter1 == 1) {
                    counter = 0;
                    counter2 = 0;
                    $('#ol-submenu1').css("display","none");
                    $('#ol-submenu3').css("display","none");
                    $('#ol-submenu2').css("display","block");
                    $('.menu').css('height', '30vw');
                    $('#nav-hide').css('top', '54%');
                } else {
                    $('#ol-submenu2').css("display","none");
                    $('.menu').css('height', '20vw');
                    $('#nav-hide').css('top', '40%');
                }
            });

            $('#quick-links').click(function() {
                if (counter2 == 0) {
                    counter2 = 1;
                } else {
                    counter2 = 0;
                }

                if (counter2 == 1) {
                    counter = 0;
                    counter1 = 0;
                    $('#ol-submenu1').css("display","none");
                    $('#ol-submenu2').css("display","none");
                    $('#ol-submenu3').css("display","block");
                    $('.menu').css('height', '30vw');
                    $('#nav-hide').css('top', '50%');
                } else {
                    $('#ol-submenu3').css("display","none");
                    $('.menu').css('height', '20vw');
                    $('#nav-hide').css('top', '40%');
                }
            });

            $(".meganews").hover(function(){
                $(".bg").css("opacity", 0);
                $(".bg").css("background","url({{ $meganews ? $meganews->meganews_image->first()->image : 'asset("img/person-bg-bg.png"'}})");
                $(".bg").animate({opacity: 1}, 2000);
                $(".bg").css("background-position","center");
                $(".bg").css("background-size","contain");
                $(".bg").css("filter","blur(3px)");


                $(".img-mega").css("display","none");
                $(".bg-humanedge").attr('hidden', true);
                $(".bg-cris").attr('hidden', true);
                $(".bg-adventus").attr('hidden', true);
                $(".bg-megawide").attr('hidden', true);
                $(".bg-meganews-img").removeAttr('hidden');

            });

            $(".megagoodvibes").hover(function(){
                $(".bg").css("opacity", 0);
                $(".bg").css("background","url({{ $megaGoodVibes ? $megaGoodVibes->thumbnail : 'asset("img/person-bg-bg.png"'}})");
                $(".bg").animate({opacity: 1}, 2000);
                $(".bg").css("background-position","center");
                $(".bg").css("background-size","contain");
                $(".bg").css("filter","blur(0px)");


                $(".img-mega").css("display","none");
                $(".bg-humanedge").attr('hidden', true);
                $(".bg-cris").attr('hidden', true);
                $(".bg-adventus").attr('hidden', true);
                $(".bg-megawide").attr('hidden', true);
                $(".bg-meganews-img").attr('hidden', true);

            });

            $(".megatrivia").hover(function(){
                $(".bg").css("opacity", 0);
                $(".bg").css("background","url({{ $megaTrivia ? $megaTrivia->image : 'asset("img/person-bg-bg.png"'}})");
                $(".bg").animate({opacity: 1}, 2000);
                $(".bg").css("background-position","center");
                $(".bg").css("background-size","contain");
                $(".bg").css("filter","blur(0px)");


                $(".img-mega").css("display","none");
                $(".bg-humanedge").attr('hidden', true);
                $(".bg-cris").attr('hidden', true);
                $(".bg-adventus").attr('hidden', true);
                $(".bg-megawide").attr('hidden', true);
                $(".bg-meganews-img").attr('hidden', true);

            });

            $(".comboard").hover(function(){
                $(".bg").css("opacity", 0);
                $(".bg").css("background","url({{asset("img/megagram-large.png")}})");
                $(".bg").animate({opacity: 1}, 2000);
                $(".bg").css("background-position","center");
                $(".bg").css("background-size","contain");
                $(".bg").css("filter","blur(0px)");


                $(".img-mega").css("display","none");
                $(".bg-humanedge").attr('hidden', true);
                $(".bg-cris").attr('hidden', true);
                $(".bg-adventus").attr('hidden', true);
                $(".bg-megawide").attr('hidden', true);
                $(".bg-meganews-img").attr('hidden', true);

            });

            $(".quicklinks").hover(function(){
                $(".bg").css("opacity", 0);
                $(".bg").css("background","none");
                $(".bg").animate({opacity: 1}, 2000);
                $(".bg").css("background-position","center");
                $(".bg").css("background-size","contain");
                $(".bg").css("filter","blur(0px)");
                $(".bg").css("clip-path","polygon(50% 0%, 0% 96%, 100% 100%, 100% 0%)");
                

                $(".img-mega").css("display","none");

                $(".bg-humanedge").removeAttr('hidden');
                $(".bg-cris").removeAttr('hidden');
                $(".bg-adventus").removeAttr('hidden');
                $(".bg-megawide").removeAttr('hidden');
                $(".bg-meganews-img").attr('hidden', true);

            });
        }


    </script>
    

@endsection