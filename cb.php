<?
        //verifica qual modulo foi recebido
    if($_REQUEST['_modulo'] == 'pessoa'){
        $modulo = 'pessoa';
    }else{
        $modulo = 'empresas';
    }
        //verifica se recebe modulo
    if(isset($_REQUEST['_modulo'])){ 
        
        //indentifica a acao a ser feita
        if($_REQUEST['_acao']=="u"){ 
            $acaoss="UPDATE ";
        }
        elseif($_REQUEST['_acao']=="i"){
            $acaoss="INSERT INTO ";
        }
        elseif($_REQUEST['_acao']=="d"){
            $acaoss="DELETE FROM ";
        }
        //define qual finçao sera realizada 
        if($_REQUEST['_modulo']=="empresas" && $_REQUEST['_acao']=="u"){
            alterarPessoa($modulo);
        }
        elseif($_REQUEST['_modulo']=="empresas" && $_REQUEST['_acao']=="i"){
            inserirPessoa($modulo);
        }
        elseif($_REQUEST['_modulo']=="empresas" && $_REQUEST['_acao']=="d"){
            excluirPessoa($modulo);
        }
        elseif($_REQUEST['_modulo']=="pessoa" && $_REQUEST['_acao']=="u"){
            alterarPessoa($modulo);
        }
        elseif($_REQUEST['_modulo']=="pessoa" && $_REQUEST['_acao']=="i"){
            $obj = "(nome,sexo,criadoem,alteradoem,idempresa)";
            inserirPessoa($modulo); 
        }
        elseif($_REQUEST['_modulo']=="pessoa" && $_REQUEST['_acao']=="d"){
            excluirPessoa($modulo);
        }
        
    }

        //funçao que abre o banco de dados MSQLI
        function abrirBanco() {
            $conexao = new mysqli("localhost", "root", "root", "crud");
            return $conexao;
        }

        function inserirPessoa($modulo) { 
            if($_REQUEST['nome']) {
                global $acaoss;
                global $obj;
                $sql = $acaoss. $modulo. $obj. " VALUES ('{$_REQUEST["nome"]}','{$_REQUEST["sexo"]}',sysdate(),sysdate(),'{$_REQUEST["empresa"]}')";
            }else{
                global $acaoss;
                $sql = $acaoss." $modulo (empresa) 
                VALUES ('{$_REQUEST["empresa"]}')";
            }
            banco($sql);
            voltarIndex(); 
        }

        function alterarPessoa($modulo) {
            global $acaoss;
            if($_REQUEST['_modulo']=="empresas"){
                $sql = $acaoss." $modulo SET empresa='{$_REQUEST["empresa"]}' WHERE idempresa='{$_REQUEST["idempresa"]}'";
            }else{
                $sql = $acaoss." $modulo SET nome='{$_REQUEST["nome"]}',sexo='{$_REQUEST["sexo"]}',alteradoem=now() WHERE id='{$_REQUEST["id"]}'";
        }
            banco($sql);
            voltarIndex();
        }

        function excluirPessoa($modulo) {
            global $acaoss;
            if($_REQUEST['_acao']=='d' && $_REQUEST['_modulo']=="empresas"){
                $sql = $acaoss. $modulo." WHERE idempresa='{$_REQUEST["id"]}'";
            }else{
                $sql = $acaoss. $modulo." WHERE id='{$_REQUEST["id"]}'";
            }
            banco($sql);
            voltarIndex();
        }

        function selectAllPessoa() {
            $banco = abrirBanco();
            $sql = "SELECT p.id,p.nome,DATE_FORMAT(p.criadoem,'%d/%m/%Y %H:%i:%s') as criadoem,DATE_FORMAT(p.alteradoem,'%d/%m/%Y %H:%i:%s') as alteradoem,p.sexo,e.empresa FROM pessoa p JOIN empresas e on (p.idempresa = e.idempresa) ORDER BY p.nome";
            $resultado = $banco->query($sql) or die ('erro no sql :'.mysqli_error($banco));
            $banco->close();
            while($row = mysqli_fetch_array($resultado)) {
                $grupo[] = $row;
            }
            return $grupo;
        }

        function selectIdPessoa($id) {
            $banco = abrirBanco();
            $sql = "SELECT * FROM pessoa WHERE id=".$id;
            $resultado = $banco->query($sql) or die ('erro no sql :'.mysqli_error($banco));
            $banco->close();
            $pessoa = mysqli_fetch_assoc($resultado);
            return $pessoa;
        }

        function voltarIndex(){
            if($_REQUEST['_modulo']=="pessoa"){
                header("Location:index.php?_modulo=pessoa&_colunas[]=nome&_colunas[]=sexo&_colunas[]=criadoem&_colunas[]=alteradoem");
            }else{
                header("Location:index.php?_modulo=empresas&_colunas[]=idempresa&_colunas[]=empresa");
            }
            
        }
        //funçao para abrir e fechar o banco de dados
        function banco($sql){
            $banco = abrirBanco();
            $banco->query($sql) or die ('erro no sql :'.mysqli_error($banco));
            $banco->close();
            voltarIndex();
        } 

    ?>