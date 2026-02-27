<?php
function showDate()
{
    $date = date ("d-m-Y", strtotime("+1week"));
    $messege = "de datum van vandaag: $date";


    return $messege;
}



function Trafficlight($color, $ambulance)
{
    if ($color == "green" && $ambulance == false)
    {
        $result = "je mag door rijden!";
    }
    else
    {
        $result = "auto moet stoppen";
    }

    return $result;
}


function SavingGoal ($goal, $Monthly)

{
    $showmassage = true;
    $savings = 0;
    $month = 0;
    $interest = 0.2;
    while( $savings < $goal)
    {
        $savings = $savings + $Monthly;
        $month++;
        $Monthly = $savings * $interest;
        $round = round($savings, 2);

            echo "<br>in maand $month heb je $round  gespaard" ;



        if ($savings >= $goal/2 && $showmassage)
        {
            echo "<br>yuppi";
            $showmassage = false;



        }
    }


    return "Je heb $month nodig om je $goal te halen";

}
echo SavingGoal(5000, 100);



?>