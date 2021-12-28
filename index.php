<?php
	session_start();
	require("database.php");
	if($conn->connect_error){
		die("could not connect mysql");
	}
	if(isset($_POST['login_out'])){
		unset($_SESSION['admin']);
		unset($_SESSION['nick']);
		unset($_SESSION['user_img_url']);
		session_destroy();
	}
	if(isset($_POST['account']) && isset($_POST['password'])){
		$account = $_POST['account'];
		$psd = $_POST['password'];
		$conn->query("set name utf8");
		$result = $conn->query("select * from user where account='$account'");
		$row = $result->fetch_assoc();
		if(!$row['password']){
			$_SESSION['user_img_url']="";
			echo "<script>alert('用户未注册');</script>";
			
		}
		else{
			if($psd == $row['password']){
				$_SESSION['nick'] = $row['username'];
				// echo $_SESSION['admin'];
				$_SESSION['admin'] = $account;
				$_SESSION['user_img_url'] = $row['img_url'];
				// echo $_SESSION['admin'];
			}else{
				echo "<script>alert('密码错误');</script>";
			}
		} 
	}
	if(isset($_POST['login_account']) && isset($_POST['login_password'])&& isset($_POST['nickname'])){
		$sign_ac = $_POST['login_account'];
		$sign_pass = $_POST['login_password'];
		$sign_name = $_POST['nickname'];
		$result = $conn->query("select * from user where account='$sign_ac'");
		$row = $result->fetch_assoc();
		if($row['password']){
			echo "<script>alert('用户已被注册');</script>";
			echo "<script>window.location.href = 'index.php';</script>";
		}
		else {
			$sql = " insert into user(account,password,username) value('$sign_ac','$sign_pass','$sign_name');";
			if(mysqli_query($conn, $sql)){
				echo "<script>alert('注册成功');</script>";
				echo "<script>window.location.href = 'index.php';</script>";
			}
		}
	
	}
	mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link href="logo.jpg" rel="shortcut icon">
	<title>导图</title>
	<link rel="stylesheet" href="plugins/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/ys.css">
	<script src="js/vue.js"></script>
	<script src="js/axios.min.js"></script>
	<script src="js/vue-router.js"></script>
</head>
<body onscroll="bodyScroll();">
	<div class="pg-header">
		<div class="nav">
			<ul>
				<li><a class="left" href=""><img class="logo" src="logo.jpg" alt="CodeZero"></a></li>
				<li><a class="left nav-selection-xhx" href="">导图</a></li>
				<li><a class="left" href="search.php">题库</a></li>
				<li><a class="left" href="">比赛</a></li>
			</ul>
			<ul>
				<li><? 
				if(!isset($_SESSION['admin'])){
					echo "<input type=\"button\" class=\"right home\" value=\"登陆/注册\" onclick=\"showLogin();\"/></input>";
				}
				else{
					echo "<div class=\"right logout\"><form action=\"\" method=\"POST\"><input class=\"outsubmit\" type=\"submit\" name=\"login_out\" value=\"退出登录\"/></form></div>
					<div class=\"right nickname\"><a href=\"personal.php\">".$_SESSION['nick']."</a></div>";
				
				}
				 ?>
				 </li>
				 <?
				 if(isset($_SESSION['admin'])){
					 echo "<div class=\"head_icon\"><a href=\"personal.php\"><img src=\" ".$_SESSION['user_img_url']."\"></a></div>";
				 }
				 ?>
			</ul>
		</div>
	</div>
	<div class="pg-body form clearfix">

		<div id="shade" class="shade hide"></div>

		<div id="modal" class="modal hide">
			<span style="margin-top: 10px;cursor: pointer;" class="go-icon-cancal
			 fa fa-times right " aria-hidden="true" onclick="hideLogin();"></span>
			<div class="box">
                <h2>登录</h2>
				<form name = "login_form" action="" method="POST" autocomplete="off" onsubmit = "return login_check()">
                    <div class="inputBox">
						<input type="text" name="account" required=""/>
						<div id ='add_alert1' class = "alert_word"></div>
                        <label>用户名</label>
                    </div>	
                    <div class="inputBox">
						<input type="password" name="password" required=""/>
						<div id ='add_alert2' class = "alert_word"></div>
                        <label>密码</label>
                    </div>
                    <input type="submit" name="" class="left" value="提交"/>
                    <input type="button" name="" class="right Register" value="注册" onclick="showRegister();"/>
				</form>

            </div>
		</div>

		<div id="modal-Register" class="modal-Register hide">
			<span style="margin-top: 10px;cursor: pointer;" class="go-icon-cancal fa fa-times right " aria-hidden="true" onclick="hideRegister();"></span>
			<div class="box">
				<h2>注册</h2>
				<form action="" method="POST" name="myform" autocomplete="off">
					<div class="inputBox">
						<input type="text" name="nickname" required="" oninput="check1();"/>
						<div id ='add_alert3' class = "alert_word"></div>
						<label id="checkNick">昵称</label>
					</div>
					<div class="inputBox">
						<input type="text" id="login_account" name="login_account" required="" oninput="check2();"/>
						<div id ='add_alert4' class = "alert_word"></div>
						<label id="checkAct">用户名</label>
					</div>
					<div class="inputBox">
						<input type="password" id="login_password" name="login_password" required="" oninput="check3();"/>
						<div id ='add_alert5' class = "alert_word"></div>
						<label id="checkPsd">密码</label>
					</div>
					<div class="inputBox">
						<input type="password" name="login_password_re" required="" oninput="check4();"/>
						<div id ='add_alert6' class = "alert_word"></div>
						<label id="checkPsdRe">请输入密码</label>
					</div>
					<input type="submit" name="" class="left" value="提交" onclick="return checkForm();">
					<input type="button" name="" class="right Register" value="登录" onclick="showLogin();"/>
				</form>
