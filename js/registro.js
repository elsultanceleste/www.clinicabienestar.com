let form = document.getElementById('formulario');

form.addEventListener('submit',function(e){
    e.preventDefault();

    let xhr = new XMLHttpRequest();
    let dato = new FormData(form);

    xhr.open("POST","./php/insertarregistro.php",true);

    xhr.addEventListener('load',function(){
        console.log(xhr.response);

        if(xhr.status == 200){
            if(xhr.response==1){
                // Swal.fire({
            //     title: "Sus dado han sido registrado exitosamente, Bienvenido!",
            //     icon: "success",
            //     draggable: true
            //     });
                window.location.href = "./login.php";
            }
            
        }else{
            alert("Error al guargar")
        }
        
    });

    xhr.send(dato);
});
