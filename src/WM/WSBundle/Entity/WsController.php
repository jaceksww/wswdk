<?php

namespace WM\WSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\Query;
use AppBundle\Utils;
use WM\WSBundle\Entity\HaWs;
use WM\WSBundle\Entity\HaImages;
use WM\WSBundle\Entity\HaWsGalleries;
use WM\WSBundle\Entity\HaWsWsSubjects;
use DateTime;

class WsController extends Controller
{
    public function indexAction($type, $start=0, $limit=20, $userid=0)
    {
		
        $repository = $this->getDoctrine()
        ->getRepository('WMWSBundle:HaWs');
    
	if($type=='WWW')
	{
		if($userid == 0){
			$query = $repository->createQueryBuilder('ws')
			->where("ws.wwwtitle <> 'GALERIA' and ws.wwwtitle <> 'REJESTR'")
			
			->setMaxResults($limit)
			->setFirstResult($start)
			->orderBy('ws.datecreated', 'DESC')
			->getQuery();
		}else{
			$query = $repository->createQueryBuilder('ws')
			->where("ws.wwwtitle <> 'GALERIA' and ws.wwwtitle <> 'REJESTR' and ws.userid = :userid")
			->setParameter('userid', $userid)
			->setMaxResults($limit)
			->setFirstResult($start)
			->orderBy('ws.datecreated', 'DESC')
			->getQuery();
		}
	}elseif($type == 'REJESTR'){
		if($userid == 0){
			$query = $repository->createQueryBuilder('ws')
			->where("ws.wwwtitle = :type and ws.parentid <> 0")
			->setParameter('type', $type)
				->setParameter('userid', $userid)
			->setMaxResults($limit)
			->setFirstResult($start)
			->orderBy('ws.datecreated', 'DESC')
			->getQuery();
		}else{
			$query = $repository->createQueryBuilder('ws')
			->where("ws.wwwtitle = :type and ws.parentid <> 0 and ws.userid = :userid")
			->setParameter('type', $type)
				->setParameter('userid', $userid)
			->setMaxResults($limit)
			->setFirstResult($start)
			->orderBy('ws.datecreated', 'DESC')
			->getQuery();
		}
	}elseif($type == 'REJESTR_LOWISKO'){
		
		if($userid == 0){
			$query = $repository->createQueryBuilder('ws')
			->where("ws.wwwtitle = :type and ws.parentid = 0")
			->setParameter('type', $type)
				->setParameter('userid', $userid)
			->setMaxResults($limit)
			->setFirstResult($start)
			->orderBy('ws.datecreated', 'DESC')
			->getQuery();
		}else{
			$query = $repository->createQueryBuilder('ws')
			->where("ws.wwwtitle = :type and ws.parentid = 0 and ws.userid = :userid")
			->setParameter('type', 'REJESTR')
			->setParameter('userid', $userid)
			->setMaxResults($limit)
			->setFirstResult($start)
			->orderBy('ws.datecreated', 'DESC')
			->getQuery();
		}
	}else{
		if($userid == 0){
			$query = $repository->createQueryBuilder('ws')
			->where("ws.wwwtitle = :type")
			->setParameter('type', $type)
			//->setParameter('price', '19.99')
			->setParameter('userid', $userid)
			->setMaxResults($limit)
			->setFirstResult($start)
			->orderBy('ws.datecreated', 'DESC')
			->getQuery();
		}else{
			$query = $repository->createQueryBuilder('ws')
			->where("ws.wwwtitle = :type and ws.userid = :userid")
			//->setParameter('price', '19.99')
			->setMaxResults($limit)
			->setFirstResult($start)
			->orderBy('ws.datecreated', 'DESC')
			->getQuery();
		}
	}
        $ws = $query->getResult(Query::HYDRATE_ARRAY);
       //print_r($ws);
       
       $this->get("app.arrays")->utf8_encode_deep($ws);
       //print_r($ws_uft8);
        $response = new Response(json_encode($ws));
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
        
    }
    
    public function getwwwAction($wwwid=0, $comments = true)
    {
        $repository = $this->getDoctrine()
        ->getRepository('WMWSBundle:HaWs');
		
	    $query = $repository->createQueryBuilder('ws')
	    ->where("ws.wwwid = :wwwid")
	    ->setParameter('wwwid', $wwwid)
	   // ->orderBy('p.price', 'ASC')
	    ->getQuery();
	
        $www = $query->getResult(Query::HYDRATE_ARRAY);
		$this->get("app.arrays")->utf8_encode_deep($www);
		
		if($comments){
			$repository = $this->getDoctrine()
		   ->getRepository('WMWSBundle:HaWsComments');
		   
		   $query = $repository->createQueryBuilder('wsc')
		   ->where("wsc.wwwid = :wwwid")
		   ->setParameter('wwwid', $wwwid)
		   ->orderBy('wsc.datecreated', 'DESC')
		   ->getQuery();
	   
		   $www_comments = $query->getResult(Query::HYDRATE_ARRAY);
		   $this->get("app.arrays")->utf8_encode_deep($www_comments);
			$www['comments'] = $www_comments;
		}
		
        $response = new Response(json_encode($www));
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
        
    }
	
