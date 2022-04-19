<?php

// GENERAL

$txt_submit = "Invia";
$txt_edit = "Modifica";
$txt_delete = "Cancella";
$txt_logout = "Logout";
$txt_modal_title = "Sei sicuro?";
$txt_modal_logout = "Seleziona \"Logout\" se ti vuoi disconnettere.";



// SIDEBAR

$side_dash = "Dashboard";
$side_profile = "Profilo";
$side_users = "Utenti";
$side_manage = "Gestione sito";
$side_page = "Pagine";
$side_files = "Files";
$side_blog = "Blog";
$side_post = "Post";
$side_cat = "Categorie";
$side_settings = "Impostazioni";
$side_siteset = "Sito";
$side_menuset = "Menu";
$side_themeset = "Tema";


// HOME PAGE

$home_title = "Mini Cms Dashboard";
$home_welcome ="Benvenuto";
// note: in the next line don't change the single quotation ( ' ) with the double quotation ( " )
$home_intro1 = 'Benvenuto <b><?=$user?></b> nel Pannello di Amministazione di Mini Cms.'; 
$home_intro2 = "Qui ci sono alcuni link rapidi per gestire il tuo sito.";
$home_quicklink = "Link rapidi";
$home_link1 = "Il sito ufficiale di Mini Cms";
$home_link2 = "Il repository GitHub del progetto";
$home_tab1 = "Utenti";
$home_tab2 = "Post";
$home_tab3 = "Il tuo tema";


// PROFILE

$prof_title = "Gestione utenti";
$prof_box1_title = "Dati degli utenti";
$prof_box1_desc = "Puoi scegliere uno dei due ruoli disponibili:<br> <ul>";
$prof_box1_desc .=" <li><b>Editor:</b> può creare, modificare e cancellare pagine, post e categorie.";
$prof_box1_desc .= " Può anche modificare le impostazioni del sito, come il nome o il tema.</li>";
$prof_box1_desc .= "<li><b>Contributor:</b> può solo creare, modificare e cancellare post e categorie";
$prof_box2_title = "Nuova password utente";
$prof_title_add = "Aggiungi utente";


// ALL USERS

$alluser_title = "Utenti";
$alluser_box_title = "Tutti gli utenti";
$alluser_add = "Aggiungi utente";
$alluser_role = "Ruolo";
$alluser_modal_text = "Se vuoi veramente cancellare questo utente clicca \"Ok\".";


// PAGES

$allpage_title = "Pagine";
$allpage_box_title = "Tutte le pagine";
$allpage_add = "Aggiungi una pagina";
$allpage_name = "Nome della pagina";
$allpage_link = "Link della pagina";
$allpage_view = "Mostra";
$allpage_modal_text = "Se vuoi veramente cancellare questa pagina clicca \"Ok\".";


// REG AND EDIT PAGES

$regpage_title_add = "Aggiungi una pagina";
$regpage_title_edit = "Modifica pagina";
$regpage_info = "Info sulla creazione delle pagine";
$regpage_layout = "Scegli il layout della pagina";
$regpage_visual = "Immagine del visual";
$regpage_actual = "Immagine attuale";
$regpage_block = "Blocco";
$regpage_background = "Colore di sfondo";
$regpage_text = "Colore del testo";
$regpage_desc = "Quando crei una nuova pagina, puoi inserire contenuti in un massimo di <b>6 blocchi</b> (uno per editor). <br><br>";
$regpage_desc .= "Obbligatorio è solo il Blocco 1, poi puoi scegliere quali blocchi usare (per esempio puoi decidere di usare il blocco 1, 3, 5, 6).<br><br>";
$regpage_desc .= "Puoi scegliere tra <b>3 diversi layout</b> per il posizionamento dei 6 blocchi, le immagini danno un'idea della disposizione dei blocchi, per scegliere quella che più si adatta alle esigenze della pagina.<br><br>";
$regpage_desc .= "Puoi caricare un'immagine del <b>visual</b> (in cima alla pagina) differente per ogni pagina.<br><br>";
$regpage_desc .= "<b>Colore di sfondo e del testo</b><br> Ogni bloccho può avere colore di sfondo e del testo specifici, puoi selezionarli dal menù a tendina sotto ogni editor.<br>";
$regpage_desc .= "Se vuoi aggiungere più colori disponibili, vai alla sezione \"Impostazioni -> Tema\".";


