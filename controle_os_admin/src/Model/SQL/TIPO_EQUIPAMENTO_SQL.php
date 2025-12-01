<?php

namespace Src\Model\SQL;

class TIPO_EQUIPAMENTO_SQL{
    public static function CADASTRAR_TIPO_EQUIPAMENTO_SQL(){
        $sql = 'INSERT INTO tb_tipo(nome_tipo) VALUES(?)';

        return $sql;
    }

    public static function CONSULTAR_TIPO_EQUIPAMENTO_SQL(){
        $sql = 'SELECT id, nome_tipo FROM tb_tipo ORDER BY nome_tipo';

        return $sql;
    }

    public static function ALTERAR_TIPO_EQUIPAMENTO_SQL(){
        $sql = 'UPDATE tb_tipo SET nome_tipo = ? WHERE id = ?';

        return $sql;
    }

    public static function EXCLUIR_TIPO_EQUIPAMENTO_SQL(){

        // $sql = 'DELETE FROM tb_setor WHERE id = ?';
        // return $sql;

        return 'DELETE FROM tb_tipo WHERE id = ?';
    }
}