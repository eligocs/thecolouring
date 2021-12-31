<?php
$command = "grep -ri 'to' ./*";
$output = shell_exec($command);
echo "$output";
echo "Grep job over.";
?>