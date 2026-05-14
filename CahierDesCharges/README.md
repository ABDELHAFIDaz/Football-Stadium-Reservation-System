# 📘 Cahier des Charges  
## Projet : Smart Football Stadium Reservation System – BALLe

---

# 🔹 Conclusion

Le projet **Smart Football Stadium Reservation System – BALLe** consiste à concevoir et développer une application web permettant la réservation intelligente de terrains de football.

Basée sur une architecture **MVC**, l’application utilise **Laravel**, **PHP** et **MySQL** afin d’offrir une solution moderne, sécurisée et évolutive.

Le système facilite la réservation des terrains pour les utilisateurs, améliore la gestion des infrastructures sportives par les responsables, et automatise l’envoi des confirmations via un service d’email.

Ce projet permet d’appliquer les principes de l’architecture MVC, de renforcer les compétences en développement web et en conception de bases de données, et de répondre à des besoins réels liés à la gestion des terrains de football.

---

# 1️⃣ Objectif du projet

L’objectif principal du projet **BALLe** est de développer une plateforme web permettant :

- La réservation en ligne de terrains de football
- L’optimisation de l’organisation et de la planification des terrains
- La gestion claire des disponibilités par les responsables
- L’accès sécurisé aux fonctionnalités selon le rôle de l’utilisateur
- L’envoi automatique de confirmations par email
- Une solution simple, performante et évolutive

---

# 🔍 Problématique

Dans de nombreux terrains de football, la gestion des réservations se fait encore de manière manuelle, ce qui entraîne :

- Des conflits de réservation
- Une mauvaise visibilité des disponibilités
- Une perte de temps pour les joueurs et les gestionnaires
- Une difficulté à suivre l’utilisation des terrains
- L’absence de confirmations automatiques

---

# 💡 Solution proposée

L’application **BALLe** propose une solution centralisée permettant :

- La gestion électronique des terrains de football et de leurs caractéristiques
- La réservation simple et rapide par les utilisateurs
- La gestion spécifique des terrains par leurs gestionnaires
- Le filtrage des terrains par ville, date et capacité
- L’envoi automatique d’emails de confirmation et de notification
- La consultation de statistiques pour optimiser l’utilisation des terrains
- Une architecture MVC claire et facile à maintenir

---

# 2️⃣ Acteurs du système

## 👨‍💼 Administrateur (Admin) — Acteur principal

- Gestion globale du système
- Création, modification et suppression des comptes utilisateurs et gestionnaires
- Supervision des terrains
- Consultation des statistiques et rapports globaux

---

## 🏟️ Gestionnaire de Stade — Acteur principal

- Gestion de ses propres terrains de football
- Mise à jour des disponibilités et de l’état des terrains
- Consultation des réservations liées à ses terrains
- Suivi du taux d’occupation

---

## 👤 Utilisateur — Acteur principal

- Recherche et consultation des terrains disponibles
- Filtrage par ville, date et capacité
- Réservation d’un terrain pour un créneau spécifique
- Consultation, modification ou annulation de ses réservations
- Réception des confirmations par email

---

## 📧 Service Email — Acteur secondaire (Système externe)

- Envoi automatique des emails de confirmation de réservation
- Notification des annulations et modifications de réservation

---

# 3️⃣ Fonctionnalités principales

## 🏟️ Gestion des terrains

- Ajouter, modifier et supprimer un terrain
- Définir la capacité, la localisation et les équipements
- Gérer l’état du terrain (*disponible, occupé, maintenance*)
- Consulter le calendrier d’occupation

---

## 📅 Réservation des terrains

- Parcourir les terrains disponibles
- Réserver un terrain pour un créneau horaire précis
- Modifier ou annuler une réservation
- Recevoir une confirmation par email

---

## 🔐 Authentification et gestion des rôles

- Authentification sécurisée
- Rôles :
  - Administrateur
  - Gestionnaire de Stade
  - Utilisateur
- Contrôle d’accès selon les permissions
- Interface adaptée à chaque rôle

---

## 📊 Statistiques et rapports

- Nombre de réservations par terrain
- Taux d’occupation des terrains
- Historique des réservations
- Rapports pour améliorer la planification

---

# 4️⃣ Architecture & Technologies

| Élément | Technologie |
|---|---|
| Architecture | MVC (Model – View – Controller) |
| Backend | Laravel / PHP |
| Base de données | MySQL |
| Frontend | HTML, CSS, JavaScript |
| Service externe | Service Email (SMTP / Mailtrap / Gmail) |

---

# 5️⃣ Exigences non fonctionnelles

- Sécurité des données et contrôle d’accès
- Interface simple et ergonomique
- Performance et stabilité
- Application responsive
- Code propre, structuré et maintenable

---

# 6️⃣ Livrables

- Code source complet de l’application
- Base de données MySQL
- Diagramme de cas d’utilisation (*Use Case Diagram*)
- Diagramme de classes
- Script SQL de création des tables avec contraintes
- Documentation courte du projet