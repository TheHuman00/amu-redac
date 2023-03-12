<p align="center">
  <a href="https://github.com/TheHuman00/amu-redac" rel="noopener">
 <img src="https://i.imgur.com/jodR2wI.jpg" alt="..."></a>
</p>

<h3 align="center">🚑 AMU-Rédac - Création de rapport amu simplifé 🚑</h3>

<div align="center">

[![Status](https://img.shields.io/badge/status-active-success.svg?style=for-the-badge&logo=statuspal)]()
<br>
[![License](https://img.shields.io/badge/license-MIT-blue.svg?style=for-the-badge)](/LICENSE)

</div>

---

<p align="center"> Web App en PHP MYSQL pour 🚑 Faire son rapport AMU au fur et à mesure ! 🏥 Aide rédaction rapport de stage.
    <br> 
</p>

## 📝 Table des matières

- [Installation](#installation)
  * [Configuration](#config)
  * [Importation de la base de données](#bdd)
  * [Mise en production](#prod)
- [Ressources](#ressources)


## 🏁 Pour commencer - Installation <a name = "installation"></a>

```bash
# Cloner le projet
$ git clone https://github.com/TheHuman00/amu-redac.git
# Accéder au dossier télécharger
$ cd amu-redac
```

### Configuration de la base de donnée <a name = "config"></a>

Allez dans le fichier `includes/config.php`.
**Si MAMP en local** -> Laisser comme ça pour faire tourner
Sinon modifier 
```php
  define( 'DB_HOST', 'URL de la BDD' );          
  define( 'DB_USER', 'USER' );             
  define( 'DB_PASS', 'PASSWORD (si pas laisser vide)' );            
  define( 'DB_NAME', 'NOM BASE DE DONNEE (redac de base)' ); 
```

### Importation de la base de données <a name = "bdd"></a>

Chercher le fichier `redac.sql`
Et mettez le dans votre base MYSQL qui se nomera **redac** (en fonction de la DB_NAME définit ci dessus)
-- Ce fichier est un template --

### Mise en prodution <a name = "prod"></a>

1. Changer le nom de domaine des coockies session dans `includes/session.sql`
2. Supprimer le `.htaccess` et remplacer le par `htaccess-prod` que vous renommerai par `.htaccess`
  (Pour avoir une règle de rewrite de l'http en l'https)


## ⛏️ Ressources  <a name = "ressources"></a>

- [PHP/HTML](https://www.php.net/) - Web Framework
- [MySQL](https://www.mysql.com/fr/) - Database
- [JS](https://www.javascript.com//) - Script divers et variés
- [Bootstrap](http://getbootstrap.com) - Bootstrap
- [StartBootsrap](http://startbootstrap.com) - Template du site