<div class="sideBar blue_area_text_color">
    <div class="logo">
        <div class="logoImage">
            <a href="#">
                <img src="../images/cs_logo.png">
            </a>
        </div>
    </div>
    <div class="mainList">
        <div class="parentList">
            <ul>
                <li class="clearFix">
                    <a href="<?php echo $domainName; ?>user_dashboard/" class="blue_area_text_color">
                        <div class="icon inline_list_elements">
                            <div class="iconContainer">
                                <img src="../images/summary.png" alt="">
                            </div>
                        </div>
                        <div class="listText verticallyCenter inline_list_elements">
                            Summary
                        </div>
                    </a>
                </li>

                <li class="clearFix">
                    <a href="<?php echo $domainName; ?>store_items/" class="blue_area_text_color">
                        <div class="icon inline_list_elements">
                            <div class="iconContainer">
                                <img src="../images/Productivity-40-512.png" alt="">
                            </div>
                        </div>
                        <div class="listText verticallyCenter inline_list_elements">
                            Store Items
                        </div>
                    </a>
                </li>
                <li class="clearFix">
                    <a href="#" onclick="openReq()" class="blue_area_text_color">
                        <div class="icon inline_list_elements">
                            <div class="iconContainer">
                                <img src="../images/Productivity-40-512.png" alt="">
                            </div>
                        </div>
                        <div class="listText verticallyCenter inline_list_elements">
                            Requisition Form
                        </div>
                    </a>
                </li>

            </ul>
        </div>
        <div class="settings">

        </div>
        
    </div>
</div>

<script>
    function openReq(){
        var mywindow = window.open('<?php echo $domainName."requisition_form.php"; ?>', 'PRINT', 'height=600,width=800');
        //mywindow.document.href = '<?php echo $domainName."requisition_form.html"; ?>';
    }
</script>
