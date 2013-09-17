trailmap
========
Idea

Karttasaitti palvelemaan juoksijayhteisöä. Poluissa kulkukelpoisuusluokittelu, esim nopeaa, hidasta, kivikkoa, juuria, suota tms. Tausta-aineisto maastotietokannasta. Polut käyttäjien GPS-trackeista



Arkkitehtuuri

Tausta-aineisto mml?-->Postgis
Polut:gpx--> Postgis

Julkaisu: geoserver/wms
Saitti: openlayers, leaflet?
Data sisään , editointi: geoserver/ wfs-t
Some plugin: fb (no oishan se pähee)
Käyttäjien arvostelut(?): postgres,geoserver, wfs

Kielet:
Sql
Xml/sld
JavaScript
Html5?
Html, css

Backlog:

Ympäristön pystytys:

   Postgres, postgis,
   Geoserver

Tietomallin määrittely:

   Polun ominaisuudet,
   Taulujen luonti

Datan sisäänluku:

   Maastodata
   Polkudata

Kuvaustekniikat:

   Maasto
   Polku

Rajapinnan luonti:

  Wms, wfs
  
Karttasaitti

Sisäänluku/editori:

  Gpx2postgis,
  Raakadatan pilkkominen ja luokittelu,
  Tallennus julkaisukantaan
  
