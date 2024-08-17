<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task_Categories extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    public $timestamps = false;
    protected $table="task_categories";
}
