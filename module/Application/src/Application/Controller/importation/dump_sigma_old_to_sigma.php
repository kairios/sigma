<?php
/**
 * @Author: Ophelie
 * @Date:   2015-06-01 11:54:57
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-06-01 12:00:31
 */
set_time_limit(0);
$serveur='localhost';
$utilisateur='root';
$mdp=null;
$base='sigma-old';
$connection=mysql_connect($serveur, $utilisateur, $mdp);
mysql_select_db($base,$connection);
mysql_set_charset('utf8',$connection);

//On récupère les tables du dev
$tableDev=array();
$r="show tables from $base";
$res=mysql_query($r,$connection);
while( $data=mysql_fetch_array($res) )
{
	if( preg_match('/IPI_/',$data['Tables_in_sigma-old']) )
		$tableDev[]=$data['Tables_in_sigma-old'];
}
/*
echo '<pre>';
	var_dump($tableDev);
echo '</pre>';
*/

//On récupère les tables de la test
$tableTest=array();
$r="show tables from ida_user_test";
$res=mysql_query($r,$connection);
while( $data=mysql_fetch_array($res) )
{
	if( preg_match('/IPI_/',$data['Tables_in_ida_user_test']) )
		$tableTest[]=$data['Tables_in_ida_user_test'];
}

/*
echo '<pre>';
	var_dump($tableTest);
echo '</pre>';
*/

$tables=array();
if( count($tableTest)>0 )
{
	foreach( $tableTest as $table )
	{
		if( in_array($table,$tableDev) )
			$tables[]=$table;
	}
}



$tables=array(
	'IPI_AGREEMENT',
	'IPI_AGREEMENT_TERRITORY',
	'IPI_INFORMATION',

	'IPI_NAME',
	'IPI_NATIONALITY',
	'IPI_REMARK',
	'IPI_STATUS_HISTORY',
	'IPI_TERRITORY',
	'IPI_USAGE'
	
);

/*echo 'Les tables a traitées sont :';
echo '<pre>';
	var_dump($tables);
echo '</pre>';
die;*/


if( count($tables)>0 )
{
	foreach( $tables as $table )
	{
		$query="truncate ida_user_test.".$table;
		echo $query.="\n";
		$boolTruncate=mysql_query($query,$connection);
		if( $boolTruncate!=true )
		{
			die("Erreur lors d'un truncate avec la requête ".$query);
		}
		else
		{
			echo "Le truncate a été effectué avec succès sur la table ".$table."\n";
			
			$query2="insert into ida_user_test.".$table." SELECT * FROM ida_dev.".$table;
			echo $query2.="\n";
			$boolInsert=mysql_query($query2,$connection);
			if( $boolInsert!=true )
			{
				die("Erreur lors d'un insert avec la requête ".$query2);
			}
			else
			{
				echo "L' insert a été effectué avec succès sur la table ".$table."\n";
			}
		}
	}
}

mysql_close($connection);
?>