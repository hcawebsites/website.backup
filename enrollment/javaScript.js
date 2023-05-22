var loadFile = function(img) {
	var image = document.getElementById('output');
	image.src = URL.createObjectURL(event.target.files[0]);
};

//Start of age//

function formatDate(date){
            var date = new Date(date),
                month = '' + (date.getMonth() + 1),
                day = '' + date.getDate(),
                year = date.getFullYear();

            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;

            return [year, month, day].join('-');

        }

        function getAge(dateString){
            var birth = new Date().getTime();
            if (typeof dateString === 'undefined' || dateString === null || (String(dateString) === 'NaN')){
                
                birth = new Date().getTime();
            }
            birth = new Date(dateString).getTime();
            var now = new Date().getTime();
           
            var n = (now - birth)/1000;
             if (n > 31562417){ 
              var year_n = Math.floor(n/31556926);
                if (typeof year_n === 'undefined' || year_n === null || (String(year_n) === 'NaN')){
                    return year_n = '';
                }else{
                    return year_n + '' + (year_n > 1 ? '' : '') + '';
                }
            }else{
                
            }
        }

        function AgeVal(pid){
            var birthd = formatDate(document.getElementById("birthdate").value);
            var count = document.getElementById("birthdate").value.length;
            if (count=='10'){
                var age = getAge(birthd);
                var str = age;
                var res = str.substring(0, 1);
                if (res =='-' || res =='0'){
                    document.getElementById("birthdate").value = "";
                    document.getElementById("age").value = "";
                    $('#birthdate').focus();
                    return false;
                }else{
                    document.getElementById("age").value = age;
                }
            }else{
                document.getElementById("age").value = "";
                return false;
            }
        }

      // End Of Age Script //

      //Strand Script//
      function populate(s1,s2) {
        	var s1 = document.getElementById(s1);

			if(s1.value == "Grade 11" || s1.value == "Grade 12"){
         		document.getElementById("strand").disabled = false;

			}
			else{
         		document.getElementById("strand").disabled = true;
			}
        }

      //End of Strand Script//

function edt(type){

var selectedValue = type.options[type.selectedIndex].value;
var SLA = document.getElementById("SLA");
var sy = document.getElementById("sy");
var genAve = document.getElementById("genAve");

SLA.disabled = selectedValue == "Kinder" ? true : false;
sy.disabled = selectedValue ==  "Kinder" ? true : false;
genAve.disabled = selectedValue ==  "Kinder" ? true : false;

if (!SLA.disabled && !sy.disabled & !genAve.disabled) {
      SLA.value = ""
      sy.value = ""
      genAve.value = ""

}else{
      SLA.value = "Not Applicable"
      sy.value = "Not Applicable"
      genAve.value = "Not Applicable"
}

}
        