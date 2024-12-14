@extends('welcome')

@section('title', 'Job Vacancies')

@section('content')

	<!-- Start page content --> 
	<div class="container">   
		<br>
		<center><h2>Job Vacancies</h2> </center>
		<hr style="width: 10%; border: solid 2px gray;">
        
        <h6>To refer a friend:</h6>
        <h6>(1) Refer to <a href="https://megawide.com.ph/about-us/careers/" target="_blank">External Job Openings</a></h6>
        <h6>(2) Read thru <a href="https://megawideph.sharepoint.com/:b:/s/HLD.HRPublic/EZ6KQ5HKP3NBl3r1sQoghFsBvy-b7jH_tvG7vYfZrghZyw" target="_blank">Employee Referral Program Guidelines</a></h6>
        <h6>(3) Fill out <a href="https://forms.office.com/r/aKMUfJCjmd" target="_blank">Referral Form</a></h6></h6>

        <br>
        <br>

        <h3><strong>Internal Vacancies</strong></h3>
        <br>
        <h6>To apply:</h6>
        <h6>(1) Discuss with Immediate Superior / Department Head</h6>
        <h6>(2) Submit CV and letter of intent acknowledged by Immediate Superior and/or Department Head to Home HR (Talent Acquisition Team)</h6>

        {{-- <h6>(3) Click link for the <a href="https://megawideph.sharepoint.com/:b:/s/HLD.HRPublic/EZ6KQ5HKP3NBl3r1sQoghFsBvy-b7jH_tvG7vYfZrghZyw" target="_blank">Employee Referral Program Guidelines</a></h6>
        <h6>(4) Click link to <a href="https://forms.office.com/r/aKMUfJCjmd" target="_blank">Refer A Friend</a></h6> --}}
        {{-- <h6>(3) Send your CV to <a href="mailto:hiring@megawide.com.ph">hiring@megawide.com.ph</a></h6> --}}
        
		<br>
		<br>

        @if($user['contacts']['mail'] == 'tosma@megawide.com.ph' || $user['contacts']['mail'] == 'wmatias@megawide.com.ph' || $user['contacts']['mail'] == 'cjzarsuelo@megawide.com.ph' || $user['contacts']['mail'] == 'jmsilvestre@megawide.com.ph' || $user['contacts']['mail'] == 'ktan@megawide.com.ph')

		<button class="btn btn-primary fables-btn-rounded btn-sm" type="button" data-toggle="modal" data-target="#exampleModal">Add Job</button>
		<br>
		<br>
        @endif


		<div class="row">

			@foreach($jobVacancies as $jobVacanciesData)
		    <div class="col-4">
		        <div class="position-relative mb-4"> 
		            <a data-fancybox="job-vacancies" id="job-vacancies" href="{{asset($jobVacanciesData->image)}}" >
		                <div class="image-container position-relative">
		                    <img src="{{asset($jobVacanciesData->image)}}" alt="" class="w-100">
		                </div>
		                
		            </a>
                    @if($user['contacts']['mail'] == 'tosma@megawide.com.ph' || $user['contacts']['mail'] == 'wmatias@megawide.com.ph' || $user['contacts']['mail'] == 'cjzarsuelo@megawide.com.ph' || $user['contacts']['mail'] == 'jmsilvestre@megawide.com.ph' || $user['contacts']['mail'] == 'ktan@megawide.com.ph')
                        <center>
                            <a class="btn fables-second-text-color underline fables-main-hover-text-color p-0 fables-main-hover-color" type="button" data-toggle="modal" data-target="#deleteAnnouncementModel" onclick ="deleteJobVacancies('{{ $jobVacanciesData->title }}', {{ $jobVacanciesData->id }})">Delete </a>
                        </center>
                    @endif
		        </div>
		    </div>
		    @endforeach
		</div>
	</div>
	<!-- /End page content -->

	<!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Job</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/addJob" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputFile">File input</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" placeholder="Enter Title" name="title" value="">
                            </div>
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

    <div class="modal fade" id="deleteAnnouncementModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content ">
                <div class="modal-header bg-danger justify-content-center">
                    <h5 class="modal-title text-white " id="exampleModalLongTitle"><i class="fa-solid fa-triangle-exclamation fa-lg "></i> Are you sure to delete this <span id="deleteName"></span>?</h5>
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
    <script src="{{URL::asset('assets/custom/js/job_vacancies.js')}}"></script>
@endsection