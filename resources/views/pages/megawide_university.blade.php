

<div class="d-flex align-items-center justify-content-between py-2 px-4" id="megawide_university">
    <h2 class="position-relative font-26 semi-font fables-blog-category-head fables-main-text-color fables-second-before pl-3 mb-3">Megawide University</h2> 

    <a class="text-secondary font-weight-medium text-decoration-none" href="/megawide-university/{{ $megawideUniversity->first() ? $megawideUniversity->first()->content_type->id : 8 }}">View All</a>
</div>
<br>

<div class="card" style="box-shadow: 6px 4px 12px; border-radius: 3px;">
    <div class="container-fluid mt-4 mb-1">
        <div class="row">

            <div class="col-md-4">

                @foreach($megawideUniversity as $key => $megawideUniversityData)
                    @if($key < 10)
                    <a {{-- href="{{asset($megawideUniversityData->image)}}" target="_blank" --}} class="fables-main-text-color font-16 bold-font fables-second-hover-color blog-smaller-head"><li class="MuName" data-src="{{$megawideUniversityData->image}}">{{$megawideUniversityData->name}}</li>
                    </a>
                    <hr>
                    @endif
                @endforeach
            </div>


            <div class="col-md-8">

                <div class="position-relative mb-4" id="embedFile"> 
                    <embed src="{{ $megawideUniversity->first() ? $megawideUniversity->first()->image : ''}}" width="100%" style="height: 35vw;" />
                    <br>
                    <br>
                    <a href="{{ $megawideUniversity->first() ? $megawideUniversity->first()->image : ''}}" target="_blank" class="text-white">
                    <button class="btn btn-primary btn-block fables-btn-rounded">View in New Tab</button>
                    </a>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>