<?php

interface Builder {
    function setName($name);
    function setAge($age);
    function setSex($sex);
    function setNationality($nationality);
    function setResidency($country);
    function setSkinColor($color);
    function setJob($title);
    function isGraduated($isGraduated);
    function isParent($isParent);
}

class CharacterBuilder implements Builder {
    private $character;

    function __construct()
    {
        $this->character = new Character();
    }

    function setName($name)
    {
        $this->character->name = $name;
        return $this;
    }

    function setAge($age)
    {
        $this->character->age = $age;
        return $this;
    }

    function setSex($sex)
    {
        $this->character->sex = $sex;
        return $this;
    }

    function setNationality($nationality)
    {
        $this->character->nationality = $nationality;
        return $this;
    }

    function setResidency($country)
    {
        $this->character->country = $country;
        return $this;
    }

    function setSkinColor($color)
    {
        $this->character->color = $color;
        return $this;
    }
    
    function setJob($title)
    {
        $this->character->title = $title;
        return $this;
    }

    function isGraduated($isGraduated)
    {
        $this->character->isGraduated = $isGraduated;
        return $this;
    }

    function isParent($isParent)
    {
        $this->character->isParent = $isParent;
        return $this;
    }

    function getCharacter() {
        return $this->character;
    }
}

class Character {
    public $name, 
            $age, 
            $sex, 
            $nationality, 
            $country, 
            $color, 
            $title, 
            $isGraduated, 
            $isParent;
    
    // Instead of the below ugly telescoping constructor, define Builder class for this one!!!
    // public function __construct($name, $age, $sex, $nationality, $country, $color, $title, $isGraduated, $isParent) {}
}


$characterAli = (new CharacterBuilder())
            ->setName('ali')
            ->setSkinColor('Yellow')
            ->setAge(26)
            ->setNationality('Turkish')
            ->setResidency('Turkey')
            ->getCharacter();

$characterNaeim = (new CharacterBuilder())
            ->setName('Naeim')
            ->setAge(32)
            ->isParent(true)
            ->setSex('male')
            ->getCharacter();



// we can also have a Director class to set order of applied builder functions.
Class CharacterDirector {
    private $builder;

    public function __construct()
    {
        $this->setBuilder();
    }

    private function setBuilder()
    {
        $this->builder = new CharacterBuilder();
    }

    public function buildACharacterWithNameAndNationalityInfo()
    {
        return $this->builder
            ->setName('Fatemeh')
            ->setSex('Female')
            ->setNationality('Norwegian')
            ->setResidency('Sweden')
            ->getCharacter();
    }

    public function buildACharacterWithNameAndFamilyInfo()
    {
        return $this->builder
            ->setName('Samira')
            ->setAge(30)
            ->isParent(false)
            ->getCharacter();
    }
}

$fatemeh = (new CharacterDirector())->buildACharacterWithNameAndNationalityInfo();
$samira  = (new CharacterDirector())->buildACharacterWithNameAndFamilyInfo();

var_dump([
    'Ali'     => $characterAli,
    'Fatemeh' => $fatemeh,
    'Samira'  => $samira,
    'Naeim'   => $characterNaeim
]);