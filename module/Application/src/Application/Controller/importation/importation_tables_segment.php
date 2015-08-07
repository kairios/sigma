<?php

        /* Connexion à la base */
        
        set_time_limit(0);
        $serveur='localhost';
        $utilisateur='root';
        $mdp=null;
        $base='sigma-old';
        $connection=mysql_connect($serveur, $utilisateur, $mdp);
        mysql_select_db($base,$connection);
        mysql_set_charset('utf8',$connection);

        /******* Suppression des données des tables sigma.type_segment *******/
        $truncate="TRUNCATE `sigma`.`type_segment`";
        $boolTruncate=mysql_query($truncate,$connection);
        if( $boolTruncate!=true )
        {
            die("Erreur lors d'un truncate avec la requête ".$truncate." : ".mysql_error());
        }
        echo 'Réinitialisation de la table type_segment terminée</br>';
        // Suppression des données des tables sigma.segment
        $truncate="TRUNCATE `sigma`.`segment`";
        $boolTruncate=mysql_query($truncate,$connection);
        if( $boolTruncate!=true )
        {
            die("Erreur lors d'un truncate avec la requête ".$truncate." : ".mysql_error());
        }
        echo 'Réinitialisation de la table segment terminée</br>';
        // Suppression des données des tables sigma.produit_fini
        $truncate="TRUNCATE `sigma`.`produit_fini`";
        $boolTruncate=mysql_query($truncate,$connection);
        if( $boolTruncate!=true )
        {
            die("Erreur lors d'un truncate avec la requête ".$truncate." : ".mysql_error());
        }
        echo 'Réinitialisation de la table produit_fini terminée</br>';

        //On récupère les lignes de l'ancienne table tbl_segment_type
        $rows=array();
        $query="SELECT * FROM `sigma-old`.tbl_segment_type";
        $result=mysql_query($query,$connection);
        while($row=mysql_fetch_array($result))
        {
            // Données du fournisseur
            $id_type_segment=intval($row['ref_segment_type']);
            $type_segment="'".addslashes($row['intitule'])."'";

            // Requète d'insertion fournisseur
            $insert_type_segment="INSERT INTO `sigma`.`type_segment`(
                `id`,
                `intitule_type_segment`
            ) VALUES (
                ".$id_type_segment.",
                ".$type_segment."
            );";

            // Exécution de la requète
            $result_type_segment=mysql_query($insert_type_segment);

            if(!$result_type_segment)
            {
                echo "Impossible d'exécuter la requête ($insert_type_segment) dans la base : </br>" . mysql_error().'</br>';
                exit;
            } 
        }

        //On récupère les lignes de l'ancienne table tbl_segment
        $rows=array();
        $query="SELECT * FROM `sigma-old`.tbl_segment";
        $result=mysql_query($query,$connection);
        while($row=mysql_fetch_array($result))
        {
            // Données du fournisseur
            $id_segment=intval($row['ref_segment']);
            $segment="'".addslashes($row['descriptif'])."'";
            $id_type_segment=intval($row['ref_segment_type']);

            if($id_segment==0)
            {
                $id_segment=1;
            }
            else if($id_segment==1)
            {
                $id_segment=2;
            }

            // Requète d'insertion fournisseur
            $insert_segment="INSERT INTO `sigma`.`segment`(
                `id`,
                `intitule_segment`,
                `ref_type_segment`
            ) VALUES (
                ".$id_segment.",
                ".$segment.",
                ".$id_type_segment."
            );";

            // Exécution de la requète
            $result_segment=mysql_query($insert_segment);

            if(!$result_segment)
            {
                echo "Impossible d'exécuter la requête ($insert_segment) dans la base : </br>" . mysql_error().'</br>';
                exit;
            } 
        }

        //On récupère les lignes de l'ancienne table tbl_segment_produit_fini
        $rows=array();
        $query="SELECT * FROM `sigma-old`.tbl_segment_produit_fini";
        $result=mysql_query($query,$connection);
        while($row=mysql_fetch_array($result))
        {
            // Données du fournisseur
            $id_produit=intval($row['ref_produit_fini']);
            $produit="'".addslashes($row['descriptif'])."'";
            $id_segment=intval($row['ref_segment']);

            if($id_segment==0)
            {
                $id_segment=1;
            }
            else if($id_segment==1)
            {
                $id_segment=2;
            }

            // Requète d'insertion fournisseur
            $insert_produit="INSERT INTO `sigma`.`produit_fini`(
                `id`,
                `intitule_produit_fini`,
                `ref_segment`
            ) VALUES (
                ".$id_produit.",
                ".$produit.",
                ".$id_segment."
            );";

            // Exécution de la requète
            $result_segment=mysql_query($insert_produit);

            if(!$result_segment)
            {
                echo "Impossible d'exécuter la requête ($insert_produit) dans la base : </br>" . mysql_error().'</br>';
                exit;
            } 
        }

        \Zend\Debug\Debug::dump('</br>Imporatation terminée');die();
        mysql_close($connection);
?>