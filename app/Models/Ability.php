<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    use HasFactory;

    protected $guarded = [];

    // if you have a particular ability and you want to grab all roles that include that ability.
    public function roles() {
      return $this->belongsToMany(Role::class)->withTimestamps();
    }
}
