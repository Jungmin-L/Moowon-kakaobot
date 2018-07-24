<?php
function weather($num)
{
  header("Content-type: application/json; charset=UTF-8"); // json and utf-8

  require("Snoopy.class.php"); // snoopy클래스 

  $URL = "http://www.weather.go.kr/wid/queryDFSRSS.jsp?zone=4128164000"; // 기상청 rss zone
  $snoopy = new Snoopy;
  $snoopy->fetch($URL);

  preg_match('/<body>(.*?)<\/body>/is', $snoopy->results, $body);
  $d0_data = $body[0];
  $date = intval($num) * intval(7);
  $month = date("m");
  $day = date("d", strtotime("+$num days"));
  $re = "/<data seq=\"" . $date . "\">(.*?)<\/data>/is";
  preg_match($re, $d0_data, $d0_data);  $d0_data = $d0_data[0];
  preg_match('/<temp>(.*?)<\/temp>/is', $d0_data, $temp_now);  $temp_now = $temp_now[0];
  preg_match('/<tmx>(.*?)<\/tmx>/is', $d0_data, $temp_max);  $temp_max = $temp_max[0];
  preg_match('/<tmn>(.*?)<\/tmn>/is', $d0_data, $temp_min);  $temp_min = $temp_min[0];
  preg_match('/<sky>(.*?)<\/sky>/is', $d0_data, $sky_status); $sky_status = $sky_status[0];
  preg_match('/<pty>(.*?)<\/pty>/is', $d0_data, $rain_status);  $rain_status = $rain_status[0];
  preg_match('/<wfKor>(.*?)<\/wfKor>/is', $d0_data, $kor); $kor = $kor[0];
  preg_match('/<pop>(.*?)<\/pop>/is', $d0_data, $rain_posb); $rain_posb = $rain_posb[0];
  preg_match('/<reh>(.*?)<\/reh>/is', $d0_data, $hmdty); $hmdty = $hmdty[0];
  $sky_status = str_replace(1, '맑음', $sky_status);
  $sky_status = str_replace(2, '구름 조금', $sky_status);
  $sky_status = str_replace(3, '구름 많음', $sky_status);
  $sky_status = str_replace(4, '흐림', $sky_status);
  $rain_status = str_replace(0, '강수 없음', $rain_status);
  $rain_status = str_replace(1, '비', $rain_status);
  $rain_status = str_replace(2, '비가 대부분이며 일부 눈', $rain_status);
  $rain_status = str_replace(3, '눈이 대부분이며 일부 비', $rain_status);
  $rain_status = str_replace(4, '눈', $rain_status);
  $list_filter = array('<temp>', '</temp>', '<tmx>', '</tmx>', '<tmn>', '</tmn>', '<sky>', '</sky>', '<pty>', '</pty>', '<wfKor>', '</wfKor>', '<pop>', '</pop>', '<reh>', '</reh>');
  foreach ($list_filter as $filter) {
      $temp_now = str_replace($filter, '', $temp_now);
      $temp_max = str_replace($filter, '', $temp_max);
      $temp_min = str_replace($filter, '', $temp_min);
      $sky_status = str_replace($filter, '', $sky_status);
      $rain_status = str_replace($filter, '', $rain_status);
      $kor = str_replace($filter, '', $kor);
      $rain_posb = str_replace($filter, '', $rain_posb);
      $hmdty = str_replace($filter, '', $hmdty);
  }
  if ($temp_max == -999.0){
    $temp_max = "등록된 데이터가 없습니다. ";
  }
  if ($temp_min == -999.0){
    $temp_min = "등록된 데이터가 없습니다. ";
  }
  $data[0] = "" . $month . "월 " . $day . "일의 무원고등학교 날씨정보입니다. \\n-경기도 고양시 덕양구 행신1동 기준 \\n-기상청 제공\\n\\n";
  $data[1] = "현재 시각 온도 : " . $temp_now . "\\n";
  $data[2] = "최고 온도 : " . $temp_max . "\\n";
  $data[3] = "최저 온도 : " . $temp_min . "\\n";
  $data[4] = "하늘 상태 : " . $sky_status . "\\n";
  $data[5] = "강수 상태 : " . $rain_status . "\\n";
  $data[6] = "날씨 : " . $kor . "\\n";
  $data[7] = "강수 확률 : " . $rain_posb . "%\\n";
  $data[8] = "습도 : " . $hmdty . "%";
return $data;
}
?>
