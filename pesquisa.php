
<div class="caixa"></div>
<table  class="table menos-top">
    <thead class="thead-light">
        <tr>
            <?
            if(!empty($_GET)){
                foreach($_GET['_colunas'] as $v) {
                    //listas os campos enviados pelo get para montar a tabela de pesquisa
                    echo '<td class="bb">'.$v.' </td>';

                }
            }
            ?>
        </tr>
    </thead>
    <tbody>
        <?
            //usar os campos de get['coluna'] para buscar na tabela (get[_modulo]) os dados cadastrados la.. apresentaremos apenas as colunas definidas no bloco php anterior.
            $banco = abrirBanco();
            $modulo = $_GET['_modulo'];
            $q = $banco->query("SELECT * FROM " .$modulo );
            $banco->close();
            if($_GET['_modulo']=='empresas'){
                while($row = mysqli_fetch_array($q)) { ?>
                    <tr class="bb">
                    <td class="bb"><?= $row["idempresa"] ?></td>
                    <td class="bb"><?= $row["empresa"] ?></td>
                    <td><a class="btn fundo-amarelo" href="?_modulo=empresa&empresa=<?=$row['empresa']?>&_acao=u&id=<?=$row["idempresa"]?>"><b>Editar</b></a> </td>
                    <td> <button class="btn fundo-vermelho" id="<?=$row["idempresa"]?>" onclick="deletar(this)"><b>Excluir</b></button></td>
                    </tr>
                    <? }
                }

            while($row = mysqli_fetch_array($q)) {//desenhar apenas as colunas?>
                <tr >    
                <td class="bb"><?=$row["nome"]?></td>
                <td class="bb"><?=$row["sexo"]?></td>
                <td class="bb"><?=$row["criadoem"]?></td>
                <td class="bb"><?=$row["alteradoem"]?></td>
                <td><a class="btn fundo-amarelo" href="?_modulo=<?=$_GET['_modulo']?>&_acao=r&id=<?=$row["id"]?>"><b>Editar</b></a> </td>
                <td> <button class="btn fundo-vermelho" onclick="deletar(this)" id="<?=$row["id"]?>"><b>Excluir</b></button></td>
                </tr>
                
            <?}
        ?>
        <tr>
            <td>
                <a href="?_modulo=<?=$_GET['_modulo'];?>&_acao=u&<?=$_GET['pk'];?>=<?=$row[$_GET['pk']];?>&_pk=<?=$_GET['pk'];?>"><b></b></a>
                <!--  ?_modulo=pessoa&_acao=u&idpessoa=2&_pk=idpessoa -->
            </td>
        </tr> 
    </tbody>
</table>
    <br>
    <div style="display: flex; justify-content: center;">
    </div>
    <script>

        function deletar(vthis){
            var id=$(vthis).attr("id");
            $.ajax({
                url: 'cb.php',
                cache : false,
                type: 'POST',
                dataType :'text',
                data:{ id,_acao:"d",_modulo:"<?=$modulo?>"},
                success: function(data,text,jqxhr) {
                    location.reload();
                },
                error: function(r){
                    alert('deu erro');
                }
            });
        }

    </script>