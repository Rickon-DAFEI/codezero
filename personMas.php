<!DOCTYPE html>

<html>
<head>
	<meta charset="utf-8">
	<link href="logo.jpg" rel="shortcut icon">
	<title>个人中心</title>
	<link rel="stylesheet" href="plugins/font-awesome-4.7.0/css/font-awesome.min.css">
	<!-- <link rel="stylesheet" type="text/css" href="layui/css/layui.css"> -->
	<link rel="stylesheet" type="text/css" href="css/ys.css">
	<script src="js/vue.js"></script>
	<script src="js/axios.min.js"></script>
	<script src="js/vue-router.js"></script>
	<script src="js/login.js"></script>

	<!-- <script scr="layui/layui.js"></script> -->
</head>
<body onscroll="bodyScroll();">
	<div class="pg-header">
		<div class="nav">
            <a class="left" href="index.php"><img class="logo" src="logo.jpg" alt="CodeZero"></a>
			<ul>
				<li><a class="left" href="index.php">导图</a></li>
				<li><a class="left" href="search.php">题库</a></li>
				<li><a class="left" href="">比赛</a></li>
				<li><? 
				session_start();
				if(isset($_POST['login_out'])){
					unset($_SESSION['admin']);
					unset($_SESSION['nick']);
					unset($_SESSION['user_img_url']);
					session_destroy();
				}
				if(!isset($_SESSION['admin'])){
					echo "<script>alert('非法访问!')</script>";
					echo "<script>window.location='index.php'</script>";
				}
				else{
					echo "<div class=\"right logout\"><form action=\"\" method=\"POST\"><input class=\"outsubmit\" type=\"submit\" name=\"login_out\" value=\"退出登录\"/></form></div>
					<div class=\"right nickname\"><a href=\"personal.php\">".$_SESSION['nick']."</a></div>";
				
				}
				 ?>	
				 </li>
			</ul>
		</div>
		
    </div>

    <div class="pg-body form clearfix" autocomplete="off">

        <div class="self-box-subject clearfix">

            <div class="self-triangle"></div>

		    <div class="self-body-header">		    	 
		    	<div class="self-item-nav">
                    <li><a class="left self-item " href="personal.php">个人空间</a></li>
                    <li><a class="left self-item self-selection" href="">信息修改</a></li>
                    <li><a class="left self-item" href="">意见反馈</a></li>
	            </div>		   
            </div>

            <div class="self-small-head"></div>

            <div class="avatar">
                <img class="avatarImg" src="<?=$_SESSION['user_img_url']?>" alt="">
            </div>

            <div class="card-text">
                <ul>
                    <li class="self-nickname">昵称 <?=$_SESSION['nick']?></li>
                    <li class="self-nickname-"><??></li>
                    <li class="self-name">用户名<br><?=$_SESSION['admin']?></li>
                    <li class="self-name-"></li>
                </ul>
            </div>
            <div id="nav" class="self-small-item-box clearfix">
                <div class="self-connect"></div>
				<div id="setting" v-bind:class="{'self-small-selection':index==1,'self-small-item':index!=1}" @click="base" onclick="goSetting();">基本资料</div>
                <div class="self-connect"></div>
                <div id="avatar" v-bind:class="{'self-small-selection':index==2,'self-small-item':index!=2}" @click="ava" onclick="goAvatar();">修改头像</div>
                <div class="self-connect"></div>
                <div id="password" v-bind:class="{'self-small-selection':index==3,'self-small-item':index!=3}" @click="pass" onclick="goPassword();">修改密码</div>
				<div class="self-connect"></div>
                <div id="email" v-bind:class="{'self-small-selection':index==4,'self-small-item':index!=4}"v-bind:class={} @click="email" onclick="goEmail();">安全中心</div>
			</div>
			<script>
			new Vue({
				el:'#nav',
				data:{
					index:1,
				},
				methods:{
					base:function(){
						var that=this;
						that.index=1;
					},
					ava:function(){
						var that=this;
						that.index=2;
					},
					pass:function(){
						var that=this;
						that.index=3;
					},
					email:function(){
						var that=this;
						that.index=4;
					},
				} 
			});
			</script>
			<div class="self clearfix">

				<div class="self-content clearfix">
					<div style="text-align: center;width: 500px;margin: 20px auto;border: 1px solid #6a6a6a;height: 360px;border-radius: 5px;padding: 20px 166.5px;" onsubmit="return check()">
						<table class="self-table">
							<tr>
								<th scope="row">昵称：</th>
								<td> 
									<input v-model="input_user_name" class="input-box" type="text" name="name" lable="昵称"/> 
									<div id="namea" class="alert"></div> 
								</td>
							</tr>
							<tr>
								<th scope="row">性别：</th>
								<td>
									<input v-model="input_sex" type="radio" name="sex" value="男">男
									<input v-model="input_sex" type="radio" name="sex" value="女">女
								</td>
							</tr>
							
							<tr>
								<th scope="row" >生日：</th>
								<td> 
									<input v-model="input_birth" class="input-box" type="date" name="birthday" lable="生日"/>
								</td>
							</tr>
							<tr>
								<th scope="row" >个人简介：</th>
								<td>
									<textarea v-model="input_address" class="personal-profile" rows="3" cols="28" name="texta"></textarea>
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="2" style="text-align:center;">
									<!-- <input class="self-submit" type="submit" name="submit" value="确定"/> -->
									<button @click="changeBasic" class="self-submit" name="submit">确认</button>
								</th>
							</tr>
						</table>
					</div>			
				</div>
