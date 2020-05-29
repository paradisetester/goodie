<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Confirmation Email</title>
        
    <style type="text/css">
    body{
      margin:0;
      padding:0;
    }
    .main_info th, .main_info td{
        padding:8px;
        border: 1px solid #c3c3c3;
        border-collapse: collapse;
        color: #565656;
    }
    .main_info{
        border-collapse: collapse;
    }
    .details p{
    margin: 8px 0;
    color:#152c3b;
    }
    .details h2{
    color:#152c3b;
    }
    
    @media (max-width:600px){
    table.main_outter {
        width: 100% !important;
        padding: 0 15px !important;
    }
.details td{
  width:100% !important;
}   
    }
</style>
</head>
    <body>
        <table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable" style="background: #ececec;padding: 20px 0 40px;" >
           <tr>
                <td>
                 
                <table align="center" border="0"  height="100%" width="600px" class="main_outter" >
                  <tr>
                            <td style="text-align:center;padding: 20px 0;">
                              <h2><span style="color: #f14545;">GoodieMenu</span> For Restaurants</h2>
                            </td>
                        </tr>
                 <tr>
                 <td>
                   
                    <table class="main_info table-bordered" cellpadding="0" cellspacing="0" style="margin:auto; background: #fff; padding: 20px 15px;display: block;" >
                            <tr align="left">
                                <th style="border: 1px solid #c3c3c3;border-collapse: collapse;width:300px;">Restraunt Name:</th>
                                <td style="border: 1px solid #c3c3c3;border-collapse: collapse;width:300px;"><?php echo $Restraunt->restraunt_name; ?></td>
                            </tr>
                          <tr align="left">
                                <th style="border: 1px solid #c3c3c3;border-collapse: collapse;width:300px;">Email:</th>
                                <td style="border: 1px solid #c3c3c3;border-collapse: collapse;width:300px;"><?php echo $user->email; ?></td>
                          </tr> 
                          <tr align="left">
                                <th style="border: 1px solid #c3c3c3;border-collapse: collapse;width:300px;">Password:</th>
                                <td style="border: 1px solid #c3c3c3;border-collapse: collapse;width:300px;"><?php echo $password; ?></td>
                          </tr>                                           
                    </table>
                    <table class="footer" style="margin:auto;">
                        <tr>
                            <td>
                                <h5 style="margin-bottom:0;">Need Support ?</h5>
                                <p style="margin-top:8px;">Feel free to email us if you have any questions, comments or suggestions. We'll be happy to resolve your issues.</p>
                            </td>
                            
                        </tr>
                    </table>
                    </td>
                    </tr>
                    </table>
                </td>
           </tr>
        </table>
    </body>
</html>    
