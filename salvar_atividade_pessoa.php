<?php

	$banco = "bd_gincana2";
	$usuario = "root";
	$senha = "";
	$hostname = "localhost";

	$conn = mysql_connect($hostname,$usuario,$senha); 
	        mysql_select_db($banco) or die("Não foi possível conectar ao banco MySQL");

	$vIdPessoa = $_GET['pessoa'];
	$vQtdLimitePartic = $_GET['limite'];
	$vQtdPartic = $_GET['participacao'];
	$vIdAgenda = $_GET['agenda'];
	$vGrupo = $_GET['ingrupo'];
	$vIdGrupo = $_GET['idgrupo'];
	$vPontos = 0; //$_GET['ponto'];
    
    echo '<br>';   
    echo '<br>';

    if($vGrupo == 'S'){
    	$inserir = "INSERT INTO tb_controle_atividade(id_pessoa, id_agenda, id_controle_grupo, qt_pontos, dt_incl, id_user_incl)
                     VALUES('$vIdPessoa', '$vIdAgenda', '$vIdGrupo', '$vPontos', sysdate(), '$vIdPessoa')";
    }else{
    	$inserir = "INSERT INTO tb_controle_atividade(id_pessoa, id_agenda, qt_pontos, dt_incl, id_user_incl)
                     VALUES('$vIdPessoa', '$vIdAgenda', '$vPontos', sysdate(), '$vIdPessoa')";
    }


	$inserir2 = mysql_query($inserir);


		if($inserir2) {
			echo "Agenda registrada com sucesso!";
			echo '<br>';
			echo "Deseja agendar outra atividade?";
			echo '<br>';
			echo '<div class="container droppedHover form-signin botao">';
				echo '<a href="registrar_atividade_pessoa.php">';
					echo '<button class="btn btn-lg btn-primary btn-block" type="reset">SIM</button>';
				echo '</a>';
				echo '<a href="menu_participante.html">';
					echo '<button class="btn btn-lg btn-primary btn-block" type="reset">NÃO</button>';
				echo '</a>';
			echo '</div>';
			} else {
			echo "Não foi possível registrar os pontos, tente novamente.";
			echo '<br>';
			// Exibe dados sobre o erro:
			echo "Dados sobre o erro:".'<br>'. mysql_error();
		}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset = "utf-8">
</head>
<body>

</body>
</html>