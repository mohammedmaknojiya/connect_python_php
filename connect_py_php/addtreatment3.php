<?php
/*For My LocalPC*/
$con=mysqli_connect ("localhost", "root", "") or die ('I cannot connect to the database because: ' . mysql_error());
mysqli_select_db ($con,'hospital_login_db');
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Add Treatment</title>
  </head>
  <body>
      <h1 class="text-center bg-info">ADD TREATMENT</h1>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  
    <!----nav bar-->

<nav class="navbar navbar-expand-lg navbar-light bg-light">
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <!--<li class="nav-item active">
              <a class="nav-link" href="index.php">HOME <span class="sr-only">(current)</span></a>
            </li> -->
            <li class="nav-item">
                    <a class="nav-link" href="profile.php">PROFILE</a>
                  </li>
            <li class="nav-item">
              <a class="nav-link" href="addtreatment.php">ADD-TREATMENT</a>
            </li>
            <li class="nav-item">
                    <a class="nav-link" href="#">TOKEN</a>
                  </li>
            <li class="nav-item">
                <a class="nav-link" href="feedback.php">FEEDBACK</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="adminlogin.php">ADMIN-LOGIN</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="map.php">MAP</a>
                  </li>
                  <li class="nav-item">
                        <a class="nav-link" href="index.php">LOGOUT</a>
                </li>

             
          </ul>
        </div>
      </nav>
    
      <br><br><br>
    
    
    <!----registration form making -->
<div class="text-center">
    <form action="addtreatment.php" method="post">
            Treatment Type:<br>
            <input type="text" name="treatment" list="treat">
            <datalist id="treat">
                <option value="xray"></option>
                <option value="fracture"></option>
                <option value="others"></option>
                <option value="fever"></option>
                <option value="bloodcheck"></option>
                <option value="mri"></option>
                <option value="sonography"></option>
                <!--<option value="admit"></option> -->
            </datalist>
            <br>
            Age:<br>
            <input type="number" name="age" >
            <br>
            Gender:
            <input type="radio" name="gender" value="male"> Male
            <input type="radio" name="gender" value="female"> Female
            <!--<input type="radio" name="gender" value="other"> Other -->
            <br>
            Choose Date:<br>
            <input type="date" name="date" >
            <br>
            Phone Number:<br>
            <input type="number"  name="phone"  >
            <br>
            <!--Choose Time:<br>
            <input type="time" name="time" >
            <br>-->
            
        <br>
        <input type="submit" value="Register" name="btnclick">
      </form>

</div>
    </body>
</html>


<!------php code-->

