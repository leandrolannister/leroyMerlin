@extends('produto.header')

@section('title')
  Index
@stop

@section('conteudo')
  @if(isset($msg))
    <div class="alert alert-success">
	    <ul>				
		    <li>{{$msg}}</li>     				
	    </ul>  
    </div>  
  @endif 

  <?php $importar = "http://localhost:8000/produto/upload" ?>    

  <form action="{{$importar}}" method="post" 
        class="form-horizontal" enctype="multipart/form-data">
        {{csrf_field()}}
  	    <input type="file" name="arquivoProduto" />        
	      <button class="btn btn-success">Upload-Excel</button>
        <div>
          <label>
            <input type="checkbox" name="delete" value="true">
               EXCLUIR
          </label>        
        </div>  
  </form>    
@stop()