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
        
        $repository = $this->getDoctrine()
        ->getRepository('WMWSBundle:HaInfos');
    
	
	    $query = $repository->createQueryBuilder('i')
	    ->where("i.userid = :userid")
	    ->setMaxResults($limit)
			->setFirstResult($start)
	    ->setParameter('userid', $userid)
	    ->orderBy('i.infoid', 'DESC')
	    ->getQuery();
	
        $infos = $query->getResult(Query::HYDRATE_ARRAY);
		
		$query2 = $repository->createQueryBuilder('i')
		->select('i.infoid')
	    ->where("i.userid = :userid and i.new=1")
		->setParameter('userid', $userid)
	    ->getQuery();
	
        $infos_count = $query2->getResult(Query::HYDRATE_ARRAY);
		$count_unread = count($infos_count);
		$infos['unread'] = $count_unread;
		
        $this->get("app.arrays")->utf8_encode_deep($infos);
        $response = new Response(json_encode($infos));
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
    }
    
    public function loginAction($email, $password)
    {
        
        $repository = $this->getDoctrine()
        ->getRepository('WMWSBundle:HaUsers');
    
	
	    $query = $repository->createQueryBuilder('u')
	    ->where("u.email = :email and u.password = :password")
	    ->setParameter('email', $email)
	     ->setParameter('password', $password)
	   // ->orderBy('p.price', 'ASC')
	    ->getQuery();
	
        $users = $query->getResult(Query::HYDRATE_ARRAY);
	$this->get("app.arrays")->utf8_encode_deep($users);
       //print_r($ws);
       
       if(empty($users)){
	$users = 0;
       }
       //print_r($ws_uft8);
        $response = new Response(json_encode($users));
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
        
    }
    public function registerAction()
    {
	
        //print_r($ws_uft8);
	$post = $_POST;
	
	$resp['error'] = array();
        if( empty($post['password']) || empty($post['email'])){
	 $resp['error'][] = 'Hasło i Email są obowiązkowe';
        }else if(empty($post['email']) || !strstr($post['email'], '@') || !strstr($post['email'], '.'))
        {
	    $resp['error'][] = 'Niepoprawny adres email';
        }
        if((!empty($post['password']) && !empty($post['password2'])) && $post['password'] != $post['password2']){
	    $resp['error'][] = 'Hasła nie są identyczne';
        }
	if(empty($resp['error'])){
	    $user = new HaUsers();
	    $user->setEmail($post['email']);
	    $user->setPassword(md5($post['password']));
	    $email_parts = explode('@',$post['email']);
	    $displayname = $email_parts[0];
	    $user->setDisplayname($displayname);
	    $user->setUsername($displayname);
	    $user->setGroupid(0);
	    $user->setSubscription("Y");
	    $user->setSubscribed(0);
	    $user->setPlan(0);
	    $user->setCurrency('USD');
	    $user->setBio('');
	    $user->setLanguage('polski');
	    $user->setPosts(0);
	    $user->setKudos(0);
	    $user->setNotifications(1);
	    $user->setNotificationsPromo(1);
	    $user->setNotificationsBlog(1);
	    $user->setNotificationsShop(1);
	    $user->setPrivacy('V');
	    $user->setCustom1('');
	    $user->setCustom2('');
	    $user->setCustom3('');
	    $user->setCustom4('');
	    $user->setActive(1);
	    //$user->set();
	    //$user->set();
	    
	
	    $em = $this->getDoctrine()->getManager();
	
	    $em->persist($user);
	    $em->flush();
	    $resp['success'][] = 'Konto utworzono pomyślnie';
	}
	//$resp = $post;
	$this->get("app.arrays")->utf8_encode_deep($resp);
        $response = new Response(json_encode($resp));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
        
    }
	
	
	public function avatarAction()
    {
	
        $post = $_POST;
	
		$resp['error'] = array();
        if( empty($post['base64']) || empty($_POST['file']) ){
			$resp['error'][] = 'Nie przesłano pliku';
        }
		if(empty($resp['error'])){
	    $file = '../../wedkarstwo.mobi/static/tmp/'.$_POST['file'];
		$base64 = $_POST['base64'];
			//$user->setActive(1);
	    
			//$em = $this->getDoctrine()->getManager();
			//$em->persist($user);
			//$em->flush();
			$this->get("app.files")->base64_to_jpeg($base64, $file);
			$resp['success'][] = 'Zapisano plik';
		}
	//$resp = $post;
	$this->get("app.arrays")->utf8_encode_deep($resp);
        $response = new Response(json_encode($resp));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
        
    }
	
	public function getuserAction($userid=0,$displayname='')
    {
        
        $repository = $this->getDoctrine()
        ->getRepository('WMWSBundle:HaUsers');
    
		if($userid == 0){
			$query = $repository->createQueryBuilder('u')
			->where("u.displayname = :displayname")
			->setParameter('displayname', $displayname)
			->getQuery();
		}else{
			$query = $repository->createQueryBuilder('u')
			->where("u.userid = :userid")
			->setParameter('userid', $userid)
			->getQuery();
		}
	
        $users = $query->getResult(Query::HYDRATE_ARRAY);
		$this->get("app.arrays")->utf8_encode_deep($users);
       //print_r($ws);
       
       if(empty($users)){
		$users = 0;
       }
       //print_r($ws_uft8);
        $response = new Response(json_encode($users));
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
        
    }
	
	public function settingsAction()
    {
	
        //print_r($ws_uft8);
		$post = $_POST;
	
			$resp['error'] = array();
			if( empty($post['userID'])){
				$resp['error'][] = 'Nie wybrano użytkownika do edycji';
			}
			
			//TODO!!
			// check if current password is ok
			
			if((!empty($post['new_password']) && !empty($post['new_password2'])) && $post['new_password'] != $post['new_password2']){
				$resp['error'][] = 'Hasła nie są identyczne';
			}
			
		if(empty($resp['error'])){
			
			$avatar='';
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
				$file = '../../wedkarstwo.mobi/static/uploads/avatars/'.$post['userID'].'_'.$imageName;
				
				$base64 = $_POST['base64'];
				$this->get("app.files")->base64_to_jpeg($base64, $file);
				
				$file = '../../wedkarstwo.mobi/static/uploads/avatars/'.$_POST['userID'].'_'.$imageRef.'_thumb.'.$fileExt;
				$base64 = $_POST['base64'];
				$this->get("app.files")->base64_to_jpeg($base64, $file);
				
				$resp['success'][] = 'Zapisano plik';
				$em = $this->getDoctrine()->getManager();
				$em->persist($images);
				$em->flush();
				$avatar = $post['userID'].'_'.$imageName;
			}
			
			
			$em = $this->getDoctrine()->getManager();
			$user = $em->find('WMWSBundle:HaUsers',$post['userID']);
			
			if(!empty($post['email'])) $user->setEmail($post['email']);
			if(!empty($post['new_password'])) $user->setPassword(md5($post['new_password']));
			if(!empty($post['displayname']))$user->setDisplayname($post['displayname']);
			if(!empty($post['displayname']))$user->setUsername($post['displayname']);
			if(!empty($post['bio']))$user->setDisplayname($post['bio']);
			if($avatar != '') $user->setAvatar($avatar);
			
			//$user->set();
			//$user->set();

			$em = $this->getDoctrine()->getManager();
		
			$em->persist($user);
			$em->flush();
			$resp['success'][] = 'Konto utworzono pomyślnie';
		}
		//$resp = $post;
		$this->get("app.arrays")->utf8_encode_deep($resp);
        $response = new Response(json_encode($resp));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
        
    }
}
