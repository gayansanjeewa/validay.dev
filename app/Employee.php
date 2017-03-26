<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['first_name', 'last_name'];
    protected $hidden = ['pivot', 'created_at', 'updated_at'];

    public function departments()
    {
        return $this->belongsToMany(Department::class);
    }
}
