<section class="menu-bar">
    <div class="search-bar-top">
        <div class="search-bar">
            <div data-parallax = "scroll">
                <form action = "" method = "GET" class = "form-inline">
                    <input id="search" name = "keyword" type = "text" placeholder = "Search Doctor By Email or First Name" class = "form-control" value = "<?php echo isset($_POST['keyword'])?$_POST['keyword']:''?>"/>
                    <span class = "input-group-button"><button class="search-btn" type="submit" name = "search"><i class="fa fa-search"></i>search</button></span>
                </form>
                <div id="suggestion" class="suggestion">

                </div>
            </div>    
        </div>
    </div>
</section>

<script src="../js/jquery-3.3.1.min.js"></script>
<script src="../js/code.jquery.com_jquery-latest.js"></script>
<script src="../js/jquery.timers-1.0.0.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        //autocomplete 1
        $("#search").keyup(function(e){
            var search_query = $(this).val();
            if(search_query != ""){
                $.ajax({
                    url:"doc-suggest-srch.php",
                    type: "POST",
                    data: {search: search_query},
                    success: function($data){
                        $("#suggestion").fadeIn('fast').html($data);
                    }
                });
            }
            else{
                $("#suggestion").fadeOut();
            }
        })
    });
</script>