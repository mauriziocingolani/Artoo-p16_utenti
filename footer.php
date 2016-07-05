<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script>
    jQuery.noConflict();
    jQuery(document).ready(function ($) {
<?php
if ($file != null)
    require_once './' . $file;
?>
    });
</script>