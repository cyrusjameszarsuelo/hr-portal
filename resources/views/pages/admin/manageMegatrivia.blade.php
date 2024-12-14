@extends('manageSiteTemplate')


@section('content')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0">Manage Megatrivia</h1>
					</div><!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="/main">Home</a></li>
							<li class="breadcrumb-item "><a href="/main/view-all-megatrivia">Megatrivia</a></li>
							<li class="breadcrumb-item active">Manage Megatrivia</li>
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
			        				<i class="fa fa-newspaper"></i>
			        				Megatrivia
			        			</h3>
			        		</div>
			        		<div class="card-body">
			        			<form method="POST" action="{{url( $megatrivia ? '/manageMegatriviaUpdate/' . $megatrivia->id : '/manageMegatrivia' )}}" enctype="multipart/form-data" >
			        				{{ $megatrivia ? method_field('PUT') : '' }}
			        				@csrf
			        			<div class="row">
			        				<div class="col-md-12">
		        					
		        						<div class="form-group">
		        							<label>Title</label>
		        							<input type="text" class="form-control" placeholder="Enter Title" name="title" value="{{ $megatrivia ? $megatrivia->title : ''}}">
		        						</div>

		        						<div class="form-group">
			        						<label for="imageFile">Image</label>
			        						<div class="input-group">

			        							<div class="custom-file">
			        								<input type="file" class="custom-file-input" id="imageFile" name="image" {{$megatrivia && $megatrivia->first()->image ? '' : 'required'}} accept="image/*">
			        								<label class="custom-file-label" for="imageFile">
			        									@if($megatrivia)
			        										{{$megatrivia->image}}
			        									@else 
			        									Choose File
			        									@endif
			        								</label>
			        							</div>
			        						</div>
			        					</div>


			        					<div class="form-group">
		        							<div class="custom-file">
		        								<label>Answer</label>
	        									<input type="text" class="form-control" placeholder="Enter Answer" name="answer" value="{{ $megatrivia ? $megatrivia->answer : ''}}">
		        							</div>
			        					</div>

			        					<div class="form-group">
		        							<label>Active?</label>
		        							<br>
		        							<div class="row">
		        								<div class="col-md-6">
		        									<div class="form-check">
				        								<input class="form-check-input" type="radio" name="active" id="flexRadioDefault1" checked>
				        								<label class="form-check-label" for="flexRadioDefault1" value="1">
				        									Active
				        								</label>
				        							</div>
		        								</div>
		        								<div class="col-md-6">
		        									<div class="form-check">
				        								<input class="form-check-input" type="radio" name="active" id="flexRadioDefault2" value="0">
				        								<label class="form-check-label" for="flexRadioDefault2">
				        									Inactive
				        								</label>
				        							</div>
		        								</div>
		        							</div>
        								</div>

	        							<div class="form-group">
	        								<label>Content</label>
							              	<textarea id="summernote" name="content">
							              		{{ $megatrivia ? $megatrivia->content : ''}}
							              	</textarea>
	        							</div>

	        							<button type="submit" class="btn btn-primary">Save</button>
			        				</div>
			        			</div>
			        			</form>
			        		</div>
			        	</div>
			        </div>
		        </div>
		    </div>
		</section>
	</div>
@endsection

@section('extendedScript')
	<script src="{{asset('js/manageMeganews.js')}}"></script>
@endsection