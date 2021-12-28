<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>导航页</title>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/vue-router/dist/vue-router.js"></script>
</head>
<body>
    <div id="app">
        {{massage}}
        <button @click="get_massage">

        </button>
    </div>
    <?php
        session_start();
        $time = 60*120;
        session_set_cookie_params($time);

    ?>
    <script>
        new Vue({
            el:"#app",
            data:{
                massage:'ok',
                words: {
                    back:'this is words',
                    now:'this is now words',
                },
            },
            methods:{
                get_massage:function(){
                    var that = this;
                    let param = new URLSearchParams();
                    param.append('back',that.words.back);
                    param.append('now',that.words.now);
                    axios.post('http://localhost:8080/codezero_war_exploded/MyFirstServlet',param).then(function (response) {
                        sonlis = response;
                        console.log(sonlis.data);
                    }).catch(function (error) {
                        alert(error);
                    });
                }
            }
        })
    </script>
</body>
</html>