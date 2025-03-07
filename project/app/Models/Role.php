<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_name',
    ];

    /**
     * العلاقة مع جدول المستخدمين (واحد-إلى-متعدد)
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}