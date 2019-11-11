<div class="card flex flex-col" style="height: 200px">
	<h3 class="text-3xl py-4 pl-4 -ml-5 mb-3 border-l-4 border-blue-600"><a href="{{ $project->path() }}" class="text-default">{{ $project->title }}</a></h3>
	<div class="text-default mb-4 flex-1">{{ Str::limit($project->description, 100) }}</div>
	@can('delete', $project)
		<footer>
			<form method="POST" action="{{ $project->path() }}" class="text-right">
				@csrf
				@method('DELETE')
				<button type="submit" class="text-xs">Delete</button>
			</form>
		</footer>
	@endcan
</div>