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

        // Suppression des données des tables sigma.fournisseur et sigma.adresse
        /*
        $truncate="TRUNCATE sigma.adresse";
        $boolTruncate=mysql_query($truncate,$connection);
        if( $boolTruncate!=true )
        {
            die("Erreur lors d'un truncate avec la requête ".$truncate." : ".mysql_error());
        }
        $delete="DELETE FROM sigma.adresse WHERE adresse.ref_fournisseur IS NOT NULL";
        $boolTruncate=mysql_query($delete,$connection);
        if( $boolTruncate!=true )
        {
            die("Erreur lors d'un truncate avec la requête ".$delete." : ".mysql_error());
        }*/
        $truncate="TRUNCATE sigma.fournisseur";
        $boolTruncate=mysql_query($truncate,$connection);
        if( $boolTruncate!=true )
        {
            die("Erreur lors d'un truncate avec la requête ".$truncate." : ".mysql_error());
        }
        echo 'Réinitialisation des tables fournisseur et adresse terminée';

        //On récupère les lignes de l'ancienne table fournisseur
        $rows=array();
        $query="SELECT * FROM `sigma-old`.tbl_fournisseur";
        $result=mysql_query($query,$connection);
        while($row=mysql_fetch_array($result))
        {
            // Identifiant du fournisseur
            $id=intval($row['ref_fournisseur']);

            /* Insertion des adresses du fournisseur */

            // Données adresse principale
            $rue1=(empty($row['adprincipale_adresse_1']))?null:"'".addslashes($row['adprincipale_adresse_1'])."'";
            $rue2=(empty($row['adprincipale_adresse_2']))?null:"'".addslashes($row['adprincipale_adresse_2'])."'";
            $rue3=(empty($row['adprincipale_adresse_3']))?null:"'".addslashes($row['adprincipale_adresse_3'])."'";
            $code_postal=(empty($row['adprincipale_code_postal']))?null:"'".addslashes($row['adprincipale_code_postal'])."'";
            $ville=(empty($row['adprincipale_ville']))?null:"'".addslashes($row['adprincipale_ville'])."'";
            $pays=(empty($row['adprincipale_pays']))?null:"'".addslashes($row['adprincipale_pays'])."'";
            $idem_fact=$row['adfact_idem_ad']=='FAUX'?0:1;
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
                $insert_adresse="INSERT INTO `sigma`.`adresse` (`rue_1`,`rue_2`,`rue_3`,`code_postal`,`ville`,`pays`,`ref_fournisseur`,`adresse_principale`,`adresse_facturation`,`adresse_livraison`,`adresse_postale`) VALUES (
                    ".$rue1.",
                    ".$rue2.",
                    ".$rue3.",
                    ".$code_postal.",
                    ".$ville.",
                    ".$pays.",
                    ".$id.",
                    '".true."',
                    '".$idem_fact."',
                    '".false."',
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

                    $insert_adresse="INSERT INTO `sigma`.`adresse` (`rue_1`,`rue_2`,`rue_3`,`code_postal`,`ville`,`pays`,`ref_fournisseur`,`adresse_principale`,`adresse_facturation`,`adresse_livraison`,`adresse_postale`) VALUES (
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
                
                    $insert_adresse="INSERT INTO `sigma`.`adresse` (`rue_1`,`rue_2`,`rue_3`,`code_postal`,`ville`,`pays`,`ref_fournisseur`,`adresse_principale`,`adresse_facturation`,`adresse_livraison`,`adresse_postale`) VALUES (
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
            $code_fournisseur=(empty($row['code_fournisseur']))?"NULL":"'".addslashes($row['code_fournisseur'])."'";
            $code_client=(empty($row['code_client']))?"NULL":"'".addslashes($row['code_client'])."'";
            $raison_sociale=(empty($row['raison_sociale']))?"NULL":"'".addslashes($row['raison_sociale'])."'";
            $date_creation=(empty($row['date_creation']))?"NULL":"'".addslashes($row['date_creation'])."'";
            $effectif_salarie=(empty($row['effectif']))?"NULL":"'".addslashes($row['effectif'])."'";
            $telephone=(empty($row['telephone']))?"NULL":"'".addslashes($row['telephone'])."'";
            $fax=(empty($row['fax']))?"NULL":"'".addslashes($row['fax'])."'";
            $site_web=(empty($row['url']))?"NULL":"'".addslashes($row['url'])."'";
            $email=(empty($row['email']))?"NULL":"'".addslashes($row['email'])."'";
            $date_maj="'".date('Y-m-d H:i:s')."'";
            $numero_tva=(empty($row['numero_tva']))?"NULL":"'".addslashes($row['numero_tva'])."'";
            $numero_siret=(empty($row['numero_siret']))?"NULL":"'".addslashes($row['numero_siret'])."'";
            $numero_ape=(empty($row['numero_ape']))?"NULL":"'".addslashes($row['numero_ape'])."'";
            $id_activite="NULL";
            $id_categorie="NULL";
            $id_condition_reglement="NULL";
            $id_mode_reglement="NULL";
            $id_poste="NULL";

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
                    }
                }
            }
            if(!empty($row['poste_par_defaut']))
            {
                $poste=addslashes($row['poste_par_defaut']);
                $qcp="SELECT id FROM `sigma`.poste WHERE ref_intitule_poste = '".$poste."'";
                $rcp=mysql_query($qcp,$connection);

                if(mysql_num_rows($rcp)>0)
                {
                    while( $data=mysql_fetch_array($rcp) )
                    {
                        $id_poste=intval($data['id']);
                    }
                }
            }

            if(!empty($row['ref_activite']))
            {
                $ref_activite=intval($row['ref_activite']);
                $qca="SELECT id FROM `sigma`.activite_fournisseur WHERE id = '".$ref_activite."'";
                $rca=mysql_query($qca,$connection);

                if(mysql_num_rows($rca)>0)
                {
                    while( $data=mysql_fetch_array($rca) )
                    {
                        $id_activite=intval($data['id']);
                    }
                }
            }
            else if(!empty($row['activite']))
            {
                $activite=addslashes($row['activite']);
                $qca="SELECT id FROM `sigma`.activite_fournisseur WHERE intitule_activite = '".$activite."'";
                $rca=mysql_query($qca,$connection);

                if(mysql_num_rows($rca)>0)
                {
                    while( $data=mysql_fetch_array($rca) )
                    {
                        $id_activite=intval($data['id']);
                    }
                }
            }
            
            if(!empty($row['categorie']))
            {
                $categorie=addslashes($row['categorie']);
                $qcat="SELECT id FROM `sigma`.categorie_fournisseur WHERE intitule_categorie_fournisseur = '".$categorie."'";
                $rcat=mysql_query($qcat,$connection);

                if(mysql_num_rows($rcat)>0)
                {
                    while( $data=mysql_fetch_array($rcat) )
                    {
                        $id_categorie=intval($data['id']);
                    }
                }
            }
            
            // Requète d'insertion fournisseur
            $insert_fournisseur="INSERT INTO `sigma`.`fournisseur`(
                `id`,
                `code_fournisseur`,
                `code_client`,
                `raison_sociale`,
                `telephone`,
                `fax`,
                `site_web`,
                `email`,
                `date_creation_modification_fiche`,
                `numero_tva`,
                `numero_siret`,
                `numero_ape`,
                `ref_categorie`,
                `ref_activite`,
                `ref_mode_reglement`,
                `ref_condition_reglement`,
                `ref_poste_par_defaut`
            ) VALUES (
                ".$id.",
                ".$code_fournisseur.",
                ".$code_client.",
                ".$raison_sociale.",
                ".$telephone.",
                ".$fax.",
                ".$site_web.",
                ".$email.",
                ".$date_maj.",
                ".$numero_tva.",
                ".$numero_siret.",
                ".$numero_ape.",
                ".$id_categorie.",
                ".$id_activite.",
                ".$id_mode_reglement.",
                ".$id_condition_reglement.",
                ".$id_poste."
            );";

            // Exécution de la requète
            $result_fournisseur=mysql_query($insert_fournisseur);

            if(!$result_fournisseur)
            {
                echo "Impossible d'exécuter la requête ($insert_fournisseur) dans la base : " . mysql_error();
                exit;
            }
            
        }

        \Zend\Debug\Debug::dump('Imporatation terminée');die();
        mysql_close($connection);
	
?>