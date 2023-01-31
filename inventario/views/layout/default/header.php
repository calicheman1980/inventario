<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title><?php if(isset($this->titulo)) echo $this->titulo; ?></title>
            <meta http-equiv="Content-type" content="text/html; charset=utf8" />
            <link href="<?php echo $_layoutParams['ruta_css'];?>estilos.css" rel="stylesheet" type="text/css" />
            <link href="<?php echo $_layoutParams['ruta_css'];?>estilosFormularios.css" rel="stylesheet" type="text/css" />
            <link href="<?php echo BASE_URL; ?>public/css/calendar-style.css" rel="stylesheet" type="text/css" />
            <script src="<?php echo BASE_URL; ?>public/js/jquery.js" type="text/javascript"></script>
            <script src="<?php echo BASE_URL; ?>public/js/jquery.validate.js" type="text/javascript"></script>
            <script src="<?php echo BASE_URL; ?>public/js/calendar.js" type="text/javascript"></script>
            <script src="<?php echo BASE_URL; ?>public/js/calendar-setup.js" type="text/javascript"></script>
            <script src="<?php echo BASE_URL; ?>public/js/calendar-es.js" type="text/javascript"></script>
            <script src="<?php echo BASE_URL; ?>public/js/funcionCancelar.js" type="text/javascript"></script>
           
            <?php if(isset($_layoutParams['js']) && count($_layoutParams['js'])): ?>
                <?php for($i=0; $i< count($_layoutParams['js']); $i++):?>
                    <script src="<?php echo $_layoutParams['js'][$i]; ?>" type="text/javascript"></script>
                <?php endfor;?>
            <?php endif;?>
                    
    </head>
    <body>
        <center><div id="header">
            <div id="top_menu">
                <ul>
                    <?php if(isset($_layoutParams['menu'])): ?>
                    <?php for($i=0; $i<count($_layoutParams['menu']); $i++): ?>
                    <li><a href="<?php echo $_layoutParams['menu'][$i]['enlace']; ?>"><?php echo $_layoutParams['menu'][$i]['titulo']; ?></a></li>
                    <?php endfor; ?>
                    <?php endif; ?>
                    </ul>
                 <ul>
                 <li><label id="perfil"></label></li>
                 </ul>
                     
                </div>
            </div>
        </center>
        
    <div id="main"></div>
    <div id="content">
            
            