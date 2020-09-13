<?php

namespace Application\Entity\OAuth2;

use ApiSkeletons\OAuth2\Doctrine\Permissions\Acl\Role\HierarchicalInterface;
use Doctrine\ORM\Mapping as ORM;
use ApiSkeletons\OAuth2\Doctrine\Entity\UserInterface;

/**
 * Roles
 *
 * @ORM\Table(name="role")
 * @ORM\Entity
 */
class Role
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @ORM\Column(name="name", type="string", nullable=false)
     */
    protected $roleId;

    /**
     * @ORM\ManyToOne(targetEntity="Role", inversedBy="child")
     * @ORM\JoinColumn(name="parent", referencedColumnName="id")
     */
    protected $parent;

    /**
     * @ORM\OneToMany(targetEntity="Role", mappedBy="parent")
     */
    protected $child;

    /**
     * @ORM\ManyToMany(targetEntity="Usuario", inversedBy="role")
     * @ORM\JoinTable(name="usuario_role",
     *      joinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id", nullable=false)},
     *      inverseJoinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)}
     *      )
     */
    protected $user;

    public function __construct()
    {
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
        $this->child = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add user
     *
     * @param Usuario $user
     *
     * @return Role
     */
    public function addUser(Usuario $user)
    {
        $this->user[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param Usuario $user
     */
    public function removeUser(Usuario $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUser()
    {
        return $this->user;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setParent(Role $role)
    {
        $this->parent = $role;

        return $this;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function getChild()
    {
        return $this->child;
    }

    public function setChild(Role $role)
    {
        $this->child = $role;

        return $this;
    }

    public function setRoleId($roleId)
    {
        $this->roleId = $roleId;

        return $this;
    }

    public function getRoleId()
    {
        return $this->roleId;
    }
}
