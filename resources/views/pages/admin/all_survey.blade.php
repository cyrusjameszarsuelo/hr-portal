@extends('manageSiteTemplate')


@section('content')
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0">Survey</h1>
					</div><!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="{{ url('/main') }}">Home</a></li>
							<li class="breadcrumb-item active">Survey</li>
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
			        				Manage Surveys
			        			</h3>
			        		</div>
			        		<div class="card-body">
			        			<div class="row">
			        				<div class="col-md-12">
			        					<div class="card">
			        						<div class="card-header">
			        							<h3 class="card-title">List of Surveys</h3>
			        						</div> 

			        						<div class="card-body">
			        							<div class="row">
				        							<a class="btn btn-primary" href="{{ url('/main/survey') }}">Add Survey</a>
				        						</div>
			        							<table id="example1" class="table table-bordered table-striped">
			        								<thead>
			        									<tr>
			        										<th>Name</th>
			        										<th>Question</th>
			        										<th>End Date</th>
			        										<th>Active</th>
			        										<th>Date Created</th>
			        										<th>Action</th>
			        									</tr>
			        								</thead>
			        								<tbody>
			        									@if(isset($survey))
			        									@foreach($survey as $surveyData)
			        									<tr>
			        										<td>{{$surveyData->name}}</td>
			        										<td>{{$surveyData->question}}</td>
			        										<td>{{$surveyData->end_date}}</td>
			        										<td>{{$surveyData->active}}</td>
			        										<td>{{$surveyData->created_at}}</td>
			        										<td >
			        											<div class="btn-group">
			        												<a href="/main/survey/edit-survey/{{$surveyData->id}}" class="btn btn-primary">Edit</a>
			        												<button class="btn btn-danger" onclick="deleteSurvey({{$surveyData->id}})" data-toggle="modal" data-target="#deleteSurveyModal">Remove</button>
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

	<div class="modal fade" id="deleteSurveyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content ">
                <div class="modal-header bg-danger justify-content-center">
                    <h5 class="modal-title text-white " id="exampleModalLongTitle"><i class="fa-solid fa-triangle-exclamation fa-lg "></i> Are you sure to delete this?</h5>
                </div>
                <form method="POST" id="deleteForm">
                    <div class="modal-footer" style="display: block;">
                        <div class="row">
                            @csrf
                            <div class="col-md-6">
                                <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Close</button>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary btn-block">Confirm</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('extendedScript')
    <script src="{{asset('assets/custom/js/survey.js')}}"></script>
	{{-- @include('scripts.admin.manageBlogScript') --}}
@endsection