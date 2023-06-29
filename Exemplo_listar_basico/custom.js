
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
/* Funcao para substituir o texto pelo campo na tabela de acordo com o ID  */
function editar_registro(id){
    console.log("Acessou o " + id);
    var nome = document.getElementById("valor_nome"+id);
    var email = document.getElementById("valor_email"+id);
    //Substituir pelo valor da tabela
    nome.innerHTML = "<input type='text' id='nome_text"+ id + "' value='" + nome.innerHTML +"'>";
    email.innerHTML = "<input type='text' id='email_text"+ id + "' value='"+ email.innerHTML +"'>";
     
}
 async function salvar_registro(id){
    //recuperar valor
    console.log("Acessou o " + id);
    var nome_valor = document.getElementById("nome_text"+id).target.value;
    var email_valor = document.getElementById("email_text"+id).target.value;
    //substituir os campos pelos valores
    document.getElementById("valor_nome"+id).innerHTML = nome_valor;
    document.getElementById("valor_email"+id).innerHTML = email_valor;
    
    var dadosForm = "id=" + id + "&nome=" + nome_valor + "&email=" + email_valor;
    console.log(dadosForm);
    // requisitar pra outro doc php e enviar pelo post
    const dados = await fetch("editar.php", {
        method: "POST",
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: dadosForm
    });
    // Ler o objeto, a resposta do PHP
    const resposta = await dados.json();
    console.log(resposta);
    if(!resposta['status']){
        document.getElementById("msgAlerta").innetHtml = resposta['msg'];
    }
}