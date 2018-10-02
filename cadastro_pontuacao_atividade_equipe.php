<?php
	
	$banco = "bd_gincana2";
	$usuario = "root";
	$senha = "";
	$hostname = "localhost";

	$conn = mysql_connect($hostname,$usuario,$senha); 
			mysql_select_db($banco) or die( "Não foi possível conectar ao banco MySQL");
		

	$sql = mysql_query("SELECT DISTINCT
       						   ativ.nm_atividade
      						  ,ativ.id_atividade 
                          FROM tb_atividade ativ
                         INNER JOIN tb_agenda age ON ativ.id_atividade = age.id_atividade 
                         INNER JOIN tb_controle_atividade ctrl ON age.id_agenda = ctrl.id_agenda
                         WHERE ativ.in_ativo = 'S' 
                           AND ativ.in_ativ_grupo = 'S'
                           AND ctrl.qt_pontos = 0
                           AND ativ.nm_atividade != 'RIFA';");
?>
<DOCTYPE html>
<html lang="PT-BR">
	<head>
		<title>SGEA</title>
		<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		    <script src="js\jquery.js"></script>
		<link rel="stylesheet" href="css/bootstrap.min.css">
	
	</head>

	<body>

		<nav>
			
		</nav>
		<!-- conteudo principal !-->
		<main>
			<h3 class="titulo_table"><i>Cadastro Pontuação<i></h3>
			<h4 class="titulo_table"><i>Atividade em Equipe<i></h4>			
		

			<br>
			<div class="container droppedHover">
				<form class="form-signin" role="form" method="post">
					<nav class="menu_table">
						<p><a href="#">HOME</a></p>
						<p><a class="submenu" href="menu_auxiliar.html">MENU</a></p>
					</nav>
					<hr align="left" width="100%" size="1" class="linha">
					
					<br>
					<div class="campos_pri">
						<p>Nome da Atividade
						<select id="atividade" name="form" class="form-control" autofocus="true">
							<?php
									echo '<option>Selecionar...</option>';
								while($opc = mysql_fetch_array($sql)){
									$vID = $opc["id_atividade"];
									echo '<option>'.$opc["nm_atividade"].'</option>';
								}
							?>
						</select>
							<button type="button" class="btn btn-primary botao_search" id="buscar">
                            	<span class="glyphicon glyphicon-search"></span>
                        	</button>
						</p>
					</div>

					<div>
						<p>Selecione as Equipes
						<div id="dados">Aqui aparecerá os dados buscados...</div>
							<script>
				            	function buscar(atividade)
				            	{
				                	var page = "busca_equipe.php";
				                	$.ajax
				                        ({
				                            type: 'POST',
				                            dataType: 'html',
				                            url: page,
				                            beforeSend: function () {
				                               	$("#dados").html("Carregando...");
				                            },
				                            data: {atividade: atividade},
				                            success: function (msg)
				                            {
				                                $("#dados").html(msg);
				                            }
				                        });
				            	}
				            	
				            	$('#buscar').click(function () {
				                	buscar($("#atividade").val())
				            	});
      			  			</script>
					</div>

				</form>
			</div>

		</main>
		
		<!-- rodapé !-->
		<footer>
			
		</footer>

		<!--<script src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/script.js"></script>!-->
	</body>

</html>