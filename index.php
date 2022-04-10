<?php
$time0 = microtime(true);
$time1 = microtime(true);
$timec = (int)(($time1 - $time0)*1000000);
echo "<!--开始计时：$timec μs-->\n";

$ht_pass = "wolf4096";      //设置网站后台密码
$xs_beia = "";              //设置网站备案号

//设置数据库参数
$db_addr = "localhost";     //主机地址(一般不改)
$db_user = "0l6_cc";        //数据库用户名
$db_pass = "wolf64";        //数据库密码
$db_name = "0l6_cc";        //数据库名
$db_conn = new mysqli($db_addr, $db_user, $db_pass, $db_name);

//初始化数据库
$sql = "SELECT * FROM `wolf4096-url` WHERE `ID` = 746515005";
if ($db_conn->query($sql)){
    $sql = "";
}else{
    $sql = "CREATE TABLE `wolf4096-url` (`id` int(8) NOT NULL,`time` datetime NOT NULL,`ip` varchar(16) NOT NULL,`longurl` text NOT NULL,`shorturl` varchar(8) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    if ($db_conn->query($sql)){
        $sql = "ALTER TABLE `wolf4096-url` ADD PRIMARY KEY (`id`);";$db_conn->query($sql);
        $sql = "ALTER TABLE `wolf4096-url` MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;";$db_conn->query($sql);
        $sql = "CREATE TABLE `wolf4096-browse` (`id` int(8) NOT NULL,`time` datetime NOT NULL,`ip` varchar(16) NOT NULL,`url` varchar(32) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;";$db_conn->query($sql);
        $sql = "ALTER TABLE `wolf4096-browse` ADD PRIMARY KEY (`id`);";$db_conn->query($sql);
        $sql = "ALTER TABLE `wolf4096-browse` MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;";$db_conn->query($sql);
        $sql = "CREATE TABLE `wolf4096-mark` (`id` int(4) NOT NULL,`list` varchar(32) NOT NULL,`mark` int(1) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;";$db_conn->query($sql);
        $sql = "ALTER TABLE `wolf4096-mark` ADD PRIMARY KEY (`id`);";$db_conn->query($sql);
        $sql = "ALTER TABLE `wolf4096-mark` MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;";$db_conn->query($sql);
        $sql = "INSERT INTO `wolf4096-url` VALUES (1, '2022-04-10 20:48:02', '127.0.0.1', 'https://github.com/WOLF4096', '1')";$db_conn->query($sql);
        $sql = "INSERT INTO `wolf4096-mark`VALUES (NULL,'github.com',0)";$db_conn->query($sql);
        $time1 = microtime(true);
        $timec = (int)(($time1 - $time0)*1000000);
        echo "<script>window.alert('初始化完成，耗时：$timec μs');</script>";
    }else{
        echo "<script>window.alert('初始化失败,请检查数据库参数是否正确');</script>";
    }
}

//获取一堆参数
$hq_text = (String)$_POST["inturl"];$hq_text = str_replace('`','',$hq_text);$hq_text = str_replace("'",'',$hq_text);
$hq_bian = (String)$_POST["outurl"];$hq_bian = str_replace('`','',$hq_bian);$hq_bian = str_replace("'",'',$hq_bian);
$hq_caoz = (String)$_POST["operat"];$hq_caoz = str_replace('`','',$hq_caoz);$hq_caoz = str_replace("'",'',$hq_caoz);
$hq_udpu = (String)$_POST["updurl"];$hq_udpu = str_replace('`','',$hq_udpu);$hq_udpu = str_replace("'",'',$hq_udpu);
$hq_root = (int)$_GET["root"];      $hq_root = str_replace('`','',$hq_root);$hq_root = str_replace("'",'',$hq_root);
$hq_num1 = (int)$_POST["updid"];    $hq_num1 = str_replace('`','',$hq_num1);$hq_num1 = str_replace("'",'',$hq_num1);
$hq_num2 = (int)$_POST["updmr"];    $hq_num2 = str_replace('`','',$hq_num2);$hq_num2 = str_replace("'",'',$hq_num2);

