<?php


namespace App\Controller;


use App\Entity\Comment;
use App\Entity\Download;
use App\Entity\Likes;
use App\Entity\Post;
use App\Entity\User;
use App\Form\CommentType;
use App\Form\PostType;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Validator\Constraints\DateTime;

class PostController extends AbstractController
{
    /**
     * @Route("/post", name="app_post")
     */
    public function createPost(Request $request)
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post->setPostName($form->get('post_name')->getData());
            $post->setPostDescription($form->get('post_description')->getData());

            $category = $form->get('post_category')->getData();
            switch ($category) {
                case 0: $post->setPostCategory("Combat");
                    break;
                case 1: $post->setPostCategory("Plateformes");
                    break;
                case 2: $post->setPostCategory("Tir");
                    break;
                case 3: $post->setPostCategory("Aventure");
                    break;
                case 4: $post->setPostCategory("Action-aventure");
                    break;
                case 5: $post->setPostCategory("Jeu de rôle");
                    break;
                case 6: $post->setPostCategory("Réflexion");
                    break;
                case 7: $post->setPostCategory("Simulation");
                    break;
                case 8: $post->setPostCategory("Sport");
                    break;
                default: $post->setPostCategory("Non classé");
            }


            $post->setPostDownloadLink($form->get('post_download_link')->getData());

            $post->setPostUserId($this->getUser());

            $post->setPostNbComs(0);
            $post->setPostNbDownloads(0);
            $post->setPostNbLikes(0);

            $post->setPostDate(new \DateTime());

            $post->setPostUserPseudo($this->getUser()->getUserPseudo());

            $uploadedFile = $form->get('post_image')->getData();
            if ($uploadedFile) {
                $destination = $this->getParameter('kernel.project_dir').'/public/uploads/game_images';
                $newFilename = $post->getPostName().'.'.$uploadedFile->guessExtension();
                $uploadedFile->move(
                    $destination,
                    $newFilename
                );
                $post->setPostImage($newFilename);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($post);
            $entityManager->flush();


            $this->addFlash('message', 'Nouveau post!');
            return $this->redirectToRoute('app_homepage');
        }

        return $this->render('post.html.twig', [
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/download/{postId}", name="app_download")
     */
    public function download($postId)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $post = $entityManager->getRepository(Post::class)->find($postId);

        if($entityManager->getRepository(Download::class)->hasAlreadyDownload($this->getUser()->getId(), $postId) == null) {
            $post->setPostNbDownloads($post->getPostNbDownloads() + 1);
            $entityManager->persist($post);
            $entityManager->flush();

            $download = new Download();
            $post->addPostDownload($download);
            $this->getUser()->addUserDownload($download);

            $entityManager->persist($download);
            $entityManager->flush();
        }

        return $this->redirect($post->getPostDownloadLink());
    }

    /**
     * @Route("/delete/{postId}", name="app_delete")
     */
    public function deletePost($postId)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $post = $entityManager->getRepository(Post::class)->find($postId);

        if ($post->getPostUserId()->getId() == $this->getUser()->getId()) {
            $downloads = $entityManager->getRepository(Download::class)->findByPostId($postId);
            foreach($downloads as $download) {
                $post->removePostDownload($download);
            }

            $comments = $entityManager->getRepository(Comment::class)->findByPostId($postId);
            foreach($comments as $comment) {
                $post->removePostComment($comment);
            }

            $likes = $entityManager->getRepository(Likes::class)->findByPostId($postId);
            foreach($likes as $like) {
                $post->removePostLike($like);
            }

            $entityManager->remove($post);
            $entityManager->flush();

            return $this->redirectToRoute('app_homepage');
        }
    }

