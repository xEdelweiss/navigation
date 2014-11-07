<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 07.11.2014
 * Time: 15:05
 */

namespace xedelweiss\Navigation\CoordinateSystem;


class Spherical extends Base {

    protected $radius = 0;
    protected $phi = 0;
    protected $theta = 0;
    protected $rho = 0;

    /**
     * @param float $phi
     */
    public function setPhi($phi)
    {
        $this->phi = $phi;
    }

    /**
     * @param float $theta
     */
    public function setTheta($theta)
    {
        $this->theta = $theta;
    }

    /**
     * @param float $rho
     */
    public function setRho($rho)
    {
        $this->rho = $rho;
    }

    /**
     * @param float $radius
     * @param bool $recalculate
     */
    public function setRadius($radius, $recalculate = FALSE)
    {
        if ($recalculate) {
            $radiusDelta = $radius - $this->radius;
            $this->updateRho($radiusDelta);
            // @todo and more
        }

        $this->radius = $radius;
    }

    /**
     * @param float $latitude
     */
    public function setLatitude($latitude)
    {
        $this->setPhi($latitude);
    }

    /**
     * @param float $longitude
     */
    public function setLongitude($longitude)
    {
        $this->setTheta($longitude);
    }

    /**
     * @param float $altitude
     */
    public function setAltitude($altitude)
    {
        $this->setRho($altitude - $this->radius);
    }

    /**
     * @param float $delta
     */
    public function updateRho($delta)
    {
        $this->rho += $delta;
    }

    /**
     * @return float
     */
    public function getRadius()
    {
        return $this->radius;
    }

    /**
     * @return float
     */
    public function getPhi()
    {
        return $this->phi;
    }

    /**
     * @return float
     */
    public function getTheta()
    {
        return $this->theta;
    }

    /**
     * @return float
     */
    public function getRho()
    {
        return $this->rho;
    }

    /**
     * @return float
     */
    public function getLatitude()
    {
        return $this->getPhi();
    }

    /**
     * @return float
     */
    public function getLongitude()
    {
        return $this->getTheta();
    }

    /**
     * @return float
     */
    public function getAltitude()
    {
        return $this->getRho() + $this->getRadius();
    }

    public function dump()
    {
        return [
            'radius' => $this->getRadius(),
            'phi' => $this->getPhi(),
            'theta' => $this->getTheta(),
            'rho' => $this->getRho(),
            'latitude' => $this->getLatitude(),
            'longitude' => $this->getLongitude(),
            'altitude' => $this->getAltitude(),
        ];
    }

    public function saveToUniSystem()
    {
        $uni = new Uni;

        $phi = $this->getPhi();
        $theta = $this->getTheta();
        $rho = $this->getRho();

        $uni->x = $rho * sin($theta) * cos($phi);
        $uni->y = $rho * sin($theta) * sin($phi);
        $uni->z = $rho * cos($theta);

        return $uni;
    }

    public function loadFromUniSystem(Uni $uni)
    {
        $x = $uni->x;
        $y = $uni->y;
        $z = $uni->z;

        $rho = sqrt(pow($x, 2) + pow($y, 2) + pow($z, 2));
        $theta = acos($z / $rho);
        $phi = atan($y / $x);

        $this->setPhi($phi);
        $this->setTheta($theta);
        $this->setRho($rho);
    }
}