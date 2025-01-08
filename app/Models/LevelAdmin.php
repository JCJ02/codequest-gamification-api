<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class LevelAdmin extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'admin_level';

    protected $fillable = [
        'admin_id',
        'language_id',
        'level_diffuculty',
        'level_prize',
        'level_task',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function language()
    {
        return $this->belongsTo(AdminLanguage::class, 'language_id');
    }
}
