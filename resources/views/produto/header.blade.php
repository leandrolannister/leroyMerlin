<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title')</title>
	<link rel="stylesheet" type="text/css" href="/css/app.css">
	<link rel="stylesheet" type="text/css" href="/css/style.css">  
  </head>
  <body>	
    <div class="navbar navbar-inverse navbar-fixed-top">
	  <div class="container">
	    <div class="navbar-header">
		  <a class="navbar-brand" href="/">Menu</a>	
		</div>	
		<div>
		  <ul class="nav navbar-nav">
		    <li>
		      <a href="{{action('Produtos@index')}}" 
		         target="_blank">Produtos</a></li>				  
		  </ul>	
		</div>
	  </div>	
	</div>		
	<div class="container">				
	  @yield('conteudo')
	</div>  
  </body>
</html>	  