<?php
      
      
if(isset($_POST['btnclick']))
{
    @$treatment=$_POST['treatment'];
    @$age=$_POST['age'];
    @$gender=$_POST['gender'];
    @$date=$_POST['date'];
    @$phone=$_POST['phone'];

    //getting user register time at time of registration
    $time_now=mktime(date('h')+5,date('i')+30,date('s'));
    @$time = date(' H:i:s', $time_now);
    
    
    $query = "insert into add_treatment_online(treatment_type,date,time) values('$treatment','$date','$time')";
		$query_run = mysqli_query($con,$query);
				
        
 /////////////////////////////////////// FRACTURE : FEVER : OTHERS  DOC-CABIN  //////////////////////////////////       
    if($treatment=='fracture' or $treatment=='fever' or $treatment=='others')
    {
        
        //my defined time from enter gate to lab
        $distlabfrom= '00:01:00';
        
        
        //giving different treatment time to different disease
/////////////////////GIVING CONDITION FOR GENDER , AGE AND GIVE TIME FOR PARTICULAR TREATMENT ///////////////////

            if($treatment='fracture')
            {
                        
                        if(  (1<=$age) && ($age<5)  )
                        {
                          if ($gender=='male')
                          {
                            $treattime="00:30:00";
                          }
                          else if($gender=='female')
                          {
                            $treattime="00:30:00";
                          }
                        }
              
                        else if(  (5<=$age) && ($age<15)  )
                        {
                          if ($gender=='male')
                          {
                            $treattime="00:25:00";
                          }
                          else if($gender=='female')
                          {
                            $treattime="00:25:00";
                          }
                        }

                        else if(  (15<=$age) && ($age<50)  )
                        {
                          if ($gender=='male')
                          {
                            $treattime="00:25:00";
                          }
                          else if($gender=='female')
                          {
                            $treattime="00:25:00";
                          }
                        }

                        
                        else if(50<=$age)
                        {
                          if ($gender=='male')
                          {
                            $treattime="00:30:00";
                          }
                          else if($gender=='female')
                          {
                            $treattime="00:30:00";
                          }
                        }

            }


            else if($treatment='fever')
            {
                        
                        if(  (1<=$age) && ($age<5)  )
                        {
                          if ($gender=='male')
                          {
                            $treattime="00:10:00";
                          }
                          else if($gender=='female')
                          {
                            $treattime="00:10:00";
                          }
                        }
              
                        else if(  (5<=$age) && ($age<15)  )
                        {
                          if ($gender=='male')
                          {
                            $treattime="00:07:00";
                          }
                          else if($gender=='female')
                          {
                            $treattime="00:07:00";
                          }
                        }

                        else if(  (15<=$age) && ($age<50)  )
                        {
                          if ($gender=='male')
                          {
                            $treattime="00:05:00";
                          }
                          else if($gender=='female')
                          {
                            $treattime="00:05:00";
                          }
                        }

                        
                        else if(50<=$age)
                        {
                          if ($gender=='male')
                          {
                            $treattime="00:08:00";
                          }
                          else if($gender=='female')
                          {
                            $treattime="00:08:00";
                          }
                        }

            }


            else if($treatment='others')
            {
                        
                       if(  (1<=$age) && ($age<5)  )
                        {
                          if ($gender=='male')
                          {
                            $treattime="00:15:00";
                          }
                          else if($gender=='female')
                          {
                            $treattime="00:15:00";
                          }
                        }
              
                        else if(  (5<=$age) && ($age<15)  )
                        {
                          if ($gender=='male')
                          {
                            $treattime="00:10:00";
                          }
                          else if($gender=='female')
                          {
                            $treattime="00:10:00";
                          }
                        }

                        else if(  (15<=$age) && ($age<50)  )
                        {
                          if ($gender=='male')
                          {
                            $treattime="00:10:00";
                          }
                          else if($gender=='female')
                          {
                            $treattime="00:10:00";
                          }
                        }

                        
                        else if(50<=$age)
                        {
                          if ($gender=='male')
                          {
                            $treattime="00:10:00";
                          }
                          else if($gender=='female')
                          {
                            $treattime="00:10:00";
                          }
                        }

            }

////////////////////////////////////////END HERE////////////////////////////////////////////////////

        //adding distlabfrom and user register time to get timetolab
        $secs = strtotime($distlabfrom)-strtotime('00:00:00');
        $timetolab = date("H:i:s",strtotime($time)+$secs);
        


        if($treatment=='fracture' or $treatment=='fever' or $treatment=='others')
        {

          //getting out time of previous user 
        $treatstartdoc= "select out_time_doc from doctor_cabin_entry_table ORDER BY token_no DESC LIMIT 1 ";
        $query_runn = mysqli_query($con,$treatstartdoc);
        if(mysqli_num_rows($query_runn)>0)
        {
          while($row=mysqli_fetch_assoc($query_runn))
          {
              $query_run1=$row["out_time_doc"];
          }
        }
        
          
          //adding outtime of previous patient and and current user treattime to get outtimedoc means outtime of patient after treatment

        $secs = strtotime($treattime)-strtotime("00:00:00");
        $outtimedoc= date("H:i:s",strtotime($query_run1)+$secs);
        

        //now to calculate waittimedoc means how much wait patient has to do to get treate by doctor 
        //for that we subtract treatment start doc means his given time + how much early he arrived means his timetolab

        $secs = strtotime($timetolab)-strtotime("00:00:00");
        $waittime= date("H:i:s",strtotime($query_run1)-$secs);

        //now to calculate billing time we have to add distlabfrom  (means lab to first registration desk then from there to medicine counter time)  and 3min etc

        $medicinetime="00:03:00";

        $secs = strtotime($medicinetime)-strtotime("00:00:00");
        $billingtime= date("H:i:s",strtotime($distlabfrom)+$secs);
 

        $query2= "insert into doctor_cabin_entry_table (doc_cabin,dist_lab_from,in_time,time_to_lab,treat_time,treat_start_doc,out_time_doc,wait_time_doc,billing_time,medicine_time,out_time) values('on','00:01:00','$time','$timetolab','$treattime','$query_run1', '$outtimedoc','$waittime','$billingtime','','')";
          $query_run3 = mysqli_query($con,$query2);
          /*if($query_run3)
					{
						echo '<script type="text/javascript">alert("User data inserted Registered.. Welcome")</script>';
						header( "Location: token.php");
						
					}
				else
					{
						echo '<p class="bg-danger msg-block">Registration Unsuccessful due to server error. Please try later</p>';
          }*/
        ///////////////////////////////////////////SMS FOR DOC_CABIN ///////////////////////////
        $textcombine= "Your treatment :".$treatment."||".
                      "Your booking time is :".$time."||".
                      "Your booking date is :".$date."||".
                      "Your treatment start at :".$query_run1."||".
                      "Your outime is :".$outtimedoc."||".
                      "Your billing time is :".$billingtime."||".
                      "Your waittime is :".$waittime."||" ;

                      $url="www.way2sms.com/api/v1/sendCampaign";
                      $message = urlencode($textcombine);// urlencode your message
                      $curl = curl_init();
                      curl_setopt($curl, CURLOPT_POST, 1);// set post data to true
                      curl_setopt($curl, CURLOPT_POSTFIELDS, "apikey=NQ4WGMOQ5P2V1BM8E893HHK8EVHY7KRS&secret=PWT0WMLUMXA1NJQS&usetype=stage&phone=$phone&senderid=mmra9593@gmail.com&message=$message");// post data
                      // query parameter values must be given without squarebrackets.
                      // Optional Authentication:
                      curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                      curl_setopt($curl, CURLOPT_URL, $url);
                      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                      $result = curl_exec($curl);
                      curl_close($curl);
                      echo $result;
                    //////////////////////////////////////////SMS END ///////////////////////////
          }
    }
////////////////////////////////////// DOC-CABIN ENDS /////////////////////////////////////////////////////////////



    
///////////////////////////////////////////////    X RAY   //////////////////////////////////////////////////



    else if($treatment=='xray')
    {
        $distlabfrom= '00:03:00';
        //$treattime="00:30:00";

//////////////////GIVING TREATMENT TIME TO XRAY PATIENT ACCORDING TO AGE AND GENDER//////////////////////////////


                      if($treatment='xray')
                      {
                                  
                                 if(  (1<=$age) && ($age<5)  )
                                  {
                                    if ($gender=='male')
                                    {
                                      $treattime="01:00:00";
                                    }
                                    else if($gender=='female')
                                    {
                                      $treattime="01:00:00";
                                    }
                                  }
                        
                                  else if(  (5<=$age) && ($age<15)  )
                                  {
                                    if ($gender=='male')
                                    {
                                      $treattime="00:50:00";
                                    }
                                    else if($gender=='female')
                                    {
                                      $treattime="00:50:00";
                                    }
                                  }

                                  else if(  (15<=$age) && ($age<50)  )
                                  {
                                    if ($gender=='male')
                                    {
                                      $treattime="00:50:00";
                                    }
                                    else if($gender=='female')
                                    {
                                      $treattime="00:50:00";
                                    }
                                  }

                                  
                                  else if(50<=$age)
                                  {
                                    if ($gender=='male')
                                    {
                                      $treattime="01:00:00";
                                    }
                                    else if($gender=='female')
                                    {
                                      $treattime="01:00:00";
                                    }
                                  }

                      }




////////////////////////////////////////END HERE////////////////////////////////////////////////////



        //adding distlabfrom and user register time to get timetolab
        $secs = strtotime($distlabfrom)-strtotime('00:00:00');
        $timetolab = date("H:i:s",strtotime($time)+$secs);




      //getting out time of previous user 
        $treatstartxray= "select out_time_lab_xray from xray_cabin_entry_table ORDER BY token_no DESC LIMIT 1 ";
        $query_runn = mysqli_query($con,$treatstartxray);
      if(mysqli_num_rows($query_runn)>0)
      {
        while($row=mysqli_fetch_assoc($query_runn))
        {
            $query_run1=$row["out_time_lab_xray"];
        }
      }
      
        
        //adding outtime of previous patient and and current user treattime to get outtimedoc means outtime of patient after treatment

        $secs = strtotime($treattime)-strtotime("00:00:00");
        $outtimexray= date("H:i:s",strtotime($query_run1)+$secs);
      

      //now to calculate waittimedoc means how much wait patient has to do to get treate by doctor 
      //for that we subtract treatment start doc means his given time + how much early he arrived means his timetolab

        $secs = strtotime($timetolab)-strtotime("00:00:00");
        $waittime= date("H:i:s",strtotime($query_run1)-$secs);

      //now to calculate billing time we have to add distlabfrom  (means lab to first registration desk then from there to medicine counter time)  and 3min etc

        $medicinetime="00:03:00";

        $secs = strtotime($medicinetime)-strtotime("00:00:00");
        $billingtime= date("H:i:s",strtotime($distlabfrom)+$secs);


      /////////////////////////CHECKING NO OF TOKEN IS GREATER THAN LIMIT /////////////////////////////
      $tokennocheck="SELECT token_no FROM `xray_cabin_entry_table` ORDER BY token_no DESC LIMIT 1";
      $query_run6 = mysqli_query($con,$tokennocheck);
              if(mysqli_num_rows($query_run6)>0)
              {
                while($row=mysqli_fetch_assoc($query_run6))
                {
                    $token_no_check=$row["token_no"];
                }
              }

      if($token_no_check==10)
      {
        echo '<script type="text/javascript">alert("No of entries for Today is full.Register Tomorrow")</script>';
      }
      else
      {
        $query2= "insert into xray_cabin_entry_table (lab_xray,dist_lab_from,in_time,time_to_lab,treat_time,treat_start_lab_xray,out_time_lab_xray,wait_time_lab_xray,billing_time,medicine_time,out_time) values('on','$distlabfrom','$time','$timetolab','$treattime','$query_run1', '$outtimexray','$waittime','$billingtime','','')";
        $query_run3 = mysqli_query($con,$query2);
      }
      ///////////////////////////////////////CHECKING ENDs HERE////////////////////////////////////////////////////
        /*if($query_run3)
                  {
                      echo '<script type="text/javascript">alert("User data inserted Registered.. Welcome")</script>';
                      header( "Location: token.php");
                      
                  }
              else
                  {
                      echo '<p class="bg-danger msg-block">Registration Unsuccessful due to server error. Please try later</p>';
                  }*/
              

        ///////////////////////////////////////////SMS FOR XRAY ///////////////////////////
        $textcombine= "Your treatment :".$treatment."||".
                      "Your booking time is :".$time."||".
                      "Your booking date is :".$date."||".
                      "Your treatment start at :".$query_run1."||".
                      "Your outime is :".$outtimexray."||".
                      "Your billing time is :".$billingtime."||".
                      "Your waittime is :".$waittime."||" ;

        $url="www.way2sms.com/api/v1/sendCampaign";
        $message = urlencode($textcombine);// urlencode your message
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_POST, 1);// set post data to true
        curl_setopt($curl, CURLOPT_POSTFIELDS, "apikey=NQ4WGMOQ5P2V1BM8E893HHK8EVHY7KRS&secret=PWT0WMLUMXA1NJQS&usetype=stage&phone=$phone&senderid=mmra9593@gmail.com&message=$message");// post data
        // query parameter values must be given without squarebrackets.
        // Optional Authentication:
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);
        echo $result;
      //////////////////////////////////////////SMS END ///////////////////////////



    }

