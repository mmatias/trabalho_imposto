<?php

	$val_bruto  = $_POST['val_bruto'];
?>
<!DOCTYPE html>
<html>
  <head>
	  <title>Salário Líquido</title>
	  <meta charset="utf-8">
    <style>
      table, td, th{
        border: 1px solid black;
      }
      table{
        border-collapse: collapse;
      }
    </style>    
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

        }else if ($val_bruto >= 1556.95 && $val_bruto <= 2594.92){
          $inss = $val_bruto*0.09;    

        }else if ($val_bruto >= 2594.93 && $val_bruto <= 5189.82){
          $inss = $val_bruto*0.11; 

        }else if($val_bruto > 5189.82){
          $inss = 570.88; 
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
        if ($val_bruto <= 1903.98){
          $impostoRenda = "0.00";

        }else if ($val_bruto >= 1903.99 && $val_bruto <= 2826.65){
          $impostoRenda = (($val_bruto*0.075) - 142.80 );   

        }else if ($val_bruto >= 2826.66 && $val_bruto <= 3751.05){
          $impostoRenda = (($val_bruto*0.15) - 354.80);  

        }else if ($val_bruto >= 3751.06 && $val_bruto <= 4664.68){
          $impostoRenda = (($val_bruto*0.225) - 636.13); 

        }else{
          $impostoRenda = (($val_bruto*0.275) - 869.36);    
        } 

        $valorTotalSal = $inss+$impostoRenda;
        $liquido= $val_bruto-$valorTotalSal;

        // Cálculo do Salário Bruto
        echo '<tr>';
        echo "<td> Salário Bruto </td>";
        echo "<td> <center> - </center> </td>";
        echo "<td> {$val_bruto}</td>";        
        echo "<td> <center> - </center> </td>"; 
        echo '</tr>';

        // Cálculo do INSS
        echo '<tr>';
        echo "<td> INSS </td>";
        echo "<td>{$inssRef}</td>";
        echo "<td> <center> - </center> </td>"; 
        echo "<td>{$inss}</td>";  
        echo '</tr>';

        // Cálculo do IRRF
        echo '<tr>';
        echo "<td> IRRF </td>";
        echo "<td>{$impostoRendaRef}</td>";
        echo "<td> <center> - </center> </td>"; 
        echo "<td>{$impostoRenda}</td>";  
        echo '</tr>';

        // Cálculo do Totais
        echo '<tr>';
        echo '<td colspan="2"> Totais </td>';
         echo "<td> {$val_bruto}</td>";     
        echo "<td>{$valorTotalSal}</td>";         
        echo '</tr>';

        // Salário Líquido
        echo '<tr>';
        echo '<td colspan="3"><h3> Salário Líquido </h3> </td>';
        echo "<td><h3>{$liquido}<h3></td>";        
        echo '</tr>';
      ?>
      </tbody>
    </table>
  </body>
</html>
