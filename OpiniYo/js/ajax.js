let buscarInput = document.querySelector('#buscarAñadirOpinion');
//let buscarBtn = document.querySelector('#buscarElemento');

let containerElementoEncontrado = document.querySelector('.containerElementoEncontrado');

document.addEventListener('DOMContentLoaded', function (event) {
    event.preventDefault();
    let buscarBtn = document.querySelector('#buscarElemento');
    if (buscarBtn) {
        buscarBtn.addEventListener('click', buscar);
    }
});

function buscar() {
    let formData = new FormData();
    let elementoBuscado = buscarInput.value;
    formData.append('elementoBuscado', elementoBuscado);

    fetch('buscador.php', {
        method: 'POST',
        body: formData,
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data.length > 0) {
                pintarProductoEncontrado(data);
            } else {
                containerElementoEncontrado.innerHTML = '';
                let divMensaje = document.createElement('div');
                divMensaje.innerHTML = "No hay producto que esta buscando";
                containerElementoEncontrado.append(divMensaje);
            }
        })
}

function pintarProductoEncontrado(datos) {
    containerElementoEncontrado.innerHTML = '';

    datos.forEach(data => {
        let divElementoEncontrado = document.createElement('div');
        divElementoEncontrado.className = 'elementoEncontrado row';
        let divImgEnc = document.createElement('div');
        divImgEnc.className = 'col-1 divImgEnc';
        let divImg = document.createElement('div');
        let img = document.createElement('img');
        img.src = 'imgProductos/' + data.ImagenProducto;
        divImg.appendChild(img);
        divImgEnc.appendChild(divImg);

        let divNombres = document.createElement('div');
        divNombres.className = 'col-10 divNombres';
        let divSubcategoria = document.createElement('div');
        divSubcategoria.innerHTML = data.NombreSubcategoria;
        let divProducto = document.createElement('div');
        let enlaceProducto = document.createElement('a');
        enlaceProducto.innerHTML = data.NombreProducto;
        enlaceProducto.href = 'productoOpinion.php?IDProducto=' + data.IDProducto;
        divProducto.appendChild(enlaceProducto);
        divNombres.append(divSubcategoria, divProducto);
        divElementoEncontrado.append(divImgEnc, divNombres);
        containerElementoEncontrado.append(divElementoEncontrado);
    })
}

//rating
let ratings = document.querySelectorAll('.rating');

if (ratings.length > 0) {
    initRatings();
}

function initRatings() {
    let ratingActive, ratingValue;
    for (let i = 0; i < ratings.length; i++) {
        let rating = ratings[i];
        initRating(rating);
    }

    function initRating(rating) {
        initRatingVars(rating);
        setRatingActiveWidth();

        if (rating.classList.contains('rating-set')) {
            setRating(rating);
        }
    }

    function initRatingVars(rating) {
        ratingActive = rating.querySelector('.rating-active');
        ratingValue = rating.querySelector('.rating-value');
    }

    //cambiamos el ancho de las estrellas activas
    function setRatingActiveWidth(i = ratingValue.innerHTML) {
        let ratingActiveWidth = i / 0.05;
        ratingActive.style.width = `${ratingActiveWidth}%`;
    }

    function setRating(rating) {
        let ratingItems = document.querySelectorAll('.rating-item');
        for (let i = 0; i < ratingItems.length; i++) {
            let ratingItem = ratingItems[i];
            ratingItem.addEventListener('mouseenter', function (e) {
                initRatingVars(rating);
                setRatingActiveWidth(ratingItem.value);
            })
            ratingItem.addEventListener('mouseleave', function (e) {
                setRatingActiveWidth();
            });
            ratingItem.addEventListener('click', function (e) {
                initRatingVars(rating);

                //para ajax
                /*if(rating.dataset.ajax){
                    //mandar los datos a server
                    setRatingValue(rating.value, rating);
                }else {*/
                ratingValue.innerHTML = i + 1;
                setRatingActiveWidth();
                //return ratingValue.innerHTML;
                //}
            })

        }
    }

    return ratingValue.innerHTML;
}

