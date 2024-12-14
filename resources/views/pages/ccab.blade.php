@extends('welcome')

@section('title', 'CCAB')

@section('content')


<!-- Start Header -->
<div class="fables-header fables-after-overlay">
    <div class="container"> 
         <h2 class="fables-page-title fables-second-border-color">Corporate Affairs, Corporate Communications, <br>and Corporate Branding</h2>
    </div>
</div>  
<!-- /End Header -->
     
<!-- Start Breadcrumbs -->
<div class="fables-light-background-color">
    <div class="container"> 
        <nav aria-label="breadcrumb">
          <ol class="fables-breadcrumb breadcrumb px-0 py-3">
            <li class="breadcrumb-item"><a href="/home" class="fables-second-text-color">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">CCAB</li>
          </ol>
        </nav>
         
    </div>
</div>
<!-- /End Breadcrumbs -->

<!-- Start page content -->  
    <div class="container-fluid">

        <div class="row">
            <img src="{{asset('img/ccab-image.png')}}" width="100%" alt="">
        </div>


    </div>
<!-- /End page content -->

@endsection