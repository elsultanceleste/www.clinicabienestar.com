let inicio = document.getElementById('inicio');

inicio.addEventListener('submit',function(e){

    e.preventDefault();
    
    let xhr = new XMLHttpRequest();
    let data = new FormData(inicio);

    if(data.get('email')=="" || data.get('pwd')==""){
        alert("Tu papá, haz las cosas bien");
    }

    xhr.open("POST","./php/sesion.php",true);
    xhr.addEventListener('load',function(){
        if(xhr.response == 1){
            window.location.href = "./index.php"
        }else{
            console.log(xhr.response);
            
        }
        
    });

    xhr.send(data);
    
});