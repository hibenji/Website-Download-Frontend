<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('max_execution_time', 300);

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Website Downloader</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/bulma-prefers-dark" />
    <link rel="stylesheet" type="text/css" href="benji.css" />

  </head>
  <body>
  <section class="section">
    <div class="container">
      <h1 class="title">
        Downloader
      </h1>
      <p class="subtitle">
        Download websites!
      </p>


      <form method="POST" action="/index.php">

        <div class="field">
          <label class="label">URL</label>
          <div class="control">
            <input class="input" id="url" name="url" type="url" placeholder="https://benji.link">
          </div>
        </div>

        <div class="field">
          <div class="control">
            <button name="form" class="button is-primary">Submit</button>
          </div>
        </div>

      </form>

      <br>
      <hr>

      <?php

      $configs = include('config.php');

      $backend_url = $configs["backend-url"];

      if(isset($_POST["form"])){

        $website = urlencode($_POST["url"]);

        $url = file_get_contents("$backend_url:3000/url/$website");

        if($url == "ERROR"){
          echo "Faulty URL!";
        }else{

          $zip = file_get_contents($url);

          $name = substr($website, 14);

          $file = fopen("$name.zip", "w");
          fwrite($file, $zip);
          fclose($file);

          
          ?>

          <a class='button is-success' href='<?php echo $name ?>.zip'>
            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
                <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
              </svg>
            Download
            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
              <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
              <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
            </svg>
          </a>
          <?php
        }
      }


      ?>

    </div>
  </section>

  </body>
</html>