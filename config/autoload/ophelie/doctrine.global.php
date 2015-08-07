<?php
/**
 * @Author: Ophelie
 * @Date:   2015-05-20 14:08:21
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-05-20 14:15:10
 */

return array(
	'doctrine'=>array(
		'connection'=>array(
			'orm_default'=>array(
				'driverClass'=>'Doctrine\DBAL\Driver\PDOMySQL\Driver',
				'params'=>array(
					'host'=>'localhost',
					'port'=>'3306',
					'dbname'=>'sigma'
				)
			)
		)
	)
);

?>