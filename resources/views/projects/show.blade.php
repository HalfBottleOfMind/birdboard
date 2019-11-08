@extends ('layouts.app')

@section('content')
	<header class="flex items-center mb-3 py-4">
		<div class="flex justify-between items-end w-full">
				<p class="text-gray-600 text-sm">
					<a href="/projects">My Projects</a> / {{ $project->title }}
				</p>
			<a href="{{ $project->path().'/edit' }}" class="button">Edit Project</a>
		</div>
	</header>

	<main>
		<div class="lg:flex -mx-3">
			<div class="lg:w-3/4 px-3 mb-6">
				<div class="mb-6">
					<div><h2 class="text-gray-600 text-lg mb-3">Tasks</h2></div>
					
					@foreach ($project->tasks as $task)
						<div class="card mb-3">
							<form method="POST" action="{{ $task->path() }}">
								@method('PATCH')
								@csrf
								<div class="flex items-center">
									<input name="body" value="{{ $task->body }}" class="w-full {{ $task->completed ? 'text-gray-600' : '' }}">
									<input type="checkbox" name="completed" class="w-4 h-4" onchange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
								</div>
							</form>
						</div>
					@endforeach

					<div class="mb-3 card">
						<form action="{{ $project->path() . '/tasks' }}" method="POST">
							@csrf
							<input placeholder="Add the new task..." name="body" class="w-full">
						</form>
					</div>
				</div>
				<div>
					<div><h2 class="text-gray-600 text-lg mb-3">General Notes</h2></div>

					<form method="POST" action="{{ $project->path() }}">
						@method('PATCH')
						@csrf
						<textarea name="notes" class="card w-full" style="min-height: 200px mb-4" placeholder="Notes?">{{ $project->notes }}</textarea>
						<button type="submit" class="button">Save</button>
					</form>
				</div>
			</div>
			<div class="lg:w-1/4 px-3">
				@include('projects.card')
			</div>
		</div>
	</main>
@endsection