if ($_SERVER['SERVER_PORT'] == '443'){
    $gt_http = 'https://';
}else{
    $gt_http = 'http://';
}
$gt_host = $_SERVER['HTTP_HOST'];
$gt_durl = $_SERVER['REQUEST_URI'];
$gt_addu = $gt_http.$gt_host.$gt_durl;
$gt_inde = $gt_http.$gt_host."/";
$gt_ilen = strlen($gt_inde);
if (substr($hq_bian, 0, $gt_ilen) == $gt_inde){
    $hq_bian = (String)substr($hq_bian, $gt_ilen, 8);
}
if (getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'),'unknown')) {
    $wolf_ip = getenv('HTTP_CLIENT_IP');
}elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'),'unknown')) {
    $wolf_ip = getenv('HTTP_X_FORWARDED_FOR');
}elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'),'unknown')) {
    $wolf_ip = getenv('REMOTE_ADDR');
}elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'],'unknown')) {
    $wolf_ip = $_SERVER['REMOTE_ADDR'];
}
$wolf_ip = preg_match ('/[\d\.]{7,15}/',$wolf_ip,$matches) ?$matches[0] :'';
$wolf_sj = date('Y-m-d H:i:s',time());
$wolf_32 = date('Y-m-d H:i:s',time() - 24*60*60);

$time2 = microtime(true);
$time1 = microtime(true);
$timec = (int)(($time1 - $time0)*1000000);
echo "<!--获取参数：$timec μs-->\n";

//添加访客记录
$sql = "INSERT INTO `wolf4096-browse` VALUES (NULL, '$wolf_sj', '$wolf_ip', '$gt_addu')";
$db_conn->query($sql);

