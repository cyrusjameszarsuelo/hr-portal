@extends('welcome')

@section('title', 'Blog')

@section('content')

	<div class="container mt-5 mb-5">
		<form action="/updateBlog/{{$blog->id}}" method="POST">
		@csrf
		{{ method_field('PUT') }}
		<div class="card">
			<div class="card-header">
				Edit Blog ID: {{$blog->id}}
			</div>
			<div class="card-body">
				<div class="container">
					<div class="row">
			            <div class="col-md-12">
			                <div class="form-group">
			                    <label for="exampleInputEmail1">Title <span style="color: red;">*</span></label>
			                    <input type="text" class="form-control" id="title" placeholder="Enter Title" name="blog_title" required value="{{$blog->blog_title}}">
			                </div>
			            </div>
			        </div>

			        <div class="row">
			            <div class="col-md-12">
			                <div class="form-group">
			                    <label for="exampleInputEmail1">Subject <span style="color: red;">*</span></label>
			                    <input type="text" class="form-control" id="title" placeholder="Enter Title" name="subject" required value="{{$blog->subject}}">
			                </div>
			            </div>
			        </div>

			        <div class="form-group">
			            <label for="exampleFormControlTextarea1">Content <span style="color: red;">*</span></label>
			            <textarea class="form-control " rows="6" name="content" required >{{$blog->content}}</textarea>
			        </div>
		        </div>
	        </div>

	        <div class="card-footer">
	        	<button class="btn btn-primary btn-block">Save</button>
	        </div>

		</div>
		</form>
	</div>

@endsection

