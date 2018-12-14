@extends('layouts.default')

@section('content')
<div style="margin: 50px 0px 40px 50px; ">
	<h1>Add Questions</h1>
</div>
<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-10">
		<form id="qcf" role="form" method="POST" action="{{route('store-question')}}">
			@csrf
			<input class="hide" type="text" name="questionair_id" value="{{$data['questionair_id']}}">
			@if(!$data['questions']->count())
			<div class="main-parent">
				<div class="parent">
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Question Type:</label>
						<div class="col-sm-7">
							<select class="form-control type-dropdown" name="type[]"> 
								<option value="text">Text</option>
								<option value="single option">Multiple Choice(Single Option)</option>
								<option value="multi option">Multiple Choice(Multiple Option)</option>
							</select>
						</div>
						<div class="col-sm-2"></div>
					</div>
				</div>
				<div class="parent-2">
					<div>
						<div class="form-group row"> 
							<label class="col-sm-3 col-form-label">Question:</label>
							<div class="col-sm-7">
								<input type="text" class="form-control ques-text" name="question[]">
							</div>
							<div class="col-sm-2">
								<a href="javascript:void(0)" class="push-right delete-question">Delete Question</a>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Answer:</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" name="answer[]">
							</div>
							<div class="col-sm-2"></div>
						</div>	
					</div>
				</div>
			</div>
			@elseif($data['questions']->count() > 0)
			@foreach($data['questions'] as $index=>$question)
			@if($question->type == 'text')
			<div class="main-parent">
				@if($index > 0)
				<hr />
				@endif
				<div class="parent">
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Question Type:</label>
						<div class="col-sm-7">
							<select class="form-control type-dropdown" name="type[]"> 
								<option value="text" selected="">Text</option>
								<option value="single option">Multiple Choice(Single Option)</option>
								<option value="multi option">Multiple Choice(Multiple Option)</option>
							</select>
						</div>
						<div class="col-sm-2"></div>
					</div>
				</div>
				<div class="parent-2">
					<div>
						<div class="form-group row"> 
							<label class="col-sm-3 col-form-label">Question:</label>
							<div class="col-sm-7">
								<input type="text" class="form-control ques-text" name="question[]" value="{{$question->question}}">
							</div>
							<div class="col-sm-2">
								<a href="javascript:void(0)" class="push-right delete-question">Delete Question</a>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Answer:</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" name="answer[]" value="{{$question->answer}}">
							</div>
							<div class="col-sm-2"></div>
						</div>	
					</div>
				</div>
			</div>
			@elseif($question->type == 'single option')
			<div class="main-parent">
				@if($index > 0)
				<hr />
				@endif
				<div class="parent">
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Question Type:</label>
						<div class="col-sm-7">
							<select class="form-control type-dropdown" name="type[]"> 
								<option value="text">Text</option>
								<option value="single option" selected="">Multiple Choice(Single Option)</option>
								<option value="multi option">Multiple Choice(Multiple Option)</option>
							</select>
						</div>
						<div class="col-sm-2"></div>
					</div>
				</div>
				<div class="parent-2">
					<div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Question:</label>
							<div class="col-sm-7">
								<input type="text" class="form-control ques-text" name="question[]" value="{{$question->question}}">
								<input type="text" class="form-control hide" name="answer[]">
							</div>
							<div class="col-sm-2">
								<a href="javascript:void(0)" class="push-right delete-question">Delete Question</a>
							</div>
						</div>
						@php 
						$name_choices = str_replace(' ', '_',$question->question).'[]';
						$name_correct_choices = str_replace(' ', '_',$question->question).'_correct[]';
						@endphp
						@foreach($question->Choices as $index=>$choice)
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Choice {{$index + 1}}:</label>
							<div class="col-sm-7">
								<input type="text" class="q2_choices form-control" name="{{$name_choices}}" value="{{$choice->choice}}">
							</div>
							<div class="col-sm-2">
								<input type="radio" class="q_choices" name="{{$name_correct_choices}}" {{ $choice->correct ? 'checked' : '' }} value="{{$choice->choice}}">Correct ? 
								<a href="javascript:void(0)" class="delete-choice">
								Delete Choice</a>
							</div>
						</div>
						@endforeach	
						<!-- Choice Template -->
						<div class="form-group row hide choice-template">
							<label class="col-sm-3 col-form-label opt-label"></label>
							<div class="col-sm-7">
								<input type="text" class="q2_choices form-control t-make-opt">
							</div>
							<div class="col-sm-2">
								<input type="radio" class="q_choices make-correct" >Correct ? <a href="javascript:void(0)" class="delete-choice">
								Delete Choice</a>
							</div>
						</div>
						<!-- -->
						<a href="javascript:void(0)" class="add-choice">Add Choice</a>	
					</div>
				</div>
			</div>
			@elseif($question->type == 'multi option')
			<div class="main-parent">
				@if($index > 0)
				<hr />
				@endif
				<div class="parent">
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Question Type:</label>
						<div class="col-sm-7">
							<select class="form-control type-dropdown" name="type[]"> 
								<option value="text">Text</option>
								<option value="single option">Multiple Choice(Single Option)</option>
								<option value="multi option" selected="">Multiple Choice(Multiple Option)</option>
							</select>
						</div>
						<div class="col-sm-2"></div>
					</div>
				</div>
				<div class="parent-2">
					<div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Question:</label>
							<div class="col-sm-7">
								<input type="text" class="form-control ques-text" name="question[]" value="{{$question->question}}">
								<input type="text" class="form-control hide" name="answer[]">
							</div>
							<div class="col-sm-2">
								<a href="javascript:void(0)" class="push-right delete-question">Delete Question</a>
							</div>
						</div>
						@php 
						$name_choices = str_replace(' ', '_',$question->question).'[]';
						$name_correct_choices = str_replace(' ', '_',$question->question).'_correct[]';
						@endphp
						@foreach($question->Choices as $index=>$choice)
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Choice {{$index + 1}}:</label>
							<div class="col-sm-7">
								<input type="text" class="q2_choices form-control" name="{{$name_choices}}" value="{{$choice->choice}}">
							</div>
							<div class="col-sm-2">
								<input type="checkbox" class="q_choices" name="{{$name_correct_choices}}" {{ $choice->correct ? 'checked' : '' }} value="{{$choice->choice}}">Correct ? 
								<a href="javascript:void(0)" class="delete-choice">
								Delete Choice</a>
							</div>
						</div>
						@endforeach	
						<!-- Choice Template -->
						<div class="form-group row hide choice-template-2">
							<label class="col-sm-3 col-form-label opt-label"></label>
							<div class="col-sm-7">
								<input type="text" class="q2_choices form-control t-make-opt">
							</div>
							<div class="col-sm-2">
								<input type="checkbox" class="q_choices make-correct" >Correct ? <a href="javascript:void(0)" class="delete-choice">
								Delete Choice</a>
							</div>
						</div>
						<!-- -->
						<a href="javascript:void(0)" class="add-choice-2">Add Choice</a>	
					</div>
				</div>
			</div>
			@endif
			@endforeach
			@endif
			<!-- New Question Template-->
			<div id="new-question-template" class="main-parent hide">
				<hr>
				<div class="parent">
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Question Type:</label>
						<div class="col-sm-7">
							<select class="form-control type-dropdown"> 
								<option value="text">Text</option>
								<option value="single option">Multiple Choice(Single Option)</option>
								<option value="multi option">Multiple Choice(Multiple Option)</option>
							</select>
						</div>
						<div class="col-sm-2"></div>
					</div>
				</div>
				<div class="parent-2">
					<div>
						<div class="form-group row"> 
							<label class="col-sm-3 col-form-label">Question:</label>
							<div class="col-sm-7">
								<input type="text" class="form-control ques-text make-question">
							</div>
							<div class="col-sm-2">
								<a href="javascript:void(0)" class="delete-question">Delete Question</a>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Answer:</label>
							<div class="col-sm-7">
								<input type="text" class="form-control make-answer">
							</div>
							<div class="col-sm-2"></div>
						</div>	
					</div>
				</div>
			</div>

			<hr>
			<div style="margin-top: 60px;">
				<a href="javascript:void(0)" id="add-new-question">Add New Question</a>
			</div>

			<div style="margin-top: 60px;">
				<button type="submit" class="btn btn-lg btn-outline-success">Save Questions</button>
			</div>

		</form>
	</div>

	<!-- Question Types Templates -->
	<div id="text-type-q-template" class="hide">
		<div class="form-group row">
			<label class="col-sm-3 col-form-label">Question:</label>
			<div class="col-sm-7">
				<input type="text" class="form-control ques-text make-question">
			</div>
			<div class="col-sm-2">
				<a href="javascript:void(0)" class="delete-question">Delete Question</a>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-3 col-form-label">Answer:</label>
			<div class="col-sm-7">
				<input type="text" class="form-control make-answer">
			</div>
			<div class="col-sm-2"></div>
		</div>	
	</div>
	<!-- -->
	<div id="single-opt-template" class="hide">
		<div class="form-group row">
			<label class="col-sm-3 col-form-label">Question:</label>
			<div class="col-sm-7">
				<input type="text" class="form-control ques-text make-question">
				<input type="text" class="form-control make-answer hide">
			</div>
			<div class="col-sm-2">
				<a href="javascript:void(0)" class="delete-question">Delete Question</a>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-3 col-form-label">Choice 1:</label>
			<div class="col-sm-7">
				<input type="text" class="q2_choices form-control make-opt">
			</div>
			<div class="col-sm-2">
				<input type="radio" class="q_choices make-correct" >Correct ? <a href="javascript:void(0)" class="delete-choice">
				Delete Choice</a>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-3 col-form-label">Choice 2:</label>
			<div class="col-sm-7">
				<input type="text" class="q2_choices form-control make-opt">
			</div>
			<div class="col-sm-2">
				<input type="radio" class="q_choices make-correct" >Correct ? <a href="javascript:void(0)" class="delete-choice">
				Delete Choice</a>
			</div>
		</div>	
		<div class="form-group row">
			<label class="col-sm-3 col-form-label">Choice 3:</label>
			<div class="col-sm-7">
				<input type="text" class="q2_choices form-control make-opt">
			</div>
			<div class="col-sm-2">
				<input type="radio" class="q_choices make-correct" >Correct ? <a href="javascript:void(0)" class="delete-choice">
				Delete Choice</a>
			</div>
		</div>
		<!-- Choice Template -->
		<div class="form-group row hide choice-template">
			<label class="col-sm-3 col-form-label opt-label"></label>
			<div class="col-sm-7">
				<input type="text" class="q2_choices form-control t-make-opt">
			</div>
			<div class="col-sm-2">
				<input type="radio" class="q_choices make-correct" >Correct ? <a href="javascript:void(0)" class="delete-choice">
				Delete Choice</a>
			</div>
		</div>
		<!-- -->
		<a href="javascript:void(0)" class="add-choice">Add Choice</a>	
	</div>
	<!-- -->
	<div id="multi-opt-template" class="hide">
		<div class="form-group row">
			<label class="col-sm-3 col-form-label">Question:</label>
			<div class="col-sm-7">
				<input type="text" class="form-control ques-text make-question">
				<input type="text" class="form-control make-answer hide">
			</div>
			<div class="col-sm-2">
				<a href="javascript:void(0)" class="delete-question">Delete Question</a>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-3 col-form-label">Choice 1:</label>
			<div class="col-sm-7">
				<input type="text" class="q2_choices form-control make-opt">
			</div>
			<div class="col-sm-2">
				<input type="checkbox" class="q_choices make-correct" >Correct ? <a href="javascript:void(0)" class="delete-choice">
				Delete Choice</a>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-3 col-form-label">Choice 2:</label>
			<div class="col-sm-7">
				<input type="text" class="q2_choices form-control make-opt">
			</div>
			<div class="col-sm-2">
				<input type="checkbox" class="q_choices make-correct" >Correct ? <a href="javascript:void(0)" class="delete-choice">
				Delete Choice</a>
			</div>
		</div>	
		<div class="form-group row">
			<label class="col-sm-3 col-form-label">Choice 3:</label>
			<div class="col-sm-7">
				<input type="text" class="q2_choices form-control make-opt">
			</div>
			<div class="col-sm-2">
				<input type="checkbox" class="q_choices make-correct" >Correct ? <a href="javascript:void(0)" class="delete-choice">
				Delete Choice</a>
			</div>
		</div>
		<!-- Choice Template -->
		<div class="form-group row hide choice-template-2">
			<label class="col-sm-3 col-form-label opt-label"></label>
			<div class="col-sm-7">
				<input type="text" class="q2_choices form-control t-make-opt">
			</div>
			<div class="col-sm-2">
				<input type="checkbox" class="q_choices make-correct" >Correct ? <a href="javascript:void(0)" class="delete-choice">
				Delete Choice</a>
			</div>
		</div>
		<!-- -->
		<a href="javascript:void(0)" class="add-choice-2">Add Choice</a>			
	</div>

