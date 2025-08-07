<?php 

namespace Src\Model\SQL;

class MODELO_EQUIPAMENTO_SQL{
    public static function CADASTRAR_MODELO_EQUIPAMENTO_SQL(){
        $sql = 'INSERT INTO tb_modelo (nome_modelo) VALUES(?)';
        
        return $sql;
    } 

    public static function CONSULTAR_MODELO_EQUIPAMENTO_SQL(){
        $sql = 'SELECT id, nome_modelo FROM tb_modelo ORDER BY nome_modelo';

        return $sql;
    }

    public static function ALTERAR_MODELO_EQUIPAMENTO_SQL(){
        $sql = 'UPDATE tb_modelo SET nome_modelo = ? WHERE id = ?';

        return $sql;
    }

    public static function EXCLUIR_MODELO_EQUIPAMENTO_SQL(){

        // $sql = 'DELETE FROM tb_modelo WHERE id = ?';
        // return $sql;

        return 'DELETE FROM tb_modelo WHERE id = ?';
    }
}