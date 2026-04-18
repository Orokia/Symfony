 Symfony Blog - Gestion d’articles et commentaires

Application web développée avec **Symfony** permettant de gérer des articles, des commentaires et des utilisateurs avec authentification.

---
 Description

Ce projet est une application de type **blog** où :

* Les administrateurs peuvent créer et gérer des articles
* Les utilisateurs peuvent consulter les articles
* Les utilisateurs connectés peuvent ajouter des commentaires
* Chaque commentaire est lié à un utilisateur et à un article

Fonctionnalités

 Articles

* Création d’articles (admin)
* Modification / suppression
* Affichage des articles sous forme de cartes
* Page détail avec contenu complet

 Commentaires

* Ajout de commentaire sous chaque article
* Association automatique avec l’utilisateur connecté
* Affichage dynamique sous les posts

 Utilisateurs

* Inscription (register)
* Connexion (login)
* Espace compte utilisateur
* Gestion des rôles :

  * `ROLE_USER`
  * `ROLE_ADMIN`

 Sécurité

* Accès protégé selon les rôles
* Seuls les admins peuvent créer des posts
* Les utilisateurs doivent être connectés pour commenter

 Admin

* Interface d’administration avec EasyAdmin
* Gestion des posts, catégories, etc.


Technologies utilisées

* PHP 8
* Symfony
* Doctrine ORM
* Twig
* Bootstrap 5
* MySQL

---

 Installation

1. Cloner le projet

```bash
git clone https://github.com/Orokia/Symfony.git
cd Symfony
```


 2. Installer les dépendances

bash
composer install



3. Configurer la base de données

Créer un fichier `.env.local` :

env
DATABASE_URL="mysql://root:@127.0.0.1:3306/symfony_blog"
```

---

4. Créer la base de données

bash
php bin/console doctrine:database:create

 5. Lancer les migrations

bash
php bin/console doctrine:migrations:migrate
```

---

 6. Charger les données (fixtures)

bash
php bin/console doctrine:fixtures:load
```

---

 7. Lancer le serveur

```bash
symfony serve
```
 Accès : http://127.0.0.1:8000

 Comptes de test

| Rôle  | Email            | Mot de passe |
| ----- | -----------------| ------------ |
| Admin | admin@gmail.com | administration   |
| User  | user@gmail.com  | utilisateur   |

---

 Structure du projet

```
src/
 ├── Controller/
 ├── Entity/
 ├── Form/
 └── Repository/

templates/
 ├── post/
 ├── account/
 └── security/

config/
public/
```

---




 Auteur

Projet réalisé par **Orokia**

---

 Licence

Projet réalisé à des fins d’apprentissage.