	public function subjectsAction()
    {
        $repository = $this->getDoctrine()
        ->getRepository('WMWSBundle:HaWsSubjects');
		
	    $query = $repository->createQueryBuilder('wss')
	    ->getQuery();
	
        $wssubjects = $query->getResult(Query::HYDRATE_ARRAY);
		$this->get("app.arrays")->utf8_encode_deep($wssubjects);
		
		$response = new Response(json_encode($wssubjects));
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
        
    }
    
	
	public function subjects2Action()
    {
        $repository = $this->getDoctrine()
        ->getRepository('WMWSBundle:HaWsSubjects2');
		
	    $query = $repository->createQueryBuilder('wss2')
	    ->getQuery();
	
        $wssubjects2 = $query->getResult(Query::HYDRATE_ARRAY);
		$this->get("app.arrays")->utf8_encode_deep($wssubjects2);
		
		$response = new Response(json_encode($wssubjects2));
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
        
    }
    public function categoriesAction()
    {
        $repository = $this->getDoctrine()
        ->getRepository('WMWSBundle:HaCategories');
		
	    $query = $repository->createQueryBuilder('c')
	    ->orderBy('c.ordering', 'ASC')
	    ->getQuery();
	
        $wscats = $query->getResult(Query::HYDRATE_ARRAY);
		$this->get("app.arrays")->utf8_encode_deep($wscats);
		
		$response = new Response(json_encode($wscats));
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
        
    }
	public function usergalleriesAction($userid=0)
    {
        $repository = $this->getDoctrine()
        ->getRepository('WMWSBundle:HaWsGalleries');
		
	    $query = $repository->createQueryBuilder('wsg')
		->where("wsg.userid = :userid")
		   ->setParameter('userid', $userid)
	    ->getQuery();
	
        $wsgalleries = $query->getResult(Query::HYDRATE_ARRAY);
		$this->get("app.arrays")->utf8_encode_deep($wsgalleries);
		
		$response = new Response(json_encode($wsgalleries));
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
        
    }
	
	public function addgalleryAction($params=array())
    {
	
	if(empty($params))
		$post = $_POST;
	else
		$post = $params;
	
	$resp['error'] = array();
        if( empty($post['galleryName']) ){
			$resp['error'][] = 'Nie wpisałeś nazwy galerii';
        }
	if(empty($resp['error'])){
	    $ws_galleries = new HaWsGalleries();
	    $ws_galleries->setUserid($post['userID']);
	    $ws_galleries->setGalleryname($post['galleryName']);
		$ws_galleries->setOrdering(100);
		$ws_galleries->setBanners(0);
	    $em = $this->getDoctrine()->getManager();
	
	    $em->persist($ws_galleries);
	    $em->flush();
		$galleryID = $ws_galleries->getGalleryid();
	    $resp['success'][] = 'Galeria została dodana';
		$resp['galleryid'] = $galleryID;
		$resp['galleryname'] = $post['galleryName'];
	}
	//$resp = $post;
		
			$this->get("app.arrays")->utf8_encode_deep($resp);
			$response = new Response(json_encode($resp));
			$response->headers->set('Content-Type', 'application/json');
			return $response;
		
        
    }
	
