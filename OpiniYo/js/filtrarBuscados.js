let btnFiltrFecha = document.querySelector('#fFecha');
let btnFiltrPun = document.querySelector('#fPuntuacion');



btnFiltrFecha.addEventListener('click', function (){
    let tipo = btnFiltrFecha.dataset['type'];
    console.log(tipo);
    filtrar(tipo);
})

btnFiltrPun.addEventListener('click', function (){
    let tipo = btnFiltrPun.dataset['type'];
    console.log(tipo)
    filtrar(tipo);

})

function filtrar(tipoFiltr){
    let formData = new FormData();
    formData.append('tipo', tipoFiltr);
    fetch('filtrosBuscados.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            pintarOpinionesOrdenadosBuscados(data);
        })
}

function pintarOpinionesOrdenadosBuscados(datos) {
    let container = document.querySelector('#cards');
    container.innerHTML = '';

    datos.forEach(opinion => {
        let div = document.createElement('div');
        div.className = 'card div-producto p-3 mb-3 p-md-4';
        div.innerHTML = `
            <div class="row">
                <h5 class="col-12 card-title">${opinion.NombreProducto}</h5>
            </div>
            <div class="row mb-2">
                <div class="col-2 me-md-3 c-img"><img src="imgProductos/${opinion.ImagenProducto}" alt="producto"></div>
                <div class="col-8 col-md-8">
                    <div class="row mb-2">
                        <div class="d-flex justify-content-between flex-column">
                            <div class="rating rating-set d-flex align-items-end">
                                <div class="rating-body text-dark">
                                    <div class="rating-active" style="width:${opinion.Rating * 20}%"></div>
                                </div>
                                <div class="rating-value text-dark d-none">${opinion.Rating}</div>
                            </div>
                            <div class="fs-5 fw-bold">${opinion.LoginUsuario}</div>
                        </div>
                    </div>
                    <div class="row"><hr></div>
                    <div>${opinion.FechaOpinion}</div>
                </div>
                <div class="row">
                    <div class="col-12 text-carusel1 comentario text-block">
                        ${opinion.ComentarioOpinion}
                        <a href="leerTodaOpinion.php?IDOpinion=${opinion.IDOpinion}" class="block-text-more">Leer toda la opinion</a>
                    </div>
                </div>
            </div>
        `;
        container.appendChild(div);
    });
}