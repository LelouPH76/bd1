<?php include 'conexao.php' ?>
<!DOCTYPE html>
<html lang="pt-br">
    <body>
        <table border='3px' cellpadding="10px" cellspacing="0">
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Age</th>
            <th colspan="2">Actions</th>

        </tr>
        <?php 
        $query_categorias = "SELECT id, descricao, nome FROM categoria";
        $result_categorias = $mysqli->prepare($query_categorias);
        $result_categorias->execute();
        if($result_categorias){
            while($row_categorias = $result_categorias->fetch(PDO::FETCH_ASSOC)) {
                extract($row_categorias);{
                ?>
                <tr>
                    <td><?php echo $row_categorias['nome']?></td>
                    <td><?php echo $row_categorias['descricao']?></td>
                    <td><a href="updatecat.php?id=<?php echo $row_categorias['id']; ?>">Edit</a></td>
                </tr>
                <?php
            }
            }}
        ?>
        </table>
    </body>
</html>