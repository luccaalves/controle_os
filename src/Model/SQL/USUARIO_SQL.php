<?php

namespace Src\Model\SQL;

class USUARIO_SQL
{
    public static function VERIFICAR_EMAIL_SQL()
    {
        $sql = 'SELECT count(email_usuario) AS contar_email FROM tb_usuario WHERE email_usuario = ?;';
        return $sql;
    }

    public static function CADASTRAR_USUARIO_SQL()
    {
        $sql = 'INSERT INTO tb_usuario(tipo_usuario,nome_usuario, email_usuario, cpf_usuario, status_usuario, tel_usuario) VALUES(?, ?, ?, ?, ?, ?);';

        return $sql;
    }

    public static function CADASTRAR_FUNCIONARIO_SQL()
    {
        $sql = 'INSERT INTO tb_funcionario(usuario_id, setor_id) VALUES (?, ?);';

        return $sql;
    }

    public static function CADASTRAR_TECNICO_SQL()
    {
        $sql = 'INSERT INTO tb_tecnico(usuario_id, nome_empresa) VALUES(?, ?);';

        return $sql;
    }

    public static function CADASTRAR_ENDERECO_SQL()
    {
        $sql = 'INSERT INTO tb_endereco(rua, bairro, cep, cidade_id, usuario_id) VALUES(?, ?, ?, ?, ?);';

        return $sql;
    }

    public static function CADASTRAR_CIDADE_SQL()
    {
        $sql = 'INSERT INTO tb_cidade(nome_cidade, estado_id) VALUES(?, ?);';

        return $sql;
    }

    public static function CADASTRAR_ESTADO_SQL()
    {
        $sql = 'INSERT INTO tb_estado(sigla_estado) VALUES(?);';

        return $sql;
    }



    public static function VERIFICAR_CIDADE_CADASTRADA_SQL()
    {
        $sql = 'SELECT ci.id
                FROM tb_cidade AS ci 
                INNER JOIN tb_estado AS es 
                ON ci.estado_id = es.id
                WHERE ci.nome_cidade = ? AND es.sigla_estado = ?;';

        return $sql;
    }

    public static function VERIFICAR_ESTADO_CADASTRADO_SQL()
    {
        $sql = 'SELECT id FROM tb_estado WHERE sigla_estado = ?;';

        return $sql;
    }

    public static function DETALHAR_USUARIO_SQL()
    {
        $sql = 'SELECT usu.id,
                   usu.tipo_usuario,
                   usu.nome_usuario,
                   usu.email_usuario,
                   usu.cpf_usuario,
                   usu.tel_usuario,
                   en.rua,
                   en.bairro,
                   en.cep,
                   en.id,
                   cid.nome_cidade,
                   est.sigla_estado,
                   tec.nome_empresa,
                   fun.setor_id
            FROM tb_usuario AS usu
            INNER JOIN tb_endereco AS en
                ON usu.id = en.usuario_id
            INNER JOIN tb_cidade AS cid
                ON en.cidade_id= cid.id
            INNER JOIN tb_estado AS est
                ON cid.estado_id = est.id
            LEFT JOIN tb_tecnico AS tec
                ON usu.id = tec.usuario_id
            LEFT JOIN tb_funcionario AS fun
                ON usu.id = fun.usuario_id WHERE usu.id = ?;';

        return $sql;
    }
    public static function ALTERAR_USUARIO_SQL()
    {
        return 'UPDATE tb_usuario 
            SET nome_usuario = ?, cpf_usuario = ?, email_usuario = ?, senha_usuario = ?, tel_usuario = ? 
            WHERE id = ?;';
    }

    public static function FILTRAR_USUARIO_SQL()
    {
        $sql = 'SELECT id, nome_usuario, tipo_usuario, status_usuario FROM tb_usuario WHERE nome_usuario LIKE ?';

        return $sql;
    }

    public static function ALTERAR_STATUS_USUARIO_SQL()
    {
        $sql = 'UPDATE tb_usuario SET status_usuario = ? WHERE id = ?';

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
}
