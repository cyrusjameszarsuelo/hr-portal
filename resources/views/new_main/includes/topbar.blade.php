<div class="container header font-20 semi-font pt-5 pl-5">

			<div class="bg-left"></div>
			<div class="bg-right"></div>

			<div class="row">
				<div class="col-md-7">

					<p class="page-title">@yield('page-title') <label style="letter-spacing: -2px; color: red;">&nbsp;____</label></p>

				</div>
				<div class="col-md-2">
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
				</div>
				<div class="col-md-3">
					<img src="{{asset('img/meganet-newlogo-removebg.png')}}" style="    width: 71%; margin-left: 2vw; margin-top: -2.5vw;" alt="">
				</div>
			</div>

		</div>

		<style>

			@font-face {
	          font-family: magistral;
	          src: url({{asset('fonts/Magistral-Medium.woff')}});
	        }

	        p.page-title {
	        	font-family: magistral;
	        	font-size: 1.5vw;
	        }

			label .menu {
	            position: absolute;
	            left: 10vw;
	    		top: 0vw;
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
	            /*box-shadow: -9vw 9vw 0vw 10vw #0000008f, 0vw 0vw 0vw 0vw #0000008f;*/
	            border-radius: 0;
			    background-color: #0000008f;
			    width: 22vw;
			    height: 19vw;
			    margin-left: -18vw;
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
	            top: 4vw;
	    		left: -6vw;
	            /*transform: translate(-50%, -50%);*/
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

	        li {
	        	list-style: none;
	        }

	        .arrow-li {
	            color: #ee3124;
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
                    $('#nav-hide').css('top', '100%');

                } else {
                    $('#ol-submenu1').css("display","none");
                    $('.menu').css('height', '20vw');
                    $('#nav-hide').css('top', '100%');
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
                    $('#nav-hide').css('top', '100%');
                } else {
                    $('#ol-submenu2').css("display","none");
                    $('.menu').css('height', '20vw');
                    $('#nav-hide').css('top', '100%');
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
                    $('#nav-hide').css('top', '100%');
                } else {
                    $('#ol-submenu3').css("display","none");
                    $('.menu').css('height', '20vw');
                    $('#nav-hide').css('top', '100%');
                }
            });
	        }
	    </script>