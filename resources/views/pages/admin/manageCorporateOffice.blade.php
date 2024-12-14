@extends('manageSiteTemplate')


@section('content')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0">Manage Corporate Office</h1>
					</div><!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="/main">Home</a></li>
							<li class="breadcrumb-item "><a href="/main/view-all-corporateoffice">Corporate Office</a></li>
							<li class="breadcrumb-item active">Manage Corporate Office</li>
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
			        				<i class="fa fa-newspaper"></i>
			        				Corporate Office
			        			</h3>
			        		</div>
			        		<div class="card-body">
			        			<form method="POST" action="{{url( $corporateOffice ? '/manageCorporateoffice/' . $corporateOffice->id : '/manageCorporateoffice' )}}" enctype="multipart/form-data" >
			        				{{ $corporateOffice ? method_field('PUT') : '' }}
			        				@csrf
			        			<div class="row">
			        				<div class="col-md-6">
			        					<div class="form-group">
			        						<label for="organizational_structure">Organizational Structure</label>
			        						<div class="input-group">
			        							<div class="custom-file">
			        								<input type="file" class="custom-file-input" id="organizational_structure" name="organizational_structure" accept="image/*">
			        								<label class="custom-file-label" for="organizational_structure">
			        									{{$corporateOffice ? $corporateOffice->organizational_structure : 'Choose File'}}
			        									
			        								</label>
			        							</div>
			        						</div>
			        					</div>
				        			</div>

				        			<div class="col-md-6">
	        							<div class="form-group">
		        							<label>Department</label>
		        							<select name="department" id="department" class="form-control" required>
		        								<option {{$corporateOffice ? ($corporateOffice->department == 'Business Devt' ? 'selected' : '') : ''}} value="Business Devt">Business Dev't</option>
		        								<option {{$corporateOffice ? ($corporateOffice->department == 'CCAB' ? 'selected' : '') : ''}} value="CCAB">CCAB</option>
		        								<option {{$corporateOffice ? ($corporateOffice->department == 'Foundation' ? 'selected' : '') : ''}} value="Foundation">Foundation</option>
		        								<option {{$corporateOffice ? ($corporateOffice->department == 'Finance' ? 'selected' : '') : ''}} value="Finance">Finance</option>
		        								<option {{$corporateOffice ? ($corporateOffice->department == 'HR' ? 'selected' : '') : ''}} value="HR">HR</option>
		        								<option {{$corporateOffice ? ($corporateOffice->department == 'Internal Audit' ? 'selected' : '') : ''}} value="Internal Audit">Internal Audit</option>
		        								<option {{$corporateOffice ? ($corporateOffice->department == 'IT' ? 'selected' : '') : ''}} value="IT">IT</option>
		        								<option {{$corporateOffice ? ($corporateOffice->department == 'Legal' ? 'selected' : '') : ''}} value="Legal">Legal</option>
		        								<option {{$corporateOffice ? ($corporateOffice->department == 'OCEO' ? 'selected' : '') : ''}} value="OCEO">OCEO</option>
		        							</select>
		        						</div>
		        					</div>

			        				<div class="col-md-12">
	        							<div class="form-group">
		        							<label>Manual Link</label>
		        							<input type="text" class="form-control" placeholder="Enter Title" name="manuals_link" value="{{$corporateOffice ? $corporateOffice->manuals_link : ''}}" required>
		        						</div>
		        					</div>

			        				<div class="col-md-12">
		        						<div class="form-group">
		        							<label>Policy Link</label>
		        							<input type="text" class="form-control" placeholder="Enter Title" name="policies_link" value="{{$corporateOffice ? $corporateOffice->policies_link : ''}}" required>
		        						</div>
		        					</div>

	        							<button type="submit" class="btn btn-primary">Save</button>
			        				</div>
			        			</form>
			        		</div>
			        	</div>
			        </div>
		        </div>
		    </div>
		</section>
	</div>
@endsection

@section('extendedScript')
	<script src="{{asset('js/manageMegaGoodVibes.js')}}"></script>
@endsection