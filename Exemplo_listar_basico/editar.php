<?php
include_once "conexao.php"; 
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
if(empty($dados['id'])){
$retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>
Cadê o ID?</div>"];
} /*elseif(empty($dados['nome'])){
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>
    Cadê o nome?</div>"];
} elseif(empty($dados['email'])){
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>
    Cadê o email?</div>"];
} */else {

    $query = "UPDATE usuarios SET nome=:nome, email=:email WHERE id=:id";
    $edit_user = $conn->prepare($query);
    $edit_user->bindParam(':nome', $dados['nome']); 
    $edit_user->bindParam(':email', $dados['email']);
    $edit_user->bindParam(':id', $dados['id']);
    
    if($edit_user->execute()){
        $retorna = ['status' => true, 'msg' => "<div class='alert alert-sucess' role='alert'>
        Cadê o nome?</div>"];
    }else{
        $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>
        deu ruim</div>"];  
    }
    $retorna = ['status' => true, 'id' => $dados['id']];
}
echo json_encode($retorna);
?>