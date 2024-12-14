@extends('manageSiteTemplate')


@section('content')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0">Corporate Office</h1>
					</div><!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="{{ url('/main') }}">Home</a></li>
							<li class="breadcrumb-item active">Corporate Office</li>
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
			        				Manage Corporate Office
			        			</h3>
			        		</div>
			        		<div class="card-body">
			        			<div class="row">
			        				<div class="col-md-12">
			        					<div class="card">
			        						<div class="card-header">
			        							<h3 class="card-title">List of Corporate Office</h3>
			        						</div> 

			        						<div class="card-body">
			        							<div class="row">
				        							<a class="btn btn-primary" href="{{ url('/main/view-all-corporateoffice/manageCorporateoffice') }}">Add Corporate Office</a>
				        						</div>
				        						<br>
			        							<table id="example1" class="table table-bordered table-striped">
			        								<thead>
			        									<tr>
			        										<th>id</th>
			        										<th>Department</th>
			        										<th>Organizational Structure</th>
			        										<th>Manual Link</th>
			        										<th>Policy Link</th>
			        										<th>Action</th>
			        									</tr>
			        								</thead>
			        								<tbody>
			        									@foreach($corporateOffice as $corporateOfficeData)
			        									<tr>
			        										<td>{{$corporateOfficeData->id}}</td>
			        										<td>{{$corporateOfficeData->department}}</td>
			        										<td width="10%"><img src="{{$corporateOfficeData->organizational_structure}}" width="100%" alt=""></td>
			        										<td><a target="_blank" href="{{$corporateOfficeData->manuals_link}}">{{ str_limit($corporateOfficeData->manuals_link, 40, '...') }}</a></td>
			        										<td><a target="_blank" href="{{$corporateOfficeData->policies_link}}">
			        											{{ str_limit($corporateOfficeData->policies_link, 40, '...') }}
			        											</a></td>
			        										<td>
			        											<div class="btn-group">
			        												<a class="btn btn-primary" href="{{ url('/main/view-all-corporateoffice/manageCorporateoffice') .'/'.$corporateOfficeData->id }}">Edit</a>
			        												<button class="btn btn-danger" data-toggle="modal" data-target="#deleteCorporateOffice" onclick="deleteFunction({{$corporateOfficeData->id}});">Remove</button>			        			
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
	<div class="modal fade" id="deleteCorporateOffice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
					<form method="POST" id="deleteCorporateOfficeForm">
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
		<script src="{{asset('js/manageCorporateoffice.js')}}"></script>
@endsection