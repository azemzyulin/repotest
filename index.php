<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Кредитный калькулятор</title>
<meta name="keywords" content="кредитный калькулятор, калькулятор кредита, кредит, калькулятор, сбербанк, аннуитентный, дифференцированный,расчет кредита" />
<meta name="description" content="Кредитный калькулятор или калькулятор кредита банков для онлайн расчета суммы платежа, реальной процентной ставки, переплаты. Возможность расчета по двум видам платежей, дифференцированный использует СберБанк. Кредитный калькулятор" />

<link href="style.css" rel="stylesheet" type="text/css" media="screen" />

<?php 
error_reporting(0);
$text = '';
$text = date("Y-m-d H:i:s").' ';
$text .=$_SERVER['REMOTE_ADDR'].' '.$_SERVER['HTTP_USER_AGENT'];
$text .= "\r\n";

$fp=@fopen("index_log.dat","a"); fputs($fp,"$text"); @fclose($fp);

echo "
<link rel=\"stylesheet\" href=\"http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css\" />
  <script src=\"http://code.jquery.com/jquery-1.8.3.js\"></script>
  <script src=\"http://code.jquery.com/ui/1.10.0/jquery-ui.js\"></script>
  <link rel=\"stylesheet\" href=\"/resources/demos/style.css\" />";

echo '<script>
  $(function() {
    $( "#datepicker" ).datepicker({ dateFormat: "dd.mm.yy",monthNames: ["Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь"],firstDay:1,dayNamesMin: ["вс","пн", "вт", "ср", "чт", "пт", "суб"]});
    $( "#anim" ).change(function() {
      $( "#datepicker" ).datepicker( "option", "showAnim", $( this ).val() );
    });
  });
  
  $(function() {
    $( "#datepicker2" ).datepicker({ dateFormat: "dd.mm.yy",monthNames: ["Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь"],firstDay:1,dayNamesMin: ["вс","пн", "вт", "ср", "чт", "пт", "суб"]});
    $( "#anim" ).change(function() {
      $( "#datepicker2" ).datepicker( "option", "showAnim", $( this ).val() );
    });
  });   
  </script>';
  ?>


</head>
<body>


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

if (isset($_REQUEST['sum_kredita']) and isset($_REQUEST['procent']) and
   isset($_REQUEST['month_count']) and isset($_REQUEST['date_st']) ) {
   $sum_kredita = (float)str_replace(",",".",$_REQUEST['sum_kredita']);
   if ($sum_kredita < 1000 or $sum_kredita > 100000000) {
      $sum_kredita = 1000;
   }
   $procent = (float)str_replace(",",".",$_REQUEST['procent']);
   if ($procent <= 0 or $procent > 100) {
      $procent = 12;
   }
   $procent2 = $procent;
   $month_count = (int)$_REQUEST['month_count'];
   $date_start = TRIM($_REQUEST['date_st']);
   $date_start2=$date_start;
   $plateg = TRIM($_REQUEST['plateg']);
   
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


?>





<div id="header-wrapper">
	<div id="header">
		<div id="menu">
			<ul>
				<li class="current_page_item"><a href="index.php">Главная</a></li>
				<li><a href="raschet.php" target="_blank">Параметры расчета</a></li>
				<!-- <li><a href="#">About</a></li>-->
				<li><a href="#" class="last">Обратная связь</a></li>
			</ul>
		</div>
		<!-- end #menu -->
		<div id="search">
			<form method="get" action="http://www.google.ru/search" target="_blank">
				<fieldset>
					<input type="text" name="s" id="search-text" size="15" />
					<input type="submit" id="search-submit" value="Поиск" />
				</fieldset>
			
				
			</form>
		</div>
		<!-- end #search -->
	</div>
</div>
<!-- end #header -->
<!-- end #header-wrapper -->
<div id="logo">
	<h1>Credit talk</h1>
	<p><em> Расчитай свой кредит</em></p>
</div>
<hr />
<!-- end #logo -->
<div id="page">
	<div id="page-bgtop">
		<div id="content">
			<div class="post">
				<h2 class="title"><a>Кредитный калькулятор</a></h2><br>
				<p class="meta"><span class="date">Параметры кредита</span></p>
				
				<div class="entry">


				
<form action=index.php name=credit  method=post>

Сумма кредита, руб:<br>
<input name="sum_kredita" type="text" value="<?php echo $sum_kredita ?>"> (1000 - ... рублей)<br>
Процентная ставка, %:<br>
<input name="procent" type="text" value="<?php echo  $procent ?>"> (Например 11.7)<br>
Срок кредита:<br>

<input name="month_count" type="text" value="
<?php echo $month_count ?>
"> (Количество месяцев) <br>
Дата получения кредита:<br>
<input type="text"  name="date_st" size="9" value="<?php echo $date_start ?>" id=datepicker2 /><br>
 <p>Вид платежа:<Br>
   <input type="radio" name="plateg" value="anu" <?php echo $checked1 ?>> Аннуитентный<Br>
   <input type="radio" name="plateg" value="diff" <?php echo $checked2 ?>> Дифференцированный<Br>
  </p>
<input type="submit" value="Рассчитать">
</form>

				</div>			
			
					<!--<p>This is <strong>Predilection </strong>, a free, fully standards-compliant CSS template designed by <a href="http://www.freecsstemplates.org/">Free CSS Templates</a>, released for free under the <a href="http://creativecommons.org/licenses/by/2.5/">Creative Commons Attribution 2.5</a> license.  You're free to use this template for anything as long as you link back to <a href="http://www.freecsstemplates.org/">my site</a>. Enjoy :)</p>
					<p>Sed lacus. Donec lectus. Nullam pretium nibh ut turpis. Nam bibendum. In nulla tortor, elementum ipsum. Proin imperdiet est. Phasellus dapibus semper urna. Pellentesque ornare, orci in felis. </p>
				-->
				
				



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
	$output .= '<br>
	<table width="100%" align="center" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="100%" height="30" align="center" valign="middle">
<p class="meta"><span class="date">График платежей</span></p>';
//<span class="title2">График платежей</span>';

	
	
//<a href="#print-this-document" onclick="print(); return false;">Распечатать</a>

//if ($allow_calc) { 

$output .= '
<form action=print.php name=priting  method=post target="_blank">
<input name="sum_kredita2" type="hidden" value="'.$sum_kredita.'">
<input name="procent2" type="hidden" value="'.$procent2.'"> 
<input name="month_count2" type="hidden" value="'.$month_count.'"> 
<input type="hidden"  name="date_st2" size="9" value="'.$date_start2.'" >
<input type="hidden" name="plateg2" value="'.$plateg.'">
<input type="submit" value="Распечатать">
</form>
';
//}
$output .= '</td>
</tr>
</table>';
	
	 $output .= '<div class="entry">';
    $output .= sprintf('Сумма кредита: %s рублей; Процентная ставка: %s в год; Срок: %s мес. ', number_format($sum_kredita, 2, '.', ' '), $procent*100, $month_count) ;
    $output .= '<br>';

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
   $out .= '</table></div>';
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

	$output .= '<br>
	<table width="100%" align="center" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="100%" height="30" align="center" valign="middle">
<p class="meta"><span class="date">График платежей</span></p>';
	
	


//if ($allow_calc) { 

$output .= '
<form action=print.php name=priting  method=post target="_blank">
<input name="sum_kredita2" type="hidden" value="'.$sum_kredita.'">
<input name="procent2" type="hidden" value="'.$procent2.'"> 
<input name="month_count2" type="hidden" value="'.$month_count.'"> 
<input type="hidden"  name="date_st2" size="9" value="'.$date_start2.'" >
<input type="hidden" name="plateg2" value="'.$plateg.'">
<input type="submit" value="Распечатать">
</form>
';
//}
$output .= '</td>
</tr>
</table>';
		  
	  
	  
	$output .= '<div class="entry">';
    $output .= sprintf('Сумма кредита: %s рублей; Процентная ставка: %s  в год; Срок: %s мес. ', number_format($sum_kredita, 2, '.', ' '), $procent*100, $month_count) ;
    $output .= '<br>';

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
   $out .= '</table></div>';
   $output .= $out;	  


}


