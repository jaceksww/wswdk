<?php

namespace WM\WSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\Query;
use AppBundle\Utils;
use WM\WSBundle\Entity\HaImages;
use WM\WSBundle\Entity\HaForumsPosts;
use WM\WSBundle\Entity\HaForumsTopics;
use DateTime;

class ForumController extends Controller
{
    public function indexAction($catId=0)
    {
        
        $forums_arr = array();
    
	if($catId == 0)
	{
	    $repository = $this->getDoctrine()->getRepository('WMWSBundle:HaForumsCats');
	    $query = $repository->createQueryBuilder('fc')->getQuery();
	    $forumCats = $query->getResult(Query::HYDRATE_ARRAY);
	    $this->get("app.arrays")->utf8_encode_deep($forumCats);
	    //print_r($forumCats);
	    
	    $repository = $this->getDoctrine()->getRepository('WMWSBundle:HaForums');
	    foreach($forumCats as $cat)
	    {
		$query = $repository->createQueryBuilder('f')
	        ->where('f.catid = :catID')
	       // ->andWhere('c.reviewed = 1')
		->setParameter('catID', $cat['catid'])
	       // ->orderBy('p.price', 'ASC')
		->getQuery();
		$forums = $query->getResult(Query::HYDRATE_ARRAY);
		$this->get("app.arrays")->utf8_encode_deep($forums);
		$set = array(
		    'cat'=>$cat,
		    'subcats'=>$forums
		);
		$forums_arr[] = $set;
	    }
	    //$forums = $forums_arr;
		
	}else{
	    //get cat
	    $repository = $this->getDoctrine()->getRepository('WMWSBundle:HaForumsCats');
	    $query = $repository->createQueryBuilder('fc')->where('fc.catid = :catID')->setParameter('catID', $catId)->getQuery();
	    $cat = $query->getResult(Query::HYDRATE_ARRAY);
	    $this->get("app.arrays")->utf8_encode_deep($cat);
	    
	    $repository = $this->getDoctrine()->getRepository('WMWSBundle:HaForums');
	    $query = $repository->createQueryBuilder('f')
	        ->where('f.catid = :catID')
	       // ->andWhere('c.reviewed = 1')
		->setParameter('catID', $catId)
	       // ->orderBy('p.price', 'ASC')
		->getQuery();
		$forums = $query->getResult(Query::HYDRATE_ARRAY);
		$this->get("app.arrays")->utf8_encode_deep($forums);
		
		$set = array(
		    'cat'=>$cat[0],
		    'subcats'=>$forums
		);
		$forums_arr[] = $set;
	}
        
        $response = new Response(json_encode($forums_arr));
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
        
    }
    
