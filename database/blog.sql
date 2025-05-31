CREATE TABLE IF NOT EXISTS categorias(
  id_categorias INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  cdescritivo VARCHAR(50) NOT NULL
);

INSERT INTO categorias (cdescritivo)
VALUES
("Tecnologia"),
("Games"),
("Saúde Mental"),
("Moda e Estilo"),
("Gastronomia"),
("Humor"),
("Turismo"),
("Notícias e Atualidades"),
("Celebridades"),
("Cinema e Séries");

CREATE TABLE IF NOT EXISTS tags(
  id_tags INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  descritivo VARCHAR(50) NOT NULL
);

INSERT INTO tags (descritivo)
VALUES
("Linguagens de Programação"),
("Novos jogos de 2025"),
("Psicologia"),
("Estação Outono/Inverno"),
("Receitas de Doces"),
("Lista de Standups"),
("Viagens"),
("Politica Atual"),
("Roberto Carlos"),
("Marvel");

CREATE TABLE IF NOT EXISTS usuarios (
  id_usuarios INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  tipo ENUM("administrador","comum") NOT NULL,
  nome VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  senha VARCHAR(100) NOT NULL
);

INSERT INTO usuarios (tipo, nome, email, senha) 
VALUES
('administrador', 'admin', 'admin@admin.com', 'admin'),
('comum', 'teste', 'teste@teste.com', 'teste');

CREATE TABLE IF NOT EXISTS posts (
  id_posts INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(50) NOT NULL,
  conteudo VARCHAR(1000) NOT NULL,
  datap DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  id_usuarios INT NOT NULL,
  id_categorias INT NOT NULL,

  FOREIGN KEY (id_categorias) REFERENCES categorias (id_categorias),
  FOREIGN KEY (id_usuarios) REFERENCES usuarios (id_usuarios)
);

INSERT INTO posts (titulo, conteudo, datap, id_usuarios, id_categorias) 
VALUES
('Primeiro Post', 'Primeiro Post', '2025-05-18', 1, 1),
('Segundo Post', 'Segundo Post', '2025-05-18', 1, 2);

CREATE TABLE IF NOT EXISTS posts_tags(
  id_posts_tags INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_posts INT NOT NULL,
  id_tags INT NOT NULL,

  FOREIGN KEY (id_posts) REFERENCES posts (id_posts),
  FOREIGN KEY (id_tags) REFERENCES tags (id_tags)
);

INSERT INTO posts_tags (id_posts, id_tags) 
VALUES
(1,2),
(1,4),
(2,5),
(2,3);

