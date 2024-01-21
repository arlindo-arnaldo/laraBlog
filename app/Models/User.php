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
        'name', 'email', 'password', 'username', 'picture', 'biography', 'type', 'blocked', 'direct_publish'
    ];
    protected $table = 'users';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**Relacao entre usuario e tipo de acesso */
    public function authorType(){
        return $this->belongsTo(Type::class, 'type', 'id');
    }
    public function getPictureAttribute($value){
        if (isset($value)) {
            return asset('back/dist/img/authors/'.$value);
        }else{
            return asset('back/dist/img/authors/default-img.png');
        }
    }
    public function scopeSearch($query, $term){
        $term = "%$term%";
        $query->where(function($query) use ($term){
            $query->where('name', 'like', $term)
            ->orWhere('email', 'like', $term);
        });
    }
}