</div>
@endsection

@section('internal_scripts')
<script type="text/javascript">

	$(function(){
		$('#qcf').on('change','.type-dropdown',function(){
			var type = $(this).val(); 
			if(type == 'text'){

				var $parent = $(this).closest('.main-parent').find('.parent-2');
				$parent.empty();
				var $template = $('#text-type-q-template');
				var $clone = $template
				.clone()
				.removeClass('hide')
				.removeAttr('id');

				$clone.find('.make-question').attr('name','question[]').removeClass('make-question');
				$clone.find('.make-answer').attr('name','answer[]').removeClass('make-answer');

				$parent.append($clone);



			}else if(type == 'single option'){
				var $parent = $(this).closest('.main-parent').find('.parent-2');
				$parent.empty();
				var $template = $('#single-opt-template');
				var $clone = $template
				.clone()
				.removeClass('hide')
				.removeAttr('id');

				$clone.find('.make-question').attr('name','question[]').removeClass('make-question');
				$clone.find('.make-opt').attr('name',Math.random()+'_choices[]').removeClass('make-opt');
				$clone.find('.make-correct').attr('name',Math.random()+'_correct[]').removeClass('make-correct');
				$clone.find('.make-answer').attr('name','answer[]').removeClass('make-answer');

				$parent.append($clone);




			}else if(type == 'multi option'){

				var $parent = $(this).closest('.main-parent').find('.parent-2');
				$parent.empty();
				var $template = $('#multi-opt-template');
				var $clone = $template
				.clone()
				.removeClass('hide')
				.removeAttr('id');

				$clone.find('.make-question').attr('name','question[]').removeClass('make-question');
				$clone.find('.make-opt').attr('name',Math.random()+'_choices[]').removeClass('make-opt');
				$clone.find('.make-correct').attr('name',Math.random()+'_correct[]').removeClass('make-correct');
				$clone.find('.make-answer').attr('name','answer[]').removeClass('make-answer');

				$parent.append($clone);

			}
		});

		$("#qcf").on('click','.q_choices',function(){
			var $choice = $(this).closest('.form-group').find('input:eq(0)').val();
			$(this).val($choice);
		});

		$("#qcf").on('click','.add-choice',function(e){
			e.preventDefault();
			var $template = $(this).closest('.parent-2').find('.choice-template');
			$clone    = $template
			.clone()
			.removeClass('hide')
			.removeClass('choice-template');
			var $choices_name = $(this).closest('.main-parent').find('.q2_choices').attr('name');
			var $correct_choices_name = $(this).closest('.main-parent').find('.q_choices').attr('name');
			$clone.find('.t-make-opt').attr('name',$choices_name).removeClass('make-opt');
			$clone.find('.make-correct').attr('name', $correct_choices_name).removeClass('make-correct');

			var $total_choices = $(this).closest('.parent-2').find('.q_choices').length;
			$clone.find('.opt-label').text('Choice '+$total_choices+':' );

			$clone.insertBefore($template);

		});

		$("#qcf").on('click','.add-choice-2',function(e){
			e.preventDefault();
			var $template = $(this).closest('.parent-2').find('.choice-template-2');
			$clone    = $template
			.clone()
			.removeClass('hide')
			.removeClass('choice-template-2');
			var $choices_name = $(this).closest('.main-parent').find('.q2_choices').attr('name');
			var $correct_choices_name = $(this).closest('.main-parent').find('.q_choices').attr('name');
			$clone.find('.t-make-opt').attr('name',$choices_name).removeClass('make-opt');
			$clone.find('.make-correct').attr('name',$correct_choices_name).removeClass('make-correct');

			var $total_choices = $(this).closest('.parent-2').find('.q_choices').length;
			$clone.find('.opt-label').text('Choice '+$total_choices+':' );

			$clone.insertBefore($template);

		});

		$("#qcf").on('click','.delete-choice',function(e){
			e.preventDefault();
			var $parent = $(this).closest('.form-group');
			$parent.remove();
		});

		$("#qcf").on('click','.delete-question',function(e){
			e.preventDefault();
			var $parent = $(this).closest('.main-parent')
			$parent.remove();

		});

		$("#qcf").on('change','.ques-text',function(){
			if($(this).val().substr(0, 1)=='.'){
				$(this).val('');
				alert('Question should start with a proper name not "."');
				return false;
			}
			var $choices_name = $(this).val().replace(/ /g,"_")+'[]';
			var $correct_choices = $(this).val().replace(/ /g,"_")+'_correct[]';
			$(this).closest('.main-parent').find('.q2_choices').attr('name',$choices_name);
			$(this).closest('.main-parent').find('.q_choices').attr('name',$correct_choices);

			var $checked_radio = $('input[name="'+$correct_choices+'"]:checked'); 
			if($checked_radio.is(':radio')){
				$checked_radio.val($checked_radio.closest('.form-group').find('.q2_choices').val());

			}
		});

		$("#add-new-question").click(function(e){
			e.preventDefault();
			var $template = $('#new-question-template');
			$clone    = $template
			.clone()
			.removeClass('hide')
			.removeAttr('id');

			$clone.find('.type-dropdown').attr('name','type[]');
			$clone.find('.make-question').attr('name','question[]').removeClass('make-question');
			$clone.find('.make-answer').attr('name','answer[]').removeClass('make-answer');

			$clone.insertBefore($template);

		});	

	})


</script>
@endsection