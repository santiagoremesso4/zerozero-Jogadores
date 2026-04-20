<?php

namespace App\Controllers;

use App\Models\PlayerModel;

class Players extends BaseController
{
    private PlayerModel $playerModel;
    private array $jsonFields = [
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
    ];

    public function __construct()
    {
        $this->playerModel = new PlayerModel();
    }

    public function index(): string
    {
        $players = $this->playerModel->orderBy('nome', 'ASC')->findAll();

        return view('players/index', [
            'players' => array_map(fn (array $player) => $this->hydratePlayer($player), $players),
        ]);
    }

    public function show(int $id): string
    {
        $player = $this->playerModel->find($id);

        if ($player === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Jogador não encontrado.');
        }

        return view('players/show', [
            'player' => $this->hydratePlayer($player),
        ]);
    }

    public function delete(int $id)
    {
        $player = $this->playerModel->find($id);

        if ($player === null) {
            return redirect()->to('/')->with('error', 'Jogador não encontrado.');
        }

        $this->playerModel->delete($id);

        return redirect()->to('/')->with('success', 'Jogador apagado com sucesso.');
    }

    private function hydratePlayer(array $player): array
    {
        foreach ($this->jsonFields as $field) {
            $player[$field] = $this->decodeJsonField($player[$field] ?? '[]');
        }

        $player['altura_peso'] = trim(($player['altura'] ?? '') . ' / ' . ($player['peso'] ?? ''), ' /');

        return $player;
    }

    private function decodeJsonField(?string $value): array
    {
        if ($value === null || trim($value) === '') {
            return [];
        }

        $decoded = json_decode($value, true);

        return is_array($decoded) ? $decoded : [];
    }
}
