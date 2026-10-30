<?php

namespace App\Policies;

use App\Models\Listing;
use App\Models\User;

class ListingPolicy
{
    // Only the owner may edit or delete a listing; everyone else is read-only.
    public function update(User $user, Listing $listing): bool
    {
        return (int) $listing->user_id === (int) $user->id;
    }

    public function delete(User $user, Listing $listing): bool
    {
        return (int) $listing->user_id === (int) $user->id;
    }
}
