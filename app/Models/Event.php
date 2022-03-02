<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $casts = [
		  'items' => 'array' //Essa linha vai mudar os itens q vão vir em string para array
	  ];
    
    protected $dates = ['date'];
    
    protected $guarded = [];

    public function user(){
		  return $this->belongsTo('App\Models\User');
        //essa linha diz q o evento tem um usuário 
        //e q esse usuário pertence a classe User
        //evento pertence a um usuário
	}

    public function users() {
		return $this->belongsToMany('App\Models\User');
	}
}
