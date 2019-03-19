
// Global Varialbes //
var regBody;
var logBody; 

// Equivalent to ready // 
document.addEventListener('DOMContentLoaded',function(){
    // Register Some Callback to Element // 
    if( document.readyState !== 'loading'){
        // Hide Register Page From Main Page //
        regBody = findElementById('regsubbody'); 
        logBody = findElementById('loginsubbody'); 

        var idxstr = localStorage.getItem('bodyidx'); 

        if( idxstr != '1' ){
            hideElement( regBody ); 
            showElement( logBody ); 
        }else{
            hideElement( logBody ); 
            showElement( regBody ); 
            localStorage.setItem('bodyidx','0'); 
        }
        
        registerAllCallback(); 
    } 
});
// Callback Functions // 
function registerAllCallback(){
    var regbtn = findElementById('regbtn'); 
    var logoutbtn = findElementById('logoutbtn'); 
    var loginbtn = findElementById('loginbtn'); 
    var idbox = findElementById('idboxform');
    var pwbox = findElementById('pwboxform'); 
    var regConfirmBtn = findElementById('regformbtn'); 

    regConfirmBtn.onclick = function(){
        var httpConn = getXMLHttpRequest(); 
        httpConn.onreadystatechange = function(){
            if( this.readyState == this.DONE && this.status == 200 ){
                alert( this.responseText ); 
                location.reload(); 
            }
        }

        httpConn.open('POST','login.php'); 
        httpConn.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        // Get Form Control Elements // 
        var newidbox = findElementById('regidform'); 
        var newpwbox = findElementById('regpwform'); 
        var newembox = findElementById('regmailform'); 
        var newbdbox = findElementById('birthdayform');
        var genderadio = document.getElementsByName('gender'); 

        // Get User Information From Form Controls // 
        var currentGender = 0; 
        for(var i = 0;i < genderadio.length;i++ ){
            if( genderadio[i].checked ){
                currentGender = i; 
            }
        }
        var newID = newidbox.value; 
        var newPW = newpwbox.value; 
        var newEM = newembox.value; 
        var newBD = newbdbox.value; 

        httpConn.send('mode=1&newID=' + newID + '&newPW=' + newPW + '&newEM=' + newEM + '&newBD=' + newBD + '&newGND=' + currentGender ); 
    }

    regbtn.onclick = function(){
        localStorage.setItem('bodyidx','1'); 
    }

    logoutbtn.onclick = function(){
        var httpConn = getXMLHttpRequest(); 
        httpConn.onreadystatechange = function(){
            if( this.readyState == this.DONE && this.status == 200 ){
                location.reload(); 
            }
        }
        httpConn.open('POST','logout.php'); 
        httpConn.send(); 
    }
    
    loginbtn.onclick = function(){
        if( idbox.value.length == 0 ){
            alert("Please Input your ID");
            return; 
        }

        if( pwbox.value.length == 0 ){
            alert("Please Input your Password");
            return; 
        }

        // Ajax connection between Client and PHP Server for Login // 
        var httpConn = getXMLHttpRequest(); 
        httpConn.onreadystatechange = function(){
            if( this.readyState == this.DONE && this.status == 200 ){
                alert( this.responseText );
            }
        }
        httpConn.open('POST','login.php'); 
        httpConn.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        httpConn.send('userID=' + idbox.value + '&userPW=' + pwbox.value + '&mode=0' ); 

        location.reload(); 
    }
}
// Utility Functions // 
function showElement( element ){
    if( element == null ) return; 

    element.style.display = 'block'; 
}
function hideElement( element ){
    if( element == null ) return; 

    element.style.display = 'none';
}
function findElementById( id ){
    return document.getElementById( id );
}
// For AJAX Connection // 
function getXMLHttpRequest(){
    var xmlHTTP; 
    if( window.XMLHttpRequest ){
        xmlHTTP = new XMLHttpRequest(); 
    }else{ // For IE ActiveX // 
        xmlHTTP = new ActiveXObject("Microsoft.XMLHTTP"); 
    }
    return xmlHTTP; 
}