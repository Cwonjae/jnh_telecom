<!DOCTYPE html>
<html>
    <head>
        <script>
            function close_msg() {
                var msg = '{{ $msg }}';
                alert(msg);
                window.close();
            }
        </script>
    </head>
    <body onload="javascript:close_msg();">
    </body>
</html>