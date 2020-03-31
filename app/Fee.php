<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Student;

class Fee extends Model
{

    protected $fillable = [
        'amount',
        'student_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'amount' => 'decimal:2',
    ];

    /**
     * Get the student a particular payment belongs to.
     */
    public function student()
    {
        return $this->belongsTo('App\Student');
    }


}
