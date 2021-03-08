<?php

require_once "db/db_data.php";

$connect = new mysqli($host, $db_user, $db_password, $db_name);

    try
        {
            $connect = new mysqli($host, $db_user, $db_password, $db_name);
            if ($connect->connect_errno!=0) 
            {
                throw new Exception(mysqli_connect_errno());
            }
            else
            {
                if(isset($_GET['id']))
                {
                $_SESSION['project_id'] = $_GET['id'];
                }
                $project_id = $_SESSION['project_id'];

                $query = "SELECT MIN(startzadania) AS minimum FROM zadania WHERE wprojekcie = $project_id";
                $query2 = "SELECT MAX(konieczadania) AS maximum FROM zadania WHERE wprojekcie = $project_id";
                
                $result = $connect->query($query);
                $row = mysqli_fetch_assoc($result);
                $min_date = $row['minimum'];

                $result = $connect->query($query2);
                $row = mysqli_fetch_assoc($result);
                $max_date = $row['maximum'];

                $query = "SELECT * FROM projekty WHERE id_projektu = $project_id";
                $result = $connect->query($query);
                $row = mysqli_fetch_assoc($result);
                $_SESSION['project_name'] = $row['nazwa'];
                
                
                /* echo $min_date."<br>";
                echo $max_date."<br>"; */

                $datestart = strtotime($min_date);//you can change it to your timestamp;
	            $dateend = strtotime($max_date);

                $datebetween = abs($dateend - $datestart);

                $daystep = 86400;
                $day_cycle = $datebetween/$daystep;
                
                echo "<div class='tasktable'>"; 
                echo "<table><thead><tr>";
                echo "<th>ZADANIE/DATA</th>";

                for ($i=0; $i <= $day_cycle; $i++) { 
                    echo "<th>".date("Y-m-d", $datestart + ($i * $daystep))."</th>";
                }

                echo "</tr></thead><tbody>";
                
                /* $year = date('d-m-y', strtotime($row['maximum']));
                echo $year."<br>";
                $month = date('m', strtotime($min_date));
                echo $month."<br>";
                $day = date('d', strtotime($min_date));
                echo $day."<br>"; */
                $query3 = "SELECT * FROM zadania WHERE wprojekcie = $project_id ORDER BY zadania.startzadania ASC";

                $result = $connect->query($query3);
                $howrows = $result->num_rows;

               
                /* echo $howrows; */

                if ($howrows > 0)
                    {
                        while($row = mysqli_fetch_assoc($result))
                        {
                            $task_id = $row['id_zadania'];
                            $task_name = $row['nazwa'];
                            $start = $row['startzadania'];
                            $end = $row['konieczadania'];
                            $t_start = strtotime($start);
                            $t_end = strtotime($end);

                            $startday = abs($t_start-$datestart);
                            $task_length = abs($t_start-$t_end);
                            $beginning = $startday/$daystep;
                            $task_duration = $task_length/$daystep;


                            /* echo "PRZESUNIECIE: ".$startday/$daystep." CZAS :".$task_duration."<br>"; */

                            echo "<tr><th>".$task_name."<a id="."'".$row['id_zadania']."'"." href='#' class='vpbutton edittask'>EDYTUJ</a></th>";
                            for ($i=0; $i <= $day_cycle; $i++) { 
                                if($i >= $beginning && $i <= ($beginning+$task_duration))
                                {
                                    echo "<td class='active'>"." "."</td>";
                                }
                                else
                                {
                                    echo "<td class='inactive'>"." "."</td>";
                                }
                            }
                            echo "</tr>";
                        }
                    }
                    echo "</tbody></table>";
                    echo "</div>";
                if($connect->query($query)) {

                }
                /* if($connect->query($query))
                {
                    //echo "Zapytanie pobrania danych udało się";
                    $result = $connect->query($query);
                    $howrows = $result->num_rows;
                    //echo $result;

                    
                    
                    if ($howrows > 0)
                    {
                        while($row = mysqli_fetch_assoc($result))
                        {
                            echo $row['MIN(startzadania)'];
                        }
                    } */
                
                else
                {
                    throw new Exception($connect->error);
                }
            }
        $connect->close();
        }

    catch(Exception $e)
    {
        echo 'Błąd bazy danych';
        echo $connect->errno;
    }

?>