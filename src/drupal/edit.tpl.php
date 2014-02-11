<!doctype html>
<html lang="en">

<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">
    <style>
        #map {
            height: 600px;
            /*width:100%;*/
        }
        body {
            padding-top: 70px;
        }
    </style>
<script type="text/javascript" src="http://trailmap.hylly.org/trailmap/OpenLayers.js?mxl277"></script>

    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://trailmap.hylly.org/trailmap/edit.js?mxl277"></script>
    <title>Trailmap</title>
        <style>
        .customEditingToolbar {
            float: right;
            right: 0px;
            height: 30px;
        }
        .customEditingToolbar div {
            float: right;
            margin: 5px;
            width: 24px;
            height: 24px;
        }
        .olControlNavigationItemActive {
            background-image: url("theme/default/img/editing_tool_bar.png");
            background-repeat: no-repeat;
            background-position: -103px -23px;
        }
        .olControlNavigationItemInactive {
            background-image: url("theme/default/img/editing_tool_bar.png");
            background-repeat: no-repeat;
            background-position: -103px -0px;
        }
        .olControlDrawFeaturePolygonItemInactive {
            background-image: url("theme/default/img/editing_tool_bar.png");
            background-repeat: no-repeat;
            background-position: -26px 0px;
        }
        .olControlDrawFeaturePolygonItemActive {
            background-image: url("theme/default/img/editing_tool_bar.png");
            background-repeat: no-repeat;
            background-position: -26px -23px ;
        }
        .olControlModifyFeatureItemActive {
            background-image: url(theme/default/img/move_feature_on.png);
            background-repeat: no-repeat;
            background-position: 0px 1px;
        }
        .olControlModifyFeatureItemInactive {
            background-image: url(theme/default/img/move_feature_off.png);
            background-repeat: no-repeat;
            background-position: 0px 1px;
        }
        .olControlDeleteFeatureItemActive {
            background-image: url(theme/default/img/remove_point_on.png);
            background-repeat: no-repeat;
            background-position: 0px 1px;
        }
        .olControlDeleteFeatureItemInactive {
            background-image: url(theme/default/img/remove_point_off.png);
            background-repeat: no-repeat;
            background-position: 0px 1px;
        }
    </style>
</head>

<body>
    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Trailmap</a>
            </div>
            <div class="navbar-text navbar-right">
                <?php if (user_is_logged_in()): ?>
                <a href="http://trailmap.hylly.org/trailmap/?q=trailmap/">Takaisin reittikarttaan</a>
<?php echo t('Kirjautunut sisään käyttäjänä: ') . '<a href="http://trailmap.hylly.org/trailmap/?q=trailmap/me">' . $user->name . '</a> - <a href="http://trailmap.hylly.org/trailmap/?q=user/logout">' . t('Kirjaudu ulos') . '</a>';?>
<?php else: ?>
<?php
echo drupal_render(drupal_get_form('user_login_block'));

?>


<?php endif;?>

</div>
<!--/.nav-collapse -->
</div>
</div>
</div>

<div class="container">
<div class="row">
<div class="col-md-2">
&nbsp;
</div>
<div class="col-md-9"></div>
<div class="btn-group">
  <button type="button" class="btn btn-default drawbtn">Piirrä uusi polku</button>
  <button type="button" class="btn btn-default editbtn">Muokkaa polkua</button>
  <button type="button" class="btn btn-default deletebtn">Poista polku</button>
  <button type="button" class="btn btn-default savebtn">Tallenna muutokset</button>
</div>
</div>
</div>
<hr/>
<div class="row">
<div class="col-md-2">
<div id="attrform">
<h4>Ominaisuustiedot</h4>
<label for="inp-sel">Selkeys</label></br>
<select class="form-control" name="sel" id="inp-sel">
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
</select>
<label for="inp-epa">Epätasaisuus</label></br>
<select class="form-control" name="epa" id="inp-epa">
	<option value="5">5</option>
	<option value="4">4</option>
	<option value="3">3</option>
	<option value="2">2</option>
	<option value="1">1</option>
</select>
<label for="inp-alu">Alusta</label></br>
<select class="form-control" name="alu" id="inp-alu">
	<option value="1">Metsä</option>
	<option value="2">Kallio</option>
	<option value="3">Niitty</option>
	<option value="4">Suo</option>
</select><br/>
<button id="savebtn" class="btn btn-primary">Tallenna</button>
</div>
</div>
<div id="map" class="col-md-9"></div>
</div>
</div>
</body>

</html>
