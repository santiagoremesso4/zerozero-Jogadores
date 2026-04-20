<?php

$playerName = $player['nome'] ?? 'Jogador';

function zz_value($value): string
{
    if (is_string($value)) {
        $value = trim($value);
    }

    return $value === '' || $value === null ? '-' : (string) $value;
}

function zz_headers_from_rows(array $rows, array $fallbackHeaders = []): array
{
    if ($rows === []) {
        return [];
    }

    $firstRow = $rows[0];
    if (! is_array($firstRow)) {
        return [];
    }

    if (array_is_list($firstRow)) {
        return $fallbackHeaders;
    }

    return array_keys($firstRow);
}

function zz_label(string $header, array $headerMap = []): string
{
    return $headerMap[$header] ?? $header;
}

function zz_render_table(
    array $rows,
    array $headerMap = [],
    array $fallbackHeaders = [],
    array $linkColumns = [],
    array $imageColumns = []
): string {
    if ($rows === []) {
        return '<p class="empty-note">Sem informação disponível.</p>';
    }

    $headers = zz_headers_from_rows($rows, $fallbackHeaders);
    if ($headers === []) {
        return '<p class="empty-note">Sem informação disponível.</p>';
    }

    $html = '<div class="table-wrap"><table class="data-table"><thead><tr>';
    foreach ($headers as $header) {
        $html .= '<th>' . esc(zz_label((string) $header, $headerMap)) . '</th>';
    }
    $html .= '</tr></thead><tbody>';

    foreach ($rows as $row) {
        $html .= '<tr>';

        foreach ($headers as $index => $header) {
            $value = array_is_list($row) ? ($row[$index] ?? '-') : ($row[$header] ?? '-');
            $display = is_array($value)
                ? json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
                : trim((string) $value);

            if (in_array($header, $imageColumns, true) && $display !== '' && $display !== '-') {
                $html .= '<td><img class="thumb" src="' . esc($display) . '" alt=""></td>';
            } elseif (in_array($header, $linkColumns, true) && $display !== '' && $display !== '-') {
                $html .= '<td><a class="table-link" href="' . esc($display) . '" target="_blank" rel="noopener noreferrer">Abrir</a></td>';
            } else {
                $html .= '<td>' . esc($display === '' ? '-' : $display) . '</td>';
            }
        }

        $html .= '</tr>';
    }

    $html .= '</tbody></table></div>';

    return $html;
}

function zz_render_links(array $rows): string
{
    if ($rows === []) {
        return '<p class="empty-note">Sem informação disponível.</p>';
    }

    $html = '<div class="link-list">';

    foreach ($rows as $row) {
        $name = is_array($row) ? trim((string) ($row['nome'] ?? '')) : '';
        $url = is_array($row) ? trim((string) ($row['url'] ?? '')) : '';

        if ($name !== '' && $url !== '') {
            $html .= '<a href="' . esc($url) . '" target="_blank" rel="noopener noreferrer">' . esc($name) . '</a>';
        }
    }

    $html .= '</div>';

    return $html === '<div class="link-list"></div>'
        ? '<p class="empty-note">Sem informação disponível.</p>'
        : $html;
}

function zz_render_gallery(array $rows): string
{
    if ($rows === []) {
        return '<p class="empty-note">Sem informação disponível.</p>';
    }

    $html = '<div class="gallery-grid">';

    foreach ($rows as $row) {
        $title = trim((string) ($row['Título'] ?? 'Imagem'));
        $image = trim((string) ($row['Imagem'] ?? ''));
        $url = trim((string) ($row['Ver'] ?? ''));

        $html .= '<article class="gallery-card">';

        if ($image !== '') {
            $html .= '<div class="gallery-image-wrap"><img class="gallery-image" src="' . esc($image) . '" alt="' . esc($title) . '"></div>';
        }

        $html .= '<div class="gallery-body">';
        $html .= '<h3>' . esc($title === '' ? 'Imagem' : $title) . '</h3>';

        if ($url !== '') {
            $html .= '<a class="action-link" href="' . esc($url) . '" target="_blank" rel="noopener noreferrer">Abrir no zerozero</a>';
        } else {
            $html .= '<p class="empty-note small">Sem ligação disponível.</p>';
        }

        $html .= '</div></article>';
    }

    $html .= '</div>';

    return $html;
}

$historicoHeaders = [
    'ÉPOCA' => 'Época',
    'EQUIPA' => 'Equipa',
    'J' => 'Jogos',
    'G' => 'Golos',
    'AST' => 'Assistências',
];

$transferHeaders = [
    'Época' => 'Época',
    'Equipa' => 'Equipa',
    'Valor' => 'Valor',
];

$factosHeaders = [
    'Pergunta' => 'Pergunta',
    'Resposta' => 'Resposta',
];

