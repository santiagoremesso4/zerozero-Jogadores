# Zerozero Back Office

Projeto simples em `CodeIgniter 4` com um scraper em `Scrapy` para recolher dados de 3 jogadores do site `zerozero.pt`:

- Lionel Messi
- Cristiano Ronaldo
- Gianluca Prestianni

## O que existe

- `zerozerobd.sql`: base de dados pronta para importar no `phpMyAdmin`
- `app/`: back office para listar, ver ficha completa e apagar registos
- `scrapy_zerozero/`: spider Scrapy para recolher os dados do zerozero
- `scripts/import_players_json.php`: importa o `players.json` para a base de dados

## Como importar a base de dados

1. Abrir o `phpMyAdmin`
2. Escolher `Importar`
3. Selecionar o ficheiro `zerozerobd.sql`
4. Confirmar a importacao

## Como abrir o back office

Com o Apache e MySQL do XAMPP ligados, abrir:

`http://localhost/zerozero%20site%20backoffice/`

Para ver o detalhe completo de um jogador:

`http://localhost/zerozero%20site%20backoffice/players/1`

## Como correr o scraper

No terminal, dentro da pasta do projeto:

```powershell
cd "c:\xampp\htdocs\zerozero site backoffice\scrapy_zerozero"
py -m scrapy crawl players -O players.json
```

O ficheiro `players.json` fica com os dados recolhidos.

## Como atualizar a base de dados a partir do JSON

Depois de gerar ou atualizar o `players.json`, corre:

```powershell
cd "c:\xampp\htdocs\zerozero site backoffice"
C:\xampp\php\php.exe scripts\import_players_json.php
```

Isto atualiza os dados dos jogadores na tabela `players`.

## Ligacao a base de dados

O projeto esta configurado em `app/Config/Database.php` com:

- host: `localhost`
- user: `root`
- password: vazio
- database: `zerozerobd`
