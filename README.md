
# Socialinių tinklų svetainė

Ši sistema turi pagrindines socialinio tinklo funkcijas, tokias kaip draugų pridėjimas, įrašų pridėjimas ir jų komentavimas. Taip pat yra galimybė redaguoti savo profilį ir pridėti paryškintus įvykius




## Reikalavimai
- PHP
- MySql DB
- Composer

## Projekto paleidimas

1. Nukopijuokite sistemos GitHub repozitoriją

```bash
  git clone https://github.com/RafalKLab/Ourlife
```

2. Nueikite į projekto aplanką

```bash
  cd Ourlife
```

3. Įdiekite Composer priklausomybes

```bash
  composer install
```

4. Įdiekite NPM priklausomybes

```bash
  npm install
```

5. Sukurkite .env failo kopiją

```bash
  cp .env.example .env
```

6. Sugeneruokite programos raktą (app encryption key)

```bash
  php artisan key:generate
```

7. Sukurkite sistemai naują duomenų bazę 
8. Į .env failą pridėkite naujai sukurtos duomenų bazės informaciją

`DB_DATABASE` = duomenų bazės pavadinimas

`DB_USERNAME` = duomenų bazės vartotojas

`DB_USERNAME` = duomenų bazės slaptažodis

Pavyzdys
```
DB_DATABASE=naujienos
DB_USERNAME=root
DB_PASSWORD=
```

9. Perkelkite migracijos lentelės į duomenų bazę

```bash
  php artisan migrate
```


    
## Programos diegimas

Projekto aplanko viduje naudokite komandą:

```bash
  php artisan serve
```


## Autoriai

- [@RafalKLab](https://github.com/RafalKLab)

