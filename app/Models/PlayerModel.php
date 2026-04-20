<?php

namespace App\Models;

use CodeIgniter\Model;

class PlayerModel extends Model
{
    protected $table            = 'players';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'slug',
        'nome',
        'data_nascimento',
        'idade',
        'pais_nascimento',
        'naturalidade',
        'nacionalidade',
        'dupla_nacionalidade',
        'ligacoes',
        'parentescos',
        'situacao',
        'internacionalizacoes_a',
        'altura',
        'peso',
        'posicoes',
        'clube_atual',
        'valor_mercado',
        'resumo_json',
        'historico_json',
        'transferencias_entradas_json',
        'transferencias_saidas_json',
        'factos_json',
        'top_json',
        'fotografias_json',
        'sala_trofeus_json',
        'partilhou_plantel_json',
        'fotos_perfil_json',
        'raio_x_url',
        'profile_url',
    ];
    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
