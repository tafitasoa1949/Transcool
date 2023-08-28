var map = L.map('map').setView([-18.8792, 47.5079], 6);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors<br><b>Transcool Madagascar</b>',
          maxZoom: 18
        }).addTo(map);

        L.marker([-18.8792, 47.5079]).addTo(map)
          .bindTooltip('Antananarivo', { direction: 'top', permanent: true, className: 'province-label' });

        L.marker([-23.35, 43.67]).addTo(map)
          .bindTooltip('Toliara', { direction: 'top', permanent: true, className: 'province-label' });

        L.marker([-21.45, 47.09]).addTo(map)
          .bindTooltip('Fianarantsoa', { direction: 'top', permanent: true, className: 'province-label' });

        L.marker([-22.15, 48.02]).addTo(map)
          .bindTooltip('Manakara', { direction: 'top', permanent: true, className: 'province-label' });

        L.marker([-18.15, 49.41]).addTo(map)
          .bindTooltip('Toamasina', { direction: 'top', permanent: true, className: 'province-label' });

        L.marker([-15.67, 46.34]).addTo(map)
          .bindTooltip('Mahajanga', { direction: 'top', permanent: true, className: 'province-label' });
        L.marker([-20.28, 44.28]).addTo(map)
          .bindTooltip('Morondava', { direction: 'top', permanent: true, className: 'province-label' });

