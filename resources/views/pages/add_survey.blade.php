@extends('welcome')

@section('title', 'Manage Survey')

@section('content')
	

  	<div class="container mt-5 mb-5">
        <div class="row">
        	<div class="col-md-12">
	        	<div class="card">
	        		<div class="card-header">
						Add Survey
					</div>
	        		<div class="card-body">
	        			<div class="row">

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
			        								<input type="date" name="end_date" class="form-control datetimepicker-input" data-target="#end_date" value="{{isset($survey) ? $survey->end_date : '' }}">
			        							</div>
			        						</div>
	        							</div>
	        							<div class="offset-md-2 col-md-4">
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
			        							
			        							
	        									{{-- <input type="checkbox" class="form-control" name="active" 
	        									{{isset($survey) ? (($survey->active == 1) ? 'checked' : '' ) : 'checked' }} > --}}
	        								</div>
	        							</div>
	        						</div>
	        						<br>
	        						<br>
	        						<span>Choices:</span>

	        						<div class="row">
	        							<div class="col-md-6">
	        								<div id="answersSection">
	        									@if(isset($survey))
	        										@foreach($survey->choices as $choice)
	        											<input type="text" class="form-control" placeholder="Enter Answer" name="answers[]" value="{{$choice->choice}}"><br>
	        											<input type="hidden" name="survey_answer_id[]" value="{{$choice->id}}">
	        										@endforeach
	        									@endif
	        									<div class="row">
		        									<div class="col-md-10">
		        										<input type="text" class="form-control" placeholder="Add Choices" name="answers[]">
		        									</div>
	        									</div>
	        									<br>
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

@endsection

@section('scripts')
	<script src="{{ asset('assets/custom/js/survey.js') }}"></script>
@endsection