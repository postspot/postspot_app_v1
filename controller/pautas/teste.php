<?php

date_default_timezone_set('America/Sao_Paulo');
$date = date('Y-m-d H:i');
echo $date;

echo date('d/m/Y', strtotime("+2 days",strtotime($date))); 
