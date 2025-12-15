<?php

namespace Src\Model\SQL;

class CHAMADO_SQL
{
    public static function ABRIR_CHAMADO_SQL(): string
    {
        $sql = 'INSERT INTO tb_chamado 
                    (data_abertura, 
                    hora_abertura, 
                    problema, 
                    funcionario_id, 
                    alocar_id)
                VALUES
                    (?,?,?,?,?)';
        return $sql;
    }
    public static function ATUALIZAR_ALOCAMENTO_SQL()
    {
        $sql = 'UPDATE
                    tb_alocar
                SET
                    situacao = ? 
                WHERE
                    id = ?';
        return $sql;
    }
    public static function FILTRAR_CHAMADO_SQL($situacao, $setor)
    {
        $sql = 'SELECT
                    chamado.id as chamado_id,
                    tipo.nome_tipo,
                    modelo.nome_modelo,
                    equip.identificacao,
                    date_format(chamado.data_abertura, "%d/%m/Y") as data_abertura,
                    chamado.hora_abertura,
                    chamado.problema,
                    date_format(chamado.data_atendimento, "%d/%m/Y") as data_atendimento,
                    chamado.hora_atendimento,
                    date_format(chamado.data_encerramento,"%d/%m/Y") as data_encerramento,
                    chamado.hora_encerramento,
                    chamado.laudo,
                    chamado.alocar_id,
                    usuario_tec_atend.nome_usuario as tecnico_atendimento,
                    usuario_tec_final.nome_usuario as tecnico_finalizado,
                    usuario_func.nome_usuario as funcionario
                FROM
                    tb_chamado as chamado
                INNER JOIN 
                    tb_funcionario as func ON chamado.funcionario_id = func.usuario_id
                INNER JOIN 
                    tb_usuario as usuario_func ON func.usuario_id = usuario_func.id
                INNER JOIN 
                    tb_alocar as alo ON chamado.alocar_id = alo.id
                INNER JOIN 
                    tb_equipamento as equip ON alo.equipamento_id = equip.id
                INNER JOIN 
                    tb_tipo as tipo ON equip.tipo_id = tipo.id
                INNER JOIN 
                    tb_modelo as modelo ON equip.modelo_id = modelo.id
                LEFT JOIN 
                    tb_tecnico as tec_atend ON chamado.tecnico_atendimento = tec_atend.usuario_id
                LEFT JOIN 
                    tb_usuario as usuario_tec_atend ON tec_atend.usuario_id = usuario_tec_atend.id
                LEFT JOIN 
                    tb_tecnico as tec_finaliza ON chamado.tecnico_encerramento = tec_finaliza.usuario_id
                LEFT JOIN 
                    tb_usuario as usuario_tec_final ON tec_finaliza.usuario_id = usuario_tec_final.id ';

        switch ($situacao) {
            case SITUACAO_CHAMADO_AGUARDANDO_ATENDIMENTO:
                $sql .= 'WHERE chamado.tecnico_atendimento is NULL ' . ($setor ? 'AND alo.setor_id = ?' : '');
                break;
            case SITUACAO_CHAMADO_EM_ATENDIMENTO:
                $sql .= 'WHERE chamado.tecnico_atendimento is NOT NULL AND chamado. tecnico_encerramento IS NULL ' . ($setor ? 'AND alo.setor_id = ?' : '');
                break;
            case SITUACAO_CHAMADO_FINALIZADO:
                $sql .= 'WHERE chamado.tecnico_encerramento is NOT NULL ' . ($setor ? 'AND alo.setor_id = ?' : '');
                break;
            default:
                $sql .= ($setor ? 'WHERE alo.setor_id = ? ' : '');
                break;
        }
        return $sql;
    }
    public static function DETALHAR_CHAMADO_SQL()
    {
        $sql = 'SELECT
                    tipo.nome_tipo,
                    modelo.nome_modelo,
                    equip.identificacao,
                    date_format(chamado.data_abertura, "%d/%m/%Y") as data_abertura,
                    chamado.hora_abertura,
                    chamado.problema,
                    date_format(chamado.data_atendimento, "%d/%m/%Y") as data_atendimento,
                    chamado.hora_atendimento,
                    date_format(chamado.data_encerramento,"%d/%m/%Y") as data_encerramento,
                    chamado.hora_encerramento,
                    chamado.laudo,
                    chamado.alocar_id,
                    chamado.id as id_chamado,
                    usuario_tec_atend.nome_usuario as tecnico_atendimento,
                    usuario_tec_final.nome_usuario as tecnico_finalizado,
                    usuario_func.nome_usuario as funcionario
                FROM
                    tb_chamado as chamado
                INNER JOIN 
                    tb_funcionario as func ON chamado.funcionario_id = func.usuario_id
                INNER JOIN 
                    tb_usuario as usuario_func ON func.usuario_id = usuario_func.id
                INNER JOIN 
                    tb_alocar as alo ON chamado.alocar_id = alo.id
                INNER JOIN 
                    tb_equipamento as equip ON alo.equipamento_id = equip.id
                INNER JOIN 
                    tb_tipo as tipo ON equip.tipo_id = tipo.id
                INNER JOIN 
                    tb_modelo as modelo ON equip.modelo_id = modelo.id
                LEFT JOIN 
                    tb_tecnico as tec_atend ON chamado.tecnico_atendimento = tec_atend.usuario_id
                LEFT JOIN 
                    tb_usuario as usuario_tec_atend ON tec_atend.usuario_id = usuario_tec_atend.id
                LEFT JOIN 
                    tb_tecnico as tec_finaliza ON chamado.tecnico_encerramento = tec_finaliza.usuario_id
                LEFT JOIN 
                    tb_usuario as usuario_tec_final ON tec_finaliza.usuario_id = usuario_tec_final.id 
                WHERE chamado.id = ?';
        return $sql;
    }
    public static function ATENDER_CHAMADO_SQL(): string {
        $sql = 'UPDATE tb_chamado
                    SET data_atendimento = ?,
                        hora_atendimento = ?,
                        tecnico_atendimento = ?
                    WHERE id = ?';

        return $sql;
    } 

    public static function FINALIZAR_CHAMADO_SQL(): string {
         $sql = 'UPDATE tb_chamado
                    SET data_encerramento = ?,
                        hora_encerramento = ?,
                        laudo = ?,
                        tecnico_encerramento = ?
                    WHERE id = ?';

        return $sql;
    }
    public static function NUMEROS_CHAMADOS_ATUAIS_SQL(){
        $sql = 'SELECT
                (SELECT COUNT(id) FROM tb_chamado WHERE tecnico_atendimento IS NULL) as qtd_aguardando,
                (SELECT COUNT(id) FROM tb_chamado WHERE tecnico_atendimento IS NOT NULL AND tecnico_encerramento IS NULL) as qtd_em_atendimento,
                (SELECT COUNT(id) FROM tb_chamado WHERE tecnico_encerramento IS NOT NULL) as qtd_encerrado';
        return $sql;
    }
}
