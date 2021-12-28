
<?php
        require("database.php");
		// $conn = new mysqli("localhost::3306","root","mysql","CodeZero");
		if($conn->connect_error){
			die("could not connect mysql");
		}
		$params=json_decode(file_get_contents("php://input"),true);
		if($params['ask']=='body'){
			$title =$params['word'];
			$page = $params['page'];
			$num = $page*50;
			$search_state = "select * from prolis where pro_id='{$title}' or title like '{$title}%' or resource='{$title}' or remarks like '{title}%' order by pro_id LIMIT $num,50";	
			$search_results = $conn->query($search_state);
			if(isset($search_results)){
				foreach($search_results as $search_result){
					echo $search_result['pro_id']."{,}";
					echo $search_result['title']."{,}";
					echo $search_result['sub_num'].'/'.$search_result['solve_num']."{,}";
					echo $search_result['level']."{,}";
					echo $search_result['resource']."{{}}";
				}
			}
		}
		else if($params['ask']=='page_num'){
			$title =$params['word'];
			$search_state = "select count(*) from prolis where pro_id='{$title}' or title like '{$title}%' or resource='{$title}' or remarks like '{title}%';";
			$search_results = $conn->query($search_state);
			$son_types = $search_results->fetch_array();
			$num = floor($son_types['count(*)']/50)+1;
			echo $num;
		}

?>