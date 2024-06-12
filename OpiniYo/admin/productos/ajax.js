let btnNuevoElemento = document.querySelector('#btn-anadir');
let tablaBody = document.querySelector('#tbody');
let modalElement = document.getElementById('exampleModal');
let modal = new bootstrap.Modal(modalElement);



btnNuevoElemento.addEventListener('click', crearProducto);

function getSelectedSubcategoria() {
    const subcategoriaSelected = document.querySelector('#subcategoria');
    const selectedOption = subcategoriaSelected.options[subcategoriaSelected.selectedIndex];
    return {
        value: selectedOption.value,
        text: selectedOption.text
    };
}

function crearProducto(){
    let nameProductoNuevo = document.querySelector('#nombreProducto').value.trim();
    let imagenProducto = document.querySelector('#imgProducto').files[0];
    console.log(imagenProducto);
    let selectedSubcategoria = getSelectedSubcategoria();
    let subcategoriaNombre = selectedSubcategoria.text;
    let subcategoriaId = selectedSubcategoria.value;

    let formData = new FormData();
    formData.append('NombreProducto', nameProductoNuevo);
    formData.append('ImagenProducto', imagenProducto);
    formData.append('SubcategoriaProducto', subcategoriaId);
    formData.append('SubcategoriaNombre', subcategoriaNombre);
    console.log(Array.from(formData.entries()));

    fetch('crear.php', {
        method: 'POST',
        body: formData
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

}

function pintarFila(datos){
    let fila = document.createElement('tr');
    fila.dataset.id = datos.IDProducto;
    /*let idColumna = document.createElement('th');
    idColumna.innerHTML = datos.IDProducto;
    idColumna.className = 'idRow col-1';*/
    let nombreColumna = document.createElement('td');
    nombreColumna.innerHTML = datos.NombreProducto;
    nombreColumna.className = 'nombreRow col-3 p-3 fs-5';
    let imgColumna = document.createElement('td');
    imgColumna.className = 'col-3 imgRow';
    let divImg = document.createElement('div');
    divImg.className = 'imgProductoDiv';
    imgColumna.appendChild(divImg);
    let imgProducto = document.createElement('img');
    imgProducto.src = '../../imgProductos/' + datos.ImagenProducto;
    divImg.appendChild(imgProducto);
    let subcategoriaColumna = document.createElement('td');
    subcategoriaColumna.innerHTML = datos.SubcategoriaNombre;
    subcategoriaColumna.className = 'subcategoriaRow col-3';
    let editarColumna = document.createElement('td');
    editarColumna.className = 'text-center';
    let btnEditar = document.createElement('button');
    btnEditar.className = 'btn-editar btn btn-outline-primary';
    btnEditar.id = 'btn-modificar';
    btnEditar.innerHTML = '<i class="fa-solid fa-file-pen"></i>';
    btnEditar.dataset.id = datos.IDProducto;
    editarColumna.appendChild(btnEditar);
    let borrarColumna = document.createElement('td');
    borrarColumna.className = 'text-center'
    let btnBorrar = document.createElement('button');
    btnBorrar.className = 'btn-borrar btn btn-outline-danger';
    btnBorrar.id = 'btn-borrar';
    btnBorrar.innerHTML = '<i class="fa-solid fa-trash-can"></i>';
    borrarColumna.appendChild(btnBorrar);
    fila.append(nombreColumna, imgColumna, subcategoriaColumna, editarColumna, borrarColumna);
    tablaBody.appendChild(fila);
}

//borrar producto

tablaBody.addEventListener('click', function (event){
    if(event.target.closest('.btn-borrar')){
        let fila = event.target.closest('tr');
        let id = fila.getAttribute('data-id');
        console.log(id)
        console.log(fila);
        borrarProducto(id, fila);
    }
})

function borrarProducto(id, fila){
    fetch('borrar.php', {
        method: 'delete',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({IDProducto: id})
    })
        .then(response => {
            if(!response.ok){
                throw new Error("Error al eliminar el producto");
            }
            return response.json();
        })
        .then(data => {
            fila.remove();
        })
        .catch(error => {
            console.error(error);
        })
}



//editar producto
tablaBody.addEventListener('click', function (event) {
    console.log("Clicked element:", event.target);
    let closestButton = event.target.closest('.btn-editar');
    console.log("Closest .btn-modificar:", closestButton);
    if (closestButton) {
        let fila = closestButton.closest('tr');
        let id = fila.getAttribute('data-id');
        console.log("Row and ID:", fila, id);
        changePorInput(fila);
    }
});

function changePorInput(fila) {
    let id = fila.getAttribute('data-id');
    let nombreCell = fila.querySelector('.nombreRow').textContent.trim();
    let imgCell = fila.querySelector('.imgRow');
    let imgSrc = imgCell.querySelector('img').src;  // Сохраняем текущий URL изображения
    let nombreSubcategoria = fila.querySelector('.subcategoriaRow').textContent;

    fila.innerHTML = `
        <td><input type="text" value="${nombreCell}" class="form-control nombre-input" /></td>
        <td>
            <input type="file" class="form-control file-input" accept="image/*"/>
            <img src="${imgSrc}" class="img-preview" style="max-width: 100px; max-height: 100px;"/>
        </td>
        <td class="subcategoriaRow col-3">${nombreSubcategoria}</td> 
        <td class="text-center"><button class="btn-guardar btn btn-outline-primary"><i class="fa-solid fa-save"></i></button></td>
        <td class="text-center"><button class="btn-cancelar btn btn-outline-danger"><i class="fa-solid fa-times"></i></button></td>
    `;

    imgCell = fila.querySelector('.img-preview').parentNode;  // Переопределение imgCell
    let fileInput = fila.querySelector('.file-input');
    let btnGuardar = fila.querySelector('.btn-guardar');
    let btnCancelar = fila.querySelector('.btn-cancelar');

    fileInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            let reader = new FileReader();
            reader.onload = function(e) {
                imgCell.querySelector('.img-preview').src = e.target.result;
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    btnGuardar.addEventListener('click', function () {
        guardarCambios(fila, id);
    });

    btnCancelar.addEventListener('click', function () {
        location.reload();
    });
}
function guardarCambios(fila, idProducto) {
    let formData = new FormData();
    let nombre = fila.querySelector('.nombre-input').value;
    let subcategoria = fila.querySelector('.subcategoriaRow').textContent;
    let fileInput = fila.querySelector('.file-input');
    let currentImageSrc = fila.querySelector('.img-preview').src;

    formData.append('IDProducto', idProducto);
    formData.append('NombreProducto', nombre);
    formData.append('SubcategoriaNombre', subcategoria);
    // Проверка на наличие выбранного файла
    if (fileInput.files.length > 0) {
        formData.append('ImagenProducto', fileInput.files[0]);
    }

    fetch('editar.php', {
        method: 'POST',
        body: formData,
    })
        .then(response => response.json())
        .then(data => {
            console.log('Success:', data);
            location.reload();
        })
        .catch(error => console.error('Error:', error));
}


