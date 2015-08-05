
## My favourite articles simple task test
## Ideja aplikacije

Osnovna ideja je izdelava aplikacije za shranjevanje naših najbolj priljubljenih člankov iz portala svet24.si

### Aplikacija naj omogoča: ###

    * Pregled člankov
    * Shranjevanje članka v bazo priljubljenih
    * Brisanje članka iz priljubljenih
    * Pregled priljubljenih

## Pogoji

### Aplikacija naj bo izdelana s pomočjo: ###

    * AngularJS https://angularjs.org/
    * PHP http://php.net/
    * MySQL http://mysql.com/
    * Uporaba PHP frameworkova Laravel http://laravel.com/
    * Oblika naj bo Twitter Bootstrap http://getbootstrap.com/

### Orodja, ki znajo samo nalogo precej olajšat: ###

    * Composer https://getcomposer.org/
    * Bower http://bower.io/
    * yeoman http://yeoman.io/

## Strani
### Pregled člankov ###

Osnovna stran aplikacije je pregled članov iz svet24.si. Z AngularJS naj se preberejo članki (top 20) in izpišejo na podoben način kot na spodnji sliki.

Zraven članka naj se doda gumb "Dodaj med priljubljene", ki pokliče lasten API, ki shrani članek med priljubljene (mysql baza) - POST klic na API.

![clanki](http://i.imgur.com/XcxFtRA.png)

### Osnovni podatki: ###

    Članki so dostopni preko kme API-ja na naslovu: http://api.kme.si/v1/articles. API resource se kliče preko GET metode z GET parametri "resource_id=22", "order=desc" ter "limit=20"
    Podatki iz API odgovora:
        * title: Naslov članka
        * section_name: Ime sekcije - sekcije so ločene z " / ". V kvadratku naj se izpiše zadnja sekcija - zaželena izdelava AngularJS filtra
        * image: Slika članka - pri naslovu je potrebno ##WIDTH## in ##HEIGHT## zamenjati z 237 - zaželena izdelava AngularJS filtra

## Pregled priljubljenih

Stran pregled priljubljenih je identična pregledu člankov, samo da članke prebere iz lastnega API-ja - GET klic na API.

Namesto gumba "Dodaj med priljubljene" je zraven članka gumb "Odstrani iz priljubljenih", ki članek pobriše iz priljubljenih - DELETE klic na API

Pod priljubljenih člankih naj, se izpiše še zadnjih 20 novih člankov s pomočjo "sliderja" (prikaznih 5 člankov + puščici levo-desno za prikaz več). Zaželena je animacija (nganimate).

Primer oblike:

![oblika](http://i.imgur.com/9yhDKjP.png)

## API

API naj vsebuje 1 end-point (recimo: /articles), in naj deluje preko GET, POST in DELETE. End-point je zaščiten z OAuth 2.0:

    * GET: pridobi priljubljene članke
    * POST: dodaj nov priljubljen članek
    * DELETE: izbriši priljubljen članek

API naj omogoča prijavo uporabnika preko OAuth 2.0. S tem se dobi dostop do branja, dodajanja in brisanja priljubljenih člankov.