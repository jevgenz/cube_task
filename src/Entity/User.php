<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface
{
	/**
	 * @ORM\Id()
	 * @ORM\GeneratedValue()
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $Name;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $Surname;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $email;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $password;

	public function getId(): ?int
      	{
      		return $this->id;
      	}

	public function getName(): ?string
      	{
      		return $this->Name;
      	}

	public function setName(string $Name): self
      	{
      		$this->Name = $Name;
      
      		return $this;
      	}

	public function getSurname(): ?string
      	{
      		return $this->Surname;
      	}

	public function setSurname(string $Surname): self
      	{
      		$this->Surname = $Surname;
      
      		return $this;
      	}

	public function getEmail(): ?string
      	{
      		return $this->email;
      	}

	public function setEmail(string $email): self
      	{
      		$this->email = $email;
      
      		return $this;
      	}

	public function getPassword(): ?string
      	{
      		return $this->password;
      	}

	public function setPassword(string $password): self
      	{
      		$this->password = $password;
      
      		return $this;
      	}

	public function getUsername() {}
	public function eraseCredentials()  {}
	public function getRoles() {}
	public function getSalt() {}

}
