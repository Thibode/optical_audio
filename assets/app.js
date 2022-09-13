/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './scss/app.scss';
import '/node_modules/jquery';


//Set timeout message success 

$("document").ready(function(){
    setTimeout(function(){
        $("div.alert").slideUp(700);
    }, 3000 ); // 3 secs
});