<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Model{
    protected $_db;
    
    public function __construct() {
        $this->_db = new Database();
    }
}
?>
