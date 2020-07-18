<?php

include_once('../models/User.php');
include_once('../models/Passager.php');
include_once('../models/Reservation.php');
include_once('../models/Vol.php');

if(ISSET($_POST['rid'])){

     $id =$_POST['rid'];
     $output = '';
     $output2 = '';


	$reservation = new Reservation();
  	$res = $reservation -> reservation_show_id($id);
  	$rowid = $res->fetch_assoc(); 

     $vol = new Vol();
     $res1 = $vol -> vol_show_id($rowid['id_vol']);

     $passager = new Passager();
     $res2 = $passager -> passager_show_id($rowid['id_passager']);

     $output .= '  
     <div class="table-responsive"> 
          <h3>Passage information</h3> 
          <table class="table table-striped table-sm table-hover">';  

               if( $row2 = $res2->fetch_assoc()){ 
                    $output .= '  
                    <tr>  
                         <td width="30%"><label>Nom :</label></td>  
                         <td width="70%">'.$row2["nom_passager"].'</td>  
                    </tr>
                    <tr>  
                         <td width="30%"><label>Prenom :</label></td>  
                         <td width="70%">'.$row2["prenom_passager"].'</td>  
                    </tr> 
                    <tr>  
                         <td width="30%"><label>age :</label></td>  
                         <td width="70%">'.$row2["date_de_naissance"].'</td>  
                         </tr>
                    <tr>  
                         <td width="30%"><label>tele :</label></td>  
                         <td width="70%">'.$row2["phone_passager"].'</td>  
                         </tr> 
                    <tr>  
                         <td width="30%"><label>Email :</label></td>  
                         <td width="70%">'.$row2["email_passager"].'</td>  
                    </tr>  
                    <tr>  
                         <td width="30%"><label>Cin :</label></td>  
                         <td width="70%">'.$row2["cin_passager"].'</td>  
                    </tr> 
                    <tr>  
                         <td width="30%"><label>Nun Passport :</label></td>  
                         <td width="70%">'.$row2["n_passport_passager"].' </td>  
                    </tr> 
                    ';  
               }

          $output .= "</table>
     </div>";  
          //   ----------------------------------------------
          $output2 .= '  
          <hr>
     <div class="table-responsive">  
          <h3>Vol information</h3> 
          <table class="table table-striped table-sm table-hover">';  
               if( $row1 = $res1->fetch_assoc())  
               {  
                    $output2 .= '  
                    <tr>  
                         <td width="30%"><label>Depart :</label></td>  
                         <td width="70%">'.$row1["pays_depart"].'</td>  
                    </tr>  
                    <tr>  
                         <td width="30%"><label>Destination :</label></td>  
                         <td width="70%">'.$row1["pays_arrive"].'</td>  
                    </tr>  
                    <tr>  
                         <td width="30%"><label>Date depart :</label></td>  
                         <td width="70%">'.$row1["date_vol"].'</td>  
                    </tr>  
                    <tr>  
                         <td width="30%"><label>Prix :</label></td>  
                         <td width="70%">'.$row1["price"].'</td>  
                    </tr>  
                    <tr>  
                         <td width="30%"><label>Statut :</label></td>  
                         <td width="70%">'.$row1["statu_vol"].' </td>  
                    </tr>  
                    ';  
               }
          $output2 .= "</table>
     </div>";  
  
}

































































// $result =  $output2;

  $result = $output . $output2;
echo $result;


?>
