<?php

namespace Defr\Ares;

use Defr\Justice;
use Goutte\Client;

/**
 * Class AresRecord.
 *
 * @author Dennis Fridrich <fridrich.dennis@gmail.com>
 */
class AresRecord
{
    /**
     * @var int
     */
    private $companyId;

    /**
     * @var string
     */
    private $taxId;

    /**
     * @var string
     */
    private $companyName;

    /**
     * @var string
     */
    private $street;

    /**
     * @var string
     */
    private $streetHouseNumber;

    /**
     * @var string
     */
    private $streetOrientationNumber;

    /**
     * @var string
     */
    private $town;

    /**
     * @var string
     */
    private $zip;

    /**
     * AresRecord constructor.
     * @param int    $companyId
     * @param string $taxId
     * @param string $companyName
     * @param string $street
     * @param string $streetHouseNumber
     * @param string $streetOrientationNumber
     * @param string $town
     * @param string $zip
     */
    public function __construct($companyId, $taxId, $companyName, $street, $streetHouseNumber, $streetOrientationNumber, $town, $zip)
    {
        $this->companyId = $companyId;
        $this->taxId = !empty($taxId) ? $taxId : null;
        $this->companyName = $companyName;
        $this->street = $street;
        $this->streetHouseNumber = !empty($streetHouseNumber) ? $streetHouseNumber : null;
        $this->streetOrientationNumber = !empty($streetOrientationNumber) ? $streetOrientationNumber : null;
        $this->town = $town;
        $this->zip = $zip;
    }

    /**
     * @return string
     */
    public function getStreetWithNumbers()
    {
        return $this->street.' '
        .($this->streetOrientationNumber
            ?
            $this->streetHouseNumber.'/'.$this->streetOrientationNumber
            :
            $this->streetHouseNumber);
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->companyName;
    }

    /**
     * @return mixed
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * @return mixed
     */
    public function getTaxId()
    {
        return $this->taxId;
    }

    /**
     * @return mixed
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * @return mixed
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @return mixed
     */
    public function getStreetHouseNumber()
    {
        return $this->streetHouseNumber;
    }

    /**
     * @return mixed
     */
    public function getStreetOrientationNumber()
    {
        return $this->streetOrientationNumber;
    }

    /**
     * @return mixed
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * @return mixed
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @return array
     */
    public function getCompanyPeople()
    {
        $justice = new Justice(new Client());
        $justiceRecord = $justice->findById($this->companyId);
        if ($justiceRecord) {
            return $justiceRecord->getPeople();
        }

        return [];
    }
}
