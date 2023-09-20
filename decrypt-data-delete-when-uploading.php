<html>
    <head>
        <?php
        include_once "conn.php";
        //generate key
        
        
        //enter table name and load in browser to check passwords
        $resultPost = mysqli_query($conn,"SELECT institutionName, password FROM reginstitutions");
        ?>
        <style>
            table,th,td{
                padding:10px;
                border: 1px solid black;
                border-collapse: collapse;
            }
        </style>
    </head>
    <body>
        <table>
            <tr>
                <th>First Name</th>
                <th>Encrypted Item name</th>
                <th>Decrypted item name</th>
            </tr>
        <?php
        while($row = mysqli_fetch_array($resultPost)) {?>
            <tr>
                <td>
                    <?php 
                        echo $row["institutionName"];
                        //echo $row["firstName"];
                    ?>
                </td>
                <td>
                    <?php
                    echo $row["password"];
                    ?>
                </td>
                <td>
                <?php 
                    $encryd = $row["password"];
                    $decryd = openssl_decrypt($encryd, "AES-128-ECB", $SECRETKEY);
                    echo $decryd;
                    ?>
                </td>
            </tr>
            <?php
        }
        ?>
        </table>
    <body>
<html>