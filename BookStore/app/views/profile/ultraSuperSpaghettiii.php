<?php
if(isset($_SESSION['editAlert'])){
    $type = json_encode($_SESSION['editAlert'][0]);
    $msg = json_encode($_SESSION['editAlert'][1]);

    echo "
        <script>
            alert({$type}, {$msg});
        </script>
    ";
    unset($_SESSION['editAlert']);
}
?>