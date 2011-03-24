<?php
/**
 * Generateur Framework
 *
 * LICENSE
 *
 * This source file is subject to the Artistic/GPL license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.generateur.com/license/
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@generateur.com so we can send you a copy immediately.
 *
 * @category   Generateur
 * @package    Moteur
 * @copyright  Copyright (c) 2010 J-P Balpe (http://www.balpe.com)
 * @license    http://framework.generateur.com/license/Artistic/GPL License
 * @version    $Id: Moteur.php 0 2010-09-20 15:26:09Z samszo $
 */

/**
 * Concrete class for generating Fragment for Generateur.
 *
 * @category   Generateur
 * @package    Moteur
 * @copyright  Copyright (c) 2010 J-P Balpe (http://www.balpe.com)
 * @license    http://framework.generateur.com/license/Artistic/GPL License
 */

class Gen_Moteur
{

	var $xmlDesc;
	var $texte;
	var $class;
	var $arrSegment;
	var $arrClass;
	var $arrDicos;
	var $ordre;
	var $segment;
	var $potentiel=0;
	var $detail;
	var $typeChoix = "alea";
	var $cache;
	var $forceCalcul;
	
	/**
	 * Le constructeur initialise le moteur.
	 * 	 */
	public function __construct($urlDesc="", $forceCalcul = false) {

		if($urlDesc=="")$urlDesc=APPLICATION_PATH.'/configs/LangageDescripteur.xml';
		$this->xmlDesc = simplexml_load_file($urlDesc);	
		$this->forceCalcul = $forceCalcul;	
	}

	private function setCache(){
		$frontendOptions = array(
	    	'lifetime' => 31536000, //  temps de vie du cache de 1 an
	        'automatic_serialization' => true
		);
	   	$backendOptions = array(
			// Répertoire où stocker les fichiers de cache
	   		'cache_dir' => ROOT_PATH.'/tmp/'
		);
		// créer un objet Zend_Cache_Core
		$this->cache = Zend_Cache::factory('Core','File',$frontendOptions,$backendOptions);				
	}
	
	public function Generation($texte, $getTexte=true, $cache=false){
		
		if(!$cache){
			$this->setCache();
		}else{
			$this->cache = $cache;		
		}
		
		$this->arrClass = array();
		$this->ordre = 0;
		$this->segment = 0;
		//$this->arrClass[$this->ordre]["generation"][] = $texte;
		
		//parcourt l'ensemble de la chaine
		for($i = 0; $i < strlen($texte); $i++)
        {
        	$c = $texte[$i];
        	if($c == "["){
        		//c'est le début d'une classe
        		//on récupère la valeur de la classe et la position des caractères dans la chaine
        		$i = $this->traiteClass($texte, $i);
        	}elseif($c == "="){
        		//c'est le début d'une notification de format
        		$i = $this->traiteFormat($texte, $i);
        	}elseif($c == "F"){
        		if($texte[$i+1]=="F"){
	        		//c'est la fin du segment
			        $this->arrSegment[$this->segment]["ordreFin"]= $this->ordre;
					$this->segment ++;
	        		$i++;
	        	}else{
	        		//on ajoute le caractère
					$this->arrClass[$this->ordre]["texte"] = $c;
	        	}
        	}else{
        		//on ajoute le caractère
				$this->arrClass[$this->ordre]["texte"] = $c;
        	}
        	$this->ordre ++;
        }
                
        //on calcule le texte
        if($getTexte){
        	$this->genereTexte();
        }

	}

	public function Verification($texte, $getTexte=true, $cache=false){
		
		$this->setCache();
						
		$this->ordre = 0;
		$this->typeChoix = "tout";
		//parcourt l'ensemble de la chaine
		for($i = 0; $i < strlen($texte); $i++)
        {
        	$c = $texte[$i];
        	if($c == "["){
        		//c'est le début d'une classe
        		//on récupère la valeur de la classe et la position des caractères dans la chaine
        		$i = $this->traiteClass($texte, $i);
				$this->ordre ++;
        	}
        }                

		$this->detail = $this->arrayVersHTML($this->arrClass);
        
	}
	
