function clicked() {
   alert("Clicked!");
}
function changeColor(color){
   color = document.getElementById("color").value;
   //alert(document.getElementById("div1").value);
   alert($("#div1").remove());
   document.getElementById("div1").value = color;
   //setAttribute("background-color", color);
}