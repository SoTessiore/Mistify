<?php


namespace App\Controller;


use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class APIController extends AbstractController
{
    /**
     * @Route("/research/post/list", name="app_list", methods={"GET"})
     */
    public function list(){
        $em = $this->getDoctrine()->getManager();
        $repositoryPost = $em->getRepository(Post::class);

        $posts = $repositoryPost->findAll();

        $encoders = [new JsonEncoder()];

        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);

        $jsonContent = $serializer->serialize($posts, 'json', [
            'circular_reference_handler' => function($object) {
                return $object->getId();
            }
        ]);

        $response = new Response($jsonContent);

        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/research/post/category/{category}", name="app_category", methods={"GET"})
     */
    public function searchCategory($category){
        $em = $this->getDoctrine()->getManager();
        $repositoryPost = $em->getRepository(Post::class);

        $posts = $repositoryPost->findByCategory($category);

        $encoders = [new JsonEncoder()];

        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);

        $jsonContent = $serializer->serialize($posts, 'json', [
            'circular_reference_handler' => function($object) {
                return $object->getId();
            }
        ]);

        $response = new Response($jsonContent);

        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/research/post/criteria/{criteria}", name="app_criteria", methods={"GET"})
     */
    public function searchCriteria($criteria){
        $em = $this->getDoctrine()->getManager();
        $repositoryPost = $em->getRepository(Post::class);

        $posts = $repositoryPost->findByOther($criteria);

        $encoders = [new JsonEncoder()];

        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);

        $jsonContent = $serializer->serialize($posts, 'json', [
            'circular_reference_handler' => function($object) {
                return $object->getId();
            }
        ]);

        $response = new Response($jsonContent);

        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/research/post/{category}/{criteria}", name="app_critcat", methods={"GET"})
     */
    public function searchCorresponding($category, $criteria){
        $em = $this->getDoctrine()->getManager();
        $repositoryPost = $em->getRepository(Post::class);

        $posts = $repositoryPost->findCorresponding($criteria, $category);

        $encoders = [new JsonEncoder()];

        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);

        $jsonContent = $serializer->serialize($posts, 'json', [
            'circular_reference_handler' => function($object) {
                return $object->getId();
            }
        ]);

        $response = new Response($jsonContent);

        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}