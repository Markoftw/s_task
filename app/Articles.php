<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model {


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'articles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['section', 'title', 'image'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
