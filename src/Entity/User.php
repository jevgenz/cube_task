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
	private $first_name;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $last_name;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $email;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $password;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $hash_str;

	/**
	 * @ORM\Column(type="boolean", options={"default":"0"})
	 */
	private $email_verified_f;

	public function getId(): ?int
	{
		return $this->id;
	}


	public function setFirstName(string $first_name): self
	{
		$this->first_name = $first_name;

		return $this;
	}

	public function setLastName(string $last_name): self
	{
		$this->last_name = $last_name;

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

	public function getUsername(): ?string
	{
		return ($this->first_name . ' ' . $this->last_name);
	}

	public function getFirstName(): ?string
	{
		return $this->first_name;
	}

	public function getLastName(): ?string
	{
		return $this->last_name;
	}

	public function eraseCredentials()
	{
	}

	public function getRoles()
	{
		$roles = [];
		// guarantee every user at least has ROLE_USER
		$roles[] = 'ROLE_USER';

		return array_unique($roles);
	}

	public function getSalt()
	{
	}

	public function getHashStr(): ?string
	{
		return $this->hash_str;
	}

	public function setHashStr($hash_str): ?string
	{
		$this->hash_str = $hash_str;
	}

	public function getEmailVerifiedF(): bool
	{
		return $this->email_verified_f;
	}

	public function setEmailVerifiedF($email_verified_f): bool
	{
		$this->email_verified_f = $email_verified_f;
	}
}
