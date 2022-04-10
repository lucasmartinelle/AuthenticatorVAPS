<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Controller\UserController;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 * 
 * 
 * @ApiResource(
 *  normalizationContext={"groups"={"user:read"}},
 *  denormalizationContext={"groups"={"user:write"}},
 *  collectionOperations={
 *      "get"={
 *          "pagination_enabled"=false,
 *          "access_control"="is_granted('ROLE_ADMIN')"
 *      },
 *      "post"={
 *          "pagination_enabled"=false
 *      },
 *      "me"={
 *          "method"="GET",
 *          "path"="/users/me",
 *          "controller"=UserController::class,
 *          "pagination_enabled"=false
 *      }
 *  },
 *  itemOperations={
 *      "get" = {
 *          "access_control"="is_granted('ROLE_ADMIN')" 
 *      },
 *      "put" = {
 *          "access_control"="is_granted('ROLE_ADMIN')" 
 *      }, 
 *      "delete" = {
 *          "access_control"="is_granted('ROLE_ADMIN')" 
 *      },
 *      "patch" = {
 *          "access_control"="is_granted('ROLE_ADMIN')" 
 *      }, 
 *  }
 * )
 * 
 * @UniqueEntity(fields={"email"})
 **/
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @Groups("user:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     * 
     * @Groups({"user:read", "user:write"})
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     * 
     * @Groups("user:read")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @Groups("user:write")
     * 
     * @SerializedName("password")
     * @Assert\NotBlank()
     */
    private $plainPassword;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"user:read", "user:write"})
     * @Assert\NotBlank()
     */
    private $username;

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    public function getUsername(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPlainPassword(): string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(string $password): self
    {
        $this->plainPassword = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        $this->plainPassword = null;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }
}
