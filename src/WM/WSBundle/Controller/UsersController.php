<?php

namespace WM\WSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\Query;
use AppBundle\Utils;
use WM\WSBundle\Entity\HaUsers;
use WM\WSBundle\Entity\HaImages;
use DateTime;

class UsersController extends Controller
{
    public function indexAction()
    {
        
        $repository = $this->getDoctrine()
        ->getRepository('WMWSBundle:HaUsers');
    
	
	    $query = $repository->createQueryBuilder('u')
	    //->where("ws.wwwtitle = :type")
	    //->setParameter('type', $type)
	   // ->orderBy('p.price', 'ASC')
	    ->getQuery();
	
        $users = $query->getResult(Query::HYDRATE_ARRAY);
       //print_r($ws);
       
       $this->get("app.arrays")->utf8_encode_deep($users);
       //print_r($ws_uft8);
        $response = new Response(json_encode($users));
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
	    $user->setBio('Gracz');
	    $user->setLanguage('polski');
	    $user->setPosts(0);
	    $user->setKudos(10);
	    $user->setNotifications(1);
	    $user->setNotificationsPromo(1);
	    $user->setNotificationsBlog(1);
	    $user->setNotificationsShop(1);
	    //if... TO DO
	    $user->setNotificationsGame(1);
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
    public function getusersAction()
    {
        $querystr='';
        if(!empty($_POST['query'])) $querystr = $_POST['query'];
        
        $wherein='';
        if(!empty($_POST['wherein'])) $wherein = $_POST['wherein'];
        
        $repository = $this->getDoctrine()
        ->getRepository('WMWSBundle:HaUsers');
    
		if($querystr == '' && $wherein==''){
			$query = $repository->createQueryBuilder('u')
			->orderBy('u.displayname', 'ASC')
			->getQuery();
		}elseif($wherein != ''){
			$query = $repository->createQueryBuilder('u')
			->where('u.userid in (:wherein)')
			->setParameter('wherein', explode(',',$wherein))
			->orderBy('u.displayname', 'ASC')
			->getQuery();
		}else{
			$query = $repository->createQueryBuilder('u')
			->where('u.displayname like :displayname')
			->setParameter('displayname', '%'.$querystr.'%')
			->orderBy('u.displayname', 'ASC')
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
	
	public function updatefieldAction($field, $val, $userID)
    {
	
      
	$resp['error'] = array();
        if( empty($userID)){
			$resp['error'][] = 'Nie wskazano usera';
        }
		
	if(empty($resp['error'])){
	    $em = $this->getDoctrine()->getManager();
			$user = $em->find('WMWSBundle:HaUsers',$userID);
			
		if($field == 'notifications')
			$user->setNotifications($val);
		else if($field == 'notifications_promo')
			$user->setNotificationsPromo($val);
		else if($field == 'notifications_blog')
			$user->setNotificationsBlog($val);
		else if($field == 'notifications_shop')
			$user->setNotificationsShop($val);
		
	    $em = $this->getDoctrine()->getManager();
		
			$em->persist($user);
			$em->flush();
	    $resp['success'][] = 'Dane zostały zmienione';
	}
	//$resp = $post;
	$this->get("app.arrays")->utf8_encode_deep($resp);
        $response = new Response(json_encode($resp));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
        
    }
}
