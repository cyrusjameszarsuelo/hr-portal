@extends('welcome')

@section('title', 'Blog Details')

@section('content')
	<!-- Start page content --> 
	<div class="container">
		<div class="row my-4 my-lg-5">
			<div class="col-12 col-lg-8">  
				<div class="owl-carousel owl-theme default-carousel nav-0 blog-single-slider fables-second-dots">
				@if(isset($blog->blog_images[0])) 
					@foreach($blog->blog_images as $blog_imagesData)
						<div>
							<a href="#">
								<img src="{{$blog_imagesData->image}}" alt="" class="w-100">
							</a>
						</div>  
					@endforeach
				@else 
					<img src="{{asset('img/blogs/default-blog-image.jpg')}}" alt="" class="w-100">
				@endif
				</div>
				{{-- <img src="{{isset($blog->blog_images[0]) ? asset('img/blogs/'.$blog->blog_images[0]->image) : asset('img/blogs/default-blog-image.jpg')}}" alt="" class="img-fluid">  --}}
				<h2 class="font-23 semi-font my-3"><a href="#" class="fables-main-text-color fables-second-hover-color">{{$blog->blog_title}}</a></h2>
				<div class="fables-forth-text-color fables-blog-date">                                  
					<div class="row">
						<div class="col-12 col-sm-10 pt-2">
							<span class="fables-icondata fables-second-text-color mr-1"></span> 
							<span class="mr-3"> {{ \Carbon\Carbon::parse($blog->created_at)->format('d/m/Y') }} </span>
							<span class="fables-iconcomment fables-second-text-color mr-1"></span> 
							<a href="" class="fables-forth-text-color fables-second-hover-color position-relative z-index"></a> 
							<span class="fables-forth-text-color fables-single-tags ml-4">
								<span class="fables-icontags-light fables-second-text-color"></span> 
								<a href="/view-all-blogs">{{$blog->content_type->type}}</a>
							</span> 

						</div> 
					</div>

				</div>
				<p class="fables-forth-text-color fables-single-blog font-14 my-3" style="padding-bottom: 50px;">
					{{$blog->content}}
				</p>
				<div class="fabales-single-share">
					<div class="row mt-3 mb-4">
						{{-- 
						<div class="col-12 col-sm-3 mt-3 mt-sm-0 text-center">
							<button class="btn btn-link fables-forth-border-color fables-forth-hover-backround-color fables-forth-text-color text-center font-14 float-none float-sm-right py-2 px-4" onclick="window.print();"><span class="fables-iconprint"></span> Print Article</button>
						</div> --}}

					</div>

				</div>  
				<hr>
				<div class="fables-single-blog-pag">
					<a href="" class="fables-forth-text-color fables-second-hover-color">
						<span class="fables-iconarrow-left"></span> 
						<span class="underline">Back</span>
					</a>
					<a href="" class="fables-forth-text-color fables-second-hover-color float-right">   
						<span class="underline">Next</span>
						<span class="fables-iconarrow-right"></span>
					</a>
				</div>
				<hr>
				<div class="row">
					<div class="col-2">
						<img src="{{asset ('assets/custom/images/avatar.jpg')}}" alt="" class="img-fluid">
					</div>
					<div class="col-10">
						<p>
							<span class="fables-fifth-text-color font-14">Posted By</span>
							<a href="" class="fables-second-text-color fables-second-hover-color font-15 bold-font ml-1">Admin</a>
						</p>
						<p class="font-14 my-2 fables-main-text-color">
							{{$blog->subject}}
						</p>
					</div>
				</div>

				<div class="fables-comments">
					<h2 class="fables-main-text-color fables-light-background-color my-3 my-lg-4 font-15 bold-font py-3 px-4">Comments</h2>
					<div id="comment_section">
						
					</div>
				</div>

				<div class="fables-blog-form">
					<h2 class="fables-main-text-color fables-light-background-color my-3 my-lg-4 font-15 bold-font py-3 px-4">Leave a comment ...</h2>
					<form class="fables-contact-form mb-0">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<div class="form-row">
							<div class="form-group col-md-12">
								<input type="text" class="form-control form-control rounded-0 p-3"  placeholder="Name" id="name" name="name">   
							</div>
						</div>                            
						<div class="form-row"> 
							<div class="form-group col-md-12">
								<textarea class="form-control form-control rounded-0 p-3" placeholder="Comment" rows="4" id="comment" name="comment"></textarea>
							</div> 
						</div>
						<div class="form-row">
							<div class="form-group col-md-12">
								<input type="hidden" id="blog_id" name="blog_id" value="{{$blog->id}}">
								<button type="button" id="addCommentAjax" class="btn fables-second-background-color rounded-0 text-white font-15 px-4 py-2">Post Comment</button>
							</div>
						</div>
					</form>
				</div>

			</div>
			<div class="col-12 col-lg-4">
				<div class="fables-blog-search">
					<form>
						<div class="row">
							<div class="col-12 col-sm-9 col-md-8 mb-3 mb-md-0">
								<div class="input-icon">
									<span class="fables-iconsearch-icon fables-input-icon font-14"></span>
									<input type="text" class="form-control rounded-0 py-2 width-100">
								</div>
							</div>
							<div class="col-12 col-sm-3 col-md-4 pl-md-0">
								<button type="submit" class="btn fables-second-background-color rounded-0 text-white font-15 semi-font py-2 btn-block">Search</button>
							</div>
						</div> 

					</form>
				</div>
				<div class="mt-4">
					<h2 class="position-relative font-23 semi-font fables-blog-category-head fables-main-text-color fables-second-before pl-3 mb-4">Other Posts</h2> 
					@foreach($listOfBlogs as $listOfBlogData)
					<div class="row mb-4">
						<div class="col-4">
							<a href="{{url('/blog-details/'.$listOfBlogData->id)}}"><img src=" 
								@if($listOfBlogData->blog_images->first() != null)

									{{$listOfBlogData->blog_images->first()->image}}

								@else 

									{{asset('img/blogs/default-blog-image.jpg')}}

								@endif

								" class="img-fluid " alt="image alt text">
							</a>

						</div>
						<div class="col-8 pl-0">
							<a href="{{url('/blog-details/'.$listOfBlogData->id)}}" class="fables-main-text-color bold-font fables-second-hover-color blog-smaller-head">{{$listOfBlogData->blog_title}}</a>
							<p class="fables-forth-text-color fables-blog-date-cat font-14 mt-1">{{ \Carbon\Carbon::parse($blog->created_by)->format('d/m/Y') }}</p>
						</div>
					</div>  
					@endforeach
					<div class="text-right">
						<a href="/view-all-blogs" class="btn fables-second-text-color underline fables-main-text-color font-14"> More</a>
					</div>
					<hr>
				</div>

				<div class="mt-4">
					<h2 class="position-relative font-23 semi-font fables-blog-category-head fables-main-text-color fables-second-before pl-3 mb-4">Tags</h2>
					<ul class="nav fables-blog-cat-list fables-forth-text-color fables-second-hover-color-link fables-blog-cat-tags">
						<li><a href="/view-all-meganews">Meganews</a></li>
						<li><a href="/view-all-announcements">All Announcements</a></li>
						<li><a href="/view-all-announcements/2">General Announcements</a></li>
						<li><a href="/view-all-announcements/3">Memorandum</a></li>
						<li><a href="/view-all-announcements/4">HMO Announcement</a></li>
						<li><a href="/view-all-blogs">Blogs</a></li>
					</ul> 
				</div>
			</div>
		</div>           
	</div> 
	<!-- /End page content -->
@endsection

@section('scripts')
    <script src="{{asset('assets/custom/js/blog_details.js')}}"></script>
@endsection