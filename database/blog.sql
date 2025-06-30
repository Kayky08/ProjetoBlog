-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2025 at 01:18 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `id_categorias` int(11) NOT NULL,
  `cdescritivo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`id_categorias`, `cdescritivo`) VALUES
(1, 'Tecnologia'),
(2, 'Games'),
(3, 'Saúde Mental'),
(4, 'Moda e Estilo'),
(5, 'Gastronomia'),
(6, 'Humor'),
(7, 'Turismo'),
(8, 'Notícias e Atualidades'),
(9, 'Celebridades'),
(10, 'Cinema e Séries');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id_posts` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `conteudo` mediumtext NOT NULL,
  `datap` datetime NOT NULL DEFAULT current_timestamp(),
  `id_usuarios` int(11) NOT NULL,
  `id_categorias` int(11) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id_posts`, `titulo`, `conteudo`, `datap`, `id_usuarios`, `id_categorias`, `imagem`) VALUES
(66, 'O Futuro das Linguagens de Programação: Da Tradição à Inovação', 'As linguagens de programação estão passando por uma grande transformação, com a ascensão de opções modernas como Rust, Kotlin e Elixir. Enquanto linguagens clássicas como Java e C ainda dominam setores importantes, a busca por segurança, desempenho e legibilidade está moldando o futuro do desenvolvimento. Python e JavaScript seguem populares, mas o interesse por alternativas mais específicas cresce. Linguagens como Zig e Crystal ganham espaço por oferecerem controle com simplicidade. A concorrência incentiva melhorias constantes, com foco em programação paralela e eficiente. Aprender novas linguagens deixou de ser diferencial: tornou-se uma necessidade. O futuro será moldado por quem conseguir acompanhar essa evolução.', '2025-06-23 16:35:31', 32, 1, 'src/img/6859ac83f1280_tecnologia.jpeg'),
(67, 'Os Lançamentos de Jogos Mais Aguardados de 2025', '2025 promete ser um ano de ouro para os gamers, com títulos inovadores e franquias clássicas retornando com força total. Jogos como “Eclipse: Shadows Reborn” e “Horizon Nexus” misturam tecnologia de ponta com narrativas imersivas. Resident Evil e The Legend of Zelda também terão novos capítulos, gerando expectativa entre os fãs. Além disso, a realidade virtual se consolida como tendência nos grandes lançamentos. A imersão, a inclusão e a personalização estão em destaque. Plataformas como PC, consoles e mobile receberão experiências otimizadas. É o ano em que jogabilidade e emoção prometem andar juntas como nunca.\', \'2025-06-06 14:46:49', '2025-06-23 16:37:54', 33, 2, 'src/img/6859ad12de2fb_games.jpeg'),
(68, 'A Psicologia por Trás dos Comportamentos em Massa', 'Na psicologia social, os comportamentos de massa revelam muito sobre influência, identidade e pertencimento. Quando em grupo, indivíduos agem de maneira distinta, muitas vezes impulsionados por emoção, liderança ou anonimato. Eventos como protestos ou pânicos demonstram como nossas ações são moldadas pelo coletivo. Com a ascensão das redes sociais, esse fenômeno ganhou ainda mais força e velocidade. Algoritmos reforçam bolhas de pensamento, aumentando reações emocionais e polarização. A psicologia busca entender essas dinâmicas para prevenir manipulações e promover empatia. Compreender o coletivo é essencial para agir de forma mais consciente no individual.', '2025-06-23 16:38:54', 34, 3, 'src/img/6859ad4e8369f_saudemental.png'),
(69, 'Outono e Inverno: Estações de Transição e Aconchego', 'Outono e inverno trazem mais que temperaturas amenas: são convites ao recolhimento, introspecção e novas rotinas. As folhas caem, o ar fica seco e os dias mais curtos criam um clima de pausa natural. Roupas quentes, comidas caseiras e tardes mais tranquilas tomam conta do cotidiano. Festas juninas, fondue, vinhos e livros tornam a estação ainda mais acolhedora. As paisagens ganham tons terrosos e melancólicos, inspirando artistas e poetas. No Brasil, o inverno é leve em muitas regiões, mas ideal para relaxar. São meses ideais para cuidar do corpo e da mente com mais calma.', '2025-06-23 16:40:05', 35, 4, 'src/img/6859ad957a8b9_modaestilo.jpeg'),
(71, '5 Stand-Ups para Rir até Chorar em 2025', 'O stand-up comedy segue em alta e 2025 traz uma leva de especiais imperdíveis. Thiago Ventura, Bruna Louise e Igor Guimarães estão com novos shows cheios de observações ácidas e muito riso. Afonso Padilha aborda temas de família com seu humor leve e crítico. Entre os novos nomes, Babu Carreira se destaca por misturar crítica social e comédia de forma envolvente. Esses artistas estão em plataformas de streaming e em turnês pelo Brasil. A diversidade de estilos é um dos pontos altos deste ano. Se rir é o melhor remédio, 2025 está bem servido.', '2025-06-23 16:42:12', 37, 6, 'src/img/6859ae141014c_humor.jpeg'),
(72, 'Roteiro de Viagem para a Chapada Diamantina', 'A Chapada Diamantina é um destino encantador para quem busca aventura, natureza e cultura brasileira. Suas trilhas, cachoeiras e cavernas são de uma beleza estonteante, ideais para ecoturismo. Lençóis serve como base para explorar atrativos como a Cachoeira da Fumaça e o Poço Encantado. A região ainda oferece uma culinária local rica e aconchegante, com destaque para pratos típicos baianos. Guias experientes enriquecem o passeio com histórias e segurança. À noite, vilas pacatas revelam um céu estrelado e charme rústico. É uma viagem que renova corpo e alma em cada passo.', '2025-06-23 16:43:23', 38, 7, 'src/img/6859ae5bd8554_turismo.jpeg'),
(73, 'A Complexidade da Política Atual no Brasil', 'A política brasileira em 2025 vive um momento tenso e transformador, com debates sobre reformas e novas tecnologias no setor público. A polarização ainda está presente, mas há tentativas de renovação e diálogo. Temas como sustentabilidade, direitos civis e digitalização ganham espaço no Congresso. A sociedade civil tem se mobilizado por mais transparência e responsabilidade. Redes sociais continuam sendo palco de desinformação, mas também de ativismo. O cenário exige mais do eleitor: participação crítica e constante. Em meio aos desafios, há oportunidades de avanço e reconstrução democrática.', '2025-06-23 16:44:28', 39, 8, 'src/img/6859ae9c9af0f_noticiasatualidades.jpeg'),
(74, 'Marvel 2025: Fase 6 e o Futuro dos Heróis', 'A Marvel inicia 2025 com produções ambiciosas que marcam sua Fase 6, incluindo “Guerras Secretas” e a aguardada estreia dos X-Men no MCU. O estúdio aposta em histórias mais maduras, interligadas e diversificadas, com novos rostos ganhando protagonismo. Séries no Disney+ como Nova e Jessica Drew aprofundam personagens antes secundários. A representatividade também se amplia, com mais diversidade nas telas. Além disso, a estética visual e as conexões multiversais continuam encantando os fãs. A Marvel quer emocionar e surpreender, sem perder o vínculo com suas raízes épicas. 2025 será um ano decisivo para seus heróis.', '2025-06-23 16:45:18', 40, 10, 'src/img/6859aecedfb2b_marvel.jpeg'),
(75, 'Roberto Carlos: O Eterno Rei e Seus Novos Caminhos', 'Roberto Carlos continua encantando gerações com sua voz marcante e presença carismática. Em 2025, celebra mais de seis décadas de carreira com uma turnê emocionante pelo Brasil e Portugal. O repertório inclui sucessos eternos e novas canções que mantêm seu estilo romântico. Um documentário recente mostra bastidores de sua trajetória, revelando momentos íntimos e histórias tocantes. Fãs de todas as idades se emocionam com sua longevidade e talento. Roberto se reinventa sem perder a essência, mantendo-se atual e relevante. Um verdadeiro ícone da música brasileira que segue firme no coração do público.', '2025-06-23 16:48:38', 41, 9, 'src/img/6859af9627dc3_celebridades.jpeg'),
(81, '5 Stand-Ups para Rir até Chorar em 2025', ' até Chorar em 2025 até Chorar em 2025 até Chorar em 2025 até Chorar em 2025 até Chorar em 2025 até Chorar em 2025 até Chorar em 2025 até Chorar em 2025 até Chorar em 2025 até Chorar em 2025 até Chorar em 2025 até Chorar em 2025 até Chorar em 2025 até Chorar em 2025 até Chorar em 2025 até Chorar em 2025 até Chorar em 2025 até Chorar em 2025 até Chorar em 2025 até Chorar em 2025 até Chorar em 2025 até Chorar em 2025 até Chorar em 2025 até Chorar em 2025 até Chorar em 2025 até Chorar em 2025', '2025-06-23 19:59:09', 33, 3, 'src/img/6859dc39475e4_games.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id_tags` int(11) NOT NULL,
  `descritivo` varchar(50) NOT NULL,
  `id_posts` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id_tags`, `descritivo`, `id_posts`) VALUES
(214, 'Linguagens de Programação', 66),
(215, ' 2025', 66),
(216, ' Nova Era', 66),
(217, 'Games', 67),
(218, ' Atuais', 67),
(219, ' Mais Aguardados', 67),
(220, 'Psicologia', 68),
(221, ' Comporatamento Humano', 68),
(222, ' Mente', 68),
(223, ' Saude', 68),
(224, 'Moda', 69),
(225, ' Estilo', 69),
(226, ' Roupas', 69),
(230, 'Piadas', 71),
(231, ' Stando-Up', 71),
(232, ' Diversão', 71),
(233, ' Risadas', 71),
(234, 'Viagem', 72),
(235, ' Diamantina', 72),
(236, ' Cultural', 72),
(237, 'Atualidades', 73),
(238, ' Politica', 73),
(239, ' Brasil', 73),
(240, 'Marvel', 74),
(241, ' Fase 6', 74),
(242, ' Filmes de Herois', 74),
(243, 'Roberto Carlos', 75),
(244, ' Turne', 75),
(245, ' Musica', 75),
(246, ' Brasil', 75),
(247, ' Portugal', 75),
(285, 'Piadas', 81),
(286, 'Stando-Up', 81),
(287, 'Diversão', 81),
(288, 'Risadas', 81);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuarios` int(11) NOT NULL,
  `tipo` enum('administrador','comum') NOT NULL,
  `status` enum('ativo','bloqueado') NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `imagem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id_usuarios`, `tipo`, `status`, `nome`, `email`, `senha`, `imagem`) VALUES
