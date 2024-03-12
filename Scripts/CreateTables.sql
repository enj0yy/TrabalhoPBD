CREATE TABLE usuarios (
    id SERIAL PRIMARY KEY,
    email VARCHAR,
    senha VARCHAR,
    nome VARCHAR,
    data_nascimento DATE,
    nome_usuario VARCHAR,
    foto VARCHAR,
    biografia VARCHAR,
    UNIQUE (email, nome_usuario)
);

CREATE TABLE publicacoes (
    id SERIAL PRIMARY KEY,
    conteudo VARCHAR,
    data_criacao TIMESTAMP,
    id_usuario_criador INTEGER
);

CREATE TABLE seguidores (
    id_usuario_seguidor INTEGER,
    id_usuario_seguido INTEGER,
    data_interacao TIMESTAMP
);

ALTER TABLE seguidores
ADD CONSTRAINT seguidores_check
CHECK ( id_usuario_seguidor != id_usuario_seguido );

CREATE TABLE curtidas (
    id_publicacao INTEGER,
    id_usuario INTEGER,
    data_interacao TIMESTAMP
);

CREATE TABLE comentarios (
    id_publicacao INTEGER,
    id_usuario INTEGER,
    comentario VARCHAR,
    data_interacao TIMESTAMP
);
 
ALTER TABLE publicacoes ADD CONSTRAINT FK_Publicacao_2
    FOREIGN KEY (id_usuario_criador)
    REFERENCES usuarios (id)
    ON DELETE CASCADE;
 
ALTER TABLE seguidores ADD CONSTRAINT FK_Seguidores_1
    FOREIGN KEY (id_usuario_seguidor)
    REFERENCES usuarios (id)
    ON DELETE CASCADE;
 
ALTER TABLE seguidores ADD CONSTRAINT FK_Seguidores_2
    FOREIGN KEY (id_usuario_seguido)
    REFERENCES usuarios (id)
    ON DELETE CASCADE;
 
ALTER TABLE curtidas ADD CONSTRAINT FK_Curtidas_1
    FOREIGN KEY (id_publicacao)
    REFERENCES publicacoes (id)
    ON DELETE CASCADE;
 
ALTER TABLE curtidas ADD CONSTRAINT FK_Curtidas_2
    FOREIGN KEY (id_usuario)
    REFERENCES usuarios (id)
    ON DELETE CASCADE;
 
ALTER TABLE comentarios ADD CONSTRAINT FK_Comentarios_1
    FOREIGN KEY (id_publicacao)
    REFERENCES publicacoes (id)
    ON DELETE CASCADE;
 
ALTER TABLE comentarios ADD CONSTRAINT FK_Comentarios_2
    FOREIGN KEY (id_usuario)
    REFERENCES usuarios (id)
    ON DELETE CASCADE;