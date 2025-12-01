<?php

namespace Src\Model\SQL;

class NOVO_EQUIPAMENTO_SQL{
    public static function CADASTRAR_EQUIPAMENTO_SQL(){
        $sql =  'INSERT INTO tb_equipamento(identificacao, descricao, situacao, tipo_id, modelo_id) VALUES(?, ?, ?, ?, ?)';

        return $sql;
    }

    public static function FILTRAR_EQUIPAMENTO_SQL($id_tipo, $id_modelo){
        $sql = 'SELECT eqp.id as id_equipamento, 
                                identificacao, 
                                descricao, 
                                situacao, 
                                nome_tipo, 
                                nome_modelo, 
                                data_descarte, 
                                motivo_descarte, 
                            (SELECT count(*) FROM tb_alocar AS al WHERE al.equipamento_id = eqp.id AND al.situacao != ?) AS estado_alocado 
                                FROM tb_equipamento AS eqp 
                                    INNER JOIN tb_tipo as tp 
                                ON eqp.tipo_id = tp.id 
                                    INNER JOIN tb_modelo as mdl 
                                ON eqp.modelo_id = mdl.id';

        $condicao = '';

        if ($id_tipo != ''){
            $condicao = ' WHERE eqp.tipo_id = ?';
        }

        if ($id_modelo != ''){
            $condicao .= (!empty($condicao) ? ' AND ' : ' WHERE ') . 'eqp.modelo_id = ?';
        }

        $sql .= $condicao;

        return $sql;
    }

    public static function SELECIONAR_EQUIPAMENTO_SQL(){
        $sql = 'SELECT eq.id AS equipamento_id,
                       eq.identificacao,
                       ti.nome_tipo,
                       mo.nome_modelo
                    FROM tb_equipamento AS eq
                INNER JOIN tb_tipo AS ti 
                    ON eq.tipo_id = ti.id
                INNER JOIN tb_modelo AS mo
                    ON eq.modelo_id = mo.id
                WHERE eq.situacao = ? AND eq.id
                    NOT IN (SELECT equipamento_id FROM tb_alocar WHERE situacao != ?)';

        return $sql;
    }

    public static function DETALHAR_EQUIPAMENTO_SQL(){
        $sql = 'SELECT id, identificacao, descricao, situacao, tipo_id, modelo_id FROM tb_equipamento WHERE id = ?';

        return $sql;
    }

    public static function ALTERAR_EQUIPAMENTO_SQL(){
        $sql = 'UPDATE tb_equipamento SET identificacao = ?, descricao = ?, tipo_id = ?, modelo_id = ? WHERE id = ?;';

        return $sql;
    }

    public static function EXCLUIR_EQUIPAMENTO_SQL(){
        $sql = 'DELETE FROM tb_equipamento WHERE id = ?;';

        return $sql;
    }

    public static function DESCARTE_EQUIPAMENTO_SQL(){
        $sql = 'UPDATE tb_equipamento SET data_descarte = ?, motivo_descarte = ?, situacao = ? WHERE id = ?';

        return $sql;
    }

    public static function ALOCAR_EQUIPAMENTO_SQL(){
        $sql = 'INSERT INTO tb_alocar(data_alocar, situacao, equipamento_id, setor_id) VALUES (?, ?, ?, ?)';

        return $sql;
    }

    public static function EQUIPAMENTOS_ALOCADO_SETOR_SQL(){
        $sql = 'SELECT eq.id AS equipamento_id,
                       eq.identificacao,
                       ti.nome_tipo,
                       mo.nome_modelo,
                       al.id AS alocar_id,
                       al.data_alocar
                    FROM tb_equipamento AS eq
                INNER JOIN tb_tipo AS ti
                    ON eq.tipo_id= ti.id
                INNER JOIN tb_modelo AS mo
                    ON eq.modelo_id = mo.id
                INNER JOIN tb_alocar AS al 
                    ON al.equipamento_id = eq.id
                WHERE al.setor_id = ? AND al.data_remocao IS NULL AND al.situacao = ?;';
        return $sql;
    }

    public static function REMOVER_EQUIPAMENTO_SETOR_SQL(){
        $sql = 'UPDATE tb_alocar SET data_remocao = ?, situacao = ? WHERE id = ?;';

        return $sql;
    }
}
