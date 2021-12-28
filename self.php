
<?php
	session_start();
	$conn = new mysqli("localhost:3306","root","mysql","CodeZero");
	if($conn->connect_error){
		die("could not connect mysql");
	}
	if(isset($_POST['login_out'])){
		unset($_SESSION['admin']);
	}
	if(isset($_POST['account']) && isset($_POST['password'])){
		$account = $_POST['account'];
		$psd = $_POST['password'];
		$conn->query("set name utf8");
		$result = $conn->query("select * from user where account='$account'");
		$row = $result->fetch_assoc();
		if(!$row['password']){
			echo "<script>alert('用户未注册');</script>";
		}
		else{
			if($psd == $row['password']){
				// echo $_SESSION['admin'];
				$_SESSION['admin'] = $account;
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
		$sql = " insert into user(account,password,username) value('$sign_ac','$sign_pass','$sign_name');";
		if(mysqli_query($conn, $sql)){
			
		}
		else{
			echo "<script>alert('用户名被占用');</script>";
		}
	}
	mysqli_close($conn);
?>
<!DOCTYPE html>

<html>
<head>
	<meta charset="utf-8">
	<link href="logo.jpg" rel="shortcut icon">
	<title>测试</title>
	<link rel="stylesheet" href="plugins/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/ys.css">
	<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	<script src="https://unpkg.com/vue-router/dist/vue-router.js"></script>
	<script src="js/login.js"></script>
</head>
<body onscroll="bodyScroll();">
	<div class="pg-header">
		<div class="nav">
			<a class="left" href="">CODEZERO</a>
			<ul>
				<li><a class="left nav-selection-xhx" href="">导图</a></li>
				<li><a class="left" href="http://localhost:8080/codezero/test.jsp">题库</a></li>
				<li><a class="left" href="">比赛</a></li>
				<li><? 
				session_start();
				if(!isset($_SESSION['admin'])){
					echo "<input type=\"button\" class=\"right home\" value=\"HOME\" onclick=\"showLogin();\"/></input>";
				}
				else{
					echo "<li><div class=\"right logout\"><form action=\"\" method=\"POST\"><input type=\"submit\" name=\"login_out\" value=\"退出登陆\"/></form></div></li>
					<li><div class=\"right nickname\">个人中心</div></li>";
				}
				 ?>	
				 </li>
			</ul>
		</div>
		<div id="jspt">
			<button @click="get_word">获取</button>
			<span>{{massage}}</span>
		</div>
		<script>
			new Vue({
				el:'#jspt',
				data:{
					massage:'OK!',
				},
				methods:{
					get_word:function(){
						axios.post('localhost:8080/codezero/test.jsp',this.post_words).then(function(response){
							console.log(response);
						})
					}
				}

			})
		</script>
	</div>
	<div class="pg-footer clearfix">
		<span id="goTop" class="icon fa fa-eject hide" aria-hidden="true" onclick="goTop();"></span>
	</div>
	<!-- <script src="js/main.js"></script> -->
</body>
</html>