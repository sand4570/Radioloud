<?php 

/**
*The page wich displays loop wiew
*/

get_header();
?>

<section id="primary" class="content-area">
    <main id="main" class="site-main">

        <button class="singletilbage">Tilbage</button>
        <article class="singlearticle">
            <div class="singlebillede">

                <h2 class="titel"></h2>
                <a href="https://open.spotify.com/" target=”_blank”>
                    <img src="images/download.png" alt="Spotify-ikon">
                </a>
                <a href="">
                    <img src="images/download-kopi.png" alt="Afspil-knap">
                </a>
                <p class="txt"></p>
                <img src="" alt="" class="billede">


                <h3>Episoder</h3>
                <div>
                    <a href="">
                        <img src="images/download-kopi.png" alt="Afspil-knap">
                    </a>
                    <p>Episode 1</p>
                </div>
                <div>

                    <a href="">
                        <img src="images/download-kopi.png" alt="Afspil-knap">
                    </a>
                    <p>Episode 2</p>
                </div>
                <div>

                    <a href="">
                        <img src="images/download-kopi.png" alt="Afspil-knap">
                    </a>
                    <p>Episode 3</p>
                </div>
                <div>
                    <a href="">
                        <img src="images/download-kopi.png" alt="Afspil-knap">
                    </a>
                    <p>Episode 4</p>
                </div>
                <div>
                    <a href="">
                        <img src="images/download-kopi.png" alt="Afspil-knap">
                    </a>
                    <p>Episode 5</p>
                </div>
                <div>
                    <a href="">
                        <img src="images/download-kopi.png" alt="Afspil-knap">
                    </a>
                    <p>Episode 6</p>
                </div>
                <div>
                    <a href="">
                        <img src="images/download-kopi.png" alt="Afspil-knap">
                    </a>
                    <p>Episode 7</p>
                </div>
                <div>
                    <a href="">
                        <img src="images/download-kopi.png" alt="Afspil-knap">
                    </a>
                    <p>Episode 8</p>
                </div>
                <div>
                    <a href="">
                        <img src="images/download-kopi.png" alt="Afspil-knap">
                    </a>
                    <p>Episode 9</p>
                </div>
                <div>
                    <a href="">
                        <img src="images/download-kopi.png" alt="Afspil-knap">
                    </a>
                    <p>Episode 10</p>
                </div>
                <div>
                    <a href="">
                        <img src="images/download-kopi.png" alt="Afspil-knap">
                    </a>
                    <p>Episode 11</p>
                </div>
                <div>
                    <a href="">
                        <img src="images/download-kopi.png" alt="Afspil-knap">
                    </a>
                    <p>Episode 12</p>
                </div>
            </div>

        </article>

    </main>
</section>


<script>
    let podcast;

    const dbUrl = "https://neanderpetersen.dk/kea/09_cms/radioloud/wp-json/wp/v2/podcast/" + <?php echo get_the_ID() ?>;

    async function getJson() {
        console.log("getJson");
        const data = await fetch(dbUrl);
        podcast = await data.json();
        visPodcasts();
    }

    function visPodcasts() {
        console.log("visPodcasts");
        document.querySelector(".titel").textContent = podcast.title.rendered;
        document.querySelector(".txt").textContent = podcast.beskrivelse;
        document.querySelector(".billede").src = podcast.billede.guid;

    }

    tilbageKnap();

    function tilbageKnap() {
        document.querySelector(".singletilbage").addEventListener("click", visTilbage);
    }

    function visTilbage() {
        window.history.back();
    }

    getJson();

</script>

<?php
get_footer();
