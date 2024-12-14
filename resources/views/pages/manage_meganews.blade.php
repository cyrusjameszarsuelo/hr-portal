@extends('welcome')

@section('title', 'Meganews')

@section('content')

	<div class="container mt-5 mb-5">
		<form action="/updateMeganews/{{$meganews->id}}" method="POST">
		@csrf
		{{ method_field('PUT') }}
		<div class="card">
			<div class="card-header">
				Edit Meganews ID: {{$meganews->id}}
			</div>
			<div class="card-body">
				<div class="container">
					<div class="row">
			            <div class="col-md-12">
			                <div class="form-group">
			                    <label for="exampleInputEmail1">Title <span style="color: red;">*</span></label>
			                    <input type="text" class="form-control" id="title" placeholder="Enter Title" name="title" required value="{{$meganews->title}}">
			                </div>
			            </div>
			        </div>

			        <div class="row">
			            <div class="col-md-12">
			                <div class="form-group">
			                    <label for="exampleInputEmail1">Quote </label>
			                    <input type="text" class="form-control" id="quote" placeholder="Enter Quote" name="quote" value="{{$meganews->quote}}">
			                </div>
			            </div>


			            <div class="col-md-12">
			                <div class="form-group">
			                    <label for="exampleInputEmail1">Quote 2 </label>
			                    <input type="text" class="form-control" id="quote2" placeholder="Enter Quote 2" name="quote2" value="{{$meganews->quote2}}">
			                </div>
			            </div>
			        </div>

			        <div class="row">
			            <div class="col-md-12">
			                <div class="form-group">
			                    <label for="exampleInputFile">Image</label>
			                    <input type="file" multiple class="form-control" id="image" name="image[]" >
			                </div>
			            </div>
			        </div>

			        <div class="row">
			            <div class="col-md-12">
			                <div class="form-group">
			                    <label for="exampleInputEmail1">Image Title <span style="color: red;">*</span></label>
			                    <input type="text" class="form-control" id="image_title" placeholder="Enter Image Title" name="image_title" required value="{{$meganews->image_title}}">
			                </div>
			            </div>
			        </div>
			        
			        <div class="form-group">
			            <label for="exampleFormControlTextarea1">Content <span style="color: red;">*</span></label>
			            <textarea class="form-control " id="contentKey1" rows="6" name="content" required >{{$meganews->content}}</textarea>
			        </div>

			        <div class="form-group">
			            <label for="exampleFormControlTextarea1">Content 2</label>
			            <textarea class="form-control " id="contentKey2" rows="6" name="content2" >{{$meganews->content2}}</textarea>
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