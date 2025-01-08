<?php

namespace App\Models\AdminModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class AdminLevel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'admin_level';
    protected $fillable = ['admin_id', 'language_id', 'level_diffuculty', 'level_prize', 'level_task'];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function language()
    {
        return $this->belongsTo(LanguageAdmin::class, 'language_id');
    }

}