	public function genereTexte(){

		$this->texte = "";
		$txtCondi = true;
		$imbCondi= false;
		
		//vérifie la présence de segments
		if(count($this->arrSegment)>0){
			//choix aleatoire d'un segment
			mt_srand($this->make_seed());
	        $a = mt_rand(0, count($this->arrSegment)-1);        
			$ordreDeb = $this->arrSegment[$a]["ordreDeb"];
			$ordreFin = $this->arrSegment[$a]["ordreFin"];
		}else{
			$ordreDeb = 0;
			$ordreFin = count($this->arrClass)-1;
		}
		
		for ($i = $ordreDeb; $i <= $ordreFin; $i++) {
			$this->ordre = $i;
			$texte = "";
			if($arr = $this->arrClass[$i]){
				if(isset($arr["texte"])){
					//vérifie le texte conditionnel
					if($arr["texte"]=="<"){
				        //choisi s'il faut afficher
				        $this->potentiel ++;
						mt_srand($this->make_seed());
				        $a = mt_rand(0, 1000);        
				        if($a>500){
				        	$txtCondi = false;
					        //vérifie si le texte conditionnel est imbriqué
					        //pour sauter à la fin de la condition
					        if(isset($this->arrClass[$i+2]["texte"]) && $this->arrClass[$i+2]["texte"]=="|"){
					        	for ($j = $this->ordre; $j <= $ordreFin; $j++) {
					        		if(isset($this->arrClass[$j]["texte"]) 
					        			&& isset($this->arrClass[$j+1]["texte"])
					        			&& isset($this->arrClass[$j+2]["texte"])){
						        		if($this->arrClass[$j]["texte"]=="|" 
						        			&& $this->arrClass[$j+1]["texte"]==$this->arrClass[$i+1]["texte"]
						        			&& $this->arrClass[$j+2]["texte"]==">"){
						        			$i=$j+2;
						        			$j=$ordreFin;		
						        		}
					        		}else{
					        			$j += 2;
					        		}
					        	}
					        }				        	
				        }else{
					        //vérifie si le texte conditionnel est imbriqué
					        //attention pas plus de 10 imbrications
					        if(isset($this->arrClass[$this->ordre+2]["texte"]) && $this->arrClass[$this->ordre+2]["texte"]=="|"){
					        	$imbCondi[$this->arrClass[$this->ordre+1]["texte"]] = true;
					        	$i+=2;
					        }
				        }
					}elseif($arr["texte"]==">"){
				        //vérifie les conditionnels imbriqué
				        if($imbCondi){
				        	if(isset($imbCondi[$this->arrClass[$this->ordre-1]["texte"]])){
					        	$txtCondi = true;
					        	if(substr($this->texte,$this->ordre-1,1)=="|"){
						        	$this->texte = substr($this->texte,0,-2);
					        	}
					        	//supprime la condition imbriquée
					        	unset($imbCondi[$this->arrClass[$this->ordre-1]["texte"]]);
					        }else{
					        	//cas des conditions dans condition imbriquée
								$txtCondi = true;					        	
					        }
				        }else{
							$txtCondi = true;
				        }
					}elseif($txtCondi){
						if($arr["texte"]=="%"){
							$texte .= "<br/>";	
						}else{
							$texte .= $arr["texte"];
						}
					}
				}else{
					if($txtCondi){
						$det = "";
						$sub = "";
						$adjs = "";
						$verbe = "";
						 
						if(isset($arr["determinant"])){
							$det = $this->genereDeterminant($arr);					
						}
						
						if(isset($arr["substantif"])){					
							$sub = $this->genereSubstantif($arr);
						}					
						
						if(isset($arr["adjectifs"])){					
							foreach($arr["adjectifs"] as $adj){
								$adjs .= $this->genereAdjectif($arr, $adj);
							}
						}
		
						if(isset($arr["verbe"])){					
							$verbe = $this->genereVerbe($arr);
						}					
						
						if(isset($arr["syntagme"])){					
							$texte .= $arr["syntagme"];
						}					
											
						$texte .= $det.$sub.$adjs.$verbe;
					}					
				}
				if($texte!=""){
					$this->arrClass[$i]["texte"] = $texte;
					$this->texte .= $texte;
				}
			}
		}
		//mise en forme du texte
		$LT = strlen($this->texte);
		//mise en forme poésie
		
		//création du tableau de génération
		$this->detail = "ordreDeb=$ordreDeb ordreFin=$ordreFin<br/>".$this->arrayVersHTML($this->arrClass);
		
		
	}
	
	public function genereSubstantif($arr){

		$txt = $arr["substantif"]["s"];
		$vecteur = $this->getVecteur("pluriel",-1);
		if($vecteur["pluriel"]){												
			$txt = $arr["substantif"]["p"];
		}
		
		$txt = $arr["substantif"]["prefix"].$txt;
				
		return $txt;
	}
	
