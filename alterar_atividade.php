<DOCTYPE html>
<html lang="PT-BR">
	<head>
		<title>SGEA</title>
		<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<img src="img\etec01.png" alt="ETEC" class="img_principal">
		<script type="text/javascript">
			function validaform(){

				var tamanho_nome = document.forms["formulario2"].nomeAtiv.value.length;
				if(tamanho_nome < 3 || tamanho_nome > 64 ){
					alert("O campo nome da atividade deve ter entre 3 e 64 caracteres.");					
					return false;
				}
		

				var qtdMin = document.forms["formulario2"].qtdMin.value;
				if(isNaN(qtdMin)){
					alert("O campo Quantidade Mínima precisa ser preenchido corretamente!");
					return false;
				}

				var qtdMax = document.forms["formulario2"].qtdMax.value;
				if(isNaN(qtdMax)){
					alert("O campo Quantidade Máxima precisa ser preenchido corretamente!");
					return false;
				}

				var limite = document.forms["formulario2"].limite.value;
				if(isNaN(limite)){
					alert("O campo Limite precisa ser preenchido corretamente!");
					return false;
				}

				var pontos = document.forms["formulario2"].pontos.value;
				if(isNaN(pontos)){
					alert("O campo Pontos precisa ser preenchido corretamente!");
					return false;
				}

				var curso = document.forms["formulario2"].curso.selectIndex;
				if(curso == 0){
					alert("Escolha um curso!");
					return false;
				}else if(curso == 1){
					curso = 'tecnico';
				}else if(curso == 2){
					curso = 'medio';
				}else{
					curso = 'todos';
				}

				var sexo = document.forms["formulario2"].sexo.selectIndex;
				if(sexo == 0){
					sexo = 'T';
				}else if(sexo == 1){
					sexo = 'M';
				}else{
					sexo = 'F';
				}

				var grupo = document.forms["formulario2"].grupo.value;
				var inRifa = document.forms["formulario2"].inRifa.value;
				var valorRifa = document.forms["formulario2"].valorRifa.value;
				
				var descricao = document.forms["formulario2"].descricao.value.length;
				if(descricao < 5){
					alert("O campo descricao precisa ser preenchido corretamente!");
					return false;
				}

				document.forms["formulario2"].submit();
			}

			function limpar(){
				var vNome = document.forms["formulario2"].nomeAtiv.value.length;
				if(vNome > 0){
					document.forms["formulario2"].nomeAtiv.value = "";
				}
			}
		</script>		
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
            	
    	$sqlListaAtividade = mysql_query("SELECT ativ.nm_atividade
      											,ativ.qt_min_pessoa
      											,ativ.qt_max_pessoa
      											,ativ.qt_limite_partic
      											,ativ.qt_pontos
      											,ativ.nm_curso
      											,ativ.in_sexo
      											,ativ.in_ativ_grupo
      											,ativ.ds_regra
      											,ativ.vl_rifa
  											FROM tb_atividade ativ
 										   WHERE ativ.id_atividade = $id");
		
		$registro = mysql_fetch_array($sqlListaAtividade);

		$nm_atividade = $registro["nm_atividade"];
      	$qt_min_pessoa = $registro["qt_min_pessoa"];
      	$qt_max_pessoa = $registro["qt_max_pessoa"];
      	$qt_limite_partic = $registro["qt_limite_partic"];
      	$qt_pontos = $registro["qt_pontos"];
      	$nm_curso = $registro["nm_curso"];
      	$in_sexo = $registro["in_sexo"];
      	$in_ativ_grupo = $registro["in_ativ_grupo"];
      	$ds_regra = $registro["ds_regra"];
      	$vl_rifa = $registro["vl_rifa"];

      	if($in_sexo == 'M'){
      		$sexo = 'Masculino';	
      	}else if($in_sexo == 'F'){
      		$sexo = 'Feminino';
      	}else{
      		$sexo = 'Misto';
      	}
	?>

		<nav>
			
		</nav>
		<!-- conteudo principal !-->
		<main>
			<h1 class="titulo_tela"><i>Cadastro de Atividades<i></h1>

			<br>
			<div class="container droppedHover">
				<form name="formulario2" action="salvar_alteracao_atividade.php" method="POST">
					
					<div class="campos_princ">
						<div class="campos_pri">
							<p> Nome Atividade
							<input type="text" class="form-control" name="nomeAtiv" placeholder="" required="" autofocus="" contenteditable="false" spellcheck="true" value="<?php echo $nm_atividade; ?>">
								<a href="atividade_registrada.php">
									<button type="button" class="btn btn-primary" id="botao_search">
                                		<span class="glyphicon glyphicon-search"></span>
                            		</button>
                            	</a></p>
						</div>
						<br><br>
						<div class="campos_sec">
							<p> Quantidade Minima
							<?php
								if($vl_rifa > 0){
									echo '<input type="text" name="qtdMin" class="form-control" id="text-input-qt_min" placeholder="" required="" autofocus="" contenteditable="false" value="" disabled="disabled">';
								}else{
									echo '<input type="text" name="qtdMin" class="form-control" id="text-input-qt_min" placeholder="" required="" autofocus="" contenteditable="false" value="'.$qt_min_pessoa.'">';
								}
							 ?>
							</p>
						</div>

						<div class="campos_terc">
							<p> Quantidade Maxima
							<?php 
								if($vl_rifa > 0){
									echo '<input type="text" name="qtdMax" class="form-control" id="text-input-qt_max" placeholder="" required="" autofocus="" contenteditable="false" value="" disabled="disabled">';
								}else{
									echo '<input type="text" name="qtdMax" class="form-control" id="text-input-qt_max" placeholder="" required="" autofocus="" contenteditable="false" value="'.$qt_max_pessoa.'">';	
								}
							?>
					    	</p>
					    </div>

					    <div class="campos_terc">
							<p> Limite de participação
							<?php
								if($vl_rifa > 0 ){
									echo '<input type="text" name="limite" class="form-control" id="text-input-limite" placeholder="" required="" autofocus="" contenteditable="false" value="" disabled="disabled">';
								}else{
									echo '<input type="text" name="limite" class="form-control" id="text-input-limite" placeholder="" required="" autofocus="" contenteditable="false" value="'.$qt_limite_partic.'">';
								}
							?>
					    	</p>
					    </div>

					    <div class="campos_sec">
					    	<p> Pontos
					    	<input type="text" name="pontos" class="form-control" placeholder="" required="" autofocus="" contenteditable="false" value="<?php echo $qt_pontos; ?>"></p>
						</div>

						<div class="campos_terc">
					    	<p> Escolha do curso
					    	<select name="curso" class="form-control">
        						<option value="<?php echo $nm_curso;?>"><?php echo $nm_curso; ?></option>
        						<option value="Tecnico"> Tecnico  </option>
        						<option value="Médio">     Médio  </option>
        						<option value="Todos">     Todos  </option>
        					</select></p>
						</div>

						<div class="campos_terc">
					    	<p> Sexo
					    	<select name="sexo" class="form-control">
					    		<option value="<?php echo $in_sexo;?>"><?php echo $sexo; ?></option>
        						<option value="T">     Misto  </option>
        						<option value="M"> Masculino  </option>
        						<option value="F">  Feminino  </option>
        					</select></p>
						</div>

						<br><br>
						<div class="form-signin campos_qua">
							<?php
								if($in_ativ_grupo == 'S'){
									echo '<label> <input name="grupo" value="S" type="checkbox" checked="checked"/>Atividade em  Grupo?</label>';
								}else{
									echo '<label> <input name="grupo" value="S" type="checkbox" />Atividade em  Grupo?</label>';
								}
							?>
						</div>

						<br>
						<div>
							<p> Descrição da regra da atividade
        					<textarea name="descricao" rows="5" cols="50" maxlength="3000" class="form-control" placeholder="" required="" contenteditable="false"  ><?php echo $ds_regra; ?></textarea></p>
						</div>

						<div class="form-signin">
							<?php
								if($vl_rifa > 0){
									echo '<label> <input name="inRifa" type="checkbox" id="check-box-rifa" checked="checked"/>Rifa?</label>';
								}else{
									echo '<label> <input name="inRifa" type="checkbox" id="check-box-rifa"/>Rifa?</label>';
								}
							?>
						</div>

						<div class="campos_qua">
							<p> Valor da rifa
							<?php
								if($vl_rifa > 0){
									echo '<input type="text" name="valorRifa" class="form-control" id="text-input-rifa" placeholder="" contenteditable="false" value="'.$vl_rifa.'">';
								}else{
									echo '<input type="text" name="valorRifa" class="form-control" id="text-input-rifa" placeholder="" contenteditable="false" disabled="false" value="">';
								}
							?>
					    	</p>
						</div>

						<div class="deixarOculto">
							<?php
								echo '<input type="text" name="id" value="'.$id.'">';
							?>
						</div>

						<div class="botao">
							<button class="btn btn-lg btn-primary btn-block" type="submit" onClick="validaform();">Atualizar</button>
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