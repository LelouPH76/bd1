<?php

// Incluir a conexao com o banco de dados
include_once "conexao.php";

// Receber o id do regitro
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

//$id = "";

if (!empty($id)) {
    try {
        // Desabilitar temporariamente a verificação de chaves estrangeiras
        $mysqli->query('SET FOREIGN_KEY_CHECKS = 0');

        // Excluir o registro
        $query_editora = "DELETE FROM editora WHERE id=:id";
        $del_editora = $mysqli->prepare($query_editora);
        $del_editora->bindParam(':id', $id);
        $del_editora->execute();

        // Verificar se a exclusão foi bem-sucedida
        if ($del_editora->rowCount() > 0) {
            $retorna = ['status' => true, 'msg' => "<div class='alert alert-success' role='alert'>Registro excluído com sucesso!</div>"];
        } else {
            $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Nenhum registro encontrado!</div>"];
        }

        // Reabilitar a verificação de chaves estrangeiras
        $mysqli->query('SET FOREIGN_KEY_CHECKS = 1');
    } catch (Exception $e) {
        $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro ao excluir o registro: " . $e->getMessage() . "</div>"];

        // Reabilitar a verificação de chaves estrangeiras em caso de erro
        $mysqli->query('SET FOREIGN_KEY_CHECKS = 1');
    }
} else {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Nenhum ID de registro fornecido!</div>"];
}

echo json_encode($retorna);