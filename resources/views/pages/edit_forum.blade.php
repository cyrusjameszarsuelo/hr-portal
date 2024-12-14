@extends('welcome')

@section('title', 'Forum')

@section('content')

	<div class="container mt-5 mb-5">
		<form action="/updateForum/{{$timeline->id}}" method="POST">
		@csrf
		{{ method_field('PUT') }}
		<div class="card">
			<div class="card-header">
				Edit Forum ID: {{$timeline->id}}
			</div>
			<div class="card-body">
				<div class="container">
					<div class="row">
			            <div class="col-md-12">
			                <div class="form-group">
			                    <label for="exampleInputEmail1">Title <span style="color: red;">*</span></label>
			                    <input type="text" class="form-control" id="title" placeholder="Enter Title" name="title" required value="{{$timeline->title}}">
			                </div>
			            </div>
			        </div>

			        <div class="form-group">
			            <label for="exampleFormControlTextarea1">Content <span style="color: red;">*</span></label>
			            <textarea class="form-control " rows="6" name="post" required >{{$timeline->post}}</textarea>
			        </div>
		        </div>
	        </div>

	        <div class="card-footer">
	        	<button class="btn btn-primary btn-block">Save</button>
	        </div>

		</div>
		</form>
	</div>

@endsection