//escribir opinion para el producto que existe
    let btnMandarOpinion = document.querySelector('#btnMandarOpinion');
    let idProducto = document.querySelector('#idPr').innerHTML;
    let errorContainer = document.querySelector('.error');

    if(btnMandarOpinion){
        btnMandarOpinion.addEventListener('click', escribirOpinion);
    }

    document.querySelectorAll('input[name="rating"]').forEach(radio => {
        radio.addEventListener('change', disponibleBtnMandar);
    });

    // CKEditor
    if (CKEDITOR.instances.exampleFormControlTextarea1) {
        CKEDITOR.instances.exampleFormControlTextarea1.on('instanceReady', function() {
            this.document.on('keyup', disponibleBtnMandar);
            this.document.on('paste', disponibleBtnMandar);
            this.document.on('change', disponibleBtnMandar);
        });
    }
    function disponibleBtnMandar() {
        btnMandarOpinion.disabled = false;
        errorContainer.innerHTML = '';
    }
    function escribirOpinion() {
        let editorContent = CKEDITOR.instances.exampleFormControlTextarea1.getData();
        let rating = initRatings();

        if (!rating || !editorContent || !idProducto) {
            errorContainer.innerHTML = "Para poder mandar la opinión es necesario rellenar todo.";
            errorContainer.className = 'text-danger fs-5 mb-4';
            btnMandarOpinion.disabled = true;
            return;
        }

        let formData = new FormData();
        formData.append('IDProducto', idProducto);
        formData.append('comentario', editorContent);
        formData.append('clasificacion', rating);

        fetch('crearOpinion.php', {
            method: 'POST',
            body: formData,
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Opinión enviada con éxito');
                    cambiarSection();
                } else {
                    console.error('Error al enviar opinión');
                }
            })
            .catch(error => console.error('Error:', error));
    }


function cambiarSection() {
    let section = document.querySelector('.section-espacioPersonal');

    section.innerHTML = '<div class="container pt-5 pb-5 w-75">' +
        '<h4 class="text-dark fw-bold mb-4 fs-3">¡Gracias por su opinión!</h4>' +
        '<div class="text-dark mb-3 fs-4">Su opinión ayuda a otros usuarios a tomar la decisión correcta. <br> Le agradecemos que comparta su experiencia. <br> Esperamos recibir más comentarios tuyos.</div>' +
        '<div class="text-dark fs-4"> Saludos, <br>' +
        '<div class="text-dark fs-4">OpiniYo</div>' +
        '</div>';
    section.style.height = '500px';
}

function getSelectedSubcategoria() {
    const subcategoriaSelected = document.querySelector('#subcategoria');
    const selectedOption = subcategoriaSelected.options[subcategoriaSelected.selectedIndex];
    return {
        value: selectedOption.value,
        text: selectedOption.text
    };
}


//escribir opinion para el producto que existe
let btnMandarOpinionProductoNuevo = document.querySelector('#btnMandarOpinionProductoNuevo');
let errorContainer2 = document.querySelector('.error');

if(btnMandarOpinionProductoNuevo){
    btnMandarOpinionProductoNuevo.addEventListener('click', escribirOpinionProductoNuevo);
}
    document.querySelectorAll('input[name="rating"]').forEach(radio => {
        radio.addEventListener('change', disponibleBtnMandar2);
    });

    //Ckeditor
    if (CKEDITOR.instances.exampleFormControlTextarea1) {
        CKEDITOR.instances.exampleFormControlTextarea1.on('instanceReady', function() {
            this.document.on('keyup', disponibleBtnMandar2);
            this.document.on('paste', disponibleBtnMandar2);
            this.document.on('change', disponibleBtnMandar2);
        });
    }


    document.getElementById('imgProductoNuevo').addEventListener('change', disponibleBtnMandar2);
    document.getElementById('nombreProducto').addEventListener('input', disponibleBtnMandar2);


function disponibleBtnMandar2() {
    btnMandarOpinionProductoNuevo.disabled = false;
    errorContainer2.innerHTML = '';
}

function escribirOpinionProductoNuevo() {
    let nameProductoNuevo = document.querySelector('#nombreProducto').value.trim();
    let imagenProducto = document.querySelector('#imgProductoNuevo').files[0];
    let selectedSubcategoria = getSelectedSubcategoria();
    let subcategoriaNombre = selectedSubcategoria.text;
    let subcategoriaId = selectedSubcategoria.value;
    let editorContent = CKEDITOR.instances.exampleFormControlTextarea1.getData();
    let rating = initRatings();

    if (!nameProductoNuevo || !imagenProducto || !subcategoriaNombre  || !editorContent || !rating) {
        errorContainer2.textContent = "Todos los campos son necesarios.";
        errorContainer2.className = 'text-danger fs-5 mb-4';
        btnMandarOpinionProductoNuevo.disabled = true;
        return;
    }

    let formData = new FormData();
    formData.append('NombreProducto', nameProductoNuevo);
    formData.append('ImagenProducto', imagenProducto);
    formData.append('SubcategoriaProducto', subcategoriaId);
    formData.append('SubcategoriaNombre', subcategoriaNombre);
    formData.append('comentario', editorContent);
    formData.append('clasificacion', rating);


    fetch('crearOpinionProductoNuevo.php', {
        method: 'POST',
        body: formData,
    })
        .then(response => response.text())
        .then(data => {
            console.log(data);
            if (data) {
                cambiarSection();
            } else {
                console.error('Error al enviar opinión');
            }
        })
        .catch(error => console.error('Error:', error));

}
