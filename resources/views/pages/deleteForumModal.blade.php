<div class="modal fade" id="deleteForumModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content ">
			<div class="modal-header bg-danger justify-content-center">
				<h5 class="modal-title text-white " id="exampleModalLongTitle"><i class="fa-solid fa-triangle-exclamation fa-lg "></i> Are you sure to delete this?</h5>
			</div>
			<form method="POST" id="deleteFormForum">
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