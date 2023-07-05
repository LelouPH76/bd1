<?php
include_once "conexao.php";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($dados['id'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário enviar o id!</div>"];
} elseif (empty($dados['nome'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário enviar o nome!</div>"];
} elseif (empty($dados['descricao'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário enviar a descrição!</div>"];
}elseif (empty($dados['email'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário enviar o e-mail!</div>"];
}else {
    $query_edit = "UPDATE editora SET nome=:nome, descricao=:descricao, email=:email WHERE id=:id";
    $edit_editora = $mysqli->prepare($query_edit);
    $edit_editora->bindParam(':nome', $dados['nome']);
    $edit_editora->bindParam(':descricao', $dados['descricao']);
    $edit_editora->bindParam(':email', $dados['email']);
    $edit_editora->bindParam(':id', $dados['id']);

    if($edit_editora->execute()){
        $retorna = ['status' => true, 'msg' => "<div class='alert alert-success' role='alert'>Usuário editado com sucesso!</div>"];
    }else{
        $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário enviar o e-mail!</div>"];
    }    
}

echo json_encode($retorna);