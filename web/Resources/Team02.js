function clicked() {
   alert("Clicked!");
}

function changeColorJS() {
   color = document.getElementById("color").value;
   document.getElementById("div1").style.backgroundColor = color;

}

function changeColorJQ() {
   $("#div1").css("background-color", $("#color").val());
}

function toggle() {
   $("#div3").fadeToggle("slow", callback);
}
function callback() {
   if ($("#div3").is(":visible")) {$("#toggle").text("Hide div3");}
   else {$("#toggle").text("Show div3");}
}