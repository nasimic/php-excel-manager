<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <title>Document</title>
</head>
<body>
    <div class="container">
        <h3 class="title">PHP - Excel Manager</h3>
        <form action="keyword_convert.php" method="post" enctype="multipart/form-data">
            <div class="initializer">
                <div class="keywords">
                    <h3 style="text-align:center">Keywords</h3>
                    <div class="form-group">
                        <div class="input-holder">
                            <input type="text" name="categories[]" placeholder="Category" required>
                            <input type="text" name="keywords[]"  placeholder="Keywords (provision,parts,store...)" required>
                            <button class="delete-button">&times;</button>
                        </div>
                    </div>
                    <div class="add-holder">
                        <div class="add-button" id="add-category">+ Add</div>
                    </div>
                </div>
                <div class="fields">
                    <h3 style="text-align:center">Fields</h3>
                    <div class="form-group">
                        <div class="input-holder">
                            <input type="text" name="fields[]" placeholder="Description" required>
                            <button class="delete-button">&times;</button>
                        </div>
                    </div>
                    <div class="add-holder">
                        <div class="add-button" id="add-field">+ Add</div>
                    </div>
                </div>
                <div class="upload-holder">
                    <input type="file" id="file-upload" name="document" required>
                    <label for="file-upload" id="file-upload-label">Upload File</label>
                </div>
                <button type="submit" class="init-button submit-button">Submit</button>
            </div>
        </form>
        <h3 class="title">Created by <span style="color: #009688;"><a href="https://github.com/nasimic" target="_blank">nasimic</a></span></h3>
    </div>

    <style>
        body{
            background: #0d1117;
            font-family: ui-monospace,SFMono-Regular,SF Mono,Menlo,Consolas,Liberation Mono,monospace;
        }
        a{
            color: inherit;
            text-decoration: none;
        }
        .container{
            width: 800px;
            margin: auto;
            padding: 15px;
        }
        .title{
            color: #c9d1d9;
            text-align: center;
        }
        .content{
            display: none;
            justify-content: center;
            flex-wrap: wrap;
            background: #ccc;
            border-radius: 20px;
            padding: 20px 40px;
            width: 650px;
            margin: auto;
        }
        .initializer{
            display: flex;
            justify-content: start;
            flex-wrap: wrap;
            background: #ccc;
            border-radius: 20px;
            padding: 40px;
            width: 650px;
            margin: auto;
            margin-bottom: 20px;
        }
        .add-holder{
            display: flex;
            justify-content: end;
            align-items: center;
            width: 100%;
            margin-bottom: 30px;
        }
        .upload-holder{
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            border: 3px dashed #3f51b55c;
            border-radius: 5px;
            padding: 20px 0px;
            margin: 15px 10px;
            background: #2196f394;
        }
        .form-group{
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            background: #ccc;
            width: 650px;
            margin: auto;
            margin-bottom: 20px;
        }
        .input-holder{
            display: flex;
            flex: 1 0 100%;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .input-holder input{
            flex: 1 0 200px;
            padding: 15px;
            border-radius: 7px;
            border: none;
            outline: none;
            margin: 10px;
        }
        .input-holder button{
            flex: 1 0 20px;
            border-radius: 7px;
            border: none;
            outline: none;
            margin: 10px;
            background-color: #f43643;
            border-color: #f43643;
            color: #f5f5f5;
            font-weight: bold;
            font-size: 1.5rem;
            cursor: pointer;
            max-width: 50px;
        }
        .input-holder button:hover{
            background-color: #d31a27;
        }
        .init-button{
            padding: 15px 50px;
            margin: 10px;
            background: #009688;
            border-radius: 7px;
            color: #f7f7f7;
            user-select: none;
            cursor: pointer;
            border: none;
        }
        .submit-button{
            width: 100%;
            text-align: center;
        }
        .add-button{
            padding: 15px 50px;
            margin: auto 10px;
            background: #0d1117;
            border-radius: 7px;
            color: #f7f7f7;
            user-select: none;
            cursor: pointer;
        }
        #file-upload{
            opacity: 0;
            width: 0;
        }
        #file-upload-label{
            padding: 15px 50px;
            margin: 10px;
            border-radius: 7px;
            color: #f7f7f7;
            user-select: none;
            cursor: pointer;
        }
        .single-code{
            display: flex;
            flex: 1 0 100%;
            justify-content: center;
            margin: 5px 0px;
        }
        .code{
            position: relative;
            background: #161b22;
            color: #c9d1d9;
            padding: 16px;
            border-radius: 6px;
            flex: 0 0 100%;
            transition: ease-in-out .2s;
        }
        .copy{
            opacity: 0;
            background: #282e33;
            border: 1px solid #3b4149;
            padding: 6px 10px 8px 10px;
            border-radius: 6px;
            position: absolute;
            right: 10px;
            top: 8px;
            transition: ease-in-out .2s;
            cursor: pointer;
            user-select: none;
        }
        .code:hover .copy{
            opacity: 1;
        }
        .copied{
            background: #606862;
            text-decoration: line-through;
        }
        .copy-triggered{
            background: #28a745;
            color: #fff;
            border: 1px solid #0b9029;
        }
    </style>

    <script>
        const inputElement = document.getElementById('file-upload');
        const inputLabel = document.getElementById('file-upload-label');

        inputElement.addEventListener('change', function(e) {
            inputLabel.innerHTML = e.srcElement.files[0].name;
        });

        $("#add-category").on("click", function() {
            $(".keywords .form-group").append(`
                <div class="input-holder">
                    <input type="text" name="categories[]" placeholder="Category" required>
                    <input type="text" name="keywords[]"  placeholder="Keywords (provision,parts,store...)" required>
                    <button class="delete-button">&times;</button>
                </div>
            `);
        });
        $("#add-field").on("click", function() {
            $(".fields .form-group").append(`
                <div class="input-holder">
                    <input type="text" name="fields[]" placeholder="Field" required>
                    <button class="delete-button">&times;</button>
                </div>
            `);
        });

        $(document).on("click", ".delete-button", function() {
            $(this).parent().remove();
        });

        function copyToClipboard(element) {
            var $temp = $("<textarea>");
            $("body").append($temp);
            var html = $(element).text();
            html = html.replace(/<br>/g, "\n"); // or \r\n
            $temp.val(html).select();
            document.execCommand("copy");
            $temp.remove();
        }

        function revertCopyText() {
            $(".copy").text("copy");
            $(".copy").removeClass("copy-triggered");
        }

        $(".copy").on("click", function(){
            copyToClipboard($(this).parent().find(".copy-target"));
            $(this).parent().addClass("copied");
            $(this).text("copied");
            $(this).addClass("copy-triggered");
            setTimeout(revertCopyText, 1000);
        });
        
        // $(".init-button").on("click", function(){
        //     if($('#website').val() == "" || $('#domain').val() == ""){
        //         alert("Fill inputs");
        //         return false;
        //     }
        //     $('.copy-target').text(function(index,text){
        //         return text.replace('WEBSITE',$("#website").val());
        //     });
        //     $('.copy-target').text(function(index,text){
        //         return text.replace('DOMAIN',$("#domain").val());
        //         return text.replace('DOMAIN',$("#domain").val());
        //     });

        //     $(".code").removeClass("copied");

        //     $(".content").css("display","flex");

        //     alert("Initialized");
        // });

    </script>
</body>
</html>