<?php
    if(isset($_POST['nickname']) && isset($_POST['login_account']) && isset($_POST['login_password']) ){
        $nickname = $_POST['nickname'];
        $account = $_POST['login_account'];
        $psd = $_POST['login_password'];


        $conn->query("set name utf8");
        $result = $conn->query("select * from user where account='$account'");

        $row = $result->fetch_assoc();

        if($psd == $row['password']){
        echo "<script>alert('账户已存在');</script>";
        }else{
            $conn->query("insert into user(account,password,username) values('{$account}','{$psd}','{$nickname}');");
            echo "<script>alert('注册成功');</script>";
        }
        mysqli_close($conn);

    }
?>
                
            </div>
        </div>  
          
		<!-- <div class="zd"></div> -->
		<div class="box-title">
		    <div class="box-title-center">
        	    <div class="cz">CodeZero</div>
			    <div class="box-search"> 
				    <div class="search-frame"></div>
					<form method="post" id="serch_line" action="search.php" name = "search_form" autocomplete="off">
					<input class="search-text" style="outline: none;" type="text" name="sskw" placeholder="search" >		
				    <input class="search-button" style="outline: none;" type="submit" name="ssn" value="search" >
					</form>
			    </div>
		    </div>
		</div>

		<div class="box-subject clearfix">
		    <div class="body-header">		    	 
		    	<div class="big-item-nav">
					<div v-for="each in types" v-bind:class="each.index==se?'a-color left xhx':'a-color left'" @click="select(each.index)">{{each.type}}</div>
	            </div>		   
		    </div>

		    <div class="small-item-head  "></div>
		    <div class="triangle"></div>

		    <div class="small-item-box ">
				<!-- <button @click='query_root'></button> -->
				<div v-for="each in sontypes" v-bind:class="each.index==sonse?'small-item small-selection-bgc':'small-item'" @click="se(each.index)" >{{each.type}}</div>
				<!-- <div v-for="each in types" v-bind:class="each.index==se?'small-item xzdl':'small-item'" @click="select(each.index)">{{each.type}}</div> -->
			</div>

	        <div class="table-box">
	        	<table>
	        		<thead class="thb">
	        			<tr>
        			        <th >ID</th>
        			        <th class="title-width">标题</th>
        			        <th >通过率</th>
        			        <th >难度</th>
        		        </tr>
					</thead>
        		    <tbody>
	        		    <tr v-for="pro in prolis">
	        			    <td >{{pro.id}}</td>
	        			    <td @click="link(pro.id,pro.title)"><a href="pro_main.php">{{pro.title}}</a></td>
	        			    <td >{{pro.per}}</td>
							<td v-html="pro.level"></td>
	        		    </tr>
	        	    </tbody>
	
	        	</table>
	        </div>
	    </div>
	</div>

	<div class="pg-footer clearfix">
	<!-- background-color: #eee; -->
	<div id ="foot" style="display: flex;justify-content:space-around;align-items: center;height: 150px;font-size:12px">
			<span style="color: #ccc"> ©  CopyRight 2020 codezero.top Inc.All Rights Reserved. </span>
			<span><a href="http://www.miit.gov.cn/">备案号 浙ICP备19038210号-2</a></span>
	</div>
		<span id="goTop" class="icon fa fa-eject hide" aria-hidden="true" onclick="goTop();"></span>
	</div>

	<script src="js/main.js"></script>
	<script src="js/login.js"></script>
	<script src="js/register.js"></script>
</body>
</html>