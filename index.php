<?php session_start();

$confirm_msg = $_SESSION['confirm-msg'];

session_unset();
session_destroy();

?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <title></title>
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="manifest" href="site.webmanifest" />
        <link rel="apple-touch-icon" href="icon.png" />
        <!-- Place favicon.ico in the root directory -->

        <link rel="stylesheet" href="css/normalize.css" />
        <link rel="stylesheet" href="css/main.css" />
    </head>
    <body>
        <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

        <header class="clearfix">
            <nav role="navigation" class="main-nav">
                <ul class="page-links">
                    <li><a href="#about-me" title="Link to my bio.">about me</a></li>
                    <li><a href="#my-work" title="Link to my portfolio.">my work</a></li>
                    <li><a href="#contact-me" title="Link to my contact form.">contact me</a></li>
                    <li><a href="https://github.com/devolasvegas" title="Link to my Github profile." target="_blank"><i class="fa fa-github" aria-hidden="true"></i></a></li>
                    <li><a href="" title="Linked to my LinkedIn profile."><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                </ul>
            </nav>
        </header>
        <main role="main">
            <article class="mast-head">

            </article>
            <article class="about-me">

            </article>
            <article class="my-work">
                <section class="project-1">

                </section>
                <section class="project-2">

                </section>
                <section class="project-3">

                </section>
            </article>
            <article class="contact-me" id="contact-me">
                <h2>Get in Contact with Me</h2>
                <ul id="form-messages"><?php echo $confirm_msg; ?></ul>
                <form id="contact-form" action="php/contact.php" method="post">
                    <fieldset>
                        <legend>Your Personal Details</legend>
                        <p class="form-row">
                            <label for="first-name">First Name</label>
                            <input id="first-name" name="first-name" type="text" />
                        </p>
                        <p class="form-row">
                            <label for="last-name">Last Name</label>
                            <input id="last-name" name="last-name" type="text" />
                        </p>
                        <p class="form-row">
                            <label for="email">Email</label>
                            <input id="email" name="email" />
                        </p>
                        <p class="form-row">
                            <label for="phone">Phone Number</label>
                            <input id="phone" name="phone" type="tel" />
                        </p>
                        <p class="form-row">
                            <label for="message">Your Message</label>
                            <textarea name="message" id="message" cols="30" rows="10"></textarea>
                        </p>
                        <p class="form-row">
                            <input type="submit" value="Submit" />
                            <input type="hidden" name="is-ajax" />
                        </p>
                    </fieldset>
                </form>
            </article>
        </main>

        <script src="js/vendor/modernizr-3.5.0.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.2.1.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
        <script>
            window.ga=function(){ga.q.push(arguments)};ga.q=[];ga.l=+new Date;
            ga('create','UA-XXXXX-Y','auto');ga('send','pageview')
        </script>
        <script src="https://www.google-analytics.com/analytics.js" async defer></script>
    </body>
</html>
