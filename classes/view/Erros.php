<?php
require_once HEADER;
?>

<div class="row">
    <div class="col-md-12">

        <?php
        
        
        switch ($_SESSION['CodErro']):
            case E_USER_NOTICE:
                $CssClass = MSG_INFO;
                echo "<p class=\"trigger {$CssClass}\">";
                echo "<b>NOTICE<br>";
                echo "Mensagem: </b> {$_SESSION['msg']}<br>";
                echo "<span class=\"ajax_close\"></span></p>";
                break;
            case E_USER_WARNING:
                $CssClass = MSG_ALERTA;
                echo "<p class=\"trigger {$CssClass}\">";
                echo "<b>WARNING<br>";
                echo "Mensagem: </b> {$_SESSION['msg']}<br>";
                echo "<span class=\"ajax_close\"></span></p>";
                break;
            case E_USER_ERROR:
                $CssClass = MSG_ERRO;
                echo "<p class=\"trigger {$CssClass}\">";
                echo "<b>FATAL ERROR<br>";
                echo "Mensagem: </b> {$_SESSION['msg']}<br>";
                echo "<span class=\"ajax_close\"></span></p>";
                break;
            case E_USER_DEPRECATED:
                $CssClass = MSG_DEPRECATED;
                echo "<p class=\"trigger {$CssClass}\">";
                echo "<b>DEPRECATED<br>";
                echo "Mensagem: </b> {$_SESSION['msg']}<br>";
                echo "<span class=\"ajax_close\"></span></p>";
                break;
        endswitch;

        if ($_SESSION['CodErro'] == E_USER_ERROR):
            die;
        endif;
        ?>
    </div>
</div>


<?php
require_once FOOTER;
?>
