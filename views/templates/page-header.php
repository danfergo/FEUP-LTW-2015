<div id="page-header" >
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-xs-2 col-sm-1 logo-section">
                <button id="nav-toggler">
                    <img src="img/btn_menu2.png">
                </button>
                <a id="logo" href="index.php">
                    <img src="img/icon_logo_small.png" alt="Icon of the website" height="31" width="31">
                    <img src="img/logo.png" id="logo-text" alt="Logo of the website" height="38" width="190">
                </a>
            </div>
            <div class="col-md-1 col-xs-0"></div>
            <div class="col-md-4 col-xs-10 col-xs-11">
                <form action="search.php" method="get" id="search-bar">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Procurar votação">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                            </button>
                        </span>
                    </div>
                </form>
            </div>
            <div class="col-md-4 col-xs-0"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#nav-toggler').click(function() {
        $("#page-sidebar").toggleClass("active");
        $("#shaddowing").toggleClass("active");

        $(this).toggleClass("active");


        $('#shaddowing').click(function() {
            $("#nav-toggler").trigger("click");
        });
    });
</script>