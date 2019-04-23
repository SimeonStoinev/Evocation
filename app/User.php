<?php

namespace App;

use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'card_id', 'name', 'family', 'email', 'rank', 'school_id', 'grade_id', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*
        |--------------------------------------------------------------------------
        | User ORM functions
        |--------------------------------------------------------------------------
    */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo (School's title)
     */
    public function school () {
        return $this->belongsTo('App\School')->select('title');
    }

    // End of ORM functions

    /**
     * Used only in Admin Panel!
     *
     * @param $query
     * @param $rank
     * @return mixed
     */
    public function scopeGetAllUsers ($query, $rank) {
        return $query->where([
            ['id', '>', '0'], ['rank', '!=', 'admin'], ['rank', $rank]
        ])->select('id', 'name', 'family', 'email', 'rank', 'school_id');
    }

    /**
     * Used only in Admin Panel!
     *
     * @param $query
     * @return mixed
     */
    public function scopeGetAllUnverifiedUsers ($query) {
        return $query->where([
            ['id', '>', '0'], ['rank', '!=', 'admin'], ['verified', '0']
        ])->select('id', 'name', 'family', 'email', 'rank', 'school_id');
    }

    /**
     * Gets current (logged) user rank by id.
     *
     * @param $query
     * @param $id
     * @return mixed (string)
     */
    public function scopeGetCurrUserRank ($query, $id) {
        return $query->where('id', $id)->select('rank');
    }

    /**
     * Gets user's name and family by id.
     *
     * @param $query
     * @param $id
     * @return mixed
     */
    public function scopeGetUserFullName ($query, $id) {
        return $query->where('id', $id)->select('name', 'family');
    }

    /**
     * Gets user's id and rank by unique card ID.
     *
     * @param $query
     * @param $cardID
     * @return mixed
     */
    public function scopeGetUserByCardID ($query, $cardID) {
        return $query->where('card_id', $cardID)->select('id', 'rank');
    }

    /**
     * Gets user's id, grade_id and school_id - necessary for creating an absence.
     *
     * @param $query
     * @param $id
     * @return mixed
     */
    public function scopeGetUserGradeAndSchool ($query, $id) {
        return $query->where('id', $id)->select('id', 'grade_id', 'school_id');
    }

    /**
     * Decides whether the user is classteacher or not.
     *
     * @param $query
     * @param $id
     * @return bool
     */
    public function scopeIsUserAClassTeacher ($query, $id) {
        $classTeacher = $query->where('id', $id)->select('is_classteacher');

        if ($classTeacher == '0') {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Gets the children linked to your id.
     *
     * @param $query
     * @param $parentID
     * @return mixed
     */
    public function scopeGetLinkedChildren ($query, $parentID) {
        return $query->where('family_link_id', $parentID);
    }

    /**
     * Gets all teachers in a given school.
     *
     * @param $query
     * @param $schoolID
     * @return mixed
     */
    public function scopeGetTeachersBySchoolID ($query, $schoolID) {
        return $query->where(['rank' => 'teacher', 'school_id' => $schoolID])->select('id', 'name', 'family');
    }
}