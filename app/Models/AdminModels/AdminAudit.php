<?php

namespace App\Models\AdminModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminAudit extends Model
{
    use HasFactory, SoftDeletes;

    // ADMIN AUDIT MODEL
    protected $table = 'admin_audit';
    protected $primaryKey = 'audit_id';  
    protected $fillable = ['admin_id', 'action_event', 'description', 'event_date',];
    protected $dates = ['event_date', 'deleted_at'];  

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
