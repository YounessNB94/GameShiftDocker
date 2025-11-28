# GameShiftDocker — Conteneurisation Docker (Full Stack)

Projet : conteneurisation d’une application full stack (Front + Back + DB) avec **Docker** et **Docker Compose**.

---

## 1) Liens

- **Repo Git** : https://github.com/YounessNB94/GameShiftDocker
- **Docker Hub** :
  - Front : https://hub.docker.com/r/younessnb94/gameshift-front
  - Back : https://hub.docker.com/r/younessnb94/gameshift-back

---

## 2) Architecture Docker

- **db** : Base de données MySQL, persistance via le volume `gameshift_db` monté sur `/var/lib/mysql`.
- **front** : Front Office PHP/Apache, exposé sur le port `8080`.
- **back** : Back Office PHP/Apache, exposé sur le port `8081`.

Tous les services sont connectés au réseau Docker dédié `gameshift_network` pour une communication sécurisée. Les variables d'environnement permettent la connexion à la base via le DNS Docker `db`.

---

## 3) Instructions pour construire et démarrer

Depuis la racine du projet (là où se trouve `docker-compose.yml`) :

```bash
docker compose up --build -d
```

- Accès Front Office : http://localhost:8080
- Accès Back Office : http://localhost:8081

Pour consulter les logs :

```bash
docker compose logs --tail=50 db
docker compose logs --tail=50 front
docker compose logs --tail=50 back
```

Pour arrêter et supprimer les conteneurs (sans supprimer la DB persistée) :

```bash
docker compose down
```

Pour réinitialiser complètement la base (supprimer le volume) :

```bash
docker compose down -v
```

---

## 4) Variables d’environnement (connexion DB)

Les services front et back utilisent :

- `DB_HOST=db`
- `DB_NAME=GameShift`
- `DB_USER=root`
- `DB_PASSWORD=` (mot de passe vide par défaut)

La base de données est configurée avec :

- `MYSQL_DATABASE=GameShift`
- `MYSQL_ALLOW_EMPTY_PASSWORD=yes`
- Volume : `gameshift_db:/var/lib/mysql`

---

## 5) Explication

**Import SQL** : Le fichier `Database/GameShift.sql` a été créé manuellement pour alimenter et modifier la base MySQL. Il est importé automatiquement au premier lancement si la base est vide.
- **Persistance** : Les données sont conservées grâce au volume Docker `gameshift_db`.
- **Réseau** : Tous les services sont sur le réseau `gameshift_network` pour garantir la communication et l'isolation.
- **Accès** : Les applications sont accessibles sur les ports 8080 (front) et 8081 (back).

---

## 6) Test de la communication entre conteneurs

Pour vérifier que le front et le back communiquent bien avec la base de données via le réseau Docker :

1. Ouvre un shell dans le conteneur front ou back :
   ```bash
   docker exec -it gameshift-front bash
   ```
2. Installe le client MariaDB (si besoin) et teste la connexion :
   ```bash
   apt-get update && apt-get install -y mariadb-client-compat
   mysql -h db -u root --skip-ssl -p
   ```
   (Laisse le mot de passe vide si tu utilises `MYSQL_ALLOW_EMPTY_PASSWORD=yes`)

Si la connexion réussit, la communication réseau entre les conteneurs fonctionne correctement.

---