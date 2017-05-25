<?php
/**
 * Created by PhpStorm.
 * User: Steven
 * Date: 20/05/2017
 * Time: 14:29
 */

namespace App\traits;
use \HighIdeas\UsersOnline\Traits\UsersOnlineTrait as BaseTrait;

trait UsersOnlineTrait
{
    use BaseTrait;


    public function allOnline()
    {
        return $this->orderBy('name','ASC')->get()->filter->isOnline();
    }

}