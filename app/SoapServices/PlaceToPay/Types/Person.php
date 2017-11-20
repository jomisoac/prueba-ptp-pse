<?php namespace App\SoapServices\PlaceToPay\Types;

class Person
{

    /** @var  string */
    public $documentType;

    /** @var  string */
    public $document;

    /** @var  string */
    public $firstName;

    /** @var  string */
    public $lastName;

    /** @var  string */
    public $company;

    /** @var  string */
    public $emailAddress;

    /** @var  string */
    public $address;

    /** @var  string */
    public $city;

    /** @var  string */
    public $province;

    /** @var  string */
    public $country;

    /** @var  string */
    public $phone;

    /** @var  string */
    public $mobile;

    public function sameSelf(Person $person)
    {
        return ($person->document == $person->document) && ($person->documentType == $person->documentType);
    }
}