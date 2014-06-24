function delayedAjaxpage(url, containerid, delay)
{
    var element = document.getElementById(containerid);

    element.innerHTML =// height +"";
        "<div style='float:left'><div class='box' style='width:200px'><img src='loading.gif'></div></div>";
    setTimeout(function(){ajaxpage(url,containerid);},delay);
}

function ajax(url,successFunction,postData)
{
    var page_request = false
    if (window.XMLHttpRequest) // if Mozilla, Safari etc
        page_request = new XMLHttpRequest()
    else if (window.ActiveXObject){ // if IE
        try {
            page_request = new ActiveXObject("Msxml2.XMLHTTP")
        }
        catch (e){
            try{
                page_request = new ActiveXObject("Microsoft.XMLHTTP")
            }
            catch (e){}
        }
    }
    else return false;
    if (successFunction!=null)
        page_request.onreadystatechange=successFunction;
    if (postData==null)
    {
        page_request.open('GET', url, true)
        page_request.send(null)
    }
    else
    {
        page_request.open('POST', url, true)
        page_request.send(postData)
    }
}

function ajaxpage(url, containerid, postData){
    var page_request = false
    if (window.XMLHttpRequest) // if Mozilla, Safari etc
        page_request = new XMLHttpRequest()
    else if (window.ActiveXObject){ // if IE
        try {
            page_request = new ActiveXObject("Msxml2.XMLHTTP")
        }
        catch (e){
            try{
                page_request = new ActiveXObject("Microsoft.XMLHTTP")
            }
            catch (e){}
        }
    }
    else
        return false
    page_request.onreadystatechange=function(){
        loadpage(page_request, containerid)
    }
    if (postData==null)
    {
        page_request.open('GET', url, true)
        page_request.send(null)
    }
    else
    {
        page_request.open('POST', url, true)
        page_request.send(postData)
    }
}

function loadpage(page_request, containerid){
    if (page_request.readyState == 4 && (page_request.status==200 || window.location.href.indexOf("http")==-1))
        document.getElementById(containerid).innerHTML=page_request.responseText
}