(32, 'comum', 'bloqueado', 'Beatriz2211', 'beatriz@gmail.com', 'caf1a3dfb505ffed0d024130f58c5cfa', 'src/img/68598ce14e944_beatriz.jpg'),
(33, 'comum', 'ativo', 'Pablo Aberto Ferraz', 'pablo.ferraz@gmail.com', '202cb962ac59075b964b07152d234b70', 'src/img/6859a8ed0d2af_pablo.jpg'),
(34, 'comum', 'ativo', 'BolinhoFofo', 'bolobolo@gmail.com', '202cb962ac59075b964b07152d234b70', 'src/img/6859a92e4e659_bolofofo.jpeg'),
(35, 'comum', 'ativo', 'Tevez_zeveT', 'tevez384@gmail.com', '202cb962ac59075b964b07152d234b70', 'src/img/6859aa42d0627_tevez.jpeg'),
(37, 'comum', 'ativo', 'Palavra Divina 🙏📿', 'palavradivina@gmail.com', '202cb962ac59075b964b07152d234b70', 'src/img/6859aa97ba81e_palavra.jpeg'),
(38, 'comum', 'ativo', 'Dudinha ❤️', 'dudasilvestre258@gmail.com', '202cb962ac59075b964b07152d234b70', 'src/img/6859aac3e4317_dudinha.png'),
(39, 'comum', 'ativo', 'Jão', 'joaoPedro1122@gmail.com', '202cb962ac59075b964b07152d234b70', 'src/img/6859aae655ce3_jao.jpeg'),
(40, 'comum', 'ativo', 'NoobMaster69', 'noobmaster69@gmail.com', '202cb962ac59075b964b07152d234b70', 'src/img/6859ab132a405_noobmaster.jpeg'),
(41, 'comum', 'ativo', 'PaulinaLina', 'paulaFonsecaFerraz@gmail.com', '202cb962ac59075b964b07152d234b70', 'src/img/6859ab474fe42_paulina.jpeg'),
(42, 'comum', 'ativo', 'Administrador', 'administrador@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'src/img/6859d9858a875_noobmaster.jpeg'),
(44, 'administrador', 'ativo', 'Administrador2', 'administrador2@gmail.com', '202cb962ac59075b964b07152d234b70', 'src/img/6859d5fac8eff_palavra.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categorias`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id_posts`),
  ADD KEY `id_categorias` (`id_categorias`),
  ADD KEY `id_usuarios` (`id_usuarios`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id_tags`),
  ADD KEY `id_posts` (`id_posts`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuarios`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categorias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id_posts` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id_tags` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=289;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`id_categorias`) REFERENCES `categorias` (`id_categorias`),
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`id_usuarios`) REFERENCES `usuarios` (`id_usuarios`);

--
-- Constraints for table `tags`
--
ALTER TABLE `tags`
  ADD CONSTRAINT `tags_ibfk_1` FOREIGN KEY (`id_posts`) REFERENCES `posts` (`id_posts`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