    /**
     * @Route("/post/edit/{postId}", name="app_editpost")
     */
    public function editPost($postId, Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $post = $entityManager->getRepository(Post::class)->find($postId);

        if ($post->getPostUserId()->getId() == $this->getUser()->getId()) {
            $cat = $post->getPostCategory();
            switch ($cat) {
                case "Combat": $post->setPostCategory(0);
                    break;
                case "Plateformes": $post->setPostCategory(1);
                    break;
                case "Tir": $post->setPostCategory(2);
                    break;
                case "Aventure": $post->setPostCategory(3);
                    break;
                case "Action-aventure": $post->setPostCategory(4);
                    break;
                case "Jeu de rôle": $post->setPostCategory(5);
                    break;
                case "Réflexion": $post->setPostCategory(6);
                    break;
                case "Simulation": $post->setPostCategory(7);
                    break;
                case "Sport": $post->setPostCategory(8);
                    break;
                default: $post->setPostCategory(0);
            }

            $form = $this->createForm(PostType::class, $post);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $category = $form->get('post_category')->getData();
                switch ($category) {
                    case 0: $post->setPostCategory("Combat");
                        break;
                    case 1: $post->setPostCategory("Plateformes");
                        break;
                    case 2: $post->setPostCategory("Tir");
                        break;
                    case 3: $post->setPostCategory("Aventure");
                        break;
                    case 4: $post->setPostCategory("Action-aventure");
                        break;
                    case 5: $post->setPostCategory("Jeu de rôle");
                        break;
                    case 6: $post->setPostCategory("Réflexion");
                        break;
                    case 7: $post->setPostCategory("Simulation");
                        break;
                    case 8: $post->setPostCategory("Sport");
                        break;
                    default: $post->setPostCategory("Non classé");
                }


                $post->setPostDownloadLink($form->get('post_download_link')->getData());

                $uploadedFile = $form->get('post_image')->getData();
                if ($uploadedFile) {
                    $destination = $this->getParameter('kernel.project_dir').'/public/uploads/game_images';
                    $newFilename = $post->getPostName().'.'.$uploadedFile->guessExtension();
                    $uploadedFile->move(
                        $destination,
                        $newFilename
                    );
                    $post->setPostImage($newFilename);
                }

                $em = $this->getDoctrine()->getManager();
                $em->persist($post);
                $em->flush();

                $this->addFlash('message', 'Post mis à jour');
                return $this->redirectToRoute('app_viewpost', [
                    "postId" => $postId
                ]);
            }

            return $this->render('post.html.twig', [
                'form' => $form->createView(),
            ]);
        }
    }

    /**
     * @Route("/like/{postId}", name="app_like")
     */
    public function like($postId)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $post = $entityManager->getRepository(Post::class)->find($postId);

        if($entityManager->getRepository(Likes::class)->hasAlreadyLiked($this->getUser()->getId(), $postId) == null) {
            $post->setPostNbLikes($post->getPostNbLikes() + 1);
            $entityManager->persist($post);
            $entityManager->flush();

            $like = new Likes();
            $post->addPostLike($like);
            $this->getUser()->addUserLike($like);

            $entityManager->persist($like);
            $entityManager->flush();
        }
        else {
            $post->setPostNbLikes($post->getPostNbLikes() - 1);
            $entityManager->persist($post);
            $entityManager->flush();

            $like = $entityManager->getRepository(Likes::class)->hasAlreadyLiked($this->getUser()->getId(), $postId);
            $post->removePostLike($like);
            $this->getUser()->removeUserLike($like);

            $entityManager->persist($like);
            $entityManager->flush();
        }


        return $this->redirectToRoute('app_viewpost', [
            "postId" => $postId,
        ]);
    }

    /**
     * @Route("/viewpost/{postId}", name="app_viewpost")
     */
    public function comment(Request $request, $postId)
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        $entityManager = $this->getDoctrine()->getManager();
        $post = $entityManager->getRepository(Post::class)->find($postId);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $post->setPostNbComs($post->getPostNbComs() + 1);

            $entityManager->persist($post);
            $entityManager->flush();

            $comment->setCommentContent($form->get('comment_content')->getData());
            $post->addPostComment($comment);
            $this->getUser()->addUserComment($comment);

            $entityManager->persist($comment);
            $entityManager->flush();
        }

        $comments = $entityManager->getRepository(Comment::class)->findByPostId($postId);
        return $this->render('viewpost.html.twig', [
            'post' => $post,
            'user' => $this->getUser(),
            'comments' => $comments,
            'form' => $form->createView(),
            'hasAlreadyLiked' => $entityManager->getRepository(Likes::class)->hasAlreadyLiked($this->getUser()->getId(), $postId)
        ]);
    }


    /**
     * @Route("/delete/comment/{commentId}/{postId}", name="app_deletecomment")
     */
    public function deleteComment($commentId, $postId)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $comment = $entityManager->getRepository(Comment::class)->find($commentId);

        if ($comment->getCommentUserId()->getId() == $this->getUser()->getId()) {
            $entityManager = $this->getDoctrine()->getManager();

            $post = $entityManager->getRepository(Post::class)->find($postId);
            $post->setPostNbComs($post->getPostNbComs() - 1);

            $entityManager->persist($post);
            $entityManager->flush();

            $comment = $entityManager->getRepository(Comment::class)->find($commentId);
            $post->removePostComment($comment);
            $this->getUser()->removeUserComment($comment);

            $entityManager->persist($comment);
            $entityManager->flush();


            return $this->redirectToRoute('app_viewpost', [
                "postId" => $postId
            ]);
        }
    }
}