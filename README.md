# Mini Cms

> 2022-02-21 -> Update: I'm about to complete a basic template with a bare template and the explanation for making your own template. Stay tuned!

The Mini Cms is a solution that allows you create and manage little websites or blog.
It offers many features:
- create and manage user with 2 different roles
- blog functions (post and category creation)
- create and manage your website's pages
- change website's theme (and if you know html and css you can create a theme on your own)

>
> Please, report any bug you find and I will fix it, thank you!
> 

## Install

Install Mini Cms is very easy.
The only thing you need are:
- an host for your website
- a MySql db with user and password

### Step-by-Step

1. Download the latest release of Mini Cms or clone the repository
2. Copy all the file on your localhost or web server
3. With your browser, go to the Mini Cms folder
4. The page will show you a form: fill it with the requested information, including your email and a password
5. Submit the form and "that's all folks" (it means that Mini Cms will create all the db tables and record he needs)
6. Login into the admin area using the email and password that you choose during the registration

## Interface overview
![minicms](https://user-images.githubusercontent.com/85158984/153583519-6a5c5f12-3b1b-4df9-99a0-a2084b8714ce.png)


## User

In Mini Cms users are the people who are allowed to modify the website's contents. 

There are 2 specific roles, which different level of permissions.

The only thing that only the Administrator is allowed to do is create and manage users.


### Role

#### Editor

It can create, modify and delete pages, posts and categories.

It can also manage website's settings, like site name or theme.

#### Contributor

It can only create, modify and delete posts and categories.


### Profile

In this tab, every user can change his username, email and password.


## Post

![post](https://user-images.githubusercontent.com/85158984/153595820-48695d50-aa0a-4bb9-9ebe-5aa72bbdfb21.png)

You can manage the existing posts or create a new post using a simple WYSIWYG editor.

On creating a new post, you can choose the title and the category of the post.

Then you will find two different editor in "Add new post".

### Summary vs Content

The first one, called **Summary** is for the preview of the post, that will be shown in the blog page where all the post will be shown.

The second one, called **Content** is for the content of the post, this will be shown by clicking **Continue reading ->**.

## Categories

You can create new categories that will automatically added to the available category for the posts.

## Pages

![page](https://user-images.githubusercontent.com/85158984/153596086-e16fc701-da71-4fb4-9e90-7c52166159e6.png)

You can create, manage and delete all the the page that you need (except from the index page, that can be only edited, and blog pages).

I created a specific structure for the pages, that will be explained below.

### Your page in "6 blocks"

![minicms_layout](https://user-images.githubusercontent.com/85158984/153586670-e59669b5-728a-43e2-9c99-83ab65648d31.png)

When you create a new page, you will have the possibility to insert various content in max 6 blocks (one per editor). It's mandatory to insert the **Block1**, then you can choose which block use (for example, you may insert only block1, block4,block5 and block6).

The image above shows the **6 blocks** of the pages. This is the default behaviour of the blocks as they are set in the css file.

If you want to modify one or more block's behaviour, you can customize it in the custom.css (see the [Managing themes](#managing-themes) section for more info).

### Background and text color

Every block may have specifics background and text color, you can select them from the dropdown menu below every block editor. If you want to add available colors go to the [Theme Settings](#theme-settings).

## Files

This is a simple file managing system that allows you to upload files and images to your website. 
It's integrated with the WYSIWYG editor, so you will find the file uploaded in your editor while editing pages or posts.

## Site settings

These are some settings of your website, like site name, description and theme.

### Menu

![menu](https://user-images.githubusercontent.com/85158984/153594868-9b054d18-b288-4d5e-9bf7-fa2f7a634505.png)

Here you can decide which of the pages you've created will be shown in the menu.

By clicking on the items of **In menu** column you can write **y** to include the page in the menu and **n** to exclude it.

By clicking on the items of **Order** column, you can decide the order of the pages in the menu.


## Theme settings

![colori](https://user-images.githubusercontent.com/85158984/153595692-4736cd9d-11ad-45e3-bdc4-3d8ebe9591ea.png)

Here you can create as many color you need, this will be shown as available colors for the background and text color in page's creation.


## Managing themes

The themes are in the folder `http://www.yoursite.com/assets/`. The default theme is `dm_theme`.

### Customize theme

The basic structure of a theme of Mini Cms is this:

```bash
+--bootstrap  # css and js files from bootstrap
|
+--css        # css files of the theme
|    |
|    +--main.css
|    +--custom.css
|
+--img        # the image of the theme
|
+--inc        # snippets of code that recall specific part of the page
|    |
|    +--cookie.php
|    +--footer.php
|    +--footerScript.php
|    +--header.php
|    +--scripts.php
|    +--visual.php
|
+--js         # javascript files
     |
     +--main.js
```

If you want to customize your theme, you can use the `custom.css` file, this will override the `main.css` property.

#### Customizing blocks

Every block has some specific classes that will help you to change the behaviour only for the blocks you need.

```html
<div class="block block1 index">
    <!-- text -->            
</div>
```

The `block` class has this properties, specified in `main.css`:

```css
.block{
    border-radius:0.5em;
    padding:2%;
    height: auto;
	float: left;
}
```

The `block1` class identifies the **Block1** in the page and `index` is a dynamic class, in every page the blocks will have a class with the same name as the page, with *underscore* instead of whitespaces and all lowercase (eg. page name -> "Contact us" / class name -> "contact_us").

This allows you to set specific properties in `custom.css` for every single blocks in every page.

#### inc

These files are snippets of code that will be included in the page by Mini Cms.

- **cookie.php** -> in this file you can paste the cookie script code (generated from services like Cookie-Script)
- **footer.php** -> here you can add all the information you want to show in the footer
- **footerScript.php** -> here you can put all the call to javascript file or script inline
- **header.php** -> this is the header part of the page, that includes the logo and the menu
- **scripts.php** -> in this file are called all the css, js and fonts of the website, you can add your own as you need
- **visual.php** -> this is the visual part of the page, below the menu


### Create your own theme

>
> WIP: soon I will create a bare theme that can be used to create a new theme
> 



