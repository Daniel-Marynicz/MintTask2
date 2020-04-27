<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use function array_unique;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="`user`")
 *
 * @UniqueEntity(fields={"username"}, message="There is already an account with this username")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /** @ORM\Column(type="string", length=180, unique=true) */
    private ?string $username = null;

    /** @ORM\Column(type="boolean",  options={"default":1}) */
    private bool $enabled = true;


    /**
     * @ORM\Column(type="json")
     *
     * @var string[]
     */
    private array $roles = [];

    /**
     * @ORM\Column(type="string")
     *
     * @var string The hashed password
     */
    private string $password;

    private ?string $plainPassword = null;

    public function getId() : ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername() : ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username) : self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     *
     * @return string[]
     */
    public function getRoles() : array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param string[] $roles
     *
     * @return $this
     */
    public function setRoles(array $roles) : self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword() : string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password) : self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt() : string
    {
        return 't+d.:4X$-uez?YTBMY"UQMckE#FN-=q%M';
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials() : void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isEnabled() : bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled) : User
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function setPlainPassword(?string $plainPassword) : User
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    public function getPlainPassword() : ?string
    {
        return $this->plainPassword;
    }
}
