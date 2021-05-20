<?php

namespace Time\Models;

use Phalcon\Mvc\Model;

/**
 * Permissions. Stores the permissions by profile
 * Vokuro\Models\Permissions
 * @package Vokuro\Models
 */
class Permissions extends Model
{
    /** @var integer */
    public $id;

    /** @var integer */
    public $profilesId;

    /** @var string */
    public $resource;

    /** @var string */
    public $action;

    public function initialize()
    {
        $this->belongsTo('profilesId', __NAMESPACE__ . '\Profiles', 'id', [
            'alias' => 'profile'
        ]);
    }
}
