<?php
session_start();  
$var = false;
include("class.excel.writer.php");
if(isset($_REQUEST['imprimir1']))
{
   $xls = new ExcelWriter();
   $var = true;
   $arr = $_REQUEST['imprimir1'];
  // echo $arr;die;
   $obra = explode( ".",explode("*",explode("]",$arr)[0])[2]);
   $fechas = array(explode("*",$arr)[0],explode("*",$arr)[1]);
   $materiales = explode("|",explode("->",$arr)[1]);
   //echo $materiales[1];die;
   
   if(isset($obra) && isset($fechas) && isset($materiales))
   {
     $xls->OpenRow();
	    $xls->NewCell($obra[1]."->".$obra[0],false,array('align'=>'center','background'=>'0000FF','color'=>'FFFFFF','bold'=>true,'border'=>'000000','width'=>'125')); // escribe negrita
     $xls->CloseRow();
   
     $arreglo = array("Codigo","Descripcion","u/m","Cantidad","Precio MN","Importe MN","Precio CUC","Importe CUC");
   
     $xls->OpenRow();
	    foreach($arreglo as $cod=>$val)	$xls->NewCell($val,false,array('align'=>'center','width'=>'125','background'=>'666666','color'=>'FFFFFF','bold'=>true,'border'=>'000000'));
     $xls->CloseRow();

     for($i=0;$i<count($materiales);$i++)
     {
        $mat = explode(",",$materiales[$i]);
	    $xls->OpenRow();
	      for($j=0;$j<count($mat) && count($mat) > 2;$j++)
	      {
	         if($i == 3)
		     {
		        $xls->NewCell($mat[$j],false,array('border'=>'000000','color'=>'FF0000','width'=>'125'));
		     }
		     if($i == 5)
		     {
		        $xls->NewCell($mat[$j],false,array('border'=>'000000','color'=>'0DBEDD','width'=>'125'));
		     }
		     if($i == 7)
		     {
		        $xls->NewCell($mat[$j],false,array('border'=>'000000','color'=>'FF8000','width'=>'125'));
		     }
		     if($i != 7 && $i != 5 && $i != 3)
		     {
		       $xls->NewCell($mat[$j],false,array('border'=>'000000','width'=>'125'));
		     }
	      }
       $xls->CloseRow();  
    }
    $xls->GetXLS("Inventario de la obra ".$obra[1]." (".$obra[0].") entre ".$fechas[0]." y el ".$fechas[1]);
  }
  else
  {
    header ("location: ../Funcionalidades/resumen_de_materiales_por_obra.php");
  }
   
   
}



if($var == false)
{
  header ("location: ../Principal/principal.php");
}


?>
