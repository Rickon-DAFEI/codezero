<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <pre>
    <?php
    $file_path = "test.txt";
if(file_exists($file_path)){
$fp = fopen($file_path,"r");
$str = fread($fp,filesize($file_path));//指定读取大小，这里把整个文件内容读取出来
echo $str = str_replace("\r\n","<br />",$str);
fclose($fp);
}
?>
</pre>
</body>
</html>