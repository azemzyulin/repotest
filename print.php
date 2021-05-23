<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Кредитный калькулятор</title>
<meta name="keywords" content="кредитный калькулятор, калькулятор кредита, кредит, калькулятор, сбербанк, аннуитентный, дифференцированный,расчет кредита" />
<meta name="description" content="Кредитный калькулятор или калькулятор кредита банков для онлайн расчета суммы платежа, реальной процентной ставки, переплаты. Возможность расчета по двум видам платежей, дифференцированный использует СберБанк. Кредитный калькулятор" />

<link href="style.css" rel="stylesheet" type="text/css" media="screen" />

<!--
<style type="text/css">
a:active,a:visited,a:link {
color: #4b719e;
text-decoration:none;
}
a:hover {
color: #4b719e;
text-decoration: underline;
}
.title {
color: #333333;
font-size: 26px;
font-family: georgia;
font-weight: normal;
padding-left: 6px;
}
.text {
font-family:Tahoma;
font-weight:normal;
font-size:12px;
color:#365069;
}
hr {
width: 100%;
height: 1px;
border: 0;
background: #B9D2E2;
color: #B9D2E2
}
table.credit {
width:100%;
border:1px solid #c0c0c0;
background-color:#ffffff;
}
table.credit tr {
background-color:#f8f8f8;
}
table.credit tr:hover {
background-color:#ffffff;
}
table.credit td{
padding:1px;
text-align:center;
}
table.credit th{
border:0px;
color:#333333;
background-color:#D5E7F3;
padding:2px;
text-align:center;
font-size:12px;
}

</style>
-->

<?php 

  ?>
  
</head>


<?php 

error_reporting(0);

$allow_month = array(
   1=> 'янв',
   2=> 'фев',
   3=> 'мар',
   4=> 'апр',
   5=> 'май',
   6=> 'июн',
   7=> 'июл',
   8=> 'авг',
   9=> 'сен',
   10=> 'окт',
   11=> 'ноя',
   12=> 'дек'
);

$allow_calc = false;
$date_start=date("d.m.Y");
$srok_opt = '';
$m_opt = '';
$sum_kredita = 1000;
$procent = 15;
$month_count = 6;
$date_st = '';
$plateg = '';
$checked1 ='checked';
$checked2 = '';
//echo "<br>1".$_REQUEST['sum_kredita2'];
//echo "<br>2".$_REQUEST['procent2'];
//echo "<br>3".$_REQUEST['month_count2'];
//echo "<br>4".$_REQUEST['date_st2'];
//echo "<br>4".$_REQUEST['plateg2'];

if (isset($_REQUEST['sum_kredita2']) and isset($_REQUEST['procent2']) and
   isset($_REQUEST['month_count2']) and isset($_REQUEST['date_st2']) ) {
   $sum_kredita = (float)str_replace(",",".",$_REQUEST['sum_kredita2']);
  // if ($sum_kredita < 1000 or $sum_kredita > 100000000) {
  //    $sum_kredita = 1000;
  // }
   $procent = (float)str_replace(",",".",$_REQUEST['procent2']);
   //if ($procent <= 0 or $procent > 100) {
   //   $procent = 12;
   //}
   $month_count = (int)$_REQUEST['month_count2'];
   $date_start = TRIM($_REQUEST['date_st2']);
   $plateg = TRIM($_REQUEST['plateg2']);
   
   $output = '';
   
   //echo $plateg;
   if ($plateg=='anu') {
   $checked1 ='checked'; 
   $checked2 = '';}
   else {
	$checked1 = '';
	$checked2 ='checked';
	}
   
   $allow_calc = true;
} else {
    $allow_calc = false;
}
if ($allow_calc) { 
echo "
<link rel=\"stylesheet\" href=\"http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css\" />
  <script src=\"http://code.jquery.com/jquery-1.8.3.js\"></script>
  <script src=\"http://code.jquery.com/ui/1.10.0/jquery-ui.js\"></script>
  <link rel=\"stylesheet\" href=\"/resources/demos/style.css\" />";

echo '<SCRIPT LANGUAGE="javascript"></SCRIPT>';
echo '<body onload="window.print()">';
$start=1;}
else {echo '<body>';
include "index.php";
$start=0;}


