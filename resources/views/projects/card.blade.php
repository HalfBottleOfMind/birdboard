<div class="card" style="height: 200px">
	<h3 class="text-3xl py-4 pl-4 -ml-5 mb-3 border-l-4 border-blue-600"><a href="{{ $project->path() }}">{{ $project->title }}</a></h3>
	<div class="text-gray-600 mb-4">{{ Str::limit($project->description, 100) }}</div>

	<footer>
		<form method="POST" action="{{ $project->path() }}" class="text-right">
			@csrf
			@method('DELETE')
			<button type="submit" class="text-xs">Delete</button>
		</form>
	</footer>
</div>