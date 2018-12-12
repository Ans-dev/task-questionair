@extends('layouts.default')

@section('content')
<div style="margin-left:60px;margin-top: 40px; ">
	<h1>Create</h1>
</div>
<div class="row">
	<div class="col-md-2">

		
	</div>
	<div class="col-md-6">
		<form role="form"  method="POST" action="{{route('questioniers.store')}}">
			@csrf
			<div class="form-group row">
				<label for="name" class="col-sm-3 col-form-label">Questionair Name:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="name" name="name">
				</div>
			</div>
			<div class="form-group row">
				<label for="duration" class="col-sm-3 col-form-label">Duration:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="duration" name="duration">
				</div>
			</div>
			<div class="form-group row">
				<label for="resumeable" class="col-sm-4 col-form-label">Can Resume?</label>
				<div class="col-sm-1">
					<input type="radio" class="form-check-input" name="resumeable" value="1" checked="checked" > Yes
				</div>
				<div class="col-sm-7">
					<input type="radio" class="form-check-input" name="resumeable" value="0"> No
				</div>
			</div>
			<div class="form-group row">
				<label for="resumeable" class="col-sm-4 col-form-label">Published?</label>
				<div class="col-sm-1">
					<input type="radio" class="form-check-input" name="published" value="1" checked="checked" > Yes
				</div>
				<div class="col-sm-7">
					<input type="radio" class="form-check-input" name="published" value="0"> No
				</div>
			</div>
			<div class="form-group row" style="margin-top: 20px;">
				<div class="col-sm-3">
					
				</div>
				<div class="col-sm-9">
					<button type="submit" class="btn btn-lg btn-outline-success">Save</button>
				</div>
			</div>
		</form>
	</div>
	<div class="col-md-4">
		
	</div>
	
</div>
@endsection

@section('internal_scripts')
<script type="text/javascript">
	$(function(){
		$( "#duration" ).timepicker();
	})
</script>

@endsection