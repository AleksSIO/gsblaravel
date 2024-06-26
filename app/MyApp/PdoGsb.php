<?php
namespace App\MyApp;
use PDO;
use Illuminate\Support\Facades\Config;
class PdoGsb{
        private static string $serveur;
        private static string $bdd;
        private static mixed $user;
        private static mixed $mdp;
        private ?PDO $monPdo;

/**
 * crée l'instance de PDO qui sera sollicitée
 * pour toutes les méthodes de la classe
 */
	public function __construct(){

        self::$serveur='mysql:host=' . Config::get('database.connections.mysql.host');
        self::$bdd='dbname=' . Config::get('database.connections.mysql.database');
        self::$user=Config::get('database.connections.mysql.username') ;
        self::$mdp=Config::get('database.connections.mysql.password');
        $this->monPdo = new PDO(self::$serveur.';'.self::$bdd, self::$user, self::$mdp);
  		$this->monPdo->query("SET CHARACTER SET utf8");
        $this->monPdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $this->monPdo->setAttribute(PDO::ATTR_AUTOCOMMIT, true);

    }
	public function __destruct(){
		if($this->monPdo !== null){
            $this->monPdo = null;
        }
	}


/**
 * Retourne les informations d'un visiteur

 * @param $login
 * @param $mdp
 * @return l'id, le nom et le prénom sous la forme d'un tableau associatif
*/
	public function getInfosVisiteur($login, $mdp){
		$req = "select visiteur.id as id, visiteur.nom as nom, visiteur.prenom as prenom from visiteur
        where visiteur.login='" . $login . "' and visiteur.mdp='" . $mdp ."'";
    	$rs = $this->monPdo->query($req);
		$ligne = $rs->fetch();
		return $ligne;
	}


/**
 * Verifie les informations d'un visiteur
<<<<<<< HEAD
<<<<<<< HEAD

 * @param $login
 * @param $mdp
 * @return l'id, le nom et le prénom sous la forme d'un tableau associatif
*/

