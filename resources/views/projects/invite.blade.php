<div class="card flex flex-col mt-3">
	<h3 class="text-3xl py-4 pl-4 -ml-5 mb-3 border-l-4 border-accent-light">Invite a User</h3>
	<footer>
		<form method="POST" action="{{ $project->path() . '/invitations' }}">
			@csrf
			<div class="mb-3">
				<input type="email" name="email" class="border border-muted rounded w-full py-2 px-3" placeholder="Email address">
			</div>
			<button type="submit" class="button">Invite</button>
		</form>
	</footer>
	@include('errors', ['bag' => 'invitations'])
</div>