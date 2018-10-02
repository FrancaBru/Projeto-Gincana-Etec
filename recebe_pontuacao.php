
<?php

	$banco = "bd_gincana2";
	$usuario = "root";
	$senha = "";
	$hostname = "localhost";

	$conn = mysql_connect($hostname,$usuario,$senha); 
			mysql_select_db($banco) or die( "Não foi possível conectar ao banco MySQL");

	// PEGA O VALOR DA SELECT NO FORMULARIO E AMARZENA NA VARIAVEL NOME
					$nome = $_POST['escolha'];
					//FAZ SELECT NO BANCO DO ID DA ATIVIDADE SELECIONADA
					$query = "SELECT id_atividade FROM tb_atividade WHERE nm_atividade = '$nome'";

					$ativId = mysql_query($query);
					$rows=mysql_num_rows($ativId);

					$sql = "SELECT * FROM tb_agenda where id_atividade LIKE'$rows'";

					//FAZ SELECT NO BANCO E PEGA TODOS OS HORARIOS
					//$query2 = "SELECT hr_inicio, hr_fim from tb_agenda where id_atividade LIKE '$ativId'";
?>

<html>
<head>
	<meta charset = 'utf-8'>
</head>
	<table border =1>
		<tr>
			<td>Inicio</td>
			<td>Fim</td>
		
		</tr>
<?php
	
	function exibeHr(){
		$result = mysql_query($sql);
		while ($tbl = mysql_fetch_array($result)){
		$inicio = $tbl["hr_inicio"];
		$fim = $tbl["hr_fim"];

		echo "$inicio";
		echo "fim";
		}
	}
	/*$result = mysql_query($sql);

	while ($tbl = mysql_fetch_array($result)){
		$inicio = $tbl["hr_inicio"];
		$fim = $tbl["hr_fim"];
	
		echo "<TR>";
		echo "<TD>$inicio</TD>";		
		echo "<TD>$fim</TD>";		
		echo "</TR>";
	}*/
?>
</table>
	<BR><A HREF="inserir.php">Clique para inserir um novo registro</A>
</html>
		