function outhtmltop(){
echo <<<EOF
<!-- 狼介（WOLF4096）    Email: wolf4096@foxmail.com    QQ: 2275203821
 _       __   ____     __     ______   __ __   ____    ____    _____
| |     / /  / __ \   / /    / ____/  / // /  / __ \  / __ \  / ___/
| | /| / /  / / / /  / /    / /_     / // /_ / / / / / /_/ / / __ \ 
| |/ |/ /  / /_/ /  / /___ / __/    /__  __// /_/ /  \__, / / /_/ / 
|__/|__/   \____/  /_____//_/         /_/   \____/  /____/  \____/  

https://github.com/WOLF4096    All Platform ID: WOLF4096
如有修改建议、添加功能、修复Bug等问题，请与本狼联系（不吃人）
-->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"> 
        <title>狼介短址</title>
        <link rel="shortcut icon" href="/favicon.png" type="image/x-icon">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    </head>
    <style>
        body {margin: 0;background-color: #eff2f5;text-align: center;}
        input[type=text],textarea {width: 64%;padding: 12px 20px;margin: 0 14px;border: 1px solid #ccc;border-radius: 4px;box-sizing: border-box;background: #fff;font-family: none;color: #777;}
        input[type=button],[type=submit] {background-color: #6d8db6;color: white;padding: 12px 20px;margin: 8px 0;border: none;border-radius: 4px;cursor: pointer;}
        input[type=button],[type=submit]:hover {background-color: #5d729d;}
        img {width: 100%;}
        a:link {color:#000;text-decoration:none;}
        a:visited {color:#000;}
        .aw {display: inline-block;padding: 10px 16px;font-size: 14px;line-height: 1;background-color: #6d8db6;border-radius: 3px;}
        .dk {background: #f7f7f7;padding: 24px;text-align: left;font-size: 14px;border-radius: 5px;border: 1px solid #babbbc;line-height: 27px;margin: auto;min-width: 320px;max-width: 800px;}
    </style>
    <body>
        <div style="width: 100%;height: 160px;"></div>
        <h1><a href="/">狼介短址</a></h1>
EOF;
}
function outhtmlbot($gt_durl,$xs_beia){
?>
        <br />
        <div style="width: 100%;height:20px;position: inherit;bottom: 10px;font-size: 12px;color: #777;">
            Copyright © 2022.
            <a href="https://blog.wolf4096.top/" target="_blank" style="color: #777;">狼介(WOLF4096). </a>
            <a href="/_help" style="color: #777;">使用方法. </a>
            <a href="https://beian.miit.gov.cn/" style="color: #777;"><?php echo $xs_beia; ?></a>
        </div><br/>
        <script>
            function posturl(str) {
                var curl = encodeURIComponent(document.getElementById("curl").value);
                var durl = document.getElementById("durl").value;
                var post = "inturl=" + curl + "&outurl=" + durl + "&operat=" + str;
                var httpRequest = new XMLHttpRequest();
                httpRequest.open('POST', '<?php echo $gt_durl;?>', true);
                httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                httpRequest.send(post);
                httpRequest.onreadystatechange = function() {
                    if (httpRequest.readyState == 4 && httpRequest.status == 200) {
                        var getreturn = httpRequest.responseText;
                        document.getElementById("WOLF4096").innerHTML = getreturn;
                    }
                };
            }
        </script>
    </body>
</html>
<?php
}
function outmarkdown($cx_text,$gt_addu){
echo '
            <div class="dk">
                <div style="word-break: break-all;font-size: 14px;">
                '."\n".$cx_text."\n".'
                </div>
                <div style="margin-top: 15px;padding-top: 30px;text-align: right;border-top: 1px solid #d8d8d8;">
                    <div style="position: absolute;">当前页面：'.$gt_addu.'</div>
                    <a class="aw" style="color: #fff;" href="/" >返回主页</a>
                </div>
            </div>
';
}
function cx_mark($cx_host,$db_conn){
    $cx_host = strtolower($cx_host);
    $ls_host = parse_url($cx_host);
    $gt_host = $ls_host['host'];
    $ls_data = explode('.', $gt_host);
    $ls_lend = count($ls_data);
    $preg = '/[\w].+\.(com|net|org|gov|edu)\.cn$/';
    if(($ls_lend > 2) && preg_match($preg,$gt_host)){
        $gt_host = $ls_data[$ls_lend - 3].'.'.$ls_data[$ls_lend - 2].'.'.$ls_data[$ls_lend - 1];
    }else{
        $gt_host = $ls_data[$ls_lend - 2].'.'.$ls_data[$ls_lend - 1];
    }
    $sql = "SELECT * FROM `wolf4096-mark` WHERE `list` = '$gt_host'";
    $res = $db_conn->query($sql);
    $row = $res->fetch_assoc();
    $cx_mark = $row["mark"];
    $cx_mark = array("$cx_mark","$gt_host");
    return $cx_mark;
}
function biantotext($hq_bian,$db_conn){
    $sql = "SELECT * FROM `wolf4096-url` WHERE binary `shorturl` = '$hq_bian'";
    $row = mysqli_fetch_array($db_conn->query($sql));
    $cx_text = $row["longurl"];
    $cx_time = $row["time"];
    $cx_dtot = array("$cx_text","$cx_time");
    return $cx_dtot;
}

$time3 = microtime(true);
$time1 = microtime(true);
$timec = (int)(($time1 - $time2)*1000000);
echo "<!--加载函数：$timec μs-->\n";

//以下是很容易理解的代码
if ($gt_durl == "/_help"){
    $text = '
<!--markdown-->
**狼介短址** 是由 **[狼介(WOLF4096)][1]** 开发的一个 **[开源的短链接项目][2]**，使用简单，核心代码不到 30KB（包含前后端及后台）  
如有遇到 Bug 可联系 **狼介**  邮箱：wolf4096@foxmail.com

1.创建短址
==
**使用方法**：输入 链接、文本 以及 Markdown  
一、**链接**：输入/粘贴 链接 → 生成短址  
二、**文本**：输入/粘贴 文本 → 生成短址  
三、**Markdown**：输入/粘贴 Markdown → 生成短址，头部必须包含 "**&lt;!--markdown--&gt;**" 字符  
**Markdown示例：**<br />  
![Markdown][3]

2.查询短址
==
**使用方法**：输入短址 或 编号  
一、**短址**：输入/粘贴 短址-->查询短址  
例如：**'.$gt_inde.'1**  
二、**编号**：输入/粘贴 编号-->查询短址  
例如：**1**  

3.关于链接
==
网站后台有一张标记表，用于标记链接状态

|  值   | 状态  |
|  ----  | ----  |
| 0  | 怀疑 |
| 1  | 信任 |
| 2  | 拒绝 |

若域名标记为0，则弹出中间页面（默认为0）  
若域名标记为1，直接跳转目标url  
若域名标记为2，则不显示链接  
需要 **管理员** 进入网站 **[后台][4]** 才能修改

  [1]: https://blog.wolf4096.top
  [2]: https://github.com/WOLF4096
  [3]: https://vkceyugu.cdn.bspapp.com/VKCEYUGU-9a8cc5dd-fdd4-4b4b-a15d-b62edf64e883/ade1b15d-2059-403b-bfc0-2f977f96595b.png
  [4]: '.$gt_inde.'_admin
    ';
    require 'Parsedown.php';
    $Parsedown = new Parsedown();
    $text = $Parsedown->text($text);
    echo outhtmltop();
    echo outmarkdown($text,$gt_addu);
    echo outhtmlbot($gt_durl,$xs_beia);
}elseif (substr($gt_durl, 0, 7) == "/_admin"){
    $to_cook = sha1($ht_pass."WOLF4096".$gt_host).sha1($ht_pass."746515005".$gt_host);
    $hq_cook = $_COOKIE["WOLF4096"];
    if ($hq_cook == $to_cook){
        echo outhtmltop();
        echo '<div class="dk"><div style="word-break: break-all;font-size: 14px;">';
        switch ($hq_root){
        case 1:
            $sql = "SELECT `url`,COUNT(*) as `zong` FROM `wolf4096-browse` GROUP BY `url` DESC ORDER BY `zong` DESC LIMIT 100";
            $res = $db_conn->query($sql);
            echo '<a href="/_admin" ><input type="button" value="后台主页" style="padding: 10px 16px;margin: 8px 6px;"></a><span>注：需要更多操作，请自行前往数据库操作</span><h3>查看排名表 (最新的100条)</h3>
            <table border="0" style="margin: auto;width: 100%;text-align: center;border: 1px dashed;"><tr><td>最后访问时间</td><td>最后访问IP</td><td style="text-align: left;">链接</td><td>访问量</td></tr>';
            if ($res->num_rows > 0) {
                while($row = $res->fetch_assoc()) {
                    $cx_surl = $row["url"];
                    $cx_paim = $row["zong"];
                    $sqla = "SELECT* FROM `wolf4096-browse` WHERE `time`=(SELECT MAX(`time`) FROM `wolf4096-browse` WHERE `url`='$cx_surl') and `url`='$cx_surl'";
                    $row = mysqli_fetch_array($db_conn->query($sqla));
                    $cx_time = $row["time"];
                    $wolf_ip = $row["ip"];
                    echo "\n<tr><td>$cx_time</td><td>$wolf_ip</td><td style=".'"'."text-align: left;".'"'.">$cx_surl</td><td>$cx_paim</td></tr>";
                }
            }echo "</table>";            
            break;
        case 2:
            function root2($db_conn){
                $sql = "SELECT * FROM `wolf4096-url` GROUP by `id` DESC LIMIT 100";
                $res = $db_conn->query($sql);
                echo '<form name="input" action="/_admin?root=2" method="post"><input type="hidden" name="root" value="2" >
                修改：<input type="text" name="updid" placeholder="输入要修改的ID" style="width: 36%;padding: 10px 12px;margin: 5px 5px;"><input type="text" name="updurl" placeholder="输入要修改的内容" style="width: 36%;padding: 10px 12px;margin: 5px 5px;"><br/>
                删除：<input type="text" name="updmr" placeholder="输入要删除的ID" style="width: 36%;padding: 10px 12px;margin: 5px 5px;"><input type="submit" value="提交修改" style="padding: 10px 16px;margin: 8px 6px;"><a href="/_admin" ><input type="button" value="后台主页" style="padding: 10px 16px;margin: 8px 6px;"></a></form>
                <h3>查看链接表 (最新的100条)</h3><table border="0" style="margin: auto;width: 100%;text-align: center;border: 1px dashed;"><tr><td>ID</td><td>创建时间</td><td>IP</td><td>短链接</td><td>长连接</td></tr>';
                if ($res->num_rows > 0) {
                    while($row = $res->fetch_assoc()) {
                        $cx_idr2 = $row["id"];
                        $cx_time = $row["time"];
                        $wolf_ip = $row["ip"];
                        $cx_surl = $row["shorturl"];
                        $cx_lurl = substr($row["longurl"], 0, 32);
                        echo "\n<tr><td>$cx_idr2</td><td>$cx_time</td><td>$wolf_ip</td><td>$cx_surl</td><td style=".'"'."text-align: left;".'"'.">$cx_lurl</td></tr>";
                    }
                }echo "</table>";
            }
            if ($hq_num1 <> "" and $hq_udpu <> ""){
                $sql = "UPDATE `wolf4096-url` SET `longurl`='$hq_udpu' WHERE `id` = $hq_num1";
                $db_conn->query($sql);
                root2($db_conn);
            }elseif ($hq_num2 <> ""){
                $sql = "DELETE FROM `wolf4096-url` WHERE `id` = $hq_num2";
                $db_conn->query($sql);
                root2($db_conn);
            }else{
                root2($db_conn);
            }            
            break;
        case 3:
            function root3($db_conn){
                $sql = "SELECT * FROM `wolf4096-mark` GROUP by `id` DESC LIMIT 100";
                $res = $db_conn->query($sql);
                echo '<form name="input" action="/_admin?root=3" method="post"><input type="hidden" name="root" value="3" >
                将ID：<input type="text" name="updid" placeholder="ID" style="width: 20%;padding: 10px 12px;margin: 5px 5px;">
                修改为：<input type="radio" name="updmr" value="0">怀疑 <input type="radio" name="updmr" value="1">信任 <input type="radio" name="updmr" value="2">拒绝 
                <input type="submit" value="提交修改" style="padding: 10px 16px;margin: 8px 6px;"><a href="/_admin" ><input type="button" value="后台主页" style="padding: 10px 16px;margin: 8px 6px;"></a></form>
                <h3>查看标记表 (最新的100条)</h3><table border="0" style="margin: auto;width: 100%;text-align: center;border: 1px dashed;"><tr><td>ID</td><td>域名</td><td>标记</td></tr>';
                if ($res->num_rows > 0) {
                    while($row = $res->fetch_assoc()) {
                        $cx_idr3 = $row["id"];
                        $cx_list = substr($row["list"], 0, 32);
                        $cx_mark = $row["mark"];
                        if ($cx_list == "."){
                            $cx_list = "所有文本";
                        }
                        if ($cx_mark == 0){
                            $ls_mark = "怀疑";
                        }elseif ($cx_mark == 1){
                            $ls_mark = "信任";
                        }elseif ($cx_mark == 2){
                            $ls_mark = "拒绝";
                        }else{
                            $ls_mark = "错误".$cx_mark;
                        }
                        echo "\n<tr><td>$cx_idr3</td><td style=".'"'."text-align: left;".'"'.">$cx_list</td><td>$ls_mark</td></tr>";
                    }
                }echo "</table>";
            }
            if ($hq_num1 <> "" and $hq_num2 <> "" and $hq_num2 < 3){
                $sql = "UPDATE `wolf4096-mark` SET `mark`= $hq_num2 WHERE `id` = $hq_num1";
                $db_conn->query($sql);
                root3($db_conn);
            }else{
                root3($db_conn);
            }            
            break;
        case 4:
            $sql = "SELECT * FROM `wolf4096-browse` GROUP by `id` DESC LIMIT 100";
            $res = $db_conn->query($sql);
            echo '<a href="/_admin" ><input type="button" value="后台主页" style="padding: 10px 16px;margin: 8px 6px;"></a><span>注：需要更多操作，请自行前往数据库操作</span><h3>查看访客表 (最新的100条)</h3>
            <table border="0" style="margin: auto;width: 100%;text-align: center;border: 1px dashed;"><tr><td>ID</td><td>时间</td><td>IP</td><td>访问链接</td></tr>';
            if ($res->num_rows > 0) {
                while($row = $res->fetch_assoc()) {
                    $cx_idr4 = $row["id"];
                    $cx_time = $row["time"];
                    $wolf_ip = $row["ip"];
                    $cx_surl = substr($row["url"], 0, 32);
                    echo "\n<tr><td>$cx_idr4</td><td>$cx_time</td><td>$wolf_ip</td><td style=".'"'."text-align: left;".'"'.">$cx_surl</td></tr>";
                }
            }echo "</table>";            
            break;
        default:
            echo '<p style="font-size: 16px;">查询(100条):&nbsp;&nbsp;
                <a class="aw" style="color: #fff;" href="/_admin?root=1" >访客排名表</a></p>
            <p style="font-size: 16px;">查看(100条):&nbsp;&nbsp;
                <a class="aw" style="color: #fff;" href="/_admin?root=2" >链接表</a>&nbsp;
                <a class="aw" style="color: #fff;" href="/_admin?root=3" >标记表</a>&nbsp;
                <a class="aw" style="color: #fff;" href="/_admin?root=4" >访客表</a>&nbsp;
            </p>
            ';            
        }
        echo '</div><div style="margin-top: 15px;padding-top: 30px;text-align: right;border-top: 1px solid #d8d8d8;">
        <div style="position: absolute;">当前页面：'.$gt_addu.'</div><a class="aw" style="color: #fff;" href="/_admin" >后台主页</a>&nbsp;&nbsp;
        <a class="aw" style="color: #fff;" href="/_admin" onclick="document.cookie='."'".'WOLF4096=0;expires=Thu, 01 Jan 1970 00:00:00 GMT'."'".'">点击退出</a>&nbsp;&nbsp;
        <a class="aw" style="color: #fff;" href="/" >返回主页</a></div></div>';
        echo outhtmlbot($gt_durl,$xs_beia);
    }elseif ($hq_caoz == "login" and $hq_text == $ht_pass){
        echo '<h2>登录成功</h2><a class="aw" style="color: #fff;" href="/_admin">进入后台</a><br/>';
        $expire = time()+60*60*24*30;
        setcookie("WOLF4096", "$to_cook", $expire);
    }elseif ($hq_caoz == "login" and $hq_text <> $ht_pass){
        echo '<h2>密码错误</h2><a class="aw" style="color: #fff;" href="/_admin">重新登录</a><br/>';
    }else{
        echo outhtmltop();
        echo <<<EOF
        <div id="WOLF4096" style="min-width: 320px;max-width: 640px;margin: auto;padding: 16px;">
            <textarea rows="1" cols="1" id="curl" placeholder="输入后台管理密码" style="position: relative;top: 15px;"></textarea><input type="button" id="b1" value="登录后台" onclick="posturl('login')" ><br/>
            <input type="hidden" id="durl" value="WOLF4096" >
        </div>
EOF;
        echo outhtmlbot($gt_durl,$xs_beia);
    }
}elseif ($hq_caoz <> ""){
    switch ($hq_caoz){
    case "inturl":
        $sql = "SELECT COUNT(*) AS `coun` FROM `wolf4096-url` WHERE `ip` = '$wolf_ip' AND `time` > '$wolf_32'";
        $row = mysqli_fetch_array($db_conn->query($sql));
        $coun_32 = $row["coun"];
        $ls_mark = cx_mark($hq_text,$db_conn);
        $cx_mark = $ls_mark[0];
        $gt_host = $ls_mark[1];
        if ($cx_mark == ""){
            $sql = "INSERT INTO `wolf4096-mark` VALUES (NULL,'$gt_host',0)";
            $db_conn->query($sql);
        }
        if ($cx_mark == 2){
            echo '<textarea rows="1" cols="1" style="position: relative;top: 15px;" disabled="disabled">'.$hq_text.'</textarea><a href="/"><input type="button" value="返回主页"></a><br/><h2>提交的域名在黑名单中，无法创建短链</h2>';
        }elseif (substr($hq_text, 0, $gt_ilen) == $gt_inde){
            echo '<h2>您搁这套娃呢</h2><a href="/">返回主页</a>';
        }elseif ($coun_32 > 31){
            echo '<h2>今日请求已达上限，明天再来叭</h2><a href="/">返回主页</a>';
        }elseif ($hq_text == ""){
            echo '<h2>您还未输入任何字符</h2><a href="/">返回主页</a>';
        }else{
            $sql = "SELECT * FROM `wolf4096-url` WHERE binary `longurl` = '$hq_text'";
            $row = mysqli_fetch_array($db_conn->query($sql));
            $cx_text = $row["longurl"];
            $gt_durl = $row["shorturl"];
            $cx_time = $row["time"];
            if ($cx_text == ""){
                $sql = "SELECT MAX(`ID`) AS lf FROM `wolf4096-url`";
                $res = $db_conn->query($sql);
                $row = $res->fetch_assoc();
                $uwu = $row["lf"] + 1;
                $dict = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $js_bian = '';
                do {
                    $js_bian = $dict[$uwu % 62] . $js_bian;
                    $uwu = intval($uwu / 62);
                } while ($uwu != 0);
                $cx_text = $hq_text;
                $gt_durl = $js_bian;
                $cx_time = $wolf_sj;
                $sql = "INSERT INTO `wolf4096-url` VALUES (NULL, '$wolf_sj', '$wolf_ip', '$hq_text', '$js_bian')";
                $db_conn->query($sql);
            }
        }
        break;
    case "outurl":
        $ls_mark = cx_mark($cx_text,$db_conn);
        $cx_mark = $ls_mark[0];
        $cx_dtot = biantotext($hq_bian,$db_conn);
        $cx_text = $cx_dtot[0];
        $cx_time = $cx_dtot[1];
        $gt_durl = $hq_bian;
        if ($cx_text == "" or $cx_mark == 2){
            echo '<h2>无结果</h2><a href="/">返回主页</a>';
        }
        break;
    default:
        echo '<h2>非法请求</h2><a href="/">返回主页</a>';
    }
    if ($cx_text <> "" and $gt_durl <> "" and $cx_mark <> 2){
        $sql = "SELECT MAX(`time`) AS timr FROM `wolf4096-browse` WHERE binary `url` = '$qd_mydu'";
        $res = $db_conn->query($sql);
        $row = $res->fetch_assoc();
        $cx_timr = $row["timr"];
        $sql = "SELECT COUNT(*) AS coub FROM `wolf4096-browse` WHERE binary `url` = '$qd_mydu'";
        $res = $db_conn->query($sql);
        $row = $res->fetch_assoc();
        $cx_coub = $row["coub"];
        $qd_mydu = $gt_inde.$gt_durl;
        if ($cx_timr == ""){
            $cx_timr = "从未访问";
        }
        if (substr($cx_text, 0, 4)=="http"){
            $tz1 = "_blank";
            $ann = "打开原链";
            $txt = $cx_text;
        }else{
            $tz1 = "_self";
            $ann = "打开文本";
            $txt = $qd_mydu;
            $cx_text = substr($cx_text, 0, 32);
        }
        echo '<textarea rows="1" cols="1" style="position: relative;top: 15px;overflow: hidden;text-overflow: ellipsis;" disabled="disabled">'.$cx_text.'</textarea><a href="'.$txt.'" target="'.$tz1.'"><input type="button" value="'.$ann.'"></a><br/>
        <input type="text" value="'.$qd_mydu.'" disabled="disabled"><a href="'.$qd_mydu.'" target="'.$tz1.'"><input type="button" value="打开短链"></a><br/><br/>
        <div>
            <div style="width: 30%;float: left;text-align: right;"><img style="width: 115px;height: 115px;" src="https://api.isoyu.com/qr/?m=1&e=L&p=10&url='.$qd_mydu.'" ></div>
            <div style="width: 20px;height: 115px;float: left;">&nbsp;</div>
            <div style="width: 100%;text-align: left;font-size: 14px">创建时间：'.$cx_time.' <br/>最后访问：'.$cx_timr.' <br/>访问总数：'.$cx_coub.' <br/><br/><a href="/"><b style="font-size: 18px;">返回主页</b></a></div>
        </div>';
    }
}elseif ($gt_durl <> "/"){
    $qd_bian = str_replace('/','',$gt_durl);
    $cx_dtot = biantotext($qd_bian,$db_conn);
    $cx_text = $cx_dtot[0];
    $ls_mark = cx_mark($cx_text,$db_conn);
    $cx_mark = $ls_mark[0];
    if ($cx_mark == 0 and $cx_text <> ""){
        echo outhtmltop();
        if (substr($cx_text, 0, 4) == "http"){
            echo '
            <div style="background: #f7f7f7;padding: 24px;text-align: left;font-size: 14px;border-radius: 5px;border: 1px solid #babbbc;line-height: 27px;margin: auto;min-width: 320px;max-width: 470px;">
                <b style="font-size: 16px;">即将离开主站</b><p>您即将离开主站，请注意您的帐号和财产安全。</p>
                <div style="word-break: break-all;font-size: 12px;">'.$cx_text.'</div>
                <div style="margin-top: 15px;padding-top: 30px;text-align: right;border-top: 1px solid #d8d8d8;">
                    <div style="position: absolute;">当前页面：'.$gt_addu.'</div>
                    <a class="aw" style="color: #fff;" href="/" >返回主页</a>&nbsp;&nbsp;
                    <a class="aw" style="color: #fff;" href="'.$cx_text.'" >继续访问</a>
                </div>
            </div>';
        }elseif (substr($cx_text, 0, 15) == "<!--markdown-->"){
            require 'Parsedown.php';
            $Parsedown = new Parsedown();
            $cx_text = urldecode("$cx_text");
            $cx_text = $Parsedown->text($cx_text);
            echo outmarkdown($cx_text,$gt_addu);
        }else{
            echo outmarkdown($cx_text,$gt_addu);
        }
        echo outhtmlbot($gt_durl,$xs_beia);
    }elseif ($cx_mark == 1 and $cx_text <> ""){
        echo outhtmltop();
        if (substr($cx_text, 0, 4) == "http"){
            Header("Location:$cx_text");
        }elseif (substr($cx_text, 0, 15) == "<!--markdown-->"){
            require 'Parsedown.php';
            $Parsedown = new Parsedown();
            $cx_text = urldecode("$cx_text");
            $cx_text = $Parsedown->text($cx_text);
            echo outmarkdown($cx_text,$gt_addu);
        }else{
            echo outmarkdown($cx_text,$gt_addu);
        }
        echo outhtmlbot($gt_durl,$xs_beia);
    }elseif ($cx_mark == 2 and $cx_text <> ""){
        echo outhtmltop();
        echo '<h2>源链接异常，无法访问</h2><a href="/">返回主页</a><br>';
        echo outhtmlbot($gt_durl,$xs_beia);
    }elseif ($qd_bian == "_help" or $qd_bian == "_admin"){
    }else{
        Header("Location:$gt_inde");
    }
}else{
    echo outhtmltop();
    echo <<<EOF
        <div id="WOLF4096" style="min-width: 320px;max-width: 640px;margin: auto;padding: 16px;">
            <textarea rows="1" cols="1" id="curl" placeholder="支持链接、文本 以及 Markdown" style="position: relative;top: 15px;"></textarea><input type="button" id="b1" value="生成短址" onclick="posturl('inturl')" >
            <input type="text" id="durl" placeholder="输入短链 或 编号" ><input type="button" id="d1" value="查询短址" onclick="posturl('outurl')" ><br/>
        </div>
EOF;
    echo outhtmlbot($gt_durl,$xs_beia);
}

$time1 = microtime(true);
$timec = (int)(($time1 - $time3)*1000000);
echo "\n<!--处理请求：$timec μs-->\n";

$time1 = microtime(true);
$timec = (int)(($time1 - $time0)*1000000);
echo "<!--结束计时：$timec μs-->\n\n";
$db_conn->close();
?>