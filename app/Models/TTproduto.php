<?php

namespace leroyMerlin\Models;

use Illuminate\Database\Eloquent\Model;

class TTproduto extends Model
{
  protected $table = "tt_produtos";

  public $timestamps = false;      

  public $fillable = ['item', 
  					  'name', 
  					  'description', 
  					  'free_shipping', 
  					  'price']; 
}  

