/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function openNav() {
    document.getElementById("content").style.width = "70%";

    document.getElementById("content").style.marginLeft = "25%";
    document.getElementById("bottombar").style.marginLeft = "0%";
        document.getElementById("menu").style.width = "25%";

}

function closeNav() {
    document.getElementById("menu").style.width = "0";
    document.getElementById("content").style.marginLeft= "0";
    	document.getElementById("content").style.width = "95%";

    document.getElementById("bottombar").style.marginLeft= "0";
    document.getElementById("bottombar").style.width= "100%";

}

function changeLogin(login, link){
    var page = document.getElementById("login");
    page.innerHTML = login;
    page.setAttribute("href",link);
}