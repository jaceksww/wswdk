<?php

namespace WM\WSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\Query;
use AppBundle\Utils;
use WM\WSBundle\Entity\HaUsers;
use WM\WSBundle\Entity\HaInfos;
use DateTime;

class InfosController extends Controller
{
    public function indexAction($userid,$start, $limit)
    {
        $infos1 = array();
        
        $repository = $this->getDoctrine()
        ->getRepository('WMWSBundle:HaInfos');
        
		$query2 = $repository->createQueryBuilder('i')
		->select('i.infoid')
	    ->where("i.userid = :userid and i.new=1")
		->setParameter('userid', $userid)
	    ->getQuery();
	
        $infos_count = $query2->getResult(Query::HYDRATE_ARRAY);
		$count_unread = count($infos_count);
        $infos1[]['unread'] = $count_unread;
        
	
	    $query = $repository->createQueryBuilder('i')
	    ->where("i.userid = :userid")
	    ->setMaxResults($limit)
			->setFirstResult($start)
	    ->setParameter('userid', $userid)
	    ->orderBy('i.infoid', 'DESC')
	    ->getQuery();
	
        $infos2 = $query->getResult(Query::HYDRATE_ARRAY);
		
		$infos = array_merge($infos1, $infos2);
		
        $this->get("app.arrays")->utf8_encode_deep($infos);
        $response = new Response(json_encode($infos));
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
    }
    
}
