<?php
/**
 * @Author  : Subraga Islammada <subraga.9310@students.amikom.ac.id>
 * @Date    : 12/15/17 - 1:50 AM
 */

class UserModel extends Model {

    protected $tableName = "user";

    public function rows() {

        return $this->db->getAll($this->tableName)->numRows();
    }

    public function userCheck($u) {
        $numUser = "select * from ".$this->tableName." where BINARY id = ('".$u."');";
        $this->db->query($numUser);
        return $this->db->execute()->numRows();
    }

    public function getDetails($id){
    	$detUsr = "select id, name, email, website, country, banned, verified, admin, joined from ".$this->tableName." where BINARY id = ". $id." ;";
        $this->db->query($detUsr);
        return $this->db->execute()->toObject();
    }

}
?>