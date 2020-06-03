<?php
include "config.php";

if(!isset($_SESSION))
{
    session_start();
}

if(isset($_POST["view"])){

  if($_POST["view"] != ''){
    $update_q = mysqli_query($con,"UPDATE employees SET NOT_ID = 1 WHERE NOT_ID = 0");
  }

$result = mysqli_query($con,"SELECT * FROM employees WHERE NOT_ID = 0 ORDER BY ID DESC LIMIT 5");
$output = '';
date_default_timezone_set('Africa/Johannesburg');

if(mysqli_num_rows($result)>0){
  while($row=mysqli_fetch_array($result)){
            $output .= '<li>
                         <a class="dropdown-item d-flex align-items-center" href="#">
                         <span class="font-weight-bold">'.$row["PROJECT"].'</span>
                         <div class="small text-gray-500">'.date("mmm/dd/yyyy").' '. date("h:i:sa").'</div>
                         </a>
                        </li>';
              }

            } else{
            $output .= '<li>
                            <span class="font-weight-bold"> No Notifications Found</span>
                        </li>';
           }

           $result_1 = mysqli_query($con,"SELECT * FROM employees WHERE NOT_ID = 0 ");
           $count = mysqli_num_rows($result_1);
          // $result_2 = mysqli_query($con,"SELECT * FROM employees WHERE NOT_ID = 1 ");
          // $count1 = mysqli_num_rows($result_2);
           $data = array (
             'notification'         => $output,
             'unseen_notification'  => $count
           );

           echo json_encode($data);
          }


?>
