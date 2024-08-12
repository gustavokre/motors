Simulação de importação de veículos por API

## Requisitos

- Docker

## Instalação e Configuração

### 1. Baixar o Projeto

Clone o repositório para o seu computador:

```bash
git clone https://github.com/gustavokre/motors.git
```

### 2. Comandos na raiz do projeto

Necessário criar ter o .env configurado

```bash
cp .env.example .env
```

```bash
docker compose up -d
```

```bash
docker compose exec app bash
```
### 3. Comandos dentro do docker
Neste momento o diretório deve estar no /var/www
```bash
composer install
```

```bash
npm install
```

```bash
php artisan migrate
```

```bash
php artisan db:seed
```

```bash
npm run build
```
### 4. Pronto
Agora acessando o navegador da sua máquina tente acessar a URL:
```bash
http://localhost:8000/
```











