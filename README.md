# Neo Start Technology - Base Standard Backend

Ce projet sert de base technique robuste pour les sites web standards de **Neo Start Technology**.  Il centralise les fonctionnalités récurrentes telles que la gestion des comptes, du blog, des services et des interactions clients (formulaire de contact).

## 🚀 Fonctionnalités Clés

- **Authentification & Rôles** : Système sécurisé (via Laravel Sanctum) avec distinction entre `admin` et `superadmin`.
- **Gestion de Contenu (Blog)** : Système complet de gestion d'articles avec images associées.
- **Services** : Présentation et gestion dynamique des services proposés.
- **Messagerie** : Gestion des messages entrants via le formulaire de contact, avec système de réponse par email intégré.
- **Branding Dynamique** : Utilisation de la variable `APP_NAME` dans tout le projet (notamment les emails).
- **Configuration Sociale & Contact** : Points d'entrée pour la modification dynamique des liens de réseaux sociaux et des coordonnées de l'agence.

---

## 🛠 Structure Technique

### 📦 Modèles & Migrations (Bases de données)

Le projet utilise des **UUID** pour tous les identifiants primaires afin de renforcer la sécurité et la flexibilité.

| Modèle / Table | Migration Source | Attributs (Colonnes) |
| :--- | :--- | :--- |
| **`User`** / `users` | `0001_01_01_000000_create_users_table.php` | `id` (UUID), `nom`, `prenom`, `email` (Unique), `telephone` (Null), `password`, `role` (Admin/Superadmin/User), `email_verified_at`, `remember_token`, `timestamps` |
| **`Service`** / `services` | `2026_03_28_110103_create_services_table.php` | `id` (UUID), `titre`, `description` (Text), `image` (Null), `timestamps` |
| **`Blog`** / `blogs` | `2026_03_28_110104_create_blogs_table.php` | `id` (UUID), `titre`, `contenu` (LongText), `categorie`, `timestamps` |
| **`Image`** / `images` | `2026_03_28_110105_create_images_table.php` | `id` (UUID), `path`, `id_blog` (FK Blogs, Cascade), `is_couverture` (Boolean), `timestamps` |
| **`Message`** / `messages` | `2026_03_28_110106_create_messages_table.php` | `id` (UUID), `expediteur`, `email`, `telephone` (Null), `objet`, `contenu` (Text), `is_read` (Boolean, default:false), `timestamps` |
| **`Contact`** / `contacts` | `2026_03_28_110105_create_contacts_table.php` | `id` (UUID), `telephone1` (Null), `telephone2` (Null), `email` (Null), `adresse` (Null), `timestamps` |
| **`Lien`** / `liens` | `2026_03_28_110105_create_liens_table.php` | `id` (UUID), `instagram` (Null), `facebook` (Null), `x` (Null), `tiktok` (Null), `timestamps` |

> [!NOTE]
> **Tables Système** : Le projet inclut également les tables standards de Laravel pour la gestion des jetons d'accès (`personal_access_tokens`), des sessions (`sessions`), des files d'attente (`jobs`, `failed_jobs`) et du cache (`cache`).

### 🛣 Routes de l'API

Les routes sont définies dans `routes/api.php` et sont divisées en deux sections :

#### Routes Publiques (Accès libre)
- **Authentification** : `POST /login`
- **Contenu** : `GET /services`, `GET /blogs`, `GET /liens`, `GET /contacts`
- **Contact** : `POST /messages` (soumission du formulaire de contact)

#### Routes Protégées (Admin / Sanctum)
- **Profil** : `PUT /profile/info`, `PUT /profile/password`
- **Gestion Admins** : `GET/POST/PUT/DELETE /admins` (réservé au superadmin)
- **CRUD Contenu** : Gestion complète des services, articles de blog et images.
- **Messagerie Admin** : `GET /messages` (liste), `POST /messages/reply` (système de réponse).

### 📧 Système de Mail

Le projet utilise des Mailables (`app/Mail/`) couplés à des templates Blade (`resources/views/emails/`).

- `AdminCreatedMail` : Envoyé lors de la création d'un nouveau compte administrateur.
- `NewMessageMail` : Notifie les admins lors d'une nouvelle soumission de contact.
- `ReplyMail` : Email envoyé au client après une réponse de l'admin.

> [!TIP]
> **Configuration du Branding** : Le projet utilise `config('app.name')`. Pensez à modifier `APP_NAME` dans votre fichier `.env`. Pour les logos, remplacez le fichier `public/images/logo-fond-blanc.png` par celui de votre client.

### 🌱 Seeders (Initialisation)

Le `DatabaseSeeder.php` initialise :
1. Un compte **Superadmin** par défaut (`admin@neostart.com` / `password`).
2. Une ligne par défaut pour les **Liens sociaux** (vide).
3. Une ligne par défaut pour les **Contacts** (vide).

---

## ⚙️ Installation

1. Cloner le repository.
2. Installer les dépendances : `composer install`.
3. Configurer le fichier `.env` (BDD, APP_NAME, MailTrap/STMP).
4. Générer la clé : `php artisan key:generate`.
5. Lancer les migrations et les seeders : `php artisan migrate --seed`.

---

## 📝 À propos de Neo Start Technology
Ce socle est maintenu pour garantir une cohérence technique sur tous nos projets et accélérer les phases de développement initiales.

