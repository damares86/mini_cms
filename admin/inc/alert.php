<?php

$msg=filter_input(INPUT_GET,"msg");

if($msg=="userDelSucc"){
    ?>
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_userDelSucc?>
    </div>

    <?php    
} else if($msg=="userDelErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_userDelErr?>
    </div>

    <?php    
} else if($msg=="mailExists"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_mailExists?>
    </div>

    <?php    
} else if($msg=="userSucc"){
    ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_userSucc?>
    </div>

    <?php    
} else if($msg=="userErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_userErr?>
    </div>

    <?php    
} else if($msg=="userEditSucc"){
    ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_userEditSucc?>
    </div>

    <?php    
} else if($msg=="userEditErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_userEditErr?>
    </div>

    <?php    
} else if($msg=="setEditSucc"){
    ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_setEditSucc?>
    </div>

    <?php    
} else if($msg=="setEditErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_setEditErr?>
    </div>

    <?php    
} else if($msg=="postDelSucc"){
    ?>
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_postDelSucc?>
    </div>

    <?php    
} else if($msg=="postDelErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_postDelErr?>
    </div>

    <?php    
} else if($msg=="postSucc"){
    ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_postSucc?>
    </div>

    <?php    
} else if($msg=="postErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_postErr?>
    </div>

    <?php    
} else if($msg=="postEditSucc"){
    ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_postEditSucc?>
    </div>

    <?php    
} else if($msg=="postEditErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_postEditErr?>
    </div>

    <?php    
} else if($msg=="catDelSucc"){
    ?>
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_catDelSucc?>
    </div>

    <?php    
} else if($msg=="catDelError"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_catDelError?>
    </div>

    <?php    
} else if($msg=="catDelExist"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_catDelExist?>
    </div>

    <?php    
} else if($msg=="catExists"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_catExists?>
    </div>

    <?php    
} else if($msg=="catSucc"){
    ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_catSucc?>
    </div>

    <?php    
} else if($msg=="catErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_catErr?>
    </div>

    <?php    
} else if($msg=="catEditSucc"){
    ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_catEditSucc?>
    </div>

    <?php    
} else if($msg=="catEditErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_catEditErr?>
    </div>

    <?php    
} else if($msg=="colorDelSucc"){
    ?>
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_colorDelSucc?>
    </div>

    <?php    
} else if($msg=="colorDelErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_colorDelErr?>
    </div>

    <?php    
} else if($msg=="colorSucc"){
    ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_colorSucc?>
    </div>

    <?php    
} else if($msg=="colorErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_colorErr?>
    </div>

    <?php    
} else if($msg=="catEmpty"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_catEmpty?>
    </div>

    <?php    
} else if($msg=="colorEmpty"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_colorEmpty?>
    </div>

    <?php    
} else if($msg=="pageEmpty"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_pageEmpty?>
    </div>

    <?php    
} else if($msg=="pswEmpty"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_pswEmpty?>
    </div>

    <?php    
} else if($msg=="postTitleEmpty"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_postTitleEmpty?>
    </div>

    <?php    
} else if($msg=="postEmpty"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_postEmpty?>
    </div>

    <?php    
} else if($msg=="settingsEmpty"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_settingsEmpty?>
    </div>

    <?php    
} else if($msg=="userEmpty"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_userEmpty?>
    </div>

    <?php    
} else if($msg=="pageDelSucc"){
    ?>
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_pageDelSucc?>
    </div>

    <?php    
} else if($msg=="pageDelErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_pageDelErr ?>
    </div>

    <?php    
} else if($msg=="pageSucc"){
    ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_pageSucc?>
    </div>

    <?php    
} else if($msg=="pageDelSucc"){
    ?>
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_pageDelSucc?>
    </div>

    <?php    
} else if($msg=="pageErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_pageErr?>
    </div>

    <?php    
} else if($msg=="pageEditSucc"){
    ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_pageEditSucc?>
    </div>

    <?php    
} else if($msg=="pageEditErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_pageEditErr?>
    </div>

    <?php    
} else if($msg=="fileDelSucc"){
    ?>
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_fileDelSucc?>
    </div>

    <?php    
} else if($msg=="fileDelErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_fileDelErr?>
    </div>

    <?php    
} else if($msg=="fileNotDel"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_fileNotDel?>
    </div>

    <?php    
} else if($msg=="fileTitleEmpty"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_fileTitleEmpty?>
    </div>

    <?php    
} else if($msg=="fileEmpty"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_fileEmpty?>
    </div>

    <?php    
} else if($msg=="fileSucc"){
    ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_fileSucc?>
    </div>

    <?php    
} else if($msg=="fileErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_fileErr?>
    </div>

    <?php    
} else if($msg=="fileModSucc"){
    ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_fileModSucc?>
    </div>

    <?php    
} else if($msg=="fileModErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_fileModErr?>
    </div>

    <?php    
} else if($msg=="fileModDelErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_fileModDelErr?>
    </div>

    <?php    
} else if($msg=="fileModTitleSucc"){
    ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_fileModTitleSucc?>
    </div>

    <?php    
} else if($msg=="fileModTitleErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_fileModTitleErr?>
    </div>

    <?php    
} else if($msg=="contactEmpty"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_contactEmpty?>
    </div>

    <?php    
} else if($msg=="setContactSucc"){
    ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_setContactSucc?>
    </div>

    <?php    
} else if($msg=="setContactErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_setContactErr?>
    </div>

    <?php    
} else if($msg=="keyEmpty"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_keyEmpty?>
    </div>

    <?php    
} else if($msg=="setKeySucc"){
    ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_setKeySucc?>
    </div>

    <?php    
} else if($msg=="setKeyErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_setKeyErr?>
    </div>

    <?php    
} else if($msg=="projectDelSucc"){
    ?>
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_projectDelSucc?>
    </div>

    <?php    
} else if($msg=="projectDelErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_projectDelErr?>
    </div>

    <?php    
} else if($msg=="projectEmpty"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_projectEmpty?>
    </div>

    <?php    
} else if($msg=="projectImgEmpty"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_projectImgEmpty?>
    </div>

    <?php    
} else if($msg=="projectSucc"){
    ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_projectSucc?>
    </div>

    <?php    
} else if($msg=="projectErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_projectErr ?>
    </div>

    <?php    
} else if($msg=="projectEditSucc"){
    ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_projectEditSucc?>
    </div>

    <?php    
} else if($msg=="projectEditErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_projectEditErr?>
    </div>

    <?php    
} else if($msg=="catPortfolioDelExist"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_catPortfolioDelExist?>
    </div>

    <?php    
} else if($msg=="catPortfolioDelSucc"){
    ?>
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_catPortfolioDelSucc?>
    </div>

    <?php    
} else if($msg=="catPortfolioDelErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_catPortfolioDelErr?>
    </div>

    <?php    
} else if($msg=="catPortfolioEmpty"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_catPortfolioEmpty?>
    </div>

    <?php    
} else if($msg=="catPortfolioExists"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_catPortfolioExists?>
    </div>

    <?php    
} else if($msg=="catPortfolioSucc"){
    ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_catPortfolioSucc?>
    </div>

    <?php    
} else if($msg=="catPortfolioErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_catPortfolioErr?>
    </div>

    <?php    
} else if($msg=="catPortfolioEditSucc"){
    ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_catPortfolioEditSucc?>
    </div>

    <?php    
} else if($msg=="catPortfolioEditErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_catPortfolioEditErr?>
    </div>

    <?php    
} else if($msg=="gallDelSucc"||$msg=="pageGallDel"){
    ?>
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_gallDel?>
    </div>

    <?php    
} else if($msg=="pageGallNotDel"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Gallery not deleted
    </div>

    <?php    
} else if($msg=="pageGallNotDel"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_pageGallNotDel?>
    </div>

    <?php    
} else if($msg=="imgDelSucc"){
    ?>
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_imgDelSucc?>
    </div>

    <?php    
} else if($msg=="imgNotDel"){
    ?>
    <div class="alert alert-daner">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_imgNotDel?>
    </div>

    <?php    
} else if($msg=="formatErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_formatErr?>
    </div>

    <?php    
} else if($msg=="imgSucc"){
    ?>
    <div class="alert alert-succ">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_imgSucc?>
    </div>

    <?php    
} else if($msg=="gallTitleErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_gallTitleErr?>
    </div>

    <?php    
} else if($msg=="gallFileErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_gallFileErr?>
    </div>

    <?php    
} else if($msg=="formatErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_formatErr?>
    </div>

    <?php    
} else if($msg=="gallSucc"){
    ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_gallSucc?>
    </div>

    <?php    
} else if($msg=="gallErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$al_gallErr?>
    </div>

    <?php    
} else if($msg=="imgEmpty"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$imgEmpty?>
    </div>

    <?php    
} else if($msg=="titleExist"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$titleExist?>
    </div>

    <?php    
} else if($msg=="pageCopySucc"){
    ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$pageCopySucc?>
    </div>

    <?php    
} else if($msg=="pageCopyErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?=$pageCopyErr?>
    </div>

    <?php    
} else

?>
