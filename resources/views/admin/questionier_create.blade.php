@extends('layouts.default')

@section('content')
<div style="margin-left:60px;margin-top: 40px; ">
	<h1>Create</h1>
</div>
<div class="row">
	<div class="col-md-2">

		
	</div>
	@if($data['form'] == 'edit')
	@php
    $questionier = $data['questionier'];
	@endphp
	@endif
	<div class="col-md-6">
		<form role="form"  method="POST" action="{{($data['form']=='edit')?route('questioniers.update',$data['questionier']->id):route('questioniers.store')}}">
			@csrf
			@if($data['form']=='edit')
			{{ method_field('PATCH') }}
			@endif
			<div class="form-group row">
				<label for="name" class="col-sm-3 col-form-label">Questionair Name:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="name" name="name" value="{{isset($questionier->name)?$questionier->name:''}}">
				</div>
			</div>
			<div class="form-group row">
				<label for="duration" class="col-sm-3 col-form-label">Duration:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="duration" name="duration" value="{{isset($questionier->duration)?$questionier->duration:''}}">
				</div>
			</div>
			<div class="form-group row">
				<label for="resumeable" class="col-sm-4 col-form-label">Can Resume?</label>
				<div class="col-sm-1">
					@if($data['form']=='create')
					<input type="radio" class="form-check-input" name="resumeable" value="1" checked="checked" > Yes
					@else
					<input type="radio" class="form-check-input" name="resumeable" value="1" {{(isset($questionier->resumeable) && $questionier->resumeable)?'checked':''}} > Yes
					@endif
				</div>
				<div class="col-sm-7">
					<input type="radio" class="form-check-input" name="resumeable" value="0" {{(isset($questionier->resumeable) && !$questionier->resumeable)?'checked':''}}> No
				</div>
			</div>
			<div class="form-group row">
				<label for="resumeable" class="col-sm-4 col-form-label">Published?</label>
				<div class="col-sm-1">
					@if($data['form']=='create')
					<input type="radio" class="form-check-input" name="published" value="1" checked="checked" > Yes
					@else
                    <input type="radio" class="form-check-input" name="published" value="1" checked="checked" {{(isset($questionier->published) && $questionier->published)?'checked':''}}> Yes
					@endif
				</div>
				<div class="col-sm-7">
					<input type="radio" class="form-check-input" name="published" value="0" {{(isset($questionier->published) && !$questionier->published)?'checked':''}}> No
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