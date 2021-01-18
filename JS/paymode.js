function getInputValue(){
            // Selecting the input element and get its value 
            if (document.getElementById('card').checked){
            var inputVal = document.getElementById("card").value;
        }
        else {
            var inputVal = document.getElementById("paypal").value;
        }
        document.getElementById("paymode").value=inputVal;
        }