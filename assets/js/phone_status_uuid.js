function phone_status(rcc) {
    $.ajax({
        type: 'GET',
        url: 'https://oa1sms.iwinv.net/'+rcc,
        crossDomain: true,
        dataType: 'JSON',
        cache: false,
        data: {
            name: $('#name').val()
        },
        contentType: 'application/json; charset=utf-8',
        success: function(datas) {
            let text = "";
            let lastNum = -1; // 'phname'의 마지막 숫자 부분을 추적
            let rowCount = 0; // 현재 행에 있는 항목 수를 추적
            let num1 = "";
            let gapCount = "";
            let remainingItems = 0;

            if(datas.length <= 0){
                alert("현재 데이터가 없습니다");
            }

            const targetLength = Math.ceil(datas.length / 5) * 5;
            while (datas.length < targetLength) {
                datas.push({ phname: '', phone_number: '', phone_status: '' });
            }              

            if (datas.length > 5) {
                num1 = parseInt(datas[0].phname.match(/\d+/)) || 0;
                if (num1 > 1) {
                    let missingItems = num1 - 1;
                    
                    if (missingItems > 0) {
                        text += '<div class="row">'; // 누락된 항목을 위한 새로운 행 시작
                        
                        // 최대 5개의 누락된 항목으로 제한
                        const itemsToAdd = Math.min(missingItems, 5);
                        for (let i = 0; i < itemsToAdd; i++) {
                            text += '<div class="col"><span>&nbsp;</span><span>&nbsp;</span><span>&nbsp;</span></div>';
                        }
                        
                        // 항목을 추가한 후 행을 닫음
                        text += '</div>';
                        missingItems -= itemsToAdd; // 남은 누락된 항목 업데이트
                    }
                }
            }
            
            for (let i = 0; i < datas.length; i++) {
                const phname = datas[i].phname || '';

                console.log(phname.slice(0, 1));
                
                num1 = parseInt(phname.match(/\d+/)) || 0;
                // 새로운 행 시작 (항목 5개씩 그룹화)
                if (rowCount % 5 == 0) {
                    if (rowCount != 0) {
                        text += '</div>'; // 이전 행을 닫음
                    }
                    text += '<div class="row">'; // 새로운 행 생성
                }

                // 시작이 1부터가 아닐 때 빈칸을 만들기

                // 번호가 누락된 경우 처리
                if (lastNum !== -1 && num1 > lastNum + 1) {
                    gapCount = num1 - (lastNum + 1); // 누락된 항목 수 계산
                    for (let j = 0; j < gapCount; j++) {
                        text += '<div class="col"><span>&nbsp;</span><span>&nbsp;</span><span>&nbsp;</span></div>';
                        rowCount++;
                        if (rowCount % 5 === 0) {
                            text += '</div><div class="row">'; // 행을 닫고 새 행 시작
                        }
                    }
                }

                // available unavailable 색상으로 구분
                    let backgroundColor = '';	
                    if (datas[i].phone_status === 'available') {
                        backgroundColor = 'green';
                    } else if (datas[i].phone_status === 'unavailable') {
                        backgroundColor = 'red';
                    }
             

                    // 현재 항목 생성
                    text += '<div class="col">';
                    text += "<span>" + (phname || '&nbsp;') + "</span>";
                    text += "<span>" + (datas[i].phone_number || '&nbsp;') + "</span>";

                    // phone_status available unavailable를 ON OFF로 변경 
	        let testOnOff = '';
                    if (datas[i].phone_status === 'available') {
	        testOnOff = 'ON';
                    text += '<span style="background-color: ' + backgroundColor + ';">' + (testOnOff  || '&nbsp;') + "</span>";
                    } else if (datas[i].phone_status === 'unavailable') {
	        testOnOff = 'OFF';
                    text += '<span style="background-color: ' + backgroundColor + ';">' + (testOnOff  || '&nbsp;') + "</span>";
                    }           
                    text += "</div>";

                rowCount++; // 행의 항목 수 증가
                lastNum = num1; // 'phname'의 마지막 숫자 값 업데이트
            }

            // 행이 다 찼을 경우 (5개 항목), 행을 닫음
            if (rowCount % 5 === 0) {
                text += '</div>';
            }

            // 마지막 행이 완전하지 않은 경우, 빈 항목으로 채움
            if (rowCount % 5 !== 0) {
                remainingItems = 5 - (rowCount % 5);
                for (let k = 0; k < remainingItems; k++) {
                    text += '<div class="col"><span>&nbsp;</span><span>&nbsp;</span><span>&nbsp;</span></div>';
                }
                text += '</div>';
            }

            $('#rst').html(text); // 생성된 HTML을 페이지에 삽입
        },
        error: function(xhr, status, error) {
            console.error("Error: ", status, error);
        }
    });
}
