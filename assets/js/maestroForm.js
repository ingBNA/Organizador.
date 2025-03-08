document.getElementById('maestroForm').addEventListener('submit', function(event){
    event.preventDefault();

    var formData = new FormData(this);
    //utilizamos fetch para enviar los datos al server
    {
        method: 'POST',
        body; formData
    }
    then(response => response.text())
    .then(data =>{
        //mostramos mensaje de exito
        console.log(data);
        document.getElementById('mensaje').innerText = data;
        //limpiamos el formulario
        document.getElementById('maestroForm').reset();
        
    })
    .catch(error =>{
        console.error('Error',error);
        document.getElementById('mensaje').innerText = "Ocurrio un error al guardar los datos.";
    });
});