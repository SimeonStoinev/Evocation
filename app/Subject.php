<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    /**
     * @param $query
     * @param $subjectID
     *
     * Gets the subject title by subject id.
     *
     * @return mixed
     */
    public function scopeGetSubjectTitle ($query, $subjectID) {
        return $query->where('id', $subjectID)->select('title');
    }
}