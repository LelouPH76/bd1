/* Inicio listar os registros do banco de dados */
const tbody = document.querySelector(".listar-usuarios");

// Funcao para listar os registros do banco de dados
const listarUsuarios = async (pagina) => {

    // Fazer a requisicao para o arquivo PHP responsavel em recuperar os registros do banco de dados
    const dados = await fetch("./list.php?pagina=" + pagina);

    // Ler o objeto retornado pelo arquivo PHP
    const resposta = await dados.json();

    // Acessa o IF quando nao encontrar nenhum registro no banco de dados
    if (!resposta['status']) {
        // Envia a mensagem de erro para o arquivo HTML que deve ser apresentada para o usuario
        document.getElementById("msgAlerta").innerHTML = resposta['msg'];
    } else {
        // Recuperar o SELETOR do HTML que deve receber os registros
        const conteudo = document.querySelector(".listar-usuarios");

        // Somente acessa o IF quando existir o SELETOR ".listar-usuarios"
        if (conteudo) {

            // Enviar os dados para o arquivo HTML
            conteudo.innerHTML = resposta['dados'];
        }
    }
}

// Chamar a funcao para listar os registro do banco de dados
listarUsuarios(1);

/* Fim listar os registros do banco de dados */

/* Inicio substituir o texto pelo campo na tabela */
// Funcao responsavel em substituir o texto pelo campo na tabela e receber o ID do registro que sera editado

function editar_registro(id) {
    // Ocultar o botao editar
    document.getElementById("botao_editar" + id).style.display = "none";

    // Apresentar o botao salvar
    document.getElementById("botao_salvar" + id).style.display = "block";

    // Recuperar os valores do registro que esta na tabela
    var nome = document.getElementById("valor_nome" + id);
    var descricao = document.getElementById("valor_descricao" + id);
    var email = document.getElementById("valor_email" + id);

    // Substituir o texto pelo campo e atribuir para o campo o valor que estava na tabela
    nome.innerHTML = "<input type='text' id='nome_text" + id + "' value='" + nome.innerHTML + "'>";
    descricao.innerHTML = "<input type='text' id='descricao_text" + id + "' value='" + descricao.innerHTML + "'>";
    email.innerHTML = "<input type='text' id='email_text" + id + "' value='" + email.innerHTML + "'>";

}

/* Fim substituir o texto pelo campo na tabela */

/* Inicio editar o registro no banco de dados */
// Funcao resposavel em salvar no banco de dados e receber o id do registro que deve ser editado

async function salvar_registro(id) {
    
    // Recuperar os valore dos campos
    var nome_valor = document.getElementById("nome_text" + id).value;
    var descricao_valor = document.getElementById("descricao_text" + id).value;
    var email_valor = document.getElementById("email_text" + id).value;
    // Prepara a STRING de valores que deve ser enviado para o arquivo PHP responsavel em salvar no banco de dados
    var dadosForm = "id=" + id + "&nome=" + nome_valor + "&descricao=" + descricao_valor + "&email=" + email_valor;

    // Fazer a requisicao com o FETCH para um arquivo PHP e enviar atraves do metodo POST os dados do formulario
    const dados = await fetch("editar.php", 
    { method: "POST", 
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, 
      body: dadosForm });

    // Ler o objeto, a resposta do arquivo PHP
    const resposta = await dados.json();

    // Acessa o IF quando nao conseguir editar no banco de dados
    if (!resposta['status']) {
        // Envia a mensagem de erro para o arquivo HTML que deve ser apresentada para o usuario
        document.getElementById("msgAlerta").innerHTML = resposta['msg'];
    } else {
        // Envia a mensagem de sucesso para o arquivo HTML que deve ser apresentada para o usuario
        document.getElementById("msgAlerta").innerHTML = resposta['msg'];

        // Chamar a funcao para remover a mensagem apos alguns segundos
        removerMsgAlerta();

        // Substituir o campo pelo texto com os valores atualizados
        document.getElementById("valor_nome" + id).innerHTML = nome_valor;
        document.getElementById("valor_descricao" + id).innerHTML = descricao_valor;
        document.getElementById("valor_email" + id).innerHTML = email_valor;


            
        // Restaurar a exibição do botão editar
        document.getElementById("botao_editar" + id).style.display = "block";

    // Ocultar o botão salvar
        document.getElementById("botao_salvar" + id).style.display = "none";
    }
}

/* Fim editar o registro no banco de dados */

/* Inicio remover a mensagem em 5 segundos apos apresentar a mensagem para o usuario */
function removerMsgAlerta() {
    setTimeout(function () {
        // Substituir a mensagem
        document.getElementById("msgAlerta").innerHTML = "";
    }, 5000);
}
async function deletar_registro(id){

    var confirmar = confirm("Tem certeza que deseja excluir o registro selecionado?");
    
    if(confirmar == true){
        const dados = await fetch('deletar.php?id='+ id);
        const resposta = await dados.json();
    
        if(!resposta['status']){
            document.getElementById("msgAlerta").innerHTML = resposta['msg'];
        }else{
            document.getElementById("msgAlerta").innerHTML = resposta['msg'];
            listarUsuarios(1);
        }
    }
    
}
/* Fim remover a mensagem em 5 segundos apos apresentar a mensagem para o usuario */