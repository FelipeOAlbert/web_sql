<?php

/**
@after_url = URL depois do URI normal
**/
function pagination($pagina=1, $total_itens, $uri, $after_uri=false, $max = 10){
	$total_itens = intval($total_itens);
	$pagina = intval($pagina);

	
	$exibicoes = 4;
	$inicio = 1;

	if($total_itens<=$max)
		return "";

	$paginas = $total_paginas = ceil($total_itens/$max);

	//Se passou da página 3, já exibe as setas
    if($pagina>3 && $paginas>=6)
    	$inicio = $pagina-2;

    //Nao deixa passar do limite maximo de paginas
    if( ($inicio+$exibicoes) < $paginas )
    	$paginas = ($inicio + $exibicoes );

    //Recua o início da paginacao para inteirar o máximo de itens
    if( $total_paginas > 5 &&  ($paginas - $inicio ) < $exibicoes ){
    	$falta = ( $exibicoes - ($paginas - $inicio ) );
    	$inicio = ($inicio-$falta);
    }

	$return = "<ul class='pagination pull-right'>";

		if($inicio>1)
			$return .= "<li><a href='".site_url($uri."/".($inicio-1)."/".$after_uri )."'>&#8249;</a></li>";


		for($x=$inicio;$x<=$paginas;$x++){

	 		$return .= "<li ".($x==$pagina?" class='active' ":"")."><a href='".site_url($uri."/".$x."/".$after_uri)."'>".$x."</a></li>";
	 	}

	 	if($x<=$total_paginas)
			$return .= "<li><a href='".site_url($uri."/".($x)."/".$after_uri )."'>&#8250;</a></li>";


	$return .= "</ul>";

	return $return;
}