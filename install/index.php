<!DOCTYPE html>
<html>
    <head>
        <title>CodeIgniter Installation Wizard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="CodeIgniter Installation Wizard">

        <link rel="shortcut icon" href="images/ci-logo.png">

        <!-- Custom Theme files -->
        <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
        <!-- //Custom Theme files -->

    </head>
    <body>
        <!-- main -->
        <div class="main">

            <?php
            $base_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
            $base_url .= "://" . $_SERVER['HTTP_HOST'];
            $base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
            $base_url = str_replace('install/', '', $base_url);
            ?>

            <div class="main-agilerow"> 
                <div class="ci-install-wrap">
                    <h1>CODEIGNITER </h1>

                    <span class="ci-subt">INSTALLATION WIZARD</span>
                    <hr />
                    <h2>Install Now</h2>
                    <p>Ajax Based CI Installer </p>
                </div>	
                
                
                <div class="ci-form-wrap" id="success-wrap" style="display:none;">
                    
                    <h2>Installation Successful.</h2>
                    <p>Authentication Credentials -</p>
                    <p style="font-weight:bolder">
                        Username: sb_accounts <br />
                        Password: h12345
                    </p>
                    <hr />
                    
                    <p><a class="btn btn-primary" href="<?php echo $base_url; ?>">Click Here</a><strong> to Login!</strong></p>
                    
                </div>
                
                <div class="ci-form-wrap" id="main-wrap">
                    <form action="#" method="post">
                        <h3>Step 1 : Database Configuration</h3>
                        <div class="form-step1">

                            <label>Host</label>
                            <span class="hints">Ex - localhost</span>
                            <input type="text" id="dbhost" name="dbhost" placeholder="Enter Database Host" required>

                            <label>User</label>
                            <span class="hints">Ex - root</span>
                            <input type="text" id="dbuser" name="dbuser" placeholder="Enter Database UserName" required>

                            <label>Password</label>
                            <span class="hints">Ex - password</span>
                            <input type="text" id="dbpass" name="dbpass" placeholder="Enter Database Password" required>

                            <label>DB Name</label>
                            <span class="hints">Ex - db_name</span>
                            <input type="text" id="dbname" name="dbname" placeholder="Enter Database Name" required>					

                        </div> 

                        <h3>Step 2 : Base URL</h3>
                        <div class="form-step1"> 						
                            <span class="hints">Ex - https://example.com/ci/</span>
                            <input type="text" id="base_url" name="base_url" placeholder="Base URL" value="<?php echo $base_url; ?>" required>						
                        </div>
                        <!--					<h3>Step 3 : Select CodeIgniter Version</h3>
                                                                <div class="form-step1">
                                                                        <select name="ci_version" id="ci_version" required>							
                                                                                <option value="">Select CodeIgniter Version</option>
                                                                                <option value="2">CodeIgniter Version 2</option>
                                                                                <option value="3">CodeIgniter Version 3</option>
                                                                        </select>
                                                                </div>-->

                        <br />

                        <div id="form-progress">

                        </div>
                        <br />

                        <div id="submit_btn">
                            <input type="button" value="Start Installation" onClick="install_ci_pa()">
                        </div>

                    </form>
                </div>  
            </div>	
        </div>	
        <!-- //main -->

        <script type="text/javascript" src="js/jquery.min.js"></script>

        <script>

        function install_ci_pa()
        {
            var ci_version = 3; // CI Version	

            var base_url = $("#base_url").val(); // base host

            var dbhost = $("#dbhost").val(); // database host	
            var dbuser = $("#dbuser").val(); // database user	
            var dbpass = $("#dbpass").val(); // database pass	
            var dbname = $("#dbname").val(); // database name

            var form_stat = 1;

//            if (ci_version == "") {
//                form_stat = 0;
//                $("#ci_version").addClass("warning");
//                $("#ci_version").focus();
//            } else {
//                $("#ci_version").removeClass("warning");
//            }

            if (base_url == "") {
                form_stat = 0;

                $("#base_url").addClass("warning");
                $("#base_url").focus();
            } else {
                $("#base_url").removeClass("warning");
            }

            if (dbname == "") {
                form_stat = 0;

                $("#dbname").addClass("warning");
                $("#dbname").focus();
            } else {
                $("#dbname").removeClass("warning");
            }

            if (dbuser == "") {
                form_stat = 0;

                $("#dbuser").addClass("warning");
                $("#dbuser").focus();
            } else {
                $("#dbuser").removeClass("warning");
            }

            if (dbhost == "") {
                form_stat = 0;

                $("#dbhost").addClass("warning");
                $("#dbhost").focus();
            } else {
                $("#dbhost").removeClass("warning");
            }

            if (form_stat === 1)
            {
                $("#form-progress").html('<div class="loader"></div><br />Installing CodeIgniter. Please Wait!');

                $("#submit_btn").hide();

                $.ajax({
                    type: "post",
                    url: "install.php",
                    //dataType: "json",
                    data: {
                        template: ci_version,
                        url: base_url,
                        hostname: dbhost,
                        username: dbuser,
                        password: dbpass,
                        database: dbname
                    },
                    success: function (resp) {

                        if (resp == '')
                        {
                            $("#main-wrap").hide();
                            $("#success-wrap").show();
                            
                        } else
                        {
                            $("#form-progress").html(resp);

                            $("#form-progress").focus();

                            $("#submit_btn").show();
                        }

                        $("#submit_btn").show();
                    }
                });
            } else
            {
                $("#form-progress").html('Please Fill The Form Correctly!');

                $("#submit_btn").show();
            }

        }


        </script>

    </body>
</html>