	public function addgalleryimageAction()
    {
	
		$post = $_POST;
	
		$resp['error'] = array();
	    if( empty($post['imageName']) || empty($post['base64'])){
			$resp['error'][] = 'Nazwa i plik są obowiązkowe';
        }
		if(empty($resp['error'])){
		$folderID = $post['userID'];
		
		$rand = substr(md5(rand(111,9999)),0,30);
		$imageName = $rand;
		$imageRef = $this->get("app.commons")->url_title(trim(substr(strtolower($imageName),0,30)));
		$fileData = explode('.',$post['imageName']);
		$fileExt = $fileData[count($fileData)-1];
		$imageName .= '.'.$fileExt;
		
		$images = new HaImages();
		$images->setClass ('default');
		$images->setImageref( $imageRef);
		$images->setImagename($imageRef);
		$images->setFilename($imageName);
		$images->setDatecreated(new DateTime("now"));
		$images->setUserid($post['userID']);
		$images->setFolderid($post['userID']);
		$images->setGroupid(0);
		$images->setFilesize(0);
		$images->setDeleted(0);
		$images->setSiteid(1);
		//upload image
		$file = '../../wedkarstwo.mobi/static/uploads/'.$_POST['userID'].'/'.$imageName;
		$base64 = $_POST['base64'];
		$this->get("app.files")->base64_to_jpeg($base64, $file);
		
		$file = '../../wedkarstwo.mobi/static/uploads/'.$_POST['userID'].'/'.$imageRef.'_thumb.'.$fileExt;
		$base64 = $_POST['base64'];
		$this->get("app.files")->base64_to_jpeg($base64, $file);
		
		$resp['success'][] = 'Zapisano plik';
		$em = $this->getDoctrine()->getManager();
	    $em->persist($images);
	    $em->flush();
		
	
	    $ws = new HaWs();
		$ws->setWwwtitle('GALERIA');
		$ws->setDatecreated(new DateTime("now"));
		$ws->setDescription($imageRef.".".$fileExt);
		$ws->setWwwdate(new DateTime("now"));
		if(!empty($post['tags']))
			$ws->setTags(trim(strtolower($post['tags'])));
		$ws->setUserid($post['userID']);
		//$ws->setWwwid = $post['wwwID'];
		$ws->setMobile(0);
		if(!empty($post['banners']) && $post['banners'] == 1)
		{
		$ws->setGallerycat($post['galleryCatBanners']);
		}else{
		$ws->setGallerycat($post['galleryCat']);	
		}
		$ws->setGroupid(0);
		$ws->setPublished(1);
		$ws->setSiteid(1);	
		$ws->setParentid(0);
		$ws->setDeleted(0);
		
		$em = $this->getDoctrine()->getManager();
		$em->persist($ws);
	    $em->flush();
		
		$wwwID = $ws->getWwwid();
		
		$subjects = $post['subject'];
		if(!is_array($subjects)){
			$subjects = explode('|', $subjects);
		}
		if(!empty($subjects))
		{
			foreach($subjects as $subj){
				$wssubject = new HaWsWsSubjects();
				$wssubject->setWsid($wwwID);
				$wssubject->setWsSubjectRef($subj);
				$em->persist($wssubject);
				$em->flush();
			}
		}
		
	
	    $resp['success'][] = 'Zdjęcie dodano pomyślnie';
	}
	//$resp = $post;
	$this->get("app.arrays")->utf8_encode_deep($resp);
        $response = new Response(json_encode($resp));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
        
    }
    
    public function addwwwAction()
    {
	
	$post = $_POST;
	
	$resp['error'] = array();
	if( empty($post['wwwTitle']) || empty($post['userID'])){
	    $resp['error'][] = 'Tytuł i User jest obowiązkowy';
        }
	 
	if(empty($resp['error']))
	{
		$mainimage='';
		if(!empty($post['base64'])){
		    $folderID = $post['userID'];
		    
		    $rand = substr(md5(rand(111,9999)),0,30);
		    $imageName = $rand;
		    $imageRef = $this->get("app.commons")->url_title(trim(substr(strtolower($imageName),0,30)));
		    $fileData = explode('.',$post['imageName']);
		    $fileExt = $fileData[count($fileData)-1];
		    $imageName .= '.'.$fileExt;
		    
		    $images = new HaImages();
		    $images->setClass ('default');
		    $images->setImageref( $imageRef);
		    $images->setImagename($imageRef);
		    $images->setFilename($imageName);
		    $images->setDatecreated(new DateTime("now"));
		    $images->setUserid($post['userID']);
		    $images->setFolderid($post['userID']);
		    $images->setGroupid(0);
		    $images->setFilesize(0);
		    $images->setDeleted(0);
		    $images->setSiteid(1);
		    //upload image
		    $file = '../../wedkarstwo.mobi/static/uploads/'.$post['userID'].'/'.$imageName;
		    $base64 = $_POST['base64'];
		    $this->get("app.files")->base64_to_jpeg($base64, $file);
		    
		    $file = '../../wedkarstwo.mobi/static/uploads/'.$_POST['userID'].'/'.$imageRef.'_thumb.'.$fileExt;
		    $base64 = $_POST['base64'];
		    $this->get("app.files")->base64_to_jpeg($base64, $file);
		    
		    $resp['success'][] = 'Zapisano plik';
		    $em = $this->getDoctrine()->getManager();
		    $em->persist($images);
		    $em->flush();
		    $mainimage = $imageName;
		}
		
		$galleryCat = 0;
		/*
		if(!empty($post['galleryCat']))
		{
		    $galParams = array('galleryName'=>'Galeria dla '.$post['wwwTitle'], 'userID'=>$post['userID']);
		    $galleryCat = $this->addgalleryAction($galParams);
		    $galleryCat = json_decode($galleryCat->getContent());
		    $galleryCat = $galleryCat->galleryID;
		}
		*/
		
		$em = $this->getDoctrine()->getManager();
		if(!empty($post['wwwID']) && $post['wwwID'] != 0){
			$ws = $em->find('HaWs',$post['wwwID']);
		}else{
			$ws = new HaWs();
		}
		$ws->setWwwtitle($post['wwwTitle']);
		if(empty($post['description'])){
			$post['description'] = '';
		}
		$ws->setGallerycat($galleryCat);
		$ws->setDescription($post['description']);
		$ws->setExcerpt(substr($post['description'],0,200));
		$ws->setDatecreated(new DateTime("now"));
		$ws->setWwwdate(new DateTime("now"));
		if(!empty($post['tags']))
			$ws->setTags(trim(strtolower($post['tags'])));
		if(!empty($post['galleryCat']))
			$ws->setGallerycat($post['galleryCat']);
		$ws->setUserid($post['userID']);
		//$ws->setWwwid = $post['wwwID'];
		$ws->setMobile(0);
		$ws->setMainimage($mainimage);
		$ws->setGroupid(0);
		$ws->setPublished(1);
		$ws->setSiteid(1);	
		$ws->setParentid(0);
		$ws->setDeleted(0);
		$catID = 0;
		if(!empty($post['categoryID'])){
			$catID = $post['categoryID'];
		}
		$ws->setCategoryId($catID);
		
		$em = $this->getDoctrine()->getManager();
		$em->persist($ws);
	    $em->flush();
		
		$wwwID = $ws->getWwwid();
		
		$resp['gal'] = $galleryCat;
	
	    $resp['success'][] = 'Artykuł dodano pomyślnie';
	}
	//$resp = $post;
	$this->get("app.arrays")->utf8_encode_deep($resp);
        $response = new Response(json_encode($resp));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
        
    }
	
