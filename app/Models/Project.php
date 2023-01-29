<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function technologies(){
        return $this->belongsToMany(Technology::class);
    }

    public static function generateSlug($string){
        $slug = Str::slug($string, '-');

        $original_slug = $slug;
        $c = 1;
        $exists = Project::where('slug',$slug)->first();
        while($exists){
            $slug = $original_slug . '-' . $c;
            $exists = Project::where('slug',$slug)->first();
            $c++;
        }
        return $slug;
        }

        protected $fillable = ['name','cover_image','client_name','summary','slug','cover_image_original_name', 'type_id', 'user_id'];
}
