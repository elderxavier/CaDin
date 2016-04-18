DROP TABLE IF EXISTS `cadin_usuario`;
CREATE TABLE IF NOT EXISTS `cadin_usuario` (
    id INT(11) UNSIGNED AUTO_INCREMENT,    
    nome varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    senha varchar(255),
    created DATETIME  ON UPDATE CURRENT_TIMESTAMP,
    modified DATETIME ON UPDATE CURRENT_TIMESTAMP,  
    PRIMARY KEY(id)    
)ENGINE=InnoDB AUTO_INCREMENT=1 CHARSET=utf8 COMMENT='tabela de usuarios';

#table endereco
DROP TABLE IF EXISTS `cadin_endereco`;
CREATE TABLE IF NOT EXISTS `cadin_endereco` (
    id INT(11) UNSIGNED AUTO_INCREMENT, 
    usuario_id INT(11) NOT NULL,   
    logradouro varchar(255),
    numero varchar(255),
    complemento varchar(255),
    cidade varchar(255),
    uf_estado varchar(255),
    cep int(11),
    created DATETIME  ON UPDATE CURRENT_TIMESTAMP,
    modified DATETIME ON UPDATE CURRENT_TIMESTAMP, 
    FOREIGN KEY (usuario_id) 
        REFERENCES cadin_usuario(id)
        ON UPDATE CASCADE ON DELETE CASCADE,       
    PRIMARY KEY(id)    
)ENGINE=InnoDB AUTO_INCREMENT=1 CHARSET=utf8 COMMENT='tabela de endereco de usuarios';


DROP TABLE IF EXISTS `cadin_acesso`;
CREATE TABLE IF NOT EXISTS `cadin_financa` (
    id INT(11) UNSIGNED AUTO_INCREMENT, 
    usuario_id INT(11) NOT NULL,   
    pagina varchar(255),
    operacao varchar(255),    
    created DATETIME  ON UPDATE CURRENT_TIMESTAMP,
    modified DATETIME ON UPDATE CURRENT_TIMESTAMP, 
    FOREIGN KEY (usuario_id) 
        REFERENCES cadin_usuario(id)
        ON UPDATE CASCADE ON DELETE CASCADE,       
    PRIMARY KEY(id)    
)ENGINE=InnoDB AUTO_INCREMENT=1 CHARSET=utf8 COMMENT='tabela de acesso de usuarios';

DROP TABLE IF EXISTS `cadin_financa_tipo`;
CREATE TABLE IF NOT EXISTS `cadin_financa_tipo` (
    id INT(11) UNSIGNED AUTO_INCREMENT,   
    tipo INT(6) NOT NULL,  
    descricao varchar(255),
    created DATETIME  ON UPDATE CURRENT_TIMESTAMP,
    modified DATETIME ON UPDATE CURRENT_TIMESTAMP,       
    PRIMARY KEY(id)    
)ENGINE=InnoDB AUTO_INCREMENT=1 CHARSET=utf8 COMMENT='tabela de tipo de fincas';

DROP TABLE IF EXISTS `cadin_financa`;
CREATE TABLE IF NOT EXISTS `cadin_financa` (
    id INT(11) UNSIGNED AUTO_INCREMENT, 
    usuario_id INT(11) NOT NULL,   
    financa_tipo_id INT(11) NOT NULL,
    valor DECIMAL(9,2) NOT NULL DEFAULT 0.00,
    local varchar(255),    
    created DATETIME  ON UPDATE CURRENT_TIMESTAMP,
    modified DATETIME ON UPDATE CURRENT_TIMESTAMP, 
    FOREIGN KEY (usuario_id) 
        REFERENCES cadin_usuario(id)
        ON UPDATE CASCADE ON DELETE CASCADE,       
    PRIMARY KEY(id)    
)ENGINE=InnoDB AUTO_INCREMENT=1 CHARSET=utf8 COMMENT='tabela de financas';