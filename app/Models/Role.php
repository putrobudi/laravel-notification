<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;

    protected $guarded = []; // "Cause I'm happy handling that my own."

    public function abilities() {
      return $this->belongsToMany(Ability::class)->withTimestamps();
    }

    // Assign abilities
    // Is this like attach method on fromscratch tags?
    // $role->allowTo('edit_forum') so the argument can be either an object or a string, use the conditional below.
    public function allowTo($ability) {
      if (is_string($ability)) {
        $ability = Ability::whereName($ability)->firstOrfail();
      }
      // $this->abilities()->save($ability);
      $this->abilities()->sync($ability, false);
    }
}

// $moderator->abilities
