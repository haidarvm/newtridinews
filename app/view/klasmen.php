<style>
         
         table td, table th{
         padding:0;
         font-family:Helvetica;font-size:16px;line-height:30px;color:#333333;
         width: 400px;
         border-color:#dddddd;
         white-space: nowrap;

         }
         
         table tbody tr:nth-child(odd) td, .game:nth-child(odd) div{
         background-color:#f5f5f5;}
         
         table th{
             display:none;font-weight:bold;background-color:#FFFFFF;color:#000000;
         }
         
         table tr:hover td{
         background-color:#ebe7e7;
         }
         
         a{
         color:333333;
         }
         .team_next_match .score{ font-size: 26px;color: #333333;font-weight:bold;;}.team_next_match .score a{ color: #333333;}
         
         </style>
        
         <?php

         $var = $url;

         $old = ['Pusamania Borneo', 'Cilegon United', 'Pusam', 'PSIS', 'Persik', 'Martapura', 'Surabaya', 'Bhayangkara  United', 'PS TNI'];
         $new = ['Borneo FC', 'RANS Nusantara', '', 'PSIS Semarang', 'Persik Kediri', 'Dewa United', '', 'Bhayangkara', 'Persikabo 1973'];

         $fctables =  str_replace($old, $new, $var);
         preg_match('/<table class=\"table\" cellspacing=\"0\" id=\"table\" data-id=\"36927\">(.*)<\/table>/', $fctables, $newfctables);
         ?>
         <?php
         echo  str_replace('class="table"', 'class="table-responsive"', $newfctables[0]);
         ?>  