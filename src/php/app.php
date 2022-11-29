<!DOCTYPE html>
<!-- 
    Author              :   Cloyd Van S. Secuya
    Filename            :   app.php 
    Date of Creation    :   November 28, 2022
    Description         :   This is a PHP app utilizing and handling forms for FLAMES
 -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/globals.css">
    <title>F.L.A.M.E.S By Cloyd Van S. Secuya</title>
</head>
<body>
    <main class="content">
        <div class="beating-heart"></div>

        <!-- ================= BEGIN USER FORM ================= -->
        <form action="app.php" method="post">
            <!-- User name and User crush input fields -->
            <h3>Find out the destiny of you and your crush</h3><br>
            <input type="text" name="user-name" placeholder="Your name" required><br><br>
            <input type="text" name="user-crush" placeholder="Crush name" required>

            <br>

            <!-- User birthdays and User crush birthday -->
            <h3>Fill out birthdates info</h3>
            <!-- 
                Create a date pick menu 
            -->
            <!-- User birthday -->
            <label for="user-birthday">Your Birthday:</label><br>
            <input type="date" id="user-birthday" name="user-birthday" required>

            <br>
            <br>

            <!-- Crush birthday -->
            <label for="crush-birthday">Your crush's birthday:</label><br>
            <input type="date" id="crush-birthday" name="crush-birthday" required>

            <br>
            <br>

            <!-- 
                Create a submit button, then, ensure that all values will be fetched accordingly with POST
             -->
             <!-- Form Submit button -->
             <input class="submit-form-btn" type="submit" value="SUBMIT">
        </form>
        <!-- Aesthetically nice boxes -->
        <div class="drops">
            <div class="drop drop-1"></div>
            <div class="drop drop-2"></div>
            <div class="drop drop-3"></div>
            <div class="drop drop-4"></div>
            <div class="drop drop-5"></div>
        </div>
        <!-- ================= END USER FORM ================= -->
    </main>





    <!-- ================= BEGIN PHP CODE BLOCKS ================= -->
    <?php
        // Stop the event reporting when fields and empty yet
        error_reporting(E_ALL & E_PARSE);
        /**
         * @todo: Fetch the values from the form
         * The submitted values are of string (text) type. 
         * Hence, it is necessary to turn them into an array to compare each element inside its own index
         */
        // Fetch the user name and crush names
        $user_name = $_POST["user-name"];
        $user_crush = $_POST["user-crush"];       
            // Debug and test
                // echo "$user_name \n"; 
                // echo "$user_crush \n"; 

        // Fetch the user birthday and crush birthday
        $user_bday = $_POST["user-birthday"];
        $crush_bday = $_POST["crush-birthday"];
            // Debug and test
                // echo "$user_bday \n"; 
                // echo "$crush_bday \n";

        /**
         * @todo: Convert the names from string into an array 
         * It is necessary to turn them into an array to compare each element inside its own index
         * If we are to compare the characters one-by-one, then, we need the element of an index.
         * 
         * @note: For the computation, count the number of similar letters between the two names. 
         * Add the total count then get the remainder when divided by 6. 
         * The resulting number corresponds with a letter in FLAMES. 
         * (F=1, L=2, A=3, M=4, E=5, S=0). 
         * F – Friends, L – Lovers, A – Anger, M – Married, E – Engaged, S – Soulmates 
         *  
         */
        // Convert the user-name into an array
        $arr_user_name = str_split($user_name);
        // Convert the user-crush into an array 
        $arr_crush_name = str_split($user_crush);

        // Now, try to FIND SIMILARITES between the elements in each index. 
        // Note that it is much easier when I use an in-built function for this.
        /** 
         * @todo: Find the similar letters between the two names.
         *           - Use a in-built function for that.
         * @documentation: https://www.php.net/manual/en/function.array-intersect.php
         * @note: array_intersect handles duplicate items in arrays differently. 
         *        If there are duplicates in the first array, all matching duplicates will be returned
         */
        // Use array_intersect in between said arrays for each index
        $toMatch_user = array_intersect($arr_user_name, $arr_crush_name);
        $toMatch_crush = array_intersect($arr_crush_name, $arr_user_name);

        // Compare the returned results to get the matching values 
        $arr_merge_names_matching_chars = array_merge($toMatch_user, $toMatch_crush); 
            // Debug and test
            echo "\n array_merge: $arr_merge_names_matching_chars \n\n";

        // Now, count the total of matching chars
        $count_tot = count($arr_merge_names_matching_chars);
            // Debug and test
            echo "\n count: $count_tot \n\n"; 

        /**
         * @todo: After getting the total count of similar letters begin computing for remainder and divide by  6 
         *          - FIND OUT THE F.L.A.M.E.S result
         *          - We can also check the remaining number of significant places or precision
         *          - (F=1, L=2, A=3, M=4, E=5, S=0)
         */
        // Get no. of remainder and response and apply conditions I want
        if($count_tot == 6 || ($count_tot % 6) == 0){
            $responses = "SOULMATES";	 
            echo "
                <div class='soulmates'>
            ";
	    }
        
        else if($count_tot == 5 || ($count_tot % 5) == 0){
            $responses = "ENGAGED";
            echo "
                <div class='engaged'>
            ";
	    }
        
        else if($count_tot == 4 || ($count_tot % 4) == 0){
            $responses = "MARRIED";
            echo "
                <div class='married'>
            ";
	    }
        
        else if($count_tot == 3 || ($count_tot % 3) == 0){
            $responses = "ANGER";
            echo "
                <div class='anger'>
            ";
	    }
        
        else if($count_tot == 2 || ($count_tot % 2) == 0){
            $responses = "LOVERS";
            echo "
                <div class='lovers'>
            ";
	    } 
        
        else if($count_tot == 1 || ($count_tot % 1) == 0){
            $responses = "FRIENDS";
            echo "
                <div class='friends'>
            ";
	    }





        /**
         * @todo: Implement the Zodiac Sign Logic.
         */
        // Explode the birthday strings 
        $user_bday_Strip = explode('-', $user_bday); 
            // Debug and test
                // echo "User Bday Month: $user_bday_Strip[1]";
                // echo "User Bday Date: $user_bday_Strip[2]";

        $crush_bday_Strip = explode('-', $crush_bday); 
            // Debug and test
                // echo "Crush Bday Month: $crush_bday_Strip[1]";
                // echo "Crush Bday Date: $crush_bday_Strip[2]";

        // The Strips are now in an array. 
        // Therefore, I need to assign its elemental value to the ff vars 
        /** User bday vars */
        $user_bday_month = $user_bday_Strip[1]; 
        $user_bday_date = $user_bday_Strip[2]; 
        /** Crush bday vars */
        $crush_bday_month = $crush_bday_Strip[1]; 
        $crush_bday_date = $crush_bday_Strip[2];

        /**
         * @todo: Now, begin conditioning testings for the month and date
         *          to get the zodiac sign
         */
        // Conditions to get user zodiac
        if(($user_bday_month == "1") && ($user_bday_date >= 20) || ($user_bday_month == "2") && ($user_bday_date <=19)){
            $user_zodiac = "AQUARIUS";
          }elseif(($user_bday_month == "2") && ($user_bday_date >= 19) || ($user_bday_month == "3") && ($user_bday_date <=20)){
            $user_zodiac = "PISCES";
          }elseif(($user_bday_month == "3") && ($user_bday_date >= 21) || ($user_bday_month == "4") && ($user_bday_date <= 19)){
            $user_zodiac = "ARIES";
          }elseif(($user_bday_month == "4") && ($user_bday_date >= 20) || ($user_bday_month == "5") && ($user_bday_date <= 20)){
            $user_zodiac = "TAURUS";
          }elseif(($user_bday_month == "5") && ($user_bday_date >= 21) || ($user_bday_month == "6") && ($user_bday_date <= 21)){
            $user_zodiac = "GEMINI";
          }elseif(($user_bday_month == "6") && ($user_bday_date >= 22) || ($user_bday_month == "7") && ($user_bday_date <= 22)){
            $user_zodiac = "CANCER";
          }elseif(($user_bday_month == "7") && ($user_bday_date >= 23) || ($user_bday_month == "8") && ($user_bday_date <= 22)){
            $user_zodiac = "LEO";
          }elseif(($user_bday_month == "8") && ($user_bday_date >= 23) || ($user_bday_month == "9") && ($user_bday_date <= 22)){
            $user_zodiac = "VIRGO";
          }elseif(($user_bday_month == "9") && ($user_bday_date >= 23) || ($user_bday_month == "10") && ($user_bday_date <= 23)){
            $user_zodiac = "LIBRA";
          }elseif(($user_bday_month == "10") && ($user_bday_date >= 24) || ($user_bday_month == "11") && ($user_bday_date <= 21)){
            $user_zodiac = "SCORPIO";
          }elseif(($user_bday_month == "11") && ($user_bday_date >= 22) || ($user_bday_month == "12") && ($user_bday_date <= 21)){
            $user_zodiac = "SAGITTARIUS";
          }elseif(($user_bday_month == "12") && ($user_bday_date >= 22) || ($user_bday_month == "1") && ($user_bday_date <= 19)){
            $user_zodiac = "CAPRICORN";
          }

        // Conditions to get crush zodiac
        if(($crush_bday_month == "1") && ($crush_bday_date >= 20) || ($crush_bday_month == "2") && ($crush_bday_date <=19)){
            $crush_zodiac = "AQUARIUS";
          }elseif(($crush_bday_month == "2") && ($crush_bday_date >= 19) || ($crush_bday_month == "3") && ($crush_bday_date <=20)){
            $crush_zodiac = "PISCES";
          }elseif(($crush_bday_month == "3") && ($crush_bday_date >= 21) || ($crush_bday_month == "4") && ($crush_bday_date <= 19)){
            $crush_zodiac = "ARIES";
          }elseif(($crush_bday_month == "4") && ($crush_bday_date >= 20) || ($crush_bday_month == "5") && ($crush_bday_date <= 20)){
            $crush_zodiac = "TAURUS";
          }elseif(($crush_bday_month == "5") && ($crush_bday_date >= 21) || ($crush_bday_month == "6") && ($crush_bday_date <= 21)){
            $crush_zodiac = "GEMINI";
          }elseif(($crush_bday_month == "6") && ($crush_bday_date >= 22) || ($crush_bday_month == "7") && ($crush_bday_date <= 22)){
            $crush_zodiac = "CANCER";
          }elseif(($crush_bday_month == "7") && ($crush_bday_date >= 23) || ($crush_bday_month == "8") && ($crush_bday_date <= 22)){
            $crush_zodiac = "LEO";
          }elseif(($crush_bday_month == "8") && ($crush_bday_date >= 23) || ($crush_bday_month == "9") && ($crush_bday_date <= 22)){
            $crush_zodiac = "VIRGO";
          }elseif(($crush_bday_month == "9") && ($crush_bday_date >= 23) || ($crush_bday_month == "10") && ($crush_bday_date <= 23)){
            $crush_zodiac = "LIBRA";
          }elseif(($crush_bday_month == "10") && ($crush_bday_date >= 24) || ($crush_bday_month == "11") && ($crush_bday_date <= 21)){
            $crush_zodiac = "SCORPIO";
          }elseif(($crush_bday_month == "11") && ($crush_bday_date >= 22) || ($crush_bday_month == "12") && ($crush_bday_date <= 21)){
            $crush_zodiac = "SAGITTARIUS";
          }elseif(($crush_bday_month == "12") && ($crush_bday_date >= 22) || ($crush_bday_month == "1") && ($crush_bday_date <= 19)){
            $crush_zodiac = "CAPRICORN";
          }

    ?>
    <div class="form-results-container">
        <h3 class="form-results-header">Your destiny is</h3>
        <?php
            echo "<h1 class='destiny'>$responses</h1>";
        ?>
        <h5 class="form-results-zodiac--user">Your zodiac sign is</h5>
        <?php
            echo "<h1 class='user-sign'>$user_zodiac</h1>";
        ?>
        <h5 class="form-results-zodiac--crush">Your crush zodiac sign is</h5>
        <?php
            echo "<h1 class='crush-sign'>$crush_zodiac</h1>";
        ?>
    </div>
    
</body>
</html>