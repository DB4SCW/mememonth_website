<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Meme Appreciation Month</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="xp.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" />
  </head>

  <body>
    <?php
      //open database
      $db = new PDO('sqlite:../database/mam.sqlite');

      //ensure database exists
      $createTableSQL = "
          CREATE TABLE IF NOT EXISTS callsigns (
          id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
          year INTEGER NOT NULL,
          region INTEGER NOT NULL,
          callsign TEXT NOT NULL,
          mainop TEXT NOT NULL,
          flag TEXT NOT NULL,
          UNIQUE(year, callsign)
      );";
      $db->exec($createTableSQL);

      $createTableSQL = "
          CREATE TABLE IF NOT EXISTS mememonths (
          id	INTEGER NOT NULL UNIQUE,
          year	INTEGER NOT NULL UNIQUE,
          title	TEXT NOT NULL,
          [from]	TEXT NOT NULL,
          [to]	TEXT NOT NULL,
          award	INTEGER NOT NULL DEFAULT 1,
          description	INTEGER NOT NULL,
          PRIMARY KEY(id AUTOINCREMENT)
      );";
      $db->exec($createTableSQL);

      //get current Meme Month Year
      $yearstmt = $db->query("SELECT MAX(year) AS max_year FROM mememonths;");
      $result = $yearstmt->fetch(PDO::FETCH_ASSOC);
      $maxYear = $result['max_year'] ? $result['max_year'] : date("Y");

      //get current Meme Month data
      $sql = "SELECT * FROM mememonths WHERE year = :year;";
      $params[':year'] = (int)$maxYear;
      $stmt = $db->prepare($sql);
      $stmt->execute($params);
      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      $current_title = $result['title'];
      $current_from = $result['from'];
      $current_to = $result['to'];
      $current_year = $result['year'];

      //get all descriptions for iteration
      $stmt = $db->query("SELECT year, description from mememonths ORDER BY year ASC;");
      $descriptions = $stmt->fetchAll(PDO::FETCH_ASSOC);

      //get all events for iteration
      $stmt = $db->query("SELECT * from mememonths WHERE year != (SELECT MAX(year) AS max_year FROM mememonths) ORDER BY year DESC;");
      $months = $stmt->fetchAll(PDO::FETCH_ASSOC);

      //define starting letter for tabs
      $start_letter = "G";

    ?>
    <div class="window" style="min-width: 640px; max-width: 1000px; width: flex;font-size: 14px;">
        <div class="title-bar">
          <div class="title-bar-text">Information about <?php echo($current_title);?></div>
          <div class="title-bar-controls">
            <a href="https://mememonth.org"><button aria-label="Minimize"></button></a>
            <a href="https://mememonth.org"><button aria-label="Maximize"></button></a>
            <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ"><button aria-label="Close"></button></a>
          </div>
        </div>
        <div class="window-body">
            <section class="tabs" style="width: flex;">
                <menu role="tablist" aria-label="Windowstabs">
                  <button role="tab" aria-selected="true" aria-controls="tab-A">About</button>
                  <button role="tab" aria-controls="tab-B">Who?</button>
                  <button role="tab" aria-controls="tab-C">When?</button>
                  <button role="tab" aria-controls="tab-D">Where and what?</button>
                  <button role="tab" aria-controls="tab-E">Why?</button>
                  <button role="tab" aria-controls="tab-F">QSL?</button>
                  <!-- create archive tabs dynamically -->
                  <?php
                    $letter = $start_letter;
                    foreach ($months as $row) {
                      echo "<button role=\"tab\" aria-controls=\"tab-" . $letter . "\">Archive " . $row['year'] . "</button>";
                      $letter++;
                    }
                  ?>
                  <button role="tab" aria-controls="tab-<?php echo($letter);?>">Legal stuff</button>
                </menu>
                <!-- the tab content -->
                <article role="tabpanel" id="tab-A" style="size: A4">
                    <h3>What in the world is this "Meme Appreciation Month"?</h3>
                    <p>The archives say it started in Canada as the brainchild of Ben (VA4BEN), as a way to spread joy & cheer to all the good little hams on the RF spectrum.</p>
                    <p>Honestly it's a way for young hams to have some fun, use a cool callsign and do a neat activity together.</p>
                    <?php
                    foreach ($descriptions as $description) {
                      echo "<p>" . $description['description'] . "</p>";
                    }
                    ?>
                    <p>The title for this years event is <?php echo($current_title);?></p>
                    <h4>What is a meme and why does it have to be appreciated?</h4>
                    <p>Officially, according to a dictionary, a meme is "an image, video, piece of text, etc., typically humorous in nature, that is copied and spread rapidly by internet users, often with slight variations".</p>
                    <p>To make it short - a meme is something most young people know and find funny.</p>
                    <p>If this funny bit makes it into amateur radio and attracts the young folk - perfect, right?</p>
                    <h4>Meme Appreciation Award <?php echo($current_year);?></h4>
                    <p>This time, for your QSOs with all the meme callsigns, you can earn yourself some fancy awards!</p>
                    <p>You can check if you qualify and download your award on this nifty webpage:</p>
                    <a href=<?php echo("\"https://hamawardz.app/logcheck/meme-appreciation-award-" . $current_year . "\"");?>><button>Check your award here</button></a>
                    <p></p>
                    <hr>
                    <h4>This info in foreign languages:</h4>
                    <section class="field-row">
                      <a href="https://www.db4scw.de/meme-appreciation-month/"><button>Deutsch/German</button></a>
                      <a href="https://mememonth.fenneck.eu/"><button>Polski/Polish</button></a>
                    </section>
                </article>
                <article role="tabpanel" hidden id="tab-B">
                    <h3>Who is in this? How much LIDs can there be?</h3>
                    <p>
                      The following callsigns have been registered for <?php echo($current_title); ?>:

                        <!-- iterate through regions and get current participants -->
                        <?php
                        for ($i = 1; $i <= 3; $i++) {
                        ?>
                        <p>IARU Region <?php echo($i); ?>:
                        <ul>
                          <?php
                            $query1 = "SELECT * FROM callsigns WHERE year = " . $current_year . " AND region = " . $i . " AND hide = 0 ORDER BY sort ASC, id ASC";
                            $stmt1 = $db->query($query1);
                            $results1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

                            if (count($results1) > 0) {
                                foreach ($results1 as $row) {
                                    $flag = htmlspecialchars($row['flag']);
                                    $callsign = htmlspecialchars($row['callsign']);
                                    $mainop = htmlspecialchars($row['mainop']);
                                    echo "<li><span class=\"flag-icon flag-icon-{$flag} flag-icon-squared\"></span><a href=\"https://qrz.com/db/{$callsign}\" style=\"color: black; padding-left: 5px;\">{$callsign}</a> <!-- {$mainop} --></li>";
                                }
                            } else {
                                echo "<li>For this region, there are no participants announced yet. Check back later!</li>";
                            }
                          ?>
                        </ul>
                      </p>
                      <?php
                        }
                      ?>
                      <!-- Iteration ends here -->
                    </p>

                    <p>The actual operators of these calls may and will rotate throughout the event in order to get the most out of our money (cries in event callsign fees).</p>
                    <hr>
                    <h3>How to join the madness?</h3>
                    <a rel="noopener" target="_blank" href="https://discord.gg/fyvjGkky7W"><img class="hover-shadow" src="join-our-discord.png" alt="Join our Discord server" style="max-width:200px;border-radius:5px;"></a>
                </article>
                <article role="tabpanel" hidden id="tab-C">
                    <h3>When does this happen?</h3>
                    <p>The event will be active between <?php echo($current_from)?> and <?php echo($current_to)?>.</p>
                    <p>Between the group of operators behind this event, we will keep the meme calls on air for most of the event, surely with enough dial spinning you too can add a meme call to your logbook.</p>
                </article>
                <article role="tabpanel" hidden id="tab-D">
                    <h3>What and where do you operate?</h3>
                    <p>We will most likely operate mostly FT8 (to propagate the funny to as much people as possible) and SSTV (to share more memes). </p>
                    <p>Furthermore, SSB operations are planned, as well as other digital modes. OLIVIA, JS8, maybe Hellschreiber? Who knows.</p>
                    <p>If you are a POTA hunter, keep your eyes peeled for some POTA activations, too.</p>

                    <h4>Which of the Megahertz can I find you on?</h4>
                    <p>Likely operations will include all of HF (160m-6m), as well as 2m, 70cm and QO-100 satellite work (for those within the footprint).</p>
                </article>
                <article role="tabpanel" hidden id="tab-E">
                  <h3>Why the heck do you do this?</h3>
                  <p>Boredom, mischief, and too much free time (^:</p>
                  <p>Aside from that, we need moooooore of these young ham persons ;)</p>
                </article>
                <article role="tabpanel" hidden id="tab-F">
                  <h3>How do I get one of these epic meme-y goodness QSL cards?</h3>
                  <p>QSL policies vary from operator to operator. Please consult the QRZ pages of each callsign.</p>
                  <hr>
                  <h4>Examples of past QSL cards:</h4>
                  <img style="width: auto; height: 200px;" src="DL0LOL_QSL_card.jpg">
                  <img style="width: auto; height: 200px;" src="DL0NGCAT_QSL_card.jpg">
                  <img style="width: auto; height: 200px;" src="DF4CEPALM_QSL_card.jpg">
                </article>

                <!-- iterate over past events -->
                <?php
                $letter = $start_letter;
                foreach ($months as $monthrow) {
                ?>
                  <article role="tabpanel" hidden id="tab-<?php echo("$letter");?>">
                    <h3><?php echo($monthrow['title']);?></h3>
                    <h3 style="font-size: 20px;">Callsign Archive</h3>
                    <p>
                      The following callsigns were on air for <?php echo($monthrow['title']);?> from <?php echo($monthrow['from']);?> until <?php echo($monthrow['to']);?>: 

                      <!-- iterate over regions and load callsigns -->
                      <?php
                      for ($i = 1; $i <= 3; $i++) {
                      ?>
                      <p>IARU Region <?php echo($i);?>:
                        <ul>
                        <?php
                          $query1 = "SELECT * FROM callsigns WHERE year = " . $monthrow['year'] . " AND region = " . $i .  " AND hide = 0 ORDER BY sort ASC, id ASC";
                          $stmt1 = $db->query($query1);
                          $results1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

                          if (count($results1) > 0) {
                              foreach ($results1 as $row) {
                                  $flag = htmlspecialchars($row['flag']);
                                  $callsign = htmlspecialchars($row['callsign']);
                                  $mainop = htmlspecialchars($row['mainop']);
                                  echo "<li><span class=\"flag-icon flag-icon-{$flag} flag-icon-squared\"></span><a href=\"https://qrz.com/db/{$callsign}\" style=\"color: black; padding-left: 5px;\">{$callsign}</a> <!-- {$mainop} --></li>";
                              }
                          } else {
                              echo "<li>For this region, there were no participants.</li>";
                          }
                          ?>
                        </ul>
                      </p>
                      <?php
                      }
                      ?>
                      <!-- Region iteration ends here -->
                      </p>
                    </p>
                    <h3>Award check:</h3>
                    <?php
                    if($monthrow['award'] == 0)
                    {
                    ?>
                    <p>There were no awards in <?php echo($monthrow['year']);?>.</p>
                    <?php
                    }else{
                    ?>
                    <a href="https://hamawardz.app/logcheck/meme-appreciation-award-<?php echo($monthrow['year']); ?>"><button>Awardcheck (<?php echo($monthrow['year']); ?>)</button></a>
                    <?php
                    }
                    ?>
                    <!-- Event iteration stops here -->
                  </article>

                <?php
                  $letter++;
                }
                ?>

                <!-- Legal stuff here -->
                <article role="tabpanel" hidden id="tab-<?php echo($letter);?>">
                    <h3>Impressum</h3>
                    <p><a href="https://legal.wolf.taipei/impressum.html">Click here for Impressum</a></p>
                    <h3>Privacy declaration</h3>
                    <p><a href="https://legal.wolf.taipei/privacy.html">Click here for Privacy declaration</a></p>
                </article>
            </section>

            <section class="field-row" style="justify-content: flex-end">
            <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ"><button>OK</button></a>
            <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ"><button>Cancel</button></a>
            </section>
        </div>

        <div class="status-bar">
            <p class="status-bar-field" style="font-family: Arial;">Press your PTT for more fun.</p>
            <p class="status-bar-field" style="font-family: Arial;">Transmitting all your sensitive passwords on 27.025 MHz USB.....<?php echo rand(50,99);?>% done</p>
            <p class="status-bar-field" style="font-family: Arial;" style="justify-content: flex-end">CPU Usage: <?php echo rand(61,99);?>%</p>
        </div>

      </div>

      <div class="footer">
        <div class="footer-header"></div>
        <div class="footer-content">
          Page best viewed in IE 6 at 640 x 480. Thanks!
        </div>
        <div style="font-size: 12px;">The only cookies we use are the ones we feed our web developers.</div>
      </div>
  </body>
<script src="script_db4scw.js"></script>


</html>
