<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'surname',
        'dob',
        'course'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'dob',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'dob' => 'date',
    ];


    /**
     * Get the fee payments for a particular student.
     */

    public function fees()
    {
        return $this->hasMany('App\Fee');
    }

    /**
     * Get the Student's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        //formating text for presentability
        $surName = ucfirst(strtolower($this->surname));
        $firstName = ucfirst(strtolower($this->first_name));
        $lastName = ucfirst(strtolower($this->last_name));

        return "{$surName} {$firstName} {$lastName}";
    }
}
