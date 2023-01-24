<?php 
require 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Metro UI -->
    <link rel="stylesheet" href="https://cdn.korzh.com/metroui/v4/css/metro-all.min.css">
    <script
        src="https://code.jquery.com/jquery-3.6.3.js"
        integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
        crossorigin="anonymous">
    </script>
  </head>
  <?php 
  $sql = "SELECT * FROM leads";
  $result = $conn->query($sql);
  ?>
  <body>
  <h1 class="text-center">OC-Analytica</h1>
    <h3 class="text-center">The Responsive Table:</h3>
    <div class="container-fluid">
        <table  id="Table1"
                class="table" 
                data-role="table"
                data-rows="50"

        >
            <thead>
                <tr>
                    <th >Name</th>
                    <th >Email</th>
                    <th data-cls-column="bg-olive fg-white text-center">Check All <input id="chkalls" type="checkbox"></th>
                    <th data-cls-column="fg-white text-center" >Sent Mail</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?=$row["name"]?></td>
                            <td><?=$row["email"]?></td>
                            <td><input class="chkbox" type="checkbox"></td>
                            <td><Button class="bg-blue  singlemailsent" type="button">Sent</button></td>
                        </tr>
                <?php    } 
                } else {
                    echo "0 results";
                }
                ?>
              
            </tbody>
        </table>
    </div>
    <input id = "btnGet" type="button" value="Sent Bulk Mails" />
    <div id="getback"> </div>

    <!-- Metro UI -->
    <script src="https://cdn.korzh.com/metroui/v4/js/metro.min.js"></script>
    <script>
        let actual_mails=[];
        var message="";
        let revtext="Mail Sent ✔";
        $(document).ready(function(){
            $("#chkalls").click(function(){
                if($(this).prop('checked')){
                    $('.chkbox').not(this).prop('checked',true);
                } else{
                    $('.chkbox').not(this).prop('checked', false);
                }
            });
            $('#Table1 tbody').on("click",".singlemailsent",function(){
                $('#getback').html("");
                $(this).removeClass("bg-blue");
                $(this).addClass("bg-green");
                $(this).text(revtext);
                message="";
                var row = $(this).closest("tr")[0];
                message = row.cells[3].innerText;
                $('#getback').html(message);
                $.ajax({
                    type: "POST",
                    url: "mailer.php",
                    data: {
                        data: message
                    },
                    cache: false,
                    success: function(data) {
                        $('#getback').html(data);
                    }
                });
            });
        });

        $(function () {
        //Assign Click event to Button.
        $("#btnGet").click(function () {
            
 
            //Loop through all checked CheckBoxes in GridView.
            $("#Table1 input[type=checkbox]:checked").each(function () {
                var row = $(this).closest("tr")[0];
                message +=row.cells[3].innerText+",";
            });
 
            //Display selected Row data in Alert Box.
            const emails=[];
            const maharray=message.split(",");
            for (let i = 0; i < maharray.length; i++) {
                if(maharray[i]!=='No Email')
                {
                    emails[i]=maharray[i];
                }
            }
            actual_mails=emails.filter(function(el){
                return el;
            })
            $.ajax({
                    type: "POST",
                    url: "mailer.php",
                    data: {
                        data: actual_mails
                    },
                    cache: false,
                    success: function(data) {
                        $('#getback').html(data);
                    }
                });
            //alert(message);s
            
            return false;
        });

  

        
    });
      
            
    </script>
  </body>
</html>