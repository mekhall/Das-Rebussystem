Docker
------
Om du vill förenkla installationen kan du köra i Docker. Kräver dock exempelvis Docker Desktop.

Kör då först följande i lämplig terminal bör att bygga en container, när du står i roten:

```
docker build -t rebusrally .
```

Därefter följande för att starta, mounta `C:\github\Das-Rebussystem` (ändra till din uppsättning) till containerns html-mapp, och mappa port 8080 till containerns 8080-mapp.

```
docker run -dp 8080:8080 -v C:\github\Das-Rebussystem\:/var/www/html rebusrally
```

Därefter går det att nå sidan på localhost:8080, eller från en annan dator på samma nätverk via serverns IP-adress.

På Docker i Windows kan det vara lite meckigt att få till skrivrättigheterna på mappen, då den mountade volymen ägs av 'root' istället för 'nobody'.
Detta kan man lösa igenom att endast bygga första delen av docker containern:

```
docker build --target rebusrally_root -t rebusrally_root .
```

 med samma volymmount och logga in på terminalen och köra:
```
chown -R nobody:nobody var/www/html
```

Efter det så skall det gå utmärkt att köra den vanliga dockercontainern. Börja med att titta så att rättningssidan laddar. Det kan vara bli fel vid installationen av PHP och Sqlite3.

Om förstasidan laddar men ingen av de andra sidorna så kan du öppna containern i Docker. Där finns en log du kan titta på. Om du får fel som säger att Sqlite3 inte kan laddas så kan det vara så att php har uppgraderat till en ny version utan att uppdatera vårt installationsscript. Uselt av dem.
Öppna terminalfönstret och skriv 'php --version' och se vilken version som gäller.
Om det är en nyare version än den som finns i Dockerfile så behöver du ändra på den raden som länkar in olika versioner av sqlite.
