<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisUser extends Model
{
    protected $table = 'JENIS_USER';

    protected $primaryKey = 'id_jenis_user';

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'id_jenis_user',
        'jenis_user',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'id_jenis_user', 'id_jenis_user');
    }
}
