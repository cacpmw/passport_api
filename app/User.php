<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

/** @OA\Schema(
 *     description="User model",
 *     title="User",
 *     @OA\Xml(
 *         name="User"
 *     )
 * )
 *
 */
class User extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;

    /**
     *
     * @OA\Property(
     *   property="name",
     *   type="string",
     *   description="The user name"
     * )
     * @OA\Property(
     *   property="email",
     *   type="string",
     *   description="The user email"
     * )
     * @OA\Property(
     *   property="password",
     *   type="string",
     *   description="The user password"
     * )
     * @OA\Property(
     *   property="role_id",
     *   type="integer",
     *   description="The user role id"
     * )
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id',
    ];


    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo('App\Role');
    }
}
