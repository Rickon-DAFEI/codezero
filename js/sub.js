new Vue({
    el:"#mes_table",
    mounted(){
        this.get_lis();
    },
    data:{
        reslis:[
            {
                index:0,
                pro_id:'',
                sub_time:'',
                language:'',
                status:'',
                filepath:'',
            },
        ]
    },
    methods:{
        get_lis:function(){
            var that = this;
            // axios.post('subServer.php').then(function(response){
            //     mes_lis = response.data;
            //     that.reslis=[];
            //     for(i=0;i<mes_lis.length;i++){
            //         // console.log(mes_lis[i]);
            //         // let temp = mes_lis[i];
            //         // console.log(temp[0]);
            //         that.reslis.push({
            //             index:i,
            //             pro_id:mes_lis[i][0],
            //             sub_time:mes_lis[i][1],
            //             language:mes_lis[i][2],
            //             status:mes_lis[i][3],
            //             filepath:mes_lis[i][4],
            //         })
            //     }
            // }).catch(function(error){
            //     alert(error);
            // });
            // console.log("ok");
        },
        get_code(e){
            // console.log(e);
            window.open("code.php");
        }
    }
})