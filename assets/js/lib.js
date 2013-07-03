$(document).ready(function() {
$('#file0').change(function() {
 
  if ($(this).val()) {
 
    var pattern = "jpg|jpeg";
 
    if ($(this).val().match(new RegExp(".(" + pattern + ")$")) == null) {
      
      alert('File type: jpg , jpeg Only.'); 
      $(this).val("");
    return; 

    } else { 
    	/* var Str=$(this).val();
      	 $('#re0').load('check.php?Id='+Str,{
	 	 ajax:true, test:$(this).val() }); */
}}

});

$('#file1').change(function() {
 
  if ($(this).val()) {
 
    var pattern = "jpg|jpeg";
 
    if ($(this).val().match(new RegExp(".(" + pattern + ")$")) == null) {
      
      alert('File type: jpg , jpeg Only.'); 
      $(this).val("");
    return; 

    } else { 
}}});

$('#file2').change(function() {
 
  if ($(this).val()) {
 
    var pattern = "jpg|jpeg";
 
    if ($(this).val().match(new RegExp(".(" + pattern + ")$")) == null) {
      
      alert('File type: jpg , jpeg Only.'); 
      $(this).val("");
    return; 

    } else { 
}}});

$('#file3').change(function() {
 
  if ($(this).val()) {
 
    var pattern = "jpg|jpeg";
 
    if ($(this).val().match(new RegExp(".(" + pattern + ")$")) == null) {
      
      alert('File type: jpg , jpeg Only.'); 
      $(this).val("");
    return; 

    } else { 
}}});

$('#file4').change(function() {
 
  if ($(this).val()) {
 
    var pattern = "jpg|jpeg";
 
    if ($(this).val().match(new RegExp(".(" + pattern + ")$")) == null) {
      
      alert('File type: jpg , jpeg Only.'); 
      $(this).val("");
    return; 

    } else { 
}}});






 });  