let tablaBody = document.querySelector('#tbody');
let btnNuevoElemento = document.querySelector('#btn-anadir');
let modalElement = document.getElementById('exampleModal');
let modal = new bootstrap.Modal(modalElement);


function actualizarDatos(){
    fetch('todas_subcategorias.php')
        .then(response => response.json())
        .then(data => {
            pintarTabla(data);
        })
}

function pintarTabla (datos){
    tablaBody.innerHTML = '';
    datos.forEach(data =>{
        let fila = document.createElement('tr');
        fila.dataset.id = data.IDSubcategoria;
        /*let idColumna = document.createElement('th');
        idColumna.innerHTML = data.IDSubcategoria;
        idColumna.className = 'idRow';*/
        let nombreColumna = document.createElement('td');
        nombreColumna.innerHTML = data.NombreSubcategoria;
        nombreColumna.className = 'nombreRow p-3 fs-5';
        let CategoriaSubcategoria = document.createElement('td');
        CategoriaSubcategoria.innerHTML = data.NombreCategoria;
        CategoriaSubcategoria.className = 'categoriaRow p-3';
        let editarColumna = document.createElement('td');
        editarColumna.className = 'text-center'
        let btnEditar = document.createElement('button');
        btnEditar.className = 'btn-editar btn btn-outline-primary';
        btnEditar.id = 'btn-modificar';
        btnEditar.innerHTML = '<i class="fa-solid fa-file-pen"></i>';
        btnEditar.dataset.id = data.IDCategoria;
        editarColumna.appendChild(btnEditar);
        let borrarColumna = document.createElement('td');
        borrarColumna.className = 'text-center';
        let btnBorrar = document.createElement('button');
        btnBorrar.className = 'btn-borrar btn btn-outline-danger';
        btnBorrar.id = 'btn-borrar';
        btnBorrar.innerHTML = '<i class="fa-solid fa-trash-can"></i>';
        borrarColumna.appendChild(btnBorrar);
        fila.append(nombreColumna, CategoriaSubcategoria, editarColumna, borrarColumna);
        tablaBody.appendChild(fila);
    })


}

btnNuevoElemento.addEventListener('click', crearSubcategoria);

function getSelectedCategoria() {
    let categoriaSelected = document.querySelector('#categoria');
    let selectedOption = categoriaSelected.options[categoriaSelected.selectedIndex];
    return {
        value: selectedOption.value,
        text: selectedOption.text
    };
}

function crearSubcategoria() {
    let nameSubcategoriaNueva = document.querySelector('#nombreSubcategoria').value.trim();
    let selectedCategoria = getSelectedCategoria();
    let categoriaSubcategoria = selectedCategoria.value;
    let categoriaNombre = selectedCategoria.text;
    let data = {
        NombreSubcategoria: nameSubcategoriaNueva,
        CategoriaSubcategoria: categoriaSubcategoria,
        NombreCategoria: categoriaNombre

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
            console.log(data);
            modal.hide();
            let backdrops = document.querySelectorAll('.modal-backdrop');
            backdrops.forEach(backdrop => backdrop.remove());
            document.body.classList.remove('modal-open');
            //document.body.className = 'x';
            console.log('Backdrop elements:', document.querySelectorAll('.modal-backdrop').length);
            console.log('Body classes:', document.body.classList);
        })
        .catch((error) => {
            console.log(error);
        })

    console.log(data);
}

function pintarFila(datos) {

    let fila = document.createElement('tr');
    fila.dataset.id = datos.IDSubcategoria;
    /*let idColumna = document.createElement('th');
    idColumna.innerHTML = datos.IDSubcategoria;
    idColumna.className = 'idRow';*/
    let nombreColumna = document.createElement('td');
    nombreColumna.innerHTML = datos.NombreSubcategoria;
    nombreColumna.className = 'nombreRow p-3 fs-5';
    let CategoriaSubcategoria = document.createElement('td');
    CategoriaSubcategoria.innerHTML = datos.NombreCategoria;
    CategoriaSubcategoria.className = 'categoriaRow p-3';
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
    fila.append(nombreColumna, CategoriaSubcategoria, editarColumna, borrarColumna);
    tablaBody.appendChild(fila);
}


tablaBody.addEventListener('click', function (event){
    if(event.target.closest('.btn-borrar')){
        let fila = event.target.closest('tr');
        let id = fila.getAttribute('data-id');
        console.log(id)
        console.log(fila);
        borrarSubcategoria(id, fila);
    }
})


function borrarSubcategoria(id, fila){
    fetch('borrar.php', {
        method: 'delete',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({IDSubcategoria: id})
    })
        .then(response => {
            if(!response.ok){
                throw new Error("Error al eliminar la categoría");
            }
            return response.json();
        })
        .then(data => {
            fila.remove();
            //actualizarDatos();

        })
        .catch(error => {
            console.error(error);
        })

}


/*tablaBody.addEventListener('click', function (event) {
    console.log(event.target);
    if (event.target.closest('.btn-editar')) {
        let fila = event.target.closest('tr');
        let id = fila.getAttribute('data-id');
        changePorInput(fila);
    }
});*/

tablaBody.addEventListener('click', function (event) {
    console.log('Clicked:', event.target);
    if (event.target.closest('button')) {
        console.log('Button clicked');
        let fila = event.target.closest('tr');
        let id = fila.getAttribute('data-id');
        changePorInput(fila);
    }
});

function changePorInput(fila) {
    let id = fila.getAttribute('data-id');
    let nombreCell = fila.querySelector('.nombreRow');
    let nombreCell2 = fila.querySelector('.categoriaRow');
    let nombre = nombreCell.textContent;
    let nombreCategoria = nombreCell2.textContent;

    fila.innerHTML = `
        
        <td><input type="text" value="${nombre}" class="form-control nombre-input" /></td>
        <td class="categoriaRow">${nombreCategoria}</td>
        <td class="text-center"><button class="btn-guardar btn btn-outline-primary"><i class="fa-solid fa-save"></i></button></td>
        <td class="text-center"><button class="btn-cancelar btn btn-outline-danger"><i class="fa-solid fa-times"></i></button></td>
    `;

    fila.querySelector('.btn-guardar').addEventListener('click', function () {
        guardarCambios(fila);
    });

    fila.querySelector('.btn-cancelar').addEventListener('click', function () {
        location.reload();

    });
}

function guardarCambios(fila) {
    let id = fila.getAttribute('data-id');
    let nuevoNombre = fila.querySelector('.nombre-input').value.trim();
    let nombreCategoria = fila.querySelector('.categoriaRow').textContent.trim();

    if (!nuevoNombre) {
        alert('Por favor, introduzca un nombre de subcategoría.');
        return;
    }

    fetch('editar.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ IDSubcategoria: id, NombreSubcategoria: nuevoNombre, NombreCategoria: nombreCategoria })
    })
        .then(response => {
            if (!response.ok) {
                throw new Error("Error al editar la subcategoría");
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                //actualizarDatos();
                location.reload();
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}
