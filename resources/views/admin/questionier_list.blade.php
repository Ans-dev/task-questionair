@extends('layouts.default')

@section('content')

<div class="row">
	<div class="col-md-2">
		<h1>Questionairs</h1>
	</div>
	<div class="col-md-2">
		
	</div>
	<div class="col-md-8" style="padding-top: 5px;">
		<button type="button" class="btn btn-outline-success">
			<a style="text-decoration: none;color: black;" href="{{route('questioniers.create')}}">
				Create New
			</a>
		</button>
	</div>
	
</div>

<table class="table" style="margin-top: 30px;">
	<thead>
		<tr>
			<th scope="col">Id</th>
			<th scope="col">Name</th>
			<th scope="col">Number of Questions</th>
			<th scope="col">Duration</th>
			<th scope="col">Resumeable</th>
			<th scope="col">Published</th>
			<th scope="col">Actions</th>
		</tr>
	</thead>
	<tbody>
		@foreach($questionairs as $questionair)
		<tr>
			<th scope="row">{{$questionair->id}}</th>
			<td>{{$questionair->name}}</td>
			<td>
				{{$questionair->Questions->count()}} | 
				<a class="this_a_links" href="{{route('create-question',$questionair->id)}}">Add</a>
			</td>
			<td>{{$questionair->duration}}</td>
			<td>{{$questionair->resumeable?'Yes':'No'}}</td>
			<td>{{$questionair->published?'Yes':'No'}}</td>
			<td>
				<a class="this_a_links" href="{{route('questioniers.edit',$questionair)}}">Edit</a> |
				
				{!! Form::open(['method'=>'Delete','route'=>['questioniers.destroy',$questionair],'class' => 'delForm','style'=>'display:inline','onsubmit' => 'return confirm("are you sure ?")']) !!}
				<a class="this_a_links del_submit" href="javascript:void()">Delete</a>
				{!!Form::close()!!}

			</td>
		</tr>
		@endforeach
	</tbody>
</table>

@endsection

@section('internal_scripts')
<script type="text/javascript">
	$(function(){
		$('.del_submit').click(function(e){
			e.preventDefault();
			$(this).closest('.delForm').submit();
		});
	})
</script>

@endsection