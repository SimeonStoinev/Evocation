<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    /**
     * @param $query
     * @param $schoolID
     *
     * Gets all grades by a given school ID.
     *
     * @return mixed
     */
    public function scopeGradesBySchoolID ($query, $schoolID) {
        return $query->where('school_id', $schoolID);
    }
}
