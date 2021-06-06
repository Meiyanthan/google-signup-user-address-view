               
                <div class="footer_main">
                    <div class="container">
                    <div class="wrapper">
                        <p class="flt_left margin_top_10">
                            <a href="#" id="lnkEmailAddress">Powered by MM</a>
                            
                            <a>@ Copyrights <?php echo date("Y"); ?></a>
                        </p>
                        <p class="version">
                            Ver : 1.0.4.0
                        </p>
                        <p class="flt_right margin_top_10">
                            <a><img src="<?php echo base_url().'assets/';?>img/twitter.png"></a>
                            <a><img src="<?php echo base_url().'assets/';?>img/facebook.png"></a>
                            <a><img src="<?php echo base_url().'assets/';?>img/mail_footer.png"></a>
                        </p>

                    </div>
                </div>
        </div>



    
    
    
    

        <script src="<?php echo base_url().'assets/';?>js/jquery-1.11.3.min.js"></script>
        <script src="<?php echo base_url().'assets/';?>js/bootstrap.min.js"></script>
        <script src= "<?php echo base_url().'assets/';?>js/angular.min.js"></script>
    
      <script type="text/javascript">

        $(document).ready(function () {
            $(".submenu").hover(function () {
                $('.level2', this).not('.in .level2').stop(true, true).addClass('active');

            },
                function () {
                    $('.level2', this).not('.in .level2').stop(true, true).removeClass('active');
                }
            );
            $(".submenu_inner").hover(function () {
                $('.level3', this).not('.in .level3').stop(true, true).addClass('active');

            },
                function () {
                    $('.level3', this).not('.in .level3').stop(true, true).removeClass('active');
                }
            );

        });

    </script>

    <script type="text/javascript">
                    $(window).bind('scroll', function () {
                //alert('hi');
                if ($(window).scrollTop() > 10) {
                    $('.footer_main').addClass('relative');
                } else {
                    $('.footer_main').removeClass('relative');
                }
            });

        </script>
 <script type="text/javascript">
       $(document).ready(function(){
        $(".menu-options").click(function(event){
            console.log('cmg');
            event.stopPropagation();
            $(".menu-options").toggleClass("open");
            $(".side-header").toggleClass("slide-menu");
            /*$(".main-content").toggleClass("wide-content");*/
            $(".header").toggleClass("active");
        });
        $(".menu-options").on("click", function (event) {
        event.stopPropagation();
    });
    });
       $(document).on("click", function () {
     $(".menu-options").removeClass("open");
     $(".side-header").removeClass("slide-menu");
     $(".header").removeClass("active");
 });

    /*Logout Menu action*/

      $(document).ready(function(){
        $(".logout").click(function(event){
            event.stopPropagation();
            $(".dropdown-logout").toggleClass("open");
        });
        $(".menu-options").on("click", function (event) {
        event.stopPropagation();
    });
    });
    $(document).on("click", function () {
     $(".dropdown-logout").removeClass("open");
     });
    </script>