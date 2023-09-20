<?php

namespace App\Entity;

use App\Repository\VideoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="categories")
 */

 class Video
{
      /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

        /**
     * @ORM\Column(type="string", length=255)
     */
    private $video_name;

 /**
     * @ORM\Column(type="datetime", nullable=true)
     */

    private ?\DateTimeInterface $created_at = null;


        /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="videos")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="videos")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVideoName(): ?string
    {
        return $this->videoName;
    }

    public function setVideoName(string $videoName): static
    {
        $this->videoName = $videoName;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}