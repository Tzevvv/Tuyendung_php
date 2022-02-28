
<form method="post">
  <input type="submit" name="a" value="heloo">
</form>

<?php
function generateRandomString($length = 6) {
    return substr(str_shuffle(str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ceil($length/strlen($x)) )),1,$length);
}

echo  generateRandomString();  // OR: generateRandomString(24)
?>
