<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = ['serviceType', 'serviceName', 'price'];
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'service_id');
    }
}
