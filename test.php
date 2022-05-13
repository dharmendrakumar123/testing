<?php
    if(isset($_POST['imagebase64'])){
        $data = $_POST['imagebase64'];

        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);

        file_put_contents('image64.png', $data);
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<title>Test</title>
<!--<link href="croppie.css" rel="stylesheet" type="text/css">-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="croppie.min.js"></script>
<script type="text/javascript">
$( document ).ready(function() {
    var $uploadCrop;


	
    function readFile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();          
            reader.onload = function (e) {
                $uploadCrop.croppie('bind', {
                    url: e.target.result
                });
                $('.upload-demo').addClass('ready');
            }           
            reader.readAsDataURL(input.files[0]);
        }
		$(".upload-result").trigger("click");
    }

    $uploadCrop = $('#upload-demo').croppie({
        viewport: {
            width: 200,
            height: 200,
            type: 'circle'
        },
        boundary: {
            width: 300,
            height: 300
        }
    });

    $('#upload').on('change', function () { readFile(this); });
	
	
    $('.upload-result').on('click', function (ev) {
		
        $uploadCrop.croppie('result', {
            type: 'base64'
        }).then(function (resp) {
            $('#imagebase64').val(resp);
			console.log('Hello after conole folder atuo load base');
            //$('#form').submit();
        });
    });
});
</script>
</head>
<body>
<form action="#" id="form" method="post">
<input type="file" id="upload" value="Choose a file">
<div id="upload-demo"></div>
<input type="hidden" id="imagebase64" name="imagebase64">
<a href="#" class="upload-result">Send</a>
</form>
</body>
</html>