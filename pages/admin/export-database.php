<?php include 'functions/admin-session.php';?>
<html>
<head>
	<title>Compiled Modules</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
	<script type="text/javascript" src="js/sweetalert-dev.js"></script>
	<script type="text/javascript" src="js/sweetalert.min.js"></script>
</head>
<body>

	<div class="main-container">

		<div class="logo-container">
			<img src="images/logo.png">
		</div>

		<div class="nav-container">
			<ul>
				<li class="active"><a href="dashboard">dashboard</a></li>
				<li class="dropdown"><a href="#">Settings</a>
					<ul class="dropdown-content">
						<li><a href="configure-smtp-server">configure smtp server</a></li>
						<li><a href="#">manage priveledges</a></li>
						<li><a href="#">theme options</a></li>
						<li><a href="export-database">export database</a></li>
					</ul>
				</li>

				<li class="dropdown"><a href="#">master list</a>
					<ul class="dropdown-content">
						<li><a href="add-socket">add socket</a></li>
						<li><a href="add-security">add security</a></li>
					</ul>
				</li>

				<li class="dropdown"><a href="#">manage records</a>
					<ul class="dropdown-content">
						<li><a href="manage-smtp-account">smtp accounts</a></li>
						<li><a href="manage-accounts">accounts</a></li>
					</ul>
				</li>
				<li><a href="admin-logout">logout</a></li>
			</ul>
		</div>

	</div>

		<div class="body-container">
			 <?php
    set_time_limit(0);
    if(!isset($_SESSION['set_time_limit']))
    $file = backup_tables('localhost','root','','modules');
    ?>
    <script type="text/javascript">
    swal({   
      title: "Database successfully backuped!",  
      text: "Please check your database folder. \n Database Name: <?php echo$file?>",
       timer: 8000, 
       type: "success",  
       showConfirmButton: false 
      });
    setTimeout("location.href = 'dashboard'",3000);
    </script>
    <?php 
    /* backup the db OR just a table */
    function backup_tables($host,$user,$pass,$name,$tables = '*')
    {
        $return = '';
        $link = mysql_connect($host,$user,$pass);
        mysql_select_db($name,$link);
        
        //get all of the tables
        if($tables == '*')
        {
            $tables = array();
            $result = mysql_query('SHOW TABLES');
            while($row = mysql_fetch_row($result))
            {
                $tables[] = $row[0];
            }
        }
        else
        {
            $tables = is_array($tables) ? $tables : explode(',',$tables);
        }
        
        //cycle through
        foreach($tables as $table)
        {
            $result = mysql_query('SELECT * FROM '.$table);
            $num_fields = mysql_num_fields($result);
            
            $return.= 'DROP TABLE IF EXISTS '.$table.';';
            $row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
            $return.= "\n\n".$row2[1].";\n\n";
            
            for ($i = 0; $i < $num_fields; $i++) 
            {
                while($row = mysql_fetch_row($result))
                {
                    $return.= 'INSERT INTO '.$table.' VALUES(';
                    for($j=0; $j<$num_fields; $j++) 
                    {
                        $row[$j] = addslashes($row[$j]);
                        $row[$j] = str_replace("\n", '\n',$row[$j]);
                        if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
                        if ($j<($num_fields-1)) { $return.= ','; }
                    }
                    $return.= ");\n";
                }
            }
            $return.="\n\n\n";
        }
        
        //save file
        $filename = 'modules-'.date('d-M-Y h-i D').'.sql';
        $handle = fopen('database/'.$filename,'w+');
        fwrite($handle,$return);
        fclose($handle);
        return $filename;
    }
    ?>
		</div>

		<div class="footer">
			<p> Compiled Modules @ <?php echo date('Y')?> </p>
		</div>

</body>
</html>
