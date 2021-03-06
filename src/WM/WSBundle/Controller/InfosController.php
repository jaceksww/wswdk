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
    
    public function addAction($content, $url, $type, $userid,$authoruserid )
	{
		$user = $this->forward('WMWSBundle:Users:getuser', array(
			'userid'=>$authoruserid,
			'displayname'=>''
			));
		$user = json_decode($user->getContent());
		$info = new Hainfos();
	    $info->setUserid($userid);
	    $info->setAuthordisplayname($user[0]->displayname);
	    $info->setAuthoruserid($authoruserid);
	    $info->setAuthoravatar($user[0]->avatar);
	    $info->setContent($content);
		$info->setUrl($url);
		$info->setType($type);
		$info->setNew(1);
		$info->setMailsent(0);
		$info->setDatecreated(new DateTime("now"));
	    $em = $this->getDoctrine()->getManager();
	
	    $em->persist($info);
	    $em->flush();
	    
	    $response = new Response();
			$response->headers->set('Content-Type', 'application/json');
			return $response;
		
	}
	
	public function resetAction($userid )
	{
		$em = $this->getDoctrine()->getManager();
			#$info = $em->find('WMWSBundle:HaInfos',['userid'=>$userID]);
			#$info->setNew(0);
			#$em = $this->getDoctrine()->getManager();
			#$em->persist($info);
			#$em->flush();
			
			$query = $em->createQuery('update WMWSBundle:HaInfos i set i.new = :new
                                                where i.userid = :userid ');
			$query->setParameter('userid', $userid);
			$query->setParameter('new', 0);
			$result = $query->execute();
			$response = new Response($result);
			$response->headers->set('Content-Type', 'application/json');
			$response->headers->set('Access-Control-Allow-Headers', 'origin, content-type, accept');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, PATCH, OPTIONS');
			return $response;
			
	}
	
	 public function sendmailsAction()
	 {
		 $repository = $this->getDoctrine()
        ->getRepository('WMWSBundle:HaInfos');
	  $limit = 100;
	    $query = $repository->createQueryBuilder('i')
		->select("u.displayname,u.userid, u.email, u.notifications, i.datecreated, i.content, i.type, i.url, i.authordisplayname, i.authoravatar, i.authoruserid, i.mailsent")
	    ->where("i.mailsent = :mailsent")
		->leftJoin("WMWSBundle:HaUsers", "u", "WITH", "u.userid=i.userid")
	    ->setMaxResults($limit)
			->setFirstResult(0)
	    ->setParameter('mailsent', 0)
	    ->orderBy('i.infoid', 'ASC')
	    ->getQuery();
	
        $infos = $query->getResult(Query::HYDRATE_ARRAY);
		
		$usermails = array();
        
		foreach($infos as $info){
			$usermails[$info['userid']][] = $info;
		}
		foreach($usermails as $mail)
		{
			if($mail[0]['notifications'] != 1 ) continue;
			
			 $message = \Swift_Message::newInstance()
				->setSubject('[Wedkarstwo.mobi][Powiadomienia o aktywności związanej z Tobą]')
				->setFrom('redakcja@wedkarstwo.mobi')
				->setTo($mail[0]['email'])
				->setBody(
					$this->renderView(
						// app/Resources/views/Emails/infos.html.twig
						'@WMWSBundle/Resources/views/Emails/infos.html.twig',
						array('infos' =>$mail)
					),
					'text/html'
				)
				/*
				 * If you also want to include a plaintext version of the message
				->addPart(
					$this->renderView(
						'Emails/registration.txt.twig',
						array('name' => $name)
					),
					'text/plain'
				)
				*/
			;
			
			//set sent for this user
			$this->get('mailer')->send($message);
			$em = $this->getDoctrine()->getManager();
			$query = $em->createQuery('update WMWSBundle:HaInfos i set i.mailsent = :mailsent
                                                where i.userid = :userid ');
			$query->setParameter('userid', $mail[0]['userid']);
			$query->setParameter('mailsent', 1);
			$result = $query->execute();
			
		}
		
		
		$this->get("app.arrays")->utf8_encode_deep($infos);
        $response = new Response(json_encode($infos));
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
    }
    
    
}
