<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    protected $fillable = ['name', 'code', 'stock', 'description'];

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
