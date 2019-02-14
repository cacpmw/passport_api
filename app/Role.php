<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @OA\Schema()
 */
class Role extends Model
{
    use SoftDeletes;
    /**
     *
     * @OA\Property(
     *   property="name",
     *   type="string",
     *   description="The role name"
     * )
     */
    protected $fillable = [
        'name',
    ];
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    public function users()
    {
        return $this->hasMany('App\User');
    }
}
