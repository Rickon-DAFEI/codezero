<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	<script src="https://unpkg.com/vue-router/dist/vue-router.js"></script>
	<script src="js/login.js"></script>
</head>
<body>
    <div class="get_email">
        mail:
        <div>
            <input type="text" v-model="my_email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,3}$" id="email">
            <button @click="send_email" id="send_email">获取验证码</button>
        </div>
        
        <input type="text" v-model="input_code" name="check_send">
        <button @click="check" >绑定邮箱</button>
    </div>
</body>
</html>


<script>
    new Vue({
        el:'.get_email',
        data:{
            my_email:'',
            my_code:'@QUIhbq2kbcuiasb123',
            input_code:'',
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
            check:function(){
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
</script>

