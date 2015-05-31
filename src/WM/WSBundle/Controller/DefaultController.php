<?php

namespace WM\WSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
	public function dictionariesAction($userid)
	{
		$dict = array();
		
		$messages = $this->forward('WMWSBundle:Messages:inbox', array(
		'userid'=> $userid,
		'start'=>0, 
		'limit'=>20,
		));
		$dict['messages'] = json_decode($messages->getContent());
		
		$infos = $this->forward('WMWSBundle:Infos:index', array(
		'userid'=> $userid,
		'start'=>0, 
		'limit'=>20,
		));
		$dict['infos'] = json_decode($infos->getContent());
		
		$forum_categories = $this->forward('WMWSBundle:Forum:index', array(
		));
		$dict['forum_categories'] = json_decode($forum_categories->getContent());
		
		$subjects = $this->forward('WMWSBundle:Ws:subjects', array());
		$dict['subjects'] = json_decode($subjects->getContent());
		
		$subjects2 = $this->forward('WMWSBundle:Ws:subjects2', array());
		$dict['subjects2'] = json_decode($subjects2->getContent());
		
		$fishery = $this->forward('WMWSBundle:Ws:index', array(
		'type'=>'REJESTR_LOWISKO', 
		'start'=>0, 
		'limit'=>100, 
		'userid'=> $userid
		));
		$dict['registerfisheries'] = json_decode($fishery->getContent());
		
		$usergalleries = $this->forward('WMWSBundle:Ws:usergalleries', array(
		'userid'=> $userid
		));
		$dict['usergalleries'] = json_decode($usergalleries->getContent());
		
		$categories = $this->forward('WMWSBundle:Ws:categories', array(
		));
		$dict['categories'] = json_decode($categories->getContent());
		
		
		
		
        $response = new Response(json_encode($dict));
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
	}
    public function indexAction($name)
    {
        return $this->render('WMWSBundle:Default:index.html.twig', array('name' => $name));
    }
    
    
}
