@extends('welcome')

@section('title', 'Company Events')

@section('content')

	<!-- Start page content --> 
	<div class="container"> 
		<br>
		<center> <h2>List of Company Events for Year {{ now()->year }}</h2> </center>
		<hr style="width: 10%; border: solid 2px gray;">  
		<div class="d-flex align-items-center justify-content-between">
			<button class="btn btn-primary fables-btn-rounded" id="addCompanyEvents" type="button" data-toggle="modal" data-target="#addCompanyEventsModal" onclick='document.getElementById("editForm").reset();'>Add Company Events</button>
			<a href="/holidays" class="btn btn-secondary fables-btn-rounded">Check Holidays of {{ now()->year }}</a>
		</div>
		<br>
		<br>
		<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
			
			@php
				$month = [];

				for ($m=1; $m<=12; $m++) {
				     $month[] = date('F', mktime(0,0,0,$m, 1, date('Y')));
				}

			@endphp

			@for($i = 0; $i < count($month) ; $i++)
				

				<li class="nav-item">
					<a class="nav-link {{ $i == 0 ? 'active' : '' }}" id="pills-{{$month[$i]}}-tab" data-toggle="pill" href="#pills-{{$month[$i]}}" role="tab" aria-controls="pills-{{$month[$i]}}" aria-selected="true">{{$month[$i]}}</a>
				</li>
			@endfor

		</ul>
		<div class="tab-content" id="pills-tabContent">

			@for($i = 0; $i < count($month) ; $i++)

				<div class="tab-pane fade {{ $i == 0 ? ' show active' : '' }}" id="pills-{{$month[$i]}}" role="tabpanel" aria-labelledby="pills-{{$month[$i]}}-tab">

					<div id="cd-timeline" class="blog-timeline">
					<span class="fables-second-background-color line"></span>

					@foreach($companyEvents as $companyEventsData)

					@if( \Carbon\Carbon::parse($companyEventsData->event_date)->format('F')  == $month[$i])
					<div class="cd-timeline-block"> 
						<div class="cd-timeline-img fables-second-background-color"></div>   
						<span class="cd-date fables-light-background-color fables-fifth-text-color">
							{{ \Carbon\Carbon::parse($companyEventsData->event_date)->format('l') }} <br>
							{{ \Carbon\Carbon::parse($companyEventsData->event_date)->format('M d, Y') }}</span>
						<div class="cd-timeline-content mb-4"> 
							<div class="row">
								{{-- <div class="col-12 col-lg-5">
									<div class="image-container translate-effect-right">
										<a href="#"><img src="{{asset($companyEventsData->image != null ? '/img/events/'.$companyEventsData->image : '/img/events/default-blog-image.jpg') }}" alt="" ></a>
									</div>

								</div> --}}
								<div class="col-12 col-lg-12 m-3 mt-lg-0">

									<h2 class="font-22 semi-font mb-2 mt-4"><a href="#" class="fables-main-text-color fables-second-hover-color">{{$companyEventsData->events}}</a></h2> 
									<p class="fables-forth-text-color mb-2">
										{{$companyEventsData->description}}
									</p>
									{{-- <a href="" class="fables-main-text-color p-0 underline fables-second-hover-color font-15">Read More</a> |  --}}
									<a href="" type="button" onclick="editCompanyEvents({{$companyEventsData->id}}, '{{$companyEventsData->events}}', '{{$companyEventsData->description}}', '{{ \Carbon\Carbon::parse($companyEventsData->event_date)->format('Y-m-d') }}')" data-toggle="modal" data-target="#addCompanyEventsModal" class="fables-main-text-color p-0 underline fables-second-hover-color font-15">Edit</a>  |
									<a href="" type="button" onclick="deleteEvent({{$companyEventsData->id}})" data-toggle="modal" data-target="#deleteEventModal" class="fables-main-text-color p-0 underline fables-second-hover-color font-15">Delete</a> 
								</div>
							</div> 
						</div>   
					</div> 
					@endif
					@endforeach

					</div>
				</div>
			@endfor

		</div>

	</div>
	<!-- /End page content -->

	<!-- Modal -->
    <div class="modal fade" id="addCompanyEventsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add to Company Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/storeCompanyEvents" method="POST" enctype="multipart/form-data" id="editForm">
                @csrf
                <div class="modal-body">
                    <div class="container-fluid">
                        <label class="font-11" for="">Required (<span style="color: red;">*</span>)</label>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Event <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" id="events" placeholder="Enter Title" required name="events">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Event Date <span style="color: red;">*</span></label>
                                    <input type="date" class="form-control" id="event_date" placeholder="Enter Title" required name="event_date" >
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputFile">Image</label>
                                    <input type="file" class="form-control" id="exampleInputFile" name="image">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea class="form-control" id="description" rows="3" name="description"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteEventModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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
    <script src="{{asset('assets/custom/js/company_events.js')}}"></script>
@endsection