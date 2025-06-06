-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2025 at 08:17 PM
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
  `id_categorias` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id_posts`, `titulo`, `conteudo`, `datap`, `id_usuarios`, `id_categorias`) VALUES
(1, 'O Futuro das Linguagens de Programação: Da Tradição à Inovação', 'As linguagens de programação estão passando por uma grande transformação, com a ascensão de opções modernas como Rust, Kotlin e Elixir. Enquanto linguagens clássicas como Java e C ainda dominam setores importantes, a busca por segurança, desempenho e legibilidade está moldando o futuro do desenvolvimento. Python e JavaScript seguem populares, mas o interesse por alternativas mais específicas cresce. Linguagens como Zig e Crystal ganham espaço por oferecerem controle com simplicidade. A concorrência incentiva melhorias constantes, com foco em programação paralela e eficiente. Aprender novas linguagens deixou de ser diferencial: tornou-se uma necessidade. O futuro será moldado por quem conseguir acompanhar essa evolução.', '2025-06-06 14:31:04', 2, 1),
(2, 'Os Lançamentos de Jogos Mais Aguardados de 2025', '2025 promete ser um ano de ouro para os gamers, com títulos inovadores e franquias clássicas retornando com força total. Jogos como “Eclipse: Shadows Reborn” e “Horizon Nexus” misturam tecnologia de ponta com narrativas imersivas. Resident Evil e The Legend of Zelda também terão novos capítulos, gerando expectativa entre os fãs. Além disso, a realidade virtual se consolida como tendência nos grandes lançamentos. A imersão, a inclusão e a personalização estão em destaque. Plataformas como PC, consoles e mobile receberão experiências otimizadas. É o ano em que jogabilidade e emoção prometem andar juntas como nunca.', '2025-06-06 14:46:49', 3, 2),
(3, 'A Psicologia por Trás dos Comportamentos em Massa', 'Na psicologia social, os comportamentos de massa revelam muito sobre influência, identidade e pertencimento. Quando em grupo, indivíduos agem de maneira distinta, muitas vezes impulsionados por emoção, liderança ou anonimato. Eventos como protestos ou pânicos demonstram como nossas ações são moldadas pelo coletivo. Com a ascensão das redes sociais, esse fenômeno ganhou ainda mais força e velocidade. Algoritmos reforçam bolhas de pensamento, aumentando reações emocionais e polarização. A psicologia busca entender essas dinâmicas para prevenir manipulações e promover empatia. Compreender o coletivo é essencial para agir de forma mais consciente no individual.', '2025-06-06 14:50:52', 4, 3),
(4, 'Outono e Inverno: Estações de Transição e Aconchego', 'Outono e inverno trazem mais que temperaturas amenas: são convites ao recolhimento, introspecção e novas rotinas. As folhas caem, o ar fica seco e os dias mais curtos criam um clima de pausa natural. Roupas quentes, comidas caseiras e tardes mais tranquilas tomam conta do cotidiano. Festas juninas, fondue, vinhos e livros tornam a estação ainda mais acolhedora. As paisagens ganham tons terrosos e melancólicos, inspirando artistas e poetas. No Brasil, o inverno é leve em muitas regiões, mas ideal para relaxar. São meses ideais para cuidar do corpo e da mente com mais calma.', '2025-06-06 14:55:06', 5, 4),
(5, 'Receita de Brigadeiro Gourmet com Toque de Flor de Sal', 'O brigadeiro é um clássico brasileiro que ganha sofisticação com toques criativos, como a flor de sal. Para essa versão gourmet, use leite condensado, chocolate 70%, manteiga e uma pitada desse sal especial. A combinação entre o doce intenso do chocolate e o leve contraste salgado cria uma explosão de sabor. Cozinhe até o ponto certo, resfrie e enrole com cobertura de cacau em pó ou granulado belga. Ideal para eventos, presentes ou um mimo pessoal. Essa receita une simplicidade com elegância. Um doce que agrada aos olhos e ao paladar, com equilíbrio surpreendente.', '2025-06-06 15:04:46', 6, 5),
(6, '5 Stand-Ups para Rir até Chorar em 2025', 'O stand-up comedy segue em alta e 2025 traz uma leva de especiais imperdíveis. Thiago Ventura, Bruna Louise e Igor Guimarães estão com novos shows cheios de observações ácidas e muito riso. Afonso Padilha aborda temas de família com seu humor leve e crítico. Entre os novos nomes, Babu Carreira se destaca por misturar crítica social e comédia de forma envolvente. Esses artistas estão em plataformas de streaming e em turnês pelo Brasil. A diversidade de estilos é um dos pontos altos deste ano. Se rir é o melhor remédio, 2025 está bem servido.', '2025-06-06 15:06:24', 7, 6),
(7, 'Roteiro de Viagem para a Chapada Diamantina', 'A Chapada Diamantina é um destino encantador para quem busca aventura, natureza e cultura brasileira. Suas trilhas, cachoeiras e cavernas são de uma beleza estonteante, ideais para ecoturismo. Lençóis serve como base para explorar atrativos como a Cachoeira da Fumaça e o Poço Encantado. A região ainda oferece uma culinária local rica e aconchegante, com destaque para pratos típicos baianos. Guias experientes enriquecem o passeio com histórias e segurança. À noite, vilas pacatas revelam um céu estrelado e charme rústico. É uma viagem que renova corpo e alma em cada passo.\',\'2025-04-27 19:48:50', '2025-06-06 15:09:08', 8, 7),
(8, 'A Complexidade da Política Atual no Brasil', 'A política brasileira em 2025 vive um momento tenso e transformador, com debates sobre reformas e novas tecnologias no setor público. A polarização ainda está presente, mas há tentativas de renovação e diálogo. Temas como sustentabilidade, direitos civis e digitalização ganham espaço no Congresso. A sociedade civil tem se mobilizado por mais transparência e responsabilidade. Redes sociais continuam sendo palco de desinformação, mas também de ativismo. O cenário exige mais do eleitor: participação crítica e constante. Em meio aos desafios, há oportunidades de avanço e reconstrução democrática.', '2025-06-06 15:10:43', 9, 8),
(9, 'Marvel 2025: Fase 6 e o Futuro dos Heróis', 'A Marvel inicia 2025 com produções ambiciosas que marcam sua Fase 6, incluindo “Guerras Secretas” e a aguardada estreia dos X-Men no MCU. O estúdio aposta em histórias mais maduras, interligadas e diversificadas, com novos rostos ganhando protagonismo. Séries no Disney+ como Nova e Jessica Drew aprofundam personagens antes secundários. A representatividade também se amplia, com mais diversidade nas telas. Além disso, a estética visual e as conexões multiversais continuam encantando os fãs. A Marvel quer emocionar e surpreender, sem perder o vínculo com suas raízes épicas. 2025 será um ano decisivo para seus heróis.', '2025-06-06 15:12:21', 10, 10),
(10, 'Roberto Carlos: O Eterno Rei e Seus Novos Caminhos', 'Roberto Carlos continua encantando gerações com sua voz marcante e presença carismática. Em 2025, celebra mais de seis décadas de carreira com uma turnê emocionante pelo Brasil e Portugal. O repertório inclui sucessos eternos e novas canções que mantêm seu estilo romântico. Um documentário recente mostra bastidores de sua trajetória, revelando momentos íntimos e histórias tocantes. Fãs de todas as idades se emocionam com sua longevidade e talento. Roberto se reinventa sem perder a essência, mantendo-se atual e relevante. Um verdadeiro ícone da música brasileira que segue firme no coração do público.', '2025-06-06 15:15:53', 11, 9);

-- --------------------------------------------------------

--
-- Table structure for table `posts_tags`
--

CREATE TABLE `posts_tags` (
  `id_posts_tags` int(11) NOT NULL,
  `id_posts` int(11) NOT NULL,
  `id_tags` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts_tags`
