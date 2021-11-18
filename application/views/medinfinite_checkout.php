<!DOCTYPE html>
<html>

<head>
    <title>Link</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" href="../full stack/node_modules/bootstrap/dist/css/bootstrap.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            margin-top: 50px;
        }

        .signin {
            background-color: #2176ef;
            color: #FFF;
            width: 20%;
            padding: 10px 20px;
            display: block;
            height: 39px;
            border-radius: 20px;
            margin-top: 0px;
            margin-left: 0%;
            border: none;
            text-transform: uppercase;
            transition: all 0.5s ease-in-out;
        }

        .signin:hover {
            background-color: #3fe3d9;
            box-shadow: 0px 4px 35px -5px #2176ef;
            cursor: pointer;
        }

        @media screen and (max-width: 600px) {

            .signin {
                background-color: #2176ef;
                color: #FFF;
                width: 50%;
                padding: 0;
                display: block;
                height: 39px;
                border-radius: 10px;
                margin-top: 20px;
                margin-left: 17%;
                border: none;
                text-transform: uppercase;
                transition: all 0.5s ease-in-out;

            }


        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3"> </div>
            <div class="col-sm-4">
                <h4 style="text-align: center;">Student Events Details</h4> <br>
                <div class="row">
                    <table class="table table-borderless" style="border: none;">
                        <tr style="border: none;">
                            <td>Student&nbsp;Name</td>
                            <td>:</td>
                            <td><b>Srinivas</b></td>
                        </tr>
                        <tr>
                            <td>Mobile&nbsp;Number</td>
                            <td>:</td>
                            <td><b>9658745612</b></td>
                        </tr>
                        <tr>
                            <td>College&nbsp;Name</td>
                            <td>:</td>
                            <td><b>Medical College</b></td>
                        </tr>
                        <tr>
                            <td>IMA&nbsp;Member or Not </td>
                            <td>:</td>
                            <td><b>Yes</b></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td><b>suddu@gmail.com</b></td>
                        </tr>
                        <tr>
                            <td>Member&nbsp;ID </td>
                            <td>:</td>
                            <td><b>136589</b></td>
                        </tr>
                        <tr>
                            <td>Year&nbsp;Of&nbsp;Study</td>
                            <td>:</td>
                            <td><b>4th Year</b></td>
                        </tr>
                        <tr>
                            <td>Events </td>
                            <td>:</td>
                            <td><b>Chess,Carrom</b></td>
                        </tr>
                        <tr>
                            <td>Accodomination </td>
                            <td>:</td>
                            <td><b>2 Day's</b></td>
                        </tr>
                        <tr>
                            <td>Food </td>
                            <td>:</td>
                            <td><b>2 Day's</b></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-sm-3"> </div>
        </div>
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4" style="text-align: center;">
                <button class="signin">PAY</button>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
</body>

</html>