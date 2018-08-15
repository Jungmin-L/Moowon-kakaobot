<?php
    include("file/weather.php");
    include("file/LOL.php");
    include("file/meal.php");
    include("file/calander.php");
    $data = json_decode(file_get_contents('php://input'),true);
    $content = $data["content"];

    // include 대화 start
    if ( strcmp($content, "대화 start") == false ) {
        echo json_encode(
            array(
                'message' => array(
                    'text' => '안녕하세요. 무원고등학교 급식봇 입니다.',
                ),
                'keyboard' => array(
                    'type' => 'buttons',
                    'buttons' => array(
                        '급식', '학사 일정', '시간표', '날씨', '게임 전적', '정보'
                    )
                )
            )
        );
    }

    // include 돌아가기
    else if(strpos($content, "돌아가기") !== false){
echo <<< EOD
    {
        "message": {
            "text": "취소 하셨습니다. 메인메뉴로 돌아갑니다."
        },
        "keyboard": { 
            "type": "buttons",
            "buttons": [ "대화 start" ]
        }
    }
EOD;
    }

    // include 급식
    else if($content=="급식"){
echo <<< EOD
    {
        "message": {
            "text": "언제 급식을 알려드릴까요?"
        },
        "keyboard": { 
            "type": "buttons",
            "buttons": [ "오늘 급식", "내일 급식",  "모레 급식", "돌아가기" ]
        }
    }
EOD;
    }

    // include 오늘 급식
    else if( strpos($content, "오늘 급식") !== false){
    $meal = getmeal(0);
echo <<< EOD
    {
        "message": {
            "text": "$meal[0]\\n무원고등학교 오늘 급식 입니다\\n\\n$meal[1]"
        },
        "keyboard": { 
            "type": "buttons",
            "buttons": ["오늘 급식", "내일 급식",  "모레 급식", "돌아가기" ]
        }
    }
EOD;
    }

    // include 내일 급식
    else if( strpos($content, "내일 급식") !== false){
    $meal = getmeal(1);
echo <<< EOD
    {
        "message": {
            "text": "$meal[0]\\n무원고등학교 내일 급식 입니다\\n\\n$meal[1]"
        },
        "keyboard": { 
            "type": "buttons",
            "buttons": [ "오늘 급식", "내일 급식",  "모레 급식", "돌아가기" ]
        }
    }
EOD;
    }

    // include 모레 급식
    else if( strpos($content, "모레 급식") !== false){
    $meal = getmeal(2);
echo <<< EOD
    {
        "message": {
            "text": "$meal[0]\\n무원고등학교 모레 급식 입니다\\n\\n$meal[1]"
        },
        "keyboard": { 
            "type": "buttons",
            "buttons": [ "오늘 급식", "내일 급식",  "모레 급식", "돌아가기" ]
        }
    }
EOD;
    }

    // include 학사일정
    else if($content=="학사 일정"){
echo <<< EOD
    {
        "message": {
            "text": "어느 달의 학사력을 알려드릴까요?"
        },
        "keyboard": {
            "type": "buttons",
            "buttons": [ "이번 달 학사일정", "다음 달 학사일정", "돌아가기" ]
        }
    }
EOD;
    }

    // include 이번 달 학사일정
    else if ( strpos($content, "이번 달 학사일정") !== false ) {
    $final = cal(0);
    $func = $final[0] . $final[1] . $final[2] . $final[3] . $final[4] . $final[5] . $final[6] . $final[7] . $final[8] . $final[9] . $final[10] . $final[11] . $final[12] . $final[13] . $final[14] . $final[15] . $final[16] . $final[17] . $final[18] . $final[19] . $final[20] . $final[21] . $final[23] . $final[24] . $final[25] . $final[26] . $final[27] . $final[28] . $final[29] . $final[30] . $final[31];
echo <<< EOD
        {
            "message": {
                "text": "$func"
            },
            "keyboard" :{
                "type" : "buttons",
                "buttons": [ "이번 달 학사일정", "다음 달 학사일정", "돌아가기" ]
            }
        }
EOD;
    }

    // include 다음 달 학사일정
    else if ( strpos($content, "다음 달 학사일정") !== false ) {
    $final = cal(1);
    $func = $final[0] . $final[1] . $final[2] . $final[3] . $final[4] . $final[5] . $final[6] . $final[7] . $final[8] . $final[9] . $final[10] . $final[11] . $final[12] . $final[13] . $final[14] . $final[15] . $final[16] . $final[17] . $final[18] . $final[19] . $final[20] . $final[21] . $final[23] . $final[24] . $final[25] . $final[26] . $final[27] . $final[28] . $final[29] . $final[30] . $final[31];
echo <<< EOD
        {
            "message": {
                "text": "$func"
            },
            "keyboard" :{
                "type" : "buttons",
                "buttons": ["이번 달 학사일정", "다음 달 학사일정", "돌아가기" ]
            }
        }
EOD;
    }

    // include 날씨
    else if($content=="날씨"){
echo <<< EOD
    {
        "message": {
            "text": "어느 날짜의 날씨를 알려 드릴까요?"
        },
        "keyboard": {
            "type": "buttons",
            "buttons": [ "오늘 날씨",  "내일 날씨", "모레 날씨", "돌아가기"]
        }
    }
EOD;
    }

    // include 오늘 날씨
    else if ( strpos($content, "오늘 날씨") !== false ) {
    $moowon = weather(0);
    $final = $moowon[0] . $moowon[1] . $moowon[2] . $moowon[3] . $moowon[4] . $moowon[5] . $moowon[6] . $moowon[7]. $moowon[8];
    $pic_url2 = "http://minyeon.com/MOOWON/touch/weather/";

    // <----- 하늘 날씨 상태 ---->
    $sky = $moowon[4];
    $sky = str_replace(":","",$sky);
    $sky = str_replace(" ","",$sky);
    // <----- 강수 상태 ---->
    $rain = $moowon[5];
    $rain = str_replace(":","",$rain);
    $rain = str_replace(" ","",$rain);
    // <----- 하늘 날씨 상태 통합 ---->
    $sky = str_replace("하늘상태구름많음","cloud",$sky);
    $sky = str_replace("하늘상태맑음","sun",$sky);
    $sky = str_replace("하늘상태구름조금","cloud",$sky);
    $sky = str_replace("하늘상태흐림","mist",$sky);
    // <----- 강수 상태 통합 ---->
    $rain = str_replace("강수상태강수없음","none",$rain);
    $rain = str_replace("강수상태비가대부분이며일부눈","rain",$rain);
    $rain = str_replace("강수상태비","rain",$rain);
    $rain = str_replace("강수상태눈이대부분이며일부비","snow",$rain);
    $rain = str_replace("강수상태눈","snow",$rain);
    // <------ 이미지 로딩 ----->
    if(strpos($rain,"none") !== false) {
    $pic_url2 = $pic_url2.$sky.".png";
  }
  else{
    $pic_url2 = $pic_url2.$rain.".png";
  }
echo <<< EOD
    {
        "message": {
            "text": "$final",
            "photo" : {
                "url" : "$pic_url2",
                "width" : 600,
                "height" : 600
            }
        },
        "keyboard" : {
            "type" : "buttons",
            "buttons": [ "오늘 날씨",  "내일 날씨", "모레 날씨", "돌아가기"]
        }
    }
EOD;
    }

    else if ( strpos($content, "내일 날씨") !== false ) {
    $moowon = weather(1);
    $final = $moowon[0] . $moowon[1] . $moowon[2] . $moowon[3] . $moowon[4] . $moowon[5] . $moowon[6] . $moowon[7]. $moowon[8];
    $pic_url2 = "http://minyeon.com/MOOWON/touch/weather/";

    // <----- 하늘 날씨 상태 ---->
    $sky = $moowon[4];
    $sky = str_replace(":","",$sky);
    $sky = str_replace(" ","",$sky);
    // <----- 강수 상태 ---->
    $rain = $moowon[5];
    $rain = str_replace(":","",$rain);
    $rain = str_replace(" ","",$rain);
    // <----- 하늘 날씨 상태 통합 ---->
    $sky = str_replace("하늘상태구름많음","cloud",$sky);
    $sky = str_replace("하늘상태맑음","sun",$sky);
    $sky = str_replace("하늘상태구름조금","cloud",$sky);
    $sky = str_replace("하늘상태흐림","mist",$sky);
    // <----- 강수 상태 통합 ---->
    $rain = str_replace("강수상태강수없음","none",$rain);
    $rain = str_replace("강수상태비가대부분이며일부눈","rain",$rain);
    $rain = str_replace("강수상태비","rain",$rain);
    $rain = str_replace("강수상태눈이대부분이며일부비","snow",$rain);
    $rain = str_replace("강수상태눈","snow",$rain);
    // <----- 예외 처리 ------->
    if(strpos($rain,"none") !== false) {
    $pic_url2 = $pic_url2.$sky.".png";
  }
  else{
    $pic_url2 = $pic_url2.$rain.".png";
  }
echo <<< EOD
    {
        "message": {
            "text": "$final",
            "photo" : {
                "url" : "$pic_url2",
                "width" : 600,
                "height" : 600
            }
        },
        "keyboard" : {
            "type" : "buttons",
            "buttons": [ "오늘 날씨",  "내일 날씨", "모레 날씨", "돌아가기"]
        }
    }
EOD;
    }

    // include 모레 날씨
    else if ( strpos($content, "모레 날씨") !== false ) {
    $moowon = weather(2);
    $final = $moowon[0] . $moowon[1] . $moowon[2] . $moowon[3] . $moowon[4] . $moowon[5] . $moowon[6] . $moowon[7]. $moowon[8];
    $pic_url2 = "http://minyeon.com/MOOWON/touch/weather/";

    // <----- 하늘 날씨 상태 ---->
    $sky = $moowon[4];
    $sky = str_replace(":","",$sky);
    $sky = str_replace(" ","",$sky);
    // <----- 강수 상태 ---->
    $rain = $moowon[5];
    $rain = str_replace(":","",$rain);
    $rain = str_replace(" ","",$rain);
    // <----- 하늘 날씨 상태 통합 ---->
    $sky = str_replace("하늘상태구름많음","cloud",$sky);
    $sky = str_replace("하늘상태맑음","sun",$sky);
    $sky = str_replace("하늘상태구름조금","cloud",$sky);
    $sky = str_replace("하늘상태흐림","mist",$sky);
    // <----- 강수 상태 통합 ---->
    $rain = str_replace("강수상태강수없음","none",$rain);
    $rain = str_replace("강수상태비가대부분이며일부눈","rain",$rain);
    $rain = str_replace("강수상태비","rain",$rain);
    $rain = str_replace("강수상태눈이대부분이며일부비","snow",$rain);
    $rain = str_replace("강수상태눈","snow",$rain);
    // <----- 예외 처리 ------->
    if(strpos($rain,"none") !== false) {
    $pic_url2 = $pic_url2.$sky.".png";
  }
  else{
    $pic_url2 = $pic_url2.$rain.".png";
  }
echo <<< EOD
    {
        "message": {
            "text": "$final",
            "photo" : {
                "url" : "$pic_url2",
                "width" : 600,
                "height" : 600
            }
        },
        "keyboard" : {
            "type" : "buttons",
            "buttons": ["오늘 날씨",  "내일 날씨", "모레 날씨", "돌아가기"]
        }
    }
EOD;
    }

    
    // include 시간표
    else if($content=="시간표"){
echo <<< EOD
    {
        "message": {
            "text": "api 준비중입니다. 기달려주세요."
        },
        "keyboard": { 
            "type": "buttons",
            "buttons": [ "대화 start" ]
        }
    }
EOD;
    }

    /*
    // include 1학년
    else if($content=="1학년"){
echo <<< EOD
    {
        "message": {
            "text": "반을 선택 해 주세요!"
        },
        "keyboard": {
            "type": "buttons",
            "buttons": [ "1학년 1반",  "1학년 2반",  "1학년 3반",  "1학년 4반",  "1학년 5반",  "1학년 6반", "1학년 7반", "1학년 8반", "1학년 9반", "1학년 10반", "1학년 11반", "1학년 12반", "돌아가기"]
        }
    }
EOD;
    }

    // include 1학년 1반
    else if(strpos($content, "1학년 1반") !== false){
echo <<< EOD
    {
        "message": {
            "text": "api 준비 중 입니다"
        },
        "keyboard": { 
            "type": "buttons",
            "buttons": [ "급식",  "학사 일정",  "시간표",  "날씨",  "게임 전적",  "개발자" ]
        }
    }
EOD;
    }

    // include 1학년 2반
    else if(strpos($content, "1학년 2반") !== false){
echo <<< EOD
    {
        "message": {
            "text": "api 준비 중 입니다"
        },
        "keyboard": { 
            "type": "buttons",
            "buttons": [ "급식",  "학사 일정",  "시간표",  "날씨",  "게임 전적",  "개발자" ]
        }
    }
EOD;
    }

    // include 1학년 3반
    else if(strpos($content, "1학년 3반") !== false){
echo <<< EOD
    {
        "message": {
            "text": "api 준비 중 입니다"
        },
        "keyboard": { 
            "type": "buttons",
            "buttons": [ "급식",  "학사 일정",  "시간표",  "날씨",  "게임 전적",  "개발자" ]
        }
    }
EOD;
    }   

    // include 1학년 4반
    else if(strpos($content, "1학년 4반") !== false){
echo <<< EOD
    {
        "message": {
            "text": "api 준비 중 입니다"
        },
        "keyboard": { 
            "type": "buttons",
            "buttons": [ "급식",  "학사 일정",  "시간표",  "날씨",  "게임 전적",  "개발자" ]
        }
    }
EOD;
    }

    // include 1학년 5반
    else if(strpos($content, "1학년 5반") !== false){
echo <<< EOD
{
    "message": {
        "text": "api 준비 중 입니다"
    },
    "keyboard": { 
        "type": "buttons",
        "buttons": [ "급식",  "학사 일정",  "시간표",  "날씨",  "게임 전적",  "개발자" ]
    }
}
EOD;
    }  

    // include 1학년 6반
    else if(strpos($content, "1학년 6반") !== false){
echo <<< EOD
    {
        "message": {
            "text": "api 준비 중 입니다"
        },
        "keyboard": { 
            "type": "buttons",
            "buttons": [ "급식",  "학사 일정",  "시간표",  "날씨",  "게임 전적",  "개발자" ]
        }
    }
EOD;
    }

    // include 1학년 7반
    else if(strpos($content, "1학년 7반") !== false){
echo <<< EOD
    {
        "message": {
            "text": "api 준비 중 입니다"
        },
        "keyboard": { 
            "type": "buttons",
            "buttons": [ "급식",  "학사 일정",  "시간표",  "날씨",  "게임 전적",  "개발자" ]
        }
    }
EOD;
    }

    // include 1학년 8반
    else if(strpos($content, "1학년 8반") !== false){
echo <<< EOD
    {
        "message": {
            "text": "api 준비 중 입니다"
        },
        "keyboard": { 
            "type": "buttons",
            "buttons": [ "급식",  "학사 일정",  "시간표",  "날씨",  "게임 전적",  "개발자" ]
        }
    }
EOD;
    }

    // include 1학년 9반
    else if(strpos($content, "1학년 9반") !== false){
echo <<< EOD
    {
        "message": {
            "text": "api 준비 중 입니다"
        },
        "keyboard": { 
            "type": "buttons",
            "buttons": [ "급식",  "학사 일정",  "시간표",  "날씨",  "게임 전적",  "개발자" ]
        }
    }
EOD;
    }

    // include 1학년 10반
    else if(strpos($content, "1학년 10반") !== false){
echo <<< EOD
    {
        "message": {
            "text": "api 준비 중 입니다"
        },
        "keyboard": { 
            "type": "buttons",
            "buttons": [ "급식",  "학사 일정",  "시간표",  "날씨",  "게임 전적",  "개발자" ]
        }
    }
EOD;
    }

    // include 1학년 11반
    else if(strpos($content, "1학년 11반") !== false){
echo <<< EOD
    {
        "message": {
            "text": "api 준비 중 입니다"
        },
        "keyboard": { 
            "type": "buttons",
            "buttons": [ "급식",  "학사 일정",  "시간표",  "날씨",  "게임 전적",  "개발자" ]
        }
    }
EOD;
    }

    // include 1학년 12반
    else if(strpos($content, "1학년 12반") !== false){
echo <<< EOD
    {
        "message": {
            "text": "api 준비 중 입니다"
        },
        "keyboard": { 
            "type": "buttons",
            "buttons": [ "급식",  "학사 일정",  "시간표",  "날씨",  "게임 전적",  "개발자" ]
        }
    }
EOD;
    }

    // include 2학년
    else if($content=="2학년"){
echo <<< EOD
    {
        "message": {
            "text": "반을 선택 해 주세요!"
        },
        "keyboard": {
            "type": "buttons",
            "buttons": [ "2학년 1반",  "2학년 2반",  "2학년 3반",  "2학년 4반",  "2학년 5반",  "2학년 6반", "2학년 7반", "2학년 8반", "2학년 9반", "2학년 20반", "2학년 11반", "2학년 12반", "돌아가기"]
        }
    }
EOD;
    }

    // include 2학년 1반
    else if(strpos($content, "2학년 1반") !== false){
echo <<< EOD
    {
        "message": {
            "text": "api 준비 중 입니다"
        },
        "keyboard": { 
            "type": "buttons",
            "buttons": [ "급식",  "학사 일정",  "시간표",  "날씨",  "게임 전적",  "개발자" ]
        }
    }
EOD;
    }
    
    // include 2학년 2반
    else if(strpos($content, "2학년 2반") !== false){
echo <<< EOD
    {
        "message": {
            "text": "api 준비 중 입니다"
        },
        "keyboard": { 
            "type": "buttons",
            "buttons": [ "급식",  "학사 일정",  "시간표",  "날씨",  "게임 전적",  "개발자" ]
        }
    }
EOD;
    }
    
    // include 2학년 3반
    else if(strpos($content, "2학년 3반") !== false){
echo <<< EOD
    {
        "message": {
            "text": "api 준비 중 입니다"
        },
        "keyboard": { 
            "type": "buttons",
            "buttons": [ "급식",  "학사 일정",  "시간표",  "날씨",  "게임 전적",  "개발자" ]
        }
    }
EOD;
    }   
    
    // include 2학년 4반
    else if(strpos($content, "2학년 4반") !== false){
echo <<< EOD
    {
        "message": {
            "text": "api 준비 중 입니다"
        },
        "keyboard": { 
            "type": "buttons",
            "buttons": [ "급식",  "학사 일정",  "시간표",  "날씨",  "게임 전적",  "개발자" ]
        }
    }
EOD;
    }
    
    // include 2학년 5반
    else if(strpos($content, "2학년 5반") !== false){
echo <<< EOD
    {
        "message": {
            "text": "api 준비 중 입니다"
        },
        "keyboard": { 
            "type": "buttons",
            "buttons": [ "급식",  "학사 일정",  "시간표",  "날씨",  "게임 전적",  "개발자" ]
        }
    }
EOD;
    }  
    
    // include 2학년 6반
    else if(strpos($content, "2학년 6반") !== false){
echo <<< EOD
    {
        "message": {
            "text": "api 준비 중 입니다"
       },
        "keyboard": { 
            "type": "buttons",
            "buttons": [ "급식",  "학사 일정",  "시간표",  "날씨",  "게임 전적",  "개발자" ]
        }
    }
EOD;
    }
    
    // include 2학년 7반
    else if(strpos($content, "2학년 7반") !== false){
echo <<< EOD
    {
        "message": {
            "text": "api 준비 중 입니다"
        },
        "keyboard": { 
            "type": "buttons",
            "buttons": [ "급식",  "학사 일정",  "시간표",  "날씨",  "게임 전적",  "개발자" ]
        }
    }
EOD;
    }
    
    // include 2학년 8반
    else if(strpos($content, "2학년 8반") !== false){
echo <<< EOD
    {
        "message": {
            "text": "api 준비 중 입니다"
        },
        "keyboard": { 
            "type": "buttons",
            "buttons": [ "급식",  "학사 일정",  "시간표",  "날씨",  "게임 전적",  "개발자" ]
        }
    }
EOD;
    }
    
    // include 2학년 9반
    else if(strpos($content, "2학년 9반") !== false){
echo <<< EOD
    {
        "message": {
            "text": "api 준비 중 입니다"
        },
        "keyboard": { 
            "type": "buttons",
            "buttons": [ "급식",  "학사 일정",  "시간표",  "날씨",  "게임 전적",  "개발자" ]
        }
    }
EOD;
    }
    
    // include 2학년 10반
    else if(strpos($content, "2학년 10반") !== false){
echo <<< EOD
    {
        "message": {
            "text": "api 준비 중 입니다"
        },
        "keyboard": { 
            "type": "buttons",
            "buttons": [ "급식",  "학사 일정",  "시간표",  "날씨",  "게임 전적",  "개발자" ]
        }
    }
EOD;
    }
    
    // include 2학년 11반
    else if(strpos($content, "2학년 11반") !== false){
echo <<< EOD
    {
        "message": {
            "text": "api 준비 중 입니다"
        },
        "keyboard": { 
            "type": "buttons",
            "buttons": [ "급식",  "학사 일정",  "시간표",  "날씨",  "게임 전적",  "개발자" ]
        }
    }
EOD;
    }
    
    // include 2학년 12반
    else if(strpos($content, "2학년 12반") !== false){
echo <<< EOD
    {
        "message": {
            "text": "api 준비 중 입니다"
        },
        "keyboard": { 
            "type": "buttons",
            "buttons": [ "급식",  "학사 일정",  "시간표",  "날씨",  "게임 전적",  "개발자" ]
        }
    }
EOD;
    }
    
    // include 3학년
    else if($content=="3학년"){
echo <<< EOD
    {
        "message": {
            "text": "반을 선택 해 주세요!"
        },
        "keyboard": {
            "type": "buttons",
            "buttons": [ "3학년 1반",  "3학년 2반",  "3학년 3반",  "3학년 4반",  "3학년 5반",  "3학년 6반", "3학년 7반", "3학년 8반", "3학년 9반", "3학년 10반", "3학년 11반", "돌아가기"]
        }
    }
EOD;
    }

    // include 3학년 1반
    else if(strpos($content, "3학년 1반") !== false){
echo <<< EOD
    {
        "message": {
            "text": "api 준비 중 입니다"
        },
        "keyboard": { 
            "type": "buttons",
            "buttons": [ "급식",  "학사 일정",  "시간표",  "날씨",  "게임 전적",  "개발자" ]
        }
    }
EOD;
    }
        
    // include 1학년 3반
    else if(strpos($content, "3학년 2반") !== false){
echo <<< EOD
    {
        "message": {
            "text": "api 준비 중 입니다"
        },
        "keyboard": { 
            "type": "buttons",
            "buttons": [ "급식",  "학사 일정",  "시간표",  "날씨",  "게임 전적",  "개발자" ]
        }
    }
EOD;
    }
        
    // include 3학년 3반
    else if(strpos($content, "3학년 3반") !== false){
echo <<< EOD
    {
        "message": {
            "text": "api 준비 중 입니다"
        },
        "keyboard": { 
            "type": "buttons",
            "buttons": [ "급식",  "학사 일정",  "시간표",  "날씨",  "게임 전적",  "개발자" ]
        }
    }
EOD;
    }   
        
    // include 3학년 4반
    else if(strpos($content, "3학년 4반") !== false){
echo <<< EOD
    {
        "message": {
            "text": "api 준비 중 입니다"
        },
        "keyboard": { 
            "type": "buttons",
            "buttons": [ "급식",  "학사 일정",  "시간표",  "날씨",  "게임 전적",  "개발자" ]
        }
    }
EOD;
    }
        
    // include 3학년 5반
    else if(strpos($content, "3학년 5반") !== false){
echo <<< EOD
    {
        "message": {
            "text": "api 준비 중 입니다"
        },
        "keyboard": { 
            "type": "buttons",
            "buttons": [ "급식",  "학사 일정",  "시간표",  "날씨",  "게임 전적",  "개발자" ]
        }
    }
EOD;
    }  
        
    // include 3학년 6반
    else if(strpos($content, "3학년 6반") !== false){
echo <<< EOD
    {
        "message": {
            "text": "api 준비 중 입니다"
       },
        "keyboard": { 
            "type": "buttons",
            "buttons": [ "급식",  "학사 일정",  "시간표",  "날씨",  "게임 전적",  "개발자" ]
        }
    }
EOD;
    }
        
    // include 3학년 7반
    else if(strpos($content, "3학년 7반") !== false){
echo <<< EOD
    {
        "message": {
            "text": "api 준비 중 입니다"
        },
        "keyboard": { 
            "type": "buttons",
            "buttons": [ "급식",  "학사 일정",  "시간표",  "날씨",  "게임 전적",  "개발자" ]
        }
    }
EOD;
    }
        
    // include 3학년 8반
    else if(strpos($content, "3학년 8반") !== false){
echo <<< EOD
    {
        "message": {
            "text": "api 준비 중 입니다"
        },
        "keyboard": { 
            "type": "buttons",
            "buttons": [ "급식",  "학사 일정",  "시간표",  "날씨",  "게임 전적",  "개발자" ]
        }
    }
EOD;
    }
        
    // include 3학년 9반
    else if(strpos($content, "3학년 9반") !== false){
echo <<< EOD
    {
        "message": {
            "text": "api 준비 중 입니다"
        },
        "keyboard": { 
            "type": "buttons",
            "buttons": [ "급식",  "학사 일정",  "시간표",  "날씨",  "게임 전적",  "개발자" ]
        }
    }
EOD;
    }
        
    // include 3학년 10반
    else if(strpos($content, "3학년 10반") !== false){
echo <<< EOD
    {
        "message": {
            "text": "api 준비 중 입니다"
        },
        "keyboard": { 
            "type": "buttons",
            "buttons": [ "급식",  "학사 일정",  "시간표",  "날씨",  "게임 전적",  "개발자" ]
        }
    }
EOD;
    }
        
    // include 3학년 11반
    else if(strpos($content, "3학년 11반") !== false){
echo <<< EOD
    {
        "message": {
            "text": "api 준비 중 입니다"
        },
        "keyboard": { 
            "type": "buttons",
            "buttons": [ "급식",  "학사 일정",  "시간표",  "날씨",  "게임 전적",  "개발자" ]
        }
    }
EOD;
    }
    */

    // include 게임전적
    else if(strpos($content, "게임 전적") !== false){
echo <<< EOD
    {
        "message": {
            "text": "전적을 검색할 게임을 선택해 주세요!"
        },
        "keyboard": { 
            "type": "buttons",
            "buttons": [ "League of Legends", "PUBG", "돌아가기" ]
        }
    }
EOD;
    }
    
    // include LOL
    else if(strpos($content, "League of Legends") !== false){
echo <<< EOD
    {
        "message": {
            "text": "전적이 필요한 소환사명을 검색해 주세요!\\nEX) Hide on bush"
        }
    }
EOD;
    }
    else if ( strpos($content, " ") !== false ) {
        $username = str_replace(" "," ",$content); // str_replace("찾을문자열","변경할문자열","문자열 원본")
        $return = lol_record($username);
        $logfile = fopen("log.txt", 'a') or die();
        fwrite($logfile, date("Y.m.d H:i:s",time()) . " '" . $username . "' 소환사를 검색했습니다(롤).\n");
        // 검색 시간과 기록이 로그 파일에 기록됨
        fclose($logfile);
        $record = $return[0];
        $last = $return[1];
        $tier = $return[2];
        if ($last == ''){ // 유효한 소환사명이 아님 => message_button 표시 X
echo <<< EOD
    {
        "message" :
        {
            "text" : "$record"
        },
        "keyboard" :
        {
            "type" : "buttons",
            "buttons" : [ "League of Legends", "PUBG", "돌아가기" ]
        }
    }
EOD;
        }
        else{ // 유효한 소환사명 => message_button 표시 O
          $pic_url = "http://minyeon.com/MOOWON/touch/opggtier/";
          $tier = strtolower($tier);
          $tier = str_replace(' ', '_', $tier);
          $pic_url = $pic_url . $tier . ".png";
        }
echo <<< EOD
  {
      "message" :
      {
          "text" : "$record",
          "photo" : {
              "url" : "$pic_url",
              "width" : 600,
              "height" : 600
          },
          "message_button": {
              "label": "OP.GG에서 정보 확인 ->",
              "url": "$last"
          }
      },
      "keyboard" :
      {
        "type" : "buttons",
        "buttons" : [ "League of Legends", "PUBG", "돌아가기" ]
      }
  }
EOD;
    }

    // include PUBG
    else if(strpos($content, "PUBG") !== false){
echo <<< EOD
    {
        "message": {
            "text": "api 준비 중 입니다"
        },
        "keyboard": { 
            "type": "buttons",
            "buttons": ["League of Legends", "PUBG", "돌아가기" ]
        }
    }
EOD;
    }

    // include 정보
    else if($content=="정보"){
echo <<< EOD
    {
        "message": {
            "text": "이 챗봇은 급식정보 , 날씨정보, 게임 전적, 학사일정 등을 알려줍니다.\\n개선사항이나 기능 추가를 원한다면 E-Mail : binse@inpase.io나 페메로 보내주세요!"
        },
        "keyboard": {
            "type": "buttons",
            "buttons": [ "대화 start" ]
        }
    }
EOD;
    }

    // 그 외
    else{
echo <<< EOD
    {
        "message": {
            "text": "개발 중인 탭 입니다."
        }
    },
    "keyboard": { 
        "type": "buttons",
        "buttons": [ "대화 start" ]
    }    
EOD;
}
?>