?>

<?php
error_reporting(0);

if ($start==1) { 


$text = '';
$text = date("Y-m-d H:i:s").' ';
$text .=$_SERVER['REMOTE_ADDR'].' '.$_SERVER['HTTP_USER_AGENT'];
$text .= "\r\n";

$fp=@fopen("print_log.dat","a"); fputs($fp,"$text"); @fclose($fp);

echo '
<table width="750" align="center" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="100%" height="30" align="center" valign="middle" style="border-left: 1px solid #D5E7F3; border-right: 1px solid #D5E7F3; border-top: 1px solid #D5E7F3;" bgcolor="#D5E7F3">
<span class="title">График платежей</span>
</td>
</tr>
</table>
<table width="750" align="center" border="0" cellspacing="1" cellpadding="0" bgcolor="#D5E7F3" class="text">
<tr>
<td>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#f5f8fa"><tr>
<td width="100%" style="padding-top:25px; padding-right:20px; padding-left:20px;" valign="top"><div class="text">

Сумма кредита: ';
echo number_format($sum_kredita, 2, '.', ' ');
echo ' руб. <br>
Процентная ставка: ';
echo  $procent;
echo '% в год.<br>
Срок кредита:  ';
echo $month_count;
echo ' месяцев.<br>
Дата получения кредита: ';
echo $date_start;
echo ' г.<br>
Вид платежа:  ';
if ($plateg=='anu') { 
echo 'Аннуитентный';} else echo 'Дифференцированный';
echo '<Br>';

}

?>

<?php

if ($allow_calc) { 

if ($plateg=='anu') { 

//Платежные период
$date_period = array();

for ($i = 0; $i < $month_count; $i++) {

$month = explode(".",$date_start);
$date_beg = date('d.m.Y',mktime(0,0,0,$month[1],1,$month[2]));
$date = date_create($date_beg);
date_add($date, date_interval_create_from_date_string('+1 month'));
$date_start=date_format($date, 'd.m.Y');
$date_period[$i]=$allow_month[date_format($date, 'n')].'.'.date_format($date, 'Y');
}


   //платежи по месяцам
   $proc_pogash = array();
   $vsego = array();
   for ($i = 0; $i < $month_count; $i++) {
      $vsego[] = ($sum_kredita*($procent/100/12)/(1-1/(pow(1+($procent/100/12),$month_count))));
//($vsego[$i]."   ");
	  }
	  
	     //проценты по месяцам
   $procent=$procent/100;
   $procents = array();
   $ostatok_osn_dolga[] = array();
   $osnovnoy_dolg = array();
   $vsego_ost = $sum_kredita;
   for ($i = 0; $i < $month_count; $i++) 
{	
	$procents[$i]=($vsego_ost*($procent/12));
	$osnovnoy_dolg[]=($vsego[$i]-$vsego_ost*($procent/12));
	$vsego_ost=($vsego_ost-($osnovnoy_dolg[$i]));
	$ostatok_osn_dolga[$i]=$vsego_ost;

//print_r($procents[$i]."   ");
//print_r($osnovnoy_dolg[$i]."   ");
//echo $zag."-----<br>";
   }
	     $output .= '<br><br>';
   // $output .= sprintf('Сумма кредита: %s рублей; Процентная ставка: %s ; Срок: %s мес. ', number_format($sum_kredita, 2, '.', ' '), $procent*100, $month_count) ;
   // $output .= '<br><br>';

   $out = '<table class="credit">';
      $out .=   '<tr><th width=10%>№ платежа</th><th width=12%>Период платежа</th><th width=20%>Остаток основного долга, руб</th><th width=20%>Основной долг, руб</th><th width=18%>Процент, руб</th><th width=20%>Ежемесячный платеж, руб</th></tr>';
   for ($i = 0; $i < $month_count; $i++) {
   if ($vsego[$i]<0) {
   $vsego[$i]=0;
   }
      $out .=   sprintf('<tr><td>%s  </td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>',
         ($i+1), $date_period[$i], 
number_format(round($ostatok_osn_dolga[$i],2), 2, '.', ' '),
number_format(round($osnovnoy_dolg[$i],2), 2, '.', ' '), 
number_format(round($procents[$i],2), 2, '.', ' '), 
number_format(round($vsego[$i],2), 2, '.', ' ')
);
   }
      $out .=   sprintf('<tr><td colspan="3"><b>Итого:</b></td><td><b>%s</b></td><td><b>%s</b></td><td><b>%s</b></td></tr>',
         number_format(array_sum($osnovnoy_dolg), 2, '.', ' '), number_format(array_sum($procents), 2, '.', ' '),  number_format(array_sum($vsego), 2, '.', ' '));
   $out .= '</table>';
   $output .= $out;
	  
}
//Конец ануитентный
}

