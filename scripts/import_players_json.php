<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$jsonPath = __DIR__ . '/../scrapy_zerozero/players.json';

if (! is_file($jsonPath)) {
    fwrite(STDERR, "Nao foi encontrado o ficheiro players.json.\n");
    exit(1);
}

$json = file_get_contents($jsonPath);
$players = json_decode($json, true);

if (! is_array($players)) {
    fwrite(STDERR, "O ficheiro players.json nao contem JSON valido.\n");
    exit(1);
}

$db = new mysqli('localhost', 'root', '', 'zerozerobd', 3306);
$db->set_charset('utf8mb4');
$db->query('TRUNCATE TABLE players');

$sql = <<<'SQL'
INSERT INTO players (
    slug, nome, data_nascimento, idade, pais_nascimento, naturalidade,
    nacionalidade, dupla_nacionalidade, ligacoes, parentescos, situacao,
    internacionalizacoes_a, altura, peso, posicoes, clube_atual,
    valor_mercado, resumo_json, historico_json, transferencias_entradas_json,
    transferencias_saidas_json, factos_json, top_json, fotografias_json,
    sala_trofeus_json, partilhou_plantel_json, fotos_perfil_json, raio_x_url,
    profile_url
) VALUES (
    ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
)
SQL;

$statement = $db->prepare($sql);

foreach ($players as $player) {
    $slug = (string) ($player['slug'] ?? '');
    $nome = (string) ($player['nome'] ?? '');
    $dataNascimento = normalizeNullableString($player['data_nascimento'] ?? null);
    $idade = isset($player['idade']) && $player['idade'] !== '' ? (int) $player['idade'] : null;
    $paisNascimento = normalizeNullableString($player['pais_nascimento'] ?? null);
    $naturalidade = normalizeNullableString($player['naturalidade'] ?? null);
    $nacionalidade = normalizeNullableString($player['nacionalidade'] ?? null);
    $duplaNacionalidade = normalizeNullableString($player['dupla_nacionalidade'] ?? null);
    $ligacoes = normalizeNullableString($player['ligacoes'] ?? null);
    $parentescos = normalizeNullableString($player['parentescos'] ?? null);
    $situacao = normalizeNullableString($player['situacao'] ?? null);
    $internacionalizacoesA = normalizeNullableString($player['internacionalizacoes_a'] ?? null);
    $altura = normalizeNullableString($player['altura'] ?? null);
    $peso = normalizeNullableString($player['peso'] ?? null);
    $posicoes = normalizeNullableString($player['posicoes'] ?? null);
    $clubeAtual = normalizeNullableString($player['clube_atual'] ?? null);
    $valorMercado = normalizeNullableString($player['valor_mercado'] ?? null);
    $resumo = encodeJson($player['resumo'] ?? []);
    $historico = encodeJson($player['historico'] ?? []);
    $transferenciasEntradas = encodeJson($player['transferencias_entradas'] ?? []);
    $transferenciasSaidas = encodeJson($player['transferencias_saidas'] ?? []);
    $factos = encodeJson($player['factos'] ?? []);
    $top = encodeJson($player['top'] ?? []);
    $fotografias = encodeJson($player['fotografias'] ?? []);
    $salaTrofeus = encodeJson($player['sala_trofeus'] ?? []);
    $partilhouPlantel = encodeJson($player['partilhou_plantel_com'] ?? []);
    $fotosPerfil = encodeJson($player['fotos_perfil'] ?? []);
    $raioXUrl = normalizeNullableString($player['raio_x_url'] ?? null);
    $profileUrl = normalizeNullableString($player['profile_url'] ?? null);

    $statement->bind_param(
        'sssisssssssssssssssssssssssss',
        $slug,
        $nome,
        $dataNascimento,
        $idade,
        $paisNascimento,
        $naturalidade,
        $nacionalidade,
        $duplaNacionalidade,
        $ligacoes,
        $parentescos,
        $situacao,
        $internacionalizacoesA,
        $altura,
        $peso,
        $posicoes,
        $clubeAtual,
        $valorMercado,
        $resumo,
        $historico,
        $transferenciasEntradas,
        $transferenciasSaidas,
        $factos,
        $top,
        $fotografias,
        $salaTrofeus,
        $partilhouPlantel,
        $fotosPerfil,
        $raioXUrl,
        $profileUrl
    );

    $statement->execute();
}

$statement->close();
$db->close();

echo "Importacao concluida com sucesso.\n";

function normalizeNullableString(mixed $value): ?string
{
    if ($value === null) {
        return null;
    }

    $value = trim((string) $value);

    return $value === '' ? null : $value;
}

function encodeJson(array $value): string
{
    return json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?: '[]';
}
