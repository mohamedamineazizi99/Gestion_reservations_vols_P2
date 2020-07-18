function testPassword1(){
    var p1 = document.getElementById("Motpass1").value;
    var p2 = document.getElementById("ConfirmMotpass1").value;
    if( p1 != p2){
        document.getElementById("btnsubmit1").style.backgroundColor = "red";
        document.getElementById("btnsubmit1").disabled = true;
        document.getElementById("btnsubmit1").style.cursor = "not-allowed";
        document.getElementById("error_pasword1").innerText = "Error Mot De Pass";
    }else{
        document.getElementById("btnsubmit1").style.backgroundColor = "#f9ca24";
        document.getElementById("btnsubmit1").disabled = false;
        document.getElementById("btnsubmit1").style.cursor = "pointer";
        document.getElementById("error_pasword1").innerText = "";
    }
}
function testPassword2(){
    var p1 = document.getElementById("Motpass2").value;
    var p2 = document.getElementById("ConfirmMotpass2").value;
    if( p1 != p2){
        document.getElementById("btnsubmit2").style.backgroundColor = "red";
        document.getElementById("btnsubmit2").disabled = true;
        document.getElementById("btnsubmit2").style.cursor = "not-allowed";
        document.getElementById("error_pasword2").innerText = "Error Mot De Pass";
    }else{
        document.getElementById("btnsubmit2").style.backgroundColor = "yellow";
        document.getElementById("btnsubmit2").disabled = false;
        document.getElementById("btnsubmit2").style.cursor = "pointer";
        document.getElementById("error_pasword2").innerText = "";
    }
}