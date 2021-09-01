<p align="center">
  <h3 align="center">Olympics Games</h3>

  <p align="center">
    Bienvenue sur le readme du projet de rattrapage.
    <br>
    Il se compose de 3 parties 
  </p>
</p>



<!-- TABLE OF CONTENTS -->
<details open="open">
  <summary><h2 style="display: inline-block">Parties</h2></summary>
  <ol>
    <li>
      <a href="#api">API</a>
      <ul>
        <li><a href="#api">Nest JS</a></li>
      </ul>
    </li>
    <li>
      <a href="#web">Application Web</a>
      <ul>
        <li><a href="#web">Public</a></li>
        <li><a href="#web">Admin</a></li>
      </ul>
    </li>
    <li><a href="#mobile">Mobile</a></li>
    
  </ol>
</details>



<!-- API -->
## API

**La première chose à faire est d'installer les dépendances.**
<br>
**Pour se faire exécuter la commande `npm i` dans le dossier `API`**



### Faire tourner l'api

* Copier coller le `.env.example` en `.env`
* Assurez-vous d'avoir les bonnes informations concernant la base de données `(DB_USERNAME, DB_HOST, DB_PASSWORD etc...)`
* Pour faire tourner l'api après avoir installé les dépendances, après avoir copié le .env, et après avoir rentré les informations relatives à la connexion de la base de données, exécuter la commande `npm run start:dev`
* Il est nécessaire de faire un seed de la base de données une fois l'API en fonctionnement pour ce faire, il faut se rendre sur l'adresse `http://127.0.0.1:3000/seeds` c'est une route protéger, il faut donc lui passer un token pour assurer l'authentification, le token est au niveau du .env dans le champs `SEEDER_TOKEN`. Url complete : `http://127.0.0.1:3000/seeds?token=$SEEDER_TOKEN` (remplacer `SEEDER_TOKEN` par la valeur dans le `.env`) 


**L'api devrait tourner sans problème**


#### Une fois l'api en fonctionnement, pour avoir une visualisation des routes disponibles de l'api vous pouvez vous rendre sur : *[swagger](http://127.0.0.1:3000/api/docs/)*

![image](https://i.ibb.co/Fbvb2DT/screencapture-127-0-0-1-3000-api-docs-2021-08-31-11-08-04.png)


<!-- WEB -->
## Application Web

Pour faire tourner l'application Web, il est nécessaire de faire d'abord `fonctionner l'api`

### Prérequis

* API en fonctionnement
* PHP
  ```
  version : >7.3 minimum
  ```
* NPM
* COMPOSER
  

### Installation

1. Installer les dépendances
   ```sh
   composer install
   ```
2. Install NPM packages
   ```sh
   npm install
   ```
3. Copier le `.env.example`
   ```sh
   cp .env.example .env
   ```
4. Donnez une `APP_KEY`
   ```sh
   php artisan key:generate
   ```
5. Générer les assets
   ```sh
   npm run prod
   ```
6. Faire fonctionner le server PHP
   ```sh
   php artisan run
   ```

#### Vous pouvez ensuite vous rendre sur `http://127.0.0.0.1/8000` pour avoir accès à l'interface *web public* 
![img](https://i.ibb.co/C87XzJR/screencapture-127-0-0-1-8000-2021-08-31-11-18-12.png)
#### Interface Admin
Pour se rendre sur l'interface admin il faut aller sur l'url `/login` pour se connecter.

Le login : `admin@olympicgames.com`

Le mot de passe : `olympicgames2024+!`

Une fois connecté, vous êtes automatiquement redirigé sur l'interface admin. 
![img](https://i.ibb.co/qWQRS7M/screencapture-127-0-0-1-8000-admin-2021-08-31-11-19-13.png)
<!-- MOBILE -->
## Application Mobile

Pour faire tourner l'application mobile il faut que vous disposiez de : 

* Dart
* Flutter

*`Si vous êtes sur mac, lancez d'abord un simulator (cmd+espace) puis notez simulator, et ouvrez simulator.app`*
<br>  
Il suffit ensuite de se rendre dans le dossier `mobile` et d'éxecuter la commande `flutter run` qui devrait `automatiquement choisir un device surlequel faire tourner l'application mobile`

![image](https://i.ibb.co/Qpy0MyZ/Simulator-Screen-Shot-i-Phone-11-2021-08-31-at-11-13-00.png)
![image](https://i.ibb.co/CWFvQ5J/Simulator-Screen-Shot-i-Phone-11-2021-08-31-at-11-13-02.png)
![image](https://i.ibb.co/VMp6sZK/Simulator-Screen-Shot-i-Phone-11-2021-08-31-at-11-13-30.png)

         

## VIDEO

Vous pouvez retrouver la video de présentation du projet [ici](https://www.youtube.com/watch?v=oA_9u3muQuU)



## Recherche internet

J'ai essentiellement utilisé la documentation des technologies choisies.

1. [Nest.js](https://docs.nestjs.com/)
2. [Laravel](https://laravel.com/docs/8.x)
3. [Flutter](https://flutter.dev/docs)
4. [TypeOrm](https://typeorm.io/#/)



## Contact

REMI GUILLARD A5 IWM - glrd.remi@gmail.com - remi.guillard@edu.devinci.fr

Lien du projet : [https://github.com/devglrd/olympic-games-IWM-REMI-GUILLARD](https://github.com/devglrd/olympic-games-IWM-REMI-GUILLARD)
