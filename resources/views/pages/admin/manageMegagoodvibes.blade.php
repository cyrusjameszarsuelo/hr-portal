@extends('manageSiteTemplate')


@section('content')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0">Manage Mega Good Vibes</h1>
					</div><!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="/main">Home</a></li>
							<li class="breadcrumb-item "><a href="/main/view-all-megagoodvibes">Mega Good Vibes</a></li>
							<li class="breadcrumb-item active">Manage Mega Good Vibes</li>
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
			        				Mega Good Vibes
			        			</h3>
			        		</div>
			        		<div class="card-body">
			        			<form method="POST" action="{{url( $megaGoodVibes ? 'manageMegagoodVibes/' . $megaGoodVibes->id  : '/manageMegagoodVibes' )}}" enctype="multipart/form-data" >
			        				{{ $megaGoodVibes ? method_field('PUT') : '' }}
			        				@csrf
			        			<div class="row">
			        				<div class="col-md-12">
		        						<div class="form-group">
			        						<label for="aFile_upload">Video input</label>
			        						<div class="input-group">

			        							<div class="custom-file">
			        								<input type="file" class="custom-file-input" id="aFile_upload" name="file" {{$megaGoodVibes && $megaGoodVibes->first()->file ? '' : 'required'}} accept="video/*">
			        								<label class="custom-file-label" for="aFile_upload" id="approvedFiles">
			        									@if($megaGoodVibes)
			        										{{$megaGoodVibes->file}}
			        									@else 
			        									Choose File
			        									@endif
			        								</label>
			        							</div>
			        						</div>
			        					</div>

			        					<div class="form-group">
			        						<label for="thumbnailFile">Thumbnail</label>
			        						<div class="input-group">

			        							<div class="custom-file">
			        								<input type="file" class="custom-file-input" id="thumbnailFile" name="thumbnail" {{$megaGoodVibes && $megaGoodVibes->first()->thumbnail ? '' : 'required'}} accept="image/*">
			        								<label class="custom-file-label" for="thumbnailFile">
			        									@if($megaGoodVibes)
			        										{{$megaGoodVibes->thumbnail}}
			        									@else 
			        									Choose File
			        									@endif
			        								</label>
			        							</div>
			        						</div>
			        					</div>

	        							<div class="form-group">
	        								<label>Content</label>
							              	<textarea id="summernote" name="content" required>
							              		{{ $megaGoodVibes ? $megaGoodVibes->content : ''}}
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
	<script src="{{asset('js/manageMegaGoodVibes.js')}}"></script>
@endsection