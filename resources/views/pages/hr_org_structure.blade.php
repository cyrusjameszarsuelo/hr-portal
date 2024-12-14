@extends('welcome')

@section('title', 'HR Org Structure')

@section('content')


<!-- Start Header -->
<div class="fables-header fables-after-overlay">
    <div class="container"> 
         <h2 class="fables-page-title fables-second-border-color">HR Organizational Structure</h2>
    </div>
</div>  
<!-- /End Header -->

<!-- Start page content -->  
    <div class="container-fluid">

        <div class="row">
            {{-- <img src="{{asset('img/ccab-image.png')}}" width="100%" alt=""> --}}
            @include('pages.organizational_structure')

        </div>


    </div>
<!-- /End page content -->

<!-- Modal -->
<div class="modal fade" id="modalTree" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <div class="container">
                    <div class="row">

                        <div class="col-md-5">
                            <div id="imageTree"></div>
                        </div>

                        <div class="col-md-7 align-self-center" >
                            <div style="border: 1px solid; padding: 20px">
                                <h3 class="font-30" id="nameTree"></h3>
                                <hr style="width: 10%; border: solid 2px black;">
                                <p class="font-20" id="positionTree"></p>
                            </div>
                            <br>
                            <div class="text-left" id="responsibilities">
                                
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

<style>
    img.img-modal {
        float: left; 
        margin: 0px 50px 20px 20px;
        width: 50%;
    }
    p.modalp {
        text-align: justify;
        margin: 10px 20px;
    }

    .icon-rotate > div.icon  {
      transition: transform .4s ease-in-out;
      background: none;
    }
    .icon-rotate > div.icon:hover {
      transform: rotate(20deg);
    }

    .card-title {
        font-size: 14px;
    }

    .card-text {
        font-size: 11px;
        color: black;
    }

    .tf-tree li {
        padding: 0 2px;
    }

    .card-body {
        margin: 0 -10px;
    }

    div.panel-body > p {
        color: black;
        letter-spacing: 0px;
        font-size: 16px;
    }

    span.tf-nc {
        cursor: pointer;
    }

    .tf-tree .tf-nc1:after {
        height: 12.3em;
    } 

    .tf-tree .tf-nc-none:after {
        content: none;
    } 

    .label {
        background: white;
        float: left;
        height: 20px;
        margin-left: 30px;
        position: relative;
        top: -8px;
    }

    .line-tf {
        height: 1px;
        background-color: black;
        display: block;
        margin-top: 65px;
        margin-bottom: 9px;
        width: 141px;
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

        /*.fables-after-overlay::after 
        {
            background-color:  #f6f6f6ad;
        }*/
</style>

@endsection

@section('scripts')

    <script src="{{asset('assets/custom/js/human_resources.js')}}"></script>
@endsection