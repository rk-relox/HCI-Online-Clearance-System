<html>

<body>
<tr>
<td class="col-md-4"><label class="control-label">Pooja Type</label></td>
<td class="col-md-8" align="center">
<label class='radio-inline'><input type='radio' name='poojaType' value='daily' checked>Daily</label>
<label class='radio-inline'><input type='radio' name='poojaType' value='misc'>Misc</label>
</td>
</tr>
<tr>
<td class="col-md-4"><label class="control-label" for="deity">Deity Name</label></td>
<td class="col-md-8"><select class="form-control" name="deityName"> 
</body>

</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$checkedBoxes = 0;

// Depending on the action, you set in the form, you have to either choose $_GET or $_POST
if(isset($_GET["checkbox1"])){
  $checkedBoxes++;
}
if(isset($_GET["checkbox2"])){
  $checkedBoxes++;
}
if(isset($_GET["checkbox3"])){
  $checkedBoxes++;
}
echo $checkedBoxes;
}
?>