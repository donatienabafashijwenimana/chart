$(document).ready(function(){
    $("#searchuser").on("input",()=>{
        let searchvalue = $("#searchuser").val()
        if (searchvalue !=""){
        $.post("searchuser.php",
            {
                user:searchvalue,
            },
            function(data,status){
                 $(".peoplelist").html(data);
            })
        }else window.location.reload()
    })
    $("#send").click(()=>{
        let message = $("#messagetext").val();
        let toid = $("#toid").val();
        let fromid = $("#fromid").val();
        if (message !=""){
        $.post("message.php",
            {
                message:message,
                fromid:fromid,
                toid:toid
            },
            function(data,status){
                window.location.reload();
            })
        }else window.location.reload()
    })
    setInterval(() => {
        $.post("getmessage.php",
            {
                toid: $("#toid").val()
            },function(data,status){
                $(".messagearea").html(data)
                
            })
    }, 10);
    setInterval(() => {
        $.post("updatelastseen.php",
            {
                id: $("#fromid").val()
            },function(data,status){
            })
    }, 10);
    setInterval(() => {
        $.post("getalluser.php",
            {
                id: $("#fromid").val()
            },function(data,status){
                $(".peoplelist").html(data);
            })
        },1000)
})