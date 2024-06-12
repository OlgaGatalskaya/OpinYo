let tablaBody = document.querySelector('#tbody');
let btnNuevoElemento = document.querySelector('#btn-añadir');
let btnModificarElemento = document.querySelectorAll('#btn-modificar');

let modalElement = document.getElementById('exampleModal');
let modal = new bootstrap.Modal(modalElement);



window.onload = () => {
    actualizarDatos();
}

function actualizarDatos(){
    fetch('todas_categorias.php')
        .then(response => response.json())
        .then(data => {
            pintarTabla(data);
        })
}

function pintarTabla (datos){
    tablaBody.innerHTML = '';
    datos.forEach(data =>{
        let fila = document.createElement('tr');
        fila.dataset.id = data.IDCategoria;
        /*let idColumna = document.createElement('th');
        idColumna.innerHTML = data.IDCategoria;
        idColumna.className = 'idRow';*/
        let nombreColumna = document.createElement('td');
        nombreColumna.innerHTML = data.NombreCategoria;
        nombreColumna.className = 'nombreRow p-3 fs-5';
        let editarColumna = document.createElement('td');
        editarColumna.className = 'text-center'
        let btnEditar = document.createElement('button');
        btnEditar.className = 'btn-editar btn btn-outline-primary';
        btnEditar.id = 'btn-modificar btn';
        btnEditar.innerHTML = '<i class="fa-solid fa-file-pen"></i>';
        btnEditar.dataset.id = datos.IDCategoria;
        editarColumna.appendChild(btnEditar);
        let borrarColumna = document.createElement('td');
        borrarColumna.className = 'text-center';
        let btnBorrar = document.createElement('button');
        btnBorrar.className = 'btn-borrar btn btn-outline-danger';
        btnBorrar.id = 'btn-borrar';
        btnBorrar.innerHTML = '<i class="fa-solid fa-trash-can"></i>';
        borrarColumna.appendChild(btnBorrar);
        fila.append( nombreColumna, editarColumna, borrarColumna);
        tablaBody.appendChild(fila);
    })

}

btnNuevoElemento.addEventListener('click', crearCategoria);

tablaBody.addEventListener('click', function (event){
    if(event.target.closest('.btn-borrar')){
        let fila = event.target.closest('tr');
        let id = fila.getAttribute('data-id');
        console.log(id)
        console.log(fila);
        borrarCategoria(id, fila);
    }
})



function borrarCategoria(id, fila){
    fetch('borrar.php', {
        method: 'delete',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({IDCategoria: id})
    })
        .then(response => {
            if(!response.ok){
                throw new Error("Error al eliminar la categoría");
            }
            return response.json();
        })
        .then(data => {
                console.log('hola')
                fila.remove();
                actualizarDatos();

        })
        .catch(error => {
            console.error(error);
        })

}

function crearCategoria() {
    let nameCategoriaNueva = document.querySelector('#nombreCategoria').value.trim();

    if (!nameCategoriaNueva) {
        alert('Por favor, introduzca un nombre de categoría.');
        return;
    }

    let data = {
        NombreCategoria: nameCategoriaNueva,
    };

    fetch('crear.php', {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(response => {
            if (!response.ok) {
                throw new Error("Ha salido un error");
            }
            return response.json();
        })
        .then(data => {
            pintarFila(data);
            modal.hide();
            let backdrops = document.querySelectorAll('.modal-backdrop');
            backdrops.forEach(backdrop => backdrop.remove());
            document.body.classList.remove('modal-open');
            //document.body.className = 'x';
            console.log('Backdrop elements:', document.querySelectorAll('.modal-backdrop').length);
            console.log('Body classes:', document.body.classList);
        })
        .catch((error) => {
            console.error(error);
        })

    console.log(data);
}

function pintarFila(datos) {

    let fila = document.createElement('tr');
    fila.dataset.id = datos.IDCategoria;
    /*let idColumna = document.createElement('th');
    idColumna.innerHTML = datos.IDCategoria;
    idColumna.className = 'idRow';*/
    let nombreColumna = document.createElement('td');
    nombreColumna.innerHTML = datos.NombreCategoria;
    nombreColumna.className = 'nombreRow p-3 fs-5';
    let editarColumna = document.createElement('td');
    editarColumna.className = 'text-center';
    let btnEditar = document.createElement('button');
    btnEditar.className = 'btn-editar btn btn-outline-primary';
    btnEditar.id = 'btn-modificar';
    btnEditar.innerHTML = '<i class="fa-solid fa-file-pen"></i>';
    btnEditar.dataset.id = datos.IDCategoria;
    editarColumna.appendChild(btnEditar);
    let borrarColumna = document.createElement('td');
    borrarColumna.className = 'text-center';
    let btnBorrar = document.createElement('button');
    btnBorrar.className = 'btn-borrar btn btn-outline-danger';
    btnBorrar.id = 'btn-borrar';
    btnBorrar.innerHTML = '<i class="fa-solid fa-trash-can"></i>';
    borrarColumna.appendChild(btnBorrar);
    fila.append(nombreColumna, editarColumna, borrarColumna);
    tablaBody.appendChild(fila);
}

tablaBody.addEventListener('click', function (event) {
    if (event.target.closest('.btn-editar')) {
        let fila = event.target.closest('tr');
        let id = fila.getAttribute('data-id');
        changePorInput(fila);
    }
});

function changePorInput(fila) {
    let id = fila.getAttribute('data-id');
    let nombreCell = fila.querySelector('.nombreRow');
    let nombre = nombreCell.textContent;

    fila.innerHTML = `
        <td><input type="text" value="${nombre}" class="form-control" /></td>
        <td class="text-center"><button class="btn-guardar btn btn-outline-primary"><i class="fa-solid fa-save"></i></button></td>
        <td class="text-center"><button class="btn-cancelar btn btn-outline-danger"><i class="fa-solid fa-times"></i></button></td>
    `;

    fila.querySelector('.btn-guardar').addEventListener('click', function () {
        guardarCambios(fila);
    });

    fila.querySelector('.btn-cancelar').addEventListener('click', function () {
        actualizarDatos();
    });
}

function guardarCambios(fila) {
    let id = fila.getAttribute('data-id');
    let nuevoNombre = fila.querySelector('input').value.trim();

    if (!nuevoNombre) {
        alert('Por favor, introduzca un nombre de categoría.');
        return;
    }

    fetch('editar.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ IDCategoria: id, NombreCategoria: nuevoNombre })
    })
        .then(response => {
            if (!response.ok) {
                throw new Error("Error al editar la categoría");
            }
            return response.json();
        })
        .then(data => {

                actualizarDatos();

        })
        .catch(error => {
            console.error('Error:', error);
        });
}