/////////////////////////////////X RAY ENDS//////////////////////////////////////////////////////


///////////////////////////////////////////////    MRI    //////////////////////////////////////



    else if($treatment=='mri')
    {
        $distlabfrom= '00:03:00';
        //$treattime="00:30:00";


//////////////////GIVING TREATMENT TIME TO MRI PATIENT ACCORDING TO AGE AND GENDER//////////////////////////////


                            if($treatment='mri')
                            {
                                        
                                       if(  (1<=$age) && ($age<5)  )
                                        {
                                          if ($gender=='male')
                                          {
                                            $treattime="01:00:00";
                                          }
                                          else if($gender=='female')
                                          {
                                            $treattime="01:00:00";
                                          }
                                        }
                              
                                        else if(  (5<=$age) && ($age<15)  )
                                        {
                                          if ($gender=='male')
                                          {
                                            $treattime="00:50:00";
                                          }
                                          else if($gender=='female')
                                          {
                                            $treattime="00:50:00";
                                          }
                                        }

                                        else if(  (15<=$age) && ($age<50)  )
                                        {
                                          if ($gender=='male')
                                          {
                                            $treattime="00:50:00";
                                          }
                                          else if($gender=='female')
                                          {
                                            $treattime="00:50:00";
                                          }
                                        }

                                        
                                        else if(50<=$age)
                                        {
                                          if ($gender=='male')
                                          {
                                            $treattime="01:00:00";
                                          }
                                          else if($gender=='female')
                                          {
                                            $treattime="01:00:00";
                                          }
                                        }

                            }




////////////////////////////////////////END HERE////////////////////////////////////////////////////

        //adding distlabfrom and user register time to get timetolab
        $secs = strtotime($distlabfrom)-strtotime('00:00:00');
        $timetolab = date("H:i:s",strtotime($time)+$secs);




      //getting out time of previous user 
        $treatstartmri= "select out_time_lab_mri from mri_cabin_entry_table ORDER BY token_no DESC LIMIT 1 ";
        $query_runn = mysqli_query($con,$treatstartmri);
      if(mysqli_num_rows($query_runn)>0)
      {
        while($row=mysqli_fetch_assoc($query_runn))
        {
            $query_run1=$row["out_time_lab_mri"];
        }
      }
      
        
        //adding outtime of previous patient and and current user treattime to get outtimedoc means outtime of patient after treatment

        $secs = strtotime($treattime)-strtotime("00:00:00");
        $outtimemri= date("H:i:s",strtotime($query_run1)+$secs);
      

      //now to calculate waittimedoc means how much wait patient has to do to get treate by doctor 
      //for that we subtract treatment start doc means his given time + how much early he arrived means his timetolab

        $secs = strtotime($timetolab)-strtotime("00:00:00");
        $waittime= date("H:i:s",strtotime($query_run1)-$secs);

      //now to calculate billing time we have to add distlabfrom  (means lab to first registration desk then from there to medicine counter time)  and 3min etc

        $medicinetime="00:03:00";

        $secs = strtotime($medicinetime)-strtotime("00:00:00");
        $billingtime= date("H:i:s",strtotime($distlabfrom)+$secs);

      /////////////////////////CHECKING NO OF TOKEN IS GREATER THAN LIMIT /////////////////////////////
      $tokennocheck="SELECT token_no FROM `mri_cabin_entry_table` ORDER BY token_no DESC LIMIT 1";
      $query_run7 = mysqli_query($con,$tokennocheck);
              if(mysqli_num_rows($query_run7)>0)
              {
                while($row=mysqli_fetch_assoc($query_run7))
                {
                    $token_no_check=$row["token_no"];
                }
              }

      if($token_no_check==10)
      {
        echo '<script type="text/javascript">alert("No of entries for Today is full.Register Tomorrow")</script>';
      }

      else
      {
        $query2= "insert into mri_cabin_entry_table (lab_mri,dist_lab_from,in_time,time_to_lab,treat_time,treat_start_lab_mri,out_time_lab_mri,wait_time_lab_mri,billing_time,medicine_time,out_time) values('on','$distlabfrom','$time','$timetolab','$treattime','$query_run1', '$outtimemri','$waittime','$billingtime','','')";
        $query_run3 = mysqli_query($con,$query2);

      }
      ///////////////////////////////////////CHECKING ENDs HERE////////////////////////////////////////////////////
        /*if($query_run3)
                  {
                      echo '<script type="text/javascript">alert("User data inserted Registered.. Welcome")</script>';
                      header( "Location: token.php");
                      
                  }
              else
                  {
                      echo '<p class="bg-danger msg-block">Registration Unsuccessful due to server error. Please try later</p>';
                  }*/
              ///////////////////////////////////////////SMS FOR MRI ///////////////////////////
                $textcombine= "Your treatment :".$treatment."||".
                              "Your booking time is :".$time."||".
                              "Your booking date is :".$date."||".
                              "Your treatment start at :".$query_run1."||".
                              "Your outime is :".$outtimemri."||".
                              "Your billing time is :".$billingtime."||".
                              "Your waittime is :".$waittime."||" ;

                $url="www.way2sms.com/api/v1/sendCampaign";
                $message = urlencode($textcombine);// urlencode your message
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_POST, 1);// set post data to true
                curl_setopt($curl, CURLOPT_POSTFIELDS, "apikey=NQ4WGMOQ5P2V1BM8E893HHK8EVHY7KRS&secret=PWT0WMLUMXA1NJQS&usetype=stage&phone=$phone&senderid=mmra9593@gmail.com&message=$message");// post data
                // query parameter values must be given without squarebrackets.
                // Optional Authentication:
                curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                $result = curl_exec($curl);
                curl_close($curl);
                echo $result;
              //////////////////////////////////////////SMS END ///////////////////////////    



    }



    


      //////////////////////////////////MRI ENDS/////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////    blood   //////////////////////////////////////////////////



    else if($treatment=='bloodcheck')
    {
        $distlabfrom= '00:03:00';
        //$treattime="00:30:00";
//////////////////GIVING TREATMENT TIME TO BLOOD PATIENT ACCORDING TO AGE AND GENDER//////////////////////////////


                      if($treatment='bloodcheck')
                      {
                                  
                                  if(  (1<=$age) && ($age<5)  )
                                  {
                                    if ($gender=='male')
                                    {
                                      $treattime="00:25:00";
                                    }
                                    else if($gender=='female')
                                    {
                                      $treattime="00:25:00";
                                    }
                                  }
                        
                                  else if(  (5<=$age) && ($age<15)  )
                                  {
                                    if ($gender=='male')
                                    {
                                      $treattime="00:20:00";
                                    }
                                    else if($gender=='female')
                                    {
                                      $treattime="00:20:00";
                                    }
                                  }

                                  else if(  (15<=$age) && ($age<50)  )
                                  {
                                    if ($gender=='male')
                                    {
                                      $treattime="00:20:00";
                                    }
                                    else if($gender=='female')
                                    {
                                      $treattime="00:20:00";
                                    }
                                  }

                                  
                                  else if(50<=$age)
                                  {
                                    if ($gender=='male')
                                    {
                                      $treattime="00:25:00";
                                    }
                                    else if($gender=='female')
                                    {
                                      $treattime="00:25:00";
                                    }
                                  }

                      }




////////////////////////////////////////END HERE////////////////////////////////////////////////////

        //adding distlabfrom and user register time to get timetolab
        $secs = strtotime($distlabfrom)-strtotime('00:00:00');
        $timetolab = date("H:i:s",strtotime($time)+$secs);




      //getting out time of previous user 
        $treatstartblood= "select out_time_lab_blood from blood_cabin_entry_table ORDER BY token_no DESC LIMIT 1 ";
        $query_runn = mysqli_query($con,$treatstartblood);
      if(mysqli_num_rows($query_runn)>0)
      {
        while($row=mysqli_fetch_assoc($query_runn))
        {
            $query_run1=$row["out_time_lab_blood"];
        }
      }
      
        
        //adding outtime of previous patient and and current user treattime to get outtimedoc means outtime of patient after treatment

        $secs = strtotime($treattime)-strtotime("00:00:00");
        $outtimeblood= date("H:i:s",strtotime($query_run1)+$secs);
      

      //now to calculate waittimedoc means how much wait patient has to do to get treate by doctor 
      //for that we subtract treatment start doc means his given time + how much early he arrived means his timetolab

        $secs = strtotime($timetolab)-strtotime("00:00:00");
        $waittime= date("H:i:s",strtotime($query_run1)-$secs);

      //now to calculate billing time we have to add distlabfrom  (means lab to first registration desk then from there to medicine counter time)  and 3min etc

        $medicinetime="00:03:00";

        $secs = strtotime($medicinetime)-strtotime("00:00:00");
        $billingtime= date("H:i:s",strtotime($distlabfrom)+$secs);

/////////////////////////CHECKING NO OF TOKEN IS GREATER THAN LIMIT /////////////////////////////
        $tokennocheck="SELECT token_no FROM `blood_cabin_entry_table` ORDER BY token_no DESC LIMIT 1";
        $query_run9 = mysqli_query($con,$tokennocheck);
                if(mysqli_num_rows($query_run9)>0)
                {
                  while($row=mysqli_fetch_assoc($query_run9))
                  {
                      $token_no_check=$row["token_no"];
                  }
                }

        if($token_no_check==30)
        {
          echo '<script type="text/javascript">alert("No of entries for Today is full.Register Tomorrow")</script>';
        }
        else
        {

        $query2= "insert into blood_cabin_entry_table (lab_blood,dist_lab_from,in_time,time_to_lab,treat_time,treat_start_lab_blood,out_time_lab_blood,wait_time_lab_blood,billing_time,medicine_time,out_time) values('on','$distlabfrom','$time','$timetolab','$treattime','$query_run1', '$outtimeblood','$waittime','$billingtime','','')";
        $query_run3 = mysqli_query($con,$query2);

        }

  ///////////////////////////////////////CHECKING ENDs HERE////////////////////////////////////////////////////
       /* if($query_run3)
                  {
                      echo '<script type="text/javascript">alert("User data inserted Registered.. Welcome")</script>';
                      header( "Location: token.php");
                      
                  }
              else
                  {
                      echo '<p class="bg-danger msg-block">Registration Unsuccessful due to server error. Please try later</p>';
                  }*/

        ///////////////////////////////////////////SMS FOR BLOOD ///////////////////////////
        $textcombine= "Your treatment :".$treatment."||".
                      "Your booking time is :".$time."||".
                      "Your booking date is :".$date."||".
                      "Your treatment start at :".$query_run1."||".
                      "Your outime is :".$outtimeblood."||".
                      "Your billing time is :".$billingtime."||".
                      "Your waittime is :".$waittime."||" ;

        $url="www.way2sms.com/api/v1/sendCampaign";
        $message = urlencode($textcombine);// urlencode your message
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_POST, 1);// set post data to true
        curl_setopt($curl, CURLOPT_POSTFIELDS, "apikey=NQ4WGMOQ5P2V1BM8E893HHK8EVHY7KRS&secret=PWT0WMLUMXA1NJQS&usetype=stage&phone=$phone&senderid=mmra9593@gmail.com&message=$message");// post data
        // query parameter values must be given without squarebrackets.
        // Optional Authentication:
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);
        echo $result;
      //////////////////////////////////////////SMS END ///////////////////////////
    }



    


    ////////////////////////////////blood ENDS///////////////////////////////////////////////////

