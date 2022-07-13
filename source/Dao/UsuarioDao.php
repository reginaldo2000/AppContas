<?php

namespace Source\Dao;

/**
 * Description of UsuarioDao
 *
 * @author Reginaldo
 */
class UsuarioDao extends DatabaseUtil {
   
    public function __construct() {
        parent::__construct("usuarios");
    }
    
}
