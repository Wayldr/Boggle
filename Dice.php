<?php
class Dice {
    private $_idDice;
    private $_face0;
    private $_face1;
    private $_face2;
    private $_face3;
    private $_face4;
    private $_face5;
    

    public function __construct($valeurs=array())
    {
        if(!empty($valeurs))
        $this->hydrate($valeurs);
    }
    private function hydrate($donnees){
        foreach ($donnees as $key => $value){
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method)){
                $this->$method($value);
            }        
        }
    }

    public function getIdDice(){
        return $this->_idDice;
    }
    public function setIdDice($_idDice){
        $this->_idDice = $_idDice;
        return $this;
    }
    public function getFace0(){
        return $this->_face0;
    }
    public function setFace0($_face0){
        $this->_face0 = $_face0;
        return $this;
    }
    public function getFace1()
    {
        return $this->_face1;
    }
    public function setFace1($_face1){
        $this->_face1 = $_face1;
        return $this;
    }
    public function getFace2(){
        return $this->_face2;
    }
    public function setFace2($_face2){
        $this->_face2 = $_face2;
        return $this;
    }
    public function getFace3(){
        return $this->_face3;
    }
    public function setFace3($_face3){
        $this->_face3 = $_face3;
        return $this;
    }
    public function getFace4(){
        return $this->_face4;
    }
    public function setFace4($_face4){
        $this->_face4 = $_face4;
        return $this;
    }
    public function getFace5(){
        return $this->_face5;
    }
    public function setFace5($_face5){
        $this->_face5 = $_face5;
        return $this;
    }

    public function rollDice(){
        $randomValue=rand(0,5);
        switch ($randomValue) {
            case '0':
                return $this->getFace0();
            case '1':
                return $this->getFace1();   
            case '2':
                return $this->getFace2();   
            case '3':
                return $this->getFace3();   
            case '4':
                return $this->getFace4();   
            case '5':
                return $this->getFace5();             
            default:
                break;
        }
    }
}
?>