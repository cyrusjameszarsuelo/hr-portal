@extends('manageSiteTemplate')


@section('content')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0">Manage Meganews</h1>
					</div><!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="/main">Home</a></li>
							<li class="breadcrumb-item "><a href="/main/view-all-meganews">Meganews</a></li>
							<li class="breadcrumb-item active">Manage Meganews</li>
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
			        				Meganews
			        			</h3>
			        		</div>
			        		<div class="card-body">
			        			<form method="POST" action="{{url( $meganewsDataId ? 'manageMeganewsUpdate/' . $meganewsDataId->id  : '/manageMeganews' )}}" enctype="multipart/form-data" >
			        				{{ $meganewsDataId ? method_field('PUT') : '' }}
			        				@csrf
			        			<div class="row">
			        				<div class="col-md-12">
			        					<div class="form-group">
				        						<label for="fileInputChange">File input</label>
				        						<div class="input-group">

				        							<div class="custom-file">
				        								<input type="file" multiple class="custom-file-input" id="fileInputChange" name="image[]" accept="image/*">
				        								<label class="custom-file-label" for="fileInputChange">
				        									@if($meganewsDataId)
				        									@foreach($meganewsDataId->meganews_image as $images)
				        										{{$images->image}}
				        									@endforeach
				        									@else 
				        									Choose File
				        									@endif
				        								</label>
				        							</div>
				        						</div>
				        					</div>
			        					
			        						<div class="form-group">
			        							<label>Title</label>
			        							<input type="text" class="form-control" placeholder="Enter Title" name="title" value="{{ $meganewsDataId ? $meganewsDataId->title : ''}}">
			        						</div>

		        							<div class="form-group">
		        								<label>Content</label>
								              	<textarea id="summernote" name="content">
								              		{{ $meganewsDataId ? $meganewsDataId->content : ''}}
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