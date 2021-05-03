var mymap = L.map('mapid').setView([48.114722, -1.679444], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
            attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODvL - rendu <a href="openstreetmap.fr">OSM France</a>', 
            minZoom: 1,
            maxZoom: 20
        }).addTo(mymap);

        var marker = L.marker([48.114722, -1.679444]).addTo(mymap);

        marker.bindPopup("<b>Rennes</b>").openPopup();

        function getgeo() {
            map.on('locationerror', onLocationError);
            map.locate({
              setView: "true"
            });
          }
          
          function onLocationError(e) {
            alert(e.message);
          }