	public function generePronom($arr){
		
		//vérifie la présence d'un d&terminant
		if(!isset($arr["determinant_verbe"])){
			//vérifie la présence d'un verbe théorique
			$verbeTheo = false;
			for ($i = $this->ordre; $i >= 0; $i--) {
				if($this->arrClass[$i]["class"][1]=="v_théorique"){
					$arr["determinant_verbe"] = $this->arrClass[$i]["determinant_verbe"];
					$verbeTheo = true;
					//calcul le pronom
					$arr = $this->generePronom($arr);
					$i=-1;						
				}
			}
			if(!$verbeTheo){
				//3eme personne sans pronom
				$arr["prosuj"] = "";
				$arr["terminaison"] = 3;
			}
		}else{
			if($arr["determinant_verbe"][6]!=0){
				//pronom indéfinie
				$arr["prosuj"] = $this->getPronom($arr["determinant_verbe"][6],"sujet_indefini");
				$arr["terminaison"] = 3;
			}else{
				//pronom sujet			
				if($arr["determinant_verbe"][2]==0){
					//pas de pronom
					$arr["prosuj"] = "";
					$arr["terminaison"] = 3;				
				}else{
					//pronom définie
					$numP = $arr["determinant_verbe"][2];
					$pr = "";
					//définition des terminaisons et du pluriel
					if($numP==6){
						//il/elle singulier
						$pr = "[a_il]";
						$pluriel = false;
						$arr["terminaison"] = 3;				
					}	
					if($numP==7){
						//il/elle pluriel
						$pr = "[a_il]";
						$pluriel = true;
						$arr["terminaison"] = 6;				
					}	
					if($numP==8){
						//pas de pronom singulier
						$pr = "[a_zéro]";
						$pluriel = false;
						$arr["terminaison"] = 3;				
					}	
					if($numP==9){
						//pas de pronom pluriel
						$pr = "[a_zéro]";
						$pluriel = true;
						$arr["terminaison"] = 6;				
					}
					if($numP==1 || $numP==2){
						$pluriel = false;
						$arr["terminaison"] = $numP;				
					}
					if($numP==4 || $numP==5){
						$pluriel = true;
						$arr["terminaison"] = $numP;				
					}
					
					if($numP>=6){	
						//calcul le vecteur
						//nombre d’informations sur le vecteur - valeur indiquée + 1
						$numSub = count($this->arrClass["vecteur"])-$arr["determinant_verbe"][7]+1;
						//récupère le genre
						$genre = $this->arrClass["vecteur"][$numSub]["genre"];     	
						//génère le pronom
						$m = new Gen_Moteur();
						$m->arrDicos = $this->arrDicos;
						$m->Generation($pr,false,$this->cache);
						$m->arrClass[1]["genre"]=$genre;
						$m->arrClass[1]["pluriel"]=$pluriel;						
						$this->potentiel += $m->potentiel;						
						$arr["prosuj"] = $m->genereTexte();
					}else{
						$arr["prosuj"] = $this->getPronom($numP,"sujet");
					}
				}
			}
			//pronom complément
			if($arr["determinant_verbe"][3]!=0 && $arr["determinant_verbe"][4]!=0){
				$numPC = $arr["determinant_verbe"][3].$arr["determinant_verbe"][4];
				$arr["prodem"] = $this->getPronom($numPC,"complément");
			}			
		}		
		return $arr;
	}
	
	public function genereDeterminant($arr){

		$det = "";
		if($vecteur = $this->getVecteur("elision", 1)){			
			//calcul le déterminant
			if($vecteur["elision"]==0 && $vecteur["genre"]==1){
				$det = $arr["determinant"][0]["lib"]." ";
			}
			if($vecteur["elision"]==0 && $vecteur["genre"]==2){
				$det = $arr["determinant"][1]["lib"]." ";
			}
			if($vecteur["elision"]==1 && $vecteur["genre"]==1){
				$det = $arr["determinant"][2]["lib"];
			}
			if($vecteur["elision"]==1 && $vecteur["genre"]==2){
				$det = $arr["determinant"][3]["lib"];
			}
		}
		
		return $det;
	}
	
	public function getVecteur($type,$dir){
		
		$vecteur = false;
		if($dir>0){
			for ($i = $this->ordre; $i < count($this->arrClass); $i++) {
				if(isset($this->arrClass[$i]["vecteur"][$type])){
					return $this->arrClass[$i]["vecteur"];						
				}
			}
		}
		if($dir<0){
			for ($i = $this->ordre; $i >= 0; $i--) {
				if(isset($this->arrClass[$i]["vecteur"][$type])){
					return $this->arrClass[$i]["vecteur"];						
				}
			}
		}
		return $vecteur;
	}
	
	public function genereAdjectif($arr,$adj){

		$txt = "";

		//calcul le nombre
		$n = "_s"; 		
		if($arr["pluriel"]){												
			$n = "_p";
		}
		
		//calcul le genre
		$g = "m"; 		
		if(isset($arr["genre"])){												
			if($arr["genre"]==2) $g = "f";
		}

		$txt = $adj["prefix"].$adj[$g.$n];

		return $txt;
	}

	public function genereTerminaison($arr){
		
		//par défaut la terminaison est 3eme personne du présent
		$num = 2;
		
		if(isset($arr["determinant_verbe"])){
			$temps= $arr["determinant_verbe"][1];
			
			if($arr["determinant_verbe"][1]==1){
				$temps= 0;
			}
			if($arr["determinant_verbe"][1]==7){
				$temps= 0;
			}
			
			$num = ($temps*6)+$arr["terminaison"]-1; 		
			if($arr["determinant_verbe"][1]==8){
				$num= 36;
			}
			if($arr["determinant_verbe"][1]==9){
				$num= 37;
			}
		}	
					
		$txt = $this->getTerminaison($arr["verbe"]["id_conj"],$num);

		return $txt;
	}
	
