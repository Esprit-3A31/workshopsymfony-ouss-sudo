<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student
{

    #[ORM\Id]
    #[ORM\Column]
    private ?string $nce = null;

    /**
     * @return string|null
     */
    public function getNce(): ?string
    {
        return $this->nce;
    }

    /**
     * @param string|null $nce
     */
    public function setNce(?string $nce): void
    {
        $this->nce = $nce;
    }

    /**
     * @return string|null
     */


    #[ORM\Column(length: 100)]
    private ?string $username = null;

    #[ORM\ManyToOne(inversedBy: 'students')]
    #[ORM\JoinColumn(onDelete:"CASCADE")]

    private ?ClassRoom $classRoom = null;

    #[ORM\Column]
    private ?float $moyenne = null;





    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getClassRoom(): ?ClassRoom
    {
        return $this->classRoom;
    }

    public function setClassRoom(?ClassRoom $classRoom): self
    {
        $this->classRoom = $classRoom;

        return $this;
    }

    public function getMoyenne(): ?float
    {
        return $this->moyenne;
    }

    public function setMoyenne(float $moyenne): self
    {
        $this->moyenne = $moyenne;

        return $this;
    }




}
