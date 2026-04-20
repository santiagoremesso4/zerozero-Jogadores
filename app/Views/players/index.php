<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Back Office Zerozero</title>
    <style>
        :root {
            --bg: #f5f5f5;
            --card: #ffffff;
            --text: #222222;
            --muted: #666666;
            --line: #dddddd;
            --primary: #2f6f9f;
            --primary-dark: #24577c;
            --danger: #c0392b;
            --danger-dark: #992d22;
            --soft: #f8f8f8;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: var(--bg);
            color: var(--text);
        }

        .wrapper {
            max-width: 1100px;
            margin: 0 auto;
            padding: 24px 16px 40px;
        }

        .hero {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 18px 20px;
        }

        .hero h1 {
            margin: 0 0 6px;
            font-size: 1.7rem;
        }

        .hero p {
            margin: 0;
            color: var(--muted);
        }

        .flash {
            margin-top: 16px;
            padding: 12px 14px;
            border-radius: 8px;
            font-size: 0.95rem;
        }

        .flash.success {
            background: rgba(15, 118, 110, 0.12);
            color: var(--primary-dark);
            border: 1px solid rgba(15, 118, 110, 0.18);
        }

        .flash.error {
            background: rgba(194, 65, 12, 0.10);
            color: var(--danger-dark);
            border: 1px solid rgba(194, 65, 12, 0.18);
        }

        .card {
            margin-top: 18px;
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: 10px;
            overflow: hidden;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            padding: 16px 18px;
            border-bottom: 1px solid var(--line);
            background: #fafafa;
        }

        .card-header h2 {
            margin: 0;
            font-size: 1.05rem;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 10px;
            border-radius: 20px;
            background: #eeeeee;
            color: #444444;
            font-size: 0.88rem;
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 14px 16px;
            text-align: left;
            border-bottom: 1px solid #e6e6e6;
            vertical-align: top;
        }

        th {
            font-size: 0.82rem;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            color: var(--muted);
            background: var(--soft);
        }

        tr:hover td {
            background: #fafafa;
        }

        .name {
            font-weight: 700;
            margin-bottom: 6px;
        }

        .meta {
            color: var(--muted);
            font-size: 0.94rem;
            line-height: 1.5;
        }

        .pill {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 20px;
            background: #eef4f8;
            color: var(--primary-dark);
            font-size: 0.85rem;
        }

        .actions form {
            margin: 0;
        }

        .btn-link,
        .btn-delete {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            padding: 8px 12px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-link {
            background: #edf4f8;
            color: var(--primary-dark);
        }

        .btn-delete {
            border: 0;
            background: var(--danger);
            color: #ffffff;
        }

        .btn-delete:hover {
            background: var(--danger-dark);
        }

        .stack {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .empty {
            padding: 22px 18px;
            color: var(--muted);
        }

        @media (max-width: 860px) {
            .hero h1 {
                font-size: 1.4rem;
            }

            th,
            td {
                padding: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <section class="hero">
            <h1>Back Office Zerozero</h1>
        </section>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="flash success"><?= esc(session()->getFlashdata('success')) ?></div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="flash error"><?= esc(session()->getFlashdata('error')) ?></div>
        <?php endif; ?>

        <section class="card">
            <div class="card-header">
                <h2>Jogadores Guardados</h2>
                <span class="badge"><?= count($players) ?> registos</span>
            </div>

            <?php if ($players === []): ?>
                <div class="empty">Não existem jogadores na base de dados.</div>
            <?php else: ?>
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Jogador</th>
                                <th>Nacionalidade</th>
                                <th>Clube</th>
                                <th>Posição</th>
                                <th>Mercado</th>
                                <th>Ver</th>
                                <th>Apagar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($players as $player): ?>
                                <tr>
                                    <td>
                                        <div class="name"><?= esc($player['nome']) ?></div>
                                        <div class="meta">
                                            Nascimento: <?= esc($player['data_nascimento'] ?: '-') ?><br>
                                            Idade: <?= esc($player['idade'] !== null ? (string) $player['idade'] . ' anos' : '-') ?>
                                        </div>
                                    </td>
                                    <td><?= esc($player['nacionalidade'] ?: '-') ?></td>
                                    <td><?= esc($player['clube_atual'] ?: '-') ?></td>
                                    <td><span class="pill"><?= esc($player['posicoes'] ?: '-') ?></span></td>
                                    <td><?= esc($player['valor_mercado'] ?: '-') ?></td>
                                    <td>
                                        <div class="stack">
                                            <a class="btn-link" href="<?= site_url('players/' . $player['id']) ?>">Ver detalhes</a>
                                            <a class="btn-link" href="<?= esc($player['profile_url']) ?>" target="_blank" rel="noopener noreferrer">Abrir no zerozero</a>
                                        </div>
                                    </td>
                                    <td class="actions">
                                        <form action="<?= site_url('players/delete/' . $player['id']) ?>" method="post">
                                            <?= csrf_field() ?>
                                            <button
                                                type="submit"
                                                class="btn-delete"
                                                onclick="return confirm('Tens a certeza que queres apagar este jogador?');"
                                            >
                                                Apagar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </section>
    </div>
</body>
</html>
