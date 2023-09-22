<?php

namespace App\Entity;

use App\Repository\VideoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="videos")
 */
#[ORM\HasLifecycleCallbacks]
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
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */

    private $created_at;


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

    /**
    * @ORM\Column(type="string", nullable=true)
    */
    private $video_file_path;
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVideoName(): ?string
    {
        return $this->video_name;
    }

    public function setVideoName(string $video_name)
    {
        $this->video_name = $video_name;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

     /**
     * Set created at timestamp before persisting.
     *
     * @ORM\PrePersist
     */
    public function setCreatedAt()
    {
        $this->created_at = new \DateTimeImmutable();

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


        /**
     * Get the user associated with this video.
     *
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

        /**
     * Get the category associated with this video.
     *
     * @return Category|null
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getVideoFilePath()
    {
        return $this->video_file_path;
    }

    public function setVideoFilePath($video_file_path)
    {
        $this->video_file_path = $video_file_path;
    }

          /**
     * Get the user associated with this video.
     *
     * @return User|null
     */
    public function setUser($user)
    {
         $this->user= $user;
         return $this->user;
    }
    
}