<?php


namespace App\Controller;


use App\Entity\Download;
use App\Entity\Likes;
use App\Entity\Post;
use App\Form\EditProfileType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="app_profile")
     */
    public function profile(){
        return $this->render('profile.html.twig');
    }

    /**
     * @Route("/profile/posts", name="app_profileposts")
     */
    public function profilePosts(){
        $entityManager = $this->getDoctrine()->getManager();
        $downloads = $entityManager->getRepository(Download::class)->findUserDownloads($this->getUser()->getId());
        $dlPosts = [];

        if (count($downloads) != 0){
            foreach ($downloads as $download) {
                $dlPosts[] = $entityManager->getRepository(Post::class)->find($download->getDownloadPostId());
            }
        }

        $likes = $entityManager->getRepository(Likes::class)->findUserLikes($this->getUser()->getId());
        $likedPosts = [];

        if (count($likes) != 0) {
            foreach ($likes as $like) {
                $likedPosts[] = $entityManager->getRepository(Post::class)->find($like->getLikesPostId());
            }
        }

        return $this->render('profileposts.html.twig', [
            'likes' => $likedPosts,
            'downloads' => $dlPosts
        ]);
    }

    /**
     * @Route("/profile/edit", name="app_editprofile")
     */
    public function edit(Request $request){
        $user = $this->getUser();
        $form = $this->createForm(EditProfileType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $uploadedFile = $form->get('user_avatar')->getData();
            if ($uploadedFile) {
                $destination = $this->getParameter('kernel.project_dir').'/public/uploads/avatars';
                $newFilename = $user->getId().'.'.$uploadedFile->guessExtension();
                $uploadedFile->move(
                    $destination,
                    $newFilename
                );
                $user->setUserAvatar($newFilename);
            }

            $posts = $user->getUserPosts();

            foreach ($posts as $post) {
                $post->setPostUserPseudo($form->get('user_pseudo')->getData());
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('message', 'Profil mis à jour');
            return $this->redirectToRoute('profile');
        }

        return $this->render('editprofile.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}