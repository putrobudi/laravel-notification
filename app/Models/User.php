<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // We're assuming when the user signs up they'll provide their phone number.
    // Or you provide in the settings are for them to fill for the user's record on database.
    public function routeNotificationForNexmo($notification)
    {
        // return $this->phone_number;
        return '6288801928310';
    }

    // When you create Model Relationship, you must provide the foreign key column on your table. Then you define the constraint on the migration file.
    public function conversations() {
      return $this->hasMany(Conversation::class);
    }

    public function replies() {
      return $this->hasMany(Reply::class);
    }

    public function roles() {
      return $this->belongsToMany(Role::class)->withTimestamps();
    }

    // here we were expecting a Role instance probably because the save() or sync() required parameter. 
    // But how about if you want to do something like this using string:
    // $user->assignRole('manager') instead of $use->assignRole(Role $manager) ?
    // Let's make the conditional below.
    public function assignRole($role) {
      
      if (is_string($role)) {
        // track down role from the given string.
        $role = Role::whereName($role)->firstOrfail();
      }
      // Of course we can check that if there is already a role assigned to a user don't do anything.
      // But we are going to use sync here.
      // $this->roles()->save($role);
      // sync: replace all of the existing records on the pivot table with this collection. And any of the records that are in the database
      // that are not in this collection will be dropped. So give false as the second parameter so that it will only add
      // new records if necessary.
      $this->roles()->sync($role, false); 
    }

    // Grab all the abilities the user has. This is not eloquent relationships, so we have to call it like a standard method.
    public function abilities() {
      return $this->roles->map->abilities->flatten()->pluck('name')->unique();
    }

}

// $user->roles = grab all the roles assigned to them.
// $user->roles()->save($role);