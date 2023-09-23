<?php

namespace App\Entity\Traits;

trait TimestampableTrait
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $created_At;

    public function getCreatedAt()
    {
        return $this->created_At;
    }

    /**
     * Set created at timestamp before persisting.
     *
     * @ORM\PrePersist
     */
    public function setCreatedAt()
    {
        $this->created_At = new \DateTimeImmutable();
    }
}