<script>
	new Vue({
		el:'.self-table',
		data:{
			input_user_name:"",
			input_sex:"",
			input_birth:"",
			input_address:"",
			
        },
		methods:{
			changeBasic:function(){
				var that = this;
				var param = {};
				param['input_user_name'] = this.input_user_name;
				param['input_sex'] = this.input_sex;
				param['input_birth'] = this.input_birth;
				param['input_address'] = this.input_address;

				axios.post('basicMes.php',param).then(function (response) {
                // console.log(response.data);
					alert("基础信息修改成功");
            	}).catch(function (error) {
            　　alert(error);
            });
			}
        } 


	})

</script>
				<div class="self-content clearfix">
					<form style="text-align: center;width: 400px;margin: 20px auto;border: 1px solid #6a6a6a;height: 730px;border-radius: 5px;padding: 20px 216.5px;" action="" method="post" enctype="multipart/form-data"  onsubmit="return check()">
					<div class="a-upload">
							<input type="file" name="file" id="file" style="width: 76px;height: 38px;">选择图片
						</div>
						<p style="color: #6a6a6a;" id="showInfo">仅支持……图片文件，文件小于200k</p>
						<div>
							<div class="avatar-addr">
								<img class="change-avatar" src="<?=$_SESSION['user_img_url']?>" alt="">
							</div>
						</div>    
						<div>
							<!-- <input class="self-submit" type="submit" name="query" value="提交查询"/> -->
							<input class="self-submit" type="submit" name="submit" value="上传"/>
						</div>                
						<div class="avatar-preview">
						<p style="color: #6a6a6a;font-weight:500;font-size:18px;">头像预览</p>
							<div class="avatar160">
								<img class="avatar160-img" name="preview-img" src="" alt=""><span class="text160">160×160</span>
							</div>
							<div class="avatar90">
								<img class="avatar90-img" name="preview-img" src="" alt=""><span class="text90">90×90</span>
							</div>
							<div class="avatarc">
								<img class="avatarc-img" name="preview-img" src="" alt=""><span class="textc">120×120</span>
							</div>
						</div>
