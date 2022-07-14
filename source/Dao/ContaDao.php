<?php


namespace Source\Dao;

/**
 * Description of ContaDao
 *
 * @author Reginaldo
 */
class ContaDao extends DatabaseUtil {
    
    public function __construct() {
        parent::__construct("contas");
    }

}
