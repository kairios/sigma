<?php

        /* Connexion � la base */

        set_time_limit(0);
        $serveur='localhost';
        $utilisateur='root';
        $mdp=null;
        $base='sigma-old';
        $connection=mysql_connect($serveur, $utilisateur, $mdp);
        mysql_select_db($base,$connection);
        mysql_set_charset('utf8',$connection);

        // Suppression des donn�es des tables sigma.client et sigma.adresse

        $truncate="TRUNCATE sigma.produit";
        $boolTruncate=mysql_query($truncate,$connection);
        if( $boolTruncate!=true )
        {
            die("Erreur lors d'un truncate avec la requ�te ".$truncate." : ".mysql_error());
        }
        $truncate="TRUNCATE sigma.traduction";
        $boolTruncate=mysql_query($truncate,$connection);
        if( $boolTruncate!=true )
        {
            die("Erreur lors d'un truncate avec la requ�te ".$truncate." : ".mysql_error());
        }
        echo 'R�initialisation des tables produit et traduction termin�e';
        /*
        $delete="DELETE FROM sigma.adresse WHERE adresse.ref_client IS NOT NULL";
        $boolTruncate=mysql_query($delete,$connection);
        if( $boolTruncate!=true )
        {
            die("Erreur lors d'un truncate avec la requ�te ".$delete." : ".mysql_error());
        }*/
        

        //On r�cup�re les lignes de l'ancienne table produit
        $rows=array();
        $query="SELECT * FROM `sigma-old`.tbl_produit";
        $result=mysql_query($query,$connection);
        while($row=mysql_fetch_array($result))
        {
            // Identifiant du client
            $id=intval($row['ref_produit']);

            /* Insertion des adresses du client */

            // donn�es de traduction
            $fr = (empty($row['intitule_produit_fr']))?null:"'".addslashes($row['intitule_produit_fr'])."'";
            $en = (empty($row['intitule_produit_uk']))?null:"'".addslashes($row['intitule_produit_uk'])."'";

            // Si l'un des champs de traduction n'est pas null, on enregistre la traduction
            if($fr||$en)
            {
                $fr=(empty($fr))?"NULL":$fr;
                $en=(empty($en))?"NULL":$en;

                // Requ�te de l'insertion de la traduction 
                $insert_traduction = "INSERT INTO `sigma`.`traduction` VALUES (
                    ".$fr.",
                    ".$en."
                );";

                // Ex�cution de la requ�te
                $result_traduction=mysql_query($insert_traduction);

                if(!$result_traduction)
                {
                    echo "Impossible d'ex�cuter la requ�te ($insert_traduction) dans la base : " . mysql_error();
                    exit;
                }
            }

            /* Insertion du produit lui-m�me */

            $id_traduction="NULL";

            // Donn�es du produit
            $codeProduit = (empty($row['reference']))?"NULL":"'".addslashes($row['reference'])."'";
            $date_maj="'".time()."'";
            $remarques = 'NULL';

            // R�cup�ration des cl�s �trang�res en BD
            if(!empty($row['intitule_produit_fr']) || !empty($row['intitule_produit_uk']))
            {
                $fr = addslashes($row['intitule_produit_fr']);
                $en = addslashes($row['intitule_produit_uk']);

                $query_traduction="SELECT id FROM `sigma`.traduction WHERE fr = '".$fr."' AND en = '".$en."'";
                $result_traduction=mysql_query($query_traduction,$connection);

                if(mysql_num_rows($result_traduction)>0)
                {
                    while( $data=mysql_fetch_array($result_traduction) )
                    {
                        $id_traduction=intval($data['id']); // if($id_traduction==0)$id_traduction="NULL";
                    }
                }
            }
            
            // Requ�te d'insertion produit
            $insert_produit="INSERT INTO `sigma`.`client`(
                `id`,
                `code_produit`,
                `ref_intitule_produit`,
                `date_creation_modification_fiche`,
                `remarques`
            ) VALUES (
                ".$id.",
                ".$codeProduit.",
                ".$id_traduction.",
                ".$date_maj.",
                ".$remarques."
            );";

            // Ex�cution de la requ�te
            $result_produit=mysql_query($insert_produit);

            if(!$result_produit)
            {
                echo "Impossible d'ex�cuter la requ�te ($insert_produit) dans la base : " . mysql_error();
                exit;
            }
        }

        \Zend\Debug\Debug::dump('Imporatation termin�e');die();
        mysql_close($connection);
	
?>