?>

<?php
echo $output;
?>


				
				

			</div>
			
			
			
		<!--	
			<div class="post">
				<p class="meta"><span class="date">Sunday, April 26, 2009</span> 7:27 AM Posted by <a href="#">Someone</a></p>
				<h2 class="title"><a href="#">Lorem ipsum sed aliquam</a></h2>
				<div class="entry">
					<p>Sed lacus. Donec lectus. Nullam pretium nibh ut turpis. Nam bibendum. In nulla tortor, elementum vel, tempor at, varius non, purus. Mauris vitae nisl nec   consectetuer. Donec ipsum. Proin imperdiet est. Phasellus <a href="#">dapibus semper urna</a>. Pellentesque ornare, orci in consectetuer hendrerit, urna elit eleifend nunc, ut consectetuer nisl felis ac diam. Etiam non felis. Donec ut ante. In id eros.</p>
				</div>
			</div>
			<div class="post">
				<p class="meta"><span class="date">Sunday, April 26, 2009</span> 7:27 AM Posted by <a href="#">Someone</a></p>
				<h2 class="title"><a href="#">Lorem ipsum sed aliquam</a></h2>
				<div class="entry">
					<p>Mauris vitae nisl nec metus placerat consectetuer. Donec ipsum. Proin imperdiet est. Sed lacus. Donec lectus. Nullam pretium nibh ut turpis. Nam bibendum. In nulla tortor, elementum vel, tempor at, varius non, purus. Mauris vitae nisl nec metus placerat consectetuer. Donec ipsum. Proin imperdiet est. Phasellus <a href="#">dapibus semper urna</a>. Pellentesque ornare, orci in consectetuer hendrerit, urna elit eleifend nunc, ut consectetuer nisl felis ac diam. </p>
				</div>
			</div> -->
		</div>
		<!-- end #content -->
		<div id="sidebar">
			<ul>
				<li>
					<h2>О нас</h2>
					<p>В отделениях банка бывают очереди, а наш онлайн калькулятор свободен всегда.</p>
				</li>
				<li>
					<h2>Кредитный продукт </h2>
					<ul>
						<li><a href="index.php">Денежный кредит</a></li>
						<li><a href="ipoteka.php">Ипотечный кредит</a></li>

					</ul>
				</li>
			<!--	<li>
					<h2>Turpis nulla</h2>
					<ul>
						<li><a href="#">Nec metus sed donec</a></li>

					</ul>
				</li>
				-->
			</ul>
		</div>
		<!-- end #sidebar -->
		<div style="clear: both;">&nbsp;</div>
	</div>
	<!-- end #page -->
</div>
<div id="footer">
	<p>Copyright (c) 2014 credit-talk.ru. <a href="mailto:credit-talk@mail.ru">credit-talk@mail.ru </a></p>
</div>
<!-- end #footer -->
</body>
</html>