	public function getCarac($cls){
		
		if(is_string($cls)){
			$this->arrClass[$this->ordre]["texte"] = $cls;			
		}else{
			if(isset($cls["id_adj"])){
				$this->arrClass[$this->ordre]["adjectifs"][] = $cls;
			}
			if(isset($cls["id_dtm"])){
				$this->arrClass[$this->ordre]["adjectifs"][] = $cls;
			}
			if(isset($cls["id_sub"])){
				$this->getSubstantif("",$cls);
			}
			if(isset($cls["id_verbe"])){
				$this->getVerbe("",$cls);
			}			
		}		
		
	}

	
	public function genereVerbe($arr){

		/*
		Position 1 : type de négation
		Position 2 : temps verbal
		Position 3 : pronoms sujets définis
		Positions 4 ET 5 : pronoms compléments
		Position 6 : ordre des pronoms sujets
		Position 7 : pronoms indéfinis
		Position 8 : Place du sujet dans la chaîne grammaticale
		*/
		$arr["debneg"]="";
		$arr["finneg"]="";
		$arr["prodem"]="";		
				
		//génère le pronom
		$arr = $this->generePronom($arr);    	
		
		//récupère la terminaison
		$term = $this->genereTerminaison($arr);
		
		//construction du centre
		$centre = $arr["verbe"]["prefix"].$term;
		
		//construction de l'élision
		$eli = $arr["verbe"]["elision"];
		if($eli==0){
			$arrEli = array("a", "e", "é", "ê", "i","y");
			$arr["elision"] = in_array(substr($centre,0,1), $arrEli);
		}
		
		$verbe="";
		if(isset($arr["determinant_verbe"])){
			//génère la négation
			if($arr["determinant_verbe"][0]!=0){
				$arr["finneg"] = $this->getNegation($arr["determinant_verbe"][0]);
				if($arr["elision"]==0){
					$arr["debneg"] = "ne ";	
				}else{
					$arr["debneg"] = "n'";
				}
			}
			
			//construction de la forme verbale
			$verbe = "";
			//gextion de l'infinitif
			if($arr["determinant_verbe"][1]==9){
				$verbe = $centre;
				if($arr["prodem"]!=""){
					if($eli==0){
						$verbe = $arr["prodem"]["lib"].$verbe; 
					}else{
						$verbe = $arr["prodem"]["lib_eli"].$verbe; 
					}
					$eli=0;
				}	
				$verbe = $arr["finneg"].$verbe; 
				if($arr["debneg"]!=""){
					$verbe = $arr["debneg"].$verbe; 
				}	
			}		
			//gestion de l'ordre inverse
			if($arr["determinant_verbe"][6]==1){
				$verbe = $centre."-";
				$c = substr($centre,strlen($centre)-1);
				if(($c == "e" || $c == "a") && $arr["terminaison"]==3){
					$verbe .= "t-"; 
				}
				if($c == "e" && $arr["terminaison"]==1){
					$verbe = substr($centre,-1)."é-"; 
				}
				$verbe = $arr["debneg"]." ".$arr["prodem"]." ".$verbe." ".$arr["prosuj"]["lib"].$arr["prodem"]["lib"];
			}
		}
		//gestion de l'ordre normal
		if($verbe==""){
			$verbe = $centre.$arr["finneg"];
			if($arr["prodem"]!=""){
				if($eli==0){
					$verbe = $arr["prodem"]["lib"].$verbe; 
				}else{
					$verbe = $arr["prodem"]["lib_eli"].$verbe; 
					$eli=0;
				}
			}	
			if($arr["debneg"]!=""){
				$verbe = $arr["debneg"].$verbe; 
			}	
			if($arr["prosuj"]!=""){
				if($eli==0){
					$verbe = $arr["prosuj"]["lib"].$verbe; 
				}else{
					$verbe = $arr["prosuj"]["lib_eli"].$verbe; 
				}
			}	
		}
		
		return $verbe;
	}
	
	public function getClass($class){

		$this->arrClass[$this->ordre]["class"][] = $class;

		//vérifie si la class est un déterminant
		if(is_numeric($class)){
			$this->getDeterminant($class);
		}
		
		//vérifie si la class possède un déterminant de class
		$c = strpos($class,"_");
		if($c>0){
			$arr = explode("_",$class);			
			switch ($arr[0]) {
				case "a":
					$this->getAdjectifs($class);
					break;
				case "m":
					$this->getSubstantif($class);
					break;
				case "v":
					$this->getVerbe($class);
					break;
				case "s":
					$this->getSyntagme($class,false);
					break;
			}
		}elseif(substr($class,0,5)=="carac"){
			//la class est un caractère
			$classSpe = str_replace("carac", "carac_", $class);
			$this->getClassSpe($classSpe);
		}else{
			//vérifie si la class possède un blocage d'information
			$c = strpos($class,"#");
			if($c>0){
				$classSpe = str_replace("#","",$class); 
				$this->getSyntagme($classSpe);	
			}
	
			//vérifie si la class possède un blocage d'information
			if(substr($class,0,1)=="="){
				$this->getBlocage($class);	
			}
			
			//vérifie si la class est un type spécifique
			$c = strpos($class,"-");
			if($c>0){
				$classSpe = substr($class,0,$c)."_".substr($class,$c+1);
				$this->getClassSpe($classSpe);
			}			
		}
						
	}

