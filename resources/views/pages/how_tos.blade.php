

<div class="d-flex align-items-center justify-content-between py-2 px-4" id="employee_services">
    <h2 class="position-relative font-26 semi-font fables-blog-category-head fables-main-text-color fables-second-before pl-3 mb-3">Employee Services</h2> 

    <a class="text-secondary font-weight-medium text-decoration-none" href="/how-tos/{{ $howTo->first() ?  $howTo->first()->content_type->id : 6 }}">View All</a>
</div>

<div class="card" style="box-shadow: 6px 4px 12px; border-radius: 3px;">
    <div class="container-fluid mt-4 mb-4">
        <div class="row">

            <div class="col-md-4">

                @foreach($howTo as $key => $howToData)
                    <a class="fables-main-text-color font-16 bold-font fables-second-hover-color blog-smaller-head"><li class="howToName" data-src="{{$howToData->image}}">{{$howToData->name}}</li>
                    </a>
                    <hr>
                @endforeach
            </div>


            <div class="col-md-8">

                <div class="position-relative mb-4"> 
                    @foreach($howTo as $key => $howToData)
                    <a data-fancybox="how-tos" href="{{$howToData->image}}" {{$key != 0 ? 'hidden' : ''}} id="aImageView">
                        <div class="image-container position-relative" id="imageView">
                            <img src="{{$howToData->image}}" alt="" class="w-100">
                        </div>
                        <div class="fables-blog-overlay text-white pl-2 pl-lg-4 pb-5"> 
                        </div>
                    </a>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div>