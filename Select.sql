-- Mostrar informaçoes de todos usuários
SELECT id, nome, nome_usuario, email, senha FROM usuarios;


-- Mostrar seguidores do usuário 1
SELECT usuarios.nome, usuarios.nome_usuario, seguidores.data_interacao
FROM seguidores 
INNER JOIN usuarios ON (seguidores.id_usuario_seguidor = usuarios.id)
WHERE seguidores.id_usuario_seguido = 1;


-- Selecionar todas publicacoes com seus respetivos criadores
SELECT publicacoes.* AS Publicacao, usuarios.nome AS Criador
FROM publicacoes
INNER JOIN usuarios ON (publicacoes.id_usuario_criador = usuarios.id);


-- Selecionar todas publicacoes com sua quantidade de curtidas
SELECT 
publicacoes.id,
publicacoes.conteudo AS Publicacao, 
COUNT(curtidas.id_publicacao) AS Curtidas
FROM publicacoes
LEFT JOIN curtidas ON (publicacoes.id = curtidas.id_publicacao)
GROUP BY 1
ORDER BY curtidas DESC;


-- Selecionar todas publicacoes dos usuários que o usuário 1 segue
SELECT publicacoes.* 
FROM publicacoes
INNER JOIN seguidores ON (publicacoes.id_usuario_criador = seguidores.id_usuario_seguido)
WHERE seguidores.id_usuario_seguidor = 1
ORDER BY publicacoes.data_criacao DESC;


-- Selecionar todos comentários da publicacao 1
SELECT * 
FROM comentarios
WHERE id_publicacao = 1;


-- Selecionar todos comentários do usuário ana
SELECT comentarios.* 
FROM comentarios 
INNER JOIN usuarios ON (comentarios.id_usuario = usuarios.id)
WHERE usuarios.nome_usuario = 'ana'
ORDER BY comentarios.data_interacao DESC;