	public function getClassSpe($class){

		$cls = $this->getAleaClass($class);
		if(is_string($cls)){
			$this->arrClass[$this->ordre]["texte"] = $cls;			
		}elseif(get_class($cls)=="Gen_Moteur"){
			$this->getClassMoteur($cls);
		}else{
			$this->getClassType($cls);
		}		
	}

	public function getClassMoteur($moteur){

		//ajoute le class générée
		foreach($moteur->arrClass as $k=>$c){
			$this->ordre ++;
			$this->arrClass[$this->ordre] = $c;
		}
	}
	
	
	public function getClassType($cls){

		if(isset($cls["id_conj"])){
		    $this->arrClass[$this->ordre]["adjectifs"][] = $cls;
		}
		if(isset($cls["id_sub"])){
		    $this->getSubstantif("",$cls);
		}
		if(isset($cls["id_verbe"])){
		    $this->getVerbe("",$cls);
		}
	}
	
	public function getClassVals($txt,$i=0){

		if(!$txt){
	        return array("deb"=>$i,"fin"=>$i,"valeur"=>$txt,"arr"=>$arr);
		}
		
		$deb = strpos($txt,"[",$i);
		$fin = strpos($txt,"]",$deb+1);
		
		//dan sle cas de ado par exemple = pas de crochet
		if($deb===false){
	        $class = $txt;
		}else{
			//on récupère la valeur de la classe
	        $class = substr($txt, $deb+1, -(strlen($txt)-$fin));
		}
		//$this->arrClass[$this->ordre]["class"][] = $class;
        
        
        //on récupère la définition de l'accord 
        $arr = explode("||",$class);
	    $class = $arr[0];        	 	
        if(count($arr)>1){
	        $this->arrClass[$this->ordre]["accord"] = $arr[1];
        }
        
        //on récupère le tableau des class
        $arr = explode("|",$class);        		        
        
        return array("deb"=>$deb,"fin"=>$fin,"valeur"=>$class,"arr"=>$arr);
	}
	
	public function getAdjectifs($class){

        //récupère le substantif
        $arr=explode("@", $class);
        if(count($arr)>1){ 
        	$this->getSubstantif($arr[1]);
        }
		
        $d = strpos($arr[0],"∏");        
        if($d){        	
        	//récupère les adjectifs
	        $arrAdj=explode("∏", $arr[0]);        
	        //récupère la définition des adjectifs
	        foreach($arrAdj as $a){
		        $this->arrClass[$this->ordre]["adjectifs"][] = $this->getAleaClass($a);
	        }        	
        }else{
	        $this->arrClass[$this->ordre]["adjectifs"][] = $this->getAleaClass($arr[0]);        	
        }
	}
	
	public function getBlocage($class){

        //récupère le numéro du blocage
        $num=substr($class,1);
		
        if($num=="x" || !isset($this->arrClass["vecteur"])){
        	//on applique le masculin singulier
	        $this->arrClass[$this->ordre]["pluriel"] = false; 
	        $this->arrClass[$this->ordre]["genre"] = 1;
			$this->arrClass["vecteur"][] = array("pluriel"=>$this->arrClass[$this->ordre]["pluriel"]
	        	,"genre"=>$this->arrClass[$this->ordre]["genre"]);       	                 	
        }else{
	        //récupère l'ordre
	        $ordre=count($this->arrClass["vecteur"])-$num;        
	        //Récupère les informations de genre et de nombre
        	if(!isset($this->arrClass["vecteur"][$ordre]["pluriel"])){
        		$toto = 1;
        	}
	        
	        $this->arrClass[$this->ordre]["pluriel"] = $this->arrClass["vecteur"][$ordre]["pluriel"]; 
	        $this->arrClass[$this->ordre]["genre"] = $this->arrClass["vecteur"][$ordre]["genre"];         	
        }
        
        
	}
	
