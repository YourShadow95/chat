 <?php
 include ('config.php');
 switch ($_REQUEST['action'])
 {
     case "sendMessage":

         $query=$dbConn->prepare('INSERT INTO messages (`user`, `message` ) VALUES (:user, :message)');
         $run = ($query->execute(array( 'user'=> $_REQUEST['user'],
                                'message'=>$_REQUEST['message'])));
         if($run)
         {
             echo 1;
             exit;
         } else 0;
        break;

     case "getMessage":
         $query=$dbConn->prepare('SELECT * FROM messages');
         $query->execute();
         $messages = $query->fetchAll(PDO::FETCH_ASSOC);
           // var_dump($messages);
         $chat = '';
            foreach ($messages as $key => $val)
            {
                $chat = '';
                $chat .= '<div class = "single-message"><strong>'.$val['user'].': </strong>'.
                    $val['message'].'<span>'.date('d-m-Y h:i', strtotime($val['date'])).'</span>'.'</div>';
                echo $chat;

            }
         break;
 }
 ?>