--

INSERT INTO `posts_tags` (`id_posts_tags`, `id_posts`, `id_tags`) VALUES
(1, 1, 11),
(2, 1, 12),
(3, 1, 13),
(4, 2, 14),
(5, 2, 15),
(6, 2, 16),
(7, 3, 17),
(8, 3, 18),
(9, 3, 19),
(10, 3, 20),
(11, 4, 21),
(12, 4, 22),
(13, 4, 23),
(14, 5, 24),
(15, 5, 25),
(16, 5, 26),
(17, 6, 27),
(18, 6, 28),
(19, 6, 29),
(20, 6, 30),
(21, 7, 31),
(22, 7, 32),
(23, 7, 33),
(24, 8, 34),
(25, 8, 35),
(26, 8, 36),
(27, 9, 37),
(28, 9, 38),
(29, 9, 39),
(30, 10, 40),
(31, 10, 41),
(32, 10, 42),
(33, 10, 43),
(34, 10, 44);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id_tags` int(11) NOT NULL,
  `descritivo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id_tags`, `descritivo`) VALUES
(11, 'Linguagens de Programação'),
(12, '2025'),
(13, 'Nova Era'),
(14, 'Lançamentos 2025'),
(15, 'Jogos mais Aguardados'),
(16, 'Games 2025'),
(17, 'Psicologia'),
(18, 'Comporatamento Humano'),
(19, 'Mente'),
(20, 'Saude'),
(21, 'Moda'),
(22, 'Estilo'),
(23, 'Roupas'),
(24, 'Comida'),
(25, 'Doces'),
(26, 'Brigadeiro'),
(27, 'Piadas'),
(28, 'Stando-Up'),
(29, 'Diversão'),
(30, 'Risadas'),
(31, 'Viagem'),
(32, 'Diamantina'),
(33, 'Cultural'),
(34, 'Politica'),
(35, 'Brasil'),
(36, 'Tecnologia'),
(37, 'Marvel'),
(38, 'Fase 6'),
(39, 'Filmes de Herois'),
(40, 'Roberto Carlos'),
(41, 'Turne'),
(42, 'Musica'),
(43, 'Brasil'),
(44, 'Portugal');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuarios` int(11) NOT NULL,
  `tipo` enum('administrador','comum') NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id_usuarios`, `tipo`, `nome`, `email`, `senha`) VALUES
(1, 'administrador', 'admin', 'administrador@gmail.com', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'comum', 'Beatriz2211', 'beatriz@gmail.com', '202cb962ac59075b964b07152d234b70'),
(3, 'comum', 'Pablo Aberto Ferraz', 'pablo.ferraz@gmail.com', '202cb962ac59075b964b07152d234b70'),
(4, 'comum', 'BolinhoFofo', 'bolobolo@gmail.com', '202cb962ac59075b964b07152d234b70'),
(5, 'comum', 'Tevez_zeveT', 'tevez384@gmail.com', '202cb962ac59075b964b07152d234b70'),
(6, 'comum', 'ReiDosPosts 😎', 'posts@gmail.com', '202cb962ac59075b964b07152d234b70'),
(7, 'comum', 'Palavra Divina 🙏📿', 'palavradivina@gmail.com', '202cb962ac59075b964b07152d234b70'),
(8, 'comum', 'Dudinha ❤️', 'dudasilvestre258@gmail.com', '202cb962ac59075b964b07152d234b70'),
(9, 'comum', 'Jão', 'joaoPedro1122@gmail.com', '202cb962ac59075b964b07152d234b70'),
(10, 'comum', 'NoobMaster69', 'noobmaster69@gmail.com', '202cb962ac59075b964b07152d234b70'),
(11, 'comum', 'PaulinaLina', 'paulaFonsecaFerraz@gmail.com', '202cb962ac59075b964b07152d234b70');

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
-- Indexes for table `posts_tags`
--
ALTER TABLE `posts_tags`
  ADD PRIMARY KEY (`id_posts_tags`),
  ADD KEY `id_posts` (`id_posts`),
  ADD KEY `id_tags` (`id_tags`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id_tags`);

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
  MODIFY `id_categorias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id_posts` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `posts_tags`
--
ALTER TABLE `posts_tags`
  MODIFY `id_posts_tags` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id_tags` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
-- Constraints for table `posts_tags`
--
ALTER TABLE `posts_tags`
  ADD CONSTRAINT `posts_tags_ibfk_1` FOREIGN KEY (`id_posts`) REFERENCES `posts` (`id_posts`),
  ADD CONSTRAINT `posts_tags_ibfk_2` FOREIGN KEY (`id_tags`) REFERENCES `tags` (`id_tags`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
