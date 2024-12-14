@extends('manageSiteTemplate')


@section('content')
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0">Blogs</h1>
					</div><!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="{{ url('/main') }}">Home</a></li>
							<li class="breadcrumb-item active">Blogs</li>
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
			        				Manage Blogs
			        			</h3>
			        		</div>
			        		<div class="card-body">
			        			<div class="row">
			        				<div class="col-md-12">
			        					<div class="card">
			        						<div class="card-header">
			        							<h3 class="card-title">List of Blogs</h3>
			        						</div> 

			        						<div class="card-body">
			        							<div class="row">
				        							<a class="btn btn-primary" href="{{ url('/main/blogs/add-blog') }}">Add Blog</a>
				        						</div>
			        							<table id="example1" class="table table-bordered table-striped">
			        								<thead>
			        									<tr>
			        										<th>Image</th>
			        										<th>Title</th>
			        										<th>Content</th>
			        										<th>Subject</th>
			        										<th>Date Created</th>
			        										<th>Action</th>
			        									</tr>
			        								</thead>
			        								<tbody>
			        									@if(isset($blog))
			        									@foreach($blog as $blogData)
			        									<tr>
			        										<td class="text-center"><img src="{{isset($blogData->blog_images[0]) ? asset('img/blogs/'.$blogData->blog_images[0]->image) : ''}}" alt="" width="50%"></td>
			        										<td>{{$blogData->blog_title}}</td>
			        										<td>{{ str_limit($blogData->content, 100, '...')}}</td>
			        										<td>{{$blogData->subject}}</td>
			        										<td>{{$blogData->created_at}}</td>
			        										<td >
			        											<div class="btn-group">
			        												<a href="/main/blogs/edit-blog/{{$blogData->id}}" class="btn btn-primary">Edit</a>
			        												<button class="btn btn-danger">Remove</button>
			        											</div>
			        										</td>
			        									</tr>
			        									@endforeach
			        									@endif
			        								</tbody>
			        							</table>
			        						</div>
			        					</div>
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