	public function getTestVisiteur($login, $mdp){
		$req = "select visiteur.id as id, visiteur.nom as nom, visiteur.prenom as prenom from visiteur
		where visiteur.login='" . $login . "' and visiteur.mdp='" . $mdp ."'";
		$rs = $this->monPdo->query($req);
		$ligne = $rs->fetch();
		return $ligne;
	}

/**
 * Retourne sous forme d'un tableau associatif toutes les lignes de frais au forfait
 * concernées par les deux arguments

 * @param $idVisiteur
 * @param '$mois' forme aaaamm
 * @return l'id, le libelle et la quantité sous la forme d'un tableau associatif
*/
	public function getLesFraisForfait($idVisiteur, $mois){
		$req = "select fraisforfait.id as idfrais, fraisforfait.libelle as libelle,
		lignefraisforfait.quantite as quantite from lignefraisforfait inner join fraisforfait
		on fraisforfait.id = lignefraisforfait.idfraisforfait
		where lignefraisforfait.idvisiteur ='$idVisiteur' and lignefraisforfait.mois='$mois'
		order by lignefraisforfait.idfraisforfait";
		$res = $this->monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
/**
 * Retourne tous les id de la table FraisForfait

 * @return un tableau associatif
*/
	public function getLesIdFrais(){
		$req = "select fraisforfait.id as idfrais from fraisforfait order by fraisforfait.id";
		$res = $this->monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
/**
 * Met à jour la table ligneFraisForfait

 * Met à jour la table ligneFraisForfait pour un visiteur et
 * un mois donné en enregistrant les nouveaux montants

 * @param $idVisiteur
 * @param $mois sous la forme aaaamm
 * @param $lesFrais tableau associatif de clé idFrais et de valeur la quantité pour ce frais
 * @return un tableau associatif
*/
	public function majFraisForfait($idVisiteur, $mois, $lesFrais){
		$lesCles = array_keys($lesFrais);
		foreach($lesCles as $unIdFrais){
			$qte = $lesFrais[$unIdFrais];
			$req = "update lignefraisforfait set lignefraisforfait.quantite = $qte
			where lignefraisforfait.idvisiteur = '$idVisiteur' and lignefraisforfait.mois = '$mois'
			and lignefraisforfait.idfraisforfait = '$unIdFrais'";
			$this->monPdo->exec($req);
		}

	}

/**
 * Teste si un visiteur possède une fiche de frais pour le mois passé en argument

 * @param $idVisiteur
 * @param $mois sous la forme aaaamm
 * @return vrai ou faux
*/
	public function estPremierFraisMois($idVisiteur,$mois)
	{
		$ok = false;
		$req = "select count(*) as nblignesfrais from fichefrais
		where fichefrais.mois = '$mois' and fichefrais.idvisiteur = '$idVisiteur'";
		$res = $this->monPdo->query($req);
		$laLigne = $res->fetch();
		if($laLigne['nblignesfrais'] == 0){
			$ok = true;
		}
		return $ok;
	}
/**
 * Retourne le dernier mois en cours d'un visiteur

 * @param $idVisiteur
 * @return le mois sous la forme aaaamm
*/
	public function dernierMoisSaisi($idVisiteur){
		$req = "select max(mois) as dernierMois from fichefrais where fichefrais.idvisiteur = '$idVisiteur'";
		$res = $this->monPdo->query($req);
		$laLigne = $res->fetch();
		$dernierMois = $laLigne['dernierMois'];
		return $dernierMois;
	}

/**
 * Crée une nouvelle fiche de frais et les lignes de frais au forfait pour un visiteur et un mois donnés

 * récupère le dernier mois en cours de traitement, met à 'CL' son champs idEtat, crée une nouvelle fiche de frais
 * avec un idEtat à 'CR' et crée les lignes de frais forfait de quantités nulles
 * @param $idVisiteur
 * @param $mois sous la forme aaaamm
*/
	public function creeNouvellesLignesFrais($idVisiteur,$mois){
		$dernierMois = $this->dernierMoisSaisi($idVisiteur);
		$laDerniereFiche = $this->getLesInfosFicheFrais($idVisiteur,$dernierMois);
		if($laDerniereFiche['idEtat']=='CR'){
				$this->majEtatFicheFrais($idVisiteur, $dernierMois,'CL');

		}
		$req = "insert into fichefrais(idvisiteur,mois,nbJustificatifs,montantValide,dateModif,idEtat)
		values('$idVisiteur','$mois',0,0,now(),'CR')";
		$this->monPdo->exec($req);
		$lesIdFrais = $this->getLesIdFrais();
		foreach($lesIdFrais as $uneLigneIdFrais){
			$unIdFrais = $uneLigneIdFrais['idfrais'];
			$req = "insert into lignefraisforfait(idvisiteur,mois,idFraisForfait,quantite) values('$idVisiteur','$mois','$unIdFrais',0)";
			$this->monPdo->exec($req);
		 }
	}


/**
 * Retourne les mois pour lesquel un visiteur a une fiche de frais

 * @param $idVisiteur
 * @return un tableau associatif de clé un mois -aaaamm- et de valeurs l'année et le mois correspondant
*/
	public function getLesMoisDisponibles($idVisiteur){
		$req = "select fichefrais.mois as mois from  fichefrais where fichefrais.idvisiteur ='$idVisiteur'
		order by fichefrais.mois desc ";
		$res = $this->monPdo->query($req);
		$lesMois =array();
		$laLigne = $res->fetch();
		while($laLigne != null)	{
			$mois = $laLigne['mois'];
			$numAnnee =substr( $mois,0,4);
			$numMois =substr( $mois,4,2);
			$lesMois["$mois"]=array(
		     "mois"=>"$mois",
		    "numAnnee"  => "$numAnnee",
			"numMois"  => "$numMois"
             );
			$laLigne = $res->fetch();
		}
		return $lesMois;
	}
/**
 * Retourne les informations d'une fiche de frais d'un visiteur pour un mois donné

 * @param $idVisiteur
 * @param $mois sous la forme aaaamm
 * @return un tableau avec des champs de jointure entre une fiche de frais et la ligne d'état
*/
	public function getLesInfosFicheFrais($idVisiteur,$mois){
		$req = "select fichefrais.idEtat as idEtat, fichefrais.dateModif as dateModif, fichefrais.nbJustificatifs as nbJustificatifs,
			fichefrais.montantValide as montantValide, etat.libelle as libEtat from  fichefrais inner join etat on fichefrais.idEtat = etat.id
			where fichefrais.idvisiteur ='$idVisiteur' and fichefrais.mois = '$mois'";
		$res = $this->monPdo->query($req);
		$laLigne = $res->fetch();
		return $laLigne;
	}
/**
 * Modifie l'état et la date de modification d'une fiche de frais

 * Modifie le champ idEtat et met la date de modif à aujourd'hui
 * @param $idVisiteur
 * @param $mois sous la forme aaaamm
 */

	public function majEtatFicheFrais($idVisiteur,$mois,$etat){
		$req = "update ficheFrais set idEtat = '$etat', dateModif = now()
		where fichefrais.idvisiteur ='$idVisiteur' and fichefrais.mois = '$mois'";
		$this->monPdo->exec($req);
	}

    /*  select les gestionnaires */
    public function getInfosGestionnaire($login, $mdp){
        $req = "SELECT * FROM gestionnaire WHERE login = :login AND mdp = :mdp";
        $res = $this->monPdo->prepare($req);
        $res->bindValue(':login', $login, PDO::PARAM_STR);
        $res->bindValue(':mdp', $mdp, PDO::PARAM_STR);
        $res->execute();
        return $res->fetch();
    }

	/*  select les comptables */
    public function getInfosComptable($login, $mdp){
        $req = "SELECT * FROM comptable WHERE login = :login AND mdp = :mdp";
        $res = $this->monPdo->prepare($req);
        $res->bindValue(':login', $login, PDO::PARAM_STR);
        $res->bindValue(':mdp', $mdp, PDO::PARAM_STR);
        $res->execute();
        return $res->fetch();
    }




    /* Select ` */

    public function listeVisiteurs(){
        $req = "SELECT * FROM visiteur";
        $res = $this->monPdo->prepare($req);
        $res->execute();
        return $res->fetchAll();
    }

    public function listeNomVisiteurs(){
        $req = "SELECT nom FROM visiteur";
        $res = $this->monPdo->prepare($req);
        $res->execute();
        return $res->fetchAll();
    }

    public function listePrenomVisiteurs(){
        $req = "SELECT prenom FROM visiteur";
        $res = $this->monPdo->prepare($req);
        $res->execute();
        return $res->fetchAll();
    }

    public function listeMoisFraisForfait(){
        $req = "SELECT DISTINCT `mois` FROM `fichefrais` ORDER BY mois ASC";
        $res = $this->monPdo->prepare($req);
        $res->execute();
        return $res->fetchAll();
    }
    public function fraisbyName($nom,$prenom,$date) {
        $req = "SELECT * FROM `visiteur`
                INNER JOIN fichefrais on fichefrais.idVisiteur = visiteur.id
                INNER JOIN etat on fichefrais.idEtat = etat.id
                WHERE nom = ? AND prenom = ? AND mois = ?";
        $res = $this->monPdo->prepare($req);
        $res->execute([$nom,$prenom,$date]);
        return $res->fetch();
    }

    public function NamebyId($nom,$prenom) {
        $req = "SELECT id FROM `visiteur`
                WHERE nom = ? AND prenom = ?";
        $res = $this->monPdo->prepare($req);
        $res->execute([$nom,$prenom]);
        return $res->fetch();
    }
    public function validerfrais($id, $mois, $etat, $montantValide){
        $r = 0;
        try {
            $req = "
            UPDATE `fichefrais`
            SET `idEtat` = :etat
            WHERE `idVisiteur` = :id AND `mois` = :mois AND `montantValide` = :montantV";
            $res = $this->monPdo->prepare($req);
            $r = $res->execute(['etat' => $etat,'id' => $id, 'mois' => $mois, 'montantV' => $montantValide]);
        }catch (PDOException $e) {
            echo "Erreur PDO : " . $e->getMessage();
        }
        return $r;
    }
    public function cloturerfrais($id, $mois, $etat, $montantValide, $m){
        $r = false;
        try {
            $req = "
            UPDATE `fichefrais`
            SET `idEtat` = :etat, `montantValide` = :montant
            WHERE `idVisiteur` = :id AND `mois` = :mois AND `montantValide` = :montantV";
            $res = $this->monPdo->prepare($req);
            $r = $res->execute(['etat' => $etat, 'montant' => $m, 'id' => $id, 'mois' => $mois, 'montantV' => $montantValide]);
        } catch (PDOException $e) {
            echo "Erreur PDO : " . $e->getMessage();
        }
        return $r;
    }
    public function lesetats(){
        $req = "SELECT `id`,`libelle` FROM `etat`";
        $res = $this->monPdo->prepare($req);
        $res->execute();
        return $res->fetchAll();
    }
    public function unVisiteur($id){
        $req = "SELECT * FROM visiteur WHERE id=?";
        $res = $this->monPdo->prepare($req);
        $res->execute([$id]);
        return $res->fetch();
    }

    public function suppVisiteur($id){
        $req = "DELETE FROM `lignefraisforfait` WHERE idVisiteur=?;
                DELETE FROM `fichefrais` WHERE idVisiteur=?;
                DELETE FROM `visiteur` WHERE id=?";

        $res = $this->monPdo->prepare($req);
        $res->execute([$id,$id,$id]);
        return true;
    }

    public function modifierVisiteur($id,$nom,$prenom,$login,$mdp,$adresse,$cp,$ville,$dateEmbauche){
        $req = "UPDATE `visiteur`
                SET `nom`=?,`prenom`=?,`login`=?,`mdp`=?,`adresse`=?,`cp`=?,`ville`=?,`dateEmbauche`=?
                WHERE `id`=?";
        $res = $this->monPdo->prepare($req);
        $res->execute([$nom,$prenom,$login,$mdp,$adresse,$cp,$ville,$dateEmbauche,$id]);
        return true;

    }

    public function insererVisiteur($id,$nom,$prenom,$login,$mdp,$adresse,$cp,$ville,$dateEmbauche){
        $req = "INSERT INTO `visiteur`(`id`, `nom`, `prenom`, `login`, `mdp`, `adresse`, `cp`, `ville`, `dateEmbauche`)
                VALUES (?,?,?,?,?,?,?,?,?)";
        $res = $this->monPdo->prepare($req);
        $res->execute([$id,$nom,$prenom,$login,$mdp,$adresse,$cp,$ville,$dateEmbauche]);
        return true;
    }

	public function getLesAnnees(){
		$req = "select distinct(left(mois, 4)) as annee from lignefraisforfait ORDER BY annee DESC";
		$res = $this->monPdo->query($req);
		$laLigne = $res->fetchAll();
		return $laLigne;
	}

	public function getLesFichesFraisParAnnee($annee){
		$req = "select lf.idVisiteur as numVisiteur,
        sum(ff.montant * case when lf.idFraisForfait = 'ETP' then lf.quantite END) as 'ETP',
        sum(ff.montant * case when lf.idFraisForfait = 'KM' then lf.quantite END) as 'KM',
        sum(ff.montant * case when lf.idFraisForfait = 'NUI' then lf.quantite END) as 'NUI',
        sum(ff.montant * case when lf.idFraisForfait = 'REP' then lf.quantite END) as 'REP'
        from lignefraisforfait lf
        inner join fraisforfait ff on ff.id = lf.idFraisForfait
        where mois like :annee
        GROUP BY lf.idVisiteur";
        $res = $this->monPdo->prepare($req);
        $res->bindValue(':annee', $annee . '%', PDO::PARAM_STR);
        $res->execute();
        $laLigne = $res->fetchAll();
        return $laLigne;
	}

	public function getLesFichesFraisParVisiteur($idVisiteur){
		$req = "select mois,
		sum(ff.montant * case when lf.idFraisForfait = 'ETP' then lf.quantite END) as 'ETP',
		sum(ff.montant * case when lf.idFraisForfait = 'KM' then lf.quantite END) as 'KM',
		sum(ff.montant * case when lf.idFraisForfait = 'NUI' then lf.quantite END) as 'NUI',
		sum(ff.montant * case when lf.idFraisForfait = 'REP' then lf.quantite END) as 'REP'
		from lignefraisforfait lf
		inner join fraisforfait ff on ff.id = lf.idFraisForfait
		where idVisiteur = :visiteur
		GROUP BY mois
		ORDER BY mois DESC";
		$res = $this->monPdo->prepare($req);
        $res->bindValue(':visiteur', $idVisiteur, PDO::PARAM_STR);
        $res->execute();
        $laLigne = $res->fetchAll();
        return $laLigne;

	}

	public function getLesTypes(){
		$req = "select id, libelle from fraisforfait";
		$res = $this->monPdo->query($req);
		$laLigne = $res->fetchAll();
		return $laLigne;
	}

	public function getLesFichesFraisParType($typefrais){
		$req = "select idVisiteur, mois, ff.montant * lf.quantite as montant
		from lignefraisforfait lf
		inner join fraisforfait ff on ff.id = lf.idFraisForfait
		where idFraisForfait = :typefrais
		ORDER BY mois DESC";
		$res = $this->monPdo->prepare($req);
        $res->bindValue(':typefrais', $typefrais, PDO::PARAM_STR);
        $res->execute();
        $laLigne = $res->fetchAll();
        return $laLigne;

	}


}
