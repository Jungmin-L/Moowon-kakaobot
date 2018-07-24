<?php
function getmeal($days)
{
  $date = date("Y.m.d", strtotime("+$days days"));
  header("Content-type: application/json; charset=UTF-8");
  require("Snoopy.class.php");

  // 고등학교 나이스에서 정보 가져옴 // https://www.meatwatch.go.kr/biz/bm/sel/schoolListPopup.do 학교 코드 찾는곳 
  $URL = "https://stu.goe.go.kr/sts_sci_md01_001.do?schulCode=J100000553&&schulCrseScCode=4&schMmealScCode=2&schYmd=" . $date; 

  // snoopy클래스 
  $snoopy = new Snoopy;
  // URL 가져옴
  $snoopy->fetch($URL);
  preg_match('/<tbody>(.*?)<\/tbody>/is', $snoopy->results, $tbody);
  $meal=$tbody[0];
  preg_match_all('/<tr>(.*?)<\/tr>/is', $meal, $meal);
  $meal=$meal[0][1];
  preg_match_all('/<td class="textC">(.*?)<\/td>/is', $meal, $meal);
  $day=0;
  if ( date('w')+$days > 6) {
    $day = (date('w')+$days)-7;
  } else {
    $day = date('w')+$days;
  }
  $meal=$meal[0][$day];
  $meal=preg_replace("/[0-9]/", "", $meal);
  $array_filter = array('.', ' ', '<tdclass="textC">', '</td>');
  foreach ($array_filter as $filter) {
      $meal=str_replace($filter, '', $meal);
  }
  $meal=str_replace('<br/>', '\\n', $meal);
  $meal=substr($meal, 0, -2);
  if ( strcmp($meal, '') == false ){
    $meal = "등록 되어 있는 급식이 없습니다!";
  }
  $return = array($date, $meal);
  return $return;
}
?>