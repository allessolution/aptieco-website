<?php 
function alert($msg){?>
    <script type="text/javascript">
        notification("<?php echo $msg ?>")
    </script>
<?php }?>