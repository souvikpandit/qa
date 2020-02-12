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

    /**
     * this function is an Accessor.
     * $question->url in questions/index is not define in table,show we use Accessor.
     * this funcion will return a route to show the question details 
     */
    public function getUrlAttribute()
    {
        return route('questions.show',$this->slug);
    }
    /**
     * This is also a accessor.
     * $question->created_date is not define in table,but form questions/index,we call $question->created_date
     * then it will return this function value.
     * diffForHumans() converts the carbon object into human understandable format 
     */
    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }
    /**
     * This Is a Accessor.
     * it Returns the color depending on the status of the question
     */
    public function getStatusAttribute()
    {
        if ($this->answers > 0) {
            if ($this->best_answer_id) {
                return "answer-accepted";
            }
            return "answered";
        } 
            return "unanswered";
        
        
    }

    /**
     * this is an accessor.
     * this helps us to convert the question body into html format
     */
    public function getBodyHtmlAttribute()
    {
        return \Parsedown::instance()->text($this->body);
    }

}
