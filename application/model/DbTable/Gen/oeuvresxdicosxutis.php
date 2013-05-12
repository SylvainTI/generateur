<?php
/**
 * Ce fichier contient la classe Gen_oeuvres_dicos_utis.
 *
 * @copyright  2013 Samuel Szoniecky
 * @license    "New" BSD License
*/
class Model_DbTable_Gen_oeuvresxdicosxutis extends Zend_Db_Table_Abstract
{
    
    /**
     * Nom de la table.
     */
    protected $_name = 'gen_oeuvres_dicos_utis';
    
    /**
     * Clef primaire de la table.
     */
    protected $_primary = 'id_odu';

    
    /**
     * Vérifie si une entrée Gen_oeuvres_dicos_utis existe.
     *
     * @param array $data
     *
     * @return integer
     */
    public function existe($data)
    {
		$select = $this->select();
		$select->from($this, array('id_odu'));
		$select->where('id_oeu = ?', $data['id_oeu']);
		$select->where('id_dico = ?', $data['id_dico']);
    	$select->where('uti_id = ?', $data['uti_id']);
	    $rows = $this->fetchAll($select);        
	    if($rows->count()>0)$id=$rows[0]->id_odu; else $id=false;
        return $id;
    } 
        
    /**
     * Ajoute une entrée Gen_oeuvres_dicos_utis.
     *
     * @param int $idOeu
     * @param int $idUti
     * @param array $data
     * @param boolean $existe
     *  
     * @return integer
     */
    public function ajouter($idOeu, $idUti, $params, $existe=true)
    {
    	
    	foreach ($params as $idDico) {
    		$id=false;
    		$data= array("id_oeu"=>$idOeu, "id_dico"=>$idDico, "uti_id"=>$idUti, 'crea' => new Zend_Db_Expr('NOW()'));
    		if($existe)$id = $this->existe($data);
    		if(!$id){
    			$id = $this->insert($data);
    		}
    	}
    	 
    	return $id;
    } 
           
    /**
     * Recherche une entrée Gen_oeuvres_dicos_utis avec la clef primaire spécifiée
     * et modifie cette entrée avec les nouvelles données.
     *
     * @param integer $id
     * @param array $data
     *
     * @return void
     */
    public function edit($id, $data)
    {        
   	
    	$this->update($data, 'gen_oeuvres_dicos_utis.id_odu = ' . $id);
    }
    
    /**
     * Recherche une entrée Gen_oeuvres_dicos_utis avec la clef primaire spécifiée
     * et supprime cette entrée.
     *
     * @param int $idOdu
     *
     * @return void
     */
    public function remove($idOdu)
    {
    	//suprime les actions liés aux dictionnaires de l'oeuvre et à l'utilisateur
    	$dbOA = new Model_DbTable_Gen_oduxacti();
    	$dbA = new Model_DbTable_flux_acti();
    	$arrActi =$dbOA->findByIdOdu($idOdu);
    	foreach ($arrActi as $acti) {
    		$dbA->remove($acti['acti_id']);
    	}
    	$arr = $dbOA->delete('id_odu='.$idOdu);    	
    	
    	//suprime le lien entre l'oeuvre et le dictionnaire
    	$this->delete('id_odu='.$idOdu);
    }

    /**
     * Recherche les entrées de Gen_oeuvres_dicos_utis avec la clef de lieu
     * et supprime ces entrées.
     *
     * @param integer $idLieu
     *
     * @return void
     */
    public function removeLieu($idLieu)
    {
		$this->delete('id_lieu = ' . $idLieu);
    }
    
    /**
     * Recherche une entrée Gen_oeuvres_dicos avec la valeur spécifiée
     * et retourne cette entrée.
     *
     * @param int $id_oeu
     *
     * @return array
     */
    public function findByIdOeu($id_oeu)
    {
        $query = $this->select()
        	->from( array("odu" => "gen_oeuvres_dicos_utis") )                           
	        ->setIntegrityCheck(false) //pour pouvoir sélectionner des colonnes dans une autre table
        ->joinInner(array('d' => 'gen_dicos'),
        		'd.id_dico = odu.id_dico')
        ->where( "odu.id_oeu = ?", $id_oeu )
        ->group("d.id_dico")
    	->order("d.type");
        
        return $this->fetchAll($query)->toArray(); 
    }

    /**
     * Recherche une entrée Gen_oeuvres_dicos_utis avec la valeur spécifiée
     * et retourne cette entrée.
     *
     * @param int $id_dico
     *
     * @return array
     */
    public function findById_dico($id_dico)
    {
        $query = $this->select()
                    ->from( array("g" => "gen_oeuvres_dicos_utis") )                           
                    ->where( "g.id_dico = ?", $id_dico );

        return $this->fetchAll($query)->toArray(); 
    }
    	/**
     * Recherche une entrée Gen_oeuvres_dicos_utis avec la valeur spécifiée
     * et retourne cette entrée.
     *
     * @param int $id_odu
     *
     * @return array
     */
    public function findById_odu($id_odu)
    {
        $query = $this->select()
                    ->from( array("g" => "gen_oeuvres_dicos_utis") )                           
                    ->where( "g.id_odu = ?", $id_odu );

        return $this->fetchAll($query)->toArray(); 
    }
    	/**
     * Recherche une entrée Gen_oeuvres_dicos_utis avec la valeur spécifiée
     * et retourne cette entrée.
     *
     * @param int $uti_id
     *
     * @return array
     */
    public function findByUti_id($uti_id)
    {
        $query = $this->select()
                    ->from( array("g" => "gen_oeuvres_dicos_utis") )                           
                    ->where( "g.uti_id = ?", $uti_id );

        return $this->fetchAll($query)->toArray(); 
    }
    
    
}