	public function getDeterminant($class){

        $arrClass = false;

        //vérifie si le déterminant est pour un verbe
        if(strlen($class) > 6){
        	$intD = intval($class);
        	if($intD==0 && $this->ordre > 0){
        		//vérifie si le determinant n'est pas transmis
        		$strD = $this->arrClass[$this->ordre]["determinant_verbe"];
        		for($i = $this->ordre-1; $i >= 0; $i--){
        			if(intval($this->arrClass[$i]["determinant_verbe"])!=0){
						$class = $this->arrClass[$i]["determinant_verbe"];
						$i=-1;        				
        			}
        		}
        	}
			$this->arrClass[$this->ordre]["determinant_verbe"] = $class;
	        return $class;
        }       	
        
        //vérifie s'il faut chercher le pluriel
        $pluriel = false;
        if($class >= 50){
        	$pluriel = true;
        	$class = $class-50;
        }       			
        //vérifie s'il faut chercher le déterminant
        if($class!=99 && $class!=0){
        	$c = md5("getDeterminant_".$this->arrDicos["déterminants"]."_".$class."_".$pluriel);
        	if($this->forceCalcul)$this->cache->remove($c);
			if(!$arrClass = $this->cache->load($c)) {
		        $tDtr = new Model_DbTable_Determinants();
	        	$arrClass = $tDtr->obtenirDeterminantByDicoNumNombre($this->arrDicos["déterminants"],$class,$pluriel);        				
			    $this->cache->save($arrClass, $c);
			}
        }
        
        if($class==0){
        	$class=0;
        	//vérifie si le determinant n'est pas transmis
        	//la transmission se fait par [=x...]
        	/*
        	for($i = $this->ordre-1; $i > 0; $i--){
        		if(isset($this->arrClass[$i]["vecteur"])){
	        		if(intval($this->arrClass[$i]["determinant"])!=0){
						$arrClass = $this->arrClass[$i]["determinant"];
						$pluriel = $this->arrClass[$i]["vecteur"]["pluriel"];
						$i=-1;        				
	        		}
        		}
        	}
			*/
        }

		//ajoute le vecteur
		$this->arrClass[$this->ordre]["vecteur"]["pluriel"] = $pluriel; 
        
        //ajoute le déterminant
		$this->arrClass[$this->ordre]["determinant"] = $arrClass;
                        
        return $arrClass;
	}
	
	public function getSubstantif($class, $arrClass=false){

        //récupération du substantif
        if(!$arrClass) $arrClass = $this->getAleaClass($class);

        if($arrClass){
        	
	        //ajoute le vecteur
	        $this->arrClass[$this->ordre]["vecteur"]["genre"] = $arrClass["genre"];
	        $this->arrClass[$this->ordre]["vecteur"]["elision"] = $arrClass["elision"];
        	        	
	        //ajoute le substantif
	        $this->arrClass[$this->ordre]["substantif"] = $arrClass;
		        	        
        }        
        return $arrClass;
	}

	public function getSyntagme($class, $direct=true){
		
		//vérifie si le syntagme direct #
		if($direct){

	        $c = md5("getSyntagme_".$this->arrDicos['syntagmes']."_".$class);
        	if($this->forceCalcul)$this->cache->remove($c);
	        if(!$arrClass = $this->cache->load($c)) {
	        	//récupère la définition de la class
	        	$table = new Model_DbTable_Syntagmes();
	        	$arrClass = $table->obtenirSyntagmeByDicoNum($this->arrDicos['syntagmes'],$class);
				$this->cache->save($arrClass,$c);
			}
	        	        
	        $syn = $arrClass["lib"];
	        if(substr($syn,0,1)== "["){
	        	$this->traiteClass($syn);
	        }else{
		        $this->arrClass[$this->ordre]["syntagme"] = $syn;
	        }
		}else{
	        $arrClass = $this->getAleaClass($class);
	        if(isset($arrClass["lib"])){
	        	$this->arrClass[$this->ordre]["syntagme"] = $arrClass["lib"];			
	        }else{
	        	$this->traiteClass($arrClass["valeur"]);
	        }
		}
	}
	
	public function traiteClass($class, $i=0){

		$arrClass = $this->getClassVals($class,$i);	        	
		foreach($arrClass["arr"] as $cls){
			$this->getClass($cls);
        }	        	
		return $arrClass["fin"];
	}
	
	public function traiteFormat($class, $i=0){

		$deb = $i+1;
		$fin = strpos($class,"$",$deb);

		//on récupère les valeurs de format
        $txt = substr($class, $deb, -(strlen($class)-$fin));

        //enregistre le numéro du segment
        $this->arrSegment[$this->segment]["num"] = $txt[0].$txt[1];
        //enregistre l'indice de répétition
        $this->arrSegment[$this->segment]["repetition"] = $txt[8];
        //enregistre l'ordre de départ
        $this->arrSegment[$this->segment]["ordreDeb"]= $this->ordre;
        
        //vérifie si le texte est en prose ou en poésie
        $forme = $txt[9].$txt[10];
        if($forme=="00"){
			$this->arrClass[$this->ordre]["format"]["page"] = "prose";        	
        }
        if($forme=="01"){
			$this->arrClass[$this->ordre]["format"]["page"] = "poésie en vers-régulier";        	
        }
        if($forme=="02"){
			$this->arrClass[$this->ordre]["format"]["page"] = "poésie en vers-défini";        	
        }
        if($forme=="XX"){
			$this->arrClass[$this->ordre]["format"]["page"] = "poésie en vers-libre";        	
        }
        if($forme=="03"){
			$this->arrClass[$this->ordre]["format"]["page"] = "poésie en vers définis centrés";        	
        }
        
        return $fin;
	}
	
	public function getNegation($class){

        $c = md5("getNegation_".$this->arrDicos['negations']."_".$class);
        if($this->forceCalcul)$this->cache->remove($c);
        if(!$arrClass = $this->cache->load($c)) {
        	//récupère la définition de la class
        	$table = new Model_DbTable_Negations();
        	$arrClass = $table->obtenirNegationByDicoNum($this->arrDicos['negations'],$class);
			$this->cache->save($arrClass,$c);
		}
        
        return $arrClass["lib"];
	}
	
