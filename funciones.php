<?php

function AlertaExitosa($mensaje)
{
?>
    <script>
        alertify.set('notifier', 'position', 'top-right');
        alertify.success('<?php echo $mensaje; ?>');
    </script>
<?php
}

function AlertaError($mensaje)
{
?>
    <script>
        alertify.set('notifier', 'position', 'top-right');
        alertify.error('<?php echo $mensaje; ?>');
    </script>
<?php
}

function AlertaAdvertencia($mensaje)
{
?>
    <script>
        alertify.set('notifier', 'position', 'top-center');
        alertify.warning('<?php echo $mensaje; ?>');
    </script>
<?php
}

function AlertaSesion($mensaje)
{
?>
    <script>
        alertify.set('notifier', 'position', 'top-center');
        alertify.warning('<?php echo $mensaje; ?>');
    </script>
<?php
}

function MensajeExitoso($mensaje)
{
?>
    <div class="alert alert-success text-dark float-right" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        <?php echo $mensaje; ?>
    </div>
<?php
}

function MensajeError($mensaje)
{
?>
    <div class="alert alert-danger float-right" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        <?php echo $mensaje; ?>
    </div>
<?php
}