<script>
	var fileInput = document.querySelector('input[type=file]'),
		previewImg = document.querySelectorAll('img[name=preview-img]');
		fileInput.addEventListener('change', function () {
		var f = this.files[0];
		var reader = new FileReader();
		// 监听reader对象的的onload事件，当图片加载完成时，把base64编码賦值给预览图片
		reader.addEventListener("load", function () {
			previewImg[0].src = reader.result;
			previewImg[1].src = reader.result;
			previewImg[2].src = reader.result;
		}, false);
		// 调用reader.readAsDataURL()方法，把图片转成base64
		reader.readAsDataURL(f);
	}, false);
</script>

					</form>
<!-- <script>document.getElementById("showInfo").innerHTML("文件太大,请更换图片(<200k)");</script> -->
<?php
	if (!isset($_GET['file']) && $_FILES["file"]["error"] > 0){
		
		// echo "Error: " . $_FILES["file"]["error"] . "<br />";
	}
	else{
		// print_r($_FILES);
		// echo "Upload: " . $_FILES["file"]["name"] . "<br />";
		// echo "Type: " . $_FILES["file"]["type"] . "<br />";
		// echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
		// echo "Stored in: " . $_FILES["file"]["tmp_name"]. "<br />";
		// echo pathinfo($_FILES['upload']['name']);
		if($_FILES["file"]["size"]/1024 > 200){
			// echo "<script>document.getElementById('showInfo').innerHTML('文件太大,请更换图片(<200k)');</script>";
			echo '<script>document.getElementById("showInfo").innerHTML="文件太大,请更换图片(<200k)";</script>';
			// echo "文件太大,请更换图片(<200k)";
		}else{
			$destinationPath = "img/head/".$_FILES["file"]["name"];
		
			if(move_uploaded_file($_FILES["file"]["tmp_name"], $destinationPath)){
				// echo "move success";
				$conn = new mysqli("localhost:3306","root","mysql","CodeZero");
				if($conn->connect_error){
					die("could not connect mysql");
				}
				$conn->query("set name utf8");
				$admin = $_SESSION['admin'];
				// echo $admin;
				if($result = $conn->query("update user set img_url='$destinationPath' where account='$admin'")){
					// echo "update success";
					// echo $destinationPath;
					$_SESSION['user_img_url']=$destinationPath;
					echo '<script>window.location.href="personMas.php"</script>';

					// header("Location:personMas.php");
				}else{
					echo '<script>document.getElementById("showInfo").innerHTML="头像更新失败";</script>';
					// echo "头像更新失败";
				}
			}
		}
		
	}
?>
					

				</div>
				<div class="self-content clearfix">
					<div style="width: 500px;margin: 20px auto;border: 1px solid #6a6a6a;height: 250px;border-radius: 5px;padding: 20px 166.5px;" onsubmit="return check()" name="psd_block">
						<table class="self-table get_password" >
							<tr>
								<th scope="row">请输入原密码：</th>
								<td> 
									<input v-model="input_psd" class="input-box" type="password" required="" name="pwdoud" lable="密码"/>
									<div id="pwda1" class="alert"></div>  
								</td>
							</tr>
							<tr>
								<th scope="row">请输入新密码：</th>
								<td> 
									<input v-model="my_new_psd" id="new_psd" class="input-box" required="" type="password" name="pwdnew1" lable="密码" /> 
									<div id="pwda2" name="pwd1" class="alert"></div>
								</td>
							</tr>
							<tr>
								<th scope="row">请再次输入新密码：</th>
								<td> 
									<input class="input-box" id="new_psd2" type="password" required="" name="pwdnew2" lable="密码" /> 
									<div id="pwda3" name="psd2" class="alert"></div>  
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="2" style="text-align:center;">
									<!-- <input class="self-submit" type="submit" name="submit" value="确定"/> -->
									<button @click="check_psd" class="self-submit" onclick="return checkForm();">确认</button>
								</th>
							</tr>
						</table>
					</div>
				</div>
				<div class="self-content clearfix get_email">
					<div style="width: 700px;margin: 20px auto ;border: 1px solid #6a6a6a;height: 200px;border-radius: 5px;padding: 20px 66.5px;" action="" method="post"  onsubmit="return check()">
						<table class="self-table" style="width: 700px;">
						<tr>
							<th scope="row">请输入邮箱</th>
							<td> 
								<input v-model="my_email" class="input-box" type="text" id="email" lable="E-mail" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,3}$"/>
								
							</td>
						</tr>
						<tr>
							<th scope="row">请输入验证码：</th>
							<td> 
								<input v-model="input_code" class="input-box" style="width: 145px;" type="text" name="check_send" lable="verification-email"/>
								<!-- <input class="self-submit" type="submit" value="获取验证码"/> -->
								<button @click="send_email" class="self-submit" id="send_email">获取验证码</button>
							</td>
						</tr>
						<tr>
							<th scope="row" colspan="2" style="text-align:center;">
								<button @click="check_email" class="self-submit">绑定邮箱</button>
							</th>
						</tr>
						</table>
					</div>			
				</div>

			</div>
           		
        </div>
			
        <span id="goTop" class="icon fa fa-eject hide" aria-hidden="true" onclick="goTop();"></span>

    </div>
	<!-- <script src="js/main.js"></script> -->
