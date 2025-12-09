# Symfony API - JWT

**POST** `/api/login`

```json
{
  "email": "koman@example.com",
  "password": "123456"
}
```

**Réponse :**
```json
{
  "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9..."
}
```

## ✅ Test effectué

Récupération du JWT : **FONCTIONNE**

```bash
curl -X POST http://127.0.0.1:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"koman@example.com","password":"123456"}'
```

## 📡 Routes

- `POST /api/login` - Obtenir JWT
- `GET /test` - Liste users
- `GET /test/user/{id}` - Détails user
