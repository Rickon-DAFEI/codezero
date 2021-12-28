
    $str = '<div class = "level5"><div>';
    $prolis = [ {
            id:'3123',
            title:'123',
            per:'12',
            level:'<div class = "level2"><div>'
        }, {
            id:'3123',
            title:'123',
            per:'12',
            level:'<div class = "level2"><div>'
        }, {
            id:'3123',
            title:'123',
            per:'12',
            level:$str
        } ]
var problem =  new Vue( {
    el: '.tb1',
    data: {
        prolis: $prolis
    }
    } )

var json = {
    'page_index':'main'
};
var mainType = new Vue({
        prolis =[],
        flags =[],
        mounted(){
            this.query_root()
        },
            el:'.dlk ',
            data:{

                s_types:$son_type
            },
            methods:{
                query_root:function(){
                axios.post('web.php',json).then(function (response) {
                    datas = response['data'];
                    alert(datas);
                    root_types = datas.split(",");
                    for(i=1;i<root_types.length;i++){
                        this.prolis.push(root_types[i-1])
                    }							
            }).catch(function (error) {
            　　alert(error);
            });
        },
            }
        })