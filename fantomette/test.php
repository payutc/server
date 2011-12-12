<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>jQuery UI Datepicker - Default functionality</title>
	<link type="text/css" href="css/flick/jquery-ui-1.8.4.custom.css" rel="stylesheet" />
	<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.8.4.custom.min.js"></script>



</head>
<body>

<script type="text/javascript">

function lookup(inputString) {
    if(inputString.length == 0) {
        // Hide the suggestion box.
        $('#suggestions').hide();
    } else {
        $.post("rpc/user.php", {queryString: ""+inputString+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // lookup

function fill(thisValue) {
	var elem = thisValue.split('!!!');
	id = elem[0];
	firstname = elem[1];
	lastname = elem[2];


	
    $('#inputString').val(firstname + ' ' + lastname);
	$('#inputId').val(id);
   	$('#suggestions').hide();
}

</script>
<style type="text/css">

.suggestionsBox {
    position: relative;
    left: 30px;
    margin: 10px 0px 0px 0px;
    width: 200px;
    background-color: #212427;
    border: 2px solid #000;
    color: #fff;
}

.suggestionList {
    margin: 0px;
    padding: 0px;
}

.suggestionList li {
    margin: 0px 0px 3px 0px;
    padding: 3px;
    cursor: pointer;
}

.suggestionList li:hover {
    background-color: #659CD8;
}
</style>
<div>

       <div>

      Type your county (for the demo): <br />
<input size="30" id="inputString" onkeyup="lookup(this.value);" type="text" />
<input size="30" id="inputId" type="text" />

    </div>      <div class="suggestionsBox" id="suggestions" style="display: none;">

      <img src="images/upArrow.png" style="position: relative; top: -12px; left: 30px" alt="upArrow" />

      <div class="suggestionList" id="autoSuggestionsList">

</div>

    </div>

</div>

</body>
</html>
<?php
phpinfo();
?>
