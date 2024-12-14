
<div class="d-flex align-items-center justify-content-between py-2 px-4" id="did_you_know">
    <h2 class="position-relative font-26 semi-font fables-blog-category-head fables-main-text-color fables-second-before pl-3 mb-3">Did You Know?</h2>

    <a class="text-secondary font-weight-medium text-decoration-none" href="/did-you-know/{{ $didYouKnow->first() ? $didYouKnow->first()->content_type->id : 7 }}">View All</a>
</div>
<br>
<div class="card" style="box-shadow: 6px 4px 12px; border-radius: 3px;">
    <div class="container-fluid mt-4 mb-5">
        <div class="row">
            @foreach($didYouKnow as $key => $didYouKnowData)
            <div class="col-12" {{$key == 0 ?  : 'hidden'}}>
                <div class="position-relative mb-4"> 
                    @if(stripos($didYouKnowData->image, 'mp4') !== FALSE)
                        <a href="{{asset($didYouKnowData->image)}}" target="_blank">
                            <div class="front filter-img-block position-relative">
                                <video width="600" height="600" >
                                  <source src="{{$didYouKnowData->image}}" type="video/mp4">
                                </video>
                            </div>
                        </a>
                    @elseif(substr($didYouKnowData->image, -3) == 'pdf')

                        <div class="position-relative mb-4" id="embedFile"> 
                            <embed src="{{$didYouKnowData->image}}" width="100%" style="height: 35vw;" />
                            <br>
                            <br>
                            <a href="{{$didYouKnowData->image}}" target="_blank">
                                <button class="btn btn-primary btn-block fables-btn-rounded">View in New Tab</button>
                            </a>
                        </div>

                    @else

                    <a data-fancybox="did-you-know" id="did-you-know" href="{{$didYouKnowData->image}}" >
                        <div class="image-container position-relative">
                            <img src="{{$didYouKnowData->image}}" alt="" class="w-100">
                        </div>
                        <div class="fables-blog-overlay text-white pl-2 pl-lg-4 pb-5"> 
                        </div>
                    </a>

                    @endif
                </div>
            </div>
            @endforeach

           {{--  <div class="col-md-8">
                <h1>5</h1>
            </div> --}}
        </div>
    </div>
</div>
 


    