<form method="POST" v-on:submit.prevent="createRecord">	
	<div class="modal fade" id="create">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">New Record</h4>
	      </div>
	      <div class="modal-body">
	      	<div class="form-group">
	      		<label for="record">UUID</label>
	        	<input type="text" name="uuid" class="form-control" v-model="fillRecord.uuid">
	      	</div>
	      	<div class="form-group">
	      		<label for="record">Name</label>
	        	<input type="text" name="name" class="form-control" v-model="fillRecord.name">
	      	</div>
	      	<div class="form-group">
	      		<label for="record">Description</label>
	        	<input type="text" name="description" class="form-control" v-model="fillRecord.description">
	      	</div>
	      	<div class="form-group">
	      		<label for="record">Code</label>
	        	<input type="text" name="code" class="form-control" v-model="fillRecord.code">
	      	</div>
	      	<div class="form-group">
	      		<label for="record">Status</label>
	        	<select name="status" class="form-control" :required="true" v-model="fillRecord.status">
			  		<option v-for="option in options" v-bind:value="option" :selected="option == 'inactive'">@{{ option }}</option>
			</select>
	      	</div>
	      	<div class="form-group"></div>
	        
	        
	        <span v-for="error in errors" class="text-danger">@{{ error }}</span>
	      </div>
	     
	      <div class="modal-footer">
	        <input type="submit" class="btn btn-primary mysave" value="Save">
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</form>
