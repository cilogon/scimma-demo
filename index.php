<html>
<head><title>SCiMMA Community Demo App</title></head>
<body>
<h1>SCiMMA Community Demo App</h1>
<?php
if (isset($_SERVER['OIDC_CLAIM_cn'])) {
  $name = $_SERVER['OIDC_CLAIM_cn'];
} elseif (isset($_SERVER['OIDC_CLAIM_name'])) {
  $name = $_SERVER['OIDC_CLAIM_name'];
} else {
  $name = "anonymous";
}
echo "<p>Hello $name!</p>\n";
if (isset($_SERVER['OIDC_CLAIM_isMemberOf'])) {
  $groups = explode(',', $_SERVER['OIDC_CLAIM_isMemberOf']);
  $strict = TRUE;
  if (array_search("CO:members:active", $groups, $strict) !== false) {
    $isMember = TRUE;
  }
  if (array_search("Blue Team", $groups, $strict) !== false) {
    $isBlueTeamMember = TRUE;
  }
  if (array_search("Red Team", $groups, $strict) !== false) {
    $isBlueTeamMember = TRUE;
  }
}
if ($isMember) {
  echo "<p>You are a current member of the <a href=\"https://scimma.github.io/IAM/Community/\">SCiMMA Community</a>!</p>\n";  
} else {
  echo "<p>You are not a current member of the SCiMMA Community. Did you <a href=\"https://scimma.github.io/IAM/Community/\">enroll</a> with the identity that you used to log in?</p>\n";  
}
if ($isBlueTeamMember) {
  echo "<p>You are a member of the Blue Team!</p>\n";
  echo "<p><img src=\"https://scimma.github.io/IAM/Community/blueteam.png\" /></p>\n";
}
if ($isRedTeamMember) {
  echo "<p>You are a member of the Red Team!</p>\n";
  echo "<p><img src=\"https://scimma.github.io/IAM/Community/redteam.png\" /></p>\n";
}
echo "<p>You can <a href=\"./redirect?logout=/oidc\">logout</a> to try this demo again.</p>\n";
echo "<p>Visit <a href=\"https://github.com/cilogon/scimma-demo\">https://github.com/cilogon/scimma-demo</a> for more information about this demo.</p>\n";
echo "<p>HTTP headers are provided below for diagnostics.</p>\n";
echo "<hr />\n";
echo "<table>\n";
ksort($_SERVER);
foreach ($_SERVER as $key => $value) {
  echo "<tr><td>$key</td><td>$value</td></tr>\n";
}
echo "</table>\n";
?>
</body></html>
