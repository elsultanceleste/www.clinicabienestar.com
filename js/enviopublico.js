let formular = document.getElementById('particular');
let modal = new bootstrap.Modal(document.getElementById('staticBackdrop'));

formular.addEventListener('submit',function(e){
    e.preventDefault();

    let xhr = new XMLHttpRequest();
    let date = new FormData(formular);
    
    xhr.open("POST","./php/enviarpeticion.php",true);

    xhr.addEventListener('load',()=>{
        console.log(xhr.response);
        formular.reset();
        modal.hide();
    });

    xhr.send(date)
});



