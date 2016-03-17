<?php

	$val_bruto  = $_POST['val_bruto'];
?>
<!DOCTYPE html>
<html>
  <head>
	  <title>Salário Líquido</title>
	  <meta charset="utf-8">
      <link href="estilo.css" rel="stylesheet" type="text/css" > 
  </head>
  <body>
    <table>
      <thead>
        <tr>
          <th>Evento</th>
          <th>Ref.</th>
          <th>Proventos</th>
          <th>Descontos</th>
        </tr> 
      </thead>
      <tbody>
      <?php

        //Inicialização de Variáveiss
        $inssRef = 0;  
        $inss = 0;
        $inss_salario = 0;
        $impostoRendaRef = 0;
        $impostoRenda = 0;
        

        //Referência do INSS em porcentagem
        if($val_bruto <= 1556.94){
          $inssRef = "8,00%";  

        }else if ($val_bruto >= 1556.95 && $val_bruto <= 2594.92){
          $inssRef = "9,00%"; 

        }else if ($val_bruto >= 2594.93 && $val_bruto <= 5189.82){
          $inssRef = "11,00%"; 

        }else if($val_bruto > 5189.82){
          $inssRef = "Teto Salarial"; 
        }

        //INSS 
        if($val_bruto <= 1556.94){
          $inss = $val_bruto*0.08;
          $inss_salario = $val_bruto - $inss;      

        }else if ($val_bruto >= 1556.95 && $val_bruto <= 2594.92){
          $inss = $val_bruto*0.09;    
          $inss_salario = $val_bruto - $inss;  

        }else if ($val_bruto >= 2594.93 && $val_bruto <= 5189.82){
          $inss = $val_bruto*0.11; 
          $inss_salario = $val_bruto - $inss;  

        }else if($val_bruto > 5189.82){
          $inss_auxiliar = 5189.82;
          $inss = $inss_auxiliar * 0.11;
          $inss_salario = $val_bruto - $inss;  
        }       

        //Referência do Imposto de Renda em porcentagem
        if ($val_bruto <= 1903.98){
          $impostoRendaRef = "0,0%";

        }else if ($val_bruto >= 1903.99 && $val_bruto <= 2826.65){
          $impostoRendaRef = "7,50%";  

        }else if ($val_bruto >= 2826.66 && $val_bruto <= 3751.05){
          $impostoRendaRef = "15%";

        }else if ($val_bruto >= 3751.06 && $val_bruto <= 4664.68){
         $impostoRendaRef = "22,5%"; 

        }else{
          $impostoRendaRef = "27,5%";
        } 

        // Imposto de Renda
        if ($inss_salario <= 1903.98){
          $impostoRenda = "0.00";

        }else if ($inss_salario >= 1903.99 && $inss_salario <= 2826.65){
          $impostoRenda = (($inss_salario*0.075)-142.80);   

        }else if ($inss_salario >= 2826.66 && $inss_salario <= 3751.05){
          $impostoRenda = (($inss_salario*0.15)-354.80);  

        }else if ($inss_salario >= 3751.06 && $inss_salario <= 4664.68){
          $impostoRenda = (($inss_salario*0.225)-636.13); 

        }else{
          $impostoRenda = (($inss_salario*0.275)-869.36);    
        } 

        $valorTotalSal = $inss + $impostoRenda;
        $liquido = (($val_bruto - $inss) - $impostoRenda);

        //Insere duas casas decimais
        $inss          = number_format($inss,2);
        $val_bruto     = number_format($val_bruto,2);
        $impostoRenda  = number_format($impostoRenda,2);
        $valorTotalSal = number_format($valorTotalSal,2);
        $liquido       = number_format($liquido,2);

        // Cálculo do Salário Bruto
        echo '<tr>';
        echo "<td> Salário Bruto </td>";
        echo "<td> <center> - </center> </td>";
        echo "<td> R$ {$val_bruto} </td>";        
        echo "<td> <center> - </center> </td>"; 
        echo '</tr>';

        // Cálculo do INSS
        echo '<tr>';
        echo "<td> INSS </td>";
        echo "<td> {$inssRef} </td>";
        echo "<td> <center> - </center> </td>"; 
        echo "<td> R$ {$inss}</td>";  
        echo '</tr>';

        // Cálculo do IRRF
        echo '<tr>';
        echo "<td> IRRF </td>";
        echo "<td> {$impostoRendaRef} </td>";
        echo "<td> <center> - </center> </td>"; 
        echo "<td> R$ {$impostoRenda} </td>";  
        echo '</tr>';

        // Cálculo do Totais
        echo '<tr>';
        echo '<td colspan="2"> Totais </td>';
        echo "<td> R$ {$val_bruto}</td>";     
        echo "<td> R$ {$valorTotalSal}</td>";         
        echo '</tr>';

        // Salário Líquido
        echo '<tr>';
        echo '<td colspan="3"><h3> Salário Líquido </h3> </td>';
        echo "<td><h3> R$ {$liquido}<h3></td>";        
        echo '</tr>';
      ?>
      </tbody>
    </table>
  </body>
</html>
