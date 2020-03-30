function cnt(form, msg, maxSize){
    if(form.value.length>maxSize)
        form.value = form.value.substring(0, maxSize);
    else
        msg.innerHTML = maxSize - form.value.length;
}
function nextNode(e){
    while(e && e.nodeType != 1){
        e = e.nextSibling;
    }
    return e;
}

function prevNode(e){
    while(e && e.nodeType != 1){
        e = e.previousSibling;
    }
    return e;
}

function swapRows(b){
    let tab = prevNode(b.previousSibling);
    let tBody = nextNode(tab.firstChild);
    let lastNode = prevNode(tBody.lastChild);
    tBody.removeChild(lastNode);
    let firstNode = nextNode(tBody.firstChild);
    tBody.insertBefore(lastNode, firstNode);
}

function alterRows(i, e){
    if(e){
        if(i % 2 == 1){
            e.setAttribute("style", "background-color: Aqua");
        }
        e = e.nextSibling;
        while(e && e.nodeType != 1){
            e = e.nextSibling;
        }
        alterRows(++i, e);
    }
}

function isWhiteSpaceOrEmpty(str){
    return /^[\s\t\r\n]*$/.test(str);
}

function isEmailValid(str){
    let email = /^[a-zA-Z_0-9\.]+@[a-zA-Z_0-9\.]+\.[a-zA-Z][a-zA-Z]+$/;
    if(!email.test(str))
        return true;
    else{
        return false;
    }
}

function checkStringAndFocus(obj, msg, validFunction){
    let str = obj.value;
    let errorFieldName = "e_"+obj.name.substr(2, obj.name.length);
    if(validFunction(str)){
        document.getElementById(errorFieldName).innerHTML = msg;
        obj.focus();
        return false;
    }else{
        document.getElementById(errorFieldName).innerHTML = "";
    }  
}

function showElement(e){
    document.getElementById(e).style.visibility= 'visible';
}

function hideElement(e){
    document.getElementById(e).style.visibility='hidden';
}

function validate(form){
    console.log("hejka");
    var validateFlag = true;
    const toValidate = ["f_imie", "f_nazwisko", "f_kod", "f_ulica", "f_miasto"];
    const messages = ["Podaj imię!", "Podaj nazwisko!", "Podaj kod!", "Podaj ulicę!", "Podaj miasto!"];
    if(!checkStringAndFocus(form.elements["f_email"], "Podaj email!", isEmailValid))
        validateFlag = false;
    for(i = toValidate.length - 1; i >= 0; i--){
        if(!checkStringAndFocus(form.elements[toValidate[i]], messages[i], isWhiteSpaceOrEmpty))
            validateFlag = false;
    }
    var x = document.getElementsByTagName('TABLE')[0].innerHTML;
    console.log(x);
    console.log(x['0']);
    return validateFlag;
}
function loadFunction(){
    var x = document.getElementsByTagName('TABLE')[0].children[0].children[0];
    alterRows(1, x);
}