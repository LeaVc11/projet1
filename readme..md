# E-commerce

Site E-commerce est un site internet présentant des vêtements en ligne

# Environnement de développement

### Pré-requis

* PHP 8.2
* Composer
* Symfony CLI
* Docker
* Docker-compose

Vous pouvez vérifier les pré-requis (sauf Docker et Docker-compose) avec la commande (de la CLI Symfony) :

```bash 
symfony check:requirements 
```

### Lancer l'environnement de développement

```bash 
docker-composer up -d
symfony serve -d
```

