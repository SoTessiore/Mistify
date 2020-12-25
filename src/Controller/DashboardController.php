<?php


namespace App\Controller;
use App\Entity\Likes;
use App\Entity\Post;
use App\Form\ResearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="app_index")
     */
    public function index(){
        return $this->render('index.html.twig');
    }


    /**
     * @Route("/home", name="app_homepage")
     */
    public function homepage(Request $request){
        $form = $this->createForm(ResearchType::class);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(Post::class);

        $posts = $repository->findAllAndOrder();

        if ($form->isSubmitted() && $form->isValid()) {
            $category = $form->get('post_category')->getData();
            switch ($category) {
                case 0: $cat = null;
                    break;
                case 1: $cat = "Combat";
                    break;
                case 2: $cat = "Plateformes";
                    break;
                case 3: $cat = "Tir";
                    break;
                case 4: $cat = "Aventure";
                    break;
                case 5: $cat = "Action-aventure";
                    break;
                case 6: $cat = "Jeu de rôle";
                    break;
                case 7: $cat = "Réflexion";
                    break;
                case 8: $cat = "Simulation";
                    break;
                case 9: $cat = "Sport";
                    break;
                default: $cat = null;
            }
            $criteria = $form->get('post_name')->getData();

            if ($criteria == null && $cat == null) {
                $posts = $repository->findAllAndOrder();
            }
            else if ($criteria == null) {
                $posts = $repository->findByCategory($cat);
            }
            else if ($cat == null) {
                $posts = $repository->findByOther($criteria);
            }
            else {
                $posts = $repository->findCorresponding($form->get('post_name')->getData(), $cat);
            }
        }

        return $this->render('home.html.twig', [
            'posts' => $posts,
            'form' => $form->createView()
        ]);
    }
}