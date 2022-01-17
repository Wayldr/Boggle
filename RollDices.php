<?php
spl_autoload_register('monChargeur'); 
function monChargeur($classe){
    require $classe.'.php';
    }
$json=file_get_contents("DicesValue.json");
$arrDicesValues=json_decode($json,true);

$arrDices=array();

foreach ($arrDicesValues as $key => $value) { 
    $dice=new Dice($value);  
    $arrDices[]=$dice->rollDice();  
}
shuffle($arrDices);
echo json_encode($arrDices);
?>