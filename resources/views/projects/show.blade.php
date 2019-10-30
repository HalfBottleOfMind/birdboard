@extends ('layouts.app')

@section('content')
	<header class="flex items-center mb-3 py-4">
		<div class="flex justify-between items-end w-full">
				<p class="text-gray-600 text-sm">
					<a href="/projects">My Projects</a> / {{ $project->title }}
				</p>
			<a href="/projects/create" class="button">New Project</a>
		</div>
	</header>

	<main>
		<div class="lg:flex -mx-3">
			<div class="lg:w-3/4 px-3 mb-6">
				<div class="mb-6">
					<div><h2 class="text-gray-600 text-lg mb-3">Tasks</h2></div>
					
					<div class="card mb-3">Lorem ipsum.</div>
					<div class="card mb-3">Lorem ipsum.</div>
					<div class="card mb-3">Lorem ipsum.</div>
					<div class="card">Lorem ipsum.</div>
				</div>
				<div>
					<div><h2 class="text-gray-600 text-lg mb-3">General Notes</h2></div>

					<textarea class="card w-full" style="min-height: 200px">Lorem ipsum.</textarea>
				</div>
			</div>
			<div class="lg:w-1/4 px-3">
				@include('projects.card')
			</div>
		</div>
	</main>
@endsection