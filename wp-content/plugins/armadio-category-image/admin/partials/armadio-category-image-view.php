    <h2>Галерея Armadio</h2>
    <h3>Введіть данні галереї</h3>  

    <form name='armadio_form_galery' method='post' action='<?php echo $_SERVER['PHP_SELF'] ?>?page=galery&amp;updated=true'>
    
    <input type='text' name='armadio_text_galery_id_uk' value='<?php echo get_option('armadio_text_galery_id_uk'); ?>'/>

    <input type='submit' name='armadio_form_galery_btn' value='Зберегти'/>
    </form>