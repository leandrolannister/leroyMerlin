<?php

namespace leroyMerlin\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
  
  public $timestamps = false;      

  public $fillable = ['item', 
  					  'name', 
  					  'description', 
  					  'free_shipping', 
  					  'price']; 
}
