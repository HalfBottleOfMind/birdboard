<?php

namespace App\Policies;

use App\User;
use App\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Project $project)
    {
        return $user->is($project->owner) || $project->members->contains($user);
    }

    public function show(User $user, Project $project)
    {
        return $user->is($project->owner) || $project->members->contains($user);
    }

    public function destroy(User $user, Project $project)
    {
        return $user->is($project->owner);
    }

    public function inviteUsers(User $user, Project $project)
    {
        return $user->is($project->owner);
    }
}
