const estados = document.querySelector("#estado_cadastro")
const cidades = document.querySelector("#cidade_cadastro")


const pegarestados = async() => {
    const data = await fetch('http://192.168.0.104/tcc/api/estados.php')
        .then(resp => resp.json()).catch(error => false)

    if(!data) return 
    
    inserirestados(data)
}

const inserirestados = (data) =>{

    estado_cadastro.innerHTML = " "
    estado_cadastro.innerHTML = "<option>Selecione</option>"

    data.forEach(row => {

     estado_cadastro.innerHTML += `<option value="${row["cod_estado"]}">${row["est_nome"]}</option>`
    })

    estado_cadastro.addEventListener("change", e => pegarcidades(estado_cadastro.value))
}

const pegarcidades = async (cod_estado) =>{
    const data = await fetch(`http://192.168.0.104/tcc/api/cidades.php?cod_estado=${cod_estado}`)
        .then(resp => resp.json()).catch(error => false)

    if(!data) return 

    inserircidades(data)
}

const inserircidades = (data) =>{
    cidade_cadastro.innerHTML = "<option>Selecione</option>"

    data.forEach(row => {

     cidade_cadastro.innerHTML += `<option value="${row["cid_nome"]}">${row["cid_nome"]}</option>`
    })

}


pegarestados()