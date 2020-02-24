<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My chat</title>
    <link rel="stylesheet" href="style.css">
    <script
            src="https://code.jquery.com/jquery-3.4.1.js"
            integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
            crossorigin="anonymous">
    </script>
</head>
<body>
    <div id="wrapper" ">
        <h1>Welcome to my chat</h1>
        <div class="chat_wrapper">
            <div id="chat">
            </div>
            <form method="post" id="messageFrm">
                <textarea name="message" cols="30" rows="10" class="textarea"></textarea>

            </form>
        </div>
    </div>
    <script>
        var user;
        user = prompt('What your name?');
        //alert(user);
        setInterval(function () {
            LoadChat();
        }, 1000)
        function LoadChat()
        {
            $.post('messages.php?action=getMessage', function (response)
            {
                var scrollpos = $('#chat').scrollTop();
                var scrollpos = parseInt(scrollpos) + 520;
                var scrollHeight = $('#chat').prop('scrollHeight');

                $('#chat').html(response);

                if(scrollpos < scrollHeight)
                {} else
                {
                    $('#chat').scrollTop($('#chat').prop('scrollHeight'));
                }
            });
        }
        $('.textarea').keyup(function (e) {
            if(e.which == 13)
            {
                $('form').submit();
            }
        });
        $('form').submit(function () {
            var message = $('.textarea').val();
            $.post('messages.php?action=sendMessage&message=' + message + '&user=' + user, function (response)
            {
               if(response == 1)
               {
                   LoadChat();
                   document.getElementById('messageFrm').reset();
               }
            });
            return false;
        });
    </script>
</body>
</html>
