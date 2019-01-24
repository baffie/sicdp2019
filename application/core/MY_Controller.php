<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Our own standard controller class
 *
 * MY_Controller is an extension of CI_Controller and simplifies language handling
 */
/* load the MX_Controller class */
//require APPPATH."third_party/MX/Controller.php";

class MY_Controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

    }
}


class Frontend_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        //Config site online or offline
        if(setting('site_offline') == '1')
        {
            $this->show_site_offline();
        }
        
    }

    private function show_site_offline() {
        echo "<!doctype html>
<html>
<head>
<title>Site Maintenance</title>
<link href='https://fonts.googleapis.com/css?family=Ubuntu:400,500,700' rel='stylesheet' type='text/css'>
<style>
  body { text-align: center; padding: 150px; }
  h1 { font-size: 50px; }
  body { font: 20px \"Ubuntu\", Helvetica, Arial, sans-serif; color: #333; }
  a { color: #dc8100; text-decoration: none; }
  a:hover { color: #333; text-decoration: none; }
</style>
 </head>
 <body>
<div class='row'>
<div class='col-md-12'>
    <h1>We&rsquo;ll be back soon!</h1>
    <div>
        <p>Sorry for the inconvenience but we&rsquo;re performing some maintenance at the moment. If you need to you can always contact us, otherwise we&rsquo;ll be back online shortly!</p>
        <p>&mdash; The Team</p>
    </div>
</div>
</div>
</body>
</html>
";
        exit();
    }

}




class Backend_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
}