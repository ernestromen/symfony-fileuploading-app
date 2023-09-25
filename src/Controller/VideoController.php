<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
class VideoController extends AbstractController
{
     /**
     * @Route("/videos/{filename}", name="video_download")
     */
    public function download(string $filename): BinaryFileResponse
    {
        $filePath = $this->getParameter('video_directory').'/'.$filename;
        return new BinaryFileResponse($filePath);
    }
}