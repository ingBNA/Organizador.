
document.getElementById('alumnoForm').addEventListener('submit', function(event){
    event.preventDefault(); //evitamos el envio tradicional al formulario

    var formData = new FormData(this);
    //utilizamos fetch para enviar los datos al servidor 
    fetch('index.php?controller=alumno&action=save', {
        method: 'POST',
         body : formData
         })
    .then(response => response.text())
    .then(data => {

        //mostramos mensaje de exito
        console.log(data);
        document.getElementById('mensaje').innerText = 'Datos guardados';
        //Limpiamos el formulario
        document.getElementById('alumnoForm').reset(); 
    })

    .catch(error =>{
        console.error('Error:', error);
        document.getElementById('mensaje').innerText = 'ocurrio  un error al guardar los datos.';
    });
});