<?php
/**
 * @Author: Ophelie
 * @Date:   2015-07-24 09:22:13
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-07-24 09:53:59
 */

        /* Connexion à la base */

        set_time_limit(0);
        $serveur='localhost';
        $utilisateur='root';
        $mdp=null;
        $base='sigma-old';
        $connection=mysql_connect($serveur, $utilisateur, $mdp);
        mysql_select_db($base,$connection);
        mysql_set_charset('utf8',$connection);

        // Suppression des données des tables sigma.client et sigma.adresse

        $truncate="TRUNCATE sigma.activite_fournisseur";
        $boolTruncate=mysql_query($truncate,$connection);
        if( $boolTruncate!=true )
        {
            die("Erreur lors d'un truncate avec la requête ".$truncate." : ".mysql_error());
        }
        // $truncate="TRUNCATE sigma.client";
        // $boolTruncate=mysql_query($truncate,$connection);
        // if( $boolTruncate!=true )
        // {
        //     die("Erreur lors d'un truncate avec la requête ".$truncate." : ".mysql_error());
        // }
        // echo 'Réinitialisation des tables client et adresse terminée';

        //On récupère les lignes de l'ancienne table
        $rows=array();
        $query="SELECT * FROM `sigma-old`.tbl_activite_fournisseur";
        $result=mysql_query($query,$connection);
        while($row=mysql_fetch_array($result))
        {
            // Identifiant de l'activité
            $id=intval($row['ref_activite']);
            $intitule_activite = (empty($row['intitule']))?null:"'".addslashes($row['intitule'])."'";

            $insert_categorie = "INSERT INTO `sigma`.`activite_fournisseur`(
            	`id`,
            	`intitule_activite`
            ) VALUES ( 
            	".$id.",
            	".$intitule_activite."
            );";
            
            // Exécution de la requète
            $result_activite=mysql_query($insert_categorie);

            if(!$result_activite)
            {
                echo "Impossible d'exécuter la requête ($insert_categorie) dans la base : " . mysql_error();
                exit;
            }
            
        }

        $rows=array();
        $query="SELECT * FROM `sigma-old`.tbl_fournisseur_activite";
        $result=mysql_query($query,$connection);
        while($row=mysql_fetch_array($result))
        {
            // Identifiant de l'activité
            $intitule_activite = (empty($row['activite_fournisseur']))?null:"'".addslashes($row['activite_fournisseur'])."'";

            $insert_categorie = "INSERT INTO `sigma`.`activite_fournisseur`(
            	`intitule_activite`
            ) VALUES ( 
            	".$intitule_activite."
            );";
            
            // Exécution de la requète
            $result_activite=mysql_query($insert_categorie);

            if(!$result_activite)
            {
                echo "Impossible d'exécuter la requête ($insert_categorie) dans la base : " . mysql_error();
                exit;
            }
            
        }

        // Maintenant que les données des deux tables de l'ancienne base ont été importées, il faut enlevr les duplicatas. 
        // Ainsi donc on repurge la table pour la reremplir.

        // On réccupère les données qui nous intérèsse
        $rows = array();
        $query = "SELECT * FROM `sigma`.activite_fournisseur GROUP BY intitule_activite";
        $result = mysql_query($query,$connection);

        // On vide la table pour la reremplir
        $truncate="TRUNCATE sigma.activite_fournisseur";
        $boolTruncate=mysql_query($truncate,$connection);
        if( $boolTruncate!=true )
        {
            die("Erreur lors d'un truncate avec la requête ".$truncate." : ".mysql_error());
        }

        // On la reremplit
        while($row=mysql_fetch_array($result))
        {
            // Identifiant de l'activité
            $id = intval($row['id']);
            $intitule_activite = (empty($row['intitule_activite']))?null:"'".addslashes($row['intitule_activite'])."'";

            $insert_categorie = "INSERT INTO `sigma`.`activite_fournisseur`(
            	`id`,
            	`intitule_activite`
            ) VALUES ( 
            	".$id.",
            	".$intitule_activite."
            );";
            
            // Exécution de la requète
            $result_activite = mysql_query($insert_categorie);

            if(!$result_activite)
            {
                echo "Impossible d'exécuter la requête ($insert_categorie) dans la base : " . mysql_error();
                exit;
            }
        }

        \Zend\Debug\Debug::dump('Imporatation terminée');die();
        mysql_close($connection);
	
?>