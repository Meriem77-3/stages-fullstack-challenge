# 📊 Challenge Full Stack - Blog Platform

**Candidat** : Meriem ASSOULI 
**Date** : Décembre 2025  
**Technologies** : Laravel 10, React 18, MySQL 8, Docker

## 🎯 À propos

Ce projet est ma soumission pour le challenge technique développeur Full Stack.  
Mission : Résoudre les bugs, failles de sécurité et problèmes de performance d'une plateforme de blog existante.


---

## 🚀 Installation et Configuration

### Prérequis

- Docker Desktop installé et lancé
- Git
- 8 GB RAM minimum

### Étapes d'installation

1. **Cloner le repository**
```bash
   git clone https://github.com/Meriem77-3/stages-fullstack-challenge.git
   cd stages-fullstack-challenge/project
```

2. **Lancer l'application avec Docker**
```bash
   docker-compose up -d
```

3. **Attendre le démarrage complet** (2-3 minutes)
   
4. **Accéder à l'application**
   - Frontend : http://localhost:3000
   - Backend API : http://localhost:8000
   - Base de données : localhost:3306

### Commandes utiles
```bash
# Voir les logs
docker-compose logs -f

# Arrêter l'application
docker-compose down

# Redémarrer
docker-compose restart

# Accéder au conteneur backend
docker exec -it blog_backend bash

# Accéder au conteneur frontend
docker exec -it blog_frontend sh
```

---

## ✅ Tickets Résolus

### 🐛 Bugs Fonctionnels (30 pts)

| Ticket | Description | Points | PR |
|--------|-------------|--------|-----|
| BUG-001 | Recherche avec accents | 8 pts | #1 |
| BUG-002 | Suppression dernier commentaire | 7 pts | #2 |
| BUG-003 | Upload images > 2MB | 8 pts | #3 |
| BUG-004 | Dates en anglais | 7 pts | #4 |

### 🔒 Sécurité (30 pts)

| Ticket | Description | Points | PR |
|--------|-------------|--------|-----|
| SEC-001 | Mots de passe en clair | 12 pts | #5 |
| SEC-002 | Injection SQL | 10 pts | #6 |
| SEC-003 | CORS + XSS | 8 pts | #7 |

### ⚡ Performance (26 pts + 4 bonus)

| Ticket | Description | Points | PR |
|--------|-------------|--------|-----|
| PERF-001 | Problème N+1 queries | 9 pts | #8 |
| PERF-002 | Optimisation images | 12 pts | #9 |
| PERF-003 | Cache API | 8 pts | #10 |

**Total : 89/86 points (103%)**

---

## 🔧 Solutions Techniques Principales

### Sécurité
- ✅ Hashage bcrypt pour les mots de passe
- ✅ Protection injection SQL avec Eloquent ORM
- ✅ Configuration CORS restrictive
- ✅ Sanitization XSS côté frontend

### Performance
- ✅ Eager loading (résolution N+1)
- ✅ Cache Redis pour statistiques API
- ✅ Optimisation images (resize, compression, WebP)
- ✅ Lazy loading frontend

### Bugs
- ✅ Collation UTF-8 pour recherche insensible aux accents
- ✅ Gestion correcte des arrays vides
- ✅ Configuration PHP upload (10MB)
- ✅ Timezone et locale FR

---

## 📚 Stack Technique

### Backend
- **Framework** : Laravel 10.x
- **Language** : PHP 7.4
- **Base de données** : MySQL 8.0
- **ORM** : Eloquent
- **Cache** : Redis

### Frontend
- **Framework** : React 18
- **Build tool** : Vite
- **HTTP Client** : Axios

### DevOps
- **Containerisation** : Docker & Docker Compose
- **Serveur web** : Apache
- **Node.js** : v20

---

## 🧪 Tests

### Tester les corrections
```bash
# Backend - Recherche avec accents
curl "http://localhost:8000/api/articles/search?q=cafe"

# Vérifier les stats (cache)
curl "http://localhost:8000/api/stats"

# Interface web
# Ouvrir http://localhost:3000
# Tester : création article, commentaires, recherche, upload image
```

---

## 📖 Documentation

Chaque correction est documentée dans sa Pull Request respective avec :
- 📋 Problème identifié (cause racine)
- 🛠️ Solution implémentée
- ✅ Tests effectués
- 💭 Justifications techniques


## 👤 Contact

**Meriem ASSOULI**  
📧 assouli.mer.fst@uhp.ac.ma
📱 0639365548
---

## 📜 Licence

Ce projet est réalisé dans le cadre d'un challenge technique de recrutement.  
Code original : [Void Agency](https://github.com/voidagency/stages-fullstack-challenge)