	/*REJESTR*/
	public function addregisterfisheryAction()
    {
	
		$post = $_POST;
	
		$resp['error'] = array();
	    if( empty($post['description2'])){
			$resp['error'][] = 'Nazwa łowiska obowiązkowa';
        }
		if(empty($resp['error'])){
		$folderID = $post['userID'];
		
		if(!empty($post['imageName']))
		{
			$rand = substr(md5(rand(111,9999)),0,30);
			$imageName = $rand;
			$imageRef = $this->get("app.commons")->url_title(trim(substr(strtolower($imageName),0,30)));
			$fileData = explode('.',$post['imageName']);
			$fileExt = $fileData[count($fileData)-1];
			$imageName .= '.'.$fileExt;
			
			$images = new HaImages();
			$images->setClass ('default');
			$images->setImageref( $imageRef);
			$images->setImagename($imageRef);
			$images->setFilename($imageName);
			$images->setDatecreated(new DateTime("now"));
			$images->setUserid($post['userID']);
			$images->setFolderid($post['userID']);
			$images->setGroupid(0);
			$images->setFilesize(0);
			$images->setDeleted(0);
			$images->setSiteid(1);
			//upload image
			$file = '../../wedkarstwo.mobi/static/uploads/'.$_POST['userID'].'/'.$imageName;
			$base64 = $_POST['base64'];
			$this->get("app.files")->base64_to_jpeg($base64, $file);
			
			$file = '../../wedkarstwo.mobi/static/uploads/'.$_POST['userID'].'/'.$imageRef.'_thumb.'.$fileExt;
			$base64 = $_POST['base64'];
			$this->get("app.files")->base64_to_jpeg($base64, $file);
			
			$resp['success'][] = 'Zapisano plik';
			$em = $this->getDoctrine()->getManager();
			$em->persist($images);
			$em->flush();
		}
	
	    $ws = new HaWs();
		$ws->setWwwtitle('REJESTR');
		$ws->setDatecreated(new DateTime("now"));
		if(!empty($post['imageName'])) $ws->setDescription($imageRef.".".$fileExt);
		$ws->setDescription2($post['description2']);
		if(!empty($post['excerpt'])) $ws->setExcerpt($post['excerpt']);
		$ws->setWwwdate(new DateTime("now"));
		if(!empty($post['tags']))
			$ws->setTags(trim(strtolower($post['tags'])));
		$ws->setUserid($post['userID']);
		$ws->setFolderid($post['userID']);
		//$ws->setWwwid = $post['wwwID'];
		$ws->setMobile(0);
		
		$ws->setGroupid(0);
		$ws->setPublished(1);
		$ws->setSiteid(1);	
		$ws->setParentid(0);
		$ws->setDeleted(0);
		
		$em = $this->getDoctrine()->getManager();
		$em->persist($ws);
	    $em->flush();
		
		$wwwID = $ws->getWwwid();
	    $resp['wwwid'] = $wwwID;
	    $resp['description2'] = $post['description2'];
	    $resp['success'][] = 'Łowisko dodano pomyślnie';
	}
	//$resp = $post;
	$this->get("app.arrays")->utf8_encode_deep($resp);
        $response = new Response(json_encode($resp));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
        
    }
}
