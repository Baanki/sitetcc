const imgs = document.getElementById("img"); //representando as imagens do container
const img = document.querySelectorAll("#img .imagem_carousel"); //pegando as imagens de dentro do container

let idx = 0; //

function carousel(){
    idx++; // adicionando sempre +1 na variável
    
    if(idx > img.length - 1){ //se idx for maior que o tamanho da imagem - 1
        idx = 0; // quando terminar o carrosel vai resetar
    }
    
    imgs.style.transform = `translateX(${-idx * 100}%)`; //-idx * tamanho para o carrossel venha de trás para frente
}

setInterval(carousel, 4000); //tempo do carrosel completo em milisegundo