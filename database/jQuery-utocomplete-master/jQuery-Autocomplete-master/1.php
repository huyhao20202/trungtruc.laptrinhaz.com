<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<body>
<div class="container">


    <h2>Local Lookup and Grouping</h2>
    <p>Type NHL or NBA team name:</p>
    <div>
        <input type="text" name="country" id="autocomplete"/>
    </div>
    <div id="selection"></div>

</div>

<script type="text/javascript" src="scripts/jquery-1.8.2.min.js"></script>
<!--<script type="text/javascript" src="scripts/jquery.mockjax.js"></script>-->
<script type="text/javascript" src="src/jquery.autocomplete.js"></script>
<!--<script type="text/javascript" src="scripts/countries.js"></script>-->
<script type="text/javascript" >
    $('#autocomplete').autocomplete({
        serviceUrl:'/do-an/deadline/database/jQuery-utocomplete-master/jQuery-Autocomplete-master/2.php',
        groupBy: 'category'
    });
</script>
</body>
</html>
