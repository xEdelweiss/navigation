<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 07.11.2014
 * Time: 15:33
 */

namespace xedelweiss\Navigation\CoordinateSystem;


class Cartesian extends Base {

    protected $x = 0;
    protected $y = 0;
    protected $z = 0;

    /**
     * @param float $x
     */
    public function setX($x)
    {
        $this->x = $x;
    }

    /**
     * @param float $y
     */
    public function setY($y)
    {
        $this->y = $y;
    }

    /**
     * @param float $z
     */
    public function setZ($z)
    {
        $this->z = $z;
    }

    /**
     * @return float
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @return float
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * @return float
     */
    public function getZ()
    {
        return $this->z;
    }

    public function dump()
    {
        return [
            'x' => $this->getX(),
            'y' => $this->getY(),
            'z' => $this->getZ(),
        ];
    }

    public function saveToUniSystem()
    {
        $uni = new Uni;

        $uni->x = $this->getX();
        $uni->y = $this->getY();
        $uni->z = $this->getZ();

        return $uni;
    }

    public function loadFromUniSystem(Uni $uni)
    {
        $this->setX($uni->x);
        $this->setY($uni->y);
        $this->setZ($uni->z);
    }

}