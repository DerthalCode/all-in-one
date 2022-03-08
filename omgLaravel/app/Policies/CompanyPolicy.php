<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CompanyPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Company $company) {
        return $user->id === $company->user_id ? Response::allow() : Response::deny('Neturi tam teisiu');
    }

    public function delete(User $user, Company $company) {
        return $user->id === $company->user_id ? Response::allow() : Response::deny('Neturi tam tesiu');
    }
}
