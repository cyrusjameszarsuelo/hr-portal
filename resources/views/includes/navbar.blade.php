<!-- Navbar Start -->
    <div class="container-fluid p-0 mb-3">
        <nav class="navbar navbar-expand-lg bg-light navbar-light py-2 py-lg-0 px-lg-5">
            <a href="/home" class="navbar-brand d-block d-lg-none">
                <h1 class="m-0 display-5 text-uppercase"><span class="text-primary">HR</span>Portal</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-0 px-lg-3" id="navbarCollapse">
                <div class="navbar-nav mr-auto py-0">
                    <a href="/human-resources" class="nav-item nav-link {{ Request::segment(1) === 'human-resources' ? 'active' : '' }} ">Corporate HR</a>
                    <a href="/job-vacancies" class="nav-item nav-link {{ Request::segment(1) === 'job-vacancies' ? 'active' : '' }} ">Job Vacancies</a>
                    {{-- <a href="#" class="nav-item nav-link " onclick="openNav()">HR Organizational Chart</a> --}}
                    <a href="/hr-organizational-structure" class="nav-item nav-link " >HR Organizational Chart</a>
                    {{-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle " data-toggle="dropdown">Interactive<i class="fa fa-chevron-down" aria-hidden="true"></i></a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="#" class="dropdown-item">For Employees</a>
                            <a href="#" class="dropdown-item">Announcements</a>
                            <a href="#" class="dropdown-item">Form Policies</a>
                            <a href="#" class="dropdown-item">Quick Links</a>
                        </div>
                    </div> --}}
                    {{-- <a href="/home" class="nav-item nav-link {{ Request::segment(1) === 'home' ? 'active' : '' }} ">Home</a>
                    <a href="/who-we-are" class="nav-item nav-link {{ Request::segment(1) === 'who-we-are' ? 'active' : '' }}">Our Company</a> --}}
                    {{-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle {{ (Request::segment(1) === 'human-resources' || Request::segment(1) === 'ccab') ? 'active' : '' }}" data-toggle="dropdown">Our Office <i class="fa fa-chevron-down" aria-hidden="true"></i></a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="/human-resources" class="dropdown-item">Corporate HR</a>
                            <a href="/ccab" class="dropdown-item">CCAB</a>
                        </div>
                    </div> --}}
                    {{-- <a href="/home" class="nav-item nav-link ">Our Subsidiaries </a> --}}


                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle"  target="_blank" data-toggle="dropdown">Quick Links <i class="fa fa-chevron-down" aria-hidden="true"></i></a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="https://humanedge.megawide.com.ph/" target="_blank"  class="dropdown-item">HuManEDGE</a>
                            <a href="https://university.megawide.com.ph/" target="_blank"  class="dropdown-item">Megawide University</a>
                            <a href="https://service.adventus.com/" target="_blank"  class="dropdown-item">Service Now</a>
                            <a href="https://checkrequestportal.megawide.com.ph:9443" target="_blank"  class="dropdown-item">Check Request and Inquiry System (CRIS)</a>
                            {{-- <a href="/covid-19" class="dropdown-item">COVID 19 Portal</a> --}}
                            <a href="https://web.yammer.com/" target="_blank"  class="dropdown-item">Yammer</a>
                            <a href="https://megawide.com.ph/" target="_blank"  class="dropdown-item">Megawide.com.ph </a>
                        </div>
                    </div>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle"  target="_blank" data-toggle="dropdown">Interactive <i class="fa fa-chevron-down" aria-hidden="true"></i></a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="/human-resources#survey_page" class="dropdown-item">Survey</a>
                            <a href="/human-resources#community_board_page" class="dropdown-item">Community Board</a>
                            <a href="/human-resources#forum_page" class="dropdown-item">Ask HR</a>
                            <a href="/human-resources#blogs_page" class="dropdown-item">Blogs</a>

                        </div>
                    </div>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle"  target="_blank" data-toggle="dropdown">HR Documents and Templates <i class="fa fa-chevron-down" aria-hidden="true"></i></a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="/human-resources#hr_templates" class="dropdown-item">HR Policies</a>
                            <a href="/human-resources#hr_templates" class="dropdown-item">Code of Discipline</a>
                            <a href="/human-resources#hr_templates" class="dropdown-item">HR Forms</a>
                        </div>
                    </div>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle"  target="_blank" data-toggle="dropdown">Knowledge Base <i class="fa fa-chevron-down" aria-hidden="true"></i></a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="/human-resources#employee_services" class="dropdown-item">Employee Services</a>
                            <a href="/human-resources#did_you_know" class="dropdown-item">Did you know</a>
                            <a href="/human-resources#megawide_university" class="dropdown-item">Megawide University</a>
                            <a href="/human-resources#faqs" class="dropdown-item">FAQs</a>
                        </div>
                    </div>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle"  target="_blank" data-toggle="dropdown">Info <i class="fa fa-chevron-down" aria-hidden="true"></i></a>
                        <div class="dropdown-menu rounded-0 m-0" style="left: -150px">
                            <a href="/human-resources#general_announcement" class="dropdown-item">General Announcement</a>
                            <a href="/human-resources#general_announcement_page" class="dropdown-item">New Hires</a>
                            <a href="/human-resources#hr_templates" class="dropdown-item">Memorandum</a>
                            <a href="/human-resources#hr_templates" class="dropdown-item">HMO</a>
                            <a href="/human-resources#hr_templates" class="dropdown-item">Holidays</a>
                            <a href="/human-resources#demographics_page" class="dropdown-item">Demographics</a>
                        </div>
                    </div>
                    <a href="/logout" class="nav-item nav-link ">Logout</a>

                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->
