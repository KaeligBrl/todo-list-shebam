var villes = {
    "Paris": {"lat": 48.852969, "lon": 2.349903},
    // "Rennes": {"lat": 48.114722, "lon": -1.679444},
    "Bruz": {"lat": 48.0256, "lon": -1.7447},
    "Mairie de Rennes": {"lat": 48.111280, "lon": -1.678920},
    "RENNES ALMA": {"lat": 48.082561, "lon": -1.679490},
    "Gare de Rennes": {"lat": 48.103700, "lon": -1.671730},
    "Gaumont Rennes": {"lat": 48.106339, "lon": -1.675340},
    "Université de Rennes 1": {"lat": 48.1159972, "lon": -1.6731751},
    "Musée des beaux arts": {"lat": 48.1096227, "lon": -1.6749412},
    "Prefecture of the Ille-et-Vilaine": {"lat": 48.1274295, "lon": -1.6943229},
    "Centre commercial Colombia": {"lat": 48.1043139, "lon": -1.6813333, "add": "40 Place du Colombier, 35000 Rennes", "tel": "0299351777"}
};

 var mymap = L.map('mapid').setView([48.114722, -1.679444], 15);


L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
    attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODvL - rendu <a href="openstreetmap.fr">OSM France</a>', 
    minZoom: 1,
    maxZoom: 20
}).addTo(mymap);

for(ville in villes){
    var marker = L.marker([villes[ville].lat, villes[ville].lon]).addTo(mymap);

    marker.bindPopup("<b><h3>"+ville+ "</h3></b>" + villes[ville].add+ "<br/>" + "<a href=\"tel:" + villes[ville].tel + "\">"+villes[ville].tel).openPopup();
}

function getgeo() {
    map.on('locationerror', onLocationError);
    map.locate({
      setView: "true"
    });
  }
  
  function onLocationError(e) {
    alert(e.message);
  }