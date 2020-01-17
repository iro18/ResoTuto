<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Tutorial;
use App\Entity\Category;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;
use App\Repository\TutorialRepository;

class ResonanceController extends AbstractController
{
   /* private $encoder ;

    public function __construct(UserPasswordEncoderInterface $encoder){
        $this->encoder = $encoder ;
    }*/
    
    /**
     * @Route("/", name="home")
     */
    public function index( Security $security )
    {

        $CurrentUser = $security->getUser();
    	$em  = $this->getDoctrine();
        $repo = $em->getRepository(Tutorial::class);
    	$repoCateg = $em->getRepository(Category::class);
        $IdBasique = $repoCateg->findOneBy(["Name" => "Basique"]);
        $IdAdvanced = $repoCateg->findOneBy(["Name" => "Avancé"]);
        $tutorialsBasique = $repo->findBy(["isPublish" => true, "category" => $IdBasique], ['order_menu' => 'ASC']);
    	$tutorialsAdvanced = $repo->findBy(["isPublish" => true, "category" => $IdAdvanced], ['order_menu' => 'ASC']);

        return $this->render('resonance/index.html.twig', compact('tutorialsBasique','tutorialsAdvanced','CurrentUser'));
    }

    /**
     * @Route("tutoriel/{slug}", name="show_tutoriel")
     */
    public function showTutorial($slug, TutorialRepository $TutoRepo)
    {

         $this->denyAccessUnlessGranted('ROLE_USER');

         
    	$tutorial = $TutoRepo->findOneBySlug($slug);

        $ActualOrder = $tutorial->getOrderMenu();
        $NextTutorial = $TutoRepo->findOneNextTuto($ActualOrder);
        $PrevTutorial = $TutoRepo->findOnePrevTuto($ActualOrder);

    	if(!$tutorial){
    		throw $this->createNotFoundException('Page inexistante ');
    	}
    	return $this->render('resonance/show.html.twig',compact('tutorial','NextTutorial','PrevTutorial'));
    }



    /* 
     Morceau de code pour inscription d'utilisateur avec injection de dépendance

         $em  = $this->getDoctrine()->getEntityManager();
        $user = new User;
        $encoded = $this->encoder->encodePassword($user, '111');
        $user->setEmail('azeaze@hotmail.fr')
        ->setPassword($encoded)
        ->setInscription(new \Datetime('now'))
        ->setRoles(array('ROLE_ADMIN'));
        $em->persist($user);
        $em->flush();
     */
}
