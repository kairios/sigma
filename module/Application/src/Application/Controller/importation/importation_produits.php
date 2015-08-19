<?php

        /**************************************** Connexion à la base ****************************************/

        set_time_limit(0);
        $serveur='localhost';
        $utilisateur='root';
        $mdp=null;
        $base='sigma-old';
        $connection=mysql_connect($serveur, $utilisateur, $mdp);
        mysql_select_db($base,$connection);
        mysql_set_charset('utf8',$connection);

        /************************************ Tables traduction et produit ************************************/

        // Suppression des données des tables sigma.produit et sigma.adresse

        $truncate="TRUNCATE sigma.produit";
        $boolTruncate=mysql_query($truncate,$connection);
        if( $boolTruncate!=true )
        {
            die("Erreur lors d'un truncate avec la requête ".$truncate." : ".mysql_error());
        }
        $truncate="TRUNCATE sigma.traduction";
        $boolTruncate=mysql_query($truncate,$connection);
        if( $boolTruncate!=true )
        {
            die("Erreur lors d'un truncate avec la requête ".$truncate." : ".mysql_error());
        }
        echo 'Réinitialisation des tables produit et traduction terminée';
        /*
        $delete="DELETE FROM sigma.adresse WHERE adresse.ref_produit IS NOT NULL";
        $boolTruncate=mysql_query($delete,$connection);
        if( $boolTruncate!=true )
        {
            die("Erreur lors d'un truncate avec la requête ".$delete." : ".mysql_error());
        }*/
        

        //On récupère les lignes de l'ancienne table produit
        $rows=array();
        $query="SELECT * FROM `sigma-old`.tbl_produit";
        $result=mysql_query($query,$connection);
        while($row=mysql_fetch_array($result))
        {

            /* Insertion des adresses du produit */

            // Données du produit

            // Identifiant du produit
            $id=intval($row['ref_produit']);
            $codeProduit = (empty($row['reference']))?"NULL":"'".addslashes($row['reference'])."'";
            $date_maj="'".time()."'";
            $remarques = "NULL";

            // données de traduction
            $d = (empty($row['intitule_produit_d']))?null:"'".addslashes($row['intitule_produit_d'])."'";
            $fr = (empty($row['intitule_produit_fr']))?$d:"'".addslashes($row['intitule_produit_fr'])."'";
            $en = (empty($row['intitule_produit_uk']))?null:"'".addslashes($row['intitule_produit_uk'])."'";
            $id_traduction="NULL";

            // Si l'un des champs de traduction n'est pas null, on enregistre la traduction
            if($fr||$en)
            {
                // Pour la requete de recherche traduction
                $frTrad = (empty($fr))?"fr IS NULL":" fr = $fr";
                $enTrad = (empty($en))?"en IS NULL":" en = $en";

                // Pour la requete d'insertion de traduction
                $fr=(empty($fr))?"NULL":$fr;
                $en=(empty($en))?"NULL":$en;

                // Requète de l'insertion de la traduction 
                $insert_traduction = "INSERT INTO `sigma`.`traduction` (fr, en) VALUES (
                    ".$fr.",
                    ".$en."
                );";

                // Exécution de la requète
                $result_traduction=mysql_query($insert_traduction);

                if(!$result_traduction)
                {
                    echo "Impossible d'exécuter la requête ($insert_traduction) dans la base : " . mysql_error();
                    exit;
                }

                // Recherche de la traduction
                $query_traduction="SELECT id FROM `sigma`.traduction WHERE ".$frTrad." AND ".$enTrad;
                echo $query_traduction."</br >";
                $result_traduction=mysql_query($query_traduction,$connection);

                if(mysql_num_rows($result_traduction)>0)
                {
                    while( $data=mysql_fetch_array($result_traduction) )
                    {
                        $id_traduction=intval($data['id']); // if($id_traduction==0)$id_traduction="NULL";
                    }
                }
            }

            // Requète d'insertion produit
            $insert_produit="INSERT INTO `sigma`.`produit`(
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

            // Exécution de la requète
            $result_produit=mysql_query($insert_produit);

            if(!$result_produit)
            {
                echo "Impossible d'exécuter la requête ($insert_produit) dans la base : " . mysql_error();
                exit;
            }
        }

        /************************************** Table produit_fournisseur **************************************/

        // Suppression des données de la table sigma.produit_fournisseur

        $truncate="TRUNCATE sigma.produit_fournisseur";
        $boolTruncate=mysql_query($truncate,$connection);
        if( $boolTruncate!=true )
        {
            die("Erreur lors d'un truncate avec la requête ".$truncate." : ".mysql_error());
        }
        // $truncate="TRUNCATE sigma.traduction";
        // $boolTruncate=mysql_query($truncate,$connection);
        // if( $boolTruncate!=true )
        // {
        //     die("Erreur lors d'un truncate avec la requête ".$truncate." : ".mysql_error());
        // }
        echo 'Réinitialisation de la table sigma.produit_fournisseur terminée';
        /*
        $delete="DELETE FROM sigma.adresse WHERE adresse.ref_produit IS NOT NULL";
        $boolTruncate=mysql_query($delete,$connection);
        if( $boolTruncate!=true )
        {
            die("Erreur lors d'un truncate avec la requête ".$delete." : ".mysql_error());
        }*/
        

        //On récupère les lignes de l'ancienne table produit
        $rows=array();
        $query="SELECT * FROM `sigma-old`.tbl_produit_fournisseur";
        $result=mysql_query($query,$connection);
        while($row=mysql_fetch_array($result))
        {
            // Données de la ligne

            $id=intval($row['ref_produit_fournisseur']);
            $ref_fournisseur = intval($row['ref_fournisseur']);
            $ref_produit = intval($row['ref_produit']);
            $prix_achat = round(floatval($row['prix_achat']), 2);
            $conditionnement = intval($row['conditionnement']);
            $ref_produit_fournisseur = (empty($row['reference_produit_fournisseur']))?"NULL":"'".addslashes($row['reference_produit_fournisseur'])."'";
            $poids = 0;
            $remarques = "NULL";
            // $codeProduit = (empty($row['reference']))?"NULL":"'".addslashes($row['reference'])."'";
            // $date_maj="'".time()."'";

            // Requète d'insertion produit_fournisseur
            $insert_produit_fournisseur="INSERT INTO `sigma`.`produit_fournisseur`(
                `id`,
                `ref_produit`,
                `ref_fournisseur`,
                `reference_fournisseur`,
                `prix_achat`,
                `conditionnement`,
                `poids`,
                `remarques`
            ) VALUES (
                ".$id.",
                ".$ref_produit.",
                ".$ref_fournisseur.",
                ".$ref_produit_fournisseur.",
                ".$prix_achat.",
                ".$conditionnement.",
                ".$poids.",
                ".$remarques."
            );";

            echo $insert_produit_fournisseur."</br >";

            // Exécution de la requète
            $result_produit_fournisseur=mysql_query($insert_produit_fournisseur);

            if(!$result_produit_fournisseur)
            {
                echo "Impossible d'exécuter la requête ($insert_produit_fournisseur) dans la base : " . mysql_error();
                exit;
            }
        }

        /************************************** Table produit_fournisseur_vente **************************************/

        // Suppression des données de la table sigma.produit_fournisseur_vente

        $truncate="TRUNCATE sigma.produit_fournisseur_vente";
        $boolTruncate=mysql_query($truncate,$connection);
        if( $boolTruncate!=true )
        {
            die("Erreur lors d'un truncate avec la requête ".$truncate." : ".mysql_error());
        }
        echo 'Réinitialisation de la table sigma.produit_fournisseur_vente terminée';

        //On récupère les lignes de l'ancienne table produit
        $rows=array();
        $query="SELECT * FROM `sigma-old`.tbl_produit_prix_vente";
        $result=mysql_query($query,$connection);
        while($row=mysql_fetch_array($result))
        {
           
            if(!empty($row['ref_produit_fournisseur']) && !empty($row['prix_vente']))
            {
                // Données de la ligne

                $id=intval($row['ref_produit_prix_vente']);
                $ref_produit_fournisseur = intval($row['ref_produit_fournisseur']);
                $prix_vente = round(floatval($row['prix_vente']), 2);
                $remarques = (empty($row['remarques']))?"NULL":"'".addslashes($row['remarques'])."'";

                // Requète d'insertion produit_fournisseur
                $insert_produit_fournisseur_vente="INSERT INTO `sigma`.`produit_fournisseur_vente`(
                    `id`,
                    `ref_produit_fournisseur`,
                    `prix_vente`,
                    `coefficient`,
                    `remarques`
                ) VALUES (
                    ".$id.",
                    ".$ref_produit_fournisseur.",
                    ".$prix_vente.",
                    30,
                    ".$remarques."
                );";

                echo $insert_produit_fournisseur_vente."</br >";

                // Exécution de la requète
                $result_produit_fournisseur_vente=mysql_query($insert_produit_fournisseur_vente);

                if(!$result_produit_fournisseur_vente)
                {
                    echo "Impossible d'exécuter la requête ($insert_produit_fournisseur_vente) dans la base : " . mysql_error();
                    exit;
                }
            }
        }

        \Zend\Debug\Debug::dump('Imporatation terminée');die();
        mysql_close($connection);
	
?>