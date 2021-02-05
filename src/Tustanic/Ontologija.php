<?php

namespace Tustanic;

/**
 * @Entity @Table(name="ontologija")
 **/


class Ontologija
{
    /** @id @Column(type="integer") @GeneratedValue **/
    protected $sifra;

    /**
    * @Column(type="string")
    */
    public $ime_nakladnika;

    /**
    * @Column(type="string")
    */
    public $mjesto_izdanja;

    /**
    * @Column(type="string")
    */
    public $jePreveo;

    /**
    * @Column(type="string")
    */
    public $jePrevedeno;

    /**
    * @Column(type="integer")
    */
    public $zaradioJe;

  public function getSifra(){
    return $this->sifra;
  }

  public function setSifra($sifra){
    $this->sifra = $sifra;
  }

  public function getIme_nakladnika(){
    return $this->ime_nakladnika;
  }

  public function setIme_nakladnika($ime_Nakladnika){
    $this->ime_nakladnika = $ime_Nakladnika;
  }

  public function getMjesto_izdanja(){
    return $this->mjesto_izdanja;
  }

  public function setMjesto_izdanja($mjesto_izdanja){
    $this->mjesto_izdanja = $mjesto_izdanja;
  }

  public function getJePreveo(){
    return $this->jePreveo;
  }

  public function setJePreveo($jePreveo){
    $this->jePreveo = $jePreveo;
  }

  public function getJePrevedeno(){
    return $this->jePrevedeno;
  }

  public function setJePrevedeno($jePrevedeno){
    $this->jePrevedeno = $jePrevedeno;
  }

  public function getZaradioJe(){
    return $this->zaradioJe;
  }

  public function setZaradioJe($zaradioJe){
    $this->zaradioJe = $zaradioJe;
  }

  public function setPodaci($podaci)
	{
		foreach($podaci as $kljuc => $vrijednost){
			$this->{$kljuc} = $vrijednost;
		}
	}

}

?>