    public function topicsAction($forumId=0)
    {
    
	$repository = $this->getDoctrine()
        ->getRepository('WMWSBundle:HaForumsTopics');
    
    if($forumId != 0 && $forumId != 9999)
    {
    $query = $repository->createQueryBuilder('ft')
		->select("ft.topictitle,ft.topicid, u.displayname, ft.datecreated, ft.replies, ft.views, ft.lastpostid, ft.lastpostuserid, ft.tmpusername,
		f.forumname, f.forumid, f.catid")
        ->where('ft.forumid = :forumid')
       // ->andWhere('c.reviewed = 1')
        ->setParameter('forumid', $forumId)
		->leftJoin("WMWSBundle:HaUsers", "u", "WITH", "u.userid=ft.userid")
		->leftJoin("WMWSBundle:HaForums", "f", "WITH", "f.forumid=ft.forumid")
        ->orderBy('ft.datecreated', 'DESC')
       
        ->getQuery();
    }else if($forumId == 9999)
    {
    $start = 0;
    $limit=9999;
    $query = $repository->createQueryBuilder('ft')
		->select("ft.topictitle,ft.topicid, u.displayname, ft.datecreated, ft.replies, ft.views, ft.lastpostid, ft.lastpostuserid, ft.tmpusername,
		f.forumname, f.forumid, f.catid")
        ->setMaxResults($limit)
		->setFirstResult($start)
		->leftJoin("WMWSBundle:HaUsers", "u", "WITH", "u.userid=ft.userid")
		->leftJoin("WMWSBundle:HaForums", "f", "WITH", "f.forumid=ft.forumid")
        ->orderBy('ft.datecreated', 'DESC')
       
        ->getQuery();
    }else{
    $start = 0;
    $limit=20;
    $query = $repository->createQueryBuilder('ft')
		->select("ft.topictitle,ft.topicid, u.displayname, ft.datecreated, ft.replies, ft.views, ft.lastpostid, ft.lastpostuserid, ft.tmpusername,
		f.forumname, f.forumid, f.catid")
        ->setMaxResults($limit)
		->setFirstResult($start)
		->leftJoin("WMWSBundle:HaUsers", "u", "WITH", "u.userid=ft.userid")
		->leftJoin("WMWSBundle:HaForums", "f", "WITH", "f.forumid=ft.forumid")
        ->orderBy('ft.datecreated', 'DESC')
       
        ->getQuery();
    }
    
	$forums_topics['topics'] = $query->getResult(Query::HYDRATE_ARRAY);
	$this->get("app.arrays")->utf8_encode_deep($forums_topics);
        
        /*forum name*/
        $repository_f = $this->getDoctrine()
        ->getRepository('WMWSBundle:HaForums');
        $query_f = $repository_f->createQueryBuilder('f')
		->select("f.forumname,f.description, f.forumid, f.catid")
		->where('f.forumid = :forumid')
       ->setParameter('forumid', $forumId)
        ->getQuery();
        $forum_params = $query_f->getResult(Query::HYDRATE_ARRAY);
        
		$this->get("app.arrays")->utf8_encode_deep($forum_params);
        $forums_topics['forum_params'] =  $forum_params;
        /**end**/
        
        
        $response = new Response(json_encode($forums_topics));
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
    }
    
    public function postsAction($topicId=0, $start=0, $limit=20)
    {
	$repository = $this->getDoctrine()
        ->getRepository('WMWSBundle:HaForumsPosts');
    
    $query_count = $repository->createQueryBuilder('fp')
	->select("count(fp.postid)")
        ->where('fp.topicid = :topicid and fp.deleted = :deleted')
       // ->andWhere('c.reviewed = 1')
        ->setParameter('topicid', $topicId)
		->setParameter('deleted', 0)
		->getQuery();
    
	$forums_count_posts = $query_count->getSingleScalarResult();
	$next = $start + $limit;
	$next_total = $forums_count_posts - $limit;
	if($forums_count_posts < $next && $next_total > 0 && $forums_count_posts > $limit){
		$start = $forums_count_posts - $limit;
	}
	if($forums_count_posts < $limit){
		$start = 0;
	}
	
    $query = $repository->createQueryBuilder('fp')
	->select("f.forumid, f.forumname, ft.topictitle,ft.topicid, ft.userid as topicauthoruserid, fp.userid ,u.displayname, u.avatar,fp.postid, fp.datecreated, fp.body, fp.tmpusername")
        ->where('fp.topicid = :topicid and fp.deleted = :deleted')
       // ->andWhere('c.reviewed = 1')
        ->setParameter('topicid', $topicId)
		->setParameter('deleted', 0)
		->setMaxResults($limit)
		->setFirstResult($start)
	->leftJoin("WMWSBundle:HaUsers", "u", "WITH", "u.userid=fp.userid")
	->leftJoin("WMWSBundle:HaForumsTopics", "ft", "WITH", "ft.topicid=fp.topicid")
	->leftJoin("WMWSBundle:HaForums", "f", "WITH", "ft.forumid=f.forumid")
        ->orderBy('fp.datecreated', 'ASC')
       
        ->getQuery();
    
	$forums_posts = $query->getResult(Query::HYDRATE_ARRAY);
	$this->get("app.arrays")->utf8_encode_deep($forums_posts);
	$new_forums_posts = array();
	$new_forums_posts['posts'] = array();
	foreach ( $forums_posts as $post) { // reference
		//$tmp_post = $post;
		$body = $post['body'];
		
		$post['body'] = $this->get("app.arrays")->bbcode($body);
		$new_forums_posts['posts'][] = $post;
	}
	
	/*topic name*/
        $repository_t = $this->getDoctrine()
        ->getRepository('WMWSBundle:HaForumsTopics');
        $query_t = $repository_t->createQueryBuilder('ft')
		->select("ft.topictitle,ft.topicid, ft.userid as topicauthoruserid")
		->where('ft.topicid = :topicid')
       ->setParameter('topicid', $topicId)
        ->getQuery();
        $topic_params = $query_t->getResult(Query::HYDRATE_ARRAY);
        
		$this->get("app.arrays")->utf8_encode_deep($topic_params);
        $new_forums_posts['topic_params'] =  $topic_params;
        /**end**/
        
	//$new_forums_posts = $forums_posts ;
	
        
        
        $response = new Response(json_encode($new_forums_posts));
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
    }
   
    public function catsAction()
    {
        
        $repository = $this->getDoctrine()
        ->getRepository('WMWSBundle:HaForums');
    
    $query = $repository->createQueryBuilder('fc')
       // ->where('p.price > :price')
       // ->andWhere('c.reviewed = 1')
        //->setParameter('price', '19.99')
       // ->orderBy('p.price', 'ASC')
       
        ->getQuery();
    
	$forums = $query->getResult(Query::HYDRATE_ARRAY);
	$this->get("app.arrays")->utf8_encode_deep($forums);
        
        
        $response = new Response(json_encode($forums));
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
        
    }
    
    public function addpostAction()
    {
		$post = $_POST;
		//$this->get("app.arrays")->utf8_encode_deep($post);
		
	
	$resp['error'] = array();
        if( empty($post['body']) || empty($post['topicID']) ){
			$resp['error'][] = array('code'=>1, 'text'=>'Treść posta i id wątku są obowiązkowe');
        }
		if(empty($resp['error'])){
			$imageName='';
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
			$forum_post = new HaForumsPosts();
			$forum_post->setUserid($post['userID']);
			$forum_post->setBody($post['body']);
			$forum_post->setTopicid($post['topicID']);
			if(!empty($post['tmpUserName']))
				$forum_post->setTmpusername($post['tmpUserName']);
			if(!empty($post['mobile']))
				$forum_post->setMobile($post['mobile']);
			else
				$forum_post->setMobile(0);
		
			$forum_post->setSiteid(1);
			$forum_post->setDeleted(0);
			$forum_post->setImage($imageName);
			$forum_post->setCountlikes(0);
			$forum_post->setDatecreated(new DateTime("now"));
			$em = $this->getDoctrine()->getManager();
	
			$em->persist($forum_post);
			$em->flush();
			$postID = $forum_post->getPostid();
		
			$this->updatelastposttopicAction($post['topicID'], $postID, $post['userID']);
		
			$resp['success'][] = array('code'=>102, 'text'=>'Post został dodany pomyślnie');
			$resp['postid'] = $postID;
			
			
			//do wlasniciela 
			$url = 'http://www.wedkarstwo.mobi/forums/viewtopic/'.$post['topicID'];
			$postdetails = $this->forward('WMWSBundle:Forum:posts', array(
				'topicId'=>$post['topicID']
				));
			$postdetails = json_decode($postdetails->getContent());
		
			$already_sent = array();
			$addInfo = $this->forward('WMWSBundle:Infos:add', array(
				'content'=> "<b>FORUM</b> - Ktoś dodał post w wątku który stworzyłeś ".$url." <br /> Zobacz &raquo;",
				'url'=>$url, 
				'type'=>'FORUM',
				'userid'=>$postdetails[0]->topicauthoruserid,
				'authoruserid'=>$post['userID']
				));
			$already_sent[] = $post['userID'];
		
			if(!empty($postdetails))
			{
			
				foreach($postdetails as $com)
				{
					if($com->userid == $post['userID'] || in_array($com->userid, $already_sent)){
						continue;
					}
					$already_sent[] = $com->userid;
				
					$addInfo = $this->forward('WMWSBundle:Infos:add', array(
						'content'=> "<b>FORUMG</b> - Ktoś dodał post, w wątku który Ty również komentowałeś na forum ".$url." <br /> Zobacz &raquo;",
						'url'=>$url,  
						'type'=>'BLOG',
						'userid'=>$com->userid,
						'authoruserid'=>$post['userID']
						));
				}		
			}
		}
		//$resp = $post;
		
			$this->get("app.arrays")->utf8_encode_deep($resp);
			$response = new Response(json_encode($resp));
			$response->headers->set('Content-Type', 'application/json');
			return $response;
		
        
    }
    
    public function addtopicAction()
    {
		$post = $_POST;
		
		$resp['error'] = array();
        if( empty($post['topicTitle']) || empty($post['forumID']) ){
			$resp['error'][] = array('code'=>1, 'text'=>'Tytuł wątka i id forum są obowiązkowe');
        }
		if(empty($resp['error'])){
			
			$forum_topic = new HaForumsTopics();
			$forum_topic->setUserid($post['userID']);
			$forum_topic->setTopictitle($post['topicTitle']);
			$forum_topic->setForumid($post['forumID']);
			if(!empty($post['tmpUserName']))
				$forum_topic->setTmpusername($post['tmpUserName']);
			if(!empty($post['mobile']))
				$forum_topic->setMobile($post['mobile']);
			else
				$forum_topic->setMobile(0);
			
			$forum_topic->setSiteid(1);
			$forum_topic->setDeleted(0);
			$forum_topic->setReplies(0);
			$forum_topic->setViews(0);
			$forum_topic->setLastpostuserid(0);
			$forum_topic->setLastpostid(0);
			$forum_topic->setSticky(0);
			$forum_topic->setLocked(0);
			$forum_topic->setTags('');

			$forum_topic->setDatecreated(new DateTime("now"));
			$em = $this->getDoctrine()->getManager();
			
			$em->persist($forum_topic);
			$em->flush();
			$topicID = $forum_topic->getTopicid();
			$resp['success'][] = array('code'=>102, 'text'=>'Wątek został dodany pomyślnie');
			$resp['topicid'] = $topicID;
		}
	//$resp = $post;
		
			$this->get("app.arrays")->utf8_encode_deep($resp);
			$response = new Response(json_encode($resp));
			$response->headers->set('Content-Type', 'application/json');
			return $response;
		
        
    }
	
	public function deletepostAction($postid)
    {
	
        $em = $this->getDoctrine()->getManager();
			$query = $em->createQuery('update WMWSBundle:HaForumsPosts fp set fp.deleted = :deleted
                                                where fp.postid = :postid');
			$query->setParameter('postid', $postid);
			$query->setParameter('deleted', 1);
			$result = $query->execute();

	    $resp['success'][] = 'Dane zostały usunięte';
	
	//$resp = $post;
	$this->get("app.arrays")->utf8_encode_deep($resp);
        $response = new Response(json_encode($resp));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
        
    }
	
	//////////////////////////////////////////
	////////////////helpers///////////////////
	//////////////////////////////////////////
	
	public function updatelastposttopicAction($topicID, $lastPostID, $lastPostUserID)
    {
		$em = $this->getDoctrine()->getManager();
			//$forum_topic = $em->find('WMWSBundle:HaForumsTopics',$topicID);
			$forum_topic = $em->getRepository('WMWSBundle:HaForumsTopics')->findOneBy(array('topicid'=>$topicID));
			$forum_topic->setLastpostid($lastPostID);
			$forum_topic->setLastpostuserid($lastPostUserID);
			$em = $this->getDoctrine()->getManager();
			
			$em->persist($forum_topic);
			$em->flush();
			
    }
	
	public function getLastTopicPost($topicID)
    {
		$repository = $this->getDoctrine()
        ->getRepository('WMWSBundle:HaForumsPosts');
    
		$query = $repository->createQueryBuilder('fp')
		   ->select('max(fp.postid) as maxpost')
		    ->where('fp.topicid = :topicid')
		   // ->andWhere('c.reviewed = 1')
			->setParameter('topicid', $topicID)
		    ->orderBy('fp.postid', 'DESC')
			->getQuery();
		
		$forums_posts = $query->getResult(Query::HYDRATE_ARRAY);
		$this->get("app.arrays")->utf8_encode_deep($forums_posts);

        $response = new Response(json_encode($forums_posts));
        $response->headers->set('Content-Type', 'application/json');
        
        return $response->getContent();
	}
	
}
