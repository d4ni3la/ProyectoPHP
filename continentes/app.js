document.addEventListener('DOMContentLoaded', () => {
    // Referencia donde se mostraran los resultados del consumo del API
    const resultadosElement = document.getElementById('resultados');

    // URL del API de MealDB para obtener recetas aleatorias
    const apiUrl = 'https://www.themealdb.com/api/json/v1/1/random.php';

    // Realiza la solicitud a la API utilizando fetch
    fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
            // Maneja los datos obtenidos de la API
            mostrarResultados(data.meals);
        })
        .catch(error => {
            // Maneja los errores de la solicitud
            console.error('Error al obtener datos de la API:', error);
        });

    // Función para mostrar los resultados en la página
function mostrarResultados(meals) {
    // Borra el contenido previo en el elemento resultados
    resultadosElement.innerHTML = '';

    // Itera sobre las recetas obtenidas y muestra la información relevante
    meals.forEach(meal => {
        // Crea un elemento <h2> para el título de la receta
        const titulo = document.createElement('h2');
        // Establece el contenido de <h2> como el nombre de la receta
        titulo.textContent = meal.strMeal;

        // crea un elemento img para la imagen de la receta
        const imagen = document.createElement('img');
        // establece la fuente de la imagen como la URL de la imagen de la receta
        imagen.src = meal.strMealThumb;
        imagen.alt = meal.strMeal;

        // crea un elemento 'p' para las instrucciones de la receta
        const instrucciones = document.createElement('p');
        // establece el contenido de 'p' con las instrucciones de la receta
        instrucciones.textContent = meal.strInstructions;

        // agrega los elementos al contenedor de resultados (el div con id 'resultadosElement')
        resultadosElement.appendChild(titulo);
        resultadosElement.appendChild(imagen);
        resultadosElement.appendChild(instrucciones);
    });
}

});
