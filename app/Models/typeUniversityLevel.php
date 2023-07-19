<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class typeUniversityLevel extends Model
{
    const diplomat = 1;
    const baccalaureate = 2;
    const degree = 3;
    const all = 4;
}
