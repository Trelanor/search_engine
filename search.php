<?php

	$host = 'localhost';
	$login = 'root';
	$pass = 'root';
	$base = 'moteur_de_recherche';
	
	try{
		
		//connection à la base de données
		$connexion = new PDO("mysql:host=$host;dbname=$base", $login, $pass);
	}
	
	catch(PDOException $e){
		echo 'echec de la connection :' .$e->getMessage();
	}
	
	$connexion->query("SET NAMES UTF8");//Solution encodage UTF8
	
	if(isset($_GET['search']) && !empty($_GET['search'])){
		
		$resultat = (htmlspecialchars($_GET['search']));
		
		$requete = $connexion ->prepare('SELECT * FROM search WHERE marque LIKE :valeur OR modele LIKE :valeur');
		$requete->execute(array(
			'valeur'=> "%".$resultat."%"
		));
		
		
		$data = $requete->fetchAll();
		
		
		echo json_encode($data);
		die();
	}

?>



