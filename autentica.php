<?php
	
	$banco = "bd_gincana2";
	$usuario = "root";
	$senha = "";
	$hostname = "localhost";

	$conn = mysql_connect($hostname,$usuario,$senha); 
			mysql_select_db($banco) or die( "Não foi possível conectar ao banco MySQL");		

?>

<html>
<head>

	<meta charset = "UTF-8">
	<title>Autenticando Usuário</title>
	<script type="text/javascript" >
		function loginsucessfully(){
			setTimeout("window.location='menu_adm.html'", 2000);
		}	
		

		function loginFailed(){
			setTimeout("window.location = 'index.html'", 2000);
		}
	
						
	</script>
</head>
<body>

<?php
	
	$cpf = $_REQUEST['cpf'];
	$sql= mysql_query("SELECT * FROM TB_PESSOA WHERE cpf = '$cpf'");
	$row = mysql_num_rows($sql);

	// VERIFICA FUNÇÃO DA  PESSOA

	$exibeFunc = mysql_query("SELECT func.nm_func
				    from tb_pessoa pes
				   inner join tb_funcao func on pes.id_func = func.id_func
				   where pes.cpf = '$cpf'");
	$resultado  =  mysql_num_rows($exibeFunc); 




	if($row > 0){
		session_start();
		$_session['cpf'] = $_POST['cpf'];	
		// ADM E DBA
		 if($cpf == '30022725822' || $cpf == '57108158531'){
		 	header("location: carregaLogin.php");
		 }
		 //  AUXILIAR
		 if($cpf == '39830433480'){
		 	header("location: carregaAuxi.html");
		 }

		 //ALUNO
		 if($cpf == '79197411655'){
		 	header("location: menu_participante.html");
		 }
			
	}else{
		echo "CPF INVÁLIDO... Aguarde";
		echo "<script>loginFailed()</script>";
	}

	//	$_session['cpf'] = $_POST['cpf'];
	//	 if(mysql_free_result($resultado ) == 'dba'){			
	//		header("location: carregaLogin.php");
	//	}
	//	 if(mysql_free_result($resultado ) == 'ALUNO_AUX'){
	//		header("location: ../Menu_Auxiliar/menu_auxiliar.html");
	//	}
	
?>
</body>
</html>
<?php
//
// enquanto uma linha de dados existir, coloca esta linha em $ row como uma matriz associativa 
// Nota: Se você está esperando apenas uma linha, não há necessidade de usar um loop 
// Nota: Se você colocar extract ($ row); dentro do loop, você 
// seguida, criar $ userid $ fullname, e US $ userstatus  



	
/*1	dba,2	ADM_GINCANA

3	ALUNO,4	PROFESSOR

5	ALUNO_AUX,PROFESSOR_AUX,7,PROFESSOR_PAD
8	ALUNO_ADM
9	ALUNO_REP*/
?>