<?php
namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use PHPZen\LaravelRbac\Traits\Rbac;
use Fenos\Notifynder\Notifable;
use Cache;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{

  use Authenticatable, CanResetPassword, Rbac, Notifable;

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'users';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['name', 'email', 'password', 'address', 'personal_number', 'work_number', 'image_path'];

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $dates = ['trial_ends_at', 'subscription_ends_at'];
  protected $hidden = ['password', 'password_confirmation', 'remember_token'];


  protected $primaryKey = 'id';

  public function ticketsAssign()
  {
    return $this->hasMany('App\Ticket', 'fk_user_id_assign', 'id')
      ->where('status', 1)
      ->orderBy('deadline', 'asc');
  }

  public function ticketsCreated()
  {
    return $this->hasMany('App\Ticket', 'fk_user_id_created', 'id')->limit(10);
  }

  public function ticketsCompleted()
  {
    return $this->hasMany('App\Ticket', 'fk_user_id_assign', 'id')->where('status', 2);
  }

  public function ticketsAll()
  {
    return $this->hasMany('App\Ticket', 'fk_user_id_assign', 'id')->whereIn('status', [1, 2]);
  }

  public function leadsAll()
  {
    return $this->hasMany('App\Leads', 'fk_user_id', 'id');
  }

  public function settings()
  {
    return $this->belongsTo('App\Settings');
  }

  public function relationsAssign()
  {
    return $this->hasMany('App\Relation', 'fk_user_id', 'id');
  }

  public function userRole()
  {
    return $this->hasOne('App\RoleUser', 'user_id', 'id');
  }

  public function department()
  {
    return $this->belongsToMany('App\Department', 'department_user');
  }

  public function departmentOne()
  {
    return $this->belongsToMany('App\Department', 'department_user')->withPivot('Department_id');
  }

  public function isOnline()
  {
    return Cache::has('user-is-online-' . $this->id);
  }
}
