<?php

namespace Src\Model\SQL;

class NOVO_SETOR_SQL{
    public static function CADASTRAR_SETOR_SQL(){
        $sql = 'INSERT INTO tb_setor(nome_setor) VALUES(?)';

        return $sql;
    }

    public static function CONSULTAR_SETOR_SQL(){
        $sql = 'SELECT id, nome_setor FROM tb_setor ORDER BY nome_setor';

        return $sql;
    }

    // public static function SELECIONAR_SETOR_SQL(){
    //     $sql = 'SELECT id, nome_setor FROM tb_setor ORDER BY nome_setor';

    //     return $sql;
    // }

    public static function ALTERAR_SETOR_SQL(){
        $sql = 'UPDATE tb_setor SET nome_setor = ?  WHERE id = ?';

        return $sql;
    }

    public static function EXCLUIR_SETOR_SQL(){

        // $sql = 'DELETE FROM tb_setor WHERE id = ?';
        // return $sql;

        return 'DELETE FROM tb_setor WHERE id = ?';
    }
}