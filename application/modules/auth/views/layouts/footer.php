<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<footer class="main-footer">
    <div class="pull-right hidden-xs">
        Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?>
    </div>
    <?php echo setting('copyright'); ?>
</footer>