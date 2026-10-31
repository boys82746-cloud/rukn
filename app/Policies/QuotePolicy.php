<?php

namespace App\Policies;

use App\Models\Quote;
use App\Models\User;

class QuotePolicy
{
    // Only the publisher may edit or delete a quote; everyone else is read-only.
    public function update(User $user, Quote $quote): bool
    {
        return (int) $quote->user_id === (int) $user->id;
    }

    public function delete(User $user, Quote $quote): bool
    {
        return (int) $quote->user_id === (int) $user->id;
    }
}
