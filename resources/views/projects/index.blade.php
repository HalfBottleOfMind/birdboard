@extends ('layouts.app')

@section('content')
	<header class="flex items-center mb-3 py-4">
		<div class="flex justify-between items-center w-full">
			<h2 class="text-gray-600 text-sm">My Projects</h2>
			<a href="/projects/create" class="button">New Project</a>
		</div>
	</header>
	<main class="lg:flex lg:flex-wrap -mx-3">
		@forelse ($projects as $project)
			<div class="lg:w-1/3 px-3 pb-6">
				<div class="bg-white rounded-lg shadow p-5" style="height: 200px">
					<h3 class="font-normal text-xl py-4 pl-4 -ml-5 mb-3 border-l-4 border-blue-600"><a href="{{ $project->path() }}">{{ $project->title }}</a></h3>
					<div class="text-gray-600">{{ Str::limit($project->description, 100) }}</div>
				</div>
			</div>
		@empty
			<div>No Projects yet</div>
		@endforelse
	</main>
@endsection