
<?php
    $passedID = $_POST["userID"]; 
    $passedPW = $_POST["userPW"]; 
    $passedMode = $_POST["mode"]; 

    // Login Mode // 
    if( $passedMode == '0'){
        if( selectUserID('./db/uinf.db',$passedID ) !== false ){
            $_password = selectUserID('./db/uinf.db',$passedID ); 
            // Check if matched password with stored password // 
            if( strpos( $_password,md5( $passedPW )) !== false ){
                // Successful Login // 
                // Start Session //
                session_start(); 
                $_SESSION['UID'] = $passedID; 
                $_SESSION['UPW'] = $_password;
            }else{
                // Failure Login // 
                echo("Incorrect Password"); 
            }
        }else{
            echo("You're not our member !\n");
            echo("if you want to use our services, please register to our website");
        }
    }else{
        // Register Mode //
        $passedNewID = $_POST['newID']; 
        $passedNewPW = $_POST['newPW']; 
        $passedNewEmail = $_POST['newEM']; 
        $passedNewBirthDay = $_POST['newBD']; 
        $passedNewGender = $_POST['newGND']; 

        $checkCollideID = selectUserID( './db/uinf.db',$passedNewID ); 
        if( $checkCollideID != false ){
            echo('Your ID is already Used in our Server');
            return; 
        }else{
            createUser( './db/uinf.db',$passedNewID,$passedNewPW,$passedNewEmail,$passedNewBirthDay,$passedNewGender );
            echo('Succefully Signed Up');
        }
    }

    // User Information DB DDL & DCL // 
    // Retrieving User ID From DataBase // 
    function selectUserID( $dbname,$userid ){
        if($file = fopen( $dbname,'r')){
            while(!feof( $file )){
                $line = fgets( $file ); 
                $encodedID = base64_encode( $userid ); 
                
                if( strpos( $line,$encodedID ) !== false ){
                    $token = explode(':',$line); 
                    return $token[1];
                }
            }
            fclose( $file ); 
        }
        return false; 
    }
    function createUser( $dbname,$userid,$userpw,$userem,$userbd,$usergen ){
        $strgen = "NULLTARGET"; 
        if( $usergen == 0 ){
            $strgen = 'BOY'; 
        }else{
            $strgen = 'GIRL'; 
        }
        if($file = fopen( $dbname,'a')){
            $record = base64_encode( $userid ).":".md5( $userpw ).":".base64_encode( $userem ).":".base64_encode( $userbd ).":".base64_encode( $strgen )."\n";
            fwrite( $file,$record );
            fclose( $file ); 
        }
    }
?>