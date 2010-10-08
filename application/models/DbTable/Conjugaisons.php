<?php
class Model_DbTable_Conjugaisons extends Zend_Db_Table_Abstract
{
    protected $_name = 'gen_conjugaisons';
	protected $_dependentTables = array('Model_DbTable_Terminaisons','Model_DbTable_Verbes');

    protected $_referenceMap    = array(
        'Dico' => array(
            'columns'           => 'id_dico',
            'refTableClass'     => 'Model_DbTable_Dicos',
            'refColumns'        => 'id_dico'
        )
    );	
	
    public function obtenirConjugaison($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id_conj = ' . $id);
        if (!$row) {
            throw new Exception("Count not find row $id");
        }
        return $row->toArray();
    }


    public function obtenirConjugaisonIdModele($idDico, $modele)
    {
		$select = $this->select();
		$select->from($this, array('id_conj'))
			->where('id_dico = ?', $idDico)
			->where('modele = ?', $modele);
		$rs = $this->fetchAll($select);        
    	if (!$rs) {
            throw new Exception("Count not find rs $id");
        }
        return $rs[0]->id_conj;
    }

    public function obtenirConjugaisonDico($idDico)
    {
		$select = $this->select();
		$select->from($this, array('id_conj','modele'))
			->where('id_dico = ?', $idDico);
	    $rs = $this->fetchAll($select);        
    	if (!$rs) {
            throw new Exception("Count not find rs $id");
        }
        return $rs->toArray();
    }

    public function obtenirConjugaisonListeModeles()
    {
		$select = $this->select();
		$select->from($this, array('id_conj','modele'))
			->order("modele");
	    $rs = $this->fetchAll($select);        
    	if (!$rs) {
            throw new Exception("Count not find rs $id");
        }
        $arr = array();
        foreach($rs as $r){
        	$arr[$r['id_conj']]=$r['modele'];	
        }
        return $arr;
    }
    
	public function existeConjugaison($idDico, $num, $modele)
    {
		$select = $this->select();
		$select->from($this, array('id_conj'))
			->where('id_dico = ?', $idDico)
			->where('modele = ?', $modele)
			->where('num = ?', $num);
	    $rows = $this->fetchAll($select);        
	    if($rows->count()>0)$id=$rows[0]->id_conj; else $id=false;
        return $id;
    }    
    
    public function ajouterConjugaison($idDico, $num, $modele)
    {
    	$id = $this->existeConjugaison($idDico, $num, $modele);
    	if(!$id){
    		$data = array(
            'id_dico' => $idDico,
            'num' => $num,
            'modele' => $modele
	        );
    	 	$id = $this->insert($data);
    	}
    	return $id;
    }
    
    public function modifierConjugaison($id, $num, $modele)
    {
        $data = array(
            'num' => $num,
            'modele' => $modele
        );
        $this->update($data, 'id_conj = '. (int)$id);
    }

    public function supprimerConjugaison($id)
    {
		$Rowset = $this->find($id);
		$parent = $Rowset->current();
		$enfants = $parent->findDependentRowset('Model_DbTable_Terminaisons');
    	$tEnfs = new Model_DbTable_Terminaisons;
		foreach($enfants as $enf){
    		$tEnfs->supprimerTerminaison($enf["id_trm"]);	
    	}
    	$this->delete('id_conj =' . (int)$id);
    }
}