// FILES 

$file_title = "Gestione file";
$file_box_title = "Tutti i file";
$file_add = "Aggiungi file";
$file_filetitle = "Titolo";
$file_filename = "Nome";
$file_modal_text = "Se vuoi veramente cancellare questo file clicca \"Ok\".";



// ADD FILES

$addfile_title = "Aggiungi file";
$addfile_upload = "Upload file";
$addfile_desc = "Qui puoi caricare dei file da poter linkare nei post o nelle pagine.<br><br>";
$addfile_desc .= "Gli unici formati ammessi sono <b>\".pdf\", \".doc\", \".docx\", \".zip\"</b> ";
$addfile_desc .= "Dopo l'upload del file, il link sarà disponibile nella tabella con tutti i file.";


// POSTS

$post_title = "Post";
$post_box_title = "Tutti i post";
$post_add = "Aggiungi post";
$post_posttitle = "Titolo";
$post_link ="Link del post";
$post_view = "Mostra";
$post_cat = "Categoria";
$post_mod = "Modificato";
$post_modal_text = "Se vuoi veramente cancellare questo post clicca \"Ok\".";



// REG AND EDIT POST

$regpost_title_add = "Aggiungi post";
$regpost_title_edit = "Modifica post";
$regpost_info = "Info sulla creazione dei post";
$regpost_posttitle = "Titolo";
$regpost_cat = "Categoria";
$regpost_summary = "Sommario";
$regpost_content = "Contenuto";
$regpost_desc = "Nella creazione di un post, devi aggiungere un titolo e una categoria per il post. (Se ti servono più categorie, vai alla sezione \"Categorie\"). <br><br>";
$regpost_desc .= "Ci sono 2 editor: <ul><li><b>Sommario:</b> è l'anteprima del post, che verrà mostrata nella pagina Blog dove vengono mostrati tutti i post</li>";
$regpost_desc .= "<li><b>Contenuto:</b> è il vero post, verrà mostrato in una pagina dedicata, dopo aver cliccato su \"Continua a leggere->\" ";
$regpost_desc .= "alla fine del sommario nella pagina Blog</li></ul>";



// CATEGORIES

$cat_title = "Categorie";
$cat_box_title = "Tutte le categorie";
$cat_add = "Aggiungi una categoria";
$cat_name = "Nome della categoria";
$cat_modal_text = "Se vuoi veramente cancellare questa categoria clicca \"Ok\".";



// REG AND EDIT CATEGORIES

$regcat_title_add = "Aggiungi una categoria";
$regcat_title_edit = "Modifica categoria";
$regcat_name = "Nome della categoria";


// SITE SETTINGS

