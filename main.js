var overlay = document.getElementById('overlay'),
    closeMenu = document.getElementById('close-menu');


document.getElementById('open-menu').addEventListener('click', function() {
    overlay.classList.add('show-menu');
    document.getElementById('open-menu').style.opacity = '0';
});


document.getElementById('close-menu').addEventListener('click', function() {
    overlay.classList.remove('show-menu');
    document.getElementById('open-menu').style.opacity = '1';
});


//Hier wird eine Funktion erstellt, durch die, man mittels Esc-Key das Menü schließen kann.
document.onkeydown = function(evt) {
    evt = evt || window.event;
    if (evt.keyCode == 27) {
        overlay.classList.remove('show-menu');
        document.getElementById('open-menu').style.opacity = '1'; 
    }
};

// Hover effects für die Menü-Punkte

var pointsDiv = document.getElementById('points'),
    point1 = document.getElementById('point1'),
    point1 = document.getElementById('point2'),
    point3 = document.getElementById('point3'),
    openMenu = document.getElementById('open-menu');



openMenu.addEventListener('mouseover', function() {
    pointsDiv.classList.add('animated-points');
    point3.style.transform = "translateX(-100%)";
    point1.style.transform = "translateX(100%)";
    
    point1.style.color = "black";
    point2.style.color = "black";
    point3.style.color = "black";
});

openMenu.addEventListener('mouseout', function() {
    pointsDiv.classList.remove('animated-points');
    point1.style.transform = "translateX(0)";
    point3.style.transform = "translateX(0)";

    point1.style.color = "#514945";
    point2.style.color = "#514945";
    point3.style.color = "#514945";
});









