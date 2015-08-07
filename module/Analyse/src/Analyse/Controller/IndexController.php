<?php
/**
 * @Author: Ophelie
 * @Date:   2015-06-11 11:15:09
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-06-11 11:26:09
 */


namespace Analyse\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
// EntityManager
use Doctrine\ORM\EntityManager;

class IndexController extends AbstractActionController
{
    /**
     * Entity Manager
     * @var DoctrineORMEntityManager
     */
    protected $em;

    public function getEntityManager()
    {
        if(null===$this->em)
        {
            $this->em=$this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }

    public function setEntityManager(EntityManager $em)
    {
        $this->em=$em;
    }

    public function indexAction()
    {
    	//Assignation de variables au layout
		$this->layout()->setVariables(array(
			'headTitle'			=>  $this->getServiceLocator()->get('Translator')->translate('Analyses'),
			'breadcrumbActive'	=>	$this->getServiceLocator()->get('Translator')->translate('Analyses'),
			'route'				=>	array('Analyses'),
			'action'			=>	'analyses',
			'module'			=>	'analyse',
			'plugins'			=>	array(),
			//'userId'			=>	$userId,
			//'login'			=>	$login,									
		));

    	return new ViewModel();
    }
}

?>