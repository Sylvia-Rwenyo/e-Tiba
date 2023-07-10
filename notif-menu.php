    <div class="menu meet-menu">
        <ul>
            <li><a href=""><i class="fa fa-bell"></i></a></li>
            <li><a href="meet.php"><i class="fa-solid fa-video"></i></a></li>
            <li><a href=""><i class="fa fa-message"></i></a></li>
            <li><a href=""><i class="fa-solid fa-book"></i></a></li>
        </ul>
    </div>
    <script>
        var element = document.querySelectorAll(".menu a");
        var length = element.length;
        for(var i=0; i<length;i++){
            element[i].onclick=function()
            {
                var b=document.querySelector(".menu a.active");
                if(b) b.classList.remove("active");
                this.classList.add('active');
            };
        }
    </script>