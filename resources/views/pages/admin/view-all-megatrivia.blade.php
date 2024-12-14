@extends('manageSiteTemplate')


@section('content')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0">Megatrivia</h1>
					</div><!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="{{ url('/main') }}">Home</a></li>
							<li class="breadcrumb-item active">Megatrivia</li>
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
			        				Manage Megatrivia
			        			</h3>
			        		</div>
			        		<div class="card-body">
			        			<div class="row">
			        				<div class="col-md-12">
			        					<div class="card">
			        						<div class="card-header">
			        							<h3 class="card-title">List of Megatrivia</h3>
			        						</div> 

			        						<div class="card-body">
			        							<div class="row">
				        							<a class="btn btn-primary" href="{{ url('/main/view-all-megatrivia/manageMegatrivia') }}">Add Megatrivia</a>
				        						</div>
				        						<br>
			        							<table id="example1" class="table table-bordered table-striped">
			        								<thead>
			        									<tr>
			        										<th>id</th>
			        										<th>Title</th>
			        										<th>Content</th>
			        										<th>Answer</th>
			        										<th>Active</th>
			        										<th>Date Created</th>
			        										<th>Action</th>
			        									</tr>
			        								</thead>
			        								<tbody>
			        									@foreach($megatrivia as $megatriviaData)
			        										<tr>
			        											<td>{{$megatriviaData->id}}</td>
			        											<td>{{$megatriviaData->title}}</td>
			        											<td>{!!$megatriviaData->content!!}</td>
			        											<td>{{$megatriviaData->answer}}</td>
			        											<td>{{$megatriviaData->active == 1 ? 'Active' : 'Inactive' }}</td>
			        											<td>{{$megatriviaData->created_at}}</td>
			        											<td>
			        												<div class="btn-group">
				        												<a class="btn btn-primary" href="{{ url('/main/view-all-megatrivia/manageMegatrivia') .'/'.$megatriviaData->id }}">Edit</a>
				        												<button class="btn btn-danger" data-toggle="modal" data-target="#deleteMegatrivia" onclick="deleteFunction({{$megatriviaData->id}});">Remove</button>
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
	<div class="modal fade" id="deleteMegatrivia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
					<form method="POST" id="deleteMegaTriviaForm">
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
		<script src="{{asset('js/manageMegatrivia.js')}}"></script>
@endsection