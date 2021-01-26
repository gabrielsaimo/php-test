<?


?>
<link rel="stylesheet" type="text/css" href="css/style.css">
<meta charset="UTF-8">
<div class="caixa"></div>
<div class="container ">
   <br>
    <form  action="cb.php" method="post" >
        <table class="centro menos-top" >
            <tbody>
            <?if (isset($_GET["id"]) != null ){?>
                <?$pessoa = selectIdPessoa($_GET["id"]);?>
            <?}?>
                <tr>
                    <td class="texto">Nome: </td>
                    <?if(isset($_GET["id"]) != null ){?>
                        <td><input class="input1" id="nome" type="text" name="nome" value="<?=$pessoa["nome"]?>" size="20"></td>
                    <?}else{?>
                        <td><input type="text" name="nome" value="" class="input1"></td>
                    <?}?>
                </tr>
                <tr >
                    <td class="texto1">Sexo: </td>
                    <?if(isset($_GET["id"]) != null ){?>
                        <td><select class="selects" name="sexo" value="">
                            <option value="Maxoxo" >Maxoxo</option>
                            <option value="Femiamia">Femiamia</option>
                        </select>
                        </td>
                    <?}else{?>
                        <td><select class="selects" name="sexo" value="">
                            <option value="Maxoxo">Maxoxo</option>
                            <option value="Femiamia">Femiamia</option>
                        </select>
                        </td>
                    <?}?>
                </tr>
                <tr>
                <?if(isset($_GET["id"]) != null ){?>
   
                    <?}else{?>
                        
                        <td class="texto1">Empresa: </td>
                        <br>
                       <td><select class="selects" name="empresa" value="">
                            <option value="6854">Rubio</option>
                            <option value="6855">Laudo</option>
                            <option value="6856">Pato Enterprise</option>
                            <option value="6858">Inata</option>
                            <option value="6864">Netflix</option>
                            <option value="6865">Reativa</option>
                        </select>
                        </td>
                    <?}?>
                </tr>
                    <?if(isset($_GET["id"]) != null ){?>
                        <td><input type="hidden" name="_acao" value="u" >
                        <td><input type="hidden" name="_modulo" value="pessoa" >
                    <?}else{?>
                        <td><input type="hidden" name="_acao" value="i" >
                        <td><input type="hidden" name="_modulo" value="pessoa" >
                    <?}?>
                <input type="hidden" name="id" value="<?=$pessoa["id"]?> " ></td>
                <td><br><br><br><br><br><input class="enviar btn1 left" type="submit" name="Enviar" value="Enviar" ></td>
                </tr>
            </tbody>
        </table> 
    </form>
</div>
