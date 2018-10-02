<?php
    
    $conecta = mysql_connect("localhost", "root", "")or die("Erro ao conectar!");
    $banco = mysql_select_db("bd_gincana2")or die("Erro ao selecionar BD!");
    

    // atividade selecionada pelo usuario
    $atividade = $_REQUEST['atividade'];

    //$_session['cpf'];   
   // $SESSAO = $_SESSION['cpf'];
    //session_start();
    // INICIO - Captura ID do usuario logado
    // ******BRUNO - Insira o CPF nessa query atraves da SESSAO! *****
    $sqlPessoa = "SELECT pes.id_pessoa
                    FROM tb_pessoa pes 
                   WHERE pes.cpf = '79197411655'";
    $Pessoa = mysql_query($sqlPessoa);
    $vPessoa = mysql_fetch_assoc($Pessoa);
    $vIdPessoa = $vPessoa['id_pessoa'];
    // FIM - Captura ID do usuario logado

    //INICIO - Gerenciamento do Id de controle de atividade en grupo  
    $sqlCtrlGrupo = "SELECT ifnull(max(ctrl.id_controle_grupo),0) + 1 id_controle_grupo FROM tb_controle_atividade ctrl";
    $CtrlGrupo = mysql_query($sqlCtrlGrupo);
    $vCtrlGrupo = mysql_fetch_assoc($CtrlGrupo);
    $vIdGrupo = $vCtrlGrupo['id_controle_grupo'];
    //FIM - Gerenciamento do Id de controle de atividade en grupo

    //
    $sqlLimitePartic = "SELECT DISTINCT ativ.qt_limite_partic, ativ.in_ativ_grupo, ativ.qt_pontos FROM tb_atividade ativ WHERE ativ.nm_atividade = '$atividade'";
    $LimitePartic = mysql_query($sqlLimitePartic);
    $vLimitePartic = mysql_fetch_assoc($LimitePartic);
    $vQtdLimitePartic = $vLimitePartic['qt_limite_partic'];
    $vGrupo = $vLimitePartic['in_ativ_grupo'];
    $vPontos = $vLimitePartic['qt_pontos'];
    //

    // INICIO - Captura o limite da participação da atividade por usuario
    $sqlPartic = "SELECT count(*) qtPartic
                    FROM tb_controle_atividade ctrl
                   INNER JOIN tb_pessoa pes ON ctrl.id_pessoa = pes.id_pessoa
                   INNER JOIN tb_agenda age ON ctrl.id_agenda = age.id_agenda
                   INNER JOIN tb_atividade ativ ON age.id_atividade = ativ.id_atividade
                   WHERE pes.id_pessoa = $vIdPessoa
                     AND ativ.nm_atividade = '$atividade'";
    $Partic = mysql_query($sqlPartic);
    $vPartic = mysql_fetch_assoc($Partic);
    $vQtdPartic = $vPartic['qtPartic'];
    // FIM - Captura o limite da participação da atividade por usuario

    // Informações sobre aagenda e atividade selecionada
    $sql = " SELECT age.id_agenda
                   ,date_format(age.dt_atividade,'%d/%m/%Y') dt_atividade
                   ,age.hr_inicio
                   ,age.hr_fim
                   ,ativ.nm_atividade
              FROM tb_agenda age
             INNER JOIN tb_atividade ativ ON age.id_atividade = ativ.id_atividade
             WHERE NOT EXISTS (SELECT * FROM tb_controle_atividade ctrl WHERE ctrl.id_agenda = age.id_agenda and ctrl.id_pessoa = $vIdPessoa)
               AND ativ.nm_atividade = '$atividade'
             ORDER BY 2,3,4";

    
    // FAZ  O SELECT DO ID DA ATIVIDADE PARA ACHAR O PARTICIPANTE
    /*$sql3 = "SELECT  pes.nm_pessoa
                    ,age.dt_atividade
                    ,age.hr_inicio
                    ,age.hr_fim
                    from tb_pessoa pes
                    inner join tb_controle_atividade cat on pes.id_pessoa = cat.id_pessoa
                    where cat.id_atividade = '$sql'";*/

    //$sql2 = mysql_query($sql);
    $query = mysql_query($sql);
    $qtd = mysql_num_rows($query);

    //$pega = "SELECT * FROM tb_atividade WHERE nm_atividade = '$atividade'";
    //$exibe = mysql_query($pega);
    mysql_close($conecta);
?>

<form class="form-signin" role="form" method="POST" action="salvar_atividade_pessoa.php">
<section class="">

    <header class="">
    
    </header>
    <?php
        if($qtd>0){
    ?> 
        <div>
            <?php
                echo '<table class="table table-hover table_font">';
                    echo '<thead>';
                        echo '<tr>';
                            echo '<th>Data</th>';
                            echo '<th>Horário Inicial</th>';
                            echo '<th>Horário Final</th>';
                            echo '<th></th>';
                        echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                        while($registro = mysql_fetch_array($query)){
                            $vIdAgenda = $registro["id_agenda"];
                            echo '<tr>';
                                echo '<td>'.$registro["dt_atividade"].'</td>';
                                echo '<td>'.$registro["hr_inicio"].'</td>';
                                echo '<td>'.$registro["hr_fim"].'</td>';
                                //echo '<td>'.'<button type="submit"> Registrar </button>'.'</td>';
                                echo '<td>'."<a href=salvar_atividade_pessoa.php?pessoa=$vIdPessoa&limite=$vQtdLimitePartic&participacao=$vQtdPartic&agenda=$vIdAgenda&ingrupo=$vGrupo&ponto=$vPontos&idgrupo=$vIdGrupo&$vIdGrupo>Registrar</a>".'</td>';
                                /*echo '<td class="deixarOculto"><input type="text" name="pessoa" value="'.$vIdPessoa.'"></td>';
                                echo '<td class="deixarOculto"><input type="text" name="limite" value="'.$vQtdLimitePartic.'"></td>';
                                echo '<td class="deixarOculto"><input type="text" name="participacao" value="'.$vQtdPartic.'"></td>';
                                echo '<td class="deixarOculto"><input type="text" name="agenda" value="'.$vIdAgenda.'"></td>';
                                echo '<td class="deixarOculto"><input type="text" name="ingrupo" value="'.$vGrupo.'"></td>';
                                echo '<td class="deixarOculto"><input type="text" name="ponto" value="'.$vPontos.'"></td>'; 
                                echo '<td class="deixarOculto"><input type="text" name="idgrupo" value="'.$vIdGrupo.'"></td>';
                                echo '<td class="deixarOculto"><input type="text" name="nmatividade" value="'.$atividade.'"></td>';*/
                            echo '</tr>';
                        }
                    echo '</tbody>';
                echo '</table>'
            ?>
        </div>
    <?php 
        }else{
    ?>
        <h4>Nao foram encontrados registros com esta palavra.</h4>
    <?php 
        }
    ?>
</section>
</form>