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

        // Suppression des données des tables sigma.client et sigma.adresse

        $truncate="TRUNCATE sigma.adresse";
        $boolTruncate=mysql_query($truncate,$connection);
        if( $boolTruncate!=true )
        {
            die("Erreur lors d'un truncate avec la requête ".$truncate." : ".mysql_error());
        }
        /*

        $delete="DELETE FROM sigma.adresse WHERE adresse.ref_client IS NOT NULL";
        $boolTruncate=mysql_query($delete,$connection);
        if( $boolTruncate!=true )
        {
            die("Erreur lors d'un truncate avec la requête ".$delete." : ".mysql_error());
        }*/
        $truncate="TRUNCATE sigma.client";
        $boolTruncate=mysql_query($truncate,$connection);
        if( $boolTruncate!=true )
        {
            die("Erreur lors d'un truncate avec la requête ".$truncate." : ".mysql_error());
        }
        echo 'Réinitialisation des tables client et adresse terminée';

        //On récupère les lignes de l'ancienne table client
        $rows=array();
        $query="SELECT * FROM `sigma-old`.tbl_societe";
        $result=mysql_query($query,$connection);
        while($row=mysql_fetch_array($result))
        {
            // Identifiant du client
            $id=intval($row['ref_societe']);

            /* Insertion des adresses du client */

            // Données adresse principale
            $rue1=(empty($row['adprincipale_adresse_1']))?null:"'".addslashes($row['adprincipale_adresse_1'])."'";
            $rue2=(empty($row['adprincipale_adresse_2']))?null:"'".addslashes($row['adprincipale_adresse_2'])."'";
            $rue3=(empty($row['adprincipale_adresse_3']))?null:"'".addslashes($row['adprincipale_adresse_3'])."'";
            $code_postal=(empty($row['adprincipale_code_postal']))?null:"'".addslashes($row['adprincipale_code_postal'])."'";
            $ville=(empty($row['adprincipale_ville']))?null:"'".addslashes($row['adprincipale_ville'])."'";
            $pays=(empty($row['adprincipale_pays']))?null:"'".addslashes($row['adprincipale_pays'])."'";
            $idem_fact=$row['adfact_idem_ad']=='FAUX'?0:1;
            $idem_livr=$row['adlivr_idem_ad']=='FAUX'?0:1;
            $idem_post=$row['adpost_idem_ad']=='FAUX'?0:1;

            // Si l'un des champs de l'adresse n'est pas null, on enregistre l'adresse
            if($rue1||$rue2||$rue3||$code_postal||$ville||$pays)
            {
                $rue1=(empty($rue1))?"NULL":$rue1;
                $rue2=(empty($rue2))?"NULL":$rue2;
                $rue3=(empty($rue3))?"NULL":$rue3;
                $code_postal=(empty($code_postal))?"NULL":$code_postal;
                $ville=(empty($ville))?"NULL":$ville;
                $pays=(empty($pays))?"NULL":$pays;

                // Requète de l'insertion de l'adresse principale
                $insert_adresse="INSERT INTO `sigma`.`adresse` (`rue_1`,`rue_2`,`rue_3`,`code_postal`,`ville`,`pays`,`ref_client`,`adresse_principale`,`adresse_facturation`,`adresse_livraison`,`adresse_postale`) VALUES (
                    ".$rue1.",
                    ".$rue2.",
                    ".$rue3.",
                    ".$code_postal.",
                    ".$ville.",
                    ".$pays.",
                    ".$id.",
                    '".true."',
                    '".$idem_fact."',
                    '".$idem_livr."',
                    '".$idem_post."'
                );";

                // Exécution de la requète
                $result_adresse=mysql_query($insert_adresse);

                if(!$result_adresse)
                {
                    echo "Impossible d'exécuter la requête ($insert_adresse) dans la base : " . mysql_error();
                    exit;
                }
            }

            // Si l'adresse de facturation n'est pas la même que l'adresse principale, on l'insère en BD
            if(!$idem_fact)
            {
                $rue1=(empty($row['adfacturation_adresse_1']))?null:"'".addslashes($row['adfacturation_adresse_1'])."'";
                $rue2=(empty($row['adfacturation_adresse_2']))?null:"'".addslashes($row['adfacturation_adresse_2'])."'";
                $rue3=(empty($row['adfacturation_adresse_3']))?null:"'".addslashes($row['adfacturation_adresse_3'])."'";
                $code_postal=(empty($row['adfacturation_code_postal']))?null:"'".addslashes($row['adfacturation_code_postal'])."'";
                $ville=(empty($row['adfacturation_ville']))?null:"'".addslashes($row['adfacturation_ville'])."'";
                $pays=(empty($row['adfacturation_pays']))?null:"'".addslashes($row['adfacturation_pays'])."'";

                // Si l'un des champs de l'adresse n'est pas null, on enregistre l'adresse
                if($rue1||$rue2||$rue3||$code_postal||$ville||$pays)
                {
                    $rue1=(empty($rue1))?"NULL":$rue1;
                    $rue2=(empty($rue2))?"NULL":$rue2;
                    $rue3=(empty($rue3))?"NULL":$rue3;
                    $code_postal=(empty($code_postal))?"NULL":$code_postal;
                    $ville=(empty($ville))?"NULL":$ville;
                    $pays=(empty($pays))?"NULL":$pays;

                    $insert_adresse="INSERT INTO `sigma`.`adresse` (`rue_1`,`rue_2`,`rue_3`,`code_postal`,`ville`,`pays`,`ref_client`,`adresse_principale`,`adresse_facturation`,`adresse_livraison`,`adresse_postale`) VALUES (
                        ".$rue1.",
                        ".$rue2.",
                        ".$rue3.",
                        ".$code_postal.",
                        ".$ville.",
                        ".$pays.",
                        ".$id.",
                        '".false."',
                        '".true."',
                        '".false."',
                        '".false."'
                    );";
                    
                    $result_adresse=mysql_query($insert_adresse);
                    if(!$result_adresse)
                    {
                        echo "Impossible d'exécuter la requête ($insert_adresse) dans la base : " . mysql_error();
                        exit;
                    }
                }
            }
            // Si l'adresse de livraison n'est pas la même que l'adresse principale, on l'insère en BD
            if(!$idem_livr)
            {
                $rue1=(empty($row['adlivraison_adresse_1']))?null:"'".addslashes($row['adlivraison_adresse_1'])."'";
                $rue2=(empty($row['adlivraison_adresse_2']))?null:"'".addslashes($row['adlivraison_adresse_2'])."'";
                $rue3=(empty($row['adlivraison_adresse_3']))?null:"'".addslashes($row['adlivraison_adresse_3'])."'";
                $code_postal=(empty($row['adlivraison_code_postal']))?null:"'".addslashes($row['adlivraison_code_postal'])."'";
                $ville=(empty($row['adlivraison_ville']))?null:"'".addslashes($row['adlivraison_ville'])."'";
                $pays=(empty($row['adlivraison_pays']))?null:"'".addslashes($row['adlivraison_pays'])."'";

                // Si l'un des champs de l'adresse n'est pas null, on enregistre l'adresse
                if($rue1||$rue2||$rue3||$code_postal||$ville||$pays)
                {
                    $rue1=(empty($rue1))?"NULL":$rue1;
                    $rue2=(empty($rue2))?"NULL":$rue2;
                    $rue3=(empty($rue3))?"NULL":$rue3;
                    $code_postal=(empty($code_postal))?"NULL":$code_postal;
                    $ville=(empty($ville))?"NULL":$ville;
                    $pays=(empty($pays))?"NULL":$pays;

                    $insert_adresse="INSERT INTO `sigma`.`adresse` (`rue_1`,`rue_2`,`rue_3`,`code_postal`,`ville`,`pays`,`ref_client`,`adresse_principale`,`adresse_facturation`,`adresse_livraison`,`adresse_postale`) VALUES (
                        ".$rue1.",
                        ".$rue2.",
                        ".$rue3.",
                        ".$code_postal.",
                        ".$ville.",
                        ".$pays.",
                        ".$id.",
                        '".false."',
                        '".false."',
                        '".true."',
                        '".false."'
                    );";
                    
                    $result_adresse=mysql_query($insert_adresse);
                    if(!$result_adresse)
                    {
                        echo "Impossible d'exécuter la requête ($insert_adresse) dans la base : " . mysql_error();
                        exit;
                    }
                }
            }
            // Si l'adresse postale n'est pas la même que l'adresse principale, on l'insère en BD
            if(!$idem_post)
            {
                $rue1=(empty($row['adpostale_adresse_1']))?null:"'".addslashes($row['adpostale_adresse_1'])."'";
                $rue2=(empty($row['adpostale_adresse_2']))?null:"'".addslashes($row['adpostale_adresse_2'])."'";
                $rue3=(empty($row['adpostale_adresse_3']))?null:"'".addslashes($row['adpostale_adresse_3'])."'";
                $code_postal=(empty($row['adpostale_code_postal']))?null:"'".addslashes($row['adpostale_code_postal'])."'";
                $ville=(empty($row['adpostale_ville']))?null:"'".addslashes($row['adpostale_ville'])."'";
                $pays=(empty($row['adpostale_pays']))?null:"'".addslashes($row['adpostale_pays'])."'";

                // Si l'un des champs de l'adresse n'est pas null, on enregistre l'adresse
                if($rue1||$rue2||$rue3||$code_postal||$ville||$pays)
                {
                    $rue1=(empty($rue1))?"NULL":$rue1;
                    $rue2=(empty($rue2))?"NULL":$rue2;
                    $rue3=(empty($rue3))?"NULL":$rue3;
                    $code_postal=(empty($code_postal))?"NULL":$code_postal;
                    $ville=(empty($ville))?"NULL":$ville;
                    $pays=(empty($pays))?"NULL":$pays;
                
                    $insert_adresse="INSERT INTO `sigma`.`adresse` (`rue_1`,`rue_2`,`rue_3`,`code_postal`,`ville`,`pays`,`ref_client`,`adresse_principale`,`adresse_facturation`,`adresse_livraison`,`adresse_postale`) VALUES (
                        ".$rue1.",
                        ".$rue2.",
                        ".$rue3.",
                        ".$code_postal.",
                        ".$ville.",
                        ".$pays.",
                        ".$id.",
                        '".false."',
                        '".false."',
                        '".false."',
                        '".true."'
                    );";
                    
                    $result_adresse=mysql_query($insert_adresse);
                    if(!$result_adresse)
                    {
                        echo "Impossible d'exécuter la requête ($insert_adresse) dans la base : " . mysql_error();
                        exit;
                    }
                }
            }

            /* Insertion du client lui-même */

            // Données du client
            $code_client=(empty($row['code_client']))?"NULL":"'".addslashes($row['code_client'])."'";
            $raison_sociale=(empty($row['raison_sociale']))?"NULL":"'".addslashes($row['raison_sociale'])."'";
            $date_creation=(empty($row['date_creation']))?"NULL":"'".addslashes($row['date_creation'])."'";
            $effectif_salarie=(empty($row['effectif']))?"NULL":"'".addslashes($row['effectif'])."'";
            $telephone=(empty($row['telephone']))?"NULL":"'".addslashes($row['telephone'])."'";
            $fax=(empty($row['fax']))?"NULL":"'".addslashes($row['fax'])."'";
            $site_web=(empty($row['url']))?"NULL":"'".addslashes($row['url'])."'";
            $email=(empty($row['email']))?"NULL":"'".addslashes($row['email'])."'";
            $date_maj="'".date('Y-m-d H:i:s')."'";
            $entreprise_a_livrer=(empty($row['entreprise_a_livrer']))?"NULL":"'".addslashes($row['entreprise_a_livrer'])."'";
            $entreprise_a_facturer=(empty($row['entreprise_a_facturer']))?"NULL":"'".addslashes($row['entreprise_a_facturer'])."'";
            $numero_tva=(empty($row['numero_tva']))?"NULL":"'".addslashes($row['numero_tva'])."'";
            $numero_siret=(empty($row['numero_siret']))?"NULL":"'".addslashes($row['numero_siret'])."'";
            $numero_ape=(empty($row['numero_ape']))?"NULL":"'".addslashes($row['numero_ape'])."'";
            $ref_type_segment=(empty($row['ref_segment_type']))?"NULL":intval($row['ref_segment_type']);
            $id_condition_reglement="NULL";
            $id_mode_reglement="NULL";

            // Récupération des clés étrangères en BD
            if(!empty($row['mode_reglement']))
            {
                $mode_reg=addslashes($row['mode_reglement']);
                $qmr="SELECT id FROM `sigma`.mode_reglement WHERE intitule_mode_reglement = '".$mode_reg."'";
                $rmr=mysql_query($qmr,$connection);

                if(mysql_num_rows($rmr)>0)
                {
                    while( $data=mysql_fetch_array($rmr) )
                    {
                        $id_mode_reglement=intval($data['id']);
                    }
                }
            }
            if(!empty($row['conditions_reglement']))
            {
                $cond_reg=addslashes($row['conditions_reglement']);
                $qcr="SELECT id FROM `sigma`.condition_reglement WHERE intitule_condition_reglement = '".$cond_reg."'";
                $rcr=mysql_query($qcr,$connection);

                if(mysql_num_rows($rcr)>0)
                {
                    while( $data=mysql_fetch_array($rcr) )
                    {
                        $id_condition_reglement=intval($data['id']);
                        //\Zend\Debug\Debug::dump($id_condition_reglement);die();
                    }
                }
            }
            
            // Requète d'insertion client
            $insert_client="INSERT INTO `sigma`.`client`(
                `id`,
                `code_client`,
                `raison_sociale`,
                `date_creation`,
                `effectif_salarie`,
                `telephone`,
                `fax`,
                `site_web`,
                `email`,
                `date_creation_modification_fiche`,
                `entreprise_a_livrer`,
                `entreprise_a_facturer`,
                `numero_tva`,
                `numero_siret`,
                `numero_ape`,
                `ref_mode_reglement`,
                `ref_condition_reglement`,
                `ref_type_segment`
            ) VALUES (
                ".$id.",
                ".$code_client.",
                ".$raison_sociale.",
                ".$date_creation.",
                ".$effectif_salarie.",
                ".$telephone.",
                ".$fax.",
                ".$site_web.",
                ".$email.",
                ".$date_maj.",
                ".$entreprise_a_livrer.",
                ".$entreprise_a_facturer.",
                ".$numero_tva.",
                ".$numero_siret.",
                ".$numero_ape.",
                ".$id_mode_reglement.",
                ".$id_condition_reglement.",
                ".$ref_type_segment."
            );";

            // Exécution de la requète
            $result_client=mysql_query($insert_client);

            if(!$result_client)
            {
                echo "Impossible d'exécuter la requête ($insert_client) dans la base : " . mysql_error();
                exit;
            }
            
        }

        \Zend\Debug\Debug::dump('Imporatation terminée');die();
        mysql_close($connection);
	
?>