<?php

include_once "conexao.php";
$pagina = filter_input(INPUT_GET, "pagina", FILTER_SANITIZE_NUMBER_INT);

if (!empty($pagina)) {

    //Calcular o inicio visualização
    $qnt_result_pg = 40; //Quantidade de registro por página
    $inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;
   
    $query_editora = "SELECT id, nome, descricao, email FROM editora";
    $result_editora = $mysqli->prepare($query_editora);
    $result_editora->execute();

    if (($result_editora) and ($result_editora->rowCount() != 0)) {

        $dados = "<div class='table-responsive'>
            
            <table class='table table-striped table-bordered'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>";
                    while ($row_editora = $result_editora->fetch(PDO::FETCH_ASSOC)) {
                        extract($row_editora);
                        $dados .= "<tr>
                                <td id='valor_id$id'>$id</td>
                                <td id='valor_nome$id'>$nome</td>
                                <td id='valor_descricao$id'>$descricao</td>
                                <td id='valor_email$id'>$email</td>
                                <td class='d-flex'>
                                    <button type='button' id='botao_editar$id' class='btn btn-warning btn-sm me-1' onclick='editar_registro($id)'>Editar</button>
                                    <button type='button' id='botao_salvar$id' class='btn btn-warning btn-sm me-1' onclick='salvar_registro($id)'>Salvar</button>
                                    <button type='button' id='botao_deletar$id' class='btn btn-warning btn-sm me-1' onclick='deletar_registro($id)'>Deletar</button>
                                </td>
                            </tr>";
                    }

                $dados .= "</tbody>
            </table>
            </form>
        </div>";

        //Paginação - Somar a quantidade de usuários
        $query_pg = "SELECT COUNT(id) AS num_result FROM editora";
        $result_pg = $mysqli->prepare($query_pg);
        $result_pg->execute();
        $row_pg = $result_pg->fetch(PDO::FETCH_ASSOC);

        //Quantidade de pagina
        $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);

        $max_links = 2;

        $dados .= '<nav aria-label="Page navigation example"><ul class="pagination pagination-sm justify-content-center">';

        $dados .= "<li class='page-item'><a href='#' class='page-link' onclick='listarUsuarios(1)'>Primeira</a></li>";

        for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
            if ($pag_ant >= 1) {
                $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarUsuarios($pag_ant)' >$pag_ant</a></li>";
            }
        }

        $dados .= "<li class='page-item active'><a class='page-link' href='#'>$pagina</a></li>";

        for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
            if ($pag_dep <= $quantidade_pg) {
                $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarUsuarios($pag_dep)'>$pag_dep</a></li>";
            }
        }

        $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarUsuarios($quantidade_pg)'>Última</a></li>";
        $dados .=   '</ul></nav>';

        $retorna = ['status' => true, 'dados' => $dados];
    } else {
        $retorna = ['status' => false, 'msg' => "<p style='color: #f00;'>Erro: Nenhum usuário encontrado!</p>"];
    }
} else {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: Nenhuma editora encontrado! </div>"];
}


echo json_encode($retorna);


