# Zadanie testowe 
## Przed uruchomienie
Instalacja dodatkowych paczek oraz tworzenie autoload. 
```bash
composer install
```
## Uruchomienie
Plik wejściowy speed.php Należy go uruchomić z poziomu konsoli.Należy podać akcje `start`. Jest możliwość uruchomienia wersji produkcyjnej lub developerskiej przez dodanie opcji `-e [dev|prod]`

Przykładowe uruchomienie:
 
```bash
./speed.php start -e dev
```

## Zadanie
GPS w samochodzie zapisuje co s sekund odległość przejechaną od początku trasy
(odległość jest mierzona bez określonej jednostki). Poniżej przykładowy zapis odległości
dla s = 15:

x = [0.0, 0.19, 0.5, 0.75, 1.0, 1.25, 1.5, 1.75, 2.0, 2.25]

Powyższy wynik możemy podzielić na następujące sekcje:
0.0-0.19, 0.19-0.5, 0.5-0.75, 0.75-1.0, 1.0-1.25, 1.25-1.50, 1.5-1.75, 1.75-2.0, 2.0-2.25
Możemy obliczyć średnią prędkość na godzinę dla każdej sekcji, w wyniku czego
otrzymamy:

[45.6, 74.4, 60.0, 60.0, 60.0, 60.0, 60.0, 60.0, 60.0]

Znając s oraz x zadaniem jest napisanie programu w języku PHP obliczającego
maksymalną średnią prędkość na godzinę, zaokrągloną w dół do wartości całkowitej.
Jeżeli ilość pomiarów wynosi 1 lub mniej przyjmuje się, że samochód nie poruszał się i
maksymalna średnia prędkość na godzinę wynosi 0.
Przykład: dla powyższych danych maksymalna średnia prędkość na godzinę wynosi 74.
Zakładamy, że pomiary są przechowywane w bazie danych (schemat poniżej). Listing 1
prezentuje raport, który powinien być wyświetlony po uruchomieniu programu.
Wyniki operacji arytmetycznych na liczbach zmiennoprzecinkowych mogą zależeć od
kolejności wykonywania operacji. Dla obliczenia prędkości na godzinę można posłużyć się
formułą:
(3600 * delta) / s.