$site_title = "Impostazioni del sito";
$site_box1_title = "Dettagli del sito";
$site_name = "Nome del sito";
$site_description = "Descrizione del sito";
$site_lang = "Lingua del Sito";
$site_box1_desc = "Scegli il nome e la descrizione del sito, che verranno mostrati in cima alla pagina e nella barra del browser.";
$site_box2_title = "Contatti";
$site_inbox = "Indirizzo email per i contatti";
$site_reset = "Indirizzo email per il reset della password";
$site_box2_desc = "Inserisci degli indirizzi corretti, per far funzionare correttamente il modulo di contatto e il reset della password. <br><br>";
$site_box2_desc .= "<ul><li><b>Indirizzo email per i contatti:</b> questa è la mail che riceverà i messaggi mandati dal modulo di contatto</li>";
$site_box2_desc .= "<li><b>Indirizzo email per il reset della password:</b> questa è la mail usata nella procedura di reset della password, sarebbe meglio usare una mail dedicata,";
$site_box2_desc .= "come noreply@iltuosito.com (funziona anche se si usa la stessa mail)</li></ul>";
$site_box2_desc .= "<b>NOTA BENE:</b> non usare un account Gmail, perché Google blocca le applicazioni di terze parti.";
$site_box3_title = "Google reCAPTCHA v3";
$site_useRec = "Usa reCAPTCHA v3";
$site_public = "Chiave pubblica";
$site_secret = "Chiave segreta";
$site_box3_desc = "Questo è uno strumento per evitare attacchi spam sull'indirizzo email di contatto. <br><br> Per usarlo è necessario creare le 2 chiavi andando ";
$site_box3_desc .= "<a href=\"https://www.google.com/recaptcha/admin\" target=\"_blank\">in questa pagina</a>, quindi potrai selezionare la checkbox \"Usa reCAPTCHA v3\" ";
$site_box3_desc .= "e incollare le 2 chiavi  fornite da Google.<br><br> Scopri di più su ";
$site_box3_desc .= "<a href=\"https://developers.google.com/search/blog/2018/10/introducing-recaptcha-v3-new-way-to\" target=\"_blank\">Google reCAPTCHA v3</a>";


// MENU SETTINGS

$menu_title = "Impostazioni del menù";
$menu_info = "Gestione del menù";
$menu_name = "Nome della pagina";
$menu_parent = "Genitore";
$menu_inmenu = "Nel menu";
$menu_t1_title = "Pagina nel menu";
$menu_t1_yes = "Sì";
$menu_t1_child = "Figlia di";
$menu_t1_order = "Ordine pagine";
$menu_t1_up ="Su";
$menu_t1_down = "Giù";
$menu_t1_remove = "Rimuovi";
$menu_t2_title = "Figli senza genitore";
$menu_t2_name = "Nome della pagina";
$menu_t3_title = "Pagine non nel menu";
$menu_t2_add = "Aggiungi";
$menu_refresh = "Aggiorna";
$menu_desc = "Here you can decide which pages will be shown in the menu of your website and also create a hierarchy of the pages.<br>";
$menu_desc .= "There are three tables:<br><br><ul><li><b>Pages in menu:</b> these are the pages shown in menu; you can see if they are \"parent\" or \"child\" ";
$menu_desc .= "(the \"children\" are tabbed to right and have a different background), you can change the view order using \"Up\" and \"Down\" and you can remove ";
$menu_desc .= "the page from menu.</li><li><b>Children without parent:</b> these are pages marked as \"children\" but they don't have any parent (you can choose ";
$menu_desc .= "it using the dropdown menu)</li><li><b>Page not in menu:</b> these are the page which are not shown in menu, you can insert them selecting \"Add\"</li>";
$menu_desc .= "</ul><br><b>NOTE:</b> to save the changes you have to click on the <b>Refresh</b> button.";


// THEME SETTINGS

$theme_title = "Theme settings";
$theme_box1_title = "Choose your theme";
$theme_theme = "Theme";
$theme_box1_desc = "Here you can select the theme for your website.<br>";
$theme_box1_desc .= "If you want to add another theme, you have to upload the theme folder in <b>http://yoursite.com/assets/</b><br>";
$theme_box1_desc .= "Discover more about themes creation on <a href=\"http://minicms.altervista.org\">Mini Cms</a>.";
$theme_box2_title = "Box background and text colors";
$them_box2_add = "Add new color";
$theme_box2_desc = "These are the colors for the box background and for the text color.<br>";
$theme_box2_desc .= "You can add new colors and these will be shown in the dropdown menus below the editors of the six block during the page creation.<br>";
$theme_box2_desc .= "NOTE: these color <b>don't change the theme colors</b>.";


// ALERT DASHBOARD

