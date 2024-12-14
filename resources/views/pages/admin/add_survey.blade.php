@extends('manageSiteTemplate')


@section('content')

	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0">Add Survey</h1>
					</div><!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="{{ url('/main') }}">Home</a></li>
							<li class="breadcrumb-item active">Add Survey</li>
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
			        				 Blogs
			        			</h3>
			        		</div>
			        		<div class="card-body">
			        			<div class="row">
			        				{{-- <div class="col-md-5">
			        					<div class="card">
			        						<div class="card-header">
			        							<h3 class="card-title">View of Blog</h3>
			        						</div> 

			        						<div class="card-body">
			        						</div>
			        					</div>
			        				</div> --}}

			        				<div class="col-md-12">
			        					<form action="{{isset($survey) ? '/updateSurvey/'.$survey->id : '/addSurveyStore' }}" method="POST">
		        						@csrf
			        						<div class="form-group">
			        							<label>Title</label>
			        							<input type="text" class="form-control" placeholder="Enter Title" name="name" value="{{isset($survey) ? $survey->name : '' }}">
			        						</div>

			        						<div class="form-group">
			        							<label>Question</label>
			        							<input type="text" class="form-control" placeholder="Enter Question" name="question" value="{{isset($survey) ? $survey->question : '' }}">
			        						</div>

			        						<div class="row">
			        							<div class="col-md-6">
			        								<div class="form-group">
					        							<label>Date End:</label>
					        							<div class="input-group date" id="end_date" data-target-input="nearest">
					        								<input type="text" name="end_date" class="form-control datetimepicker-input" data-target="#end_date" value="{{isset($survey) ? $survey->end_date : '' }}">
					        								<div class="input-group-append" data-target="#end_date" data-toggle="datetimepicker">
					        									<div class="input-group-text"><i class="fa fa-calendar"></i></div>
					        								</div>
					        							</div>
					        						</div>
			        							</div>
			        							<div class="offset-md-2 col-md-4">
			        								<div class="form-group">
					        							<label>Active?</label>
					        							<br>
			        									<input type="checkbox" class="form-control" name="active" 
			        									{{isset($survey) ? (($survey->active == 1) ? 'checked' : '' ) : 'checked' }} data-bootstrap-switch>
			        								</div>
			        							</div>
			        						</div>
			        						<br>
			        						<br>
			        						<h3>Choices</h3>

			        						<div class="row">
			        							<div class="col-md-6">
			        								<div id="answersSection">
			        									@if(isset($survey))
			        										@foreach($survey->choices as $choice)
			        											<input type="text" class="form-control" placeholder="Enter Answer" name="answers[]" value="{{$choice->choice}}"><br>
			        											<input type="hidden" name="survey_answer_id[]" value="{{$choice->id}}">
			        										@endforeach
			        									@endif
			        									<input type="text" class="form-control" placeholder="Add Choices" name="answers[]" value=""><br>
			        								</div>
			        								<button type="button" class="btn btn-secondary btn-sm" id="addText">Add Text</button>
			        							</div>
			        							<div class="col-md-6"></div>
			        						</div>
			        						

			        						<div>
		        								<button type="submit" class="btn btn-primary float-right">Save</button>
		        							</div>
	        							</form>

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
    <script src="{{asset('assets/custom/js/survey.js')}}"></script>
@endsection