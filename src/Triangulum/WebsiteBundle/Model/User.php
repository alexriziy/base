<?php

namespace Triangulum\WebsiteBundle\Model;

use Triangulum\WebsiteBundle\Model\om\BaseUser;
use Triangulum\WebsiteBundle\Model\GroupQuery;
use Symfony\Component\Security\Core\User\UserInterface;

class User extends BaseUser implements UserInterface
{
    /**
     * Get roles of user
     *
     * @param void
     *
     * @return array
     */
    public function getRoles()
    {
        $roles = array();
        $userGroup = GroupQuery::create()->findPK($this->getGroupId());

        if ($userGroup) {
            $roles[] = $userGroup->getRole();
        }

        return $roles;
    }

    /**
     * Get salt
     *
     * @param void
     *
     * @return string
     */
    public function getSalt()
    {
        return '';
    }

    /**
     * Erase data of user
     *
     * @param void
     *
     * @return void
     */
    public function eraseCredentials()
    {
    }
}
