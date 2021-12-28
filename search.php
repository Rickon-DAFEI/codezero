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
				// echo $_SESSION['admin'];
				$_SESSION['nick'] = $row['username'];
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
			echo "<script>window.location.href = 'search.php';</script>";
		}
		else {
			$sql = " insert into user(account,password,username) value('$sign_ac','$sign_pass','$sign_name');";
			if(mysqli_query($conn, $sql)){
				echo "<script>alert('注册成功');</script>";
				echo "<script>window.location.href = 'search.php';</script>";
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
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
	<title>搜索</title>
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
				<li><a class="left" href="index.php"><img class="logo" src="logo.jpg" alt="CodeZero"></a></li>
				<li><a class="left " href="index.php">导图</a></li>
				<li><a class="left nav-selection-xhx" href="search.php">题库</a></li>
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
			<span style="margin-top: 10px;cursor: pointer;" class="go-icon-cancal fa fa-times right " aria-hidden="true" onclick="hideLogin();"></span>
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
                <form action="" method="POST" autocomplete="off"  onsubmit = "return sign_check()" name = "sign_form" >
					<div class="inputBox">
                        <input type="text" name="nickname" required=""/>
                        <label>昵称</label>
                    </div>
                    <div class="inputBox">
						<input type="text" name="login_account" required=""/>
						<div id ='add_alert3' class = "alert_word"></div>
                        <label>用户名</label>
                    </div>
                    <div class="inputBox">
						<input type="password" name="login_password" required=""/>
						<div id ='add_alert4' class = "alert_word"></div>
                        <label>密码</label>
                    </div>
                    <div class="inputBox">
						<input type="password" name="login_password_re" required=""/>
						<div id ='add_alert5' class = "alert_word"></div>
                        <label>确认密码</label>
                    </div>
                    <input type="submit" name="" class="left" value="提交">
                    <input type="button" name="" class="right Register" value="登录" onclick="showLogin();"/>
                </form>
            </div>
        </div>  

		<!-- <div class="zd"></div> -->
		<div class="box-title">
		    <div class="box-title-center">
        	    <div class="cz">CodeZero</div>
			    <div class="box-search"> 
				    <div class="search-frame"></div>
					<form method="post" name = "search_form" autocomplete="off">
					<input class="search-text" style="outline: none;" type="text" name="sskw" placeholder="search" >		
				    <input class="search-button" style="outline: none;" type="submit" name="ssn" value="search" >
					</form>
			    </div>
		    </div>
		</div>

		<div class="body-search clearfix">
		    <div class="search-page">
		    	<div class="page-bar clearfix">
                    <ul>
                        <li v-if="now>1"  style="width:80px"><div style="width:80px" v-on:click="now- pageClick(-1)" class="click-ordinary">上一页</div></li>
                        <li v-if="now==1"  style="width:80px"><div style="width:80px" class="banclick" >上一页</div></li>
                        <li class="click-ordinary" v-for="index in page_array"  v-bind:class="{ 'active': index == now}">
                            <div v-on:click="btnClick(index)">{{ index }}</div>
                        </li>
                        <li v-if="now!=all" style="width:80px"><div  style="width:80px" v-on:click="pageClick(1)" class="click-ordinary">下一页</div></li>
                        <li v-if="now == all" style="width:80px"><div  style="width:80px" class="banclick">下一页</div></li>
                        <li  style="width:80px"><div style="width:80px;color:#6a6a6a">共{{all}}页</div></li>
                    </ul>
                </div>
		    </div>

	        <div class="body-search-table clearfix">
	        	<table>
	        		<thead class="thb">
	        			<tr>
        			        <th >ID</th>
        			        <th class="title-width">标题</th>
        			        <th >通过率</th>
        			        <th >难度</th>
        			        <th >题目来源</th>
        		        </tr>
					</thead>
        		    <tbody id = "pro_main">
	        		    <tr v-for="pro in prolis">
	        			    <td >{{pro.id}}</td>
	        			    <td @click="link(pro.id,pro.title)"><a href="pro_main.php">{{pro.title}}</a></td>
	        			    <td >{{pro.per}}</td>
							<td v-html="pro.level"></td>
							<td>{{pro.resource}}</td>
	        		    </tr>
	        	    </tbody>
	        	</table>
	        </div>
			<div class="jump_con">
				<input  class="input_page" type="text" v-model="page_index">
				<button @click="jump" class="jump_button">跳转</button>
			</div>
	    </div>
        <script>
			var storage=window.localStorage;
			storage['search_word'] = "<?php echo $_POST['sskw']?>";
		</script>
	</div>

	<div class="pg-footer clearfix">
	<div id ="foot" style="display: flex;justify-content:space-around;align-items: center;height: 150px;font-size:12px">
			<span style="color: #ccc"> ©  CopyRight 2020 codezero.top Inc.All Rights Reserved. </span>
			<span><a href="http://www.miit.gov.cn/">备案号 浙ICP备19038210号-2</a></span>
	</div>
		<span id="goTop" class="icon fa fa-eject hide" aria-hidden="true" onclick="goTop();"></span>
	</div>

	<script src="js/search.js"></script>
	<script src="js/login.js"></script>
</body>
</html>