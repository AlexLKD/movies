// // Récupérez toutes les éléments avec la classe movie-box
// let movieBoxes = document.querySelectorAll('.movie-box');

// // Attachez un gestionnaire d'événements clic à chaque movie-box
// movieBoxes.forEach(function (box) {
//     box.addEventListener('click', function () {
//         // Récupérez l'ID du film à partir de l'attribut data-movie-id
//         let movieId = box.getAttribute('data-movie-id');

//         // Vous pouvez maintenant utiliser l'ID du film pour récupérer d'autres détails du film
//         let titleElement = box.querySelector('.movie-title');
//         let synopsisElement = box.querySelector('.movie-synopsis');

//         // Assurez-vous que les éléments titleElement et synopsisElement ne sont pas null
//         let title = titleElement ? titleElement.innerText : 'Titre non disponible';
//         let synopsis = synopsisElement ? synopsisElement.innerText : 'Synopsis non disponible';

//         // Affichez le pop-in avec le titre, le synopsis et l'ID du film
//         showPopIn(movieId, title, synopsis);
//     });
// });

// // Fonction pour afficher le pop-in
// function showPopIn(movieId, title, synopsis) {
//     // Créez un élément de pop-in
//     let popIn = document.createElement('div');
//     popIn.className = 'pop-in';

//     // Remplissez le contenu du pop-in avec le titre, le synopsis et l'ID du film
//     popIn.innerHTML = '<h2>Movie ID: ' + movieId + '</h2><h3>' + title + '</h3><p>' + synopsis + '</p>';

//     // Ajoutez le pop-in au corps du document
//     document.body.appendChild(popIn);

//     // Affichez le pop-in
//     popIn.style.display = 'block';

//     // Attachez un gestionnaire d'événements clic pour fermer le pop-in
//     popIn.addEventListener('click', function () {
//         // Cachez le pop-in lors du clic
//         popIn.style.display = 'none';

//         // Supprimez le pop-in après qu'il a été caché
//         setTimeout(function () {
//             popIn.remove();
//         }, 300);
//     });
// }
