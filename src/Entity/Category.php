<?php

// src/Entity/Category.php
namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\Traits\TimestampableTrait;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="categories")
 */
#[ORM\HasLifecycleCallbacks]

class Category
{
    use TimestampableTrait;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $category_name;
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="categories")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="Video", mappedBy="category",cascade={"remove"})
     */
    private $videos;


    public function __construct()
    {
        $this->videos = new Collection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCategoryName()
    {
        return $this->category_name;
    }

    public function setCategoryName($category_name)
    {
        $this->category_name = $category_name;
    }

     /**
     * Get all categories associated with this user.
     *
     * @return Collection|Category[]
     */
    public function getVideos()
    {
        return $this->videos;
    }

    public function setVideos($videos)
    {
        $this->videos = $videos;
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
     * Get the user associated with this video.
     *
     * @return User|null
     */
    public function setUser($user): ?User
    {
         $this->user= $user;
         return $this->user;
    }
}
