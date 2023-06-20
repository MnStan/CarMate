// tooltipInfo.js

const tooltips = {
    '3litry': 'Pojemność',
    '400km': 'Moc',
    // Dodaj inne dostosowane treści tooltipów tutaj
  };
  
  document.addEventListener('DOMContentLoaded', () => {
    // Znajdź wszystkie kontenery info-info
    const infoInfoContainers = document.querySelectorAll('.info-info');
  
    // Iteruj przez kontenery info-info
    infoInfoContainers.forEach(container => {
      // Znajdź elementy RentInfo wewnątrz kontenera
      const rentInfoElements = container.querySelectorAll('.rent-info');
  
      // Iteruj przez elementy RentInfo
      rentInfoElements.forEach(rentInfoElement => {
        // Pobierz informacje z elementu RentInfo
        const info = rentInfoElement.textContent.trim();
  
        // Sprawdź, czy istnieje dostosowany tooltip dla danej wartości
        const tooltipContent = tooltips[info];
  
        if (tooltipContent) {
          // Dodaj atrybut title z treścią tooltipa
          rentInfoElement.setAttribute('title', tooltipContent);
        }
      });
    });
  });
  