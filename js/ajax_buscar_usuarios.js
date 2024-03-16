document.getElementById('buscar').addEventListener('keyup', getData);

function getData(){
    let input = document.getElementById('buscar').value;
    let content = document.getElementById('cont_table');
    let url = 'carg_usuarios.php';
    let formData = new FormData();
    formData.append('buscar', input); // Enviar el valor del input al script PHP

    fetch(url, {
        method: 'POST',
        body: formData
    }).then(response => response.json())
    .then(data => {
        content.innerHTML = data;
    }).catch(error => {
        console.log(error); // Cambié err por error para que coincida con la variable definida
    });
}