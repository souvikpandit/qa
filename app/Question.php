<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['title','body'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    } 
    /**
     * setTitleAttribute() is a mutator.Since the slug is not insterted by User, that means when a question's title 
     * will be inserted into database,then the mutator will genarate the slug for us,
     * and set the attribute
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }


}
