<?php


echo <<<_END
<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

_END;

require("templates/head.php");
echo "<body>";
require("templates/header.php");

include("templates/footer.php");

echo <<<_END
</body>
<script src="javaScript.js"></script>
</html>
_END;



?>
