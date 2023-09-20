<?php

// src/Entity/Category.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="categories")
 */
class Category
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
    private $category_name;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="categories")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="Video", mappedBy="category")
     */
    private $videos;


    public function __construct()
    {
        $this->videos = new ArrayCollection();
        // ...
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

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt()
    {
        $this->createdAt = new DateTime();
    }

     /**
     * Get all categories associated with this user.
     *
     * @return Collection|Category[]
     */
    public function getVideos(): Collection
    {
        return $this->videos;
    }
}
