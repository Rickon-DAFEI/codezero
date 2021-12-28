
<?php
    session_start();
    require("database.php");
    // 创建连接
    $con = new mysqli($servername, $username, $password ,$dbname);
    // 检测连接
    //   $typeLis = ['11'=>'枚举','12'=>'递归和分治','13'=>'递推','14'=>'构造与模拟','15'=>'
    //  贪心 '];
    if ( !$con ) {
        die( "服务器连接失败: 请联系系统管理员1016831404@qq.com " . $conn->connect_error );
    }//$id = $_POST[ 'id' ];
    //   mysqli_query($con , "set names utf8");
    //   foreach($typeLis as $x=>$xv){
    //       echo $xv;
    //   }
    //   $type = $typeLis['11'];
    $son_typelis = explode(",",$query_anser);
    array_shift($son_typelis);
    $params=json_decode(file_get_contents("php://input"),true);
    if($params['page_index']=='main'){
        $root_typeLis = array();
        $query_anser = '';
        $sql = "select type_name from type_index where root_index=0;";
        $res = mysqli_query($con,$sql);
        while($root_types = $res->fetch_array()){
        // echo $root_types['root_type'];
        // array_push($root_typeLis,$root_types['root_type']);
        $query_anser.=','.$root_types['type_name'];
        // array_push($root_typeLis,$root_types['root_type']);
    }
        print_r($query_anser);
    }
    if($params['page_index']=='son'){
        $index = $params['son_index']+1;
        $sql = "select type_name from type_index where root_index = $index order by son_index";
        $res = mysqli_query($con,$sql);
        $type_lis=[];
        while($son_types = $res->fetch_array()){
            array_push($type_lis,$son_types['type_name']) ;
            $Son_query_anser.=','.$son_types['type_name'];
        }
        echo $Son_query_anser;
    }
    if($params['page_index']=='prolis'){
        $root_index =  $params['root_typename']+1;
        $son_index = $params['son_typename'];
        $sql = "select b.pro_id,b.title,b.solve_num,b.sub_num,level from prolis b inner join typelis a on a.pro_id = b.pro_id and a.root_type=$root_index and a.son_type=$son_index order by b.level,resource desc;";
        $prolis = mysqli_query($con,$sql);
        while($pro_main = $prolis->fetch_array()){
            // print_r($pro_main);
            for($i=0;$i<5;$i++){
                echo $pro_main[$i].'{,}';
            }
            echo $pro_main[5].'{{}}';
            // echo $root_types['root_type'];
            // array_push($root_typeLis,$root_types['root_type']);
            // $query_anser.=','.$root_types['type_name'];
            // array_push($root_typeLis,$root_types['root_type']);
        }
    }
    if($params['page_index']=='pro_main'){
        $pro_id = $params['pro_id'];
        $sql = "select title,concat(tlimit,'    ',mlimit),pro_des,input,output,sample_input,sample_output,resource,hint from prolis where pro_id=$pro_id";
        $pro_body = mysqli_query($con,$sql);
        $ans = $pro_body->fetch_array();
        for($i=0;$i<8;$i++){
            print_r($ans[$i].'{|,|}') ;
    }
    if($params['page_index']=='user'){
        if(isset($_SESSION['admin'])){
            echo $_SESSION['admin'];
        }
        else{
            echo "unLogin_reback";
        }
    }
}
    mysqli_close($con);
    // foreach($root_typeLis as $each){
    //     echo $each.',';
    // }
    // echo $query_anser;
    // if($index=='root1'){
    //     echo 'son_type';
    // }
    // echo json_encode($username);
   
//   $root_typelisJson = json_encode($root_typeLis);
//   echo $root_typelisJson;
?>