</body>
</html>

<script>
    new Vue({
        el:'.get_email',
        data:{
            my_email:'',
            my_code:'',
            input_code:'',
			
			input_psd:'',
			my_new_psd:'',
			
			
        },
        methods:{
            send_email:function(){
                var that = this;
                var param={};
                param['my_email']=this.my_email;
                axios.post('email_server.php',param).then(function (response) {
                that.my_code=response.data;
            }).catch(function (error) {
            　　alert(error);
            });
            },
            check_email:function(){
                var that2 = this;
                if(that2.my_code==that2.input_code){
                    var param2={};
                    param2['my_email'] = this.my_email;
                    axios.post('user_email.php',param2).then(function (response) {
                    email_add_sit=response.data;
						// console.log(email_add_sit);
						// console.log(response.data);
            		}
            ).catch(function (error) {
            　　alert(error);
            });
                }
                else{
                    alert("NO!")
                    return ;
                }
            },
			check_psd:function(){
				var that3 = this;
				var param3 = {};
				param3['input_psd'] = this.input_psd;
				param3['my_new_psd'] = this.my_new_psd;
				// console.log(param3['input_psd']);
				// console.log(param3['my_new_psd']);
				axios.post('psd_server.php',param3).then(function (response) {
                // console.log(response.data);
            	}).catch(function (error) {
            　　alert(error);
            });
			}
        }            
    });
	new Vue({
		el:'.get_password',
		data:{
			input_psd:'',
			my_new_psd:'',
			
        },
		methods:{
			check_psd:function(){
				var that3 = this;
				var param3 = {};
				param3['input_psd'] = this.input_psd;
				param3['my_new_psd'] = this.my_new_psd;
				// console.log(param3['input_psd']);
				// console.log(param3['my_new_psd']);
				axios.post('psd_server.php',param3).then(function (response) {
                // console.log(response.data);
				alert("密码修改成功，退出登录后生效");
            	}).catch(function (error) {
            　　alert(error);
            });
			}
        } 


	})
	
</script> 

<script type="text/javascript">                 
    var wait=60; 
    function time(o) {                              //60秒延时函数
        if (wait == 0) { 
            o.removeAttribute("disabled");           
            o.innerHTML="获取验证码"; 
            wait = 60; 
        } else { 
            o.setAttribute("disabled", true); 
            o.innerHTML=wait+"秒后可以重新发送"; 
            wait--; 
            setTimeout(function() { 
                time(o) 
            }, 
            1000) 
        } 
    } 
    document.getElementById("send_email").onclick=function(){time(this);}   //调用函数

	var isShow=true;
        function change(){
            var v=document.getElementById("new_psd");
            if (isShow) {
                v.type="text";
                isShow=false;
            }else{
                v.type="password";
                isShow=true;
            }
        };
</script>