///////////////////////////////////////////////    SONOGRAPHY   //////////////////////////////////////////////////



    else if($treatment=='sonography')
    {
        $distlabfrom= '00:03:00';
       // $treattime="00:30:00";
//////////////////GIVING TREATMENT TIME TO SONOGRAPHY PATIENT ACCORDING TO AGE AND GENDER///////////////////////////


                    if($treatment='sonography')
                    {
            
                          if(  (1<=$age) && ($age<5)  )
                          {
                            if ($gender=='male')
                            {
                              $treattime="00:45:00";
                            }
                            else if($gender=='female')
                            {
                              $treattime="00:45:00";
                            }
                          }
                
                          else if(  (5<=$age) && ($age<15)  )
                          {
                            if ($gender=='male')
                            {
                              $treattime="00:50:00";
                            }
                            else if($gender=='female')
                            {
                              $treattime="00:50:00";
                            }
                          }

                          else if(  (15<=$age) && ($age<50)  )
                          {
                            if ($gender=='male')
                            {
                              $treattime="01:00:00";
                            }
                            else if($gender=='female')
                            {
                              $treattime="01:00:00";
                            }
                          }

                          
                          else if(50<=$age)
                          {
                            if ($gender=='male')
                            {
                              $treattime="00:50:00";
                            }
                            else if($gender=='female')
                            {
                              $treattime="00:50:00";
                            }
                          }

                    }




////////////////////////////////////////END HERE////////////////////////////////////////////////////

        //adding distlabfrom and user register time to get timetolab
        $secs = strtotime($distlabfrom)-strtotime('00:00:00');
        $timetolab = date("H:i:s",strtotime($time)+$secs);




      //getting out time of previous user 
        $treatstartsono= "select out_time_lab_sono from sono_cabin_entry_table ORDER BY token_no DESC LIMIT 1 ";
        $query_runn = mysqli_query($con,$treatstartsono);
      if(mysqli_num_rows($query_runn)>0)
      {
        while($row=mysqli_fetch_assoc($query_runn))
        {
            $query_run1=$row["out_time_lab_sono"];
        }
      }
      
        
        //adding outtime of previous patient and and current user treattime to get outtimedoc means outtime of patient after treatment

        $secs = strtotime($treattime)-strtotime("00:00:00");
        $outtimesono= date("H:i:s",strtotime($query_run1)+$secs);
      

      //now to calculate waittimedoc means how much wait patient has to do to get treate by doctor 
      //for that we subtract treatment start doc means his given time + how much early he arrived means his timetolab

        $secs = strtotime($timetolab)-strtotime("00:00:00");
        $waittime= date("H:i:s",strtotime($query_run1)-$secs);

      //now to calculate billing time we have to add distlabfrom  (means lab to first registration desk then from there to medicine counter time)  and 3min etc

        $medicinetime="00:03:00";

        $secs = strtotime($medicinetime)-strtotime("00:00:00");
        $billingtime= date("H:i:s",strtotime($distlabfrom)+$secs);

      /////////////////////////CHECKING NO OF TOKEN IS GREATER THAN LIMIT /////////////////////////////
        $tokennocheck="SELECT token_no FROM `sono_cabin_entry_table` ORDER BY token_no DESC LIMIT 1";
        $query_run8 = mysqli_query($con,$tokennocheck);
                if(mysqli_num_rows($query_run8)>0)
                {
                  while($row=mysqli_fetch_assoc($query_run8))
                  {
                      $token_no_check=$row["token_no"];
                  }
                }

        if($token_no_check==10)
        {
          echo '<script type="text/javascript">alert("No of entries for Today is full.Register Tomorrow")</script>';
        }

        else
        {
        $query2= "insert into sono_cabin_entry_table (lab_sono,dist_lab_from,in_time,time_to_lab,treat_time,treat_start_lab_sono,out_time_lab_sono,wait_time_lab_sono,billing_time,medicine_time,out_time) values('on','$distlabfrom','$time','$timetolab','$treattime','$query_run1', '$outtimesono','$waittime','$billingtime','','')";
        $query_run3 = mysqli_query($con,$query2);
        }

  ///////////////////////////////////////CHECKING ENDs HERE////////////////////////////////////////////////////
        /*if($query_run3)
                  {
                      echo '<script type="text/javascript">alert("User data inserted Registered.. Welcome")</script>';
                      header( "Location: token.php");
                      
                  }
              else
                  {
                      echo '<p class="bg-danger msg-block">Registration Unsuccessful due to server error. Please try later</p>';
                  }*/
    ///////////////////////////////////////////SMS FOR SONO ///////////////////////////
            $textcombine= "Your treatment :".$treatment."||".
                          "Your booking time is :".$time."||".
                          "Your booking date is :".$date."||".
                          "Your treatment start at :".$query_run1."||".
                          "Your outime is :".$outtimesono."||".
                          "Your billing time is :".$billingtime."||".
                          "Your waittime is :".$waittime."||" ;

            $url="www.way2sms.com/api/v1/sendCampaign";
            $message = urlencode($textcombine);// urlencode your message
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_POST, 1);// set post data to true
            curl_setopt($curl, CURLOPT_POSTFIELDS, "apikey=NQ4WGMOQ5P2V1BM8E893HHK8EVHY7KRS&secret=PWT0WMLUMXA1NJQS&usetype=stage&phone=$phone&senderid=mmra9593@gmail.com&message=$message");// post data
            // query parameter values must be given without squarebrackets.
            // Optional Authentication:
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($curl);
            curl_close($curl);
            echo $result;
          //////////////////////////////////////////SMS END ///////////////////////////



    }



    


      /////////////////////////////////SONOGRAPHY ENDS///////////////////////////////////////////////////////////////













}///btnclick wala if


        
				
				//converting into proper string
        //$xx=strtotime($query_run1);
        //$query_run2= date('H:i:s',$xx); /////



        /*if($query_run)
					{
						echo '<script type="text/javascript">alert("User Registered.. Welcome")</script>';
						header( "Location: token.php");
						
					}
				else
					{
						echo '<p class="bg-danger msg-block">Registration Unsuccessful due to server error. Please try later</p>';
					}*/
				
			
			
?>
