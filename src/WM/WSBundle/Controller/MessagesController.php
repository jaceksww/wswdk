<?php

namespace WM\WSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\Query;
use AppBundle\Utils;
use WM\WSBundle\Entity\HaUsers;
use WM\WSBundle\Entity\HaCommunityMessages;
use WM\WSBundle\Entity\HaCommunityMessagemap;
use DateTime;

class MessagesController extends Controller
{
    public function inboxAction($userid, $start, $limit)
    {
    
    	$messages1 = array();
        $messages2 = array();
        $messages3 = array();
        
        $repository = $this->getDoctrine()
        ->getRepository('WMWSBundle:HaCommunityMessagemap');
        
		$query1 = $repository->createQueryBuilder('cmm')
		->select('cmm.messageid')
	    ->where("cmm.touserid = :userid and cmm.touserid <> cmm.userid")
		->setParameter('userid', $userid)
	    ->getQuery();
	
        $total_count = $query1->getResult(Query::HYDRATE_ARRAY);
		$count_total = count($total_count);
        $messages1[]['count_total'] = $count_total;
        
        $query2 = $repository->createQueryBuilder('cmm')
		->select('cmm.messageid')
	    ->where("cmm.touserid = :userid and cmm.unread=1  and cmm.touserid <> cmm.userid")
		->setParameter('userid', $userid)
	    ->getQuery();
	
        $unread_count = $query2->getResult(Query::HYDRATE_ARRAY);
		$count_unread = count($unread_count);
        $messages2[]['count_unread'] = $count_unread;
        
	
	    $query = $repository->createQueryBuilder('cmm')
	    ->select('cm.messageid, cmm.userid, cmm.touserid, cm.datecreated, cmm.parentid, cmm.unread, cm.subject, cm.message,
	    u.avatar, u.displayname')
	    ->where("cmm.touserid = :userid and cmm.touserid <> cmm.userid")
	    ->leftJoin("WMWSBundle:HaCommunityMessages", "cm", "WITH", "cm.messageid=cmm.messageid")
	    ->leftJoin("WMWSBundle:HaUsers", "u", "WITH", "u.userid=cmm.userid")
	    ->setMaxResults($limit)
		->setFirstResult($start)
	    ->setParameter('userid', $userid)
	    ->orderBy('cmm.messageid', 'DESC')
	    ->getQuery();
	
        $messages3 = $query->getResult(Query::HYDRATE_ARRAY);
		
		$messages = array_merge($messages1, $messages2, $messages3);
		
        $this->get("app.arrays")->utf8_encode_deep($messages);
        $response = new Response(json_encode($messages));
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
    }
 	public function outboxAction($userid, $start, $limit)
    {
        $messages1 = array();
        $messages2 = array();
        $messages3 = array();
        
        $repository = $this->getDoctrine()
        ->getRepository('WMWSBundle:HaCommunityMessagemap');
        
		$query1 = $repository->createQueryBuilder('cmm')
		->select('cmm.messageid')
	    ->where("cmm.userid = :userid and cmm.touserid <> cmm.userid")
		->setParameter('userid', $userid)
	    ->getQuery();
	
        $total_count = $query1->getResult(Query::HYDRATE_ARRAY);
		$count_total = count($total_count);
        $messages1[]['count_total'] = $count_total;
        
        
	
	    $query = $repository->createQueryBuilder('cmm')
	    ->select('cm.messageid, cmm.userid, cmm.touserid, cm.datecreated, cmm.parentid, cmm.unread, cm.subject, cm.message,
	    u.avatar, u.displayname')
	    ->where("cmm.userid = :userid and cmm.touserid <> cmm.userid")
	    ->leftJoin("WMWSBundle:HaCommunityMessages", "cm", "WITH", "cm.messageid=cmm.messageid")
	    ->leftJoin("WMWSBundle:HaUsers", "u", "WITH", "u.userid=cmm.userid")
	    ->setMaxResults($limit)
		->setFirstResult($start)
	    ->setParameter('userid', $userid)
	    ->orderBy('cmm.messageid', 'DESC')
	    ->getQuery();
	
        $messages3 = $query->getResult(Query::HYDRATE_ARRAY);
		
		$messages = array_merge($messages1, $messages3);
		
        $this->get("app.arrays")->utf8_encode_deep($messages);
        $response = new Response(json_encode($messages));
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
    }  
    
    public function viewAction($messageid)
    {
        
        $repository = $this->getDoctrine()
        ->getRepository('WMWSBundle:HaCommunityMessagemap');
        
	
	    $query = $repository->createQueryBuilder('cmm')
	    ->select('cm.messageid, cmm.userid, cmm.touserid, cm.datecreated, cmm.parentid, cmm.unread, cm.subject, cm.message,
	    u.avatar, u.displayname, tou.displayname as todisplayname, tou.avatar as toavatar, tou.userid as touserid')
	    ->where("cmm.messageid = :messageid and cmm.touserid <> cmm.userid")
	    ->leftJoin("WMWSBundle:HaCommunityMessages", "cm", "WITH", "cm.messageid=cmm.messageid")
	    ->leftJoin("WMWSBundle:HaUsers", "u", "WITH", "u.userid=cmm.userid")
	    ->leftJoin("WMWSBundle:HaUsers", "tou", "WITH", "tou.userid=cmm.touserid")
	    ->setParameter('messageid', $messageid)
	    ->getQuery();
        $message = $query->getResult(Query::HYDRATE_ARRAY);
		
        $this->get("app.arrays")->utf8_encode_deep($message);
        $response = new Response(json_encode($message[0]));
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
    }   
    
    public function addAction()
    {
		$post = $_POST;
		
		$resp['error'] = array();
        if( empty($post['userID']) || empty($post['touserID'])|| empty($post['message']) ){
			$resp['error'][] = array('code'=>1, 'text'=>'nadawca, adresat i wiadomość są obowiązkowe');
        }
		if(empty($resp['error'])){
			
			$message = new HaCommunityMessages();
			$message->setUserid($post['userID']);
			$message->setMessage($post['message']);
			if(!empty($post['subject']))
				$message->setSubject($post['subject']);
			
			$message->setSiteid(1);
			$message->setDatecreated(new DateTime("now"));
			$em = $this->getDoctrine()->getManager();
			
			$em->persist($message);
			$em->flush();
			$messageID = $message->getMessageid();
			$resp['success'][] = array('code'=>102, 'text'=>'Wiadomość została dodana pomyślnie');
			$resp['messageID'] = $messageID;
			
			if(!empty($messageID))
			{
				$messagemap = new HaCommunityMessagemap();
				$messagemap->setUserid($post['userID']);
				$messagemap->setTouserid($post['touserID']);
				$messagemap->setMessageid($messageID);
				$messagemap->setParentid(0);
				$messagemap->setUnread(1);
				$messagemap->setDeleted(0);
				$messagemap->setSiteid(1);
				$em = $this->getDoctrine()->getManager();
			
				$em->persist($messagemap);
				$em->flush();
				
				$messagemap = new HaCommunityMessagemap();
				$messagemap->setUserid($post['userID']);
				$messagemap->setTouserid($post['userID']);
				$messagemap->setMessageid($messageID);
				$messagemap->setParentid(0);
				$messagemap->setUnread(1);
				$messagemap->setDeleted(0);
				$messagemap->setSiteid(1);
				$em = $this->getDoctrine()->getManager();
			
				$em->persist($messagemap);
				$em->flush();
			}
		}
	//$resp = $post;
		
			$this->get("app.arrays")->utf8_encode_deep($resp);
			$response = new Response(json_encode($resp));
			$response->headers->set('Content-Type', 'application/json');
			return $response;
		
        
    }
}