 <?php
        if(isset($_POST['sub_form'])){
            if($_POST['wt']<= 0 ||$_POST['ht'] <= 0) die("Enter valid values.");
            $wt = $_POST['wt'];
            $ht = $_POST['ht'];
            $ht = $ht * $ht;
            $bmi =     round($wt/$ht,2);
            if($bmi < 20)die( 'You are underweight. Your BMI is '.$bmi);
            if($bmi >25) die ('You are overweight. Your BMI is '.$bmi);
            echo "You weight is optimum. Your BMI is ".$bmi;
        }
?>