<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Entity\Video;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Form\VideoType;
use App\Form\CategoryType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class PageController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em,SessionInterface $session)
    {
        $this->em = $em;
        $this->session = $session;
    }

    public function index(){
        if( $this->isGranted('ROLE_ADMIN') ||  $this->isGranted('ROLE_USER')){
          return  $this->redirectToRoute('video_list');
        }else{
          return  $this->redirectToRoute('app_login');
        }
    }

    public function userList(){
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $users = $this->em->getRepository(User::class)->findAll();
        return $this->render('pages/users.html.twig', ['users' => $users]);
    }

    public function addVideo(Request $request){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $video = new Video();
        
        $form = $this->createForm(VideoType::class, $video);
        $videos = $this->em->getRepository(Video::class)->findAll();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
            $user = $this->getUser();
            $video->setUser($user);        
            $videoFile = $form->get('video_file_path')->getData();
        
            if ($videoFile) {
                $originalFilename = pathinfo($videoFile->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = pathinfo($videoFile->getClientOriginalName(), PATHINFO_EXTENSION );
                $newFilename = $originalFilename.'-'.uniqid().'.'.$videoFile->guessExtension();
                $videoFile->move(
                    $this->getParameter('video_directory'), // Define the directory where videos should be stored
                    $newFilename
                );
                
            $video->setVideoFilePath($newFilename);

            $this->em->persist($video);
            $this->em->flush();

            $this->addFlash(
                'notice',
                'Your changes were saved!'
            );
        }
        return $this->redirectToRoute('add_video');
        } catch (Exception $e) {
            $this->addFlash(
                'notice',
                $e->getMessage()
            );
            return $this->redirectToRoute('add_video');
        }    
    }
        return $this->render(
            'pages/addvideo.html.twig',
            [
            'form' => $form->createView(),
            'videos' => $videos
            ]
        );
}



public function deleteVideo($id){

    $this->denyAccessUnlessGranted('ROLE_ADMIN');
    try {
    $videoToDelete = $this->em->getRepository(Video::class)->find($id);

    if (!$videoToDelete) {
        throw $this->createNotFoundException('Video not found.');
    }  

    $this->em->remove($videoToDelete);

    $this->em->flush();
    $this->addFlash(
        'notice',
        'Video deleted successfully'
    );            
    return $this->redirectToRoute('add_video');
} catch (\Exception $e) {
    echo new Response($e->getMessage(), 500);
}

}


    public function addCategory(Request $request){
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $categories = $this->em->getRepository(Category::class)->findAll();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $category->setUser($user);

            $this->em->persist($category);
            $this->em->flush();

            
            $this->addFlash(
                'notice',
                'Your changes were saved!'
            );

            return $this->redirectToRoute('add_category');
        }

        return $this->render(
            'pages/addcategory.html.twig',
            [
            'form' => $form->createView(),
            'categories' => $categories
            ]
        );

    }


   public function deleteCategory($id)
   {
    $this->denyAccessUnlessGranted('ROLE_ADMIN');
    try {
    $categoryToDelete = $this->em->getRepository(Category::class)->find($id);

    $this->em->remove($categoryToDelete);

    $this->em->flush();
    $this->addFlash(
        'notice',
        'Category deleted successfully'
    );            
    return $this->redirectToRoute('add_category');
} catch (\Exception $e) {
    echo new Response($e->getMessage(), 500);
    $this->addFlash(
        'notice',
        $e->getMessage()
    );    
    return $this->redirectToRoute('add_category');
}
   }

   public function videoList(){
        $data = [];
       $categories =  $this->em->getRepository(Category::class)->findAll();
       foreach($categories as $category){
        foreach($category->getVideos()->getIterator() as $video){
            $videos[] = [
                'videoName' => $video->getVideoName(),
                'videoFilePath' => $video->getVideoFilePath()
            ];
        }
        // $category->setVideos($videos);
        $data[] = [
            "categoryName" => $category->getCategoryName(),
            "videos" => $videos,
        ];
        $arr[] = $category;
        $videos = [];
           }

           return $this->render('pages/videos.html.twig',[
            'categories' => ($data)
        ]);
    }
    
    public function fetchVideoList(){
        $data = [];
        $categories =  $this->em->getRepository(Category::class)->findAll();
        foreach($categories as $category){
         foreach($category->getVideos()->getIterator() as $video){
             $videos[] = [
                 'videoName' => $video->getVideoName(),
                 'videoFilePath' => $video->getVideoFilePath()
             ];
         }
         // $category->setVideos($videos);
         $data[] = [
             "categoryName" => $category->getCategoryName(),
             "videos" => $videos,
         ];
         $arr[] = $category;
         $videos = [];
        }
                    return new JsonResponse($data);


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