<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;
class Products extends Model
{
    protected function serializeDate(DateTimeInterface $date){
        return $date->format('Y-m-d h:i a');
    }
    protected $fillable = [
        'name',
        'qty',
    ];
}