	public function getPronom($class, $type){


        $c = md5("getPronom_".$this->arrDicos["pronoms"]."_".$class."_".$type);
        if($this->forceCalcul)$this->cache->remove($c);
        if(!$arrClass = $this->cache->load($c)) {
			//récupère la définition de la class
       		$table = new Model_DbTable_Pronoms();
        	$arrClass = $table->obtenirPronomByDicoNumType($this->arrDicos['pronoms'],$class,$type);
			$this->cache->save($arrClass,$c);
		}

		return $arrClass;										

	}

	public function getTerminaison($idConj, $num){


        $c = md5("getTerminaison_".$idConj."_".$num);
        if($this->forceCalcul)$this->cache->remove($c);
        if(!$arrClass = $this->cache->load($c)) {
			//récupère la définition de la class
        	$table = new Model_DbTable_Terminaisons();
        	$arrClass = $table->obtenirConjugaisonByConjNum($idConj, $num);
			$this->cache->save($arrClass,$c);
		}
		
		if(get_class($arrClass)=="Exception"){
	        $this->arrClass[$this->ordre]["ERREUR"] = $arrClass->getMessage()."<br/><pre>".$arrClass->getTraceAsString()."</pre>";
			return "";
		}
		return $arrClass["lib"];
												
	}
	
	public function getVerbe($class, $arrClass=false){

        //récupération du verbe
        if(!$arrClass) $arrClass = $this->getAleaClass($class);
        
		if($arrClass){
	        //ajoute le verbe
	        $this->arrClass[$this->ordre]["verbe"] = $arrClass;
	                
	        $this->arrClass[$this->ordre]["elision"] = $arrClass["elision"];
		}
		        
        return $arrClass;
	}
	
	public function getAleaClass($class){
		
        //cherche la définition de la class
        $arrCpt = $this->getClassDef($class);
        
        //cas des classes théoriques et des erreurs
        if(count($arrCpt["dst"])<1){
        	return false;
        }
		$this->arrClass[$this->ordre]["concept"]["idConcept"] = $arrCpt["src"]["id_concept"];
		$this->arrClass[$this->ordre]["concept"]["idDico"] = $arrCpt["src"]["id_dico"];
		
        //enregistre le potentiel
        $this->potentiel += count($arrCpt["dst"]);
        
        if($this->typeChoix=="tout"){
        	//pour la vérification
        	$i=0;
        	foreach($arrCpt["dst"] as $dst){
        		$this->arrClass[$this->ordre][$i][] = $this->getClassGen($dst);	
        		$i++;
        	}
        	$cpt = false;
        }else{
	        //choisi un concept aléatoirement
	        //initialise le random
			mt_srand($this->make_seed());
        	
	        $a = mt_rand(0, count($arrCpt["dst"])-1);        
	        $cpt = $this->getClassGen($arrCpt["dst"][$a]);
	        if($cpt)$cpt["idParent"] = $arrCpt["src"]["id_concept"];
        }
                	
		return $cpt; 			
		
	}

	function make_seed()
	{
	  list($usec, $sec) = explode(' ', microtime());
	  return (float) $sec + ((float) $usec * 100000);
	}
	
	public function getClassGen($cpt){
		
        //Vérifie si le concept est un générateur
        if(isset($cpt["id_gen"])){
        	//générer l'expression
			$m = new Gen_Moteur();
			$m->arrDicos = $this->arrDicos;		
			//génére la classe
			$m->Generation($cpt['valeur'],false,$this->cache);
			//récupère les class générée
			$this->getClassMoteur($m);
			$this->potentiel += $m->potentiel;
			$cpt = false;
		}
		
		return $cpt; 			
		
	}
	
	public function getClassDef($class){


        $c = md5("getClassDef_".$this->arrDicos['concepts']."_".$class);
        if($this->forceCalcul)$this->cache->remove($c);
        if(!$arrCpt = $this->cache->load($c)) {
			//récupère la définition de la class
			$arrClass=explode("_", $class);
	        $table = new Model_DbTable_Concepts();	
	   	    $arrCpt = $table->obtenirConceptDescription($this->arrDicos['concepts'],$arrClass);
			$this->cache->save($arrCpt,$c);
		}
		
		if(get_class($arrCpt)=="Exception"){
    		$this->arrClass[$this->ordre]["ERREUR"] = $arrCpt->getMessage()."<br/><pre>".$arrCpt->getTraceAsString()."</pre>";
    		$arrCpt = false;
		}
		
        return $arrCpt;
	}

	
	
