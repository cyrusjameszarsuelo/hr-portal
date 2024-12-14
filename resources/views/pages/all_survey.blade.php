@extends('welcome')

@section('title', 'List of Survey')

@section('content')
<div class="container mt-5 mb-5">

	@if($user['contacts']['mail'] == 'tosma@megawide.com.ph' || $user['contacts']['mail'] == 'wmatias@megawide.com.ph' || $user['contacts']['mail'] == 'cjzarsuelo@megawide.com.ph')
	<a type="button" class="btn btn-primary fables-btn-rounded" href="{{url('/add-survey')}}">Add Survey</a>
	<br>
	<br>
	@endif

	<div class="row">

		@foreach($survey as $surveyData)
		<div class="col-12 col-sm-6 col-lg-4 fables-product-block">
			<div class="card rounded-0 mb-4">
				<div class="row">
					<div class="card-body col-12">
						<h5 class="card-title mx-xl-3">
							<a href="#" class="fables-main-text-color fables-store-product-title fables-second-hover-color">{{$surveyData->name}}</a>
						</h5>
						<p class="store-card-text fables-fifth-text-color font-15 mx-xl-3">{{$surveyData->question}}</p>
						@php 
							$countAll = 0;
						@endphp
						@foreach($resultChoices as $choice)

							@if($choice['title'] == '"'.$surveyData->name.'"')

							@php

							$jsImplode = '[';
					        foreach ($choice as $key => $result) {
					            $jsImplode .= '["'.$key.'", '.$result.'],';

					            if ($key != 'title' ) {
					            	$countAll += $result;
					            }
					        }
					        $jsImplode = substr($jsImplode, 0, -1);
					        $jsImplode .= ']';
					        @endphp

							<p class="font-15 font-weight-bold fables-second-text-color my-2 mx-xl-3">{{$countAll}} Total Answered </p>

							<p class="fables-product-info">
								<button  data-toggle="modal"  data-target="#surveyResultsModal" class="btn fables-second-border-color fables-second-text-color fables-btn-rouned fables-hover-btn-color font-14 p-2 px-2 px-xl-4" onclick="surveyResultsFunction('{{$jsImplode}}', '{{$surveyData->question}}', '{{$surveyData->name}}')">
								<span class="fables-btn-value">View Results</span></button>
								<br><br>

								@if($user['contacts']['mail'] == 'tosma@megawide.com.ph' || $user['contacts']['mail'] == 'wmatias@megawide.com.ph')


								<a href="/edit-survey/{{$surveyData->id}}" type="button"> <i class="fa-regular fa-pen-to-square"></i> Edit</a> |

								<a href="#" type="button" onclick="deleteSurvey({{$surveyData->id}})" data-toggle="modal" data-target="#deleteSurveyModal"> <i class="fa-regular fa-trash-can"></i> Delete</a>

								@endif
							</p>

							@endif
						@endforeach
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="surveyResultsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="surveyTitleModal">Survey Results</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div id="piechart"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
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

@section('scripts')
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script src="{{ asset('assets/custom/js/survey.js') }}"></script>
	{{-- @include('scripts/all_survey_scripts') --}}
@endsection