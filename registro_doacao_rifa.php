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

		<nav>
			
		</nav>
		<!-- conteudo principal !-->
		<main>
			<h1 class="titulo_tela"><i>Registro de Doações e Rifa<i></h1>

			<br>
			<div class="container droppedHover">
				<form name="formulario" action="cadastraAtiv.php" method="POST">
					<div class="campos_princ">
						<p><b>Dados do participante</b></p>
					
						<div class="campos_pri">
							<p> CPF do participante
							<input type="text" name="cpf" class="form-control" placeholder="" required="" autofocus="" contenteditable="false">
							<a href="#">
									<button type="button" class="btn btn-primary" id="botao_search">
                                		<span class="glyphicon glyphicon-search"></span>
                            		</button>
                            </a></p>
						</div>

						<div class="campos_sec">
					    	<p> Escolha o curso
					    	<select name="curso" class="form-control">
        						<option value="">        Escolha... </option>
        						<option value="tecnico"> Tecnico    </option>
        						<option value="Médio">     Médio    </option>
        						<option value="Todos">     Todos    </option>
        					</select></p>
						</div>

						<div class="campos_terc">
					    	<p> Escolha a turma
					    	<select name="sexo" class="form-control">
        						<option value="">        Escolha... </option>
        						<option value="tecnico"> Tecnico    </option>
        						<option value="Médio">     Médio    </option>
        						<option value="Todos">     Todos    </option>
        					</select></p>
						</div>

						<br>
						<div class="campos_qua">
						<p><b>Dados da doação</b></p>
						</div>
						<div class="campos_pri">
							<p> Material doado
							<input type="text" class="form-control" name="nomeAtiv" placeholder="" required="" autofocus="" contenteditable="false" spellcheck="true">
								<a href="atividade_registrada.php">
									<button type="button" class="btn btn-primary" id="botao_search">
                                		<span class="glyphicon glyphicon-search"></span>
                            		</button>
                            	</a></p>
						</div>

						<div class="campos_qua">
					    	<p> Valor
					    	<input type="text" name="pontos" class="form-control" placeholder="" required="" autofocus="" contenteditable="false"></p>
						</div>

						
						<div class="botao">
							<button class="btn btn-lg btn-primary btn-block" type="submit">Registrar</button>
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