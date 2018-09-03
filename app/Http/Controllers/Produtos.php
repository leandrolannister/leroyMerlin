<?php

namespace leroyMerlin\Http\Controllers;

use Request;
use Illuminate\Http\Resources\Json\JsonResource;
use leroyMerlin\Models\Produto;
use leroyMerlin\Models\TTProduto;
use Illuminate\Support\Facades\Input;
use Excel;
use DB;
use leroyMerlin\Jobs\Gravar;

class Produtos extends Controller
{
   
  public function upload()
  {
    if(Input::hasFile('arquivoProduto')):      
      $path = Input::file('arquivoProduto')->getRealPath();
      $arquivo = Excel::load($path, function($reader){})->get();
      
      if(sizeOf($arquivo) > 0):        
        $produtos = $this->retornarArray($arquivo);
      else:        
        dd("Arquivo não possui registros"); 
      endif;      
    else:      
      dd("Favor anexar um arquivo");
    endif; 
    
    $produtos = $this->removeItensNull($produtos);    
    
    DB::table('tt_produtos')->insert($produtos);  

    if(Request::only(['delete'])):      
      Gravar::dispatch($this->delete());
    else:
      Gravar::dispatch($this->filtro());        
    endif;                
    
    return view("produto.form")
      ->with('msg', "importado com sucesso"); 
  }

  public function retornarArray($object)
  {
    foreach ($object as $key => $p):            
       $produtos[] = 
        ['name' => $p->name,
         'description' => $p->description,
         'free_shipping' => $p->free_shipping,
         'price' => $p->price,
         'item' => $p->item];        
    endforeach; 
    
    return $produtos;
  }
  
  public function removeItensNull($produtos)
  {
    foreach($produtos as $key => $p):
      if(strlen($p['item']) == 0):
        unset($produtos[$key]);
      endif;  
    endforeach;    

    return $produtos;
  }

  public function listarProdutos()
  {
    return response()->json(TTProduto::all());
  }  

  public function procurarProduto($item)
  {    
    $produtos[] = (string) $item; 
    
    $achou = DB::select(" 
                    SELECT item FROM produtos AS p 
                    WHERE p.item = ?",
                    array_values($produtos));                    
    return $achou;    
  }  

  public function filtro()
  {
    $produtos = JsonResource::collection(TTProduto::all());    
    $valor = json_decode(json_encode($produtos), True);

    if(sizeOf($valor) > 0):
      $itens = $this->retornarArray($produtos);

      foreach ($itens as $i): 
        if($this->procurarProduto($i['item'])):          
          $this->update($itens);            
        else:                        
          $this->store($i);                     
        endif; 
      endforeach; 

      $this->limpaLog();
      
      return view("produto.form")
        ->with('msg', "Gravado com sucesso!"); 
    endif;  
    
    return view("produto.form")
      ->with('msg', "Anexar um arquivo");        
  }  

  public function store($produtos)
  {    
    DB::table('produtos')->insert($produtos);  
  }

  public function update($produtos)
  { 
    foreach ($produtos as $key => $value):
      DB::update("UPDATE produtos SET 
        name = ?,        
        description = ?,
        free_shipping = ?,
        price = ?
      WHERE item = ?", array_values($value));
    endforeach;    
  }

  public function limpaLog()
  {
    return 
      DB::select('DELETE FROM tt_produtos WHERE id >= ?', ["1"]);
  }

  public function delete()
  {
    $produtos = JsonResource::collection(TTProduto::all());
    $valor = json_decode(json_encode($produtos), True);
        
    if(sizeOf($valor) > 0):    
      $itens = $this->retornarArray($produtos);
      $itens = $this->removeItensNull($itens); 

      foreach($itens as $i):
        DB::select('
          DELETE FROM produtos WHERE item = ?', array($i['item']));
      endforeach; 

      $this->limpaLog();   
      
      return view("produto.form")
        ->with('msg', "Eliminado com sucesso!");   
    endif;    
    
    return view("produto.form")
      ->with('msg', "Anexar um arquivo");      
  }

  function index()
  {
    return view('produto.lista')->with('produtos', Produto::all());
  }  
}    
