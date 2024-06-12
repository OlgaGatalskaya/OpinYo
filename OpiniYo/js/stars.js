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


let masInfo = document.querySelector('.block-text-more');
let comentario = document.querySelector('.comentario');

if(masInfo !== null){

    masInfo.addEventListener('click', function() {
        if (comentario.classList.contains('text-block--show')) {
            comentario.classList.remove('text-block--show');
            masInfo.innerHTML = 'Leer mas';
        }
        /*else {
            comentario.classList.add('text-block--show');
            masInfo.innerHTML = 'Leer menos';
        }*/
    });

}





