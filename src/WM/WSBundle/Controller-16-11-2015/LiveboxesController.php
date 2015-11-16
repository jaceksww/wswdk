<?php

namespace WM\WSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\Query;
use AppBundle\Utils;

class LiveboxesController extends Controller
{
    public function indexAction($weekstart=0, $numberofdays=7)
    {
        
	$datestart = date('Y-m-d H:i:s', strtotime('-'.($weekstart*7).' days'));
	$dateend = date('Y-m-d H:i:s', strtotime('-'.($weekstart*7) - $numberofdays.' days'));
	
	
	$liveboxes_arr = array();
	
		//WS
        $repository = $this->getDoctrine()
        ->getRepository('WMWSBundle:HaWs');
	
		$query = $repository->createQueryBuilder('ws')
	    ->select("ws.wwwtitle,ws.wwwid,ws.mainimage,ws.countcomments,ws.countimages, ws.description, ws.excerpt, ws.datecreated, u.displayname")
	    ->leftJoin("WMWSBundle:HaUsers", "u", "WITH", "u.userid=ws.userid")
	    ->where("(ws.datecreated <= :datestart and ws.datecreated > :dateend) and ( ws.wwwtitle <> 'GALERIA' and ws.wwwtitle <> 'REJESTR') ")
	    //->addSelect("pb") 
	    ->setParameter('datestart', $datestart)
	    ->setParameter('dateend', $dateend)
	    ->orderBy('ws.datecreated', 'DESC')
	    ->getQuery();
	
        $ws = $query->getResult(Query::HYDRATE_ARRAY);
		foreach($ws as $www){
			$www['type']='WWW';
			$liveboxes_arr[strtotime($www['datecreated']->format('Y-m-d H:i:s'))] = $www;
		}
		
		//GALERIA
        $repository = $this->getDoctrine()
        ->getRepository('WMWSBundle:HaWs');
	
		$query = $repository->createQueryBuilder('ws')
	    ->select("ws.wwwtitle,ws.wwwid,ws.mainimage,ws.countcomments,ws.countimages, ws.description, ws.excerpt, ws.datecreated, u.displayname")
	    ->leftJoin("WMWSBundle:HaUsers", "u", "WITH", "u.userid=ws.userid")
	    ->where("(ws.datecreated <= :datestart and ws.datecreated > :dateend) and ( ws.wwwtitle = 'GALERIA') ")
	    //->addSelect("pb") 
	    ->setParameter('datestart', $datestart)
	    ->setParameter('dateend', $dateend)
	    ->orderBy('ws.datecreated', 'DESC')
	    ->getQuery();
	
        $ws = $query->getResult(Query::HYDRATE_ARRAY);
		foreach($ws as $www){
			$www['type']='GALERIA';
			$liveboxes_arr[strtotime($www['datecreated']->format('Y-m-d H:i:s'))] = $www;
		}
		
		//REJESTR
        $repository = $this->getDoctrine()
        ->getRepository('WMWSBundle:HaWs');
	
		$query = $repository->createQueryBuilder('ws')
	    ->select("ws.parentid, ws.description2, ws.wwwid,ws.wwwtitle,ws.wwwid,ws.mainimage,ws.custom3 as cm, ws.countcomments,ws.countimages,
		     ws.description, ws.excerpt, ws.datecreated, u.displayname,
		     wss.name as fishname, wss2.name as bait, ws.custom1 as qtty, ws.custom2 as weight, ws.custom3 as length ")
	    ->leftJoin("WMWSBundle:HaUsers", "u", "WITH", "u.userid=ws.userid")
	    //ryba
	    ->leftJoin("WMWSBundle:HaWsWsSubjects", "wswss", "WITH", "wswss.wsId=ws.wwwid")
	    ->leftJoin("WMWSBundle:HaWsSubjects", "wss", "WITH", "wswss.wsSubjectRef=wss.ref")
	    
	    //ryba
	    ->leftJoin("WMWSBundle:HaWsWsSubjects2", "wswss2", "WITH", "wswss2.wsId=ws.wwwid")
	    ->leftJoin("WMWSBundle:HaWsSubjects2", "wss2", "WITH", "wswss2.wsSubjectRef=wss2.ref")
	    
	    ->where("(ws.datecreated <= :datestart and ws.datecreated > :dateend) and ( ws.wwwtitle = 'REJESTR') ")
	    //->addSelect("pb") 
	    ->setParameter('datestart', $datestart)
	    ->setParameter('dateend', $dateend)
	    ->orderBy('ws.datecreated', 'DESC')
	    ->getQuery();
	
        $ws = $query->getResult(Query::HYDRATE_ARRAY);
		foreach($ws as $www){
			$www['type']='REJESTR';
			$liveboxes_arr[strtotime($www['datecreated']->format('Y-m-d H:i:s'))] = $www;
		}
		
		//WS COMMENTS
		$repository = $this->getDoctrine()
        ->getRepository('WMWSBundle:HaWsComments');
	
		$query = $repository->createQueryBuilder('wsc')
	    ->select("wsc.wwwid,ws.countcomments, wsc.comment,ws.description, ws.wwwtitle, wsc.datecreated, u.displayname")
	    ->leftJoin("WMWSBundle:HaUsers", "u", "WITH", "u.userid=wsc.userid")
	    ->leftJoin("WMWSBundle:HaWs", "ws", "WITH", "ws.wwwid=wsc.wwwid")
	    ->where("wsc.datecreated <= :datestart and wsc.datecreated > :dateend")
	    //->addSelect("pb") 
	    ->setParameter('datestart', $datestart)
	    ->setParameter('dateend', $dateend)
	    ->orderBy('wsc.datecreated', 'DESC')
	    ->getQuery();
	
        $wsComments = $query->getResult(Query::HYDRATE_ARRAY);
       
	   foreach($wsComments as $com){
		$com['type']='WS_COMMENT';
		$liveboxes_arr[strtotime($com['datecreated']->format('Y-m-d H:i:s'))] = $com;
	   }
	   
		//POSTS
		$repository = $this->getDoctrine()
        ->getRepository('WMWSBundle:HaForumsPosts');
	
		$query = $repository->createQueryBuilder('fp')
	    ->select("fp.body, fp.userid, fp.image, fp.postid, fp.topicid, fp.datecreated,ft.topictitle,ft.replies, u.displayname")
	    ->leftJoin("WMWSBundle:HaUsers", "u", "WITH", "u.userid=fp.userid")
		->leftJoin("WMWSBundle:HaForumsTopics", "ft", "WITH", "ft.topicid=fp.topicid")
	    ->where("fp.datecreated <= :datestart and fp.datecreated > :dateend")
	    //->addSelect("pb") 
	    ->setParameter('datestart', $datestart)
	    ->setParameter('dateend', $dateend)
	    ->orderBy('fp.datecreated', 'DESC')
	    ->getQuery();
	    
	
        $forumPosts = $query->getResult(Query::HYDRATE_ARRAY);
       
	   foreach($forumPosts as $post){
		$post['type']='FORUM_POST';
		$liveboxes_arr[strtotime($post['datecreated']->format('Y-m-d H:i:s'))] = $post;
	   }
	   
	   //TOPICS
		$repository = $this->getDoctrine()
        ->getRepository('WMWSBundle:HaForumsTopics');
	
		$query = $repository->createQueryBuilder('ft')
	    ->select("ft.forumid, ft.userid, ft.topicid,ft.topictitle, ft.views, ft.replies, ft.datecreated,ft.topictitle, u.displayname, ft.tmpusername, ft.lastpostid")
	    ->leftJoin("WMWSBundle:HaUsers", "u", "WITH", "u.userid=ft.userid")
	    ->where("ft.datecreated <= :datestart and ft.datecreated > :dateend")
	    //->addSelect("pb") 
	    ->setParameter('datestart', $datestart)
	    ->setParameter('dateend', $dateend)
	    ->orderBy('ft.datecreated', 'DESC')
	    ->getQuery();
	    
	
        $forumTopics = $query->getResult(Query::HYDRATE_ARRAY);
       
	   foreach($forumTopics as $topic){
		$topic['type']='FORUM_TOPIC';
		$liveboxes_arr[strtotime($topic['datecreated']->format('Y-m-d H:i:s'))] = $topic;
	   }
	   
	   
	   ksort($liveboxes_arr);
	   $liveboxes_arr   = array_reverse($liveboxes_arr);
	   $liveboxes = $liveboxes_arr;
       
       $this->get("app.arrays")->utf8_encode_deep($liveboxes);
       //print_r($ws_uft8);
        $response = new Response(json_encode($liveboxes));
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
        
    }
    
}
