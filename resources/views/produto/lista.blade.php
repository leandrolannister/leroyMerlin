@extends('produto.header')

@section('title')
  Lista de Produtos
@stop

@section('conteudo')
  <div>
  	<label>Description</label>
  	<input type="text" name="description" id="description" 
  		   class="form-control" oninput="buscar()">
  </div>
  <table class="table table-striped table-bordered table-hover">
    <thead>
	  <tr>
	    <th>Item</th>
		<th>Name</th>
		<th>Description</th>
		<th>Free_shipping</th>
		<th>Price</th>
	  </tr>
	</thead>	
	<tbody>
	  @foreach($produtos as $p)
	    <tr id="produtos">
		  <td>{{$p->item}}</td>
		  <td>{{$p->name}}</td>
		  <td id="info-description">{{$p->description}}</td>
		  <td>{{$p->free_shipping}}</td>
		  <td>{{$p->price}}</td>
		</tr>	
	  @endforeach 
	</tbody>
  </table>  
@stop()
<script type="text/javascript" src="/js/pesquisaDescription.js">    
</script>
