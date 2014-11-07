<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 07.11.2014
 * Time: 15:41
 */

namespace xedelweiss\Navigation\CoordinateSystem;


abstract class Base {
    abstract public function saveToUniSystem();
    abstract public function loadFromUniSystem(Uni $uni);

    public function importFrom(Base $system)
    {
        $uni = $system->saveToUniSystem();
        $this->loadFromUniSystem($uni);
    }
}