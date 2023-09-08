# CarMate

## Cel projektu:

Celem projektu było stworzenie aplikacji pozwalającej uzytkownikom dodawanie oraz przeglądanie ogłoszeń dotyczących wynajmu pojazdów.

## Funkcjonalności:

- logowanie
- rejestracja
- wylogowywanie
- przeglądanie ogłoszeń
- wyświetlanie ogłoszenia
- wyszukiwanie ogłoszeń
- dodawanie ogłoszeń

## Diagram UML Klas

![Zrzut ekranu 2023-09-8 o 16 52 17](https://github.com/MnStan/CarMate/assets/58117854/a5f7ea5b-5350-420e-8ef9-17f32964edea)


## Diagram ERD Bazy

![image](https://github.com/MnStan/CarMate/assets/58117854/431da79f-74f4-43da-8c8a-0de5338a0d8d)


## Struktura Folderów:

```
CarMate/
├─ docker/
│  ├─ nginx/
│  ├─ php/
├─ public/
│  ├─ css/
│  │  ├─ components/
│  │  ├─ variables/
│  ├─ img/
│  │  ├─ input/
│  │  ├─ logo/
│  │  ├─ photos/
│  ├─ js/
│  ├─ uploads/
│  ├─ views/
│  │  ├─ components/
├─ src/
│  ├─ controllers/
│  ├─ data/
│  ├─ models/
│  ├─ repository/
```

## Figma

[Link FIGMA](https://www.figma.com/file/tK30FC4XitTO8eHh2NIADf/AutoMate?type=design&node-id=0%3A1&mode=design&t=COMCQzptgoD1hKS1-1)

## Przykład Działania:

#### Podczas pierwszych odwiedzin strony użytkownik ma możliwość zalogowania bądz zarejestrowania się.

![image](https://github.com/MnStan/CarMate/assets/58117854/39a2feee-0c89-4729-85ad-ae15ee9d55c1)

#### Do rejestracji użytkownik potrzebuje podać imie, nazwisko, adres email, hasło, numer telefonu, miasto oraz adres. Wszystkie pola muszą być wypełnione, aby rejestracja przebiegła pomyślnie.

![image](https://github.com/MnStan/CarMate/assets/58117854/747c9021-85ba-46ec-a47c-5ab5199abca2)

#### Użytkownik może się też zalogować na już istniejące konto.

![image](https://github.com/MnStan/CarMate/assets/58117854/0f575640-df11-4fd2-87b4-9e8e3eecb456)

#### Po zalogowaniu użytkonik zostaje przeniesiony na stronę głowną 

![image](https://github.com/MnStan/CarMate/assets/58117854/33ff6013-d7d7-4143-960f-2ac59592563b)

#### Na stronie głownej użytkownik może przeglądać dodane ogłoszenia, dodać swoje ogłoszenie lub wyszukać interesującego go modelu przy użyciu wyszukiwarki

![image](https://github.com/MnStan/CarMate/assets/58117854/caa76816-a8a9-4457-ab0d-c0b92b181717)

#### Wyszukiwanie:

![image](https://github.com/MnStan/CarMate/assets/58117854/e90e2bc5-8114-4c90-9569-6e09dc1f6bc1)

![image](https://github.com/MnStan/CarMate/assets/58117854/41013123-e4eb-441f-8ba9-74cb02208492)

#### Użytkownik po kliknięciu w interesujące go ogłoszenie zostaje przeniesiony do strony z informacjami o danym pojeździe takimi jak: zdjęcia pojazdu, informacje o właścicielu, opis

![image](https://github.com/MnStan/CarMate/assets/58117854/2626699f-5247-4333-a0c3-98e28896c25e)

#### Użytkownik może nacisnąć przycisk "Umów jazdę próbną" po czym wyświetlą mu się informacje kontaktowe do właściciela

![image](https://github.com/MnStan/CarMate/assets/58117854/fc246ae8-41b1-4592-b9a7-a35880a331e1)

#### Dodanie pojazdu następuje po uzupełnieniu przez użytkownika takich informacji jak: zdjęcie głowne ogłaszanego pojazdu, zdjęcia dodatkowe, nazwę pojazdu, miasto w którym oferowany jest najem oraz opis

![image](https://github.com/MnStan/CarMate/assets/58117854/6e9fb21f-821a-496e-bc19-b200f8185e98)

#### Aplikacja posiada również takie podstrony jak regulamin, kontakt czy polityka prywatności strony

![image](https://github.com/MnStan/CarMate/assets/58117854/dedd21af-28f5-4cab-9d8e-6ba2f7552985)

#### Po skorzystaniu z usług aplikacji użytkownik może się wylogować a aplikacja przeniesie go do strony którą widział przy pierwszym uruchomieniu aplikacji

![image](https://github.com/MnStan/CarMate/assets/58117854/87d30e55-ca43-4e05-8d4c-85fd0322e6b8)

#### Aplikacja jest dostosowana do używania jej na komputerach, tabletach oraz telefonach komórkowych

![image](https://github.com/MnStan/CarMate/assets/58117854/2e1cac0f-cd5f-45c8-a8a8-172a74bea05e)

## Wzorce projektowe

### MVC

Ten projekt wykorzystuje wzorzec projektowy Model-View-Controller (MVC) do organizacji kodu i reprezentacji danych. Wzorzec ten pomaga w klarownym podziale odpowiedzialności w aplikacji, co ułatwia zarządzanie i rozwijanie projektu.

#### Model
W folderze "src/models" znajdują modele, które odpowiadają za strukturę danych w aplikacji. Modele definiują właściwości i metody, które pozwalają na operowanie na danych. Są one niezależne od logiki biznesowej i pomagają w klarownej reprezentacji informacji.

#### Repozytorium
Logika biznesowa jest obsługiwana w folderze "src/repository". Repozytorium jest odpowiedzialne za operacje na danych, takie jak pobieranie, przetwarzanie i zapisywanie. Wykorzystuje modele, aby reprezentować dane, i dostarcza interfejsy do komunikacji między kontrolerami a bazą danych.

#### Kontroler
Kontrolery w folderze "src/controllers" obsługują żądania użytkownika i komunikują się zarówno z repozytorium, jak i widokami. Kontrolery korzystają z repozytorium do pobierania danych i przekazują te dane do widoków w celu wyświetlenia ich użytkownikowi.

#### Widoki
Folder "public/views" zawiera widoki, które są odpowiedzialne za prezentację danych użytkownikowi. Widoki wykorzystują modele do wyświetlania danych w atrakcyjny sposób. Kontrolery przekazują dane do widoków, które następnie są renderowane i wyświetlane użytkownikowi.

#### Dependency Injection
Wstrzykiwanie zależności (DI) to technika, która polega na przekazywaniu obiektów, których klasa potrzebuje do działania, zamiast tworzyć je wewnątrz klasy. Jest to ważny koncept, który pomaga w tworzeniu bardziej elastycznych i skalowalnych aplikacji.

W strukturze katalogowej projektu, która obejmuje foldery "src/controllers", "src/models", i "src/repository", można skorzystać z kontenera DI do zarządzania zależnościami. Kontener DI, często dostarczany przez popularne biblioteki lub frameworki, ułatwia konfigurację i dostarczanie potrzebnych zależności klasom w aplikacji.

Wprowadzanie Wstrzykiwania Zależności do projektu przyczynia się do jego lepszej organizacji, a także ułatwia utrzymanie i rozwijanie kodu. Dzięki tej technice, aplikacja staje się bardziej skalowalna i bardziej przyjazna dla testowania. Wszystkie zależności są zarządzane centralnie, co ułatwia wprowadzanie zmian i poprawki w kodzie.

#### Signleton
Wzorzec Singleton jest wykorzystywany w klasie Database.php, która służy do zarządzania jedną, globalną instancją połączenia z bazą danych. Dzięki zastosowaniu tego wzorca, zapewniamy, że istnieje tylko jedna instancja klasy Database, co ma wiele zalet w kontekście zarządzania połączeniem z bazą danych w aplikacji.

W klasie Database.php znajduje się statyczna metoda getInstance(), która jest odpowiedzialna za zwracanie instancji klasy Database. Gdy ta metoda zostaje wywołana, sprawdzane jest, czy instancja już istnieje. Jeśli tak, to istniejąca instancja zostaje zwrócona. Jeśli natomiast instancja jeszcze nie istnieje, tworzona jest nowa i zwracana. Dzięki temu mamy pewność, że zawsze korzystamy z jednej, globalnej instancji klasy Database w całej aplikacji.

#### Front Controller
W pliku index.php aplikacji, po rozpoczęciu sesji, zachodzi kluczowy proces parsowania ścieżki z żądania HTTP. Ten istotny etap obsługi żądania jest realizowany za pomocą klasy Router, która odpowiada za mapowanie ścieżek żądań na konkretne kontrolery.

Wszystkie reguły dotyczące mapowania ścieżek są precyzyjnie zdefiniowane wewnątrz klasy Router. Następnie ta klasa uruchamia metodę run(), przekazując jej zparsowaną ścieżkę z żądania jako parametr. To właśnie w tej chwili następuje przekierowanie żądania do odpowiedniego kontrolera, zgodnie z wcześniej określonymi mapowaniami.

Zastosowanie wzorca Front Controller w pliku index.php pozwala na to, że wszystkie żądania, niezależnie od ich źródła czy typu, są kierowane do jednego, centralnego punktu wejścia w naszej aplikacji. Ta jednolitość pozwala na znacznie łatwiejsze zarządzanie i rutowanie żądaniami, ponieważ cała obsługa żądań zaczyna się od tego właśnie punktu. To z kolei przekłada się na większą kontrolę nad procesem obsługi żądań oraz lepszą organizację kodu aplikacji.

## Rozwój projektu w przyszłości

- Umożliwienie komunikacji pomiędzy osobą dodającą ogłoszenie i przeglądającą
- Dodanie możliwości zarezerwowania terminu wypożyczenia pojazdu bezpośrednio w aplikacji
- Dodanie możliwości moderowania ogłoszeń przez osobę uprawnioną
- Dodanie profili użytkowników

