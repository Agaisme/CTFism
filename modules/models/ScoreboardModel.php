<?php
/**
 * @Author  : Subraga Islammada <subraga.9310@students.amikom.ac.id>
 * @Date    : 12/15/17 - 1:50 AM
 */

class ScoreboardModel extends Model{

    protected $tableName = "user";

    public function listRank() {
        $queryList = "select  u.name, 
                        u.country, 
                        u.banned, 
                        s.date, 
                        SUM(c.value) AS score
         from ". $this->tableName ." AS u 
                        INNER JOIN solves AS s 
                        ON s.uid = u.id 
                        INNER JOIN challenges AS c 
                        ON c.id = s.chall_id
        GROUP  BY u.name";
        $this->db->query($queryList);
        return $this->db->execute()->toObject();
    }

    public function getScoreU($id){
        $query = "select SUM(c.value) AS score
                    from ". $this->tableName ." AS u 
                        INNER JOIN solves AS s 
                        ON s.uid = u.id 
                        INNER JOIN challenges AS c 
                        ON c.id = s.chall_id
                    WHERE u.id = ".$id;
        $this->db->query($query);
        return $this->db->execute()->toObject();
    }


}
?>