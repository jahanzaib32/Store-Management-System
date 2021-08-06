<?php

    include ("common_functions/config.php");
    $conn = makeConn();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel='stylesheet' href='req.css'>
    <title>Document</title>
</head>
<body>
    <div class="reqForm">
        <div class="title">University of Engineering and Technology Taxila</div>
        <div class="title">Department of Computer Science</div>
        <br><table class="threeCol">
            <tr>
                <td>Req No: _______________</td>
                <td class="underlined">STORE REQUISITION</td>
                <td>Dated: _____/_____/2019</td>
            </tr>
        </table>
        <br><div style="text-align: center;">Name of Faculty Member: ______________________________________________</div>
        <br><table class="item_table">
            <tr>
                <th>Sr.#</th>
                <th style="width: 40%;">Name of Item</th>
                <th>Qty</th>
                <th>Store Reg/Page #</th>
                <th>By Name Reg/Page #</th>
            </tr>
            <tr>
                <td>1</td>
                <td class="item_name_1">
                    <select name="items1" id="">
                        <option value="none">Select Option</option>
                        <?php
                            $query = "SELECT * FROM sub_carta";
                            makeOption($conn, $query, "name", "name");
                        ?>
                    </select>
                </td>
                <td>
                        <input type="text" name="vv" onchange="this.setAttribute('value', this.value)">
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>2</td>
                <td class="item_name_2">
                    <select name="items2" id="">
                        <option value="none">Select Option</option>
                        <?php
                            $query = "SELECT * FROM sub_carta";
                            makeOption($conn, $query, "name", "name");
                        ?>
                    </select>
                </td>
                <td><input type="text" name="vv" onchange="this.setAttribute('value', this.value)"></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>3</td>
                <td class="item_name_3">
                    <select name="items3" id="">
                        <option value="none">Select Option</option>
                        <?php
                            $query = "SELECT * FROM sub_carta";
                            makeOption($conn, $query, "name", "name");
                        ?>
                    </select>                
                </td>
                <td><input type="text" name="vv" onchange="this.setAttribute('value', this.value)"></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>4</td>
                <td class="item_name_4">
                    <select name="items4" id="">
                        <option value="none">Select Option</option>
                        <?php
                            $query = "SELECT * FROM sub_carta";
                            makeOption($conn, $query, "name", "name");
                        ?>
                    </select>
                </td>
                <td><input type="text" name="vv" onchange="this.setAttribute('value', this.value)"></td>
                <td></td>
                <td></td>
            </tr>
        </table>
        <br><table class="threeCol">
            <tr>
                <td>________________</td>
                <td>___________________</td>
                <td>Recieved By:</td>
            </tr>
        </table>
        <table class="threeCol">
            <tr>
                <td>Demanded By:</td>
                <td>Officer Incharge Store</td>
                <td>Signature: ____________</td>
            </tr>
        </table>
        <table class="threeCol">
            <tr>
                <td colspan="2" style="width: 66%;">Head of Department: ___________________________________</td>
                <td>Name: ____________</td>
            </tr>
        </table>
        <table class="threeCol">
            <tr>
                <td>Dated: ______________</td>
                <td>Issued By: _____________</td>
                <td>Designation: ____________</td>
            </tr>
        </table>
    </div>
    <div class="reqHiddenForm">
        <div class="title">University of Engineering and Technology Taxila</div>
        <div class="title">Department of Computer Science</div>
        <br><table class="threeCol">
            <tr>
                <td>Req No: _______________</td>
                <td class="underlined">STORE REQUISITION</td>
                <td>Dated: _____/_____/2019</td>
            </tr>
        </table>
        <br><div style="text-align: center;">Name of Faculty Member: ______________________________________________</div>
        <br><table class="item_table">
            <tr>
                <th>Sr.#</th>
                <th style="width: 40%;">Name of Item</th>
                <th>Qty</th>
                <th>Store Reg/Page #</th>
                <th>By Name Reg/Page #</th>
            </tr>
            <tr>
                <td>1</td>
                <td class="item_name_1"></td>
                <td class="item_qty_1">
                    <textarea></textarea>
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>2</td>
                <td class="item_name_2"></td>
                <td><textarea></textarea></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>3</td>
                <td class="item_name_3"></td>
                <td><textarea></textarea></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>4</td>
                <td class="item_name_4"></td>
                <td><textarea></textarea></td>
                <td></td>
                <td></td>
            </tr>
        </table>
        <br><table class="threeCol">
            <tr>
                <td>________________</td>
                <td>___________________</td>
                <td>Recieved By:</td>
            </tr>
        </table>
        <table class="threeCol">
            <tr>
                <td>Demanded By:</td>
                <td>Officer Incharge Store</td>
                <td>Signature: ____________</td>
            </tr>
        </table>
        <table class="threeCol">
            <tr>
                <td colspan="2" style="width: 66%;">Head of Department: ___________________________________</td>
                <td>Name: ____________</td>
            </tr>
        </table>
        <table class="threeCol">
            <tr>
                <td>Dated: ______________</td>
                <td>Issued By: _____________</td>
                <td>Designation: ____________</td>
            </tr>
        </table>
    </div>

    <br><br><br><button onclick="printForm()">Print</button>
    <script>
        function getValue(number){
            if (document.querySelector("[name=items"+number+"]").value != "none"){
                return document.querySelector("[name=items"+number+"]").value;
            }else{
                return "";
            }
        }
        function changeQty(element){
        }
        function printForm(){
            var printAbleHtml1 = document.querySelector(".reqForm");
            var printAbleHtml = printAbleHtml1;

            for (var i = 1; i <5; i++){
                printAbleHtml.querySelector(".item_name_"+i).innerHTML = getValue(i);
                //printAbleHtml.querySelector(".item_name_"+i).innerHTML = getValue(i);
            }

            var mywindow = window.open('', 'PRINT', 'height=600,width=800');
            
            mywindow.document.write("<html><head><link rel='stylesheet' href='req.css'><title>Requisition Form</title>");
            mywindow.document.write('</head><body>');
            mywindow.document.write("<div class=''>" + printAbleHtml.innerHTML + "</div>");
            mywindow.document.write('</body></html>');

            mywindow.document.close(); // necessary for IE >= 10
            mywindow.focus(); // necessary for IE >= 10*/

            //mywindow.print();
            //mywindow.close();
        }
    </script>
</body>
</html>