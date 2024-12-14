@extends('manageSiteTemplate')


@section('content')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0">Meganews</h1>
					</div><!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="{{ url('/main') }}">Home</a></li>
							<li class="breadcrumb-item active">Meganews</li>
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
			        				Manage Meganews
			        			</h3>
			        		</div>
			        		<div class="card-body">
			        			<div class="row">
			        				<div class="col-md-12">
			        					<div class="card">
			        						<div class="card-header">
			        							<h3 class="card-title">List of Meganews</h3>
			        						</div> 

			        						<div class="card-body">
			        							<div class="row">
				        							<a class="btn btn-primary" href="{{ url('/main/view-all-meganews/manageMeganews') }}">Add Meganews</a>
				        						</div>
				        						<br>
			        							<table id="example1" class="table table-bordered table-striped">
			        								<thead>
			        									<tr>
			        										<th>Image</th>
			        										<th>Title</th>
			        										<th>Content</th>
			        										<th>Date Created</th>
			        										<th>Action</th>
			        									</tr>
			        								</thead>
			        								<tbody>
			        									@foreach($meganews as $meganewsData)
			        									<tr>
			        										<td class="text-center" style="width: 17%"><img src="{{ ($meganewsData->meganews_image->first()) ? asset($meganewsData->meganews_image->first()->image) : '' }}" alt="" width="100%"></td>
			        										<td>{{$meganewsData->title}}</td>
			        										<td>{!!$meganewsData->content!!}</td>
			        										<td>{{$meganewsData->created_at}}</td>
			        										<td >
			        											<div class="btn-group">
			        												<a class="btn btn-primary" href="{{ url('/main/view-all-meganews/manageMeganews') .'/'.$meganewsData->id }}">Edit</a>
			        												<button class="btn btn-danger" data-toggle="modal" data-target="#deleteMeganews" onclick="deleteFunction({{$meganewsData->id}});">Remove</button>
			        											</div>
			        										</td>
			        									</tr>
			        									@endforeach
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

	<!-- Modal -->
	<div class="modal fade" id="deleteMeganews" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content bg-danger">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Confimation</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body bg-white text-center">
					<br>
					<h3>Are you sure to delete this?</h3>
					<br>
				</div>
				<div class="modal-footer bg-white">
					<form method="POST" id="deleteMeganewsForm">
						@csrf
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-danger">Delete</button>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('extendedScript')
		<script src="{{asset('js/manageMeganews.js')}}"></script>
@endsection