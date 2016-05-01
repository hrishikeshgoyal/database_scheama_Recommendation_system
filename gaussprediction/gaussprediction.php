<?php
  

  include 'trainingdata.php';
  
  $mean = array(array (0,0,0,0,0,0,0,0,0),
                array (0,0,0,0,0,0,0,0,0),
                array (0,0,0,0,0,0,0,0,0),
                array (0,0,0,0,0,0,0,0,0),
                array (0,0,0,0,0,0,0,0,0),
                array (0,0,0,0,0,0,0,0,0)    );

  $mean_sum;//=array();


  $variance = array(
                array (0,0,0,0,0,0,0,0,0),
                array (0,0,0,0,0,0,0,0,0),
                array (0,0,0,0,0,0,0,0,0),
                array (0,0,0,0,0,0,0,0,0),
                array (0,0,0,0,0,0,0,0,0),
                array (0,0,0,0,0,0,0,0,0)    );


  $variance_sum;// = array();

  for ($k=1; $k<=5 ; $k++) {
  
        for ( $i=1; $i<=8;$i++) { 			



        		$mean_sum= 0; 
            $count =0;
        		for ($j=0;$j<200;$j++) {

                if ($dataset[$j][9]==$k ) {
                   
          			   $mean_sum += $dataset[$j][$i];
                   $count ++;
                }

        		}
        		
        		
        		$mean[$k][$i] = $mean_sum/$count;

        		//Calculating Varince for each value 
            $variance_sum =0;
        		for ($j=0;$j<200;$j++) {
        			

                if ($dataset[$j][9]==$k ) {
                   
                    
                   $variance_sum+= pow(($mean[$k][$i] - $dataset[$j][$i]),2);
                }
        			

        		}

            $variance[$k] [$i]= sqrt((float)$variance_sum/$count);
            if($variance[$k] [$i]==0)
            {
              $variance[$k] [$i]=0.1;
            }

             if($mean[$k] [$i]==0)
            {
              $variance[$k] [$i]=0.01;
            }

       }
  }

 echo implode(',', $mean[1]);


?>