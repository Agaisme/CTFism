<?php
/**
 * @Author  : Subraga Islammada <subraga.9310@students.amikom.ac.id>
 * @Date    : 12/15/17 - 1:50 AM
 */

class SolvesModel extends Model {

    protected $tableName = "solves";

    public function solvesCheck($c, $u, $f) {
        $numSolves = "select * from ".$this->tableName." where BINARY (chall_id = ('".$c."') AND uid = ('".$u."') AND flag = ('".$f."'));";
        $this->db->query($numSolves);
        return $this->db->execute()->numRows();
    }

    public function getSolves() {
        $qSolves = "select c.value, s.chall_id, u.name, s.date from ".$this->tableName." AS s 
                        JOIN challenges AS c 
                        ON c.id = s.chall_id 
                        JOIN user AS u 
                        ON u.id = s.uid";

        $this->db->query($qSolves);

        return $this->db->execute()->toObject();
    }

    public function rows() {

        return $this->db->getAll($this->tableName)->numRows();
    }

}
?>