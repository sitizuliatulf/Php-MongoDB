</body>
<?php 
    if (isset($js)) {
        foreach($js as $key => $value) {
?>
    <script type="text/javascript" src="<?php echo base_url($value) ?>"></script>
<?php
        }
    }

?>
</html>