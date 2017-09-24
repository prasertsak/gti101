<?$pin_id = $_SESSION['user_id'];
$color    = "gray";
//     menu_id        menu_name        menu_link        menu_icon
$sql5     = ("SELECT * FROM system_menu where menu_id_child='$s_id' order by menu_id ");
$results5 = $mysqli->
    query($sql5);
?>
<ddiv class="row">
    <div class="col-lg-12">
        <h3 class="page-header">
            <?echo $this_sys; ?>
        </h3>
        <i>
            <?echo "พบข้อมูล " . $results5 -> num_rows . " รายการ "; ?>
        </i>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <?if ($results5->
    num_rows > 0) {
    while ($row5 = $results5->fetch_assoc()) {
        $menu_id   = $row5["menu_id"];
        $menu_name = $row5["menu_name"];
        $menu_link = $row5["menu_link"];
        $menu_icon = $row5["menu_icon"];
        ?>
    <div class="col-lg-2 col-md-3">
        <style>
            a.five:link {
            color: #4a4a4a;
            text-decoration: none;
        }
        a.five:visited {
            color: #4a4a4a;
            text-decoration: none;
        }
        a.five:hover {
            color: #000000;
            text-decoration: none;
        }
        </style>
        <a class="five" href="?msel=<?echo $menu_id; ?>&mlink=<?echo $menu_link; ?>">
            <div class="panel custom_class" style="border-color:<?echo $color; ?>">
                <div class="panel-heading custom_class" style="background-color:<?echo $color; ?>;">
                    <div class="row">
                        <div class="panel-title">
                            <div class="col-xs-3">
                                <div>
                                    <?echo $menu_id; ?>
                                </div>
                            </div>
                            <div class="col-xs-9 text-right">
                                <i class="fa <?echo $menu_icon; ?> fa-2x">
                                </i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <?echo $menu_name; ?>
                </div>
            </div>
        </a>
    </div>
    <?
    }
}

?>
</div>