$al_userDelSucc = "User successfully deleted";
$al_userDelErr = "User not deleted";
$al_mailExists = "User's email already registered";
$al_userSucc = "User successfully registered";
$al_userErr = "Error while registering user";
$al_userEditSucc = "User successfully modified";
$al_userEditErr = "User not modified";
$al_setEditSucc = "Settings succesfully updated";
$al_setEditErr = "Settings not modified";
$al_postDelSucc = "Post successfully deleted";
$al_postDelErr = "Post not deleted";
$al_postSucc = "Post successfully inserted";
$al_postErr = "Post not inserted";
$al_postEditSucc = "Post successfully modified";
$al_postEditErr = "Post not modified";
$al_userdelSucc = "User successfully deleted";
$al_catDelSucc = "Category successfully deleted";
$al_catDelError = "Category not deleted";
$al_catDelError = "Category not deleted because some post use it!";
$al_catExists = "Category already exists";
$al_catSucc = "Category successfully created";
$al_catErr = "Category not created";
$al_catEditSucc = "Category successfully modified";
$al_catEditErr = "Category not modified";
$al_colorDelSucc = "Color deleted";
$al_colorDelErr = "Color not deleted";
$al_colorSucc = "Color created";
$al_colorErr = "Color not created";
$al_catEmpty = "Category name missing";
$al_colorEmpty = "Color missing";
$al_pageEmpty = "Page name or first block missing";
$al_pswEmpty = "New password missing";
$al_postTitleEmpty = "Post title missing";
$al_postEmpty = "Post error: you have to fill both summary and content";
$al_settingsEmpty = "Title and description can't be empty";
$al_userEmpty = "Some data missing during user creation";
$al_pageDelSucc = "Page successfully deleted";
$al_pageDelErr = "Page not deleted";
$al_pageSucc = "Page successfully created";
$al_pageDelSucc = "Page successfully deleted";
$al_pageErr = "Page not created";
$al_pageEditSucc = "Page modified";
$al_pageEditErr = "Page not modified";
$al_fileDelSucc = "File deleted";
$al_fileNotDel = "File not deleted";
$al_fileTitleEmpty = "File title missing";
$al_fileEmpty = "File missing";
$al_fileSucc = "File uploaded";
$al_fileErr = "File not uploaded";
$al_contactEmpty = "You must insert both addesses!";
$al_setContactSucc = "Contact emails updated";
$al_setContactErr = "Contact emails not updated";
$al_keyEmpty = "You must insert both keys";
$al_setKeySucc = "reCAPTCHA keys updated";
$al_setKeyErr = "reCAPTCHA keys not updated";

// ALERT WEBSITE

$al_errSend = "Problems sending you an email.";
$al_mailResetErr = "Email missing";
$al_mailNotReg = "Email not registered";
$al_newPass = "Password changed successfully. Login below";
$al_pswEditErr = "Error while changing your password";
$al_errResetRequest = "Reset request already done. Check your email for the link or come back later and retry";
$al_noResetDelete = "There are problems with your reset request. Please contact us.";
$al_noReset = "There are problems with your reset request. Please contact us.";
$al_errRecaptcha = "Sorry, you don't seem reliable, please try again or contact us.";
$al_errPost = "Error while trying to login";
$al_contactFormEmpty = "Please fill all the fields";
$al_sentContact = "Mail successfully sent";
$al_errSendContact = "Error sending your email";
$al_errUserPsw = "Email or password wrong!";


// LOGIN AND RESET FORM

$log_forgot = "Forgot password?";
$log_required = "Password is required";
$log_back = "Back to login";
$log_forgot_title = "Forgot your password?";
$log_forgot_desc = "Insert your email below to reset your password";
$log_forgot_sent = "An email has been sent to you with instructions on how to reset your password.";
$log_forgot_wrong = "Wrong link";
$log_forgot_new = "Insert your new password";
$log_forgot_exp = "Your link is expired";


// CONTACT FORM

$cont_page_title = "Contact us";
$cont_form_title = "Contact";
$cont_form_name = "Your name";
$cont_form_email = "Your email";
$cont_form_sub = "Subject";
$cont_form_msg = "Your message";
$cont_form_button = "Send";

// BLOG

$blog_category = "Category";
$blog_mod = "Last modified on";
$blog_continue = "Continue reading";
$blog_categories = "Categories";










?>