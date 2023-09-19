<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PageController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em,SessionInterface $session)
    {
        $this->em = $em;
        $this->session = $session;
    }

    public function index(){
        return $this->render(
            'pages/index.html.twig'
        );
    }

    public function userList(){
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $users = $this->em->getRepository(User::class)->findAll();
        return $this->render('pages/users.html.twig', ['users' => $users]);
    }

    public function addVideo(){
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
       
        return $this->render('pages/addvideo.html.twig');
    }


    public function videoList(){

        return $this->render('pages/videos.html.twig');
    }

    public function deleteUser($id){
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

            try {
            $userToDelete = $this->em->getRepository(User::class)->find($id);
            !$userToDelete ? throw $this->createNotFoundException('User not found.') : '';
            $this->em->remove($userToDelete);
            $this->em->flush();
            $this->addFlash(
                'notice',
                'User deleted successfully'
            );            
            return $this->redirectToRoute('user_list');
        } catch (\Exception $e) {
            // Log the exception or handle it appropriately
            echo new Response($e->getMessage(), 500);
        }
    }
}
