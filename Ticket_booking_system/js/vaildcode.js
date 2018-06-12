// JavaScript Document
/*
 * HUST DBMS Design - validcode.js
 *
 * Author: Pan Yue, zxc479773533@gmail.com
 */
var code;
function createCode() {    
	code = "";
	var codeLength = 6;
	var checkCode = document.getElementById("vaildcode_again");
	var selectChar = new Array(0,1,2,3,4,5,6,7,8,9,'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'); 
	
	for (var i = 0; i < codeLength; i++) {
		var charIndex = Math.floor(Math.random() * 36);
		code += selectChar[charIndex];
	}
	if (checkCode) {
		checkCode.className="code";
		checkCode.value = code;
		checkCode.blur();
	}
}