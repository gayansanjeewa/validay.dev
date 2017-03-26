<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['name', 'parent_id'];

    /**
     * @param $department
     * @param array $relation
     * @return mixed
     */
    public static function findByName($department, $relation = [])
    {
        return self::with($relation)->where('name', $department)->first();
    }

    public function employees()
    {
        return $this->belongsToMany(Employee::class);
    }
}
