<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Read More</title>
        <style>
            *{
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }body{
                background-color: #f5f7f9;
                font-family: 'Open Sans', sans-serif;
            }
            .box{
                width: 30%;
                float: left;
                margin: 50px 20px;
                background-color: #fff;
                padding: 15px;
                border-radius: 8px;
                box-shadow: 0 5px 5px rgba(0,0,0,0.15);
            }
            /* .box h4{
                margin-bottom: 10px;
            } */
            .box p{
                font-size: 15px;
                line-height: 28px;
                height: 90px;
                overflow: hidden;
            }
            .box a{
                font-size: 15px;
                /* display: inline-block;
                color: #fff;
                background-color: #2196f3;
                text-decoration: none;
                padding: 10px 15px;
                border-radius: 8px;
                margin-top: 15px; */
            }
            .box a:hover{
                box-shadow: 0 5px 5px rgba(0,0,0,0.2);
            }
            .box.showContent p{
                height: auto;
            }
            .box.showContent a.readmore-btn{
                background-color: red;
            }
            
        </style>
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
        <!-- <link rel="stylesheet" href="readmore.css"> -->
    </head>
    <body>
        <div class="box">
                    <!-- <h4>Post title 1<h4> -->
                    <p>Lorem Ipsum is simply dummy text of the printing and 
                    typesetting industry. Lorem Ipsum has been the 
                    industry's standard dummy text ever since the 1500s Lorem Ipsum
                    is simply dummy text of the printing and typesetting industry. 
                    Lorem Ipsum has been the industry's standard dummy text ever since 
                    the 1500s, when an unknown printer took a galley of type and scrambled 
                    it to make a type specimen book. It has survived not only five centuries, 
                    but also the leap into electronic typesetting, remaining essentially 
                    unchanged. It was popularised in the 1960s with the release of Letraset 
                    sheets containing Lorem Ipsum passages, and more recently with desktop 
                    publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                    <a href="javascript:void();" class="readmore-btn">Read More</a>                    
                    <!-- <button class="read">Read More</button> -->
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
        <script>
            $(".readmore-btn").on('click', function(){
                $(this).parent().toggleClass("showContent");
            });
        </script>
    </body>
</html>