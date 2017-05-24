<!-- Extends from app.blade template -->
@extends('layouts.app')

<!-- Content of pages, using app.css-->
@section('content')
	
	<!-- Define the main content of task page -->
	<div class='panel-body'>
		<!-- Display errors -->
		@include('errors.503')
		
		<!-- Form to enter new task -->
		<form action="{{ url('task') }}" method="post" class="form-horizontal">
			{{ csrf_field() }}
			
			<!-- Task info -->
			<div class="form-group">
				<label for="task" class="col-sm3 control-label">
				Task
				</label>
				<div class="col-sm6">
					<input type="text" name="name" id="task-name" class="form-control">
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-6">
					<button type="submit" class="btn btn-default">
						<i class="fa fa-plus"></i> Add Task
					</button>
					
				</div>
			</div>
		</form>

		<!-- Display tasks -->
		@if(count($tasks) > 0)
			<div class="panel panel-default">
				<div class"panel-heading">
				Current Task
				</div>
				<div class"panel-body">
					<table class="table table-stripped task-table">
						<thead>
							<td>Task</td>
							<td>&nbsp</td>
						</thead>

						<tbody>
							@foreach($tasks as $task)
							<tr>
								<td class="table-text">
									<div>{{ $task->name }}</div>
								</td>

								<td>
									<form action="task/{{ $task->id }}" method="post">
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<button>Delete Task</button>
										<input type="hidden" name="method" value="DELETE">
									</form>
								</td>
							</tr>

							@endforeach
						</tbody>
						
					</table>
				</div>
				
			</div>

		@endif

	</div>

@endsection