//Дифференцированные платежи
if ($plateg == 'diff') {
//Платежные период
$date_period = array();

for ($i = 0; $i < $month_count; $i++) {
$month = explode(".",$date_start);
$date_beg = date('d.m.Y',mktime(0,0,0,$month[1],1,$month[2]));
$date = date_create($date_beg);
date_add($date, date_interval_create_from_date_string('+1 month'));
$date_start=date_format($date, 'd.m.Y');
$date_period[$i]=$allow_month[date_format($date, 'n')].'.'.date_format($date, 'Y');
}
   //основной долг, проценты, остаток по месяцам
   $proc_pogash = array();
   $osnovnoy_dolg = array();
   //$vsego = array();
   $procent=$procent/100;
   $vsego_ost = $sum_kredita;
   for ($i = 0; $i < $month_count; $i++) {
      $osnovnoy_dolg[] = $sum_kredita/$month_count;
	  $procents[$i]=$vsego_ost*$procent/12;
	  $vsego_ost=($vsego_ost-($osnovnoy_dolg[$i]));
	$ostatok_osn_dolga[$i]=$vsego_ost;
	
	
//($vsego[$i]."   ");
	  }

//   for ($i = 0; $i < $month_count; $i++) 
		  
	  
	  
	     $output .= '<br><br>';
   // $output .= sprintf('Сумма кредита: %s рублей; Процентная ставка: %s /% в год; Срок: %s мес. ', number_format($sum_kredita, 2, '.', ' '), $procent*100, $month_count) ;
   // $output .= '<br><br>';

   $out = '<table class="credit">';
      $out .=   '<tr><th width=15%>№ платежа</th><th width=10%>Период платежа</th><th width=20%>Остаток основного долга, руб</th><th width=20%>Основной долг, руб</th><th width=15%>Процент, руб</th><th width=20%>Ежемесячный платеж, руб</th></tr>';
   for ($i = 0; $i < $month_count; $i++) {
   if ($vsego[$i]<0) {
   $vsego[$i]=0;
   }
      $out .=   sprintf('<tr><td>%s  </td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>',
         ($i+1), $date_period[$i], 
number_format(round($ostatok_osn_dolga[$i],2), 2, '.', ' '),
number_format(round($osnovnoy_dolg[$i],2), 2, '.', ' '), 
number_format(round($procents[$i],2), 2, '.', ' '), 
number_format(round(($osnovnoy_dolg[$i]+$procents[$i]),2), 2, '.', ' ')
);
   }
      $out .=   sprintf('<tr><td colspan="3"><b>Итого:</b></td><td><b>%s</b></td><td><b>%s</b></td><td><b>%s</b></td></tr>',
         number_format(array_sum($osnovnoy_dolg), 2, '.', ' '), number_format(array_sum($procents), 2, '.', ' '),  number_format(array_sum($osnovnoy_dolg)+array_sum($procents), 2, '.', ' '));
   $out .= '</table>';
   $output .= $out;	  


}


?>

<?php
echo $output;
?>


</div></td></tr></table>

</td>
</tr>
</table>
</body>
</html> 