	public function traiteAction($chaine, $action){

		//applique l'action défini dans la description du langage
		switch ($action['type']) {
			case 'explode':
				//pour améliorer le explode des saut de ligne
				$c = str_replace("\\r","- -",$action['char']);
				//met la chaine dans un tableau
				$arr = explode($c, $chaine);
				//boucle sur les fragments de chaine optenus
				for ($i = 0 ; $i < count($arr); $i++) {
					//foreach ($arr as $frag) {
					$frag = $arr[$i];
					//vérifie si le traitement comporte des sous actions
					if(count($action->children())==0){
						$this->AjoutFrag($frag, $action);
					}else{
						//boucle sur les sous actions de l'action
						foreach ($action->children() as $act) {
							//vérifie si l'action est liée à la fin du tableau
							switch ($act['type']) {
								case "VerifFin":
									if($i==(count($arr)-1)){
										$this->traiteAction($frag, $act->action);					
									}else{
										$this->traiteAction($frag, $act->NoVerifAction);					
									}
									break;								
								case "VerifDeb":
									if($i==0){
										$this->traiteAction($frag, $act->action);					
									}else{
										$this->traiteAction($frag, $act->NoVerifAction);					
									}
									break;								
								default:
									$this->traiteAction($frag, $act);								
									break;
							}							
						}
					}
				}
				break;				
			case 'VerifSubstr':
				$c = substr($chaine, $action['deb'],$action['length']);
				if($c==$action['val']){
					//on exécute l'action suivante
					$this->traiteAction($chaine, $action->action);					
				}else{
					$this->traiteAction($chaine, $action->NoVerifAction);					
				}
				break;
		}

	}	


	function arrayVersHTML($tab, $col1 = "Cl&eacute;", $col2 = "Valeur", $bordure = 1)
	{
 		//http://www.phpsources.org/scripts471-PHP.htm
 		//modifier pour prendre en compte récursivement les tableaux   
 	    /* le chiffre doit être positif */
	    $bordure = (int) $bordure;
	    if ($bordure < 1) $bordure = 1;
	
	    /* le style CSS 
	    (rappel : il est préférable d'utiliser une feuiille externe plutôt que des styles internes aux balises) */
	    $style = "border: {$bordure}px solid black;font-style: bold;color:black;"; // les accolades permettent de coller la valeur numérique à "px"
		$styleErr = "border: {$bordure}px solid black;font-style: bold;color:red;";
		$styleTxt = "border: {$bordure}px solid black;font-style: bold;color:green;";
		
		$url = WEB_ROOT."/public/index.php/index/modifier/type/";
		
		/* génération de la première ligne, avec les libellés balisés comme cellules d'entête */
	    /* explications sur le scope="col" : l'accessibilité, lire l'article http://www.pompage.net/pompe/autableau/ */
	    $aafficher = "<table style='border-collapse: collapse; $style'>\n<tr>
	    <th scope='col' style='$style'>$col1</th> 
	    <th scope='col' style='$style'>$col2</th>\n</tr>\n";
	    
	    /* génération de chaque ligne ; col de gauche : la clé, celle de droite : la valeur correspondante
	    à chaque tour de boucle on ajoute le string généré à la suite du précédent (opérateur .=) */
	    foreach($tab as $cle => $valeur)
	    {
	        $aafficher .= "<tr style='$style'>
			    <td style='$style'>$cle</td>";
			//cas particulier des tableaux d'adjectifs
			if($cle==="adjectifs"){
				foreach($valeur as $adj){
		    		$admin = $url."adjectif/id/".$adj["id_adj"]."/idParent/".$adj["idParent"];
		    		$valeur = $this->arrayVersHTML($adj);
			    	$aafficher .= "<td style='$styleTxt'><a href='".$admin."'>admin</a> $valeur</td>\n</tr>\n";
				}
			}else{
			    if(is_array($valeur)){
			    	$valeur = $this->arrayVersHTML($valeur);
			    }
			    switch ($cle) {
			    	case "ERREUR":
				    	$aafficher .= "<td style='".$styleErr."'>$valeur</td>\n</tr>\n";
				    	break;
			    	case "texte":
				    	$aafficher .= "<td style='$styleTxt'>$valeur</td>\n</tr>\n";
				    	break;
				    case "concept":
			    		$admin = $url."concept/id/".$tab["concept"]["idConcept"]."/idParent/".$tab["concept"]["idDico"];
				    	$aafficher .= "<td style='$styleTxt'><a href='".$admin."'>admin</a> $valeur</td>\n</tr>\n";
				    	break;
				    case "verbe":
			    		$admin = $url."verbe/id/".$tab["verbe"]["id_verbe"]."/idParent/".$tab["verbe"]["idParent"];
				    	$aafficher .= "<td style='$styleTxt'><a href='".$admin."'>admin</a> $valeur</td>\n</tr>\n";
				    	break;
				    case "substantif":
			    		$admin = $url."substantif/id/".$tab["substantif"]["id_sub"]."/idParent/".$tab["substantif"]["idParent"];
				    	$aafficher .= "<td style='$styleTxt'><a href='".$admin."'>admin</a> $valeur</td>\n</tr>\n";
				    	break;
			    	default:
			    		$aafficher .= "<td style='$style'>$valeur</td>\n</tr>\n";
			    	break;
			    }
			}
	    }
	    
	    /* on ferme le tableau HTML (nécessaire pour la validité) */
	    $aafficher .= "</table>\n";
	    
	    return $aafficher;
	}
	
	
}
?>