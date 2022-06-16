<?php
$creds = json_decode(file_get_contents('assets/data/creds.json') , true);
$ssoToken = $creds['eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmlxdWUiOiJkNjNjYjYyYy1lYTc0LTQzMzUtOWVmZS1hNjRkNzBkNjE2MDMiLCJ1c2VyVHlwZSI6IlJJTHBlcnNvbiIsImF1dGhMZXZlbCI6IjQwIiwiZGV2aWNlSWQiOiI4ODAyNjZhY2I1NDcyYmJjYWYwZTY0ZWE2YmE0NWE2ZDM1ZTAxNzVkZWQ2NTk4OTIwNGM0NDRhNzlhN2U3MWM4MDA0YWVkNTJlMDgyYWYzN2JkYjk1NGJiNTYxYjM3YmMxOWViOWMzNWMwZmI2MWFjOWVlZjE2ZjM3OTMwOWExNiIsImp0aSI6IjdiMzI4ZTc4LWViNGMtNGU0OC04MDk4LWU4YTJmMjhjYTYzZSIsImlhdCI6MTY1NTM5MjM5M30.AIPxTE0nKdU12AkCbIZOEbLK3PbwRg9rto1diDljg1o'];

$jctBase = "cutibeau2ic";

function tokformat($str)
{
    $str = base64_encode(md5($str, true));
    return str_replace("\n", "", str_replace("\r", "", str_replace("/", "_", str_replace("+", "-", str_replace("=", "", $str)))));
}
function generateJct($st, $pxe)
{
    global $jctBase;
    return trim(tokformat($jctBase . $st . $pxe));
}
function generatePxe()
{
    return time() + 6000000;
}
function generateSt()
{
    global $ssoToken;
    return tokformat($ssoToken);
}
function generateToken()
{
    $st = generateSt();
    $pxe = generatePxe();
    $jct = generateJct($st, $pxe);
    return "?jct=" . $jct . "&pxe=" . $pxe . "&st=" . $st;
}

$token = generateToken();

?>
