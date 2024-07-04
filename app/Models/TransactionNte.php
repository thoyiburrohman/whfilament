<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionNte extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function nte()
    {
        return $this->belongsTo(Nte::class, 'nte_id');
    }

    public function toTechnician()
    {
        return $this->belongsTo(Technician::class, 'to_id');
    }

    public function fromTechnician()
    {
        return $this->belongsTo(Technician::class, 'from_id');
    }

    public function fromWarehouse()
    {
        return $this->belongsTo(Warehouse::class, 'from_id');
    }

    public function toWarehouse()
    {
        return $this->belongsTo(Warehouse::class, 'to_id');
    }
}
