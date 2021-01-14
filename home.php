<?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/header.php'; ?>

<main>
  <h1>Welcome to PHP Motors!</h1>

  <div class="topcontainer">
    <section class="deloreanp">
      <h2>DMC Delorean</h2>
      <p>3 Cup holders</p>
      <p>Superman doors</p>
      <p>Fuzzy dice!</p>
    </section>

    <img class='delorean' src="images/delorean.jpg" alt="Delorean">

    <div class="buttondiv">
      <button>Own Today</button>
    </div>
  </div>

  <div class="bottomcontainer">
    <section class="deloreanreviews">
      <h2>DMC Delorean Reviews</h2>
      <ul>
        <li>"So fast its almost like traveling time." (4/5)</li>
        <li>"Coolest ride on the road." (4/5)</li>
        <li>"I'm feeling Marty McFly!" (5/5)</li>
        <li>"The most futuristic ride of our day." (5/5)</li>
        <li>"80's livin and I love it!" (5/5)</li>
      </ul>
    </section>

    <section class="upgradecontainer">
      <h2>Delorean Upgrades</h2>
      <div class="deloreanupgrades">
        <figure>
          <img class="deloreanupgradesfig" src="images/upgrades/flux-cap.png" alt="Flux Capacitor">
          <figcaption>Flux Capacitor</figcaption>
        </figure>
        <figure>
          <img class="deloreanupgradesfig" src="images/upgrades/flame.jpg" alt="Flame Decals">
          <figcaption>Flame Decals</figcaption>
        </figure>
        <figure>
          <img class="deloreanupgradesfig" src="images/upgrades/bumper_sticker.jpg" alt="Bumper Stickers">
          <figcaption>Bumper Stickers</figcaption>
        </figure>
        <figure>
          <img class="deloreanupgradesfig" src="images/upgrades/hub-cap.jpg" alt="Hub Caps">
          <figcaption>Hub Caps</figcaption>
        </figure>
      </div>
    </section>
  </div>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php'; ?>