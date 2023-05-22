<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneratedUrl extends Model
{
    use HasFactory;

    protected $table = 'generated_url';

    protected $fillable=['hased_url ','has_code','original_url'];
}
