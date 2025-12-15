<?php

namespace Src\Model\SQL;

class USUARIO_SQL
{
    public static function VALIDAR_LOGIN_SQL()
    {
        $sql = 'SELECT 
                    us.id, 
                    us.nome_usuario, 
                    us.senha_usuario,
                    fu.setor_id,
                    nome_empresa
                FROM
                    tb_usuario us
                LEFT JOIN  
                    tb_funcionario fu ON us.id = fu.usuario_id
                LEFT JOIN
                    tb_tecnico te ON us.id = te.usuario_id 
                WHERE
                    cpf_usuario = ?
                AND status_usuario = ?';

        return $sql;
    }
    public static function VERIFICAR_EMAIL_SQL()
    {
        $sql = 'SELECT count(email_usuario) AS contar_email FROM tb_usuario WHERE email_usuario = ?;';

        return $sql;
    }
    // Cadastrar dados na Tabela Usuário!
    public static function CADASTRAR_USUARIO_SQL(): string
    {
        $sql = 'INSERT INTO tb_usuario (nome_usuario, tipo_usuario, email_usuario, cpf_usuario, senha_usuario, status_usuario, tel_usuario)VALUES(?,?,?,?,?,?,?)';

        return $sql;
    }
    // Cadastrar dados na Tabela  Funcionário!
    public static function CADASTRAR_FUNCIONARIO_SQL()
    {
        $sql = 'INSERT INTO tb_funcionario(usuario_id, setor_id) VALUES(?, ?);';

        return $sql;
    }
    // Cadastrar dados na Tabela Técnico!
    public static function CADASTRAR_TECNICO_SQL()
    {
        $sql = 'INSERT INTO tb_tecnico(usuario_id, nome_empresa) VALUES(?, ?);';

        return $sql;
    }
    // Cadastrar dados na Tabela Endereço!
    public static function CADASTRAR_ENDERECO_SQL()
    {
        $sql = 'INSERT INTO tb_endereco(rua, bairro, cep, cidade_id, usuario_id) VALUES(?, ?, ?, ?, ?);';

        return $sql;
    }
    // Cadastrar dados na Tabela Cidade!
    public static function CADASTRAR_CIDADE_SQL()
    {
        $sql = 'INSERT INTO tb_cidade(nome_cidade, estado_id) VALUES(?, ?);';

        return $sql;
    }
    // Cadastrar dados na Tabela Estado!
    public static function CADASTRAR_ESTADO_SQL()
    {
        $sql = 'INSERT INTO tb_estado(sigla_estado) VALUES(?);';

        return $sql;
    }
    // Verifica se os dados foram preenchidos corretamente de acordo a regra da Tabela Endereço!
    public static function VERIFICAR_CIDADE_CADASTRADA_SQL()
    {
        $sql = 'SELECT ci.id
                        FROM tb_cidade AS ci
                    INNER JOIN tb_estado AS es
                        ON ci.estado_id = es.id
                    Where ci.nome_cidade = ? AND es.sigla_estado = ?;';

        return $sql;
    }
    public static function VERIFICAR_ESTADO_CADASTRADO_SQL()
    {
        $sql = 'SELECT id FROM tb_estado WHERE sigla_estado = ?;';

        return $sql;
    }
    public static function FILTRAR_USUARIO_SQL()
    {
        $sql = 'SELECT id, nome_usuario, tipo_usuario, status_usuario FROM tb_usuario WHERE nome_usuario LIKE ?';

        return $sql;
    }
    public static function ALTERAR_STATUS_USUARIO_SQL()
    {
        $sql = 'UPDATE tb_usuario SET status_usuario = ? WHERE id = ?;';

        return $sql;
    }
    public static function DETALHAR_USUARIO_SQL()
    {
        $sql = 'SELECT usu.id as id_usuario,
                        usu.nome_usuario,
                        usu.tipo_usuario,
                        usu.cpf_usuario,
                        usu.tel_usuario,
                        usu.email_usuario,
                        tec.nome_empresa,
                        fun.setor_id,
                        se.nome_setor,
                        en.rua,
                        en.bairro,
                        en.cep,
                        cid.id AS id_cidade,
                        cid.nome_cidade,
                        est.sigla_estado,
                        en.id as cod_endereco
                    FROM tb_usuario AS usu
                INNER JOIN tb_endereco AS en
                    ON usu.id = en.usuario_id
                INNER JOIN tb_cidade AS cid
                    ON en.cidade_id = cid.id
                INNER JOIN tb_estado AS est
                    ON cid.estado_id = est.id
                LEFT JOIN tb_tecnico AS tec
                    ON usu.id = tec.usuario_id
                LEFT JOIN tb_funcionario AS fun
                    ON usu.id = fun.usuario_id 
                LEFT JOIN tb_setor as se
                    ON se.id = fun.setor_id
                WHERE usu.id = ?;';

        return $sql;
    }
    public static function ALTERAR_USUARIO_SQL(): string
    {
        $sql = 'UPDATE 
                    tb_usuario as usu
                SET 
                    nome_usuario = ?,
                    email_usuario = ?,
                    cpf_usuario = ?,
                    senha_usuario = ?,
                    tel_usuario = ?
                WHERE 
                    usu.id = ?';

        return $sql;
    }

    public static function ALTERAR_FUNCIONARIO_SQL()
    {
        $sql = 'UPDATE tb_funcionario SET setor_id = ? WHERE usuario_id = ?;';
        return $sql;
    }
    public static function ALTERAR_TECNICO_SQL()
    {
        $sql = 'UPDATE tb_tecnico SET nome_empresa = ? WHERE usuario_id = ?;';

        return $sql;
    }
    public static function ALTERAR_ENDERECO_SQL()
    {
        $sql = 'UPDATE tb_endereco SET rua = ?, bairro = ?, cep = ?, cidade_id = ? WHERE id = ?;';

        return $sql;
    }
    public static function REGISTRAR_LOG_ACESSO()
    {
        $sql = 'INSERT INTO tb_log (data, usuario_id) VALUES (?, ?)';

        return $sql;
    }
    public static function ALTERAR_SENHA_SQL()
    {
        $sql = 'UPDATE tb_usuario 
                SET senha_usuario = ?
                WHERE id = ?';
        return $sql;
    }
    public static function BUSCAR_SENHA()
    {
        $sql = 'SELECT senha_usuario
                FROM tb_usuario
                WHERE id = ? ';
        return $sql;
    }
    public static function BUSCAR_CPF()
    {
        $sql = 'SELECT count(cpf_usuario) as contar
                FROM tb_usuario
                WHERE cpf_usuario = ?';

        return $sql;
    }
}
