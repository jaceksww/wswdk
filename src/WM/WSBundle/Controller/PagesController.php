<?php

namespace WM\WSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\Query;
use AppBundle\Utils;

class PagesController extends Controller
{
    public function indexAction($parentid=0)
    {
        
        $repository = $this->getDoctrine()
        ->getRepository('WMWSBundle:HaPages');
	
	if($parentid!='0')
	{
	    $query = $repository->createQueryBuilder('p')
	    ->select("p.pagename,p.uri, p.pageid, pb.body, p.title, p.description, p.keywords, p.datecreated, p.mainimage") 
	    ->where("p.parentid = :parentid")
	    ->leftJoin("WMWSBundle:HaPageBlocks", "pb", "WITH", "p.versionid=pb.versionid")
	    //->addSelect("pb") 
	    ->setParameter('parentid', $parentid)
	   // ->orderBy('p.price', 'ASC')
	    ->getQuery();
	}else{
	    $query = $repository->createQueryBuilder('pages')
	    //->where("pages.parentid = :parentid")
	    //->setParameter('parentid', $parentId)
	   // ->orderBy('p.price', 'ASC')
	    ->getQuery();
	}
        $pages = $query->getResult(Query::HYDRATE_ARRAY);
	//$pages = $this->get("app.arrays")->utf8_encode_deep($pages);
       
       $this->get("app.arrays")->utf8_encode_deep($pages);
        $response = new Response(json_encode($pages));
	
        $response->headers->set('Content-Type', 'application/json');

        return $response;
        
    }
	
	public function viewAction($pageid=0)
    {
        
        $repository = $this->getDoctrine()
        ->getRepository('WMWSBundle:HaPages');
	$page = array();
	if($pageid!='0')
	{
	    if(is_numeric($pageid))
	    {
		$query = $repository->createQueryBuilder('p')
		->select("p.pagename, p.uri, p.pageid, pb.body, p.title, p.description, p.keywords, p.datecreated, p.mainimage") 
		->where("p.pageid = :pageid")
		->leftJoin("WMWSBundle:HaPageBlocks", "pb", "WITH", "p.versionid=pb.versionid")
		//->addSelect("pb") 
		->setParameter('pageid', $pageid)
	       // ->orderBy('p.price', 'ASC')
		->getQuery();
	    }else{
		$pageid = str_replace('-_-', '/', $pageid);
		$query = $repository->createQueryBuilder('p')
		->select("p.pagename, p.uri, p.pageid, pb.body, p.title, p.description, p.keywords, p.datecreated, p.mainimage") 
		->where("p.uri = :uri")
		->leftJoin("WMWSBundle:HaPageBlocks", "pb", "WITH", "p.versionid=pb.versionid")
		//->addSelect("pb") 
		->setParameter('uri', $pageid)
	       // ->orderBy('p.price', 'ASC')
		->getQuery();
	    }
	}
        $page = $query->getResult(Query::HYDRATE_ARRAY);
	   
       $this->get("app.arrays")->utf8_encode_deep($page);
        $response = new Response(json_encode($page));
	
        $response->headers->set('Content-Type', 'application/json');

        return $response;
        
    }
    
}
