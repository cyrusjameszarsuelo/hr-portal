@extends('welcome')

@section('title', 'Human Resources')

@section('content')

    {{-- <div class="fables-header bg-white index-3-height bg-rules overflow-hidden">
    <div class="container position-relative z-index">   
        <div class="row">
            <div class="col-12 col-lg-7 offset-lg-4 wow fadeInUpBig" data-wow-duration="2s" style="visibility: visible; animation-duration: 2s; animation-name: fadeInUpBig; ">
                <div class="index-3-height-caption">
                    <h1 class="fables-main-text-color bold-font mb-2 font-40">Corporate Human Resources</h1>  
                    <br>
                    <a href="#structure" class="btn fables-second-background-color fables-second-border-color white-color rounded-0 mr-4 px-4 py-2 white-color-hover">Get Started</a>  
                </div> 
            </div>
        </div> 
    </div>
</div> --}}


    {{-- <button class="openbtn" onclick="openNav()">T</button> --}}

    {{-- <div id="mySidepanel" class="sidepanel">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    @include('pages.organizational_structure')
  
</div> --}}

    <div class="container-fluid py-3">
        <div class="row">
            <div class="col-md-5">

                @include('pages.survey_page')

            </div>

            <div class="col-md-7">

                @include('pages.community_board_page')

            </div>
        </div>
        <br>
    </div>


    <!-- Featured News Slider Start -->
    <div class="container-fluid py-3 mt-5 bg-white">
        <br>
        <div class="">
            <div class="row" id="general_announcement">
                <div class="col-md-5">
                    <div class="d-flex align-items-center justify-content-between py-2 px-4">
                        <h2
                            class="position-relative font-26 semi-font fables-blog-category-head fables-main-text-color fables-second-before pl-3 mb-3 ">
                            General Announcement</h2>
                        <a class="text-secondary font-weight-medium text-decoration-none"
                            href="/view-all-announcements/{{ $generalAnnouncement ? $generalAnnouncement->content_type->id : 2 }}">View
                            All</a>
                    </div>

                    @if ($generalAnnouncement)
                        <div class="text-center position-relative mb-3 mb-lg-0">
                            <div class="position-relative overflow-hidden" style="height: 600px;">
                                @if (stripos($generalAnnouncement->announcements_images->first()->image, '.pdf') !== false)
                                    <embed src="{{ $generalAnnouncement->announcements_images->first()->image }}"
                                        width="100%" style="height: 35vw;" />
                                @else
                                    <img class="img-fluid h-100"
                                        src="{{ $generalAnnouncement->announcements_images->first()->image }}"
                                        style="object-fit: cover;">
                                    <div class="overlay ">
                                        <div class="mb-1">
                                            <a class="text-white"
                                                href="">{{ $generalAnnouncement->content_type->type }}</a>
                                            <span class="px-2 text-white">/</span>
                                            <a class="text-white" href="">{{ $generalAnnouncement->created_at }}</a>
                                        </div>
                                        <a class="h2 m-0 text-white font-weight-bold" type="button" data-toggle="modal"
                                            data-target="#generalAnnouncementModal"
                                            onclick='getSubData({{ $generalAnnouncement }})'>{{ $generalAnnouncement->title }}</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                </div>

                <div class="col-md-3 mt-2">
                    <div class="row mt-6">
                        @foreach ($generalAnnouncementAll as $key => $generalAnnouncementAllData)
                            <div class="col-5 mb-2">
                                <div class="image-container zoomIn-effect position-relative"
                                    style="width: 100%; height: 100px;">
                                    @if ($generalAnnouncementAllData->announcements_images->first())
                                        <img src="{{ asset($generalAnnouncementAllData->announcements_images->first()->image) }}"
                                            alt="" class="w-100">
                                    @else
                                        <div class="text-light d-flex justify-content-center align-items-center"
                                            style="height: 100%; background-color: #b1b1b1">
                                            <i>No image available</i>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-7 pl-0 mb-2">
                                <a style="padding-right: 25px" type="button" data-toggle="modal"
                                    data-target="#generalAnnouncementModal"
                                    onclick='getSubData({{ $generalAnnouncementAllData }})'
                                    class="fables-main-text-color bold-font fables-second-hover-color blog-smaller-head">{{ str_limit($generalAnnouncementAllData->title, 40, '...') }}</a>
                                <p class="fables-forth-text-color font-12" style="margin: 0px">
                                    {{ \Carbon\Carbon::parse($generalAnnouncementAllData->created_at)->format('M/d/Y H:i:s') }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-right">
                        <a href="/view-all-announcements/{{ $generalAnnouncement->content_type->id }}"
                            class="btn fables-second-text-color underline fables-main-text-color font-14"
                            style="padding-right: 25px"> More</a>
                    </div>
                    @endif
                </div>

                <!--Divider!-->
                <div class="" id="dividerWrap">
                    <div class="contentDivider">
                        <div class="dividedText">
                            <div class="icon">
                                <i class="medium fas fa-user"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!--divider end-->

                <div class="col-md-4">
                    <div class="d-flex align-items-center justify-content-between py-2 px-4">
                        <h2
                            class="position-relative font-26 semi-font fables-blog-category-head fables-main-text-color fables-second-before pl-3 mb-3 ">
                            New Hires</h2>
                        <a class="text-secondary font-weight-medium text-decoration-none" href="/view-all-hires">View
                            All</a>
                    </div>
                    <div class="wow bounceInDown" data-wow-duration="2s" data-wow-delay=".4s"
                        style="visibility: visible; animation-duration: 2s; animation-delay: 0.4s; animation-name: bounceInDown; ">
                        <div class="container-fluid py-3 " {{-- style="border: 1px solid; padding: 20px" --}}>
                            <div class="text-center">
                                <hr style="width: 10%; border: solid 2px black;">
                                {{-- <h4>{{ \Carbon\Carbon::parse($newHires->first()->created_at)->format('M Y') }} </h4> --}}
                            </div>
                            <br>
                            <div class="owl-carousel owl-carousel-2 carousel-item-1 position-relative">
                                @foreach ($newHires as $newHiresData)
                                    <div class="position-relative overflow-hidden" style="height: 400px;">
                                        <img class="img-fluid w-100 h-100" src="{{ $newHiresData->image }}"
                                            style="object-fit: cover;">
                                        <div class="overlay">
                                            <div class="mb-1" style="font-size: 13px;">
                                                <a class="text-white" href="">{{ $newHiresData->position }}</a>
                                            </div>
                                            <a class="h4 m-0 text-white" href="">{{ $newHiresData->name }}</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <br>
                            <div class="text-center">
                                <h4>WELCOME, KaMegawide!</h4>
                                <hr style="width: 20%; border: solid 2px black;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <br>
            <br>
            <div class="row" id="hr_templates">
                <div class="col-lg-7 py-2">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center justify-content-between py-2 px-4">
                                <h2
                                    class="position-relative font-26 semi-font fables-blog-category-head fables-main-text-color fables-second-before pl-3 mb-3 ">
                                    Memorandum</h2>
                                <a class="text-secondary font-weight-medium text-decoration-none"
                                    href="/view-all-announcements/{{ $memorandum ? $memorandum->content_type->id : 3 }}">View
                                    All</a>
                            </div>
                            @if ($memorandum)
                                <div class="position-relative overflow-hidden" style="height: 300px;">
                                    <img class="img-fluid w-100"
                                        src="{{ $memorandum->announcements_images->first()->image }}"
                                        style="object-fit: cover;">
                                    <div class="overlay">
                                        <div class="mb-1" style="font-size: 13px; font-weight: 500;">
                                            <a class="text-white">{{ $memorandum->content_type->type }}</a>
                                            <span class="px-1 text-white">/</span>
                                            <a class="text-white">{{ $memorandum->created_at }}</a>
                                        </div>
                                        <a class="h4 m-0 text-white" style="cursor: pointer;" data-toggle="modal"
                                            data-target="#generalAnnouncementModal"
                                            onclick='getSubData({{ $memorandum }})'>{{ $memorandum->title }}</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center justify-content-between py-2 px-4">
                                <h2
                                    class="position-relative font-26 semi-font fables-blog-category-head fables-main-text-color fables-second-before pl-3 mb-3 ">
                                    HMO</h2>
                                <a class="text-secondary font-weight-medium text-decoration-none"
                                    href="/view-all-announcements/{{ $hmoAnnouncement ? $hmoAnnouncement->content_type->id : 4 }}">View
                                    All</a>
                            </div>
                            @if ($hmoAnnouncement)
                                <div class="position-relative overflow-hidden" style="height: 300px;">
                                    <img class="img-fluid w-100"
                                        src="{{ $hmoAnnouncement->announcements_images ? $hmoAnnouncement->announcements_images->first()->image : '' }}"
                                        style="object-fit: cover;">
                                    <div class="overlay">
                                        <div class="mb-1" style="font-size: 13px; font-weight: 500;">
                                            <a class="text-white">{{ $hmoAnnouncement->content_type->type }}</a>
                                            <span class="px-1 text-white">/</span>
                                            <a class="text-white">{{ $hmoAnnouncement->created_at }}</a>
                                        </div>
                                        <a class="h4 m-0 text-white" style="cursor: pointer;" data-toggle="modal"
                                            data-target="#generalAnnouncementModal"
                                            onclick='getSubData({{ $hmoAnnouncement }})'>{{ $hmoAnnouncement->title }}</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>

                <div class="col-md-5 align-self-center mt-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="info-box bg-warning wow zoomIn" data-wow-delay=".3s">
                                <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                                <div class="info-box-content">
                                    <a target="_blank"
                                        href="https://megawideph.sharepoint.com/sites/HLD.HRPublic/Shared%20Documents/Forms/AllItems.aspx?RootFolder=%2Fsites%2FHLD%2EHRPublic%2FShared%20Documents%2F400%20Policies&FolderCTID=0x01200070E57EF218BAB84FBF05BFC0E44B94B3"
                                        class="text-white links-hover"><span class="info-box-text">Policies and
                                            Procedures</span></a>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="info-box bg-success wow zoomIn" data-wow-delay=".6s">
                                <span class="info-box-icon"><i class="fas fa-heart"></i></span>
                                <div class="info-box-content">
                                    <a target="_blank"
                                        href="https://megawideph.sharepoint.com/sites/HLD.HRPublic/Shared%20Documents/Forms/AllItems.aspx?FolderCTID=0x01200070E57EF218BAB84FBF05BFC0E44B94B3&id=%2Fsites%2FHLD%2EHRPublic%2FShared%20Documents%2F400%20Policies%2FHLD%2E%20HRD%2E%20Code%20of%20Discipline%2E%202020%2009%2005%2Epdf&parent=%2Fsites%2FHLD%2EHRPublic%2FShared%20Documents%2F400%20Policies&OR=Teams%2DHL&CT=1691508926240&clickparams=eyJBcHBOYW1lIjoiVGVhbXMtRGVza3RvcCIsIkFwcFZlcnNpb24iOiIyNy8yMzA3MDMwNzMzOSIsIkhhc0ZlZGVyYXRlZFVzZXIiOmZhbHNlfQ%3D%3D"
                                        class="text-white links-hover"><span class="info-box-text">Code of
                                            Discipline</span></a>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="info-box bg-danger wow zoomIn" data-wow-delay=".7s">
                                <span class="info-box-icon"><i class="fas fa-cloud-download-alt"></i></span>
                                <div class="info-box-content">
                                    <a target="_blank"
                                        href="https://megawideph.sharepoint.com/sites/HLD.HRPublic/Shared%20Documents/Forms/AllItems.aspx?RootFolder=%2Fsites%2FHLD%2EHRPublic%2FShared%20Documents%2F300%20Forms%20and%20Templates&FolderCTID=0x01200070E57EF218BAB84FBF05BFC0E44B94B3"
                                        class="text-white links-hover"><span class="info-box-text">Forms and
                                            Templates</span></a>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="info-box bg-info wow zoomIn" data-wow-delay="1.2s">
                                <span class="info-box-icon"><i class="fas fa-calendar"></i></span>
                                <div class="info-box-content">
                                    <a href="/holidays" class="text-white links-hover"><span
                                            class="info-box-text">Holidays</span></a>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="info-box bg-secondary wow zoomIn" data-wow-delay="1.5s">
                                <span class="info-box-icon"><i class="fas fa-image"></i></span>
                                <div class="info-box-content">
                                    <a href="/photo-gallery" class="text-white links-hover"><span
                                            class="info-box-text">Photo Gallery</span></a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>

    </div>

    <div class="container-fluid">
        <br>

        <div class="row">

            <div class="col-md-5">
                <div class="d-flex align-items-center justify-content-between py-2 px-4" id="demographics_page">
                    <h2
                        class="position-relative font-26 semi-font fables-blog-category-head fables-main-text-color fables-second-before pl-3 mb-3">
                        Demographics</h2>

                    <a class="text-secondary font-weight-medium text-decoration-none"
                        href="/demographics/{{ $demographics ? $demographics->content_type->id : 10 }}">View All</a>
                </div>
                <div class="card" style="box-shadow: 6px 4px 12px; border-radius: 3px;">
                    <div class="container">
                        <div class="position-relative mb-4 mt-4">
                            <a data-fancybox="demographics" href="{{ $demographics ? $demographics->image : '' }}">
                                <div class="image-container position-relative">
                                    <img src="{{ $demographics ? $demographics->image : '' }}" alt=""
                                        class="w-100" style="height: 52vw">
                                </div>
                                <div class="fables-blog-overlay text-white pl-2 pl-lg-4 pb-5">
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-7">

                @include('pages.how_tos')

            </div>

        </div>

        <div class="row mt-5">
            <div class="col-md-5">

                @include('pages.did_you_know')

            </div>

            <div class="col-md-7">

                @include('pages.megawide_university')

            </div>
        </div>
    </div>

    @include('pages.faqs')




    <div class="d-flex align-items-center justify-content-between py-2 px-4" id="quick_links">
        <h2
            class=" fables-counter position-relative font-26 semi-font fables-blog-category-head fables-main-text-color fables-second-before pl-3 mb-4 ">
            Quick Links</h2>
    </div>

    <div class="py-4 mb-4 bg-white">
        <div class="container-fluid">


            <div class="row">
                <div class="col">
                    <div class="row fables-counter ">
                        <a href="https://humanedge.megawide.com.ph/" target="_blank">
                            <div class="col-md-12"><img src="{{ asset('img/images for links/human_edge.png') }}"
                                    alt="" style="width: 90%"></div>
                        </a>
                        {{-- <div class="col-md-10"><a href="https://humanedge.megawide.com.ph/" target="_blank"><h2 class="fables-second-text-color fables-about-icon-head mb-2 font-15 semi-font" style="margin-left: -25px;">HuManEDGE</h2></a></div> --}}
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <h2
                        class=" fables-counter position-relative fables-blog-category-head fables-main-text-color fables-second-before pl-3 mb-4 ">
                        &nbsp;</h2>
                </div>
                <div class="col">
                    <div class="row fables-counter ">
                        <a href="https://university.megawide.com.ph/" target="_blank">
                            <div class="col-md-12"><img src="{{ asset('img/images for links/megawide_university.png') }}"
                                    alt="" style="width: 90%; margin-top: 10px"></div>
                        </a>
                        {{-- <div class="col-md-10"><a href="https://university.megawide.com.ph/" target="_blank"><h2 class="fables-second-text-color fables-about-icon-head mb-2 font-15 semi-font" style="margin-left: -25px;">Megawide University</h2></a></div> --}}
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <h2
                        class=" fables-counter position-relative fables-blog-category-head fables-main-text-color fables-second-before pl-3 mb-4 ">
                        &nbsp;</h2>
                </div>
                <div class="col">
                    <div class="row fables-counter ">
                        <a href="https://service.adventus.com/" target="_blank">
                            <div class="col-md-12"><img src="{{ asset('img/images for links/itspp.png') }}"
                                    alt="" style="width: 90%;  margin-top: 5px"></div>
                        </a>
                        {{-- <div class="col-md-10"><a href="https://itss.megawide.com.ph/web/login" target="_blank"><h2 class="fables-second-text-color fables-about-icon-head mb-2 font-15 semi-font" style="margin-left: -25px;">IT SSP</h2></a></div> --}}
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <h2
                        class=" fables-counter position-relative fables-blog-category-head fables-main-text-color fables-second-before pl-3 mb-4 ">
                        &nbsp;</h2>
                </div>
                <div class="col">
                    <div class="row fables-counter ">
                        <a href="https://checkrequestportal.megawide.com.ph:9443" target="_blank">
                            <div class="col-md-12"><img src="{{ asset('img/images for links/cris.png') }}"
                                    alt="" style="width: 90%;  margin-top: 10px"></div>
                        </a>

                        {{-- <div class="col-md-10"><a href="https://checkrequestportal.megawide.com.ph:9443" target="_blank"><h2 class="fables-second-text-color fables-about-icon-head mb-2 font-15 semi-font" style="margin-left: -25px;">CRIS</h2></a></div> --}}
                    </div>
                </div>
                {{-- <div class="d-flex align-items-center justify-content-between">
                <h2 class=" fables-counter position-relative fables-blog-category-head fables-main-text-color fables-second-before pl-3 mb-4 ">&nbsp;</h2> 
            </div>
            <div class="col">
                <div class="row fables-counter ">
                    <a href="/covid-19" target="_blank">
                        <div class="col-md-12"><img src="{{asset('img/images for links/covid.jpg')}}" alt="" style="width: 90%"></div>
                    </a>
                    <div class="col-md-10"><a href="/covid-19" target="_blank"><h2 class="fables-second-text-color fables-about-icon-head mb-2 font-15 semi-font" style="margin-left: -25px;">Covid 19 <br> Portal</h2></a></div>
                </div>
            </div> --}}
                <div class="d-flex align-items-center justify-content-between">
                    <h2
                        class=" fables-counter position-relative fables-blog-category-head fables-main-text-color fables-second-before pl-3 mb-4 ">
                        &nbsp;</h2>
                </div>
                <div class="col">
                    <div class="row fables-counter ">
                        <a href="https://web.yammer.com/" target="_blank">
                            <div class="col-md-12"><img src="{{ asset('img/images for links/yammer.png') }}"
                                    alt="" style="width: 90%"></div>
                        </a>
                        {{-- <div class="col-md-10"><a href="https://web.yammer.com/" target="_blank"><h2 class="fables-second-text-color fables-about-icon-head mb-2 font-15 semi-font" style="margin-left: -25px;">Yammer</h2></a></div> --}}
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <h2
                        class=" fables-counter position-relative fables-blog-category-head fables-main-text-color fables-second-before pl-3 mb-4 ">
                        &nbsp;</h2>
                </div>
                <div class="col">
                    <div class="row fables-counter mt-2">
                        <a href="https://megawide.com.ph/" target="_blank">
                            <div class="col-md-12"><img src="{{ asset('img/images for links/megawide_website.svg') }}"
                                    alt="" style="width: 90%;  margin-top: 10px"></div>
                        </a>
                        {{-- <div class="col-md-10"><a href="https://megawide.com.ph/" target="_blank"><h2 class="fables-second-text-color fables-about-icon-head mb-2 font-15 semi-font" style="margin-left: -25px;">Megawide<br>.com.ph</h2></a></div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <div class="container-fluid py-3" id="blog">
            <div class="row">
                <div class="col-md-6">

                    @include('pages.kamegawide_blogs')

                </div>

                <div class="col-md-6">

                    @include('pages.kamegawide_convos')

                </div>
            </div>
        </div>

    </div>


    <!-- Modal -->
    <div class="modal fade" id="generalAnnouncementModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-body" style="background-color: #e4e4e4;">
                    <div class="container ">
                        <h2 class="text-center" id="titleGeneralAnnouncement" style="color: #ee3124"></h2>
                        <hr style="border: 3px solid #c1c1c1; width: 10%;">
                        <br>
                        <div class="row justify-content-center">

                            <div class="square">
                                <div id="imageGeneralAnnouncement"> </div>
                                <p class="modalp" id="textGeneralAnnouncement" style="color: black;"></p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <br>
    <br>
    <li style="list-style: none;" class="ml-5">Total No. of Visitors:
        @if (
            $user['contacts']['mail'] == 'tosma@megawide.com.ph' ||
                $user['contacts']['mail'] == 'wmatias@megawide.com.ph' ||
                $user['contacts']['mail'] == 'cjzarsuelo@megawide.com.ph')
            <a type="button" data-toggle="modal" data-target="#totalListOfUsers"
                class="fables-second-text-color">{{ $listOfUsers->count() }}</a>
        @else
            <a type="button" href="#" class="fables-second-text-color">{{ $listOfUsers->count() }}</a>
        @endif
    </li>

    <!-- Modal -->
    <div class="modal fade" id="totalListOfUsers" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-body" style="background-color: #e4e4e4;">
                    <div class="container ">
                        <table id="tableListOfUsers" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Date Logged In</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listOfUsers as $listOfUsersData)
                                    <tr>
                                        <td>{{ $listOfUsersData->id }}</td>
                                        <td>{{ $listOfUsersData->name }}</td>
                                        <td>{{ $listOfUsersData->email }}</td>
                                        <td>{{ $listOfUsersData->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .icon-rotate>i.icon {
            transition: transform .4s ease-in-out;
            background: none;
        }

        .icon-rotate>i.icon:hover {
            transform: rotate(20deg);
        }

        .sidepanel {
            width: 0;
            position: fixed;
            z-index: 5;
            height: 50vw;
            top: 0;
            left: 0;
            background-color: #f2f2f2;
            overflow-x: auto;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidepanel a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .sidepanel a:hover {
            color: #f1f1f1;
        }

        .sidepanel .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
        }

        .openbtn {
            font-size: 20px;
            cursor: pointer;
            background-color: #111;
            color: white;
            padding: 10px 15px;
            border: none;
        }

        .openbtn:hover {
            background-color: #444;
        }

        .avatar {
            /* Center the content */
            display: inline-block;
            vertical-align: middle;

            /* Used to position the content */
            position: relative;

            /* Colors */
            background-color: #2c3e4f;
            color: #fff;

            /* Rounded border */
            border-radius: 50%;
            height: 38px;
            width: 38px;
        }

        .avatar__letters {
            /* Center the content */
            left: 50%;
            position: absolute;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        .circular {
            margin-left: 55px;
            margin-bottom: 5px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            position: relative;
            overflow: hidden;
        }

        .circular img {
            min-width: 50%;
            min-height: 50%;
            /*width: auto;
                        height: auto;*/
            position: absolute;
            left: 50%;
            top: 65%;
            -webkit-transform: translate(-50%, -50%);
            -moz-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }

        .fables-after-overlay::after {
            background-color: #f6f6f6ad;
        }
    </style>

@endsection

@section('scripts')

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="{{ asset('assets/custom/js/human_resources.js') }}"></script>
    <script src="{{ asset('assets/custom/js/forum.js') }}"></script>
    <script>
        // $(".example").scrollLeft(($(".example")[0].scrollWidth - $(".example")[0].clientWidth) / 2); 
        var owl = $('.owl-carousel');
        $(document).ready(function() {
            owl.trigger('stop.owl.autoplay');

            setInterval(function() {
                window.location.href =
                    "https://login.microsoftonline.com/common/oauth2/v2.0/logout?post_logout_redirect_uri=http://localhost:8000";
            }, 8000000);
        });

        $("#tableListOfUsers").dataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    </script>

    <script>
        function openNav() {
            document.getElementById("mySidepanel").style.width = "100vw";
        }

        function closeNav() {
            document.getElementById("mySidepanel").style.width = "0";
        }
    </script>
@endsection
