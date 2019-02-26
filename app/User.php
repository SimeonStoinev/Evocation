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

    /**
     * @param $query
     * @param $id
     *
     * Gets current (logged) user rank by id.
     *
     * @return mixed (string)
     */
    public function scopeGetCurrUserRank ($query, $id) {
        return $query->where('id', $id)->select('rank');
    }

    /**
     * @param $query
     * @param $id
     *
     * Gets user's name and family by id.
     *
     * @return mixed
     */
    public function scopeGetUserFullName ($query, $id) {
        return $query->where('id', $id)->select('name', 'family');
    }

    /**
     * @param $query
     * @param $cardID
     *
     * Gets user's id and rank by unique card ID.
     *
     * @return mixed
     */
    public function scopeGetUserByCardID ($query, $cardID) {
        return $query->where('card_id', $cardID)->select('id', 'rank');
    }

    /**
     * @param $query
     * @param $id
     *
     * Gets user's id, grade_id and school_id - necessary for creating an absence.
     *
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
}