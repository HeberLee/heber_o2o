<?php
function status($status){
	if($status == 1){
		$str = "<span class='label label-success radius'>正常</span>";
	}
	else if($status == 0){
		$str = "<span class='label label-success radius'>待审</span>";
	}
	else if($status == -1){
		$str = "<span class='label label-success radius'>删除</span>";
	}
	return $str;
}

?>