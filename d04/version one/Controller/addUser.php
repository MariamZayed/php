<?php
        function addUser($userRecord){
            try{
                $fileHandler= fopen("../usersDB.txt", 'a');
                fwrite($fileHandler, $userRecord.PHP_EOL);
                fclose($fileHandler);
        
                if(is_readable('../usersDB.txt')){
                    $users= file("../usersDB.txt");
                    var_dump($users);
                }
            }
            catch (Exception $e){
                var_dump($e);
            }
        }
?>