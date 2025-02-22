let currentIndex = 0;
let matches = [];

function searchText() {
    // Obtener el valor del campo de búsqueda
    let searchQuery = document.getElementById('searchInput').value.toLowerCase();

    // Limpiar cualquier resaltado anterior y el índice
    removeHighlights();
    currentIndex = 0;
    matches = [];

    // Si no hay texto en la búsqueda, salir
    if (!searchQuery) {
        return;
    }

    // Buscar todas las instancias del término en el documento
    let bodyText = document.body.innerHTML;
    const regex = new RegExp(`(${searchQuery})`, 'gi');
    let match;

    // Almacenar todas las coincidencias con su posición
    while ((match = regex.exec(bodyText)) !== null) {
        matches.push(match.index);
    }

    // Si hay coincidencias, resaltar la primera y desplazarse
    if (matches.length > 0) {
        highlightMatch(matches[currentIndex]);
        scrollToMatch(matches[currentIndex]);
    } else {
        alert("No se encontraron coincidencias.");
    }
}

// Función para resaltar la coincidencia
function highlightMatch(index) {
    let bodyText = document.body.innerHTML;
    const searchQuery = document.getElementById('searchInput').value.toLowerCase();
    const regex = new RegExp(`(${searchQuery})`, 'gi');
    bodyText = bodyText.replace(regex, (match, p1, offset) => {
        if (offset === index) {
            return `<span class="highlight" id="match-${index}">${p1}</span>`;
        }
        return match;
    });
    document.body.innerHTML = bodyText;
}

// Función para eliminar los resaltados
function removeHighlights() {
    let highlightedElements = document.querySelectorAll('.highlight');
    highlightedElements.forEach((el) => {
        el.outerHTML = el.innerHTML;
    });
}

// Función para desplazar la vista hacia la coincidencia
function scrollToMatch(index) {
    let element = document.getElementById(`match-${index}`);
    if (element) {
        element.scrollIntoView({ behavior: "smooth", block: "center" });
    }
}