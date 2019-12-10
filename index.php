<html>
    <head>
        <title>Terraprima</title>
    </head>

    <body>
        <?php

             // define variables and set to empty values
            $message = '';
            if(isset($_POST['database'])){
                $database = test_input($_POST['database']);
                unset($_POST['database']);

                $path = getcwd();
                exec("$path/assets/run.sh $database");

                if (dir_is_empty("$path/schema")) {
                    $message = "Database don't exist";
                }
                else{
                    header("Location: schema");
                    exit();
                }
            }

            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            function dir_is_empty($dir) {
              $handle = opendir($dir);
              while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                  return FALSE;
                }
              }
              return TRUE;
            }
        ?>

        <?php echo "<h2>$message</h2>"; ?>

        <form method="post" action="<?php $_SERVER['PHP_SELF'];?>">
          Database:<br>
          <input type = "text" name = "database">
          <br><br>
          <input type="submit" name="submit" value="Submit">
        </form>

        <p>Write your database and "Submit" button <br> You will redirect to your database schema</p>
        <small>powered by <a href="http://schemaspy.org/" target="_blank">schemaspy</a></small>

    </body>
</html>

