<?php

namespace App\Models\AdminModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminLanguage extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'admin_language';
    
    protected $fillable = [
        'admin_id', 'language_title', 'language_description',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
