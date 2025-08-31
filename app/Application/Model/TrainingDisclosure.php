<?php

namespace App\Application\Model;

use Illuminate\Database\Eloquent\Model;

class TrainingDisclosure extends Model
{

  public $table = "trainingdisclosure";


   protected $fillable = [
        'name','email','phone','country','company','numberoftrainees','websiteurl','service','title'
   ];


}
