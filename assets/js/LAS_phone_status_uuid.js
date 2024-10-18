// if (phname.slice(0,1) == rcc) {}
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
                alert("현재 데이터가 없습니다")
            }

            // 총 항목 수가 5의 배수가 되도록 빈 항목을 추가
            const targetLength = Math.ceil(datas.length / 5) * 5;
            while (datas.length < targetLength) {
                datas.push({ phname: '', phone_number: '', number_status: '', phone_status: '' });
            }              

            if (datas.length > 5) {
                num1 = parseInt(datas[0].phname.match(/\d+/)) || 0;
                if (num1 > 1) {
                    let missingItems = num1 - 1;
                    
                    if (missingItems > 0) {
                        text += '<div class="row">'; // Start a new row for missing items
                        
                        // Limit to 5 missing items to fit the row
                        const itemsToAdd = Math.min(missingItems, 5);
                        for (let i = 0; i < itemsToAdd; i++) {
                            text += '<div class="col"><span>&nbsp;</span><span>&nbsp;</span><span>&nbsp;</span><span>&nbsp;</span></div>';
                        }
                        
                        // Close the row after adding the items
                        text += '</div>';
                        missingItems -= itemsToAdd; // Update remaining missing items
                    }
                }
            }
            
           
           
            for (let i = 0; i < datas.length; i++) {
                const phname = datas[i].phname || '';

                console.log(phname.slice(0,1));
                
                    num1 = parseInt(phname.match(/\d+/)) || 0;
                    // 새로운 행 시작 (항목 5개씩 그룹화)
                    if (rowCount % 5 == 0) {
                        if (rowCount != 0) {
                            text += '</div>'; // 이전 행을 닫음
                        }
                        text += '<div class="row">'; // 새로운 행 생성
                    }

                     // 시작이 1부터가 아닐때 빈칸을 만들기


                    // 번호가 누락된 경우 처리
                    if (lastNum !== -1 && num1 > lastNum + 1) {
                        gapCount = num1 - (lastNum + 1); // 누락된 항목 수 계산
                        for (let j = 0; j < gapCount; j++) {
                            text += '<div class="col"><span>&nbsp;</span><span>&nbsp;</span><span>&nbsp;</span><span>&nbsp;</span></div>';
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

                    text += "<span>" + (datas[i].number_status || '&nbsp;') + "</span>";
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
                    text += '<div class="col"><span>&nbsp;</span><span>&nbsp;</span><span>&nbsp;</span><span>&nbsp;</span></div>';
                }
                text += '</div>';
            }
            let xlsxbtn = '';
            xlsxbtn += '<button onclick="phone_status(\'phone_status_table_upload/LAS_phone_status_uuid/LAS_phone_status_uuid_A_proc.php\');">A</button>';
            xlsxbtn += '<button onclick="phone_status(\'phone_status_table_upload/LAS_phone_status_uuid/LAS_phone_status_uuid_B_proc.php\');">B</button>';
            xlsxbtn += '<button onclick="phone_status(\'phone_status_table_upload/LAS_phone_status_uuid/LAS_phone_status_uuid_P_proc.php\');">P</button>';   
            xlsxbtn += '<button id="download">엑셀로 저장</button>';
            document.getElementById('downloadBox').innerHTML = xlsxbtn;
            // $('#downloadBox').html(xlsxbtn); // 생성된 HTML을 페이지에 삽입
            $('#rst').html(text); // 생성된 HTML을 페이지에 삽입

          
            let xlsxData = []; //배열초기화
            document.getElementById('download').addEventListener('click', function() {
                // 엑셀에 저장할 데이터 생성
                for (let i = 0; i < datas.length; i++) {
                    
                    if(datas[i].number_status != null && datas[i].number_status !== ""){

                        xlsxData.push([datas[i].phname, datas[i].phone_number, datas[i].number_status]); // 배열에 추가

                        console.log(datas[i].number_status);
                    }
                    };      
                    // 워크북 생성
                    let wb = XLSX.utils.book_new();
                    let ws = XLSX.utils.aoa_to_sheet(xlsxData);
                    XLSX.utils.book_append_sheet(wb, ws, '시트1');
    
                    // 엑셀 파일 다운로드
                    XLSX.writeFile(wb, '데이터.xlsx');     
                });


        },
        error: function(xhr, status, error) {
            console.error("Error: ", status, error);
        }
    });

setTimeout('location.reload()',600000); 


}

