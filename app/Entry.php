<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    /**
     * @param $query
     * @param $userID
     * @return mixed
     */
    public function scopeGetUserEntries ($query, $userID) {
        return $query->where('user_id', $userID);
    }
}
