

// $(document).ready(function() {
//     $.ajaxSetup({ cache: false });
//     $('#search_bt').click(function() {
//         fun_load();
//     });
// });

function fun_load() {				
    $.ajax({
        type : 'GET',
        url : 'https://oa1sms.iwinv.net/search/search_msg.php',
        crossDomain : true,
        dataType : 'JSON',
        cache: false,
        data : {
            msgval : $('#search_input').val(),
            name : $('#name').val()
        },
        contentType: 'application/json; charset=utf-8',
        success : function(datas) { // 통신이 성공적으로 이루어졌을 때
            console.log("Success: ", datas); // 디버깅 메시지 추가
            var text = "";
            let Hyphen = "-";
            let respTime = "";
            let reqPhoneNum = "";
            let respPhoneNum = "";
            $.each(datas, function(index, value) {
                respTime = datas[index].RESULT1.slice(5,19)
                if(datas[index].RESULT2.length == 11){
                    reqPhoneNum = datas[index].RESULT2.slice(0, 3) + Hyphen + datas[index].RESULT3.slice(3,7) + Hyphen + datas[index].RESULT3.slice(7,11);    
                }else if(datas[index].RESULT2.length == 10){
                    reqPhoneNum = datas[index].RESULT2.slice(0, 2) + Hyphen + datas[index].RESULT3.slice(2,6) + Hyphen + datas[index].RESULT3.slice(6,10);    
                }else{
                    reqPhoneNum = datas[index].RESULT2;
                }
                respPhoneNum = datas[index].RESULT3.slice(0, 3) + Hyphen + datas[index].RESULT3.slice(3,7) + Hyphen + datas[index].RESULT3.slice(7,11);
                //alert(datas[index].RESULT1);
                text += "<tr>";
                text += "<td>"+respTime+"</td>";
                text += "<td>"+reqPhoneNum+"</td>";
                text += "<td>"+respPhoneNum+"</td>";
                text += "<td>"+datas[index].RESULT4+"</td>";
                text += "<td>"+datas[index].RESULT5+"</td>";
                text += "</tr>";
            });
            $('#rst').html(text);
        },
        error : function(xhr, status, error) {
            console.error("Error: ", status, error); // 디버깅 메시지 추가
            // if(version >= 0 && version < 10) {
            // } else {
            // 	alert("정보를 불러오지 못했습니다.");
            // }
        }
    });
}

//자동 새로고침 1000=1초
window.setTimeout('window.location.reload()',10000);
//window.setTimeout('fun_load()',10000);
