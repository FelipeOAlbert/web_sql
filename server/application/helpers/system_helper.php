<?php

function printr($array =array())
{
	var_dump($array);
	print '<br /><br /><pre>';
		print_r($array);
	print '</pre>';
	die();
}

function mysql_br_time($time = '0000-00-00 00:00:00')
{
	if($time){
        $time = explode(' ', $time);
        return implode('/', array_reverse(explode('-', $time[0]))).' '.$time[1];
	}
	
    return false;
}

function mysql_br_date($time = '0000-00-00 00:00:00')
{
	if($time){
        $time = explode(' ', $time);
        return implode('/', array_reverse(explode('-', $time[0])));
	}
	
    return false;
}

function br_mysql_date($date = '00/00/0000')
{
	return implode('-', array_reverse(explode('/', $date)));
}

function return_hour_minute($time = '0000-00-00 00:00:00')
{
    if($time){
        $time = explode(' ', $time); 
		return date('H:i', strtotime($time[1]));
	}
	
	return FALSE;
}

function return_hour_minute2($time = '00:00')
{
    if($time){    
		return date('H:i', strtotime($time));
	}
}

function return_hour_minute3($time = '00:00:00')
{
    if($time){    
		return date('H:i', strtotime($time));
	}
}

/***
 * Função para remover acentos de uma string
 *
 * @autor Thiago Belem <contato@thiagobelem.net>
 */
function removeAcentos($string, $slug = false) {
	$string=remove_accent($string);
	$string = mb_strtolower($string);


	// Código ASCII das vogais
	$ascii['a'] = range(224, 230);
	$ascii['e'] = range(232, 235);
	$ascii['i'] = range(236, 239);
	$ascii['o'] = array_merge(range(242, 246), array(240, 248));
	$ascii['u'] = range(249, 252);

	// Código ASCII dos outros caracteres
	$ascii['b'] = array(223);
	$ascii['c'] = array(231);
	$ascii['d'] = array(208);
	$ascii['n'] = array(241);
	$ascii['y'] = array(253, 255);

	foreach ($ascii as $key=>$item) {
		$acentos = '';
		foreach ($item AS $codigo) $acentos .= chr($codigo);
		$troca[$key] = '/['.$acentos.']/i';
	}

	$string = preg_replace(array_values($troca), array_keys($troca), $string);

	// Slug?
	if ($slug) {
		// Troca tudo que não for letra ou número por um caractere ($slug)
		$string = preg_replace('/[^a-z0-9]/i', $slug, $string);
		// Tira os caracteres ($slug) repetidos
		$string = preg_replace('/' . $slug . '{2,}/i', $slug, $string);
		$string = trim($string, $slug);
	}

	return $string;
}


/**
* Função para pegar extensão do arquivo
* @access public static
* @param String $tUrl
* @return void
*/

function getExt($arquivo_nome = '')
{
	if(!isset($arquivo_nome)) {
		return false;
	} else {
		return pathinfo($arquivo_nome, PATHINFO_EXTENSION);
	}
}

function getSizeArchive($arquivo='')
{
    $tamanhoarquivo = filesize($arquivo);

    /* Medidas */
    $medidas = array('kb', 'mb', 'gb', 'tb');
    
	/* Se for menor que 1KB arredonda para 1KB */

    if($tamanhoarquivo < 999){
        $tamanhoarquivo = 1000;
    }

    for ($i = 0; $tamanhoarquivo > 999; $i++){
        $tamanhoarquivo /= 1024;
    }
	
    return round($tamanhoarquivo,2) ." ".$medidas[$i - 1];
}

function remove_accent($str)
{
  $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', 'Œ', 'œ', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', 'Š', 'š', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', 'Ÿ', '?', '?', '?', '?', 'Ž', 'ž', '?', 'ƒ', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?');
  $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');
  return str_replace($a, $b, $str);
}

function money($value = 0.00)
{
	if(is_numeric($value)){
		return number_format($value,2,',','.');
	}

	else{
		return 0;
	}
}

function converterparahoras($segundos)
{ 
	$hours		= floor($segundos / 3600);
	$segundos	-= $hours * 3600;
	$minutes	= floor($segundos / 60);
	$segundos	-= $minutes * 60;
	
	
	return sprintf("%d:%02d", $hours, $minutes);
}

//Formata um selectbox
function format_select($rows, $selected=0, $input_1 = 'id', $input_2 = 'name', $display_zero = true)
{
	if($display_zero){
		print('<option value="0">Selecione</option>');
	}
	
	if($rows){
		foreach($rows as $row){
			if($row['id'] == $selected){
				print('<option value="'.$row[$input_1].'" selected="selected">'.$row[$input_2].'</option>');
			} else {
				print('<option value="'.$row[$input_1].'">'.$row[$input_2].'</option>');
			}
		}
	}

	return true;
}

function only_numbers($string = '')
{
	return preg_replace('/\D/', '', $string);

}

function comma_period($value = null)
{
	if($value)
	{
		$value = str_replace(array('.',','), array('','.'), $value);

		return $value;
	}
	else
	{
		return 0;
	}
}

function soma_horas($times)
{
	if($times){
		
		$segundos = 0;
		
		foreach ($times as $time){
			if($time != '0' && $time!=""){

				list($g, $i) = explode(':', $time);
				$segundos += $g * 3600;
				$segundos += $i * 60;
			}
		}
		
		return $segundos;
	}
	
	return 0;
}

function status2txt($status){
	switch ($status) {
		
		case '1':
			return 'Ativo';
		break;
		case '2':
			return 'Aguardando Pagamento';
		break;	
		case '0':
			return 'Inativo';
		break;	
		default:
			return $status;
		break;
	}
}

function select_status($id = 0)
{
	for($i = 1; $i < 3; $i++){
		
		if($id == $i){
			echo '<option value="'.$i.'" selected>'.status2txt($i).'</option>';
		}else{
			echo '<option value="'.$i.'">'.status2txt($i).'</option>';
		}
	}
}

function yes_no($id)
{
	
	if($id == 1){
		return 'Sim';
	}
	
	return 'Não';
}

function geraRA($tamanho = 6, $letras = false, $maiusculas = false, $numeros = true, $simbolos = false)
{
	$lmin		= 'abcdefghijklmnpqrstuvwxyz';
	$lmai		= 'ABCDEFGHIJKLMNPQRSTUVWXYZ';
	$num		= '1234567890';
	$simb		= '!@#$%*-';
	$retorno	= '';
	$caracteres	= '';

	if ($letras)
		$caracteres .= $lmin;
	if ($maiusculas)
		$caracteres .= $lmai;
	if ($numeros)
		$caracteres .= $num;
	if ($simbolos)
		$caracteres .= $simb;
	
	$len = strlen($caracteres);
	
	for($n = 1; $n <= $tamanho; $n++){
		$rand		= mt_rand(1, $len);
		$retorno 	.= $caracteres[$rand-1];
	}
	
	return $retorno;
}

function week()
{
	return array(
		array('id' => 1, 'name' => 'Domingo'),
		array('id' => 2, 'name' => 'Segunda'),
		array('id' => 3, 'name' => 'Terça'),
		array('id' => 4, 'name' => 'Quarta'),
		array('id' => 5, 'name' => 'Quinta'),
		array('id' => 6, 'name' => 'Sexta'),
		array('id' => 7, 'name' => 'Sábado'),
	);
}
