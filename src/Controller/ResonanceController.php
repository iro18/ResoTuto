<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Tutorial;
use App\Entity\Category;
// use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;
use App\Repository\TutorialRepository;
use App\Repository\CategoryRepository;

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
        $repoTuto = $em->getRepository(Tutorial::class);
    	$repoCateg = $em->getRepository(Category::class);
        $AllCateg = $repoCateg->findAll();
        $ArrayCateg =  array();
        $ListeTutoriels = array() ;
        $i = 0 ;
        foreach ($AllCateg as $key => $value) {
           $ListeTutoriels[$i]['tutos'] = $repoTuto->findBy(["isPublish" => true, "category" => $value->getId()], ['order_menu' => 'ASC']);
           $ListeTutoriels[$i]['categ'] = $value->getName();
           $i++;
        }

        /*$IdBasique = $repoCateg->findOneBy(["Name" => "Basique"]);
        $IdAdvanced = $repoCateg->findOneBy(["Name" => "Avancé"]);
        $tutorialsBasique = $repo->findBy(["isPublish" => true, "category" => $IdBasique], ['order_menu' => 'ASC']);
    	$tutorialsAdvanced = $repo->findBy(["isPublish" => true, "category" => $IdAdvanced], ['order_menu' => 'ASC']);*/

        //return $this->render('resonance/index.html.twig', compact('tutorialsBasique','tutorialsAdvanced','CurrentUser'));

        return $this->render('resonance/index.html.twig', compact('ListeTutoriels','CurrentUser'));
    }

    /**
     * @Route("tutoriel/{name}/{slug}", name="show_tutoriel")
     */
    public function showTutorial( $name, $slug, TutorialRepository $TutoRepo)
    {

         $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

    	$tutorial = $TutoRepo->findOneBySlug($slug);

        $ActualOrder = $tutorial->getOrderMenu();
        $CategoryTutorial = $tutorial->getCategory();

        $NextTutorial = $TutoRepo->findOneNextTuto($ActualOrder,$CategoryTutorial);
        $PrevTutorial = $TutoRepo->findOnePrevTuto($ActualOrder,$CategoryTutorial);


    	if(!$tutorial){
    		throw $this->createNotFoundException('Page inexistante ');
    	}
    	return $this->render('resonance/show.html.twig',compact('tutorial','NextTutorial','PrevTutorial','CategoryTutorial'));
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
