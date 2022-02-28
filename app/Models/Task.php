<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // protected $guarded = [];
    protected $fillable = ['name', 'description', 'user_id'];

    // protected $table = 'zadaci';

    // protected $primaryKey = 'taks_id';

    // public $incrementing = false;

    // protected $keyType = 'string';

    // public $timestamps = false; 

    // const CREATED_AT = 'created';
    // const UPDATED_AT = 'update';


    // public $id;

    // public $user_id;

    // public $name;

    // public $description;

    // public $completed;   


    // public function findOr($id) {

    //     $sql = "SELECT * FROM tasks WHERE id = 2";

    //     $task = $stmt->fetch(PDO::FETCH_OBJ);

    //     $this->id = $task->id;

    //     $this->user_id = $task->user_id;

    //     $this->name = $task->name;

    // }

    public function taskDetail() {
        return $this->hasOne(TaskDetail::class);
    }

    public function items() {
        return $this->hasMany(Item::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class, 'task_tag');
    }


}

