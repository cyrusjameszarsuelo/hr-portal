                <div class="d-flex align-items-center justify-content-between py-2 px-4 " id="blogs_page">
                    <h2 class="position-relative font-26 semi-font fables-blog-category-head fables-main-text-color fables-second-before pl-3 mb-4">Blogs</h2> 
                    <a class="text-secondary font-weight-medium text-decoration-none"  ></a>
                    <div>&nbsp;</div><div>&nbsp;</div><div>&nbsp;</div><div>&nbsp;</div><div>&nbsp;</div><div>&nbsp;</div><div>&nbsp;</div>
                    <button class="btn btn-primary fables-btn-rounded btn-sm" type="button" data-toggle="modal" data-target="#exampleModal">Add Blog</button>
                    <a class="text-secondary font-weight-medium text-decoration-none" href="/view-all-blogs">View All</a>
                </div>
                <div class="card" style="box-shadow: 6px 4px 12px; border-radius: 3px; overflow:auto; height:1000px;" >
                    <div class="container-fluid mt-4">
                        @if($blog->isEmpty())
                        <div class="text-center image content mt-5 mb-5">
                            <h4 >No Blogs Found.</h4>
                        </div>
                        @endif
                        <div class="row">   
                            @if(isset($blog))
                                @foreach($blog as $key => $blogData) 
                                    @if($key == 0)      
                                    <div class="col-12 col-sm-12 col-md-12 mb-1 mb-lg-4"> 
                                        <div class="owl-carousel owl-theme default-carousel absolute-dots nav-0">
                                            <div class="image-container zoomIn-effect position-relative" style="height: 390px;">
                                                <a href="/blog-details/{{$blogData->id}}"><img src="
                                                    @if($blogData->blog_images->first() != null)

                                                        {{$blogData->blog_images->first()->image}}

                                                    @else 

                                                        {{asset('img/blogs/default-blog-image.jpg')}}

                                                    @endif
                                                " alt="" class="w-100"></a> 
                                            </div>
                                        </div>

                                        <h2 class="font-18 semi-font mt-3 mb-1"><a href="#" class="fables-main-text-color fables-second-hover-color">{{$blogData->blog_title}}</a></h2>
                                        <a href="#" class="font-14">{{$blogData->blog_name}}</a>
                                        <div class="fables-forth-text-color font-14 mb-2 mt-2">                                  
                                            <span class="fables-icondata fables-second-text-color mr-1"></span> 
                                            <span class="mr-3"> {{ \Carbon\Carbon::parse($blogData->created_by)->format('d/m/Y') }}</span>
                                            <span class="fables-iconcomment fables-second-text-color mr-1"></span> 
                                            <a href="/blog-details/{{$blogData->id}}" class="fables-main-text-color fables-second-hover-color mr-3">{{count($blogData->blog_comments)}}</a> 
                                            <span class=" fables-second-text-color mr-1"><i class="fa fa-regular fa-heart"></i></span> 
                                            <a href="/blog-details/{{$blogData->id}}" class="fables-main-text-color fables-second-hover-color">0</a> 
                                        </div>
                                        <p class="fables-forth-text-color font-14 mb-3">
                                            {{ str_limit($blogData->content, 500, '...') }}
                                        </p>
                                        <a href="/blog-details/{{$blogData->id}}" class="btn fables-main-text-color fables-second-hover-color font-14 p-0 underline ">Read More</a> 
                                    </div>
                                    @endif
                                @endforeach
                           @endif
                                
                       </div>


                       <hr style="width: 50%">
                        <div class="row">
                            <div class="col-md-12">
                                @if(!$blog->isEmpty())
                                    <h2 class="position-relative font-23 semi-font fables-blog-category-head fables-main-text-color fables-second-before pl-3 mb-4 mt-4">Recent Posts</h2>
                                @endif
                                <div class="row">

                                @if(isset($blog))
                                    @foreach($blog as $key => $blogData) 
                                        @if($key >= 1) 
                                        <div class="col-md-4">
                                            <div class="image-container zoomIn-effect position-relative" style="width: 75%; height: 80px;">
                                                <a href="/blog-details/{{$blogData->id}}"><img src="{{isset($blogData->blog_images[0]->image) ? $blogData->blog_images[0]->image : asset('img/blogs/default-blog-image.jpg')}}" alt="" class="w-100"></a> 
                                            </div>

                                            <div class="fables-forth-text-color font-14  my-2">                                  
                                                <span class="fables-icondata fables-second-text-color mr-1"></span> 
                                                <span class="mr-3">{{ \Carbon\Carbon::parse($blogData->created_by)->format('d/m/Y') }}</span>
                                                <span class="fables-iconcomment fables-second-text-color mr-1"></span> 
                                                <a href="/blog-details/{{$blogData->id}}" class="fables-forth-text-color fables-second-hover-color position-relative z-index">{{count($blogData->blog_comments)}}</a> 
                                            </div>
                                            <a href="#" class="font-14">{{$blogData->blog_name}}</a>
                                            <h2 class="font-18 semi-font"><a href="/blog-details/{{$blogData->id}}" class="fables-main-text-color fables-second-hover-color">{{$blogData->blog_title}}</a></h2> 
                                            <a href="/blog-details/{{$blogData->id}}" class="btn fables-second-text-color fables-main-hover-color font-14 p-0 my-3">Read More <i class="fas fa-chevron-right"></i></a>  
                                        </div>
                                        @endif
                                    @endforeach
                                @endif

                                </div>
                            </div>
                        </div>
                   </div>
               </div>

    @include('pages.add_blog')
               