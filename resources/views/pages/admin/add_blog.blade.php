@extends('manageSiteTemplate')


@section('content')

	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0">Add Blog</h1>
					</div><!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="{{ url('/main') }}">Home</a></li>
							<li class="breadcrumb-item active">Add Blog</li>
						</ol>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
		<!-- /.content-header -->

		<section class="content">
	      	<div class="container-fluid">
		        <div class="row">
		        	<div class="col-md-12">
			        	<div class="card">
			        		<div class="card-header">
			        			<h3 class="card-title">
			        				<i class="fas fa-users mr-1"></i>
			        				 Blogs
			        			</h3>
			        		</div>
			        		<div class="card-body">
			        			<div class="row">
			        				{{-- <div class="col-md-5">
			        					<div class="card">
			        						<div class="card-header">
			        							<h3 class="card-title">View of Blog</h3>
			        						</div> 

			        						<div class="card-body">
			        						</div>
			        					</div>
			        				</div> --}}

			        				<div class="col-md-12">
			        					<form action="{{ isset($blog) ? '/updateBlog/'.$blog->id : '/submitBlog'}}" method="POST" enctype="multipart/form-data">
		        						{{isset($blog) ? method_field('PUT') : '' }}
		        						@csrf
				        					<div class="form-group">
				        						<label for="exampleInputFile">File input</label>
				        						<div class="input-group">
				        							<div class="custom-file">
				        								<input type="file" multiple class="custom-file-input" id="exampleInputFile" name="image[]">
				        								<label class="custom-file-label" for="exampleInputFile">Choose file</label>
				        							</div>
				        						</div>
				        					</div>
			        					
			        						<div class="form-group">
			        							<label>Title</label>
			        							<input type="text" class="form-control" placeholder="Enter Title" name="blog_title" value="{{isset($blog) ? $blog->blog_title : '' }}">
			        						</div>

			        						<div class="form-group">
			        							<label>Subject</label>
			        							<input type="text" class="form-control" placeholder="Enter Subject" name="subject" value="{{isset($blog) ? $blog->subject : '' }}">
			        						</div>

		        							<div class="form-group">
		        								<label>Content</label>
		        								<textarea class="form-control" rows="5" placeholder="Content" name="content" >{{isset($blog) ? $blog->content : '' }}</textarea>
		        							</div>

		        							<button type="submit" class="btn btn-primary">Save</button>

	        							</form>

			        				</div>
			        			</div>
			        		</div>
			        	</div>
			        </div>
			    </div>
			</div>
		</section>
	</div>

@endsection


@section('extendedScript')
	@include('scripts.admin.manageBlogScript')
@endsection