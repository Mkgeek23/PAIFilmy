# PAIFilmy [PHP + MySQL]

Aplikacja internetowa będąca wypożyczalnią filmów, które po zakupie można w niej obejrzeć.

Wykorzystane technologie:
<div align="center">  
<a href="https://www.w3schools.com/css/" target="_blank"><img style="margin: 10px" src="https://profilinator.rishav.dev/skills-assets/css3-original-wordmark.svg" alt="CSS3" height="50" /></a>  
<a href="https://en.wikipedia.org/wiki/HTML5" target="_blank"><img style="margin: 10px" src="https://profilinator.rishav.dev/skills-assets/html5-original-wordmark.svg" alt="HTML5" height="50" /></a>  
<a href="https://www.javascript.com/" target="_blank"><img style="margin: 10px" src="https://profilinator.rishav.dev/skills-assets/javascript-original.svg" alt="JavaScript" height="50" /></a>  
<a href="https://www.mysql.com/" target="_blank"><img style="margin: 10px" src="https://profilinator.rishav.dev/skills-assets/mysql-original-wordmark.svg" alt="MySQL" height="50" /></a>  
<a href="https://www.php.net/" target="_blank"><img style="margin: 10px" src="https://profilinator.rishav.dev/skills-assets/php-original.svg" alt="PHP" height="50" /></a>  
<a href="https://www.apachefriends.org/" target="_blank"><img style="margin: 10px" src="https://profilinator.rishav.dev/skills-assets/xampp.png" alt="XAMPP" height="50" /></a>  
</div>

## Strona główna

Na stronie głównej możemy znaleźć dwie karuzele przedstawiające ostatnio dodane filmy oraz te najpopularniejsze wśród innych użytkowników.

![App Screenshot](screenshots/screen1.png)

## Katalog

Przechodząc na podstronę "Katalog" możemy przejrzeć wszystkie filmy dostępne na stronie. Dodatkowo mamy możliwość posortowania ich po:

- dacie dodania
- alfabetycznie
- popularności

Lista filmów może również zostać odfiltrowana według gatunku filmu oraz kraju produkcji.

![App Screenshot](screenshots/screen2.png)

## Rejestracja

Strona posiada możliwość założenia konta za pomocą podstrony "Zarejestruj się"

W formularzu rejestracyjnym należy wypełnić 4 pola:

- nazwa użytkownika
- adres email
- hasło
- powtórz hasło

Dodatkowo pole "nazwa użytkownika" oraz "hasło" posiadają ikonę wykrzyknika, która po aktywacji poprzez najechanie myszą pokazuje wytyczne do tych pól.

W przypadku źle wypełnionych pól zostaną one oznaczone na czerwono oraz zostanie wyświetlona wskazówka mówiąca o tym co zostało wypełnione źle.

![App Screenshot](screenshots/screen3.png)

## Logowanie

Gdy posiadamy konto w serwisie, za pomocą strony logowania możemy się zalogować podając login oraz hasło.

![App Screenshot](screenshots/screen4.png)

## Użytkownik zalogowany

Jako użytkownik zalogowany mamy dostęp do nowych podstron

- moje filmy - zawierającą filmy posiadane przez użytkownika
- koszyk - pokazującą filmy znajdujące się w koszyku użytkownika
- ustawienia - pozwalającą na zmianę ustawień użytkownika, dodanie adresu oraz sprawdzenie historii zamówień
- wyloguj się - służącą wylogowaniu użytkownika

## Strona filmu

Wybierając jakiś film z katalogu lub ze strony głównej zostajemy przeniesieni na stronę ze zwiastunem oraz opisem danego filmu. Znajduje się tam także przycisk pozwalający na zakup filmu.

![App Screenshot](screenshots/screen5.png)

## Koszyk

Po naciśnięciu przycisku zakup, produkt znajduje się w naszym koszyku, z którego możemy podejrzeć produkty w koszyku, usunąć je z koszyka oraz zfinalizować zakup

![App Screenshot](screenshots/screen6.png)

## Moje filmy

Strona wyświetla wszystkie posiadane przez nas filmy. Każdy zakupiony przez nas film zostaje oznaczony zieloną ikoną w lewym górnym rogu.

![App Screenshot](screenshots/screen7.png)

Wejście w zakupiony przez nas film przeniesie nas do strony, na której będziemy mogli go obejrzeć.

![App Screenshot](screenshots/screen8.png)

## Ustawienia

Strona ustawień pozwala na zmianę adresu email oraz hasła, dodanie, edycję lub usunięcie naszego fizycznego adresu, a także podgląd dokonanych przez nas transakcji

![App Screenshot](screenshots/screen9.png)

## Historia płatności

Na tej podstronie możemy zobaczyć historię transakcji dokonanych przez użytkownika oraz przejść do szczegółów każdej z nich.

![App Screenshot](screenshots/screen10.png)
![App Screenshot](screenshots/screen11.png)

## Wyszukiwanie filmów

Strona pozwala na wyszukiwanie filmów za pomocą pola "Wyszukaj" znajdującego się w pasku nawigacyjnym u góry strony. Aby wyszukać film należy wpisać dowolną frazę powiązaną z danym filmem.

![App Screenshot](screenshots/screen12.png)

## Panel administracyjny

Istnieją dwa rodzaje kont:
- zwykły użytkownik
- administrator

Administrator ma dostęp do panelu administracyjnego, gdzie przy pomocy formularza może dodawać nowe filmy do sklepu.

![App Screenshot](screenshots/screen14.png)
