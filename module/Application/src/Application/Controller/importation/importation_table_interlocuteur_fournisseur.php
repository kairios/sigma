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

        // Suppression des données des tables sigma.interlocuteur_fournisseur
        $truncate="TRUNCATE `sigma`.`interlocuteur_fournisseur`";
        $boolTruncate=mysql_query($truncate,$connection);
        if( $boolTruncate!=true )
        {
            die("Erreur lors d'un truncate avec la requête ".$truncate." : ".mysql_error());
        }
        echo 'Réinitialisation de la table interlocuteur_fournisseur terminée</br>';

        //On récupère les lignes de l'ancienne table tbl_interlocuteur
        $rows=array();
        $query="SELECT * FROM `sigma-old`.tbl_interlocuteur_fournisseur";
        $result=mysql_query($query,$connection);
        while($row=mysql_fetch_array($result))
        {
            // Données du fournisseur
            $id=intval($row['ref_interlocuteur']);
            $id_societe=intval($row['ref_societe']);
            $nom=(empty($row['nom']))?"NULL":"'".addslashes($row['nom'])."'";
            $prenom=(empty($row['prenom']))?"NULL":"'".addslashes($row['prenom'])."'";
            $telephone=(empty($row['telephone']))?"NULL":"'".addslashes($row['telephone'])."'";
            $portable=(empty($row['portable']))?"NULL":"'".addslashes($row['portable'])."'";
            $email=(empty($row['email']))?"NULL":"'".addslashes($row['email'])."'";
            $civilite=(empty($row['titre_civilite']))?"NULL":"'".addslashes($row['titre_civilite'])."'";
            $fax=(empty($row['fax_direct']))?"NULL":"'".addslashes($row['fax_direct'])."'";
            $envoi_vers_outlook=$row['envoi_vers_outlook']=='FAUX'?0:1;
            $id_fonction="NULL";
            $complement="NULL";

            // Récupération des clés étrangères en BD
            if(!empty($row['fonction']))
            {
                $fonction=addslashes($row['fonction']);
                $query_fonction="SELECT id FROM `sigma`.fonction_interlocuteur WHERE intitule_fonction = '".$fonction."'";
                $result_fonction=mysql_query($query_fonction,$connection);

                if(mysql_num_rows($result_fonction)>0)
                {
                    while( $data=mysql_fetch_array($result_fonction) )
                    {
                        $id_fonction=intval($data['id']);
                        if($id_fonction==0)$id_fonction="NULL";
                    }
                }
                else
                {
                    $complement="'".$fonction."'";
                }
            }

            //\Zend\Debug\Debug::dump($id_fonction);die();

            $date_fiche="'".date('Y-m-d H:i:s')."'";
            /*if(!empty($row['date_creation_modification_fiche']))
                echo date('Y-m-d H:i:s',$row['date_creation_modification_fiche']);*/
            
            // Requète d'insertion fournisseur
            $insert_interlocuteur="INSERT INTO `sigma`.`interlocuteur_fournisseur`(
                `id`,
                `nom`,
                `prenom`,
                `telephone`,
                `portable`,
                `email`,
                `fax`,
                `date_creation_modification_fiche`,
                `titre_civilite`,
                `envoi_vers_outlook`,
                `ref_fonction`,
                `ref_societe_fournisseur`,
                `complement`
            ) VALUES (
                ".$id.",
                ".$nom.",
                ".$prenom.",
                ".$telephone.",
                ".$portable.",
                ".$email.",
                ".$fax.",
                ".$date_fiche.",
                ".$civilite.",
                '".$envoi_vers_outlook."',
                ".$id_fonction.",
                ".$id_societe.",
                ".$complement."
            );";

            // Exécution de la requète
            $result_interlocuteur=mysql_query($insert_interlocuteur);

            if(!$result_interlocuteur)
            {
                echo "Impossible d'exécuter la requête ($insert_interlocuteur) dans la base : </br>" . mysql_error().'</br>';
                exit;
            } 
        }

        \Zend\Debug\Debug::dump('</br>Imporatation terminée');die();
        mysql_close($connection);
?>