<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hello Bulma!</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/bulma-prefers-dark" />
  </head>
  <body>
  <section class="section">
    <div class="container">
      <h1 class="title">
        Hello World
      </h1>
      <p class="subtitle">
        My first website with <strong>Bulma</strong>!
      </p>


      <form method="POST" action="/index.php">

        <div class="field">
          <label class="label">URL</label>
          <div class="control">
            <input class="input" id="url" name="url" type="text" placeholder="https://benji.link">
          </div>
        </div>

        <div class="field">
          <div class="control">
            <button name="form" class="button is-primary">Submit</button>
          </div>
        </div>

      </form>

    </div>
  </section>

  <?php


  if(isset($_POST["form"])){

    echo "huhu";
    $website = urlencode($_POST["url"]);

    $url = get_file_contents("http://download.benji.link:3000/url/$website");

    echo $url;

    $zip = get_file_contents("http://download.benji.link:3000/$url");

    $name = substr($website, 8);

    $file = fopen("$name.zip", "w");
    fwrite($file, $zip);
    fclose($file);

    echo "<a href='$name.zip'>Download</a>";

  }


  ?>

  </body>
</html>