/*
1. 
As linguagens de programação estão passando por uma grande transformação, com a ascensão de opções modernas como Rust, Kotlin e Elixir. Enquanto linguagens clássicas como Java e C ainda dominam setores importantes, a busca por segurança, desempenho e legibilidade está moldando o futuro do desenvolvimento. Python e JavaScript seguem populares, mas o interesse por alternativas mais específicas cresce. Linguagens como Zig e Crystal ganham espaço por oferecerem controle com simplicidade. A concorrência incentiva melhorias constantes, com foco em programação paralela e eficiente. Aprender novas linguagens deixou de ser diferencial: tornou-se uma necessidade. O futuro será moldado por quem conseguir acompanhar essa evolução.
Tags: Linguagens de Programação

2. Os Lançamentos de Jogos Mais Aguardados de 2025
2025 promete ser um ano de ouro para os gamers, com títulos inovadores e franquias clássicas retornando com força total. Jogos como “Eclipse: Shadows Reborn” e “Horizon Nexus” misturam tecnologia de ponta com narrativas imersivas. Resident Evil e The Legend of Zelda também terão novos capítulos, gerando expectativa entre os fãs. Além disso, a realidade virtual se consolida como tendência nos grandes lançamentos. A imersão, a inclusão e a personalização estão em destaque. Plataformas como PC, consoles e mobile receberão experiências otimizadas. É o ano em que jogabilidade e emoção prometem andar juntas como nunca.
Tags: Novos jogos de 2025

3. A Psicologia por Trás dos Comportamentos em Massa
Na psicologia social, os comportamentos de massa revelam muito sobre influência, identidade e pertencimento. Quando em grupo, indivíduos agem de maneira distinta, muitas vezes impulsionados por emoção, liderança ou anonimato. Eventos como protestos ou pânicos demonstram como nossas ações são moldadas pelo coletivo. Com a ascensão das redes sociais, esse fenômeno ganhou ainda mais força e velocidade. Algoritmos reforçam bolhas de pensamento, aumentando reações emocionais e polarização. A psicologia busca entender essas dinâmicas para prevenir manipulações e promover empatia. Compreender o coletivo é essencial para agir de forma mais consciente no individual.
Tags: Psicologia

4. Outono e Inverno: Estações de Transição e Aconchego
Outono e inverno trazem mais que temperaturas amenas: são convites ao recolhimento, introspecção e novas rotinas. As folhas caem, o ar fica seco e os dias mais curtos criam um clima de pausa natural. Roupas quentes, comidas caseiras e tardes mais tranquilas tomam conta do cotidiano. Festas juninas, fondue, vinhos e livros tornam a estação ainda mais acolhedora. As paisagens ganham tons terrosos e melancólicos, inspirando artistas e poetas. No Brasil, o inverno é leve em muitas regiões, mas ideal para relaxar. São meses ideais para cuidar do corpo e da mente com mais calma.
Tags: Estação Outono/Inverno

5. Receita de Brigadeiro Gourmet com Toque de Flor de Sal
O brigadeiro é um clássico brasileiro que ganha sofisticação com toques criativos, como a flor de sal. Para essa versão gourmet, use leite condensado, chocolate 70%, manteiga e uma pitada desse sal especial. A combinação entre o doce intenso do chocolate e o leve contraste salgado cria uma explosão de sabor. Cozinhe até o ponto certo, resfrie e enrole com cobertura de cacau em pó ou granulado belga. Ideal para eventos, presentes ou um mimo pessoal. Essa receita une simplicidade com elegância. Um doce que agrada aos olhos e ao paladar, com equilíbrio surpreendente.
Tags: Receitas de Doces

6. 5 Stand-Ups para Rir até Chorar em 2025
O stand-up comedy segue em alta e 2025 traz uma leva de especiais imperdíveis. Thiago Ventura, Bruna Louise e Igor Guimarães estão com novos shows cheios de observações ácidas e muito riso. Afonso Padilha aborda temas de família com seu humor leve e crítico. Entre os novos nomes, Babu Carreira se destaca por misturar crítica social e comédia de forma envolvente. Esses artistas estão em plataformas de streaming e em turnês pelo Brasil. A diversidade de estilos é um dos pontos altos deste ano. Se rir é o melhor remédio, 2025 está bem servido.
Tags: Lista de Standups

7. Roteiro de Viagem para a Chapada Diamantina
A Chapada Diamantina é um destino encantador para quem busca aventura, natureza e cultura brasileira. Suas trilhas, cachoeiras e cavernas são de uma beleza estonteante, ideais para ecoturismo. Lençóis serve como base para explorar atrativos como a Cachoeira da Fumaça e o Poço Encantado. A região ainda oferece uma culinária local rica e aconchegante, com destaque para pratos típicos baianos. Guias experientes enriquecem o passeio com histórias e segurança. À noite, vilas pacatas revelam um céu estrelado e charme rústico. É uma viagem que renova corpo e alma em cada passo.
Tags: Viagens

8. A Complexidade da Política Atual no Brasil
A política brasileira em 2025 vive um momento tenso e transformador, com debates sobre reformas e novas tecnologias no setor público. A polarização ainda está presente, mas há tentativas de renovação e diálogo. Temas como sustentabilidade, direitos civis e digitalização ganham espaço no Congresso. A sociedade civil tem se mobilizado por mais transparência e responsabilidade. Redes sociais continuam sendo palco de desinformação, mas também de ativismo. O cenário exige mais do eleitor: participação crítica e constante. Em meio aos desafios, há oportunidades de avanço e reconstrução democrática.
Tags: Politica Atual

9. Roberto Carlos: O Eterno Rei e Seus Novos Caminhos
Roberto Carlos continua encantando gerações com sua voz marcante e presença carismática. Em 2025, celebra mais de seis décadas de carreira com uma turnê emocionante pelo Brasil e Portugal. O repertório inclui sucessos eternos e novas canções que mantêm seu estilo romântico. Um documentário recente mostra bastidores de sua trajetória, revelando momentos íntimos e histórias tocantes. Fãs de todas as idades se emocionam com sua longevidade e talento. Roberto se reinventa sem perder a essência, mantendo-se atual e relevante. Um verdadeiro ícone da música brasileira que segue firme no coração do público.
Tags: Roberto Carlos

10. Marvel 2025: Fase 6 e o Futuro dos Heróis
A Marvel inicia 2025 com produções ambiciosas que marcam sua Fase 6, incluindo “Guerras Secretas” e a aguardada estreia dos X-Men no MCU. O estúdio aposta em histórias mais maduras, interligadas e diversificadas, com novos rostos ganhando protagonismo. Séries no Disney+ como Nova e Jessica Drew aprofundam personagens antes secundários. A representatividade também se amplia, com mais diversidade nas telas. Além disso, a estética visual e as conexões multiversais continuam encantando os fãs. A Marvel quer emocionar e surpreender, sem perder o vínculo com suas raízes épicas. 2025 será um ano decisivo para seus heróis.
Tags: Marvel
*/