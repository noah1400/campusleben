<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use HasFactory;

    use Concerns\UsesUuid;

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
