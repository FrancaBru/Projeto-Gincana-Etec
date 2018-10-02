<DOCTYPE html>
<html lang="PT-BR">
	<head>
		<title>SGEA</title>
		<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<img src="img\etec01.png" alt="ETEC" class="img_principal">	
	</head>

	<body>

	<?php
		$banco = "bd_gincana2";
    	$usuario = "root";
    	$senha = "";
    	$hostname = "localhost";

    	$conn = mysql_connect($hostname,$usuario,$senha); 
            	mysql_select_db($banco) or die("Não foi possível conectar ao banco MySQL");

        $id = $_GET['id'];     	
            	
    	$sqlListaAtividade = mysql_query("SELECT ativ.id_atividade
	  											,ativ.nm_atividade
      											,age.id_agenda
      											,age.dt_atividade
      											,age.hr_inicio
      											,age.hr_fim
 											FROM tb_atividade ativ 
 									  LEFT JOIN tb_agenda age ON ativ.id_atividade = age.id_atividade
 										   WHERE ativ.id_atividade = $id");
		
		$registro = mysql_fetch_array($sqlListaAtividade);

		$nmAtividade = $registro["nm_atividade"];
      	$idAgenda =  $registro["id_agenda"];
      	$dtAtividade = $registro["dt_atividade"];
      	$hrInicio = $registro["hr_inicio"];
      	$hrFim = $registro["hr_fim"];
	?>

		<nav>
			
		</nav>
		<!-- conteudo principal !-->
		<main>
			
			<h1 class="titulo_tela"><i>Agenda das Atividades<i></h1>
			<!-- LINK PARA LOGOUT DA PAGINA-->
			<a href="../Logout/logout.php">Sair</a>

			<br>
			<div class="container droppedHover">
				<form class="form-signin" role="form" name="opc" method="post" action="salvar_alteracao_agendamento.php">
					<div class="campos_princ">
						<div class="campos_pri">
							<p> Nome da Atividade
							<input type="text" name="nm_atividade" class="form-control" value="<?php echo $nmAtividade; ?>">
							<a href="lista_atividade_agendamento.php">
								<button type="button" class="btn btn-primary" id="botao_search">
                                	<span class="glyphicon glyphicon-search"></span>
                            	</button>
                            </a></p>
						</div>						

						<div class="campos_sec">
							<p> Escolha uma data
							<input type="date" name="data" class="form-control" value="<?php echo $dtAtividade; ?>"></p>
						</div>

						<div class="form-signin campos_terc">
							<p> Horario inicial
							<input type="time" name="hrIncial" class="form-control" value="<?php echo $hrInicio; ?>"></p>
						</div>

						<div class="form-signin campos_qui">
							<p> Horario final
							<input type="time" name="hrFinal" class="form-control" value="<?php echo $hrFim; ?>"></p>
						</div>

						<div class="deixarOculto">
							<?php
								echo '<input type="text" name="id" value="'.$id.'">';
								echo '<input type="text" name="idAgenda" value="'.$idAgenda.'">';
							?>
						</div>

						<br><br>
						<div class="botao">
							<button class="btn btn-lg btn-primary btn-block"  type="submit">Atualizar</button>
						</div>

					</div>
				</form>
			</div>

		</main>
		
		<!-- rodapé !-->
		<footer>
			
		</footer>

		<script src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/script.js"></script>

	</body>
</html>