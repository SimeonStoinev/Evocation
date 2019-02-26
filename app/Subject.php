<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    /**
     * Gets the subject title by subject id.
     *
     * @param $query
     * @param $subjectID
     * @return mixed
     */
    public function scopeGetSubjectTitle ($query, $subjectID) {
        return $query->where('id', $subjectID)->select('title');
    }
}