# Test Technique - Backend Symfony

Projet Symfony 6.4 avec API Platform, EasyAdmin et Messenger.

## 🚀 Installation

### Prérequis
- Docker & Docker Compose

### Démarrage rapide
```bash
# Cloner le projet
git clone <votre-repo>
cd technical-test

# Démarrer les conteneurs
docker-compose up -d

# Installer les dépendances
docker-compose exec php composer install

# Lancer les migrations
docker-compose exec php bin/console doctrine:migrations:migrate --no-interaction

# Charger les fixtures (optionnel)
docker-compose exec php bin/console doctrine:fixtures:load --no-interaction
```

## 📍 Accès

- **API** : http://localhost:8000/api
- **Swagger UI** : http://localhost:8000/api (documentation interactive)
- **Admin** : http://localhost:8000/admin

## 🔄 Messenger (Consumer)

Pour traiter les messages asynchrones :
```bash
docker-compose exec php bin/console messenger:consume async -vv
```

## 🧪 Tester l'API

### Créer une catégorie
```bash
curl -X POST http://localhost:8000/api/categories \
  -H "Content-Type: application/ld+json" \
  -d '{"designation": "Électronique"}'
```

### Créer un produit
```bash
curl -X POST http://localhost:8000/api/products \
  -H "Content-Type: application/ld+json" \
  -d '{"designation": "iPhone 15"}'
```

### Affecter des catégories à un produit
```bash
curl -X PATCH http://localhost:8000/api/products/1 \
  -H "Content-Type: application/merge-patch+json" \
  -d '{"categories": ["/api/categories/1", "/api/categories/2"]}'
```

### Filtrer les produits
```bash
# Par désignation
curl http://localhost:8000/api/products?designation=iPhone

# Par catégorie
curl http://localhost:8000/api/products?categories.id=1
```

## 📦 Fonctionnalités

### Socle obligatoire
✅ Modèle de données (Product, Category, ManyToMany)  
✅ API REST (API Platform)  
✅ Back-office (EasyAdmin)  
✅ Traitement asynchrone (Messenger + ProductLog)  
✅ Docker

### Bonus implémentés
✅ **Bonus A** : Filtres API (designation, categories)  
✅ **Bonus B** : Fixtures avec Stories (Foundry)

## 🛠️ Commandes utiles
```bash
# Logs en temps réel
docker-compose logs -f php

# Bash dans le conteneur
docker-compose exec php bash

# Clear cache
docker-compose exec php bin/console cache:clear

# Voir les messages en attente
docker-compose exec php bin/console messenger:stats
```

## 🏗️ Structure
```
src/
├── Entity/          # Product, Category, ProductLog
├── Message/         # ProductUpdatedMessage
├── MessageHandler/  # ProductUpdatedMessageHandler
├── EventSubscriber/ # ProductEventSubscriber
├── Factory/         # Foundry factories
├── Story/           # DefaultStory
└── Controller/
    └── Admin/       # EasyAdmin controllers
```

## 📊 Base de données

- **PostgreSQL 15**
- Tables : `product`, `category`, `product_category`, `product_log`

## 🔐 Sécurité

L'API est publique. Le back-office admin est accessible sans authentification (pour simplification du test).