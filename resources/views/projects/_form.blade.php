@csrf
<div class="field mb-6">
	<label for="title" class="label text-sm mb-2 block">Title</label>
	<div class="control">
		<input type="text" name="title" placeholder="Title" class="input bg-transparent border border-muted rounded p-2 text-xs w-full" value="{{ $project->title }}" required>
	</div>
</div>
<div class="field mb-6">
	<label for="description" class="label text-sm mb-2 block">Description</label>
	<div class="control">
		<textarea 
			placeholder="Description" 
			name="description" 
			rows="10" 
			class="textarea bg-transparent border border-muted rounded p-2 text-xs w-full" 
			required
			>{{ $project->description }}</textarea>
	</div>
</div>
<div class="field">
	<div class="control">
		<button type="submit" class="button is-link">{{ $buttonText }}</button>
		<a href="{{ $project->path() }}" class="text-default">Cancel</a>
	</div>
</div>

@if ($errors->any())
	<div class="field mt-6">
		<ul>
			@foreach ($errors->all() as $error)
				<li class="text-red-500">{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif