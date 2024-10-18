function search(){
    let selectUser = document.getElementById("user");
    let selectUserIndex = document.getElementById("user").options.selectedIndex;
    let selectType = document.getElementById("type");
    let selectTypeIndex = document.getElementById("type").options.selectedIndex;
    location.href='/admin_hi/select_query_proc.php?val='+selectType.options[selectTypeIndex].value+'&idx='+selectUser.options[selectUserIndex].value;
}
