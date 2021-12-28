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
				$_SESSION['admin'] = $account;
				$_SESSION['nick'] = $row['username'];
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
			echo "<script>window.location.href = 'pro_main.php';</script>";
		}
		else {
			$sql = " insert into user(account,password,username) value('$sign_ac','$sign_pass','$sign_name');";
			if(mysqli_query($conn, $sql)){
				echo "<script>alert('注册成功');</script>";
				echo "<script>window.location.href = 'pro_main.php';</script>";
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
	<title></title>
	<script>
		document.title = window.localStorage.pro_title;
	</script>
	<link rel="stylesheet" href="plugins/font-awesome-4.7.0/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="css/ys.css">
	<script src="js/vue.js"></script>
	<script src="js/axios.min.js"></script>
	<script src="js/vue-router.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.6/ace.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.6/ext-language_tools.js" type="text/javascript" charset="utf-8"></script>
</head>
<body onscroll="bodyScroll();">
	<div class="pg-header">
	<div class="nav">
			<ul>
				<li><a class="left" href="index.php"><img class="logo" src="logo.jpg" alt="CodeZero"></a></li>
				<li><a class="left nav-selection-xhx" href="index.php">导图</a></li>
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
					<a href="index.php"><div v-for="each in types" v-bind:class="each.index==se?'a-color left xhx':'a-color left'" @click="select(each.index)">{{each.type}}</div></a>
	            </div>		   
		    </div>

		    <div class="small-item-head "></div>
		    <div class="triangle"></div>

		    <div class="small-item-box ">
				<!-- <button @click='query_root'></button> -->
				<a href="index.php"><div v-for="each in sontypes" v-bind:class="each.index==sonse?'small-item small-selection-bgc':'small-item'" @click="se(each.index)" >{{each.type}}</div></a>
				<!-- <div v-for="each in types" v-bind:class="each.index==se?'small-item xzdl':'small-item'" @click="select(each.index)">{{each.type}}</div> -->
			</div>

			<div class="subject-box clearfix">
				<div id="pro_describe">
				<div class="subject-title">{{title}}</div>
                <div class="subject-header">
					<div class="header_con" style="width: 800px;"> 	
						<span>数据限制:{{limit}}</span>
						<span>来源:{{resource}}</span>
					</div>
                </div>
                <div class="subject-content">
						<p v-html="des"></p>
						<h2>Input</h2>
						<p v-html="input"></p>
						<h2>Output</h2>
						<p v-html="output"></p>
						<h2>Sample Input</h2>
						<pre>{{sample_input}}</pre>
						<h2>Sample Output</h2>
						<pre>{{sample_output}}</pre>
						<h2>Hint</h2>
						<pre>{{hint}}</pre>
						<hr style="color: #6a6a6a">
					</div>
				</div>
                	<div class="bd_sr">
						<span>Language:</span>
						<!-- <div id = "t1"> -->
							<select class="lang" name="lang" v-model="selected" @change="change_lan">
								<option v-for="option in options" v-bind:value="option.value">
								  {{ option.text }}
								</option>
							  </select>
							  <span style="margin-left: 30px;">Theme:</span>
							<select class="lang"  name="lang" v-model="th_selected" @change="change_th">
							  <option v-for="option in th_options" v-bind:value="option.value">
								{{ option.text }}
							  </option>
							</select>
							<input type="reset" name="reset" value="重置" class="reset-answer" @click="set_empty()">
							  <!-- <span>Selected: {{ selected }}</span> -->
						<br><br>
						<pre id="code" class="ace_editor" style="min-height:400px"><textarea class="ace_text-input"></textarea></pre>
						<div class="bd_an">
							<div class="res_line">
								<div class = "submit_status">
									{{status}}
								</div>
								<div class="sub_button_con">
								<input type="submit" name="submit" value="调试" class="submit-answer" @click="get_value(1)">
								<input type="submit" name="submit" value="提交" class="submit-answer" @click="get_value(0)">		
								</div>
							</div>
							<div class="res_box" >
							<p :class="{res_none:InputActive}">输入</p>
								<div contenteditable class="Caseinput_box" :class="{res_none:InputActive}" @input="changeVal" @focus="getFocus">
									<pre>{{inputTemp}}</pre>
								</div>
								<p :class="{res_none:ResActive}">输出</p>	
								<div class="Caseres_box" :class="{res_none:ResActive}">
								<pre>{{outputTemp}}</pre>
								</div>

							</div>

						</div>

                    </div>

	        </div>
	    </div>
	</div>

	<div class="pg-footer clearfix">
	<div id ="foot" style="display: flex;justify-content:space-around;align-items: center;height: 150px;font-size:12px">
			<span style="color: #ccc"> ©  CopyRight 2020 codezero.top Inc.All Rights Reserved. </span>
			<span><a href="http://www.miit.gov.cn/">备案号 浙ICP备19038210号-2</a></span>
	</div>
		<span id="goTop" class="icon fa fa-eject hide" aria-hidden="true" onclick="goTop();"></span>
	</div>

	<script src="js/pro_page.js"></script>
	<script src="js/login.js"></script>
		<!-- <div style="border: 1px solid black;width: 500px;height: 1000px"></div> -->

</body>
</html>