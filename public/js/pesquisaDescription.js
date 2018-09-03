var $ = document.getElementById.bind(document);

function buscar()
{
  getProdutos().forEach(function(p){
    let desc = p.querySelector('#info-description').textContent;
    let comparar = new RegExp($('description').value, "i");

    if($('description').value.length > 0)
    {
      if(comparar.test(desc))    
        p.classList.remove('hidden');  
      else
        p.classList.add('hidden');
    }else{
      getProdutos().forEach(function(p){
        p.classList.remove('hidden');
      });
    } 
  });
}   

function getProdutos()
{
  let produtos = document.querySelectorAll('#produtos');
  return produtos;  
} 
