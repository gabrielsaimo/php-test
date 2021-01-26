
<link rel="stylesheet" type="text/css" href="css/style.css">
<meta charset="UTF-8">

<div class="caixa"></div>
<div class="container menos-top" style="margin-left: 23%; ">
    <form  action="cb.php" method="get" >
        <table>
            <tbody>
            
                <td><input type="hidden" name="_modulo" value="empresas" >
                <td><input type="submit" class="btn2"style="margin-left: 295%;" ></td>
                <td class="texto">Empresa: </td>          
                <?if($_REQUEST['_acao']=='u'){ ?>
            <td><input type="hidden" name="_acao" value="u" >
            <td><input type="text" name="empresa" value="<?=$_REQUEST['empresa']?>" class="input1" placeholder="digite a empresa aqui..." ></td>
            <input type="hidden" name="idempresa" value="<?=$_REQUEST['id']?>" >
        <?}else{?>
            <td><input type="hidden" name="_acao" value="i" >
            <input type="hidden" name="idempresa" value="" >
            <td><input type="text" name="empresa" value="" class="input1" placeholder="digite a empresa aqui..."></td>
        <?}?>
            </tbody>
        </table>
    </form>
</div>

<div class="centro " style=" margin-top: 20%;">
<img src="img/pato.gif" style="width: 100px; " />
</div>