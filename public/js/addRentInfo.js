document.getElementById('add-car-info').addEventListener('click', function() {
    var container = document.getElementById('car-info-container');
    var rentInfoElement = container.querySelector('.info-title').cloneNode(true);

    rentInfoElement.querySelector('.info-title-content').value = '';

    if (container.children.length < 11) {
        container.appendChild(rentInfoElement);
    } else {
        alert("Osiągnięto maksymalną liczbę elementów.");
    }
});

document.getElementById('add-rent-info').addEventListener('click', function() {
    var container = document.getElementById('rent-info-container');
  
    if (container.children.length < 11) {
        var rentInfoElement = container.querySelector('.info-title').cloneNode(true);
        rentInfoElement.querySelector('.info-title-content').value = '';
        container.appendChild(rentInfoElement);
    } else {
        alert("Osiągnięto maksymalną liczbę elementów.");
    }
});
