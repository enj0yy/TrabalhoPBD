-- Inserir usuários
INSERT INTO public.usuarios
(email, senha, nome, data_nascimento, nome_usuario, foto, biografia)
VALUES ('grazi@gmail.com', '123', 'Graziele', '2001-03-12', 'enjoy', 'enjoy.jpg', 'Estudante');

INSERT INTO public.usuarios
(email, senha, nome, data_nascimento, nome_usuario, foto, biografia)
VALUES ('ana@gmail.com', '1234', 'Ana', '2000-01-01', 'ana', 'ana.jpg', 'Professora');


-- Inserir seguidores
INSERT INTO public.seguidores
(id_usuario_seguidor, id_usuario_seguido, data_interacao)
VALUES (1,2,NOW());

INSERT INTO public.seguidores
(id_usuario_seguidor, id_usuario_seguido, data_interacao)
VALUES (2,1,NOW());


-- Inserir publicações
INSERT INTO public.publicacoes
(conteudo, data_criacao, id_usuario_criador)
VALUES('Publicação Teste', NOW(), 1);

INSERT INTO public.publicacoes
(conteudo, data_criacao, id_usuario_criador)
VALUES('Publicação Teste 2', NOW(), 2);


-- Inserir curtidas
INSERT INTO public.curtidas
(id_publicacao, id_usuario, data_interacao)
VALUES(1, 2, NOW());


-- Inserir comentários
INSERT INTO public.comentarios
(id_publicacao, id_usuario, comentario, data_interacao)
VALUES(1, 2, 'Comentário Teste', NOW());

