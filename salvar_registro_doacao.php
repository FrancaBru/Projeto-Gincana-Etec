<?php
	
	$banco = "bd_gincana2";
	$usuario = "root";
	$senha = "";
	$hostname = "localhost";

	$conn = mysql_connect($hostname,$usuario,$senha); 
	        mysql_select_db($banco) or die( "Não foi possível conectar ao banco MySQL");

	$vCPF = $_POST['cpf'];
	$vMaterial = $_POST['material'];
	$vValorDoacao = $_POST['valor'];
    
    // inicio - caculo do valor de pontos da doacao
	$sqlValorRifa = mysql_query("SELECT DISTINCT 
		                                ativ.vl_rifa
		                               ,ativ.qt_pontos
                                   FROM tb_atividade ativ
                                  WHERE ativ.nm_atividade = 'RIFA'
                                    AND ativ.in_ativo = 'S'");

    $Rifa = mysql_fetch_assoc($sqlValorRifa);
    $vPontoRifa = $Rifa['qt_pontos']; 
    $vValorRifa = $Rifa['vl_rifa'];

    $vQtRifa = $vValorDoacao / $vValorRifa;
    
    $vPontosDoacao = $vQtRifa * $vPontoRifa;
    // fim - caculo do valor de pontos da doacao

    // inicio - captura o id do doador
	$sqlDoador = mysql_query("SELECT pes.id_pessoa
		                        FROM tb_pessoa pes
		                       WHERE pes.cpf = $vCPF");
    
    $Doador = mysql_fetch_assoc($sqlDoador);
    $vIdDoador = $Doador['id_pessoa'];
    // fim - captura o id do doador

	$queryInsertDoacao = "INSERT INTO tb_doacao(ds_doacao, vl_doacao, id_user_incl, dt_incl) VALUES(UPPER('$vMaterial'), '$vValorDoacao', 3, sysdate())";
	$inserirDoacao = mysql_query($queryInsertDoacao);

	// inicio - captura id da doacao registrada 
	$sqlDoacao = mysql_query("SELECT max(doa.id_doacao) id_doacao FROM tb_doacao doa");
	$Doacao = mysql_fetch_assoc($sqlDoacao);
	$vIdDoacao = $Doacao['id_doacao'];
	// fim - captura id da doacao registrada

	$queryInsertControl = "INSERT INTO tb_controle_atividade(id_pessoa, id_doacao, qt_pontos, id_user_incl, dt_incl) VALUES('$vIdDoador', '$vIdDoacao', '$vPontosDoacao', 3, sysdate())";
	$inserirControl = mysql_query($queryInsertControl);

	if($inserirDoacao&&$inserirControl) {
		echo "Dados inseridos com sucesso!";
		echo '<br>';
		echo "Deseja voltar para a tela de cadastro de doação?";
		echo '<br>';
		echo '<br>';
		echo '<div class="container droppedHover form-signin botao">';
			echo '<a href="registro_doacao.html">';
				echo '<button class="btn btn-lg btn-primary btn-block" type="reset">SIM</button>';
			echo '</a>';
				echo '<a href="menu_adm.html">';
				echo '<button class="btn btn-lg btn-primary btn-block" type="reset">NÃO</button>';
			echo '</a>';
		echo '</div>';
		} else {
		echo "Não foi possível inserir os dados, tente novamente.";
		// Exibe dados sobre o erro:
		echo "Dados sobre o erro:" . mysql_error();
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	</head>
<body>

</body>
</html>