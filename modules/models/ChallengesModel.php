<?php
/**
 * @Author  : Subraga Islammada <subraga.9310@students.amikom.ac.id>
 * @Date    : 12/15/17 - 1:50 AM
 */

class ChallengesModel extends Model {

    protected $tableName = "challenges";

    public function getChall() {
        $qChall = "select * from ". $this->tableName ." ORDER BY category, value ASC ;";
        $this->db->query($qChall);
        return $this->db->execute()->toObject();
    }

    public function getData($id){
    	$qData = "select id, name, description, value, category from ".$this->tableName." where id = ". $id." ;";
        $this->db->query($qData);
        return $this->db->execute()->toObject();
    }

    public function dataKeys($k){
        $qKeys = "select * from `keys` where BINARY flag = ('".$k."');";
        $this->db->query($qKeys);
        return $this->db->execute()->toObject();
    }

    public function cidCheck($w) {
        $numChall = "select * from `challenges` where BINARY id = ('".$w."');";
        $this->db->query($numChall);
        return $this->db->execute()->toObject();
    }

    public function keysCheck($q) {
        $numKeys = "select * from `keys` where BINARY flag = ('".$q."');";
        $this->db->query($numKeys);
        return $this->db->execute()->numRows();
    }

    public function rows() {
        return $this->db->getAll($this->tableName)->numRows();
    }

    public function challCheck($u) {
        $rowChall = "select * from ".$this->tableName." where BINARY id = ('".$u."');";
        $this->db->query($rowChall);
        return $this->db->execute()->numRows();
    }

}
?>



