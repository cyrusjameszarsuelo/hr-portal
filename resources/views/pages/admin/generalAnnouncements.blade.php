@extends('manageSiteTemplate')


@section('content')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0">General Announcements</h1>
					</div><!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="{{ url('/main') }}">Home</a></li>
							<li class="breadcrumb-item active">General Announcements</li>
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
			        				Manage General Announcement
			        			</h3>
			        		</div>
			        		<div class="card-body">
			        			<div class="row">
			        				<div class="col-md-12">
			        					<div class="card">
			        						<div class="card-header">
			        							<h3 class="card-title">List of General Announcements</h3>
			        						</div> 

			        						<div class="card-body">
			        							<div class="row">
				        							<a class="btn btn-primary" href="{{ url('/main/generalAnnouncements/manageGeneralAnnouncement') }}">Add Announcement</a>
				        						</div>
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
			        									<tr>
			        										<td class="text-center"><img src="{{ asset ('img/g-ann1.png') }}" alt="" width="50%"></td>
			        										<td>Test</td>
			        										<td>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Architecto, repudiandae amet nesciunt sed ipsa esse impedit natus vitae nihil ex magnam eligendi necessitatibus inventore cum perferendis totam nobis quibusdam. Enim?</td>
			        										<td> 12-12-2020</td>
			        										<td >
			        											<div class="btn-group">
			        												<button class="btn btn-primary">Edit</button>
			        												<button class="btn btn-danger">Remove</button>
			        											</div>
			        										</td>
			        									</tr>
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
	@include('scripts.admin.manageSiteTemplateScript')
@endsection