$topHeaders = [
    'coluna_1' => 'Posição',
    'coluna_2' => 'Indicador',
    'coluna_3' => 'Competição',
    'coluna_4' => 'Valor',
];

$trofeusHeaders = [
    'Competição' => 'Competição',
    'Total' => 'Total',
];
?>
<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($playerName) ?> - Back Office Zerozero</title>
    <style>
        :root {
            --bg: #f4f4f4;
            --card: #ffffff;
            --text: #1f1f1f;
            --muted: #666666;
            --line: #dddddd;
            --soft: #f8f8f8;
            --accent: #2f6f9f;
            --accent-dark: #24577c;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: var(--bg);
            color: var(--text);
        }

        .wrapper {
            max-width: 1180px;
            margin: 0 auto;
            padding: 24px 16px 40px;
        }

        .topbar {
            margin-bottom: 18px;
        }

        .back-link {
            color: var(--accent-dark);
            text-decoration: none;
            font-weight: 700;
        }

        .hero,
        .panel {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: 10px;
        }

        .hero {
            padding: 18px 20px;
        }

        .hero h1 {
            margin: 0 0 6px;
            font-size: 1.85rem;
        }

        .hero-subtitle {
            color: var(--muted);
            line-height: 1.5;
        }

        .hero-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 14px;
        }

        .hero-pill,
        .action-link,
        .link-list a,
        .table-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 8px 12px;
            border-radius: 999px;
            background: #edf4f8;
            color: var(--accent-dark);
            text-decoration: none;
            font-weight: 700;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
            margin-top: 18px;
        }

        .panel.full {
            grid-column: 1 / -1;
        }

        .panel-header {
            padding: 14px 16px;
            border-bottom: 1px solid var(--line);
            background: #fafafa;
        }

        .panel-header h2 {
            margin: 0;
            font-size: 1.05rem;
        }

        .panel-body {
            padding: 16px;
        }

        .facts-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .fact {
            padding: 12px;
            border: 1px solid #e6e6e6;
            border-radius: 8px;
            background: var(--soft);
        }

        .fact-label {
            display: block;
            margin-bottom: 6px;
            font-size: 0.8rem;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .fact-value {
            font-size: 0.96rem;
            line-height: 1.5;
        }

        .table-wrap {
            overflow-x: auto;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th,
        .data-table td {
            padding: 10px 12px;
            text-align: left;
            border-bottom: 1px solid #e7e7e7;
            vertical-align: top;
        }

        .data-table th {
            background: #f8f8f8;
            color: var(--muted);
            font-size: 0.82rem;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .data-table tr:hover td {
            background: #fafafa;
        }

        .thumb {
            width: 120px;
            height: 80px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #dcdcdc;
            display: block;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 14px;
        }

        .gallery-card {
            border: 1px solid #e6e6e6;
            border-radius: 10px;
            overflow: hidden;
            background: #ffffff;
        }

        .gallery-image-wrap {
            aspect-ratio: 16 / 10;
            background: #f2f2f2;
        }

        .gallery-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .gallery-body {
            padding: 12px;
        }

        .gallery-body h3 {
            margin: 0 0 10px;
            font-size: 0.95rem;
            line-height: 1.4;
        }

        .link-list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .split-panels {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .subpanel h3 {
            margin: 0 0 12px;
            font-size: 0.98rem;
        }

        .empty-note {
            margin: 0;
            color: var(--muted);
            line-height: 1.5;
        }

        .empty-note.small {
            font-size: 0.9rem;
        }

        @media (max-width: 1024px) {
            .gallery-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        @media (max-width: 920px) {
            .grid,
            .facts-grid,
            .split-panels {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 680px) {
            .gallery-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 460px) {
            .gallery-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="topbar">
            <a class="back-link" href="<?= site_url('/') ?>">&larr; Voltar à lista de jogadores</a>
        </div>

        <section class="hero">
            <h1><?= esc($playerName) ?></h1>
            <div class="hero-subtitle">
                <?= esc(zz_value($player['clube_atual'])) ?> | <?= esc(zz_value($player['posicoes'])) ?>
            </div>
            <div class="hero-meta">
                <span class="hero-pill">Valor de mercado: <?= esc(zz_value($player['valor_mercado'])) ?></span>
                <span class="hero-pill">Situação: <?= esc(zz_value($player['situacao'])) ?></span>
                <span class="hero-pill">Internacionalizações A: <?= esc(zz_value($player['internacionalizacoes_a'])) ?></span>
            </div>
        </section>

        <div class="grid">
            <section class="panel full">
                <div class="panel-header"><h2>Dados Pessoais</h2></div>
                <div class="panel-body">
                    <div class="facts-grid">
                        <div class="fact"><span class="fact-label">Nome</span><span class="fact-value"><?= esc(zz_value($player['nome'])) ?></span></div>
                        <div class="fact"><span class="fact-label">Data de Nascimento</span><span class="fact-value"><?= esc(zz_value($player['data_nascimento'])) ?> (<?= esc(zz_value($player['idade'])) ?> anos)</span></div>
                        <div class="fact"><span class="fact-label">País de Nascimento</span><span class="fact-value"><?= esc(zz_value($player['pais_nascimento'])) ?> (<?= esc(zz_value($player['naturalidade'])) ?>)</span></div>
                        <div class="fact"><span class="fact-label">Nacionalidade</span><span class="fact-value"><?= esc(zz_value($player['nacionalidade'])) ?></span></div>
                        <div class="fact"><span class="fact-label">Dupla Nacionalidade</span><span class="fact-value"><?= esc(zz_value($player['dupla_nacionalidade'])) ?></span></div>
                        <div class="fact"><span class="fact-label">Ligações</span><span class="fact-value"><?= esc(zz_value($player['ligacoes'])) ?></span></div>
                        <div class="fact"><span class="fact-label">Parentescos</span><span class="fact-value"><?= esc(zz_value($player['parentescos'])) ?></span></div>
                        <div class="fact"><span class="fact-label">Situação</span><span class="fact-value"><?= esc(zz_value($player['situacao'])) ?></span></div>
                        <div class="fact"><span class="fact-label">Internacionalizações A</span><span class="fact-value"><?= esc(zz_value($player['internacionalizacoes_a'])) ?></span></div>
                        <div class="fact"><span class="fact-label">Altura / Peso</span><span class="fact-value"><?= esc(zz_value($player['altura_peso'])) ?></span></div>
                        <div class="fact"><span class="fact-label">Posição(ões)</span><span class="fact-value"><?= esc(zz_value($player['posicoes'])) ?></span></div>
                        <div class="fact"><span class="fact-label">Perfil no zerozero</span><span class="fact-value"><a class="action-link" href="<?= esc($player['profile_url']) ?>" target="_blank" rel="noopener noreferrer">Abrir perfil</a></span></div>
                    </div>
                </div>
            </section>

            <section class="panel full">
                <div class="panel-header"><h2>Histórico</h2></div>
                <div class="panel-body"><?= zz_render_table($player['historico_json'], $historicoHeaders) ?></div>
            </section>

            <section class="panel full">
                <div class="panel-header"><h2>Transferências</h2></div>
                <div class="panel-body">
                    <div class="split-panels">
                        <div class="subpanel">
                            <h3>Entradas</h3>
                            <?= zz_render_table($player['transferencias_entradas_json'], $transferHeaders) ?>
                        </div>
                        <div class="subpanel">
                            <h3>Saídas</h3>
                            <?= zz_render_table($player['transferencias_saidas_json'], $transferHeaders) ?>
                        </div>
                    </div>
                </div>
            </section>

            <section class="panel full">
                <div class="panel-header"><h2>Factos do Jogador</h2></div>
                <div class="panel-body"><?= zz_render_table($player['factos_json'], $factosHeaders) ?></div>
            </section>

            <section class="panel">
                <div class="panel-header"><h2>Top</h2></div>
                <div class="panel-body"><?= zz_render_table($player['top_json'], $topHeaders) ?></div>
            </section>

            <section class="panel">
                <div class="panel-header"><h2>Sala de Troféus</h2></div>
                <div class="panel-body"><?= zz_render_table($player['sala_trofeus_json'], $trofeusHeaders) ?></div>
            </section>

            <section class="panel full">
                <div class="panel-header"><h2>Fotografias</h2></div>
                <div class="panel-body"><?= zz_render_gallery($player['fotografias_json']) ?></div>
            </section>

            <section class="panel full">
                <div class="panel-header"><h2>Fotos de Perfil</h2></div>
                <div class="panel-body"><?= zz_render_gallery($player['fotos_perfil_json']) ?></div>
            </section>

            <section class="panel">
                <div class="panel-header"><h2>Partilhou Plantel Com</h2></div>
                <div class="panel-body"><?= zz_render_links($player['partilhou_plantel_json']) ?></div>
            </section>

            <section class="panel">
                <div class="panel-header"><h2>Raio X</h2></div>
                <div class="panel-body">
                    <?php if (! empty($player['raio_x_url'])): ?>
                        <a class="action-link" href="<?= esc($player['raio_x_url']) ?>" target="_blank" rel="noopener noreferrer">Comparar jogador no Raio X</a>
                    <?php else: ?>
                        <p class="empty-note">Sem informação disponível.</p>
                    <?php endif; ?>
                </div>
            </section>
        </div>
    </div>
</body>
</html>
