@extends('manageSiteTemplate')


@section('content')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0">MegaGram</h1>
					</div><!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="{{ url('/main') }}">Home</a></li>
							<li class="breadcrumb-item active">MegaGram</li>
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
			        				Manage MegaGram
			        			</h3>
			        		</div>
			        		<div class="card-body">
			        			<div class="row">
			        				<div class="col-md-12">
			        					<div class="card">
			        						<div class="card-header">
			        							<h3 class="card-title">List of MegaGram</h3>
			        						</div> 

			        						<div class="card-body">
			        							<div class="row">
				        							<a class="btn btn-primary" href="{{ url('/main/view-all-megagram/manageMegagram') }}">Add MegaGram</a>
				        						</div>
				        						<br>
			        							<table id="example1" class="table table-bordered table-striped">
			        								<thead>
			        									<tr>
			        										<th>Image</th>
			        										<th>Title</th>
			        										<th>Content</th>
			        										<th>Active</th>
			        										<th>Date Created</th>
			        										<th>Action</th>
			        									</tr>
			        								</thead>
			        								<tbody>
			        									@foreach($megagram as $megagramData)
			        										<tr>
			        											<td class="text-center"><img src="{{ asset($megagramData->image) }}" alt="" width="50%"></td>
			        											<td>{{$megagramData->title}}</td>
			        											<td>{!!$megagramData->content!!}</td>
			        											<td>{{$megagramData->active == 1 ? 'Active' : 'Inactive' }}</td>
			        											<td>{{$megagramData->created_at}}</td>
			        											<td>
			        												<div class="btn-group">
				        												<a class="btn btn-primary" href="{{ url('/main/view-all-megagram/manageMegagram') .'/'.$megagramData->id }}">Edit</a>
				        												<button class="btn btn-danger" data-toggle="modal" data-target="#deleteMegagram" onclick="deleteFunction({{$megagramData->id}});">Remove</button>
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
	<div class="modal fade" id="deleteMegagram" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
					<form method="POST" id="deleteMegagramForm">
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
		<script src="{{asset('js/manageMegagram.js')}}"></script>
@endsection