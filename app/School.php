<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    /**
     * Gets the school title by id.
     *
     * @param $query
     * @param $schoolID
     * @return mixed
     */
    public function scopeGetSchoolTitle ($query, $schoolID) {
        return $query->where('id', $schoolID);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeGetAllSchools ($query) {
        return $query->where('id', '>', '0');
    }
}
