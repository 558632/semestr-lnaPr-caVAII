<?php

class registracia
{
    private $krajina;
    private $obec;
    private $psc;
    private $ulica;
    private $cislo_popisne;
    private $telefon;
    private $email;
    private $cislo_op;
    private $meno;
    private $priezvisko;
    private $datum_narodenia;
    private $login;
    private $heslo;

    public function __construct($krajina, $obec, $psc, $ulica, $cislo_popisne, $telefon, $email, $cislo_op, $meno, $priezvisko, $datum_narodenia, $login, $heslo)
    {
        $this->krajina = $krajina;
        $this->obec = $obec;
        $this->psc = $psc;
        $this->ulica = $ulica;
        $this->cislo_popisne = $cislo_popisne;
        $this->telefon = $telefon;
        $this->email = $email;
        $this->cislo_op = $cislo_op;
        $this->meno = $meno;
        $this->priezvisko = $priezvisko;
        $this->datum_narodenia = $datum_narodenia;
        $this->login = $login;
        $this->heslo = $heslo;
    }

    /**
     * @return mixed
     */
    public function getKrajina()
    {
        return $this->krajina;
    }

    /**
     * @param mixed $krajina
     */
    public function setKrajina($krajina)
    {
        $this->krajina = $krajina;
    }

    /**
     * @return mixed
     */
    public function getObec()
    {
        return $this->obec;
    }

    /**
     * @param mixed $obec
     */
    public function setObec($obec)
    {
        $this->obec = $obec;
    }

    /**
     * @return mixed
     */
    public function getPsc()
    {
        return $this->psc;
    }

    /**
     * @param mixed $psc
     * @return registracia
     */
    public function setPsc($psc)
    {
        $this->psc = $psc;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUlica()
    {
        return $this->ulica;
    }

    /**
     * @param mixed $ulica
     */
    public function setUlica($ulica)
    {
        $this->ulica = $ulica;
    }

    /**
     * @return mixed
     */
    public function getCisloPopisne()
    {
        return $this->cislo_popisne;
    }

    /**
     * @param mixed $cislo_popisne
     */
    public function setCisloPopisne($cislo_popisne)
    {
        $this->cislo_popisne = $cislo_popisne;
    }

    /**
     * @return mixed
     */
    public function getTelefon()
    {
        return $this->telefon;
    }

    /**
     * @param mixed $telefon
     */
    public function setTelefon($telefon)
    {
        $this->telefon = $telefon;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getCisloOp()
    {
        return $this->cislo_op;
    }

    /**
     * @param mixed $cislo_op
     */
    public function setCisloOp($cislo_op)
    {
        $this->cislo_op = $cislo_op;
    }

    /**
     * @return mixed
     */
    public function getMeno()
    {
        return $this->meno;
    }

    /**
     * @param mixed $meno
     */
    public function setMeno($meno)
    {
        $this->meno = $meno;
    }

    /**
     * @return mixed
     */
    public function getPriezvisko()
    {
        return $this->priezvisko;
    }

    /**
     * @param mixed $priezvisko
     */
    public function setPriezvisko($priezvisko)
    {
        $this->priezvisko = $priezvisko;
    }

    /**
     * @return mixed
     */
    public function getDatumNarodenia()
    {
        return $this->datum_narodenia;
    }

    /**
     * @param mixed $datum_narodenia
     */
    public function setDatumNarodenia($datum_narodenia)
    {
        $this->datum_narodenia = $datum_narodenia;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getHeslo()
    {
        return $this->heslo;
    }

    /**
     * @param mixed $heslo
     */
    public function setHeslo($heslo)
    {
        $this->heslo = $heslo;
    }
}