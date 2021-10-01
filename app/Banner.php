<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    public function admin(){
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }
}
