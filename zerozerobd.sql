-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20-Abr-2026 às 15:08
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `zerozerobd`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `players`
--

CREATE TABLE `players` (
  `id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(150) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `data_nascimento` date DEFAULT NULL,
  `idade` int(11) DEFAULT NULL,
  `pais_nascimento` varchar(120) DEFAULT NULL,
  `naturalidade` varchar(120) DEFAULT NULL,
  `nacionalidade` varchar(120) DEFAULT NULL,
  `dupla_nacionalidade` varchar(120) DEFAULT NULL,
  `ligacoes` text DEFAULT NULL,
  `parentescos` text DEFAULT NULL,
  `situacao` varchar(80) DEFAULT NULL,
  `internacionalizacoes_a` varchar(120) DEFAULT NULL,
  `altura` varchar(40) DEFAULT NULL,
  `peso` varchar(40) DEFAULT NULL,
  `posicoes` varchar(255) DEFAULT NULL,
  `clube_atual` varchar(150) DEFAULT NULL,
  `valor_mercado` varchar(60) DEFAULT NULL,
  `resumo_json` longtext DEFAULT NULL,
  `historico_json` longtext DEFAULT NULL,
  `transferencias_entradas_json` longtext DEFAULT NULL,
  `transferencias_saidas_json` longtext DEFAULT NULL,
  `factos_json` longtext DEFAULT NULL,
  `top_json` longtext DEFAULT NULL,
  `fotografias_json` longtext DEFAULT NULL,
  `sala_trofeus_json` longtext DEFAULT NULL,
  `partilhou_plantel_json` longtext DEFAULT NULL,
  `fotos_perfil_json` longtext DEFAULT NULL,
  `raio_x_url` varchar(255) DEFAULT NULL,
  `profile_url` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `players`
--

INSERT INTO `players` (`id`, `slug`, `nome`, `data_nascimento`, `idade`, `pais_nascimento`, `naturalidade`, `nacionalidade`, `dupla_nacionalidade`, `ligacoes`, `parentescos`, `situacao`, `internacionalizacoes_a`, `altura`, `peso`, `posicoes`, `clube_atual`, `valor_mercado`, `resumo_json`, `historico_json`, `transferencias_entradas_json`, `transferencias_saidas_json`, `factos_json`, `top_json`, `fotografias_json`, `sala_trofeus_json`, `partilhou_plantel_json`, `fotos_perfil_json`, `raio_x_url`, `profile_url`, `created_at`, `updated_at`) VALUES
(1, 'lionel-messi', 'Lionel Andrés Messi Cuccittini', '1987-06-24', 38, 'Argentina', 'Rosario', 'Argentina', 'Espanha', NULL, 'Filho de Jorge Messi Tio de Agustín Messi Primo de Maxi Biancucchi Primo de Emanuel Biancucchi Pai de Thiago Messi Padrinho de Benjamin Aguero Irmão de Matias Messi', 'No ativo', '198 Jogos / 116 Golos', '170 cm', '66 kg', 'Extremo Direito 2.º avançado', 'Inter Miami CF', '18.0 M €', '[{\"J\":\"MLS\",\"M\":\"7\",\"GM\":\"630\",\"AST\":\"7\",\"coluna_5\":\"1\"},{\"J\":\"9\",\"M\":\"810\",\"GM\":\"8\",\"AST\":\"1\"},{\"J\":\"Jogos Preparação Seleções\",\"M\":\"2\",\"GM\":\"135\",\"AST\":\"1\",\"coluna_5\":\"0\"},{\"J\":\"Total\",\"M\":\"11\",\"GM\":\"945\",\"AST\":\"9\",\"coluna_5\":\"1\"}]', '[{\"ÉPOCA\":\"2025\",\"EQUIPA\":\"Inter Miami CF\",\"J\":\"49\",\"G\":\"43\",\"AST\":\"26\"},{\"ÉPOCA\":\"2024\",\"EQUIPA\":\"Inter Miami CF\",\"J\":\"25\",\"G\":\"23\",\"AST\":\"13\"},{\"ÉPOCA\":\"+32 registos\"}]', '[{\"Época\":\"2021/2022\",\"Equipa\":\"Paris SG\",\"Valor\":\"Custo zero\"},{\"Época\":\"2000/2001\",\"Equipa\":\"Barcelona\",\"Valor\":\"-\"}]', '[]', '[{\"Pergunta\":\"Qual o nome completo de Lionel Messi?\",\"Resposta\":\"O nome completo é Lionel Andrés Messi Cuccittini.\"},{\"Pergunta\":\"Quantos anos tem Lionel Messi?\",\"Resposta\":\"Lionel Messi tem 38 anos, nasceu a 24 junho 1987, em Rosario, Argentina.\"},{\"Pergunta\":\"Qual a posição de Lionel Messi?\",\"Resposta\":\"Lionel Messi joga na posição de Avançado.\"}]', '[{\"coluna_1\":\"1.º\",\"coluna_2\":\"Remates à baliza por jogo\",\"coluna_3\":\"MLS 2025\",\"coluna_4\":\"2.35\"},{\"coluna_1\":\"1.º\",\"coluna_2\":\"Remates Bloqueados por jogo\",\"coluna_3\":\"MLS 2025\",\"coluna_4\":\"1.71\"},{\"coluna_1\":\"1.º\",\"coluna_2\":\"Dribles Conseguidos por jogo\",\"coluna_3\":\"MLS 2025\",\"coluna_4\":\"2.97\"},{\"coluna_1\":\"1.º\",\"coluna_2\":\"Expected Goals on Target por jogo\",\"coluna_3\":\"MLS 2025\",\"coluna_4\":\"0.90\"},{\"coluna_1\":\"1.º\",\"coluna_2\":\"Grandes Oportunidades Criadas por jogo\",\"coluna_3\":\"MLS 2025\",\"coluna_4\":\"1.06\"}]', '[{\"Título\":\"Fotografia\",\"Ver\":\"https://www.zerozero.pt/foto.php?fk_galeria=0&nchapter=1&tpe=1&ide=10592\",\"Imagem\":\"https://www.zerozero.pt/img/geral/1475122_med_.jpg.jpg\"},{\"Título\":\"Fotografia\",\"Ver\":\"https://www.zerozero.pt/foto.php?fk_galeria=0&nchapter=2&tpe=1&ide=10592\",\"Imagem\":\"https://www.zerozero.pt/img/geral/1466328_med_.jpg.jpg\"},{\"Título\":\"Fotografia\",\"Ver\":\"https://www.zerozero.pt/foto.php?fk_galeria=0&nchapter=3&tpe=1&ide=10592\",\"Imagem\":\"https://www.zerozero.pt/img/geral/1466303_med_.jpg.jpg\"},{\"Título\":\"Mais fotografias\",\"Ver\":\"https://www.zerozero.pt/player_photos.php?id=10592\",\"Imagem\":\"\"}]', '[{\"ÉPOCA\":\"2025\",\"EQUIPA\":\"Inter Miami CF\",\"J\":\"49\",\"G\":\"43\",\"AST\":\"26\"},{\"ÉPOCA\":\"2024\",\"EQUIPA\":\"Inter Miami CF\",\"J\":\"25\",\"G\":\"23\",\"AST\":\"13\"},{\"ÉPOCA\":\"+32 registos\"}]', '[{\"nome\":\"Neymar\",\"url\":\"https://www.zerozero.pt/jogador/neymar/54814\"},{\"nome\":\"Ronaldinho Gaúcho\",\"url\":\"https://www.zerozero.pt/jogador/ronaldinho-gaucho\"},{\"nome\":\"Nolito\",\"url\":\"https://www.zerozero.pt/jogador/nolito/135957\"},{\"nome\":\"Ricardo Quaresma\",\"url\":\"https://www.zerozero.pt/jogador/ricardo-quaresma/771\"},{\"nome\":\"Javier Saviola\",\"url\":\"https://www.zerozero.pt/jogador/javier-saviola/773\"},{\"nome\":\"Samuel Eto’o\",\"url\":\"https://www.zerozero.pt/jogador/samuel-eto-o/927\"},{\"nome\":\"Jeffrén Suárez\",\"url\":\"https://www.zerozero.pt/jogador/jeffren-suarez/16702\"},{\"nome\":\"Zlatan Ibrahimovic\",\"url\":\"https://www.zerozero.pt/jogador/zlatan-ibrahimovic\"}]', '[{\"Título\":\"Inter Miami CF Lionel Messi 2026\",\"Ver\":\"https://www.zerozero.pt/jogador/lionel-messi?epoca_id=155\",\"Imagem\":\"https://cdn-img.staticzz.com/img/planteis/new/84/75/16198475_lionel_messi_20260301013642.png\"},{\"Título\":\"Inter Miami CF Lionel Messi 2025\",\"Ver\":\"https://www.zerozero.pt/jogador/lionel-messi?epoca_id=154\",\"Imagem\":\"https://cdn-img.staticzz.com/img/planteis/new/69/95/14166995_lionel_messi_20260109224734.jpg\"},{\"Título\":\"Inter Miami CF Lionel Messi 2024\",\"Ver\":\"https://www.zerozero.pt/jogador/lionel-messi?epoca_id=153\",\"Imagem\":\"https://cdn-img.staticzz.com/img/planteis/new/81/81/9648181_lionel_messi_20240617223940.jpg\"},{\"Título\":\"Inter Miami CF Lionel Messi 2023\",\"Ver\":\"https://www.zerozero.pt/jogador/lionel-messi?epoca_id=152\",\"Imagem\":\"https://cdn-img.staticzz.com/img/planteis/new/61/30/8656130_lionel_messi_20260224204701.png\"}]', 'https://www.zerozero.pt/jogador/lionel-messi/raiox', 'https://www.zerozero.pt/jogador/lionel-messi', '2026-04-20 13:56:40', '2026-04-20 13:56:40'),
(2, 'cristiano-ronaldo', 'Cristiano Ronaldo dos Santos Aveiro', '1985-02-05', 41, 'Portugal', 'Funchal', 'Portugal', NULL, NULL, 'Pai de Cristiano Ronaldo Jr. Primo de Adriano Tio de Dinis Moreira Irmão de Hugo Aveiro Sobrinho de Joao Aveiro', 'No ativo', '226 Jogos / 143 Golos', '187 cm', '83 kg', 'Ponta de Lança', 'Al-Nassr', '11.0 M €', '[{\"J\":\"Saudi Premier League\",\"M\":\"25\",\"GM\":\"2174\",\"AST\":\"24\",\"coluna_5\":\"2\"},{\"J\":\"Saudi Super Cup\",\"M\":\"2\",\"GM\":\"180\",\"AST\":\"1\",\"coluna_5\":\"1\"},{\"J\":\"King´s Cup\",\"M\":\"1\",\"GM\":\"90\",\"AST\":\"0\",\"coluna_5\":\"0\"},{\"J\":\"30\",\"M\":\"2556\",\"GM\":\"26\",\"AST\":\"4\"},{\"J\":\"Qualificação Mundial (UEFA)\",\"M\":\"5\",\"GM\":\"374\",\"AST\":\"5\",\"coluna_5\":\"0\"},{\"J\":\"Total\",\"M\":\"35\",\"GM\":\"2930\",\"AST\":\"31\",\"coluna_5\":\"4\"}]', '[{\"ÉPOCA\":\"2024/25\",\"EQUIPA\":\"Al-Nassr\",\"J\":\"41\",\"G\":\"35\",\"AST\":\"4\"},{\"ÉPOCA\":\"2023/24\",\"EQUIPA\":\"Al-Nassr\",\"J\":\"51\",\"G\":\"50\",\"AST\":\"13\"},{\"ÉPOCA\":\"+37 registos\"}]', '[{\"Época\":\"2021/2022\",\"Equipa\":\"Manchester United\",\"Valor\":\"17.00 M €\"},{\"Época\":\"2018/2019\",\"Equipa\":\"Juventus\",\"Valor\":\"117.00 M €\"},{\"Época\":\"2009/2010\",\"Equipa\":\"Real Madrid\",\"Valor\":\"94.00 M €\"},{\"Época\":\"2003/2004\",\"Equipa\":\"Man. United\",\"Valor\":\"19.00 M €\"},{\"Época\":\"1997/1998\",\"Equipa\":\"Sporting\",\"Valor\":\"25 mil €\"},{\"Época\":\"1995/1996\",\"Equipa\":\"Nacional\",\"Valor\":\"Custo zero\"}]', '[]', '[{\"Pergunta\":\"Qual o nome completo de Cristiano Ronaldo?\",\"Resposta\":\"O nome completo é Cristiano Ronaldo dos Santos Aveiro.\"},{\"Pergunta\":\"Quantos anos tem Cristiano Ronaldo?\",\"Resposta\":\"Cristiano Ronaldo tem 41 anos, nasceu a 5 fevereiro 1985, em Funchal, Portugal.\"},{\"Pergunta\":\"Qual a posição de Cristiano Ronaldo?\",\"Resposta\":\"Cristiano Ronaldo joga na posição de Avançado.\"}]', '[{\"coluna_1\":\"2.º\",\"coluna_2\":\"Melhor Marcador\",\"coluna_3\":\"Saudi Super Cup 25/26\",\"coluna_4\":\"1\"},{\"coluna_1\":\"2.º\",\"coluna_2\":\"Mais Assistências\",\"coluna_3\":\"Saudi Super Cup 25/26\",\"coluna_4\":\"1\"},{\"coluna_1\":\"3.º\",\"coluna_2\":\"Participação em Golos\",\"coluna_3\":\"Saudi Super Cup 25/26\",\"coluna_4\":\"2\"},{\"coluna_1\":\"3.º\",\"coluna_2\":\"Melhor Marcador\",\"coluna_3\":\"Saudi Premier League 25/26\",\"coluna_4\":\"24\"},{\"coluna_1\":\"3.º\",\"coluna_2\":\"Média de Golos/Jogo\",\"coluna_3\":\"Saudi Premier League 25/26\",\"coluna_4\":\"0.96\"},{\"coluna_1\":\"1.º\",\"coluna_2\":\"Remates à baliza por jogo\",\"coluna_3\":\"Saudi Super Cup 25/26\",\"coluna_4\":\"2.00\"},{\"coluna_1\":\"1.º\",\"coluna_2\":\"Remates Bloqueados por jogo\",\"coluna_3\":\"Saudi Super Cup 25/26\",\"coluna_4\":\"1.50\"},{\"coluna_1\":\"1.º\",\"coluna_2\":\"Rating por jogo\",\"coluna_3\":\"Saudi Super Cup 25/26\",\"coluna_4\":\"8.21\"},{\"coluna_1\":\"1.º\",\"coluna_2\":\"Remates para Fora por jogo\",\"coluna_3\":\"Saudi Super Cup 25/26\",\"coluna_4\":\"2.50\"},{\"coluna_1\":\"1.º\",\"coluna_2\":\"Remates por jogo\",\"coluna_3\":\"Saudi Premier League 25/26\",\"coluna_4\":\"5.72\"}]', '[{\"Título\":\"Fotografia\",\"Ver\":\"https://www.zerozero.pt/foto.php?fk_galeria=0&nchapter=1&tpe=1&ide=1579\",\"Imagem\":\"https://www.zerozero.pt/img/geral/1460221_med_.jpg.jpg\"},{\"Título\":\"Fotografia\",\"Ver\":\"https://www.zerozero.pt/foto.php?fk_galeria=0&nchapter=2&tpe=1&ide=1579\",\"Imagem\":\"https://www.zerozero.pt/img/geral/1448975_med_.jpg.jpg\"},{\"Título\":\"Fotografia\",\"Ver\":\"https://www.zerozero.pt/foto.php?fk_galeria=0&nchapter=3&tpe=1&ide=1579\",\"Imagem\":\"https://www.zerozero.pt/img/geral/1446103_med_.jpg.jpg\"},{\"Título\":\"Mais fotografias\",\"Ver\":\"https://www.zerozero.pt/player_photos.php?id=1579\",\"Imagem\":\"\"}]', '[{\"ÉPOCA\":\"2024/25\",\"EQUIPA\":\"Al-Nassr\",\"J\":\"41\",\"G\":\"35\",\"AST\":\"4\"},{\"ÉPOCA\":\"2023/24\",\"EQUIPA\":\"Al-Nassr\",\"J\":\"51\",\"G\":\"50\",\"AST\":\"13\"},{\"ÉPOCA\":\"+37 registos\"}]', '[{\"nome\":\"Ricardo Quaresma\",\"url\":\"https://www.zerozero.pt/jogador/ricardo-quaresma/771\"},{\"nome\":\"Fábio Coentrão\",\"url\":\"https://www.zerozero.pt/jogador/fabio-coentrao/19171\"},{\"nome\":\"Liedson\",\"url\":\"https://www.zerozero.pt/jogador/liedson/488\"},{\"nome\":\"Nemanja Matic\",\"url\":\"https://www.zerozero.pt/jogador/nemanja-matic/99030\"},{\"nome\":\"Nani\",\"url\":\"https://www.zerozero.pt/jogador/nani/16812\"},{\"nome\":\"Danilo\",\"url\":\"https://www.zerozero.pt/jogador/danilo/91587\"},{\"nome\":\"Mário Jardel\",\"url\":\"https://www.zerozero.pt/jogador/mario-jardel/1293\"},{\"nome\":\"Ezequiel Garay\",\"url\":\"https://www.zerozero.pt/jogador/ezequiel-garay/25466\"}]', '[{\"Título\":\"Al-Nassr Cristiano Ronaldo 2025/26\",\"Ver\":\"https://www.zerozero.pt/jogador/cristiano-ronaldo?epoca_id=155\",\"Imagem\":\"https://cdn-img.staticzz.com/img/planteis/new/06/64/14890664_cristiano_ronaldo_20251117043404.png\"},{\"Título\":\"Al-Nassr Cristiano Ronaldo 2024/25\",\"Ver\":\"https://www.zerozero.pt/jogador/cristiano-ronaldo?epoca_id=154\",\"Imagem\":\"https://cdn-img.staticzz.com/img/planteis/new/72/46/11527246_cristiano_ronaldo_20250528093706.png\"},{\"Título\":\"Al-Nassr Cristiano Ronaldo 2023/24\",\"Ver\":\"https://www.zerozero.pt/jogador/cristiano-ronaldo?epoca_id=153\",\"Imagem\":\"https://cdn-img.staticzz.com/img/planteis/new/39/79/8693979_cristiano_ronaldo_20240817233026.jpg\"},{\"Título\":\"Al-Nassr Cristiano Ronaldo 2022/23\",\"Ver\":\"https://www.zerozero.pt/jogador/cristiano-ronaldo?epoca_id=152\",\"Imagem\":\"https://cdn-img.staticzz.com/img/planteis/new/04/27/7460427_cristiano_ronaldo_20240525112233.jpg\"}]', 'https://www.zerozero.pt/jogador/cristiano-ronaldo/raiox', 'https://www.zerozero.pt/jogador/cristiano-ronaldo', '2026-04-20 13:56:40', '2026-04-20 13:56:40'),
(3, 'gianluca-prestianni', 'Gianluca Prestianni Gross', '2006-01-31', 20, 'Argentina', 'Ciudadela', 'Argentina', 'Itália', NULL, NULL, 'No ativo', '1 Jogos / 0 Golos', '166 cm', '53 kg', 'Extremo Direito 2.º avançado', 'Benfica', '12.0 M €', '[{\"J\":\"UEFA Champions League (Qual.)\",\"M\":\"2\",\"GM\":\"51\",\"AST\":\"0\",\"coluna_5\":\"0\"},{\"J\":\"Liga Portuguesa\",\"M\":\"25\",\"GM\":\"1302\",\"AST\":\"3\",\"coluna_5\":\"4\"},{\"J\":\"Supertaça\",\"M\":\"1\",\"GM\":\"10\",\"AST\":\"0\",\"coluna_5\":\"0\"},{\"J\":\"Taça de Portugal\",\"M\":\"2\",\"GM\":\"162\",\"AST\":\"0\",\"coluna_5\":\"0\"},{\"J\":\"Taça da Liga\",\"M\":\"2\",\"GM\":\"71\",\"AST\":\"0\",\"coluna_5\":\"0\"},{\"J\":\"37\",\"M\":\"1881\",\"GM\":\"3\",\"AST\":\"4\"},{\"J\":\"Jogos Preparação Seleções\",\"M\":\"1\",\"GM\":\"4\",\"AST\":\"0\",\"coluna_5\":\"0\"},{\"J\":\"Total\",\"M\":\"38\",\"GM\":\"1885\",\"AST\":\"3\",\"coluna_5\":\"4\"}]', '[{\"ÉPOCA\":\"2024/25\",\"EQUIPA\":\"Benfica\",\"J\":\"14\",\"G\":\"1\",\"AST\":\"2\"},{\"ÉPOCA\":\"Benfica\",\"EQUIPA\":\"[B]\",\"J\":\"5\",\"G\":\"1\",\"AST\":\"1\"},{\"ÉPOCA\":\"+11 registos\"}]', '[]', '[]', '[{\"Pergunta\":\"Qual o nome completo de Gianluca Prestianni?\",\"Resposta\":\"O nome completo é Gianluca Prestianni Gross.\"},{\"Pergunta\":\"Quantos anos tem Gianluca Prestianni?\",\"Resposta\":\"Gianluca Prestianni tem 20 anos, nasceu a 31 janeiro 2006, em Ciudadela, Argentina.\"},{\"Pergunta\":\"Qual a posição de Gianluca Prestianni?\",\"Resposta\":\"Gianluca Prestianni joga na posição de Avançado.\"}]', '[{\"coluna_1\":\"2.º\",\"coluna_2\":\"Remates para Fora\",\"coluna_3\":\"Taça de Portugal 25/26\",\"coluna_4\":\"3\"},{\"coluna_1\":\"2.º\",\"coluna_2\":\"Dribles Tentados\",\"coluna_3\":\"Allianz Cup 25/26\",\"coluna_4\":\"9\"},{\"coluna_1\":\"2.º\",\"coluna_2\":\"Oportunidades Criadas por jogo\",\"coluna_3\":\"Taça de Portugal 25/26\",\"coluna_4\":\"2.00\"},{\"coluna_1\":\"2.º\",\"coluna_2\":\"Remates para Fora\",\"coluna_3\":\"Allianz Cup 25/26\",\"coluna_4\":\"2\"},{\"coluna_1\":\"2.º\",\"coluna_2\":\"Passes Chave por jogo\",\"coluna_3\":\"Taça de Portugal 25/26\",\"coluna_4\":\"2.00\"}]', '[{\"Título\":\"Fotografia\",\"Ver\":\"https://www.zerozero.pt/foto.php?fk_galeria=0&nchapter=1&tpe=1&ide=977459\",\"Imagem\":\"https://www.zerozero.pt/img/galerias/380/1469380_med_liga_portugal_betclic_2025_26_casa_pia_ac_x_benfica.jpg.jpg\"},{\"Título\":\"Fotografia\",\"Ver\":\"https://www.zerozero.pt/foto.php?fk_galeria=0&nchapter=2&tpe=1&ide=977459\",\"Imagem\":\"https://www.zerozero.pt/img/galerias/378/1469378_med_liga_portugal_betclic_2025_26_casa_pia_ac_x_benfica.jpg.jpg\"},{\"Título\":\"Fotografia\",\"Ver\":\"https://www.zerozero.pt/foto.php?fk_galeria=0&nchapter=3&tpe=1&ide=977459\",\"Imagem\":\"https://www.zerozero.pt/img/galerias/662/1460662_med_liga_portugal_betclic_2025_26_benfica_x_vitoria_sc.jpg.jpg\"},{\"Título\":\"Mais fotografias\",\"Ver\":\"https://www.zerozero.pt/player_photos.php?id=977459\",\"Imagem\":\"\"}]', '[{\"ÉPOCA\":\"2024/25\",\"EQUIPA\":\"Benfica\",\"J\":\"14\",\"G\":\"1\",\"AST\":\"2\"},{\"ÉPOCA\":\"Benfica\",\"EQUIPA\":\"[B]\",\"J\":\"5\",\"G\":\"1\",\"AST\":\"1\"},{\"ÉPOCA\":\"+11 registos\"}]', '[{\"nome\":\"Bruma\",\"url\":\"https://www.zerozero.pt/jogador/bruma/74312\"},{\"nome\":\"Ángel Di María\",\"url\":\"https://www.zerozero.pt/jogador/angel-di-maria/37283\"},{\"nome\":\"Nicolás Otamendi\",\"url\":\"https://www.zerozero.pt/jogador/nicolas-otamendi/67588\"},{\"nome\":\"João Mário\",\"url\":\"https://www.zerozero.pt/jogador/joao-mario/56560\"},{\"nome\":\"João Neves\",\"url\":\"https://www.zerozero.pt/jogador/joao-neves/587629\"},{\"nome\":\"Vangelis Pavlidis\",\"url\":\"https://www.zerozero.pt/jogador/vangelis-pavlidis/459841\"},{\"nome\":\"Gonçalo Guedes\",\"url\":\"https://www.zerozero.pt/jogador/goncalo-guedes/143938\"},{\"nome\":\"Renato Sanches\",\"url\":\"https://www.zerozero.pt/jogador/renato-sanches/155284\"}]', '[{\"Título\":\"Benfica Gianluca Prestianni 2025/26\",\"Ver\":\"https://www.zerozero.pt/jogador/gianluca-prestianni/977459?epoca_id=155\",\"Imagem\":\"https://cdn-img.staticzz.com/img/planteis/new/36/32/14903632_gianluca_prestianni_20251121220247.png\"},{\"Título\":\"Benfica Gianluca Prestianni 2024/25\",\"Ver\":\"https://www.zerozero.pt/jogador/gianluca-prestianni/977459?epoca_id=154\",\"Imagem\":\"https://cdn-img.staticzz.com/img/planteis/new/54/58/11535458_gianluca_prestianni_20240803151807.jpg\"},{\"Título\":\"Benfica Gianluca Prestianni 2023/24\",\"Ver\":\"https://www.zerozero.pt/jogador/gianluca-prestianni/977459?epoca_id=153\",\"Imagem\":\"https://cdn-img.staticzz.com/img/planteis/new/87/68/9808768_gianluca_prestianni_20240503165643.png\"},{\"Título\":\"Vélez Sarsfield Gianluca Prestianni 2023\",\"Ver\":\"https://www.zerozero.pt/jogador/gianluca-prestianni/977459?epoca_id=152\",\"Imagem\":\"https://cdn-img.staticzz.com/img/planteis/new/03/48/7440348_gianluca_prestianni_20240503173657.jpg\"}]', 'https://www.zerozero.pt/jogador/gianluca-prestianni/977459/raiox', 'https://www.zerozero.pt/jogador/gianluca-prestianni/977459?search=1', '2026-04-20 13:56:40', '2026-04-20 13:56:40');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_players_slug` (`slug`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `players`
--
ALTER TABLE `players`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
